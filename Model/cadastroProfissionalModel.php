<?php

require_once("../Model/profissionalModel.php");
require_once("../Model/loginModel.php");
require_once("../Model/servicoModel.php");


class cadastroProfissionalModel {
    
    private $profissionalModel;
	private $loginModel;
	private $servicoModel;
    
	
   
    function getProfissionalModel() {
        return $this->profissionalModel;
    }
	
	function getLoginModel() {
        return $this->loginModel;
    }
	
	function getServicoModel() {
        return $this->servicoModel;
    }

	
	


    function setProfissionalModel($profissionalModel) {
        $this->profissionalModel = $profissionalModel;
    }
	
	function setLoginModel($loginModel) {
        $this->loginModel = $loginModel;
    }

    function setServicoModel($servicoModel) {
        $this->servicoModel = $servicoModel;
    }
}
