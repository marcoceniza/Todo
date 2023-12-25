<?php

namespace App\Models;

use CodeIgniter\Model;

class TodoModel extends Model
{
    protected $table = 'Todo';
    protected $allowedFields = ['title', 'is_completed', 'is_important', 'created_at'];

    public function fetchTodo() {
        $query = $this->orderBy('created_at', 'DESC')
                      ->findAll();
        return $query;
    }

    public function addTodo($data) {
        $query = $this->insert($data);
        return $query;
    }

    public function deleteTodo($todoID) {
        $query = $this->delete($todoID);
        return $query;
    }

    public function setToImportant($todoID) {
        $currentValue = $this->where('id', $todoID)
                             ->first();
        $data = [
            'is_important' => $currentValue['is_important'] == 0 ? 1 : 0
        ];
        
        $query = $this->update($todoID, $data);
        return $query;
    }

    public function setToCompleted($todoID) {
        $currentValue = $this->where('id', $todoID)
                             ->first();
        $data = [
            'is_important' => 0,
            'is_completed' => $currentValue['is_completed'] == 0 ? 1 : 0
        ];

        $query = $this->update($todoID, $data);
        return $query;
    }
}