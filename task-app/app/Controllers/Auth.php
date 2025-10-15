<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function signInView()
    {
        if (session()->get('isLoggedIn')) return redirect()->to('/dashboard');
        return view('auth/sign-in');
    }

    public function signUpView()
    {
        if (session()->get('isLoggedIn')) return redirect()->to('/dashboard');
        return view('auth/sign-up');
    }

    public function forgotPwdView()
    {
        if (session()->get('isLoggedIn')) return redirect()->to('/dashboard');
        return view('auth/forgot-pwd');
    }

    public function resetPwdView($token)
    {
        if (session()->get('isLoggedIn')) return redirect()->to('/dashboard');

        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)->first();
        if (! $user || strtotime($user['reset_expires']) < time()) {
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => lang('ResetPwd.invalidToken')
            ]);
            return redirect()->to('/forgot-password')->with('error', 'Invalid token');
        }

        return view('auth/reset-pwd', ['token' => $token]);
    }

    public function signIn()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!($user && password_verify($password, $user['password']))) {
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => lang("SignIn.invalidCredentials")
            ]);
            return redirect()->to('/sign-in')->with('error', 'Invalid credentials');
        }

        if (!$user['active']) {
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => lang("SignIn.inactive")
            ]);
            return redirect()->to('/sign-in')->with('error', 'Inactive User');
        }

        session()->set([
            'id_user' => $user['id_user'],
            'name' => $user['name'],
            'email' => $user['email'],
            'administrator' => $user['administrator'],
            'isLoggedIn' => true
        ]);
        if ($remember) {
          $token = bin2hex(random_bytes(32));
          setcookie('remember_token', $token, time() + (86400 * 30), "/");

          $userModel->update($user['id_user'], ['token' => $token]);
        }
        session()->setFlashdata('alert', [
          'type' => 'success',
          'message' => lang('System.welcome')
        ]);
        return redirect()->to('/dashboard');

    }

    private function sendActiveUserEmail($user) {
        $email = \Config\Services::email();
        $email->setTo($user['email']);
        $email->setSubject(lang("ActivateEmail.subject"));
        $email->setMessage(view('emails/activation', [
            'name' => $user['name'],
            'activationLink' => base_url('activate/' . $user['token'])
        ]));

        if (! $email->send()) {
            log_message('error', 'Error sending email: ' . $email->printDebugger(['headers']));
            session()->setFlashdata('alert', [
              'type' => 'danger',
              'message' => $email->printDebugger(['headers'])
            ]);
        }
    }

    public function signUp()
    {
        // Validation
        $validation = \Config\Services::validation();
        $rules = [
            'name' => 'required|min_length[3]|max_length[150]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ];

        if (! $this->validate($rules)) {
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => 'Validation error. Please check the form fields.'
            ]);
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Saving user
        try {
            $userModel = new UserModel();
            $data = [
                'name'         => $this->request->getPost('name'),
                'email'        => $this->request->getPost('email'),
                'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'active'       => false,
                'administrator'=> false,
                'token'        => bin2hex(random_bytes(32)),
                'profile_image'=> null
            ];
            $userModel->insert($data);

            // Send activation email
            $this->sendActiveUserEmail($data);
            // Notify success
            session()->setFlashdata('alert', [
                'type' => 'success',
                'message' => lang('SignUp.success')
            ]);
            return redirect()->to('/sign-in');
        } catch (\Throwable $e) {
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

            return redirect()->back()->withInput();
        }
    }

    public function activateAccount($token)
    {
        $userModel = new UserModel();
        $user = $userModel->where('token', $token)->first();

        // Invalid token
        if (! $user) {
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => lang('SignUp.activateError')
            ]);
            return redirect()->to('/sign-in');
        }

        // Activate Account and clear token
        $userModel->update($user['id_user'], [
            'active' => true,
            'token' => null
        ]);

        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => lang("SignUp.activateSuccess")
        ]);

        return redirect()->to('/sign-in');
    }

    public function signOut() {
        session()->destroy();
        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/');
        }
        return redirect()->to('/sign-in?exit=true');
    }

    private function sendResetLinkEmail($user, $resetLink) {
        $email = \Config\Services::email();
        $email->setTo($user['email']);
        $email->setSubject(lang("ResetPwdEmail.subject"));
        $email->setMessage(view('emails/reset-password', [
            'name' => $user['name'],
            'resetLink' => $resetLink
        ]));

        if (! $email->send()) {
            log_message('error', 'Error sending email: ' . $email->printDebugger(['headers']));
            session()->setFlashdata('alert', [
              'type' => 'danger',
              'message' => $email->printDebugger(['headers'])
            ]);
        }
    }

    public function sendResetLink() {
        $userModel = new UserModel();
        $email = $this->request->getPost('email');
        $user = $userModel->where('email', $email)->first();

        if (! $user) {
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => lang("ResetPwdEmail.emailNotFound")
            ]);
            return redirect()->back()->with('error', 'Email not found.');
        }

        $token = bin2hex(random_bytes(32));
        $expires = date('Y-m-d H:i:s', strtotime('+5 minutes'));

        $userModel->update($user['id_user'], [
            'reset_token' => $token,
            'reset_expires' => $expires
        ]);

        // Send Email
        $this->sendResetLinkEmail($user, base_url("reset-password/$token"));

        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => lang("ResetPwdEmail.successSend")
        ]);
        return redirect()->to('/forgot-password')->with('success', 'Email sent');
    }

    public function resetPassword($token)
    {
        $userModel = new UserModel();
        $user = $userModel->where('reset_token', $token)->first();

        if (! $user || strtotime($user['reset_expires']) < time()) {
            session()->setFlashdata('alert', [
                'type' => 'danger',
                'message' => lang('ResetPwd.invalidToken')
            ]);

            return redirect()->to('/forgot-password')->with('error', 'Invalid token');
        }

        $newPassword = $this->request->getPost('password');
        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);

        $userModel->update($user['id_user'], [
            'password' => $hashed,
            'reset_token' => null,
            'reset_expires' => null
        ]);

        session()->setFlashdata('alert', [
            'type' => 'success',
            'message' => lang('ResetPwd.passwordResetSuccess')
        ]);

        return redirect()->to('/sign-in')->with('success', 'Password reset successfully');
    }

}

