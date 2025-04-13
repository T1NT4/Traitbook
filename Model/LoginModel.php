<?php

class LoginModel{
    private $pdo;
    function __construct($pdo){
        $this->pdo = $pdo;
    }
    function cadastrarConta($username,$password,$data_de_registro, $nome_arquivo_fotoperfil){
        $sql = "SELECT * FROM contas WHERE username = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(empty($results)){
            $sql = "INSERT INTO contas(username,password, data_de_registro, nome_arquivo_fotoperfil) VALUES (?,?,?,?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$username,$password,$data_de_registro,$nome_arquivo_fotoperfil]);
            return true;
        }else{
            return false;
        }
    }
    public function listarContaPorUsername($username) {
        $sql = "SELECT * FROM contas WHERE username = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    }
    public function listarContaPorID($id_user) {
        $sql = "SELECT * FROM contas WHERE id_user = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    }
    public function confirmarSenha($username,$password){
        $sql = "SELECT * FROM contas WHERE username = ? AND password = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username, $password]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateUser($id_user,$password){
        $sql = "UPDATE contas SET password = ? WHERE id_user = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$password,$id_user]);
    }
    public function logIn($username, $password){
        $sql = "SELECT * FROM contas WHERE username = ? AND password = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username,$password]);
        $stmt = $stmt->fetch(PDO::FETCH_ASSOC);
        return $stmt;
    }
    public function updateFotoPerfil($id_user,$nome_arquivo_fotoperfil){
        $sql = "UPDATE contas SET nome_arquivo_fotoperfil = ? WHERE id_user = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome_arquivo_fotoperfil,$id_user]);
    }
    // public function atualizarPlano($username,$plano){
    //     $sql = "UPDATE Contas SET plano = ? WHERE username = ?";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->execute([$plano,$username]);
    // }

    // public function listarPlanos(){
    //     $sql = "SELECT * FROM planos";
    //     $stmt = $this->pdo->query($sql);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    // public function listarPlanoPorId($id_plano){
    //     $sql = "SELECT * FROM planos WHERE id_plano = ?";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->execute([$id_plano]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    // public function treinosDoPlano($plano_id){
    //     $sql = "SELECT treinos FROM planos WHERE plano_id = ?";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->execute([$plano_id]);
    //     $result = $stmt->fetch();
    //     if(empty($result)){
    //         return null;
    //     }else{
    //         return json_decode($result[$plano_id],true);
    //     }
    // }   
    // public function listarTreinoPorId($id_treino){
    //     $sql = "SELECT * FROM treinos WHERE id_treino = ?";
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->execute([$id_treino]);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
}