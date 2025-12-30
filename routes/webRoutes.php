<?php
if(isset($router)){
    // Home
    $router->get('/','HomeController@index');
    
    // About
    $router->get('/about','AboutController@index');
    
    // Authentication (Guest only - redirects if already logged in)
    $router->get('/login','AuthController@showLogin', ['GuestMiddleware']);
    $router->post('/login','AuthController@login', ['GuestMiddleware']);
    $router->get('/register','AuthController@showRegister', ['GuestMiddleware']);
    $router->post('/register','AuthController@register', ['GuestMiddleware']);
    $router->post('/logout','AuthController@logout');
    
    // Notes (Protected - requires authentication)
    $router->get('/notes','NoteController@index', ['AuthMiddleware']);
    $router->get('/notes/show','NoteController@show', ['AuthMiddleware']);
    $router->get('/notes/create','NoteController@create', ['AuthMiddleware']);
    $router->post('/notes/create','NoteController@store', ['AuthMiddleware']);
    $router->delete('/notes','NoteController@destroy', ['AuthMiddleware']);
}
