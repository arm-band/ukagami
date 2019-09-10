<?php

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    // 上の.envでDEBUG=1の時にデバッグ機能をオンにする
    if ($container->get('settings')['debug']) {
        // ob_start前のエラーをハンドルする
        $whoops = new Whoops\Run;
        $whoops->pushHandler(new Whoops\Handler\PrettyPageHandler);
        $whoops->register();
        // ob_start以降のエラーをハンドルする
        $container['phpErrorHandler'] = /*$container['errorHandler'] =*/ function($c) {
            return new Dopesong\Slim\Error\Whoops($c->get('settings')['displayErrorDetails']);
        };
        // debugbar setting
        $settings = $container->get('settings')['debugbar'];
        $provider = new Kitchenu\Debugbar\ServiceProvider($settings);
        $provider->register($app);
    }

    // view renderer
    $container['renderer'] = function($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    //Model
    $container['getDirList'] = function($c) {
        $getDirList = new \Slim\App\Model\getDirList($c->get('settings'));
        return $getDirList;
    };
    $container['getImgList'] = function($c) {
        $getImgList = new \Slim\App\Model\getImgList($c->get('settings'));
        return $getImgList;
    };
    //Helper
    $container['escape'] = function() {
        $escape = new \Slim\App\Helper\escape();
        return $escape;
    };
    $container['procDate'] = function() {
        $procDate = new \Slim\App\Helper\procDate();
        return $procDate;
    };

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };
};
