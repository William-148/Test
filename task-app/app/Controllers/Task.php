<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Task extends BaseController
{
  public function tasksView(){
    $taskModel = new TaskModel();
    $idUser = session()->get('id_user');

    $tasks = $taskModel
        ->where('id_user', $idUser)
        ->orderBy('created_at', 'DESC')
        ->findAll();

    return view('task/index', ['tasks' => $tasks]);
  }

  public function taskFormView(){
    return view('task/form');
  }

  public function createTask(){
    $taskModel = new TaskModel();
    $validation = \Config\Services::validation();
    $validation->setRules([
        'description' => [
            'label' => lang('Tasks.descriptionLabel'),
            'rules' => 'required|max_length[300]'
        ]
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $taskModel->insert([
        'description' => $this->request->getPost('description'),
        'id_user'     => session()->get('id_user')
    ]);

    session()->setFlashdata('alert', [
      'type' => 'success',
      'message' => lang('Task.taskCreated')
    ]);

    return redirect()->back()->with('success', lang('Task.taskCreated'));
  }

   public function taskInfo($id){
    $taskModel = new TaskModel();
    $task = $taskModel->find($id);
    if(!$task){
      return redirect()->to('/tasks')->with('error', 'Task not found');
    }
    return view('task/info', ['task' => $task]);
  }

  public function deleteTask($id){
    $taskModel = new TaskModel();
    $task = $taskModel->find($id);
    if(!$task){
      session()->setFlashdata('alert', [
        'type' => 'danger',
        'message' => 'Task not found.'
      ]);
      return redirect()->to('/tasks')->with('error', 'Task not found');
    }
    try {
      $taskModel->delete($id);
      session()->setFlashdata('alert', [
          'type' => 'success',
          'message' => lang('Task.successDelete')
      ]);
      return redirect()->to('/tasks')->with('success', 'Task deleted successfully');
    } catch (\Throwable $e) {
      session()->setFlashdata('alert', [
          'type' => 'danger',
          'message' => 'Error: ' . $e->getMessage()
      ]);
      return redirect()->to('/tasks')->with('error', 'Task deleted wrong');
    }
  }

  public function editTaskView($id){
    $taskModel = new TaskModel();
    $task = $taskModel->find($id);
    if(!$task){
      return redirect()->to('/tasks')->with('error', 'Task not found');
    }
    return view('task/edit', ['task' => $task]);
  }

  public function updateTask($id){
    $taskModel = new TaskModel();
    $task = $taskModel->find($id);
    if(!$task){
      return redirect()->to('/tasks')->with('error', 'Task not found');
    }

    $validation = \Config\Services::validation();
    $validation->setRules([
        'description' => [
            'label' => lang('Tasks.descriptionLabel'),
            'rules' => 'required|max_length[300]'
        ]
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    try {
      $taskModel->update($id, [
        'description' => $this->request->getPost('description')
      ]);

      session()->setFlashdata('alert', [
        'type' => 'success',
        'message' => lang('Task.successUpdate')
      ]);

      return redirect()->to('/tasks/'. $id)->with('success', lang('Task.taskCreated'));
    }
    catch (\Throwable $e) {
      $message = $e->getMessage();
      session()->setFlashdata('alert', [
        'type' => 'danger',
        'message' => lang("System.unexpectedError") . $message
      ]);
      return redirect()->back()->withInput()->with('errors', $message);
    }
  }

}

