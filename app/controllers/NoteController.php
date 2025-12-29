<?php

namespace app\controllers;

use core\forms\InputForm;
use core\Session;
use Exception;
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
    public function store(): void
    {
        $form = new InputForm();
        if($form->validate($_POST)){
            // Validation passed - proceed with saving
            $data = $form->fields();
            $userId = 2;
            $data['user_id'] = $userId;
            try {
                $this->saveIt($form, $userId, $data);
                redirect('/notes');
                exit();
            } catch (Exception $e) {
                // Handle database errors
                Session::flash('errors', ['database' => 'Failed to save note. Please check if user exists and database schema is correct.']);
                redirect('notes/create');
                return;
            }
        }
        // Validation failed - set flash message and redirect
        Session::flash('errors', $form->errors());
        redirect('notes/create');
    }
    public function show(){}
    #[NoReturn]
    public function create(): void
    {
        // Retrieve flash messages and pass to view
        $errors = Session::get('errors', []);
        // Clear flash message after retrieving (flash messages should only be shown once)
        if (Session::has('errors')) {
            unset($_SESSION['_flash']['errors']);
        }
        view('notes/create', ['errors' => $errors]);
    }
    public function findAll()
    {
        return $this->db->query('SELECT * FROM notes')->get();
    }
    public function saveIt($form,$current_user,$data): void
    {
        // Build field names and placeholders
        $fields = array_keys($data);
        $fieldNames = implode(',', array_map(function($field) {
            return "`$field`"; // Escape field names
        }, $fields));
        $placeholders = ':' . implode(', :', $fields);
        
        // Build the SQL query
        $sql = "INSERT INTO notes ($fieldNames) VALUES ($placeholders)";
        
        // PDO accepts the data array directly if keys match placeholders
        $this->db->query($sql, $data);
    }
}