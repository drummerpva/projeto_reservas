<?php

class Reservas {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getReservas($dataInicio, $dataFim) {
        $array = array();
        $sql = $this->pdo->prepare("SELECT * FROM reservas WHERE"
                . "(NOT(data_inicio > :data_fim OR data_fim < :data_inicio))");
        $sql->bindValue(":data_inicio", $dataInicio);
        $sql->bindValue(":data_fim", $dataFim);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function reservar($carro, $dataInicio, $dataFim, $pessoa) {
        $sql = $this->pdo->prepare("INSERT INTO reservas(id_carro,data_inicio,data_fim,pessoa) VALUES(:carro,:data_inicio,:data_fim,:pessoa)");
        $sql->bindValue(":carro", $carro);
        $sql->bindValue(":data_inicio", $dataInicio);
        $sql->bindValue(":data_fim", $dataFim);
        $sql->bindValue(":pessoa", $pessoa);
        $sql->execute();
        if ($this->pdo->lastInsertId() != '') {
            return true;
        } else
            return false;
    }

    public function verificarDisponibilidade($carro, $dataInicio, $dataFim) {
        $sql = $this->pdo->prepare("SELECT * FROM reservas WHERE id_carro = :carro AND"
                . "(NOT(data_inicio > :data_fim OR data_fim < :data_inicio))");
        $sql->bindValue(":carro", $carro);
        $sql->bindValue(":data_inicio", $dataInicio);
        $sql->bindValue(":data_fim", $dataFim);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }

}
