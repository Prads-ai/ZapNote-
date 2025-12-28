<?php

namespace app\controllers;

use core\App;
use core\database\Database;

class Controller
{
    protected $db;
    public function __construct(){
        $this->db = App::resolve(Database::class);
    }
}