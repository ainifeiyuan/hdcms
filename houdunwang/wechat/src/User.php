<?php

namespace Houdunwang\WeChat;

use Houdunwang\WeChat\User\Auth;
use Houdunwang\WeChat\User\Black;
use Houdunwang\WeChat\User\Get;
use Houdunwang\WeChat\User\Remark;
use Houdunwang\WeChat\WeChat;

/**
 * 粉丝管理
 * @package Houdunwang\WeChat
 */
class User extends WeChat
{
    use Get, Auth, Remark, Black;
}
