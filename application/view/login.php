<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/plugins/layui/css/layui.css">
    <script src="/static/plugins/layui/layui.all.js"></script>
    <title><?=$data['title']?></title>
</head>
<body>
<div class="layui-form layui-form-pane">
    <div class="layui-form-item">
        <label for="" class="layui-form-label">用户名：</label>
        <div class="layui-input-inline">
            <input type="text" name="username" id="username" class="layui-input">
        </div>

        <div class="layui-form-item">
            <label for="" class="layui-form-label">密码：</label>
            <div class="layui-input-inline">
                <input type="password" name="password" id="password" class="layui-input">
            </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" onclick="login()">登陆</button>
            </div>
        </div>
    </div>
</div>
<script >
    layui.use(['layer'],function () {
        layer = layui.layer;
        $ = layui.jquery;
    });
    function login() {
        var username = $.trim($('#username').val());
        var password = $.trim($('#password').val());

        if(username==''){
            return false;
        }
        if(password==''){
            layer.alert("密码不能为空",{icon:2});
            return false;
        }
        $.post('/Account/dologin',{'username':username,'password':password},function (res) {
            // layer.alert(res.msg);
        if(res.code>0){
            layer.alert(res.msg,{icon: 2})
        }else{
            layer.msg(res.msg);
            setTimeout(function () {
                parent.window.location.reload();
            },1000)
        }
        },'json')
        
    }
</script>
</body>
</html>