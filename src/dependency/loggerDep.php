<?php

$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    $timeZone = new DateTimeZone("Asia/Kolkata");
    $logger->setTimeZone($timeZone);
    return $logger;
};
 ?>
