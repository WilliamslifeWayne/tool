<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Session;
use App\user;
class LoginController extends Controller
{
	public function index()
	{
		return view("auth.login");
	}

	//形成验证码方法
	public function getCheckCode()
	{
		//创建验证码对象
		$builder = new CaptchaBuilder;
		$builder->build($width = 120, $height = 40,$font = null);
		$phrase = $builder->getPhrase();
		Session::flash("checkcode", $phrase);
		header("Cache-Control: no-cache, must-revalidate");
		header("Content-Type: image/jpeg");
		return $builder->output();
	}

	//登录检测
	public function logincheck(Request $request)
	{
		$this->validate($request,[
			"username" => "required",
			"password" => "required",
			"checkcode" => "required",
		 ], [
		 	"username.required" => "用户名不能为空",
		 	"password.required" => "密码不能为空",
		 	"checkcode.required" => "验证码不能为空",
		 ]);
	}    
}
