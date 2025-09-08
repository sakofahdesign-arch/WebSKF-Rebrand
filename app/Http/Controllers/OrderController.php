<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function rules()
    {
        return view('office.orders.rule');
    }

    public function order()
    {
        return view('office.orders.order');
    }

    public function form()
    {
        $data = DB::table('internal_announcement')->select('id', 'title', 'date', 'uploadfile','type_announcement')->where('type_announcement', 1)->orderBy('date', 'DESC')->paginate(20);
        return view('office.orders.form', compact('data'));
    }

    public function publish()
    {
        $data = DB::table('internal_announcement')->select('id', 'title', 'date', 'uploadfile','type_announcement')->where('type_announcement', 2)->orderByDesc('date')->paginate(15);
        return view('office.orders.publish', compact('data'));
    }

}
