<?php
require __DIR__.'/../vendor/autoload.php';

use Fiber\Helper as f;

f\once(function () {
    $http = \Fiber\Http\Client::create(['base_uri' => 'http://myip.ipip.net']);
    $response = $http->request('GET', '/');
    echo $response->getBody();
});
