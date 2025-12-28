<?php

namespace app\controllers;

use JetBrains\PhpStorm\NoReturn;

class NoteController extends Controller
{
    public function __construct(){
        parent::__construct();
    }
    #[NoReturn]
    public function index(): void
    {
        $notes = $this->findAll();
        view('notes/index', ['notes' => $notes]);
    }
    public function findAll()
    {
        return $this->db->query('SELECT * FROM notes')->get();
    }
}