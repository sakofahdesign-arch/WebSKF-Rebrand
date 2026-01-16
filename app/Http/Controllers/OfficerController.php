<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficerController extends Controller
{
    protected $connection = 'mysql_second';

    public function member()
    {
        return view('office.members.member');
    }

    public function searchMember(Request $request)
    {
        $request->validate([
            'idCardNumber' => 'nullable|string|max:20',
            'memberNumber' => 'nullable|string|max:20',
            'firstName'    => 'nullable|string|max:50',
            'lastName'     => 'nullable|string|max:50',
            'branch'       => 'nullable|string|max:10',
        ]);

        $query = DB::connection('mysql_second')
            ->table('MEM_H_MEMBER')
            ->join('BK_M_BRANCH', 'BK_M_BRANCH.BR_NO', '=', 'MEM_H_MEMBER.BR_NO');

        if ($request->filled('idCardNumber')) {
            $query->where('MEM_H_MEMBER.ID_CARD', 'like', '%' . $request->idCardNumber . '%');
        }

        if ($request->filled('memberNumber')) {
            $query->where('MEM_H_MEMBER.MEM_ID', 'like', '%' . $request->memberNumber . '%');
        }

        if ($request->filled('branch')) {
            $query->where('MEM_H_MEMBER.BR_NO', 'like', '%' . $request->branch . '%');
        }

        if ($request->filled('firstName')) {
            $query->where('MEM_H_MEMBER.FNAME', 'like', '%' . $request->firstName . '%');
        }

        if ($request->filled('lastName')) {
            $query->where('MEM_H_MEMBER.LNAME', 'like', '%' . $request->lastName . '%');
        }

        // ใช้ paginate() แทน limit()->get() และกำหนดจำนวนรายการต่อหน้า (เช่น 15)
        $data = $query->select(
            'MEM_H_MEMBER.MEM_ID',
            'MEM_H_MEMBER.BR_NO',
            'BK_M_BRANCH.BR_NAME',
            'MEM_H_MEMBER.FNAME',
            'MEM_H_MEMBER.LNAME'
        )->paginate(15);

        // ส่งข้อมูลและ input เดิมกลับไปที่ view
        // ไม่จำเป็นต้องใช้ compact('data') แล้วส่ง withInput() เพราะเราใช้ GET method
        // ข้อมูล input จะอยู่ใน URL อยู่แล้ว เราจะดึงจาก request() ใน view ได้เลย
        return view('office.members.member', compact('data'));
    }

    public function data_member(Request $request)
    {
        $mem_id = trim($request->mem_id);
        $br_no  = trim($request->br_no);

        // ข้อมูลสมาชิก
        $data_member = DB::connection('mysql_second')->table('MEM_H_MEMBER')
            ->where('MEM_ID', $mem_id)
            ->where('BR_NO', $br_no)
            ->select('FNAME', 'LNAME', 'ID_CARD', 'DMY_BIRTH', 'SEX', 'FATHER', 'MOTHER', 'MARRIAGE_STATUS', 'BLO_GROUP', 'ADDRESS', 'MOO_ADDR', 'TUMBOL', 'LINE_ID', 'EMAIL', 'MOBILE_TEL')
            ->first();

        // ตรวจสอบว่าข้อมูลสมาชิกมีหรือไม่
        if (! $data_member) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลสมาชิกที่คุณค้นหา');
        }

        // ข้อมูลบัญชีเงินฝาก
        $deposit_member = DB::connection('mysql_second')->table('BK_H_SAVINGACCOUNT')
            ->where('MEM_ID', $mem_id)
            ->where('BR_NO', $br_no)
            ->select('ACCOUNT_NO', 'ACCOUNT_NAME', 'BALANCE')
            ->get();

        // ข้อมูลสินเชื่อที่เปิด
        $opened_credit_member = DB::connection('mysql_second')->table('LOAN_M_CONTACT')
            ->where([
                ['LOAN_M_CONTACT.MEM_ID', '=', $mem_id],
                ['LOAN_M_CONTACT.BR_NO', '=', $br_no],
                ['LOAN_M_CONTACT.LCONT_STATUS_FLAG', '=', '1'],
            ])
            ->join('LOAN_M_REGISTER', function ($join) {
                $join->on('LOAN_M_REGISTER.CODE', '=', 'LOAN_M_CONTACT.CODE')
                    ->on('LOAN_M_REGISTER.BR_NO', '=', 'LOAN_M_CONTACT.BR_NO');
            })
            ->join('LOAN_M_SUB_NAME', function ($join) {
                $join->on('LOAN_M_SUB_NAME.L_TYPE_CODE', '=', 'LOAN_M_CONTACT.L_TYPE_CODE')
                    ->on('LOAN_M_SUB_NAME.LSUB_CODE', '=', 'LOAN_M_CONTACT.LSUB_CODE');
            })
            ->select('LOAN_M_CONTACT.LCONT_ID', 'LOAN_M_SUB_NAME.LSUB_NAME', 'LOAN_M_CONTACT.LCONT_DATE', 'LOAN_M_REGISTER.END_PAYDEPT', 'LOAN_M_CONTACT.LCONT_APPROVE_SAL', 'LOAN_M_CONTACT.LCONT_AMOUNT_INST', 'LOAN_M_CONTACT.LCONT_AMOUNT_SAL', 'LOAN_M_CONTACT.CODE', 'LOAN_M_CONTACT.BR_NO')
            ->orderByDesc('LOAN_M_CONTACT.LCONT_DATE')
            ->get();

        // ข้อมูลสินเชื่อที่ปิด
        $closed_credit_member = DB::connection('mysql_second')->table('LOAN_M_CONTACT')
            ->where([
                ['LOAN_M_CONTACT.MEM_ID', '=', $mem_id],
                ['LOAN_M_CONTACT.BR_NO', '=', $br_no],
                ['LOAN_M_CONTACT.LCONT_STATUS_FLAG', '=', '4'],
            ])
            ->join('LOAN_M_REGISTER', function ($join) {
                $join->on('LOAN_M_REGISTER.CODE', '=', 'LOAN_M_CONTACT.CODE')
                    ->on('LOAN_M_REGISTER.BR_NO', '=', 'LOAN_M_CONTACT.BR_NO');
            })
            ->join('LOAN_M_SUB_NAME', function ($join) {
                $join->on('LOAN_M_SUB_NAME.L_TYPE_CODE', '=', 'LOAN_M_CONTACT.L_TYPE_CODE')
                    ->on('LOAN_M_SUB_NAME.LSUB_CODE', '=', 'LOAN_M_CONTACT.LSUB_CODE');
            })
            ->select('LOAN_M_CONTACT.LCONT_ID', 'LOAN_M_SUB_NAME.LSUB_NAME', 'LOAN_M_CONTACT.LCONT_DATE', 'LOAN_M_REGISTER.END_PAYDEPT', 'LOAN_M_CONTACT.LCONT_APPROVE_SAL', 'LOAN_M_CONTACT.LCONT_AMOUNT_INST', 'LOAN_M_CONTACT.LCONT_AMOUNT_SAL', 'LOAN_M_CONTACT.CODE', 'LOAN_M_CONTACT.BR_NO')
            ->orderByDesc('LOAN_M_CONTACT.LCONT_DATE')
            ->get();

        // ข้อมูลหุ้น
        $stock_select = DB::connection('mysql_second')->table('SHR_MEM')
            ->where('SHR_MEM.MEM_ID', $mem_id)
            ->where('SHR_MEM.BR_NO', $br_no)
            ->join('BK_M_BRANCH', 'BK_M_BRANCH.BR_NO', '=', 'SHR_MEM.BR_NO')
            ->join('WEL_H_MEMBER', function ($join) {
                $join->on('WEL_H_MEMBER.MEM_ID', '=', 'SHR_MEM.MEM_ID')
                    ->on('WEL_H_MEMBER.BR_NO', '=', 'SHR_MEM.BR_NO');
            })
            ->select('SHR_MEM.MEM_ID', 'BK_M_BRANCH.BR_NAME', 'SHR_MEM.SHR_SUM_BTH', 'WEL_H_MEMBER.MEM_AGE_OLD', 'SHR_MEM.POINT_SHR')
            ->first();

        // เช็คว่ามีข้อมูลหุ้นหรือไม่
        $stock_exists = $stock_select !== null;

        // ข้อมูลอายุหุ้น
        $stock_age = DB::connection('mysql_second')->table('SHR_T_SHARE')
            ->select(DB::raw('SUM(SHR_ADV_COUNT) as total'))
            ->where('MEM_ID', $mem_id)
            ->where('BR_NO', $br_no)
            ->where('TMP_DATE_REC', '>=', '2019-07-01')
            ->first();

        // ข้อมูลการฝากหุ้น
        $stock_details = DB::connection('mysql_second')->table('SHR_T_SHARE')
            ->where('SHR_T_SHARE.MEM_ID', $mem_id)
            ->where('SHR_T_SHARE.BR_NO', $br_no)
            ->leftJoin('SHR_TBL', 'SHR_T_SHARE.SHR_NO', '=', 'SHR_TBL.SHR_NO')
            ->select('SHR_T_SHARE.SLIP_NO', 'SHR_TBL.SHR_NA', 'SHR_T_SHARE.TMP_SHARE_QTY', 'SHR_T_SHARE.TMP_SHARE_BHT', 'SHR_T_SHARE.TMP_DATE_TODAY', 'SHR_T_SHARE.SHR_SUM_BTH')
            ->orderBy('TMP_DATE_TODAY', 'DESC')
            ->get();

        // ข้อมูลเงินปันผล
        $dividend = DB::connection('mysql_second')->table('SHR_PAY_DIVIDEND')
            ->where('SHR_PAY_DIVIDEND.MEM_ID', $mem_id)
            ->where('SHR_PAY_DIVIDEND.BR_NO', $br_no)
            ->where('SHR_PAY_DIVIDEND.SHR_YEAR', date('Y') - 1)
            ->join('BK_M_BRANCH', 'BK_M_BRANCH.BR_NO', '=', 'SHR_PAY_DIVIDEND.BR_NO_PAY')
            ->select('SHR_PAY_DIVIDEND.SHR_YEAR', 'SHR_PAY_DIVIDEND.SHR_OUT_DATE', 'SHR_PAY_DIVIDEND.SHR_SUMUP_DIV', 'BK_M_BRANCH.BR_NAME')
            ->first();

        // ส่งข้อมูลไปยัง view ถ้าหากข้อมูลหุ้นมี
        return view('office.members.data_member', [
            'data_member'          => $data_member,
            'deposit_member'       => $deposit_member,
            'opened_credit_member' => $opened_credit_member,
            'closed_credit_member' => $closed_credit_member,
            'stock_exists'         => $stock_exists,
            'stock_select'         => $stock_select,
            'stock_age'            => $stock_age,
            'stock_details'        => $stock_details,
            'dividend'             => $dividend,
        ]);
    }

    public function account_details(Request $request)
    {
        $account_no = $request->account_number;

        // 1. ดึงข้อมูลสรุปของบัญชี (แค่ 1 record)
        $account_info = DB::connection('mysql_second')->table('BK_H_SAVINGACCOUNT')
            ->where('ACCOUNT_NO', $account_no)
            ->select('ACCOUNT_NO', 'ACCOUNT_NAME')
            ->first();

        if (! $account_info) {
            return redirect()->back()->with('error', 'ไม่พบบัญชีนี้');
        }

        $account_transactions = DB::connection('mysql_second')->table('BK_T_FINANCE')
            ->where('F_FROM_ACC', $request->account_number)
            ->orderByDesc('F_TIME')
            ->get();

        return view('office.members.account_details', [
            'account_info' => $account_info,
            'account'      => $account_transactions,
        ]);
    }

    public function loan_details(Request $request)
    {
        $loan_select = DB::connection('mysql_second')->table('LOAN_M_CONTACT')
            ->select('LOAN_M_CONTACT.LCONT_ID', 'LOAN_M_CONTACT.L_TYPE_CODE', 'LOAN_M_CONTACT.LSUB_CODE', 'LOAN_M_CONTACT.LCONT_DATE', 'LOAN_M_CONTACT.LCONT_APPROVE_SAL', 'LOAN_M_CONTACT.LCONT_AMOUNT_INST', 'LOAN_M_CONTACT.LCONT_AMOUNT_SAL', 'LOAN_M_REGISTER.END_PAYDEPT', 'LOAN_M_SUB_NAME.LSUB_NAME')
            ->where('LOAN_M_CONTACT.BR_NO', $request->br_no)
            ->where('LOAN_M_CONTACT.CODE', $request->code)
            ->join('LOAN_M_REGISTER', 'LOAN_M_REGISTER.CODE', '=', 'LOAN_M_CONTACT.CODE')
            ->join('LOAN_M_SUB_NAME', function ($join) {
                $join->on('LOAN_M_SUB_NAME.L_TYPE_CODE', '=', 'LOAN_M_CONTACT.L_TYPE_CODE')
                    ->on('LOAN_M_SUB_NAME.LSUB_CODE', '=', 'LOAN_M_CONTACT.LSUB_CODE');
            })
            ->first();
        $loan_detail = DB::connection('mysql_second')->table('LOAN_M_PAYDEPT')->where([
            ['CODE', '=', $request->code],
            ['BR_NO', '=', $request->br_no],
            ['LPD_NUM_INST', '>', '0'],
        ])->orderByDesc('LPD_DATE')->select('LPD_DATE', 'SUM_SAL', 'LCONT_BAL_AMOUNT', 'LPD_NUM_INST')->get();
        return view('office.members.loan_details', compact('loan_detail', 'loan_select'));
    }
}
