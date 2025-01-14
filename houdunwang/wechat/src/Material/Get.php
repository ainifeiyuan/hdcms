<?php

namespace Houdunwang\WeChat\Material;

use Exception;
use Http;

/**
 * 获取素材
 */
trait Get
{
    /**
     * 获取临时素材
     * @param string $mediaId 素材编号
     * @return mixed
     */
    public function getShortMaterial(string $mediaId)
    {
        $api = $this->api . "/media/get?access_token=" . $this->token() . "&media_id=" . $mediaId;
        $response = Http::get($api)->json();
        return $this->return($response);
    }

    /**
     * 获取永久素材
     * @param string $mediaId 素材编号
     * @return mixed
     */
    public function getLongMaterial(string $mediaId)
    {
        $api = $this->api . "/material/get_material?access_token=" . $this->token();
        $response = Http::post($api, ["media_id" => $mediaId])->json();
        return $this->return($response);
    }

    /**
     * 获取永久素材的统计
     * @return void
     */
    public function getMaterialCount()
    {
        $api = $this->api . "/material/get_materialcount?access_token=" . $this->token();
        $response = Http::get($api)->json();
        return $this->return($response);
    }

    /**
     * 获取永久素材列表
     * @param string $type 素材的类型，图片（image）、视频（video）、语音 （voice）、图文（news）
     * @param int $offset 从全部素材的该偏移位置开始返回，0表示从第一个素材 返回
     * @param int $count 返回素材的数量，取值在1到20之间
     * @return mixed
     */
    public function getMaterialList(string $type, int $offset = 0, int $count = 20)
    {
        $api = $this->api . "/material/batchget_material?access_token=" . $this->token();
        $response = Http::post($api, [
            'type' => $type,
            'offset' => $offset,
            'count' => $count
        ])->json();
        return $this->return($response);
    }
}
