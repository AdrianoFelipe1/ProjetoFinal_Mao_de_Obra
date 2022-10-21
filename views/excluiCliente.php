<?php

    require_once("../controllers/clienteController.php");
	require_once("../Model/cadastroClienteModel.php");
	require_once("../Model/clienteModel.php");
	
	
	
	//session_start();
	$validar = $_SESSION["nomeUsuario"];
	
	//$resp = isset($_REQUEST["resp"]) ? $_REQUEST["resp"] : "";
	
	if (empty($validar)){
		
		header("Location:../index.php");
		
	}else{
		
		$id_login_cliente = $_GET['idLogin'];
		
		//header("Location:../index.php?teste=".$id_login_profissional);
		
		$clienteController = new clienteController();
		$listaCadastrosClientes = $clienteController->excluirCadastroCliente($id_login_cliente);
	}


?>