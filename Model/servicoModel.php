<?php

class servicoModel {
    
    private $id_serv;
	private $nome_serv;
	
	
            
    function getId_serv() {
        return $this->id_serv;
    }
	
	function getNome_serv() {
        return $this->nome_serv;
    }

	
	


    function setId_serv($id_serv) {
        $this->id_serv = $id_serv;
    }
	
	function setNome_serv($nome_serv) {
        $this->nome_serv = $nome_serv;
    }
}
