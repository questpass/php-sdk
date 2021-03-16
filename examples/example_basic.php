<?php

use Questpass\SDK\CurlHttpClient;
use Questpass\SDK\InMemoryStorage;

include './vendor/autoload.php';

$content = new \Questpass\SDK\Content(
    'https://api.questpass.com/v1/publishers/services/',  // API url
    'SERVICE-UUID',
    new InMemoryStorage,
    new CurlHttpClient
);

$js = $content->javascript(
    new \Questpass\SDK\SubscriptionsContextProvider([])
);
