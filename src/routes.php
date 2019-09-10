<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        $getDirList = $container->get('getDirList');
        $dirLists = $getDirList->getDirArray();

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', [
            'args' => $args,
            'pageID' => 'index',
            'lists' => $dirLists,
            'settings' => $container->get('settings')
        ]);
    });

    $app->get('/archive/[{ym}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/archive' route");

        $procDate = $container->get('procDate');
        $ym = $procDate->calcYM($args['ym']);
        $days = $procDate->calcDays($ym);

        $getImgList = $container->get('getImgList');
        $imgLists = $getImgList->getImg($ym, $getImgList);

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', [
            'args' => $args,
            'pageID' => 'archive',
            'ym' => $ym,
            'days' => $days,
            'list' => $imgLists,
            'settings' => $container->get('settings')
        ]);
    });
};
