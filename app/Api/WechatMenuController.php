<?php

namespace App\Api;

use App\Http\Controllers\Controller;
use App\Models\WeChat;
use Illuminate\Http\Request;
use App\Models\Site;
use Houdunwang\WeChat\Button;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * 微信菜单
 * @package App\Http\Controllers\WeChat
 */
class WechatMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'site']);
    }

    /**
     * 更新菜单
     *
     * @param Request $request
     * @param WeChat $wechat
     * @return void
     */
    public function update(Request $request, Site $site, WeChat $wechat)
    {
        $wechat->menus = $request->input('menus');
        $wechat->save();
        return $this->message('菜单保存成功');
    }

    /**
     * 推送菜单到微信
     *
     * @param WeChat $wechat
     * @param Button $button
     * @return void
     */
    public function push(Site $site, WeChat $wechat,  Button $button)
    {
        $button->config($wechat)->create(['button' => $wechat->menus]);
        return $this->message('微信菜单推送成功，请取关并再次关注后查看效果');
    }
}