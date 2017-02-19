<?php
// Routes

$app->get('/', 'App\Home:index')
    ->setName('homepage');

$app->get('/debug', 'App\Home:debug')
    ->setName('Debug JSON');
