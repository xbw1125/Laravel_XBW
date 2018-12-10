<?php
/**
 * Created by PhpStorm.
 * User: XIBINWEI
 * Date: 2018/11/2
 * Time: 12:03
 */

namespace App\Http\Controllers;

use App\Admin;

class AdminController extends Controller
{
    public function index()
    {
        $result = Admin::where('id','>=',1)->orderby('id','desc')->get();

        foreach ($result as $v){
            echo $v->uuid."<br>";
        }

    }
}