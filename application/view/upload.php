<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/plugins/layui/css/layui.css">
    <script src="/static/plugins/layui/layui.all.js"></script>
    <title>Document</title>
</head>
<body>

<button type="button" class="layui-btn" id="test1">
    <i class="layui-icon">&#xe67c;</i>上传图片
</button>
<img src="" alt="" id="img">
<script>
    layui.use('upload', function(){
        var upload = layui.upload;
        var $ = layui.jquery;
        //执行实例
        var uploadInst = upload.render({
            elem: '#test1' //绑定元素
            ,url: '/Upload/up' //上传接口,
            ,method:'post'
            ,accept:'file'
            ,multiple : true
            ,done: function(res,index){
                if(res.code>0){
                    layer.alert(res.msg,{icon:2});


                }else{
                    layer.msg(res.msg);
                    $('#img').attr('src',res.data);
                    console.log(res.data);
                }
                console.log(index);
            }
            ,error: function(res){
                layer.alert(res.msg)
            }
        });
    });
</script>
</body>
</html>