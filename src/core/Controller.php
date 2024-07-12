<?php

namespace Core;

class Controller
{
    protected $session;
    //Session 
    //layout 
    //validator 
    protected ?File $file;
    protected $authorize;
    protected $template="template" ;
    protected ?Validator $controller;

    public function __construct() {
        $this->session = new Session();
    }
    
    public function renderView($view, $data = [],$layout = null)
    {
        if (count($data)) {
            extract($data);
        }

        ob_start();
        var_dump("skd",$_ENV['VIEW'] . "{$view}.html.php");
        
        require_once $_ENV['VIEW'] . "{$view}.html.php";
        $content = ob_get_clean();
        require_once $_ENV['VIEW'] . "{$this->template}.html.php";
    }
    
    //renderJson
    //fromArray
}
