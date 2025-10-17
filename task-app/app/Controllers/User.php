<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
  public function usersView(){
    $userModel = new UserModel();
    $users = $userModel->findAll();
    return view('admin/user-list', ['users' => $users]);
  }

  public function newUserView(){
    return view('admin/new-user');
  }

  public function userInfo($id){
    $userModel = new UserModel();
    $user = $userModel->find($id);
    if(!$user){
      return redirect()->to('/users')->with('error', 'User not found');
    }
    return view('admin/user-info', ['user' => $user]);
  }

  public function registerUser()
  {
    $service = new \App\Services\UserService();
    $result = $service->register($this->request->getPost());

    if (! $result['success']) {
      session()->setFlashdata('alert', [
        'type' => 'danger',
        'message' => $result['errors']
      ]);
      return redirect()->back()->withInput()->with('errors', $result['errors']);
    }

    session()->setFlashdata('alert', [
      'type' => 'success',
      'message' => lang('SignUp.success')
    ]);

    return redirect()->back()->withInput();
  }

  public function deleteUser($id)
  {
    $userModel = new \App\Models\UserModel();

    $user = $userModel->find($id);
    if (! $user) {
      session()->setFlashdata('alert', [
          'type' => 'danger',
          'message' => 'User not found.'
      ]);
      return redirect()->to('/users')->with('error', 'User not found');
    }

    try {
      $userModel->delete($id);
      session()->setFlashdata('alert', [
          'type' => 'success',
          'message' => lang('UserInfo.successDelete')
      ]);
    } catch (\Throwable $e) {
      session()->setFlashdata('alert', [
          'type' => 'danger',
          'message' => 'Error: ' . $e->getMessage()
      ]);
    }

    return redirect()->to('/users');
  }

  public function editUserView($id){
    $userModel = new UserModel();
    $user = $userModel->find($id);
    if(!$user){
      return redirect()->to('/users')->with('error', 'User not found');
    }
    return view('admin/edit-user', ['user' => $user]);
  }

  public function updateUser($id){
    $userModel = new UserModel();
    $user = $userModel->find($id);
    if (!$user) {
        return redirect()->back()->with('error', 'User not found');
    }
 
    // Validate form data
    $rules = [
        'name' => 'required|min_length[3]',
        'email' => 'required|valid_email',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Getting data from the form
    $data = [
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'active' => $this->request->getPost('active') ? 1 : 0,
        'administrator' => $this->request->getPost('administrator') ? 1 : 0,
    ];

    // Update password only if provided
    $password = $this->request->getPost('password');
    if (!empty($password)) {
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    // Update User
    try {
      $userModel->update($id, $data);
      session()->setFlashdata('alert', [
          'type' => 'success',
          'message' => lang('SignUp.updateSuccess')
      ]);

      return redirect()->back()->withInput()->with('success', 'User updated successfully.');
    }
    catch (\Throwable $e) {
      $message = $e->getMessage();
      if (str_contains($message, 'Duplicate entry')) {
          session()->setFlashdata('alert', [
              'type' => 'danger',
              'message' => lang("SignUp.duplicateEmail")
          ]);
      } else {
          session()->setFlashdata('alert', [
              'type' => 'danger',
              'message' => lang("System.unexpectedError") . $message
          ]);
      }
      return redirect()->back()->withInput()->with('errors', $message);
    }
  }

}
