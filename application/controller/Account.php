<?php

class Account extends Base
{
    public function __construct()
    {
        session_start();
    }

    public function login()
    {
        $data = ['title' => '登陆'];
        FrameWork::view('login', $data);
    }

    public function logout()
    {
        $_SESSION['user'] = null;
        exit(json(['code' => 0, 'msg' => '退出成功']));
    }

    public function register()
    {
        $data = ['title' => '注册'];
        FrameWork::view('register', $data);
    }

    public function dologin()
    {
        $username = trim(post('username'));
        $password = trim(post('password'));
        if ($username == '') {
            exit(json(['code' => 1, 'msg' => '用户名不能为空']));
        }
        if ($password == '') {
            exit(json(['code' => 1, 'msg' => '密码不能为空']));
        }
        //查询用户
        $user = Db::item('user', ['username' => $username]);
        if (!$user) {
            exit(json(['code' => 1, 'msg' => '用户名错误']));
        }


        if (md5($user['username'] . $password) != $user['password']) {
            exit(json(['code' => 1, 'msg' => '密码错误']));
        }/*else{
            exit(json(['code'=>2,'msg'=>'登陆成功']));
        }*/
        $_SESSION['user'] = $user;
        $data['user'] = $_SESSION['user'];
        exit(json(['code' => 0, 'msg' => '登陆成功']));
    }

    public function doregister()
    {
        $username = trim(post('username'));
        $password = trim(post('password'));
        $notpassword = trim(post('notpassword'));
        if ($username == '') {
            exit(json(['code' => 1, 'msg' => '用户名不能为空']));
        }
        if ($password == '') {
            exit(json(['code' => 1, 'msg' => '密码不能为空']));
        }
        if($password!=$notpassword){
            exit(json(['code'=>1,'msg'=>'两次密码不一致']));
        }
        $user = Db::item('user', ['username' => $username]);
        if ($user) {
            exit(json(['code' => 1, 'msg' => '用户名已注册']));
        }
        $data = ['username' => $username, 'password' => md5($username . $password), 'reg_time' => time()];
        $res = Db::insert('user', $data);
        if ($res) {
            exit(json(['code' => 0, 'msg' => '注册成功']));
        } else {
            exit(json(['code' => 1, 'msg' => '注册失败']));
        }
    }

}