<?php

    require_once("../controllers/profissionalController.php");
	require_once("../Model/cadastroProfissionalModel.php");
	require_once("../Model/profissionalModel.php");
	require_once("../Model/servicoModel.php");
	
	
	//session_start();
	$validar = $_SESSION["nomeUsuario"];
	
	//$resp = isset($_REQUEST["resp"]) ? $_REQUEST["resp"] : "";
	
	if (empty($validar)){
		
		header("Location:../index.php");
		
	}else{
		
		$id_login_profissional = $_GET['idLogin'];
		
		//header("Location:../index.php?teste=".$id_login_profissional);
		
		$profissionalController = new profissionalController();
		$listaCadastrosProfissionais = $profissionalController->excluirCadastroProfissional($id_login_profissional);
	}


?>