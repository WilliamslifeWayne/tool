<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
class LoginController extends Controller
{
	public function index()
	{
		
		return view("auth.login");
	}
    
}
