<?php

namespace App\Services\WeChat;

use Illuminate\Support\ServiceProvider;

class WeChatServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('WeChatService', function () {
            return new WeChatService();
        });
    }

    public function boot()
    {
    }
}
