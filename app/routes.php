<?php
// Routes

$app->get('/', 'App\Home:index')
    ->setName('homepage');

$app->post('/signup/new', 'App\Home:new_signup')
    ->setName('new signup');

$app->post('/signup/update', 'App\Home:update_signup')
    ->setName('update signup');

$app->post('/signup/remove', 'App\Home:remove_signup')
    ->setName('remove reservation');

$app->get('/debug', 'App\Home:debug')
    ->setName('Debug JSON');
