<?php

declare(strict_types=1);

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

use App\Controller\Api\LoginController;
use App\Controller\Api\MenuController;
use App\Controller\Api\UserController;
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');
Router::addServer('http', function () {
    Router::addGroup('/api/', function () {
        //账号和密码登录
        Router::post('login/doLogin', [LoginController::class, 'doLogin']);
        //发送验证码
        Router::post('login/sendCode', [LoginController::class, 'sendCode']);
        //获取验证码
        Router::get('captcha', [\App\Controller\CaptchaController::class, 'index']);
    });
    Router::addGroup('/api/', function () {
        //退出登录
        Router::get('login/logout', [LoginController::class, 'logout']);
        //验证token
        Router::get('login/verify', [LoginController::class, 'verify']);
        //添加默认菜单
        Router::post('menu/addMenu', [MenuController::class, 'addMenu']);
        Router::post('menu/getMenuListInfo', [MenuController::class, 'getMenuListInfo']);
        Router::post('menu/index', [MenuController::class, 'index']);   //获取菜单列表
        Router::post('menu/add', [MenuController::class, 'add']);   //获取菜单列表
        Router::get('menu/del', [MenuController::class, 'del']);   //获取菜单列表
        //获取用户信息 - 根据token获取用户信息
        Router::get('user/getUserInfo', [UserController::class, 'getUserInfo']);
        Router::post('user/index', [UserController::class, 'index']);
        Router::post('user/add', [UserController::class, 'add']);
        Router::post('user/del', [UserController::class, 'del']);
        Router::post('user/getUserListInfo', [UserController::class, 'getUserListInfo']);
        Router::post('user/updateUserInfo', [UserController::class, 'updateUserInfo']);
        //角色相关
        Router::post('role/index', [\App\Controller\Api\RoleController::class, 'index']);
        Router::post('role/add', [\App\Controller\Api\RoleController::class, 'add']);
        Router::post('role/del', [\App\Controller\Api\RoleController::class, 'del']);
        //上传相关
        Router::post('upload/file', [\App\Controller\Api\UploadController::class, 'file']);
        Router::post('upload/index', [\App\Controller\Api\UploadController::class, 'index']);
        Router::post('upload/getUploadFile', [\App\Controller\Api\UploadController::class, 'getUploadFile']);
        Router::post('upload/mergeData', [\App\Controller\Api\UploadController::class, 'mergeData']);
        Router::get('upload/del', [\App\Controller\Api\UploadController::class, 'del']);
        Router::post('upload/image', [\App\Controller\Api\UploadController::class, 'image']);
        //上传分类添加
        Router::post('uploadCate/index', [\App\Controller\Api\UploaderCateController::class, 'index']);
        Router::post('uploadCate/add', [\App\Controller\Api\UploaderCateController::class, 'add']);
        //商品
        Router::post('goods/index', [\App\Controller\Api\GoodsController::class, 'index']);
        Router::post('goods/add', [\App\Controller\Api\GoodsController::class, 'add']);
        Router::post('goods/getInfo', [\App\Controller\Api\GoodsController::class, 'getInfo']);
        Router::get('goods/del', [\App\Controller\Api\GoodsController::class, 'del']);
        //商品分类
        Router::post('goodsCategory/index', [\App\Controller\Api\GoodsCategoryController::class, 'index']);
        Router::post('goodsCategory/add', [\App\Controller\Api\GoodsCategoryController::class, 'add']);
        Router::get('goodsCategory/del', [\App\Controller\Api\GoodsCategoryController::class, 'del']);
        Router::post('goodsCategory/getGoodsCategoryByList', [\App\Controller\Api\GoodsCategoryController::class, 'getGoodsCategoryByList']);
        //商品规格
        Router::post('specs/index', [\App\Controller\Api\SpecsController::class, 'index']);
        Router::post('specs/add', [\App\Controller\Api\SpecsController::class, 'add']);
        Router::get('specs/del', [\App\Controller\Api\SpecsController::class, 'del']);
        Router::get('specs/getSpecsByListInfo', [\App\Controller\Api\SpecsController::class, 'getSpecsByListInfo']);
        //规格
        Router::post('specsValue/add', [\App\Controller\Api\SpecsValueController::class, 'add']);
        Router::post('specsValue/getSpecsValueByListInfo', [\App\Controller\Api\SpecsValueController::class, 'getSpecsValueByListInfo']);
        Router::post('specsValue/getSpecsValueByInfo', [\App\Controller\Api\SpecsValueController::class, 'getSpecsValueByInfo']);
        Router::post('test/index', [\App\Controller\Api\TestController::class, 'index']);
        Router::get('test/tt', [\App\Controller\Api\TestController::class, 'test']);
        Router::get('test/info', [\App\Controller\Api\TestController::class, 'application_info']);
        Router::post('test/ss', [\App\Controller\Api\TestController::class, 'ss']);

    }, ['middleware' => [\App\Middleware\HttpAuthMiddleware::class]]);
    Router::addGroup('/member/', function () {
        Router::post('login/check', [\App\Controller\Member\LoginController::class, 'check']);
    });
});
Router::addServer('ws', function () {
    Router::get('/', 'App\Controller\Websocket\WebSocketController');
    Router::get('/login', 'App\Controller\Websocket\WebSocketController');
    Router::get('/message', 'App\Controller\Websocket\WebSocketController');
    Router::get('/list', 'App\Controller\Websocket\WebSocketController');
});
Router::get('/favicon.ico', function () {
    return '';
});
