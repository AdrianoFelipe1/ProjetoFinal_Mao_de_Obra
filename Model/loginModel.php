<?php

class loginModel {
    
    private $id_login;
	private $login;
    private $senha;
	private $nivel_acesso;
	
	
            
    function getId_login() {
        return $this->id_login;
    }
	
	function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }
	
	function getNivel_acesso() {
        return $this->nivel_acesso;
    }
	
	


    function setId_login($id_login) {
        $this->id_login = $id_login;
    }
	
	function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }
	
	function setNivel_acesso($nivel_acesso) {
        $this->nivel_acesso = $nivel_acesso;
    }
}
