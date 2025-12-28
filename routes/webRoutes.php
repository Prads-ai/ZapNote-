<?php
if(isset($router)){
    $router->get('/','HomeController@index');
    $router->get('/notes','NoteController@index');
}
