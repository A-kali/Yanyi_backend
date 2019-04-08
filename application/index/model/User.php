<?php

namespace app\index\model;

use think\Model;

class User extends Model
{
    public $id;
    public $mailbox;
    public $password;
    public $nickname;
    public $img_url;

    //用户模型关联数据
    public function profile()
    {
        return $this->hasOne('Profile')->field('mailbox,nickname,tags,img_url,infoif');
    }

    public function getProfile()
    {
        return $this->column('mailbox,nickname,tags,img_url,infoif');
    }
}