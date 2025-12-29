<?php
if(isset($router)){
    $router->get('/','HomeController@index');
    $router->get('/notes','NoteController@index');
    $router->get('/notes/create','NoteController@create');
    $router->post('/notes/create','NoteController@store');
}
