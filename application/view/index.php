<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
    <meta name="renderer" content="webkit"/>
    <meta name="applicable-device" content="pc">
    <meta name="domain_verify"
          content="pmrgi33nmfuw4ir2ejyws5ltnbuweyljnnss4y3pnurcyithovuwiir2ejqwmyrtguzdgobsmezdgnbyheywcmzthbrdmmtemu4tamrqg5rtmirmej2gs3lfknqxmzjchiytkmrzgq4demjugaydcnd5">


    <title><?= $data['title'] ?>- 超搞笑的原创糗事笑话分享社区</title>


    <meta name="keywords" content="幽默笑话,爆笑笑话,搞笑段子,笑话大全 爆笑"/>
    <meta name="description" content="糗事百科官网提供幽默笑话大全,糗百网分享的各种爆笑笑话、搞笑段子,小心笑破你的肚子,精彩搞笑笑话就在糗事百科！"/>

    <meta name="robots" content="noarchive">
    <link href="//static.qiushibaike.com/css/dist/web/app.min.css?v=1a44fd15c6e802cc1ab5953bd398eea8"
          media="screen, projection" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/static/plugins/layui/css/layui.css">
    <script src="/static/plugins/layui/layui.all.js"></script>
    <script src="/static/js/site.js"></script>
</head>
<body>


<div id="header" class="head">
    <div class="content-block">
        <div class="logo" id="hd_logo">
            <a href="/"><h1>糗事百科</h1></a>
        </div>
        <div id="menu" class="menu-bar menu clearfix" style="margin:0 10px">
            <?php
            foreach ($data['cate'] as $cate){?>
               <a id="<?=$data['cid']==$cate['cid']?'highlight':''?>" href="/Home/index?cid=<?php echo $cate['cid']?>" rel="nofollow"><?php echo $cate['title']?></a>
            <?php  } ?>
            <?php
             if(isset($data['user']) && $data['user'] !=''){
                            echo '<a href="javascript:void(0)">'.$data['user']['username'].'</a>';
                            echo '<a href="javascript:void(0)" onclick="tz()">发帖</a>';
                            echo '<a href="javascript:void(0)" onclick="logout()">退出</a>';
                        }else{
                            echo ' <a href="javascript:void(0)" onclick="login()">登陆</a>';
                            echo ' <a href="javascript:void(0)" onclick="register()">注册</a>';
                        }
    ?>
        </div>
        <div class="userbar clearfix hidden">
            <div class="login hidden">
                <a href="/my" class="username" id="uname" rel="nofollow"></a>
            </div>
            <div class="logout">
                <a href="javascript:void(0);" class="fn-signin-required logintop" id='logintop' rel="nofollow"
                   style="font-size:16.5px;">登录</a>
            </div>
        </div>
    </div>
</div>


<div id="content" class="main">
    <div class="content-block clearfix">
        <!-- 暂停更新提示 -->
        <!-- <img src="/static/images/banner.png" alt="" style="width: 100%; margin: 16px 0 0; display: block"> -->

        <div id="content-left" class="col1">


            <?php foreach($data['article']['lists'] as $article){ ?>


            <div class="article block untagged mb15 typs_long" id='qiushi_tag_121689281'>


                <div class="author clearfix">
                    <a href="javascript:void()" target="_blank" rel="nofollow" style="height: 35px"
                       onclick="_hmt.push(['_trackEvent','web-list-author-img','chick'])">

                        <img src="//pic.qiushibaike.com/system/avtnew/1674/16749385/thumb/20190212000558.jpg?imageView2/1/w/90/h/90"
                             alt="王八与蛋">
                    </a>
                    <a href="javascript:void()" target="_blank"
                       onclick="_hmt.push(['_trackEvent','web-list-author-text','chick'])">
                        <h2>
                           <?php
                           $user = Db::item('user',array('uid'=>$article['cid'] ));
                           echo $user['username'];
                           ?>
                        </h2>
                    </a>
                </div>

                <a href="javascript:void(0)" target="_blank" class="contentHerf"
                   onclick="_hmt.push(['_trackEvent','web-list-content','chick'])">
                    <div class="content">
<span>
                           <?=html_entity_decode($article['content'])?>
</span>

                    </div>
                </a>
                <!-- 图片或gif -->


                <div class="stats">
                    <!-- 笑脸、评论数等 -->


                    <!--<span class="stats-vote"><i class="number">421</i> 好笑</span>
                    <span class="stats-comments">
<span class="dash"> · </span>
<a href="/article/121689281" data-share="/article/121689281" id="c-121689281" class="qiushi_comments" target="_blank"
   onclick="_hmt.push(['_trackEvent','web-list-comment','chick'])">
<i class="number">9</i> 评论
</a>
</span>-->
                </div>
                <div id="qiushi_counts_121689281" class="stats-buttons bar clearfix">
                    <ul class="clearfix">
                        <li id="vote-up-121689281" class="up">
                            <a href="javascript:voting(121689281,1)" class="voting" data-article="121689281"
                               id="up-121689281" rel="nofollow"
                               onclick="_hmt.push(['_trackEvent','web-list-funny','chick'])">
                                <i></i>
                                <span class="number hidden">424</span>
                            </a>
                        </li>
                        <li id="vote-dn-121689281" class="down">
                            <a href="javascript:voting(121689281,-1)" class="voting" data-article="121689281"
                               id="dn-121689281" rel="nofollow"
                               onclick="_hmt.push(['_trackEvent','web-list-cry','chick'])">
                                <i></i>
                                <span class="number hidden">-3</span>
                            </a>
                        </li>
                        <li class="comments">
                            <a href="/article/121689281" id="c-121689281" class="qiushi_comments" target="_blank"
                               onclick="_hmt.push(['_trackEvent','web-list-comment01','chick'])">
                                <i></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="single-share">
                    <a class="share-wechat" data-type="wechat" title="分享到微信" rel="nofollow">微信</a>
                    <a class="share-qq" data-type="qq" title="分享到QQ" rel="nofollow">QQ</a>
                    <a class="share-qzone" data-type="qzone" title="分享到QQ空间" rel="nofollow">QQ空间</a>
                    <a class="share-weibo" data-type="weibo" title="分享到微博" rel="nofollow">微博</a>
                </div>
                <div class="single-clear"></div>


                <a href="javascript:void()" class="indexGodCmt"
                   onclick="_hmt.push(['_trackEvent','web_list_comment-popular','chick'])" rel="nofollow"
                   target="_blank">
                    <div class="cmtMain">
                        <span class="cmt-god"></span>


                        <span class="cmt-name">寻找小仙女：</span>
                        <div class="main-text">
                            一句靓仔 就算投个百元大钞也是值得的

                        </div>
                    </div>
                </a>

            </div>

<?php }?>



<!--分页-->
            <div id="page">

            </div>
            <script >
                //执行一个laypage实例
                laypage.render({
                    elem: 'page' //注意，这里的 test1 是 ID，不用加 # 号
                    ,count:<?=$data['article']['total_page']?>//数据总数，从服务端得到
                    ,limit:1
                    ,curr:<?=$data['page']?>
                    ,jump: function(obj, first){
                    //obj包含了当前分页的所有参数，比如：
                    console.log(obj.count); //得到当前页，以便向服务端请求对应页的数据。
                    //首次不执行
                    if(!first){
                        window.location.href="/Home/index?cid=<?=$data['cid']?>&page="+obj.curr;
                    }
                }
                });
            </script>




    <div class="foot-nav clearfix">
        <div class="foot-nav-col">
            <h3>
                关于
            </h3>
            <ul>
                <li>
                    <a href="https://hr.qiushibaike.com/about.html" target="_blank" rel="nofollow">
                        关于糗百
                    </a>
                </li>
                <li>
                    <a href="https://hr.qiushibaike.com/social.html" target="_blank" rel="nofollow">
                        加入我们
                    </a>
                </li>
                <li>
                    <a href="https://hr.qiushibaike.com/about.html?tag=3" target="_blank" rel="nofollow">
                        联系方式
                    </a>
                </li>
            </ul>
        </div>
        <div class="foot-nav-col">
            <h3>
                帮助
            </h3>
            <ul>
                <li>
                    <a href="//about.qiushibaike.com/feedback.html" target="_blank" rel="nofollow">
                        在线反馈
                    </a>
                </li>
                <li>
                    <a href="//about.qiushibaike.com/agreement.html" target="_blank" rel="nofollow">
                        用户协议
                    </a>
                </li>
                <li>
                    <a href="//about.qiushibaike.com/policy.html" target="_blank" rel="nofollow">
                        隐私政策
                    </a>
                </li>
            </ul>
        </div>
        <div class="foot-nav-col">
            <h3>
                下载
            </h3>
            <ul>
                <li>
                    <a href="https://android.myapp.com/myapp/detail.htm?apkName=qsbk.app"
                       target="_blank" rel="external nofollow">
                        Android 客户端
                    </a>
                </li>
                <li>
                    <a href="https://itunes.apple.com/cn/app/id422853458" target="_blank" rel="external nofollow">
                        iPhone 客户端
                    </a>
                </li>
            </ul>
        </div>
        <div class="foot-nav-col">
            <h3>
                关注
            </h3>
            <ul>
                <li>
                    <a href="#" class="foot-wechat">
                        微信
                        <div class="foot-wechat-tips">
                            <span class="foot-wechat-icon"></span>
                            手机扫描二维码关注
                        </div>
                    </a>
                </li>
                <li>
                    <a href="http://weibo.com/qiushibaike" target="_blank" rel="external nofollow">
                        新浪微博
                    </a>
                </li>
                <li>
                    <a href="http://user.qzone.qq.com/1492495058" target="_blank" rel="external nofollow">
                        QQ空间
                    </a>
                </li>
            </ul>
        </div>
        <div class="foot-nav-col">
            <h3>
                组织
            </h3>
            <ul>
                <li>
                    <a href="http://user.qzone.qq.com/1492495058/blog/1408597608" target="_blank"
                       rel="external nofollow">
                        官方粉丝群
                    </a>
                </li>
                <li>
                    <a href="https://www.qiushibaike.com/users/37042475" target="_blank"
                       rel="external nofollow">
                        <img style="vertical-align: middle;height: 16px;margin-top: -2px;"
                             src="//static.qiushibaike.com/images/beian.png?v=d0289dc0a46fc5b15b3363ffa78cf6c7">
                        首都网警
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="foot-copyrights">
        <!-- <p>&copy; Qiushibaike.com 糗事百科版权所有</p>
        <p>
        <span>京ICP备14028348号-1</span>
        <span>京ICP证140448号</span>
        <span>京网文[2017]2369-247号</span>
        <span>
        <a style='color:#333' target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11010502031601" rel="nofollow"><img style='vertical-align: top;' src="/static/images/beian.png?v=d0289dc0a46fc5b15b3363ffa78cf6c7" />京公网安备11010502031601号</a>
        </span>
        </p>
        <p style="margin-top:8px">友际无限（北京）科技有限公司</p>
        <p style="margin-top:8px">
        <span>互联网违法和不良信息举报电话：010-84872896</span>
        <span>邮箱：kefu@qiushibaike.com</span>
        </p> -->
        <p>互联网ICP备案：京ICP备14028348号-1</p>
        <p>
            <span>广播电视节目制作经营许可证：（京）字第08319号</span>
            <span>网络文化经营许可证：
<a style='color:#333' target="_blank" href="http://sq.ccm.gov.cn:80/ccnt/sczr/service/business/emark/toDetail/"
   rel="nofollow">
<img src="//static.qiushibaike.com/images/wenhuajingying.png?v=f5f3976cf4be787ad2be202a19d40823"
     style='width: 20px; height: 20px; vertical-align: top;'>京网文[2017]2369-247号</a>
</span>
        </p>
        <p style="margin-top: 8px">电信与信息服务业务经营许可证：京ICP证140448号</p>
        <p style="margin-top: 8px"><span>营业性演出许可证：京演(机构)(2018)1940号</span></p>
        <p>
            <span>计算机信息网络国际联网单位备案：<a style='color:#333' target="_blank"
                                     href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=11010502031601"
                                     rel="nofollow"><img style='vertical-align: top;'
                                                         src="//static.qiushibaike.com/images/beian.png?v=d0289dc0a46fc5b15b3363ffa78cf6c7"/>京公网安备11010502031601号</a></span>
        </p>
        <br>
        <p style="margin-top: 8px">友际无限（北京）科技有限公司</p>
        <p>
            <span>违法和不良信息举报电话：0755-86967540</span>
            <span>邮箱：kefu@qiushibaike.com</span>
        </p>
        <br>
        <p style="margin-top: 8px">&copy; Qiushibaike.com 糗事百科版权所有</p>
    </div>
</div>


<div class="signin-box" id="login-form">
    <div class="sigin-left">
        <div class="signin-account clearfix">
            <h4 class="social-signin-heading">社交帐号登录</h4>
            <a rel="external nofollow" oauth_href
               href="https://open.weixin.qq.com/connect/qrconnect?appid=wx559af2d26b56c655&redirect_uri=http%3A%2F%2Fwww.qiushibaike.com%2Fnew4%2Fsession%3Fsrc%3Dwx&response_type=code&scope=snsapi_login#wechat_redirect"
               class="social-btn social-wechat">
                使用 微信 账号</a>
            <a rel="external nofollow" oauth_href
               href="https://api.weibo.com/oauth2/authorize?client_id=63372306&redirect_uri=http%3A%2F%2Fwww.qiushibaike.com%2Fnew4%2Fsession"
               class="social-btn social-weibo">
                使用 微博 账号</a>
            <a rel="external nofollow" oauth_href
               href="https://graph.qq.com/oauth2.0/authorize?which=Login&display=pc&client_id=100251437&response_type=code&redirect_uri=www.qiushibaike.com/new4/session?src=qq"
               class="social-btn social-qq">
                使用 QQ 账号 </a>
        </div>
        <div class="signin-form clearfix">
            <h4 class="social-signin-heading">糗事百科账号登录</h4>
            <form method="post" action="/new4/session">
                <input type="hidden" name="_xsrf" value="2|23d17dc4|e1acf67d2a5bbf38a4523933b3a9d473|1554898036"/>
                <div class="signin-section clearfix">
                    <input type="text" class="form-input form-input-first" name="login" placeholder="昵称或邮箱">
                    <input type="password" class="form-input" name="password" placeholder="密码">
                    <input type="checkbox" id="remember_me" name="remember_me" checked="" value="checked"
                           style="display:none">
                </div>
                <div class="signin-error" id="signin-error"></div>
                <button type="submit" id="form-submit" class="form-submit">登录</button>
            </form>
        </div>
        <div class="signin-foot clearfix">
            <a rel="nofollow" href="/new4/fetchpass" class="fetch-password">忘记密码?</a>
        </div>
    </div>
</div>

<div class="float-nav">
    <a class="float-nav-backtop" href="#" rel="nofollow">
        <span class="float-nav-backtop-icon"></span>
    </a>
</div>

</body>
</html>
