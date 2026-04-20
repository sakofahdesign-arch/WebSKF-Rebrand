<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function store(Request $request)
    {
        $userAgent = $request->header('User-Agent');
        $agent     = new Agent();
        $agent->setUserAgent($userAgent);
        $request->validate(
            [
                'user_id'  => 'required',
                'password' => 'required',
            ],
            [
                'user_id.required'  => 'กรุณาใส่ชื่อผู้ใช้',
                'password.required' => 'กรุณาใส่รหัสผ่าน',
            ]
        );
        $data = DB::connection('mysql_second')->table('BK_H_TELLER_CONTROL')->where([
            'user_id'  => $request->user_id,
            'password' => $request->password,
        ])
            ->select(
                'USER_ID',
                'BR_NO',
                'USER_NAME',
                'LEVEL_CODE'
            )->first();
        if ($data) {
            $request->session()->put([
                'user_id'    => $data->USER_ID,
                'username'   => $data->USER_NAME,
                'br_no'      => $data->BR_NO,
                'level_code' => $data->LEVEL_CODE,
            ]);
            DB::table('signin_history')
                ->insert([
                    'user_id'    => $data->USER_ID,
                    'branch_id'  => $data->BR_NO,
                    'user_name'  => $data->USER_NAME,
                    'login_time' => now(),
                    'ip_address' => $request->ip(),
                    'browser'    => $agent->browser(),
                    'version'    => $agent->version($agent->browser()),
                    'platform'   => $agent->platform(),
                ]);
            return view('office.members.member');
        }
        return back()->withErrors(['user_id' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['user_id', 'username', 'br_no', 'level_code']);
        $request->session()->regenerateToken();
        return redirect('login');
    }

    public function login_history()
    {
        $login_history = DB::table('signin_history')->join('branch_name', 'branch_name.branch_id', '=', 'signin_history.branch_id')->orderBy('login_time', 'desc')->paginate(15);
        return view('office.admin.login_history', compact('login_history'));
    }
}
