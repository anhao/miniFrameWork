<?php
class FrameWork{
    //加载控制器，方法
    public static function init(){
        header('Content-Type:text/html;charset=utf8');
        $script_name = $_SERVER['SCRIPT_NAME'];
        $request_uri = $_SERVER['REQUEST_URI'];
        $request = str_replace($script_name,'',$request_uri);//去掉index.php,拿出控制器名称和参数
        $request=ltrim($request,'/');//去掉斜杆
        $request_array = explode('?',$request);//拿出控制器名称和方法，去掉参数
        $controller_action=$request_array[0];
        $controller_action=explode('/',$controller_action);
        //当没有控制器时，使用默认的配置

        if(count($controller_action)>=2){
            $controller=$controller_action[0];
            $action=$controller_action[1];
        }else{
            $config=require 'config/config.php';
            $controller=$config['default_controller'];
            $action=$config['default_action'];
        }
        return array('controller'=>$controller,'action'=>$action);
    }

    //加载视图
    public static function view($view,$data=''){
        $config=require 'config/config.php';
        require 'application/view/'.$view.$config['default_view_model'];

    }
}
//助手函数
function dump($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

//json 数组转换成json 格式化输出
function json($data){
    header('Content-Type:application/json;charset=utf8');
    echo json_encode($data,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
}

//$_GET
//数据传递给get函数，处理后再返回
function get($params=false){
    //如果没有传参则显示$_GET 或者false
    if(!($params)){
        return $_GET?$_GET:false;
    }
    return isset($_GET[$params])?$_GET[$params]:false;
}


//$_POST

function post($params = false){
    if(!$params){
        return $_POST?$_POST:false;
    }
    return isset($_POST[$params])?$_POST[$params]:false;
}
