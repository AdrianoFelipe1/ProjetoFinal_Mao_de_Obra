<?php

require_once("../Model/clienteModel.php");
require_once("../Model/loginModel.php");


class cadastroClienteModel {
    
    private $clienteModel;
	private $loginModel;
    
	
	
   
    function getClienteModel() {
        return $this->clienteModel;
    }
	
	function getLoginModel() {
        return $this->loginModel;
    }


	
	


    function setClienteModel($clienteModel) {
        $this->clienteModel = $clienteModel;
    }
	
	function setLoginModel($loginModel) {
        $this->loginModel = $loginModel;
    }

    
}
