<?php
namespace App\Controllers;

header("Access-Control-Allow-Origin: *");

use App\Models\TodoModel;

class Todo extends BaseController
{
    public function __construct() {
        $this->todoModel = model(TodoModel::class);
    }

    public function index() {
        try {
            $data = $this->todoModel->fetchTodo();

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Fetch Successfully',
                'result' => $data
            ]);
        }catch(Exception $error) {
            exit($error->getMessage());
        }
    }

    public function addTodoHandler() {
        try {
            $post = $this->request->getVar(['title']);

            if(empty($post['title'])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Field are empty!'
                ]);
            }
    
            $data = [
                'title' => $post['title'],
                'is_completed' => 0,
                'is_important' => 0,
                'created_at' => Date('Y-m-d h:i:sa')
            ];
    
            $this->todoModel->addTodo($data);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Added Succesfully'
            ]);
        }catch(Exception $error) {
            exit($error->getMessage());
        }
    }

    public function deleteTodoHandler() {
        try {
            $todoID = $this->request->getVar('todoID');

            if(empty($todoID)) return $this->response->setJSON([
                'success' => false,
                'message' => 'ID not found'
            ]);
    
            $this->todoModel->deleteTodo($todoID);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Deleted Successfully'
            ]);
        }catch(Exception $error) {
            exit($error->getMessage());
        }
    }

    public function setToImportantHandler() {
        try {
            $todoID = $this->request->getVar('todoID');

            if(empty($todoID)) return $this->response->setJSON([
                'success' => false,
                'message' => 'ID not found'
            ]);
    
            $this->todoModel->setToImportant($todoID);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Changed Important Status Successfully'
            ]);
        }catch(Exception $error) {
            exit($error->getMessage());
        }
    }

    public function setToCompletedHandler() {
        try {
            $todoID = $this->request->getVar('todoID');

            if(empty($todoID)) return $this->response->setJSON([
                'success' => false,
                'message' => 'ID not found'
            ]);
    
            $this->todoModel->setToCompleted($todoID);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Changed Completed Status Successfully'
            ]);
        }catch(Exception $error) {
            exit($error->getMessage());
        }
    }
}
