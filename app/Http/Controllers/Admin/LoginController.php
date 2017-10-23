<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Hash;
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

	//验证码输入检测
	public function check_code($code)
	{
		$checkcode = Session::get("checkcode");
		if ($code == $checkcode) {
			return 1;
		} else {
			return 0;
		}
	}

	//登录检测
	public function logincheck(Request $request)
	{
		$this->validate($request, [
			"username" => "required",
			"password" => "required",
			"checkcode" => "required",
		 ], [
		 	"username.required" => "用户名不能为空",
		 	"password.required" => "密码不能为空",
		 	"checkcode.required" => "验证码不能为空",
		 ]);
		$User   = new User;
		$record = $User->where("username", $request->username)->first();
		if ($res = Hash::check($request->password, $record->password)) {
			//用户持久化操作
			Session::flash("username",$record->username);
			Session::flash("group",$record->group);
			Session::flash("tel",$record->tel);
			return view("/admin/index");
		} else {
			//用户名或者密码不正确
			return redirect("/admin/login")->with("message", "用户名或者密码不正确");
		}
	}    
}
