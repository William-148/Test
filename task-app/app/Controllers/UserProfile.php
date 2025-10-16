<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserProfile extends BaseController
{
  public function profileView()
  {
    $userId = session()->get('id_user');
    $userModel = new UserModel();
    $user = $userModel->find($userId);
    return view('dashboard/profile', ['user' => $user]);
  }

  public function editProfileView()
  {
    $userId = session()->get('id_user');
    $userModel = new UserModel();
    $user = $userModel->find($userId);
    return view('dashboard/edit-profile', ['user' => $user]);
  }

  public function updateProfile()
  {
    $userId = session()->get('id_user');
    $userModel = new UserModel();
    $user = $userModel->find($userId);

    $name = $this->request->getPost('name');
    $email = $this->request->getPost('email');

    // Verify current password
    $currentPassword = $this->request->getPost('current_password');
    if (! password_verify($currentPassword, $user['password'])) {
      session()->setFlashdata('alert', [
        'type' => 'danger',
        'message' => lang("EditProfile.passwordMismatch")
      ]);

        return redirect()->back()
            ->withInput()
            ->with('errors', ['current_password' => 'Password is incorrect.']);
    }

    // Update fields
    try {
      $userModel->update($userId, [
        'name' => $name,
        'email' => $email,
      ]);

      session()->set([
        'name' => $name,
        'email' => $email,
      ]);

      session()->setFlashdata('alert', [
        'type' => 'success',
        'message' => lang("EditProfile.success")
      ]);

      return redirect()->to('/profile')->with('success', 'Profile updated successfully.');
    } 
    catch (\Throwable $e) {
      $message = $e->getMessage();
      if (str_contains($message, 'Duplicate entry')) {
          session()->setFlashdata('alert', [
              'type' => 'danger',
              'message' => lang("EditProfile.duplicateEmail")
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
  
  public function changePasswordView()
  {
    return view('dashboard/change-password');
  }

  public function changePassword() {
    // Validating fields
    $rules = [
      'current_password' => 'required',
      'new_password'     => 'required|min_length[6]',
      'confirm_password' => 'required|matches[new_password]'
    ];
    if (! $this->validate($rules)) {
      session()->setFlashdata('alert', [
        'type' => 'danger',
        'message' => lang("ChangePassword.mismatch")
      ]);
      return redirect()->back()
        ->withInput()
        ->with('errors', $this->validator->getErrors());
    }

    // Getting user data
    $userId = session()->get('id_user');
    $userModel = new UserModel();
    $user = $userModel->find($userId);

    // Comparing current password
    $currentPassword = $this->request->getPost('current_password');
    if (! password_verify($currentPassword, $user['password'])) {
      session()->setFlashdata('alert', [
        'type' => 'danger',
        'message' => lang("ChangePassword.currentMismatch")
      ]);

      return redirect()->back()
          ->withInput()
          ->with('errors', ['current_password' => 'Current password mismatch.']);
    }

    // Update password
    $newPassword = password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT);
    $userModel->update($userId, ['password' => $newPassword]);
    
    session()->setFlashdata('alert', [
      'type' => 'success',
      'message' => lang("ChangePassword.success")
    ]);

    return redirect()->to('/profile')->with('success', 'Updated successfully.');
  }

}
