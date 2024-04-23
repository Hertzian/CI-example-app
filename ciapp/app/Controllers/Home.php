<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        if (session('magicLogin')) {
            return redirect()
                ->to('set-password')
                ->with('message', 'Please update your password');
        }

        return view('Home/index');
    }

    private function sendTestEmail()
    {

        $email = \Config\Services::email();
        $email->setTo('tallitosan@gmail.com');
        $email->setSubject('Test email');
        $email->setMessage('Hello from <i>CodeIgniter</i>');

        if ($email->send()) {
            echo 'Email sent :D';
        } else {
            $email->send();
            echo 'Email not sent :(';
        }
    }
}
