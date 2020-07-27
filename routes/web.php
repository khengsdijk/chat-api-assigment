<?php

/** @var \Laravel\Lumen\Routing\Router $router */

//routes for the UserController
$router->get('/user', 'UserController@getAllUsers');
$router->get('/user/{id}', 'UserController@getSingleUser');
$router->get('/user/{id}/chats', 'UserController@getChats');
$router->get('/user/{id}/messages', 'UserController@getMessages');
$router->get('/user/{receiver_id}/messages/{sender_id}', 'UserController@getMessageBySender');
$router->post('/user', 'UserController@registerUser');

// routes for the MessageController
$router->post('/message', 'MessageController@sendMessage');
$router->get('/message', 'MessageController@getAllMessages');

