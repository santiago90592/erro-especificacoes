<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function email(){

        $email = \Config\Services::email();

        $email->setFrom('your@example.com', 'Your Name');
        $email->setTo('bejec71013@d3ff.com');
       // $email->setCC('another@another-example.com');
       // $email->setBCC('them@their-example.com');

        $email->setSubject('Teu cu');
        $email->setMessage('Vai tomar no cu');

        if($email->send()){

            echo 'Email enviado';
        }else{
           echo $email->printDebugger();
        }
    }
}
