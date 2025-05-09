<?php
require_once __DIR__.'/../model/LoginModel.php';

class LoginController{
    private $LoginModel;
    function __construct($pdo){
        $this->LoginModel = new LoginModel($pdo);
    }
    function cadastrarConta($username, $fullname, $email, $password, $data_de_registro, $nome_arquivo_fotoperfil, $aniversario, $genero){
        return $this->LoginModel->cadastrarConta($username, $fullname, $email, $password, $data_de_registro, $nome_arquivo_fotoperfil, $aniversario, $genero);
    }
    public function listarContaPorUsername($username) {
        return $this->LoginModel->listarContaPorUsername($username);
    }
    public function listarContaPorEmail($email) {
        return $this->LoginModel->listarContaPorEmail($email);
    }
    public function listarContaPorID($id_user) {
        return $this->LoginModel->listarContaPorID($id_user);
    }
    public function confirmarSenha($username,$password){
        return $this->LoginModel->confirmarSenha($username,$password);
    }
    public function updateUser($id_user,$password){
        return $this->LoginModel->updateUser($id_user,$password);
    }
    public function updateUserWithEmail($email,$password){
        return $this->LoginModel->updateUserWithEmail($email,$password);
    }
    public function logIn($username, $password){
        return $this->LoginModel->logIn($username,$password);
    }
    public function updateFotoPerfil($id_user,$nome_arquivo_fotoperfil){
        return $this->LoginModel->updateFotoPerfil($id_user,$nome_arquivo_fotoperfil);
    }
    public function updateLinkPersonalidade($id_user,$link_personalidade, $personalidade_data){
        return $this->LoginModel->updateLinkPersonalidade($id_user,$link_personalidade, $personalidade_data);
    }
    public function updateEverything($id_user, $username, $nome_inteiro, $email, $aniversario, $genero, $sobre_mim, $pontos_fracos, $pontos_fortes, $profissao_atual, $minhas_aspiracoes, $meus_principais_objetivos){
        return $this->LoginModel->updateEverything($id_user, $username, $nome_inteiro, $email, $aniversario, $genero, $sobre_mim, $pontos_fracos, $pontos_fortes, $profissao_atual, $minhas_aspiracoes, $meus_principais_objetivos);
    }
    // public function atualizarPlanoDoUsuario($username,$plano){
    //     return $this->LoginModel->atualizarPlano($username,$plano);
    // }
    // public function listarPlanos(){
    //     return $this->LoginModel->listarPlanos();
    // }
    // public function listarPlanoPorId($plano_id){
    //     return $this->LoginModel->listarPlanoPorId($plano_id);
    // }
    // public function treinosDoPlano($plano_id){
    //     return $this->LoginModel->treinosDoPlano($plano_id);
    // }
    // public function listarTreinoPorId($id_treino){
    //     return $this->LoginModel->listarTreinoPorId($id_treino);
    // }
    // public function listarTreinosPorIds($id_treino_array){
    //     $array = [];
    //     foreach($id_treino_array as $id_treino){
    //         array_push($array,$this->listarTreinoPorId($id_treino)[0]);
    //     }
    //     return $array;
    // }
}