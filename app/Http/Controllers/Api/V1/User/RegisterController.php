<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public $loginAfterSignUp = true;

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required|max:18',
            'email' => 'bail|required|email|unique:users,email',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return (new LoginController())->login($request);
        }
        return $this->success($user);
    }
}