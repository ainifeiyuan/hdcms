<?php

namespace Modules\Edu\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

/**
 * 前台主页
 * @package Modules\Edu\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * 前台首页
     *
     * @return void
     */
    public function index()
    {
        $site = site()->select('id', 'title')->first();
        $module = module();
        return view('edu::app', compact('site', 'module'));
    }
}