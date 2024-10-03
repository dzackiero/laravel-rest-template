<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index()
    {
        auth("web")->logout();
        return view('login');
    }

    public function login()
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth("web")->attempt($credentials)) {
            return redirect("login")->withErrors(["message" => __("auth.failed")]);
        }

        return redirect("/telescope");
    }


}
