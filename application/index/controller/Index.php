<?php
namespace app\index\controller;

use think\Controller;
use think\facade\Request;
use \Firebase\JWT\JWT;

class Index extends Controller
{
    private  $key = "@#$^^^&*&*(&*&GHJHks#$56bHULKJ^^*&**";
    public function index()
    {
        return $this->fetch();
    }

    public function login(){
        return $this->fetch();
    }

    public function signin(){
        $username = Request::post('username');
        $password = Request::post('password');
        $this->assign('username',$username);
        $this->assign('password',$password);

//        需要返回给接口客户端的用户信息，这里只是凑个密码参数，实际使用不需要用密码验证机制
        $token = array(
            "user" => $username,
            "pwd" => $password,
        );

        $jwt = JWT::encode($token, $this->key);
        $this->assign('token',$jwt);
        return $this->fetch();
    }

    public function detoken(){
        return $this->fetch();
    }

    public function token(){
        $tokens = Request::post('token');
        $decoded = JWT::decode($tokens, $this->key, array('HS256'));
//        print_r($decoded);
        $this->assign('token',$decoded);
        return $this->fetch();
    }
}
