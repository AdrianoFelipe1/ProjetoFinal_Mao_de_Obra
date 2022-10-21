<?php

require_once("../Model/administradorModel.php");
require_once("../Model/loginModel.php");


class cadastroAdministradorModel {
    
    private $administradorModel;
	private $loginModel;
    
	
	
   
    function getAdministradorModel() {
        return $this->administradorModel;
    }
	
	function getLoginModel() {
        return $this->loginModel;
    }


	
	


    function setAdministradorModel($administradorModel) {
        $this->administradorModel = $administradorModel;
    }
	
	function setLoginModel($loginModel) {
        $this->loginModel = $loginModel;
    }

    
}
