layui.use(['layer','laypage'],function () {
    layer = layui.layer;
    $ = layui.jquery;
    laypage = layui.laypage;
});

function login() {
    layer.open({
        type:2,
        title:'登陆',
        area:['380px','230px'],
        content:'/Account/login',
        skin:'layui-layer-molv',
        offset: 'auto',
        maxmin:true,
        anim:1,
        shadeClose:true
    });
}
function register(){
    layer.open({
        type:2,
        title:'注册',
        area:['380px','230px'],
        content:'/Account/register',
        skin:'layui-layer-molv',
        offset: 'auto',
        maxmin:true,
        anim:1,
        shadeClose:true
    });
}
function logout() {
    layer.confirm('确定退出吗？',{
        btn:['确定','取消'],
    },function () {
        //确定处理
        $.post('Account/logout',function (res) {
            if(res.code>0){
                layer.alert(res.msg,{icon:2});
            }else{
                layer.msg('退出成功');
                setTimeout(function () {
                    parent.window.location.reload();
                },1000)
            }
        })
    })
}

function tz() {
    layer.open({
        type:2,
        title:'发帖',
        area:['800px','600px'],
        content:'/article/publish',
        skin:'layui-layer-molv',
        offset: 'auto',
        maxmin:true,
        anim:1,
        shadeClose:true
    });
}