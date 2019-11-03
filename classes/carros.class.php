<?php
class Carros{
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function getCarro($idCarro){
        $sql = $this->pdo->prepare("SELECT * FROM carros WHERE id = ?");
        $sql->execute(array($idCarro));
        if($sql->rowCount() > 0){
            $sql = $sql->fetch();
            return $sql['nome'];
        }else{
            return 'Não carro';
        }
            
    }
    public function listarCarros(){
        $carros = array();
        $sql = $this->pdo->query("SELECT * FROM carros");
        if($sql->rowCount() > 0){
            $carros = $sql->fetchAll();
            return $carros;
        }
    }
}