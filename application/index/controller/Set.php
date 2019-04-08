<?php

namespace app\index\controller;

use app\index\logic\Init;
use app\index\model\User;
use think\Controller;
use think\Request;
use think\Session;

class Set extends Controller{



    public function set_password(Request $request){
        $password = md5(md5($request->post('password')).Init::$salt);
        $mailbox = Session::get('mailbox');
        User::where('mailbox',$mailbox)->update(['tags'=>$password]);
    }

}
