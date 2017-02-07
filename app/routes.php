<?php
// Routes

$app->get('/', 'App\Home:index')
    ->setName('homepage');
