<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="lib/html5shiv.js"></script>
    <script type="text/javascript" src="lib/respond.min.js"></script>
    <![endif]-->
    <link href="/admin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/admin/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
    <link href="/admin/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>Tool 后台登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
</head>
<body>
    {{Session::get("checkcode")}}
<input type="hidden" id="TenantId" name="TenantId" value="" />
<div class="loginWraper">
    <div id="loginform" class="loginBox">
    	<div style="color: white;text-align:center"><h4>Tool 后台登录系统</h4></div>
        <form class="form form-horizontal" action="/admin/login" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe62c;</i></label>
                <div class="formControls col-xs-8">
                    <input name="username" type="text" placeholder="请输入账号" class="input-text radius size-L">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe605;</i></label>
                <div class="formControls col-xs-8">
                    <input name="password" type="password" placeholder="请输入密码" class="input-text radius size-L">
                </div>
            </div>
            <div class="row cl">
            	<label class="form-label col-xs-3"><i class="Hui-iconfont">&#xe63f;</i></label>
            	<div class="formControls col-xs-8">
                	<input name="checkcode" id="code" class="input-text radius size-L" type="text" placeholder="验证码" value="" onblur="check_code()" style="width:150px;">
                	<img src="{{URL('/admin/login/getCheckCode')}}" id="checkcodeimg" class="radius"> <a id="kanbuq" href="javascript:;" onClick="againCode()">看不清，换一张</a>
                </div>
            </div>
            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <label for="online" style="color:red;">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </label>
                </div>
            </div>
            <div class="row cl">
                <div class="formControls col-xs-8 col-xs-offset-3">
                    <input name="" type="submit" class="btn btn-success radius size-L" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;">
                    <input name="" type="reset" class="btn btn-default radius size-L" value="&nbsp;取&nbsp;&nbsp;&nbsp;&nbsp;消&nbsp;">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="footer">Copyright &copy; 1993-2017 Powered by Williams Technology</div>
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript">
	function againCode(){
		$.ajax({
			url: '/admin/login/getCheckCode',
			type: 'GET',
			success: function(data){
                if(data){
                	var urls =$('#checkcodeimg').attr('src');
                    $("#checkcodeimg").attr('src', urls);
                }else{
                    alert("获取验证码失败！");
                }
            }
		})
	}
    function check_code(){
        var code = $("#code").val();
        $.ajax({
            url: '/admin/login/check_code/checkcode/' + code,
            type: 'GET',
            success:function(data){
                if (data == 0) {
                    alert("验证码输入有误");
                    // window.location.reload();
                }
            }
        });
    }
</script>
</body>
</html>