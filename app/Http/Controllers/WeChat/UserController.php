<?php

namespace App\Http\Controllers\WeChat;

use App\Http\Controllers\Controller;
use App\Models\WeChat;
use Houdunwang\WeChat\User;
use App\Services\WeChatService;
use Illuminate\Http\Request;
use App\Models\User as ModelsUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;

/**
 * 微信粉丝
 * @package App\Http\Controllers\WeChat
 */
class UserController extends Controller
{

    /**
     * 同步粉丝数据
     * @param Request $request
     * @param WeChat $wechat
     * @param string $openid
     * @param User $userPackage
     * @param WeChatService $weChatService
     * @return JsonResponse
     * @throws BindingResolutionException
     * @throws RequestException
     */
    public function sync(Request $request, WeChat $wechat, User $userPackage, WeChatService $weChatService)
    {
        //获取用户列表。openid为上次获取的最后一个粉丝openid
        $response = $userPackage->config($wechat)->getList(session('next_openid'));
        session(['next_openid' => $response['next_openid']]);

        if (!isset($response['data'])) {
            session()->forget('next_openid');
            return ['state' => true];
        }
        //获取粉丝资料
        $users = $userPackage->getByOpenids($response['data']['openid'])['user_info_list'];
        //同步到数据库
        $weChatService->batchSaveUsers(array_map(function ($v) use ($wechat) {
            $v['wechat_id'] = $wechat['id'];
            $v['site_id'] = $wechat->site->id;
            return $v;
        }, $users));

        return array_filter($response, function ($k) {
            return $k != 'data';
        }, ARRAY_FILTER_USE_KEY) + ['state' => false];
    }

    /**
     * 粉丝搜索
     * @param Request $request
     * @param WeChat $wechat
     * @return mixed
     */
    public function search(Request $request, WeChat $wechat)
    {
        $users = ModelsUser::whereHas('wechatUser', function ($query) use ($wechat) {
            $query->where('site_id', site()['id'])->where('wechat_id', $wechat['id']);
        })
            ->with('wechatUser')
            ->limit(10)
            ->get();

        return $users;
    }
}