<?php

class Cliente{
    public $id, $nome, $idade, $email, $telefone, $cep, $endereco,$login, $senha;

    public function __construct($id, $nome, $idade, $email, $telefone, $cep, $endereco,$login, $senha){

        $this-> id = $id;
        $this-> nome = $nome;
        $this-> idade = $idade;
        $this-> email = $email;
        $this-> telefone = $telefone;
        $this-> cep = $cep;
        $this-> endereco = $endereco;
        $this-> login = $login;
        $this-> senha = $senha;
    }

    public function getId(){
        return $this-> id;
    }

    public function getNome(){
        return $this-> nome;
    }

    public function getIdade(){
        return $this -> idade;
    }

    public function getEmail(){
        return $this-> email;
    }

    public function getTelefone(){
        return $this-> telefone;
    }

    public function getCep(){
        return $this-> cep;
    }

    public function getEndereco(){
        return $this-> endereco;
    }

    public function getLogin(){
        return $this-> login;
    }

    public function getSenha(){
        return $this-> senha;
    }

    public function setNome($nome){
        $this-> nome = $nome;
    }

    public function setIdade($idade){
        $this-> idade = $idade;
    }

    public function setEmail($email){
        $this-> email = $email;
    }

    public function setTelefone($telefone){
        $this-> telefone = $telefone;
    }

    public function setCep($cep){
        $this-> cep = $cep;
    }

    public function setEndereco($endereco){
        $this-> endereco = $endereco;
    }

    public function setLogin($login){
        $this-> login = $login;
    }

    
    public function setSenha($senha){
        $this-> senha = $senha;
    }  
}

?>