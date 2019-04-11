<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/static/plugins/layui/css/layui.css">
    <script src="/static/plugins/layui/layui.all.js"></script>
    <script src="/static/plugins/wangeditor/wangEditor.min.js"></script>
    <title>Document</title>
</head>
<body style="padding: 10px">
<div class="layui-form">
    <div class="layui-form-item">
        <label for="title" class="layui-form-label">标题</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" id="title" name="title">
        </div>
    </div>
    <div class="layui-form-item">
        <label for="title" class="layui-form-label">分类</label>
        <div class="layui-input-inline">
            <select name="cate" id="cate" lay-search>
                <option value="0"></option>
                <?php foreach ($data['cates'] as $cates) {
                    echo '<option value="' . $cates['cid'] . '">' . $cates['title'] . '</option>';
                }
                ?>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label for="content" class="layui-form-label">帖子内容</label>
        <div class="layui-input-block">
            <div id="wangeditor">

            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button id='btn' class="layui-btn" onclick="publish()">发帖</button>
        </div>
    </div>
</div>

<script>

    layui.use(['form', 'layer'], function () {
        form = layui.form;
        $ = layui.jquery;
        form.render('select');
    });

    var E = window.wangEditor
    var editor = new E('#wangeditor')


    //图片上传
    editor.customConfig.uploadImgServer = '/Upload/up'
    editor.customConfig.uploadImgMaxLength = 5
    editor.customConfig.uploadFileName = 'file'
    editor.customConfig.uploadImgTimeout = 3000
    editor.customConfig.uploadImgHooks = {
        before: function (xhr, editor, files) {
            // 图片上传之前触发
            // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，files 是选择的图片文件

            // 如果返回的结果是 {prevent: true, msg: 'xxxx'} 则表示用户放弃上传
            // return {
            //     prevent: true,
            //     msg: '放弃上传'
            // }
        },
        success: function (xhr, editor, result) {
            // 图片上传并返回结果，图片插入成功之后触发
            // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
        },
        fail: function (xhr, editor, result) {
            // 图片上传并返回结果，但图片插入错误时触发
            // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象，result 是服务器端返回的结果
        },
        error: function (xhr, editor) {
            // 图片上传出错时触发
            // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象
        },
        timeout: function (xhr, editor) {
            // 图片上传超时时触发
            // xhr 是 XMLHttpRequst 对象，editor 是编辑器对象
        },

        // 如果服务器端返回的不是 {errno:0, data: [...]} 这种格式，可使用该配置
        // （但是，服务器端返回的必须是一个 JSON 格式字符串！！！否则会报错）
        customInsert: function (insertImg, result, editor) {
            // 图片上传并返回结果，自定义插入图片的事件（而不是编辑器自动插入图片！！！）
            // insertImg 是插入图片的函数，editor 是编辑器对象，result 是服务器端返回的结果

            // 举例：假如上传图片成功后，服务器端返回的是 {url:'....'} 这种格式，即可这样插入图片：
            if(result.code>0){
                layer.alert(result.msg,{icon:2});
            }else{
                var url = result.data
                insertImg(url)
            }



            // result 必须是一个 JSON 格式字符串！！！否则报错
        }
    }






    editor.customConfig.fontNames = [
        '宋体',
        '微软雅黑',
        'Arial',
        'Tahoma',
        'Verdana'
    ]
    editor.customConfig.menus =
        [
            'head',  // 标题
            'bold',  // 粗体
            'fontSize',  // 字号
            'fontName',  // 字体
            'italic',  // 斜体
            'underline',  // 下划线
            'strikeThrough',  // 删除线
            'foreColor',  // 文字颜色
            'backColor',  // 背景颜色
            'link',  // 插入链接
            'list',  // 列表
            'justify',  // 对齐方式
            'quote',  // 引用
            'emoticon',  // 表情
            'image',  // 插入图片
            'table',  // 表格
            'video',  // 插入视频
            'code'  // 插入代码
        ]
    editor.customConfig.zIndex = 1
    editor.customConfig.onchange = function (html) {
        // html 即变化之后的内容
        console.log(html)
    }
    editor.create()

    function publish() {
        title = $.trim($('#title').val())
        cate = $.trim($('#cate').val())
        content = editor.txt.html();

        if (title == '') {
            layer.alert('请输入帖子标题', {icon: 2});
            return false;
        }
        if (cate == 0) {
            layer.alert('请选择帖子分类', {icon: 2})
            return false;
        }
        if (content == '<p><br></p>') {
            layer.alert('请输入帖子内容', {icon: 2})
            return false;
        }
        $('#btn').attr('disabled',true);
        $.post('/Article/dopublish', {'title': title, 'cate': cate, 'content': content},function (res) {
            if(res.code>0){
                $('#btn').attr('disabled',false);
                layer.alert(res.msg,{icon:2});
            }else{
                layer.msg(res.msg);
                setTimeout(function () {
                    window.location.reload();
                },1000)
            }
        })
    }

</script>
</body>
</html>