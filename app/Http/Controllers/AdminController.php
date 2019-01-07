<?php
/**
 * Created by PhpStorm.
 * User: XIBINWEI
 * Date: 2018/11/2
 * Time: 12:03
 */

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {

        $admin = new Admin();
        $admin->id = 666;
        $admin->uuid = 666;
        $admin->name = 666;
        $admin->image_url = 666;

        $admin->save();
        $result = Admin::where('id', '>=', 1)->orderby('id', 'desc')->get();

        foreach ($result as $v) {
            echo $v->uuid . "<br>";
        }

    }
}