<?php

class administradorModel {
    
    private $id_adm;
	private $id_login_adm;
    private $nome_adm;
	private $email_adm;
   
            
    function getId_adm() {
        return $this->id_adm;
    }
	
	function getId_login_adm() {
        return $this->id_login_adm;
    }

    function getNome_adm() {
        return $this->nome_adm;
    }
	
	function getEmail_adm() {
        return $this->email_adm;
    }
	
	



    function setId_adm($id_adm) {
        $this->id_adm = $id_adm;
    }
	
	function setId_login_adm($id_login_adm) {
        $this->id_login_adm = $id_login_adm;
    }

    function setNome_adm($nome_adm) {
        $this->nome_adm = $nome_adm;
    }
	
	function setEmail_adm($email_adm) {
        $this->email_adm = $email_adm;
    }
}
