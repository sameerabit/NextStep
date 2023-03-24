<?php

use Fiber\FiberScheduler;

function make_api_request($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    yield $response;
}

$scheduler = new FiberScheduler();
$results = [];

for ($i = 1; $i <= 10; $i++) {
    $url = "https://jsonplaceholder.typicode.com/posts/$i";
    $fiber = new Fiber('make_api_request', $url);
    $fiber->start();
    $scheduler->add($fiber);
}

while ($scheduler->run()) {
    $result = $scheduler->getReturn();
    $results[] = $result;
}

print_r($results);