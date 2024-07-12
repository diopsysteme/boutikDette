<?php

namespace Controller;

use App\App;
use Core\Controller;
use Entity\ClientEntity;
use Core\Validator;
use Core\File;
use Model\DetteModel;
class ClientController extends Controller
{
    private $clientModel;
    public function __construct()
    {
        $this->clientModel = App::getInstance()->getModel("Client");
    }

    public function listAdd(){
        var_dump($_POST);
        if(isset($_POST["ajoutDette"])){
            $clients = $this->clientModel->searchByAttribute('telephone', $_POST["ajoutDette"], ClientEntity::class);

        }elseif(isset($_POST["ajoutProd"])){
            echo "ajout";
        }
        var_dump($clients);
        $this->renderView('ajoutDette', ['clients' => $clients]);

    }
    public function searchClientByPhone($telephone)
    {
        $clients = $this->clientModel->searchByAttribute('telephone', $telephone, ClientEntity::class);
        $this->renderView('ajoutDette/', ['clients' => $clients]);
    }

    public function createClient($data)
    {
        $this->clientModel->save($data);
    }
    public function index()
    {
        $clients = $this->clientModel->all();
        $this->renderView('dashboard', ['clients' => $clients]);
    }
    public function store()
    {
        if (isset($_POST['register'])) {

            $data = [
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'mail' => $_POST['mail'],
                'telephone' => $_POST['telephone'],
                'photo' => $_FILES["filephoto"]["name"],
                "password" => password_hash("Passer123", PASSWORD_DEFAULT),
                "observation" => "Nouveau client",
            ];
            $img = $_FILES["filephoto"]["name"];
            $img_tmp = $_FILES["filephoto"]["tmp_name"];
            // var_dump($img);
            // var_dump($img_tmp);

            $validator = new Validator($data,[
                'nom' =>"required|unique",
            ],[
                
            ]);
            $validator->validateData();
            // var_dump($validator);
            
            if ($validator->passes()) {
                var_dump($validator->passes());
                $file = new File($_FILES["filephoto"], $_FILES["filephoto"]["name"], '/var/www/html/detteComposer/public/asset');
                $uploadMessage = $file->upload();
                // var_dump($uploadMessage);

                
                $this->createClient($data);
                $this->renderView('dashboard');
            } else {
            
                $errors = $validator->errors();
                $this->renderView('dashboard', ['errors' => $errors]);
            }
        } elseif (isset($_POST['searchClient'])) {
            $datad = $this->clientModel->infosClientDebt($_POST['telephone']);

            if (!empty($datad)) {
                $clientInfo = $datad[0];
                var_dump($datad[0]->id);
                $dd=$this->clientModel->belongsTo(DetteModel::class, "idclient",$datad[0]->id);
                var_dump($dd);

              
                $this->renderView('dashboard', ["datad" => $datad]);
            } else {
                $this->renderView('dashboard', ["client" => null]);
            }

        }elseif(isset($_POST["ajoutDette"])) {

        $clients = $this->clientModel->searchByAttribute('telephone', $_POST["ajoutDette"], ClientEntity::class);
        $this->renderView('ajoutDette', ['clients' => $clients]);
        }
    }

    public function listdette($var){
        var_dump($var);
        var_dump("kdjksd");
      
        $clients = $this->clientModel->all();
        
        $this->renderView('dette/dette', ['clients' => $clients]);
    }
    
}
