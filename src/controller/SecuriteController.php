<?php

namespace Controller;

use App\App;
use Core\Controller;
use Core\Session;

class SecuriteController extends Controller
{
    private $securityModel;

    public function __construct()
    {
        $this->securityModel = App::getInstance()->getModel("Security");
    }

    public function login($username, $password)
    {
        $user = $this->securityModel->authenticate($username, $password);
        if ($user) {
            Session::start();
            Session::set('user', $user);
            
        } else {
         
        }
    }

    public function logout()
    {
        Session::destroy();
       
    }
}
