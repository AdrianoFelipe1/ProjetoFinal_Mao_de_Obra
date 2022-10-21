<?php

require_once("../Model/clienteModel.php");
require_once("../Model/loginModel.php");
require_once("../Model/cadastroClienteModel.php");
require_once("../dao/mao_De_Obra_Dao.php");
require_once("../controllers/loginController.php");

$acao = isset($_REQUEST["acao"]) ? $_REQUEST["acao"] : ""  ;

switch ($acao) {

    case "cadastrarCliente":
        clienteController::cadastrarCliente();
        break;
		
	case "editarCadastroCliente":
        clienteController::editarCadastroCliente();
        break;
		
	case "editarCadastroClienteId":
        clienteController:: editarCadastroClienteId($_SESSION["id_clienteEdita"]);
        break;
	
	case "mostrarDadosClienteId":
        clienteController::mostrarDadosClienteId();
        break;
		
	case "relatorioClientesEstado":
        clienteController::relatorioClientesEstado();
        break;
	
 }


class clienteController {

	

    static function cadastrarCliente() {
		
		
        $Nome_cli = isset($_REQUEST["nome"]) ? $_REQUEST["nome"] : "";
        $Data_Nascimento_cli = isset($_REQUEST["data_nascimento"]) ? $_REQUEST["data_nascimento"] : "";
		date_default_timezone_set("America/sao_paulo");
        $Data_Cadastro_cli = date("Y-m-d H:i:s");
		$Endereco_cli = isset($_REQUEST["endereco"]) ? $_REQUEST["endereco"] : "";
		$Cep_cli = isset($_REQUEST["cep"]) ? $_REQUEST["cep"] : "";
		$Bairro_cli = isset($_REQUEST["bairro"]) ? $_REQUEST["bairro"] : "";
		$Cidade_cli = isset($_REQUEST["cidade"]) ? $_REQUEST["cidade"] : "";
		$Estado_cli = isset($_REQUEST["estado"]) ? $_REQUEST["estado"] : "";
		$Telefone_cli = isset($_REQUEST["telefone"]) ? $_REQUEST["telefone"] : "";
		$Email_cli = isset($_REQUEST["email"]) ? $_REQUEST["email"] : "";
		$Login_cli = isset($_REQUEST["login"]) ? $_REQUEST["login"] : "";
		$Senha_cli = isset($_REQUEST["senha"]) ? $_REQUEST["senha"] : ""     ;
		$Nivel_acesso_cli = 3;

        $clienteModel = new clienteModel();
		$loginModel = new loginModel();
		
		
        $clienteModel->setNome_cli($Nome_cli);
		$clienteModel->setData_Nascimento_cli($Data_Nascimento_cli);
		$clienteModel->setData_Cadastro_cli($Data_Cadastro_cli);
		$clienteModel->setEndereco_cli($Endereco_cli);
		$clienteModel->setCep_cli($Cep_cli);
		$clienteModel->setBairro_cli($Bairro_cli);
		$clienteModel->setCidade_cli($Cidade_cli);
		$clienteModel->setEstado_cli($Estado_cli);
		$clienteModel->setTelefone_cli($Telefone_cli);
		$clienteModel->setEmail_cli($Email_cli);
		$loginModel->setLogin($Login_cli);
		$loginModel->setSenha(sha1(trim($Senha_cli)));
		$loginModel->setNivel_acesso($Nivel_acesso_cli);

		
      
		$loginController = new loginController();
	    $clienteController = new clienteController();
		//session_start();
		
		if ($loginController->verificarLogin($loginModel)){
			
			$loginController->retornarLogin($loginModel);
			
			$_SESSION["logCli"] = "Este login já existe cadastrado em nosso sistema, por favor digite outro login";
			
			header("location:../views/clienteCadastro.php");	

			
			}	
		elseif($clienteController->verificarEmailDoCliente($clienteModel)){
			

			$_SESSION["emailDoCliente"] = "Este E-mail já existe cadastrado  em nosso sistema, por favor digite outro e-mail";
			
			header("location:../views/clienteCadastro.php");	
		}	
		else{
	
		
			$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		
			$resultado = $mao_De_Obra_Dao->cadastrarCliente($loginModel, $clienteModel);

			//var_dump($resultado);exit;

			if ($resultado) {
				
				$_SESSION["cadastroCliente"] = "Cadastro realizado com sucesso!";

		
				$resp = "Cadastrado realizado com sucesso!";
				header("location:../views/clienteCadastro.php?resp=$resp");
				header("Location: ../index.php");
			
			} else {
				
				$resp = "Erro ao cadastrar!";
				header("location:../views/clienteCadastro.php?resp=$resp");
				header("Location: ../index.php");
			}
		
		}
    }
	
	
	
	static function editarCadastroCliente() {
		
		session_start();	
		$Nome_usuario = $_SESSION["nomeUsuario"];
		
		
		$Editar_nome_cli = isset($_REQUEST["editar_nome_cli"]) ? $_REQUEST["editar_nome_cli"] : "";
		$Editar_data_cli = isset($_REQUEST["editar_data_cli"]) ? $_REQUEST["editar_data_cli"] : "";
		$Editar_endereco_cli = isset($_REQUEST["editar_endereco_cli"]) ? $_REQUEST["editar_endereco_cli"] : "";
		$Editar_cep_cli = isset($_REQUEST["editar_cep_cli"]) ? $_REQUEST["editar_cep_cli"] : "";
		$Editar_bairro_cli = isset($_REQUEST["editar_bairro_cli"]) ? $_REQUEST["editar_bairro_cli"] : "";
		$Editar_cidade_cli = isset($_REQUEST["editar_cidade_cli"]) ? $_REQUEST["editar_cidade_cli"] : "";
		$Editar_estado_cli = isset($_REQUEST["editar_estado_cli"]) ? $_REQUEST["editar_estado_cli"] : "";
		$Editar_telefone_cli = isset($_REQUEST["editar_telefone_cli"]) ? $_REQUEST["editar_telefone_cli"] : "";
		$Editar_email_cli = isset($_REQUEST["editar_email_cli"]) ? $_REQUEST["editar_email_cli"] : "";
		$Editar_Senha_cli = isset($_REQUEST["editar_senha_cli"]) ? $_REQUEST["editar_senha_cli"] : ""     ;
		$Editar_Senha_cli = trim($Editar_Senha_cli);
		
		$clienteModel = new clienteModel();
		$loginModel = new loginModel();
		
		$clienteModel->setNome_cli($Editar_nome_cli);
		$clienteModel->setData_Nascimento_cli($Editar_data_cli);
		$clienteModel->setEndereco_cli($Editar_endereco_cli);
		$clienteModel->setCep_cli($Editar_cep_cli);
		$clienteModel->setBairro_cli($Editar_bairro_cli);
		$clienteModel->setCidade_cli($Editar_cidade_cli);
		$clienteModel->setEstado_cli($Editar_estado_cli);
		$clienteModel->setTelefone_cli($Editar_telefone_cli);
		$clienteModel->setEmail_cli($Editar_email_cli);
		$loginModel->setLogin($Nome_usuario);
		
		
		if(strlen($Editar_Senha_cli) > 0){
			
			$loginModel->setSenha(sha1($Editar_Senha_cli));
			
		}
		
		$clienteController = new clienteController();
		//session_start();
		
		if ($clienteController->cliVerificaEmailCliente($clienteModel, $loginModel)){
			
			$_SESSION["emailDoClienteEdita"] = "Este E-mail já existe cadastrado  em nosso sistema, por favor digite outro e-mail";
			
			header("location:../views/editarCadastroCliente.php");
		}
		else{
			$mao_De_Obra_Dao = new mao_De_Obra_Dao();
			$resultado = $mao_De_Obra_Dao->editarCadastroCliente($loginModel, $clienteModel);
		
			if ($resultado) {
			 
				$_SESSION["atualizacaoCliente"] = "Atualização realizada com sucesso!";

			 
				$resp = "Cadastro atualizado com sucesso!";
				header("location:../views/editarCadastroCliente.php?resp=$resp");
				header("Location: ../views/editarCadastroCliente.php");
			
			} else {
				$resp = "Erro ao cadastrar!";
				header("location:../views/editarCadastroCliente.php?resp=$resp");
				header("Location: ../views/editarCadastroCliente.php");
			}
		}
	}
	
	
	static function editarCadastroClienteId($idCli) {
		
		session_start();	
		$Nome_usuario = $_SESSION["nomeUsuario"];
		
		
		$Editar_nome_cli = isset($_REQUEST["editar_nome_cli"]) ? $_REQUEST["editar_nome_cli"] : "";
		$Editar_data_cli = isset($_REQUEST["editar_data_cli"]) ? $_REQUEST["editar_data_cli"] : "";
		$Editar_endereco_cli = isset($_REQUEST["editar_endereco_cli"]) ? $_REQUEST["editar_endereco_cli"] : "";
		$Editar_cep_cli = isset($_REQUEST["editar_cep_cli"]) ? $_REQUEST["editar_cep_cli"] : "";
		$Editar_bairro_cli = isset($_REQUEST["editar_bairro_cli"]) ? $_REQUEST["editar_bairro_cli"] : "";
		$Editar_cidade_cli = isset($_REQUEST["editar_cidade_cli"]) ? $_REQUEST["editar_cidade_cli"] : "";
		$Editar_estado_cli = isset($_REQUEST["editar_estado_cli"]) ? $_REQUEST["editar_estado_cli"] : "";
		$Editar_telefone_cli = isset($_REQUEST["editar_telefone_cli"]) ? $_REQUEST["editar_telefone_cli"] : "";
		$Editar_email_cli = isset($_REQUEST["editar_email_cli"]) ? $_REQUEST["editar_email_cli"] : "";
		$Editar_Senha_cli = isset($_REQUEST["editar_senha_cli"]) ? $_REQUEST["editar_senha_cli"] : ""     ;
		$Editar_Senha_cli = trim($Editar_Senha_cli);
		
		$clienteModel = new clienteModel();
		$loginModel = new loginModel();
		
		$clienteModel->setNome_cli($Editar_nome_cli);
		$clienteModel->setData_Nascimento_cli($Editar_data_cli);
		$clienteModel->setEndereco_cli($Editar_endereco_cli);
		$clienteModel->setCep_cli($Editar_cep_cli);
		$clienteModel->setBairro_cli($Editar_bairro_cli);
		$clienteModel->setCidade_cli($Editar_cidade_cli);
		$clienteModel->setEstado_cli($Editar_estado_cli);
		$clienteModel->setTelefone_cli($Editar_telefone_cli);
		$clienteModel->setEmail_cli($Editar_email_cli);
		$clienteModel->setId_cli($idCli);
		//$loginModel->setLogin($Nome_usuario);
		
		
		if(strlen($Editar_Senha_cli) > 0){
			
			$loginModel->setSenha(sha1($Editar_Senha_cli));
			
		}
		
		$clienteController = new clienteController();
		session_start();
		
		if($clienteController->verificarEmailDoClienteDiferente($clienteModel)){
			
			$_SESSION["EmailCliJaCadastrado"] = "Este E-mail já existe cadastrado em nosso sistema, por favor digite um outro E-mail";
			
			header("location:../views/administradorEditaCadastroCliente.php?id=".$idCli);	
			
		}
		else{
		
			$mao_De_Obra_Dao = new mao_De_Obra_Dao();
			$resultado = $mao_De_Obra_Dao->editarCadastroClienteId($loginModel, $clienteModel);
		
			if ($resultado) {
			
				$_SESSION["atualizacaoClienteId"] = "Atualização realizada com sucesso!";

				$resp = "Cadastro atualizado com sucesso!";
				//header("location:../views/administradorEditaCadastroCliente.php?resp=$resp");
				header("Location: ../views/administradorEditaCadastroCliente.php?id=".$idCli);
				
			} else {
				$resp = "Erro ao cadastrar!";
				header("location:../views/administradorEditaCadastroCliente.php?id=".$idCli);
				//header("Location: ../views/administradorEditaCadastroCliente.php");
			}
		}
	}
	
	
	
	static function mostrarDadosCliente($Nome_usuario) {
		
		//session_start();	
	//	$Nome_usuario = $_SESSION["nomeUsuario"];
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
        $result = $mao_De_Obra_Dao->mostrarDadosCliente($Nome_usuario);
		
		$clienteModel = new clienteModel();
		$loginModel = new loginModel();
		$cadastroClienteModel = new cadastroClienteModel();
		
        if (($result -> rowCount()) == 1){
            foreach($result as $r) {
			  
			  
				$clienteModel->setNome_cli($r[2]);
				$clienteModel->setData_Nascimento_cli($r[3]);
				$clienteModel->setData_Cadastro_cli($r[4]);
				$clienteModel->setEndereco_cli($r[5]);
				$clienteModel->setCep_cli($r[6]);
				$clienteModel->setBairro_cli($r[7]);
				$clienteModel->setCidade_cli($r[8]);
				$clienteModel->setEstado_cli($r[9]);
				$clienteModel->setTelefone_cli($r[10]);
				$clienteModel->setEmail_cli($r[11]);
				
				$loginModel->setLogin($r[13]);
				$loginModel->setSenha($r[14]);
				$loginModel->setNivel_acesso($r[15]);
				
				$cadastroClienteModel->setClienteModel($clienteModel);
				$cadastroClienteModel->setLoginModel($loginModel);

			}
		}
	
		return $cadastroClienteModel;	
	}
	
	
	
	static function mostrarDadosClienteId($id_cliente) {
		
		//session_start();	
	//	$Nome_usuario = $_SESSION["nomeUsuario"];
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
        $result = $mao_De_Obra_Dao->mostrarDadosClienteId($id_cliente);
		
		$clienteModel = new clienteModel();
		$loginModel = new loginModel();
		$cadastroClienteModel = new cadastroClienteModel();
		
        if (($result -> rowCount()) == 1){
            foreach($result as $e) {
			  
			  
				$clienteModel->setNome_cli($e[2]);
				$clienteModel->setData_Nascimento_cli($e[3]);
				$clienteModel->setData_Cadastro_cli($e[4]);
				$clienteModel->setEndereco_cli($e[5]);
				$clienteModel->setCep_cli($e[6]);
				$clienteModel->setBairro_cli($e[7]);
				$clienteModel->setCidade_cli($e[8]);
				$clienteModel->setEstado_cli($e[9]);
				$clienteModel->setTelefone_cli($e[10]);
				$clienteModel->setEmail_cli($e[11]);
				
				$loginModel->setLogin($e[13]);
				$loginModel->setSenha($e[14]);
				$loginModel->setNivel_acesso($e[15]);
				
				$cadastroClienteModel->setClienteModel($clienteModel);
				$cadastroClienteModel->setLoginModel($loginModel);

			}
		}
	
		return $cadastroClienteModel;	
	}
	
	
	
	
	static function exibirDadosClientes(){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
        $result = $mao_De_Obra_Dao->exibirDadosClientes();
		
		
		$listaCadastrosClientes = array();
		$indice = 1;
		
        if (($result -> rowCount()) >= 1){
            foreach($result as $cli) {
			  
				$clienteModel = new clienteModel();
				$cadastroClienteModel = new cadastroClienteModel();
			  
				$clienteModel->setId_cli($cli[0]);
				$clienteModel->setId_login_cli($cli[1]);
				$clienteModel->setNome_cli($cli[2]);
				$clienteModel->setData_Nascimento_cli($cli[3]);
				$clienteModel->setData_Cadastro_cli($cli[4]);
				$clienteModel->setEndereco_cli($cli[5]);
				$clienteModel->setCep_cli($cli[6]);
				$clienteModel->setBairro_cli($cli[7]);
				$clienteModel->setCidade_cli($cli[8]);
				$clienteModel->setEstado_cli($cli[9]);
				$clienteModel->setTelefone_cli($cli[10]);
				$clienteModel->setEmail_cli($cli[11]);
				
	
				$cadastroClienteModel->setClienteModel($clienteModel);
				
				$listaCadastrosClientes[$indice] = $cadastroClienteModel;
				$indice++;
				
			}
		}
		
		return $listaCadastrosClientes;	
	}
	
	
	
	public function excluirCadastroCliente($idLoginCliente){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->excluirCadastroCliente($idLoginCliente);
		
		if ($result){
			
			$_SESSION["excluirCli"] = "Cliente excluído com sucesso!";
			header("location:../views/areaAdministradorClientes.php");
			
			
		}
		else{
			
			header("location:../views/areaAdministradorClientes.php?erroExclui=".$idLoginCliente);
			
		}
	
		
	}
	
	

	
	
	// CLIENTE CADASTRA - Método para verificar se ja tem o e-mail do Cliente ao cadastrar
	public function verificarEmailDoCliente($clienteModel){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->verificarEmailDoCliente($clienteModel);
		
		return $result;
		
	}
	
	//NOVO
	// CLIENTE EDITAR
	public function cliVerificaEmailCliente($clienteModel, $loginModel){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->cliVerificaEmailCliente($clienteModel, $loginModel);
		
		return $result;
		
	}
	
	
	//ESSE METODO DEIXA DE EXISTIR
	//public function retornarEmailDoCliente($clienteModel){
		
	////	$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		//$result = $mao_De_Obra_Dao->verificarEmailDoCliente($clienteModel);
		
	//	$emailDoCliente = '';
		/*
		if (($result->rowCount()) > 0){
			
			foreach($result as $email) {
				
				$emailDoCliente = trim($email[0]);
				
			}
		}
		
			return $emailDoCliente;
	}
	
	*/
	
	//ADMINISTRADOR EMAIL - 
	public function verificarEmailDoClienteDiferente($clienteModel){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->verificarEmailDoClienteDiferente($clienteModel);
		
		return $result;
	}
	
	
	
	static function relatorioTodosClientes(){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
        $result = $mao_De_Obra_Dao->relatorioTodosClientes();
		
		
		$listaRelatorioClientes = array();
		$indice = 1;
		
        if (($result -> rowCount()) >= 1){
            foreach($result as $recli) {
			  
				$clienteModel = new clienteModel();
				$cadastroClienteModel = new cadastroClienteModel();
			  
				$clienteModel->setId_cli($recli[0]);
				$clienteModel->setId_login_cli($recli[1]);
				$clienteModel->setNome_cli($recli[2]);
				$clienteModel->setData_Nascimento_cli($recli[3]);
				$clienteModel->setData_Cadastro_cli($recli[4]);
				$clienteModel->setEndereco_cli($recli[5]);
				$clienteModel->setCep_cli($recli[6]);
				$clienteModel->setBairro_cli($recli[7]);
				$clienteModel->setCidade_cli($recli[8]);
				$clienteModel->setEstado_cli($recli[9]);
				$clienteModel->setTelefone_cli($recli[10]);
				$clienteModel->setEmail_cli($recli[11]);
				
	
				$cadastroClienteModel->setClienteModel($clienteModel);
				
				$listaRelatorioClientes[$indice] = $cadastroClienteModel;
				$indice++;
				
			}
		}
		
		return $listaRelatorioClientes;	
	}
	
	
	static function  relatorioClientesEstado(){
		
		$RelatorioCliente = isset($_REQUEST["selecionar_cliente_estado"]) ? $_REQUEST["selecionar_cliente_estado"] : "";
		
		
		$listaRelatorioCliente = array();
		$indice = 1;
		
		if ($RelatorioCliente == "todos"){
			
			header("location:../views/relatorioDoCliente.php");	
			
		}else{	

			$mao_De_Obra_Dao = new mao_De_Obra_Dao();
			$result = $mao_De_Obra_Dao->relatorioClientesEstado($RelatorioCliente);
		

		
			if (($result-> rowCount()) >= 1){
				foreach($result as $recli) {
			  
					$clienteModel = new clienteModel();
					$cadastroClienteModel = new cadastroClienteModel();
			  
					$clienteModel->setId_cli($recli[0]);
					$clienteModel->setId_login_cli($recli[1]);
					$clienteModel->setNome_cli($recli[2]);
					$clienteModel->setData_Nascimento_cli($recli[3]);
					$clienteModel->setData_Cadastro_cli($recli[4]);
					$clienteModel->setEndereco_cli($recli[5]);
					$clienteModel->setCep_cli($recli[6]);
					$clienteModel->setBairro_cli($recli[7]);
					$clienteModel->setCidade_cli($recli[8]);
					$clienteModel->setEstado_cli($recli[9]);
					$clienteModel->setTelefone_cli($recli[10]);
					$clienteModel->setEmail_cli($recli[11]);
				
	
					$cadastroClienteModel->setClienteModel($clienteModel);
				
					$listaRelatorioCliente[$indice] = $cadastroClienteModel;
					$indice++;
				
				}
				
			}
		
			$_SESSION['listaRelatorioCliente'] = $listaRelatorioCliente;
			
			header("location:../views/relatorioDoCliente.php");

		}	
		
	}
	
}

