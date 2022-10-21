<?php

require_once("../Model/administradorModel.php");
require_once("../Model/loginModel.php");
require_once("../Model/cadastroAdministradorModel.php");
require_once("../dao/mao_De_Obra_Dao.php");


$acao = isset($_REQUEST["acao"]) ? $_REQUEST["acao"] : ""  ;

switch ($acao) {

    case "editarCadastroAdministrador":
        administradorController::editarCadastroAdministrador();
        break;
		

 }

class administradorController {

    
	
	static function editarCadastroAdministrador() {
		
		session_start();	
		$Nome_usuario = $_SESSION["nomeUsuario"];
		
		
		$Editar_nome_adm = isset($_REQUEST["editar_nome_adm"]) ? $_REQUEST["editar_nome_adm"] : "";
		$Editar_email_adm = isset($_REQUEST["editar_email_adm"]) ? $_REQUEST["editar_email_adm"] : "";
		$Editar_Senha_adm = isset($_REQUEST["editar_senha_adm"]) ? $_REQUEST["editar_senha_adm"] : ""     ;
		$Editar_Senha_adm = trim($Editar_Senha_adm);
		
		$administradorModel = new administradorModel();
		$loginModel = new loginModel();
		
		$administradorModel->setNome_adm($Editar_nome_adm);
		$administradorModel->setEmail_adm($Editar_email_adm);
		$loginModel->setLogin($Nome_usuario);
		
		if(strlen($Editar_Senha_adm) > 0){
			
			$loginModel->setSenha(sha1($Editar_Senha_adm));
			
		}
		
		$administradorController = new administradorController();
		//session_start();
		
		if ($administradorController->verificarEmailDoAdministrador($administradorModel, $loginModel)){
			
			$_SESSION["emailDoAdministradorEdita"] = "Este E-mail já existe cadastrado  em nosso sistema, por favor digite outro e-mail";
			
			header("location:../views/editarCadastroAdministrador.php");
		}
		else{
		
			$mao_De_Obra_Dao = new mao_De_Obra_Dao();
			$resultado = $mao_De_Obra_Dao->editarCadastroAdministrador($loginModel, $administradorModel);
		
			if ($resultado) {
		
				$_SESSION["atualizacaoAdministrador"] = "Atualização realizada com sucesso!";
			
				$resp = "Cadastro atualizado com sucesso!";
				header("location:../views/editarCadastroAdministrador.php?resp=$resp");
				header("Location: ../views/editarCadastroAdministrador.php");
			
			} else {
				$resp = "Erro ao cadastrar!";
				header("location:../views/editarCadastroAdministrador.php?resp=$resp");
				header("Location: ../views/editarCadastroAdministrador.php");
			}
		}
	}
	
	
	
	static function mostrarDadosAdministrador($Nome_usuario) {
		
		//session_start();	
	//	$Nome_usuario = $_SESSION["nomeUsuario"];
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
        $result = $mao_De_Obra_Dao->mostrarDadosAdministrador($Nome_usuario);
		
		$administradorModel = new administradorModel();
		$loginModel = new loginModel();
		$cadastroAdministradorModel = new cadastroAdministradorModel();
		
        if (($result -> rowCount()) == 1){
            foreach($result as $a) {
			  
			  
				$administradorModel->setNome_adm($a[2]);
				$administradorModel->setEmail_adm($a[3]);
				
				$loginModel->setLogin($a[5]);
				$loginModel->setSenha($a[6]);
				$loginModel->setNivel_acesso($a[7]);
				
				$cadastroAdministradorModel->setAdministradorModel($administradorModel);
				$cadastroAdministradorModel->setLoginModel($loginModel);
				
				
			  
			}
		}
	
		return $cadastroAdministradorModel;	
		
	}
	
	
	//Método para verificar se ja tem o e-mail do administrador ao editar
	public function verificarEmailDoAdministrador($administradorModel, $loginModel){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->verificarEmailDoAdministrador($administradorModel, $loginModel);
		
		return $result;
		
	}
	
	//public function retornarEmailDoAdministrador($administradorModel){
		
		//$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		//$result = $mao_De_Obra_Dao->verificarEmailDoAdministrador($administradorModel);
		
		//$emailDoAdministrador = '';
		
	//	if (($result->rowCount()) > 0){
			
		//	foreach($result as $email) {
				
		//		$emailDoAdministrador = trim($email[0]);
				
		//	}
	//	}
		
		//	return $emailDoAdministrador;
//	}
	
	
	public function verificarEmailDoAdministradorOutros($administradorModel){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->verificarEmailDoAdministradorOutros($administradorModel);
		
		if (($result->rowCount()) > 0){
			
			return true;
			
		}else{
			
			return false;
		}
	}
	
	
	
	
	
}

