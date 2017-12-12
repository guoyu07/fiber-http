<?php
require __DIR__.'/../vendor/autoload.php';

use Fiber\Helper as f;
use Fiber\Util\Channel;

f\once(function () {
    $c = new Channel;

    f\go(function () use($c) {
        $http = \Fiber\Http\Client::create(['base_uri' => 'http://127.0.0.1:8080']);
        $response = $http->request('GET', '/');
        $c->write($response->getBody());
    });

    f\go(function () use($c) {
        $http = \Fiber\Http\Client::create(['base_uri' => 'http://127.0.0.1:8081']);
        $response = $http->request('GET', '/');
        $c->write($response->getBody());
    });

    f\go(function () use($c) {
        $http = \Fiber\Http\Client::create(['base_uri' => 'http://127.0.0.1:8082']);
        $response = $http->request('GET', '/');
        $c->write($response->getBody());
    });

    echo $c->read();
    echo $c->read();
    echo $c->read();
});
