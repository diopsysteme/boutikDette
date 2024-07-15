<?php
namespace Controller;

use App\App;
use Core\Controller;
use Entity\ClientEntity;
use Core\Validator;
use Core\File;
use Model\DetteModel;
use Model\ArticleModel;
use Model\DettearticleModel;
use Model\PaiementModel;
class DetteController extends Controller{
    private $detteModel;
    private $clientModel;
    private $paiementModel;
    private $dettearticleModel;
    private $articleModel;
    public function __construct($session,$validator)
    {
        parent::__construct($session,$validator);
        $this->paiementModel = App::getInstance()->getModel("Paiement");
        $this->detteModel = App::getInstance()->getModel("Dette");
        $this->clientModel = App::getInstance()->getModel("Client");
        $this->dettearticleModel = App::getInstance()->getModel("Dettearticle");
        $this->articleModel = App::getInstance()->getModel("Article");
    }
    


    public function listPayments($id){

        // var_dump($id);

        $paiements=$this->detteModel->hasMany(PaiementModel::class,"iddette",$id);
        echo "listing payments";
        // var_dump($paiements);
        
        $this->renderView("paiement/details",["paiement" => $paiements]);
    }
    public function formpayer($id,$data=[]){
        // var_dump($id);
        $clients = $this->session::get("client");
        $entity=$this->clientModel->getEntityClass();
        $entityInstance = \Core\Factory::instantiateClass($entity);
        $entityInstance->unserialize($clients);
        $dette=$this->detteModel->searchByAttribute("id",$id);
        // var_dump($data);
        $this->renderView("dette/paiement",["dette" => $dette[0],"client"=>$entityInstance,"error"=>$data]);
    }
    public function registerDebt() {
        $this->detteModel->transaction(function () {
            $this->createDebt();
        });
        echo "Dette enregistrée avec succès.";
        $this->session::unset("articles");
        $this->redirect("/client");
    }
    
    public function createDebt(){
        $articles = $this->articlesPanier();
        $clients = $this->session::get("client");
        $entity = $this->clientModel->getEntityClass();
        $entityInstance = \Core\Factory::instantiateClass($entity);
        $entityInstance->unserialize($clients);
        // var_dump("<br>shdjshdjsh",$articles);
        // die();
        $totalDebt=0;
        foreach ($articles as $article) {
            $quantitySold = (int) $article->quantitevendu;
            $unitPrice = (float) $article->pu;
            $totalDebt += $quantitySold * $unitPrice;
        }
        $dette=[
            "montant"=>$totalDebt,
            "idclient"=>$entityInstance->id,
            "montantVerse"=>0,
            "iduserquiafaitlavente"=>1
        ];
        $this->detteModel->save($dette);
        $detteid=$this->detteModel->lastInsertId();
        // quantitevendu | prixdevente | idarticle | iddette
        $articleDette=[];
        foreach ($articles as $article){
            $articleDette=[
                "prixdevente"=>$article->pu,
                "quantitevendu"=>$article->quantitevendu,
                "idarticle"=>$article->id,
                "iddette"=>$detteid
            ];
            $this->dettearticleModel->save($articleDette);
            $article=[
                "id"=>$article->id,
                "qt_stock"=>(int)$article->qt_stock-(int)$article->quantitevendu
            ];
            // var_dump($article);
            // die();
            $this->articleModel->save($article);
        }
    }
    public function payer($id){
        
        // var_dump($_POST);
        $amount=(int)$_POST["amount"];
        $ramount=(int)$_POST["ramount"];
        $amountp=(int)$_POST["amountp"];
        if($amount>$ramount || $ramount-$amount==$ramount){
            if($ramount==0)
            $error="la dette est deja soldée";
            elseif($amount>$ramount)
                $error="le montant verse doit etre inferieur à $ramount franc";
            elseif($ramount-$amount==$ramount)
                $error="le montant verse doit etre supperieur à 0";
        
            $this->formpayer($id,$error);
            return;
        }
        $data=["iddette"=>$id,"montantverse"=>$amount];
        $this->paiementModel->save($data);
        $data=["id"=>$id,"montantverse"=>$amount+$amountp];
        $this->detteModel->save($data);
        $this->redirect("/dette/list/$id");

    }
    public function listArticle($id){
        // var_dump($id);
        $articles=$this->detteModel->belongsToMany(ArticleModel::class,"iddette",$id,DettearticleModel::class);
        // var_dump($articles);
        // echo "liste article";
        $this->renderView("dette/details",["articles" => $articles]);
    }
    
}