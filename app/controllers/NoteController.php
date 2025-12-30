<?php

namespace app\controllers;

use core\forms\InputForm;
use core\Session;
use Exception;
use JetBrains\PhpStorm\NoReturn;

/**
 * Controller for managing notes.
 * 
 * Handles CRUD operations for notes including creation, reading, updating,
 * deletion, and searching. All operations require user authentication.
 * 
 * @package app\controllers
 */
class NoteController extends Controller
{
    /**
     * Initializes the NoteController.
     * 
     * Calls parent constructor to set up database connection and authentication.
     */
    public function __construct(){
        parent::__construct();
    }
    /**
     * Displays the notes index page.
     * 
     * Shows all notes for the current user, with optional search functionality.
     * Protected by AuthMiddleware - requires user authentication.
     * 
     * @return void Never returns (calls view() which exits)
     */
    #[NoReturn]
    public function index(): void
    {
        // Handle search if query parameter exists
        $searchQuery = $_GET['search'] ?? '';
        $notes = !empty($searchQuery) ? $this->search($searchQuery) : $this->findAll();
        
        // Retrieve flash messages and pass to view
        $errors = Session::get('errors', []);
        $success = Session::get('success', '');
        
        view('notes/index', [
            'notes' => $notes, 
            'errors' => $errors,
            'success' => $success,
            'searchQuery' => $searchQuery
        ]);
    }
    /**
     * Stores a new note.
     * 
     * Validates form input and saves the note to the database.
     * Redirects to notes index on success, back to create form on failure.
     * 
     * @return void
     */
    public function store(): void
    {
        $form = new InputForm();
        if($form->validate($_POST)){
            // Validation passed - proceed with saving
            $data = $form->fields();
            $data['user_id'] = $this->currentUser;
            try {
                $this->saveIt($form, $this->currentUser, $data);
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
    /**
     * Displays a single note.
     * 
     * Shows the full details of a specific note by ID.
     * 
     * @return void Never returns (calls view() which exits)
     */
    #[NoReturn]
    public function show(): void
    {
        $noteId = $_GET['id'] ?? null;
        
        if (!$noteId) {
            Session::flash('errors', ['note' => 'Note ID is required']);
            redirect('/notes');
            return;
        }

        $note = $this->db->query("SELECT * FROM notes WHERE id = :id", [':id' => $noteId])->find();
        
        if (!$note) {
            Session::flash('errors', ['note' => 'Note not found']);
            redirect('/notes');
            return;
        }

        view('notes/show', ['note' => $note]);
    }

    /**
     * Deletes a note.
     * 
     * Removes a note from the database after verifying ownership.
     * Uses the parent controller's destroyNote method for authorization.
     * 
     * @return void
     */
    public function destroy(): void
    {
        // Get the note ID from POST data
        $noteId = $_POST['id'] ?? null;
        
        if (!$noteId) {
            Session::flash('errors', ['delete' => 'Note ID is required']);
            redirect('/notes');
            return;
        }
        
        // Use the parent controller's destroyNote method
        $this->destroyNote('notes', $noteId, $this->currentUser);
    }

    /**
     * Displays the note creation form.
     * 
     * Shows the form for creating a new note with any validation errors.
     * Protected by AuthMiddleware - requires user authentication.
     * 
     * @return void Never returns (calls view() which exits)
     */
    #[NoReturn]
    public function create(): void
    {
        // Retrieve flash messages and pass to view
        $errors = Session::get('errors', []);
        view('notes/create', ['errors' => $errors]);
    }

    /**
     * Retrieves all notes for the current user.
     * 
     * Fetches all notes belonging to the logged-in user from the database.
     * 
     * @return array<int, array> Array of note records
     */
    public function findAll()
    {
        if (!$this->currentUser) {
            return [];
        }
        
        return $this->db->query('SELECT * FROM notes WHERE user_id = :user_id ORDER BY id DESC',[
            ':user_id' => $this->currentUser
        ])->get();
    }

    /**
     * Searches notes by title or body content.
     * 
     * Performs a case-insensitive search across note titles and body content.
     * Returns matching notes for the current user.
     * 
     * @param string $query The search query string
     * @return array<int, array> Array of matching note records
     */
    public function search(string $query): array
    {
        if (!$this->currentUser) {
            return [];
        }

        $searchTerm = '%' . $query . '%';
        return $this->db->query(
            'SELECT * FROM notes WHERE user_id = :user_id AND (title LIKE :search OR body LIKE :search) ORDER BY id DESC',
            [
                ':user_id' => $this->currentUser,
                ':search' => $searchTerm
            ]
        )->get();
    }
    /**
     * Saves a note to the database.
     * 
     * Builds and executes an INSERT query with the provided form data.
     * 
     * @param \core\forms\InputForm $form The form instance (unused, kept for compatibility)
     * @param int $current_user The user ID (unused, kept for compatibility)
     * @param array<string, string> $data The note data to insert
     * @return void
     */
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