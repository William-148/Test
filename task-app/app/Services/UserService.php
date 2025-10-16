<?php

namespace App\Services;

use App\Models\UserModel;
use Config\Services;

class UserService
{
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

    public function register(array $input): array
    {
        $validation = Services::validation();
        $rules = [
            'name' => 'required|min_length[3]|max_length[150]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]'
        ];

        if (! $validation->setRules($rules)->run($input)) {
            return [
                'success' => false,
                'errors' => $validation->getErrors()
            ];
        }

        try {
            $userModel = new UserModel();
            $data = [
                'name'         => $input['name'],
                'email'        => $input['email'],
                'password'     => password_hash($input['password'], PASSWORD_DEFAULT),
                'active'       => false,
                'administrator'=> false,
                'token'        => bin2hex(random_bytes(32)),
                'profile_image'=> null
            ];
            $userModel->insert($data);

            // Notify success by sending activation email
            $this->sendActiveUserEmail($data);

            return ['success' => true];
        } catch (\Throwable $e) {
            $message = $e->getMessage();
            return [
                'success' => false,
                'errors' => str_contains($message, 'Duplicate entry')
                    ? lang('SignUp.duplicateEmail')
                    : lang('System.unexpectedError') . $message
            ];
        }
    }
}

