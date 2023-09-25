<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Add_adminController extends Controller
{
    public function get_admin()
    {
        $order = request('order', 'desc');
        if (request('email')) {
            $this->add_admin(request('email'), request('rule'));
        }
        $date = DB::table('users', 'u')
            ->join('roles as r', 'u.role_id', '=', 'r.id')
            ->whereNot('r.name', 'user')
            ->leftJoin('product_users as pu', 'u.id', '=', 'pu.user_id')
            ->select('u.name as u_name', 'u.updated_at', 'r.name as r_name', DB::raw('COUNT(CASE WHEN pu.is_sell = 0 THEN 1 END) AS product_count'), DB::raw('COUNT(CASE WHEN pu.is_sell = 1 THEN 1 END) AS sold_count'))
            ->orderBy('u.updated_at', $order)
            ->groupBy('u.name', 'u.updated_at', 'r.name')
            ->where('u.id', '<>', 1)
            ->get();
        return $date;
    }

    public function add_admin($email, $role)
    {
        $r = DB::table('roles')->where('name', $role)->select('id')->first();
        $u = DB::table('users')->where('email', $email)->first('*');
        DB::table('users')->where('id', $u->id)->update(['role_id' => $r->id]);
    }
}
