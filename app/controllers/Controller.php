<?php

namespace app\controllers;

use core\App;
use core\database\Database;

/**
 * Base controller class that provides database access and authentication.
 * 
 * All controllers extend this class to get database access and user authentication.
 * 
 * @package app\controllers
 */
class Controller
{
    /**
     * Database instance for querying.
     * 
     * @var \core\database\Database
     */
    protected $db;
    
    /**
     * Current logged-in user ID.
     * 
     * Retrieved from session, defaults to null if not logged in.
     * 
     * @var int|null
     */
    protected $currentUser;
    
    /**
     * Initializes the controller.
     * 
     * Resolves the Database instance and sets the current user from session.
     */
    public function __construct(){
        $this->db = App::resolve(Database::class);
        $this->currentUser = \core\Session::get('user_id');
    }
    /**
     * Deletes a record from the specified table.
     * 
     * Verifies the record exists and belongs to the current user before deletion.
     * Uses findOrFail() to ensure the record exists, then checks authorization.
     * 
     * @param string $table The table name to delete from
     * @param int|string $id The ID of the record to delete
     * @param int|null $currentUser The current user ID (for authorization check)
     * @return void Never returns (calls redirect() which exits)
     * @throws \Exception If record not found or authorization fails
     */
    public function destroyNote($table,$id,$currentUser): void
    {
        $note = $this->db->query("SELECT * FROM $table WHERE id = :id", [':id' => $id])->findOrFail();
        authorize($note['user_id'] === $this->currentUser);
        $this->db->query("DELETE FROM $table WHERE id = :id", [':id' => $id]);
        redirect('/notes');
    }
}