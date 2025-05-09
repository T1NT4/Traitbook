<?php

class LoginModel{
    private $pdo;
    function __construct($pdo){
        $this->pdo = $pdo;
    }
    function cadastrarConta($username, $fullname, $email, $password, $data_de_registro, $nome_arquivo_fotoperfil, $aniversario, $genero) {
        $sql = "SELECT * FROM contas WHERE username = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM contas WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $results2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($results) AND empty($results2)) {
            // Hash the password before saving it
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO contas(username, nome_inteiro, email, password, data_de_registro, nome_arquivo_fotoperfil, aniversario, genero) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$username, $fullname, $email, $hashedPassword, $data_de_registro, $nome_arquivo_fotoperfil, $aniversario, $genero]);

            return true;
        } else {
            return false;
        }
    }
    public function listarContaTodas() {
        $sql = "SELECT * FROM `contas` WHERE 1 ORDER BY data_de_registro";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarContaPorUsername($username) {
        $sql = "SELECT * FROM contas WHERE username = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    }
    public function listarContaPorEmail($email) {
        $sql = "SELECT * FROM contas WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        if (empty($result)){
            return [];
        }else{
            return $result[0];
        }
    }
    public function listarContaPorID($id_user) {
        $sql = "SELECT * FROM contas WHERE id_user = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_user]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        if (empty($result)){
            return [];
        }else{
            return $result[0];
        }
    }

    public function confirmarSenha($username, $password) {
        $sql = "SELECT * FROM contas WHERE username = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return [];
    }

    public function updateUser($id_user, $password) {
        // Hash the new password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE contas SET password = ? WHERE id_user = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$hashedPassword, $id_user]);
    }
    public function updateUserWithEmail($email, $password) {
        // Hash the new password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE contas SET password = ? WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$hashedPassword, $email]);
    }

    public function logIn($username, $password) {
        $sql = "SELECT * FROM contas WHERE username = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        $sql = "SELECT * FROM contas WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return [];
    }
    public function updateFotoPerfil($id_user,$nome_arquivo_fotoperfil){
        $sql = "UPDATE contas SET nome_arquivo_fotoperfil = ? WHERE id_user = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome_arquivo_fotoperfil,$id_user]);
    }
    public function updateLinkPersonalidade($id_user,$link_personalidade, $personalidade_data){
        $sql = "UPDATE contas SET link_personalidade = ?, personalidade_data = ? WHERE id_user = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$link_personalidade, $personalidade_data,$id_user]);
    }
    public function updateEverything($id_user, $username, $nome_inteiro, $email, $aniversario, $genero, $sobre_mim, $pontos_fracos, $pontos_fortes, $profissao_atual, $minhas_aspiracoes, $meus_principais_objetivos){
        $sql = "UPDATE contas SET
        username = ?,
        nome_inteiro = ?,
        email = ?,
        aniversario = ?,
        genero = ?,
        sobre_mim = ?,
        pontos_fracos = ?,
        pontos_fortes = ?,
        profissao_atual = ?,
        minhas_aspiracoes = ?,
        meus_principais_objetivos = ? 
        WHERE id_user = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $username,
            $nome_inteiro,
            $email,
            $aniversario,
            $genero,
            $sobre_mim,
            $pontos_fracos,
            $pontos_fortes,
            $profissao_atual,
            $minhas_aspiracoes,
            $meus_principais_objetivos,
            $id_user]);
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