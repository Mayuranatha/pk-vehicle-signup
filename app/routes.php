<?php
// Routes

$app->get('/', 'App\Home:index')
    ->setName('homepage');

$app->post('/signup/new', 'App\Home:new_signup')
    ->setName('new signup');

$app->get('/debug', 'App\Home:debug')
    ->setName('Debug JSON');
