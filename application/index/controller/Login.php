<?php

namespace app\index\controller;

use app\index\model\User;
use think\Controller;
use think\Loader;
use think\Request;
use think\Session;

;

class Login extends Controller
{

    public function send_mail(Request $request)
    {
        $mailbox = $request->post('mailbox');
        if (filter_var($mailbox, FILTER_VALIDATE_EMAIL)) {

            //判断是否已经注册过
            $isRegisted = User::where('mailbox',$mailbox)->value('mailbox');
            if ($isRegisted) {
                return ['stat'=>0,'log'=>'该用户已注册'];
            }
            $init = Loader::model('Init', 'logic');
            return $init->sendMail($mailbox);
        }
        return ['stat'=>0,'log' => '邮箱格式错误'];
    }

    public function register(Request $request)
    {
        //echo Session::get('vcode');
        if ($request->post('mailbox') == Session::get('mailbox')
            and $request->post('vcode/d') == Session::get('vcode')) {

            $init = Loader::model('Init', 'logic');
            $stat = $init->register($request->post('password'));
            return $stat;
        } return ['stat' => 0, 'log' => '验证码错误'];


    }

    public function login(Request $request)
    {
        $mailbox = $request->post('mailbox');
        if (filter_var($mailbox, FILTER_VALIDATE_EMAIL)){
            $init = Loader::model('Init', 'logic');
            $log = $init->login($request->post('mailbox'), $request->post('password'));
            return $log;
        }
        return ['stat'=>0,'log' => '邮箱格式错误'];
    }
}
