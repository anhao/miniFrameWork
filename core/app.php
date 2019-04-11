<?php
//做一个简单的mvc框架

require_once 'FrameWork.php';
require_once 'Db.php';
/*$controller = $controller_action[0];//获取控制器名称
$action = $controller_action[1];//获取方法名*/


$result = FrameWork::init();
$controller = $result['controller'];
$action = $result['action'];
if(file_exists('core/Base.php')){
    require_once 'core/Base.php';
}

require_once 'application/controller/'.$controller.'.php';
$class = new $controller();
$class->$action();
