<?php
 namespace Core;
 use App\App;
use Core\Controller;
use Entity\ClientEntity;
use Core\Validator;
  class ErrorController extends Controller{
     public function loadError(int $error){
        http_response_code(404);
         $this->renderView($error);
     }
 }