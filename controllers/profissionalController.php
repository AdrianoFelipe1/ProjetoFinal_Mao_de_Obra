<?php

require_once("../Model/profissionalModel.php");
require_once("../Model/loginModel.php");
require_once("../Model/servicoModel.php");
require_once("../dao/mao_De_Obra_Dao.php");
require_once("../controllers/loginController.php");

	//session_start();	
	
	
	
$acao = isset($_REQUEST["acao"]) ? $_REQUEST["acao"] : ""  ;

switch ($acao) {

    case "cadastrarProfissional":
        profissionalController::cadastrarProfissional();
        break;
	
	case "editarCadastroProfissional":
		profissionalController::editarCadastroProfissional();
        break;
	
	case "clienteBuscaPorProfissao":
		profissionalController::clienteBuscaPorProfissao();
        break;
	
	case "profissionalBuscaPorProfissao":
		profissionalController:: profissionalBuscaPorProfissao();
        break;
	
	case "editarCadastroProfissionalId":
		
		profissionalController:: editarCadastroProfissionalId($_SESSION["id_profissionalEdita"]);
		//header("Location: ../views/areaCliente.php?id=".$_SESSION["id_profissionalEdita"]);
		//header($_SESSION["id_profissionalEdita"]);
        break;
	
	case "mostrarDadosProfissionalId":
		
		profissionalController:: mostrarDadosProfissionalId();
        break;
		
	case "relatorioProfissionaisPorProfissao":
		
		profissionalController:: relatorioProfissionaisPorProfissao();
        break;
 }


class profissionalController {




    static function cadastrarProfissional() {
	
		
        $Nome_pro = isset($_REQUEST["nomep"]) ? $_REQUEST["nomep"] : "";
		$Cpf_pro = isset($_REQUEST["cpfp"]) ? $_REQUEST["cpfp"] : "";
		$Data_Nascimento_pro = isset($_REQUEST["data_nascimentop"]) ? $_REQUEST["data_nascimentop"] : "";
		date_default_timezone_set("America/sao_paulo");
        $Data_Cadastro_pro = date("Y-m-d H:i:s");
		$Escolaridade_pro = isset($_REQUEST["escolaridadep"]) ? $_REQUEST["escolaridadep"] : "";
		$Endereco_pro = isset($_REQUEST["enderecop"]) ? $_REQUEST["enderecop"] : "";
		$Cep_pro = isset($_REQUEST["cepp"]) ? $_REQUEST["cepp"] : "";
		$Bairro_pro = isset($_REQUEST["bairrop"]) ? $_REQUEST["bairrop"] : "";
		$Cidade_pro = isset($_REQUEST["cidadep"]) ? $_REQUEST["cidadep"] : "";
		$Estado_pro = isset($_REQUEST["estadop"]) ? $_REQUEST["estadop"] : "";
		$Id_serv = isset($_REQUEST["profissaop"]) ? $_REQUEST["profissaop"] : "";
		$Resumo_experiencia_pro = isset($_REQUEST["experienciap"]) ? $_REQUEST["experienciap"] : "";	
		$Telefone_pro = isset($_REQUEST["telefonep"]) ? $_REQUEST["telefonep"] : "";
		$Email_pro = isset($_REQUEST["emailp"]) ? $_REQUEST["emailp"] : "";
		$Login_pro = isset($_REQUEST["loginp"]) ? $_REQUEST["loginp"] : "";
		$Senha_pro = isset($_REQUEST["senhap"]) ? $_REQUEST["senhap"] : ""     ;
		$Nivel_acesso_pro = 2;

        $profissionalModel = new profissionalModel();
		$loginModel = new loginModel();
		$servicoModel = new servicoModel();
		
		
        $profissionalModel->setNome_pro($Nome_pro);
		$profissionalModel->setCpf_pro($Cpf_pro);
		$profissionalModel->setData_Nascimento_pro($Data_Nascimento_pro);
		$profissionalModel->setData_Cadastro_pro($Data_Cadastro_pro);
		$profissionalModel->setEscolaridade_pro($Escolaridade_pro);		
		$profissionalModel->setEndereco_pro($Endereco_pro);
		$profissionalModel->setCep_pro($Cep_pro);
		$profissionalModel->setBairro_pro($Bairro_pro);
		$profissionalModel->setCidade_pro($Cidade_pro);	
		$profissionalModel->setEstado_pro($Estado_pro);
		$servicoModel->setId_serv($Id_serv);
		$profissionalModel->setResumo_experiencia_pro($Resumo_experiencia_pro);
		$profissionalModel->setTelefone_pro($Telefone_pro);
		$profissionalModel->setEmail_pro($Email_pro);
		$loginModel->setLogin($Login_pro);
		$loginModel->setSenha(sha1(trim($Senha_pro)));
		$loginModel->setNivel_acesso($Nivel_acesso_pro);
		
		
		$loginController = new loginController();
		$profissionalController = new profissionalController();
		session_start();
		
		if ($loginController->verificarLogin($loginModel)){
			
			$loginController->retornarLogin($loginModel);
			
			$_SESSION["logPro"] = "Este login já existe cadastrado em nosso sistema, por favor digite outro";
			
			header("location:../views/profissionalCadastro.php");	
		
		
			
		}elseif ($profissionalController->verificarCpf($profissionalModel)){
			
			$profissionalController->retornarCpf($profissionalModel);
			
			$_SESSION["cpfPro"] = "Este CPF já existe cadastrado em nosso sistema, por favor digite um outro CPF";
			
			header("location:../views/profissionalCadastro.php");	
			
		
			
		}elseif ($profissionalController->verificarEmailDoProfissional($profissionalModel)){
			
			
			$_SESSION["emailProfissional"] = "Este E-mail já existe cadastrado em nosso sistema, por favor digite um outro e-mail";
			
			header("location:../views/profissionalCadastro.php");
		}
		
		else{
			

			$mao_De_Obra_Dao = new mao_De_Obra_Dao();
			$resultado = $mao_De_Obra_Dao->cadastrarProfissional($loginModel, $servicoModel, $profissionalModel );

			//var_dump($resultado);exit;

			if ($resultado) {
				
				$_SESSION["cadastroProfissional"] = "Cadastro realizado com sucesso!";

				
				$resp = "Cadastrado realizado com sucesso!";
				header("location:../views/profissionalCadastro.php?resp=$resp");
				header("Location: ../index.php");
			
			} else {
				$resp = "Erro ao cadastrar!";
				header("location:../views/profissionalCadastro.php?resp=$resp");
				header("Location: ../index.php");
			}
		}
    }
	
	
	
	static function editarCadastroProfissional() {
		//session_start();	
		$Nome_usuario = $_SESSION["nomeUsuario"];
		
		$Editar_nome_pro = isset($_REQUEST["editar_nome_pro"]) ? $_REQUEST["editar_nome_pro"] : "";
		$Editar_cpf_pro = isset($_REQUEST["editar_cpf_pro"]) ? $_REQUEST["editar_cpf_pro"] : "";
		$Editar_data_pro = isset($_REQUEST["editar_data_pro"]) ? $_REQUEST["editar_data_pro"] : "";
		$Editar_escolaridade_pro = isset($_REQUEST["editar_escolaridade_pro"]) ? $_REQUEST["editar_escolaridade_pro"] : "";
		$Editar_endereco_pro = isset($_REQUEST["editar_endereco_pro"]) ? $_REQUEST["editar_endereco_pro"] : "";
		$Editar_cep_pro = isset($_REQUEST["editar_cep_pro"]) ? $_REQUEST["editar_cep_pro"] : "";
		$Editar_bairro_pro = isset($_REQUEST["editar_bairro_pro"]) ? $_REQUEST["editar_bairro_pro"] : "";
		$Editar_cidade_pro = isset($_REQUEST["editar_cidade_pro"]) ? $_REQUEST["editar_cidade_pro"] : "";
		$Editar_estado_pro = isset($_REQUEST["editar_estado_pro"]) ? $_REQUEST["editar_estado_pro"] : "";
		$Editar_id_serv = isset($_REQUEST["editar_profissao_pro"]) ? $_REQUEST["editar_profissao_pro"] : "";
		$Editar_resumo_experiencia_pro = isset($_REQUEST["editar_experiencia_pro"]) ? $_REQUEST["editar_experiencia_pro"] : "";	
		$Editar_telefone_pro = isset($_REQUEST["editar_telefone_pro"]) ? $_REQUEST["editar_telefone_pro"] : "";
		$Editar_email_pro = isset($_REQUEST["editar_email_pro"]) ? $_REQUEST["editar_email_pro"] : "";
		$Editar_Senha_pro = isset($_REQUEST["editar_senha_pro"]) ? $_REQUEST["editar_senha_pro"] : ""     ;
		$Editar_Senha_pro = trim($Editar_Senha_pro);
		
		$profissionalModel = new profissionalModel();
		$loginModel = new loginModel();
		$servicoModel = new servicoModel();
		
		$profissionalModel->setNome_pro($Editar_nome_pro);
		$profissionalModel->setCpf_pro($Editar_cpf_pro);
		$profissionalModel->setData_Nascimento_pro($Editar_data_pro);
		$profissionalModel->setEscolaridade_pro($Editar_escolaridade_pro);		
		$profissionalModel->setEndereco_pro($Editar_endereco_pro);
		$profissionalModel->setCep_pro($Editar_cep_pro);
		$profissionalModel->setBairro_pro($Editar_bairro_pro);
		$profissionalModel->setCidade_pro($Editar_cidade_pro);	
		$profissionalModel->setEstado_pro($Editar_estado_pro);	
		$servicoModel->setId_serv($Editar_id_serv);
		$profissionalModel->setResumo_experiencia_pro($Editar_resumo_experiencia_pro);
		$profissionalModel->setTelefone_pro($Editar_telefone_pro);
		$profissionalModel->setEmail_pro($Editar_email_pro);
		$loginModel->setLogin($Nome_usuario);
	
		
		
		if(strlen($Editar_Senha_pro) > 0){
			
			$loginModel->setSenha(sha1($Editar_Senha_pro));
			
		}
		
		
		$profissionalController = new profissionalController();
		//session_start();
		
		if ($profissionalController->profVerificaCpfProfissional($profissionalModel, $loginModel)){
			
			
			$_SESSION["cpfPro"] = "Este CPF já existe cadastrado em nosso sistema, por favor digite um outro CPF";
			
			header("location:../views/editarCadastroProfissional.php");	
			
			
		}	
		elseif($profissionalController->profVerificaEmailProfissional($profissionalModel, $loginModel)) {
			
			$_SESSION["emailDoProfissionalDiferente"] = "Este E-mail já existe cadastrado  em nosso sistema, por favor digite outro e-mail";
			
			header("location:../views/editarCadastroProfissional.php");	
			
			
		} 
		else{
			
			$mao_De_Obra_Dao = new mao_De_Obra_Dao();
			$resultado = $mao_De_Obra_Dao->editarCadastroProfissional($loginModel, $servicoModel, $profissionalModel );
		
			if ($resultado) {
				
				$_SESSION["atualizacaoCPF"] = "Atualização realizada com sucesso!";
				
				
				$resp = "Cadastro atualizado com sucesso!";
				header("location:../views/editarCadastroProfissional.php?resp=$resp");
				header("Location: ../views/editarCadastroProfissional.php");
				//$loginModel->getLogin();
				
			} else {
				
				$resp = "Erro ao cadastrar!";
				header("location:../views/editarCadastroProfissional.php?resp=$resp");
				header("Location: ../views/editarCadastroProfissional.php");
			}
		}
		
	}
	
	
	
	static function editarCadastroProfissionalId($idProf) {
		session_start();	
		$Nome_usuario = $_SESSION["nomeUsuario"];
		
		
		$Editar_nome_pro = isset($_REQUEST["editar_nome_pro"]) ? $_REQUEST["editar_nome_pro"] : "";
		$Editar_cpf_pro = isset($_REQUEST["editar_cpf_pro"]) ? $_REQUEST["editar_cpf_pro"] : "";
		$Editar_data_pro = isset($_REQUEST["editar_data_pro"]) ? $_REQUEST["editar_data_pro"] : "";
		$Editar_escolaridade_pro = isset($_REQUEST["editar_escolaridade_pro"]) ? $_REQUEST["editar_escolaridade_pro"] : "";
		$Editar_endereco_pro = isset($_REQUEST["editar_endereco_pro"]) ? $_REQUEST["editar_endereco_pro"] : "";
		$Editar_cep_pro = isset($_REQUEST["editar_cep_pro"]) ? $_REQUEST["editar_cep_pro"] : "";
		$Editar_bairro_pro = isset($_REQUEST["editar_bairro_pro"]) ? $_REQUEST["editar_bairro_pro"] : "";
		$Editar_cidade_pro = isset($_REQUEST["editar_cidade_pro"]) ? $_REQUEST["editar_cidade_pro"] : "";
		$Editar_estado_pro = isset($_REQUEST["editar_estado_pro"]) ? $_REQUEST["editar_estado_pro"] : "";
		$Editar_id_serv = isset($_REQUEST["editar_profissao_pro"]) ? $_REQUEST["editar_profissao_pro"] : "";
		$Editar_resumo_experiencia_pro = isset($_REQUEST["editar_experiencia_pro"]) ? $_REQUEST["editar_experiencia_pro"] : "";	
		$Editar_telefone_pro = isset($_REQUEST["editar_telefone_pro"]) ? $_REQUEST["editar_telefone_pro"] : "";
		$Editar_email_pro = isset($_REQUEST["editar_email_pro"]) ? $_REQUEST["editar_email_pro"] : "";
		$Editar_Senha_pro = isset($_REQUEST["editar_senha_pro"]) ? $_REQUEST["editar_senha_pro"] : ""     ;
		$Editar_Senha_pro = trim($Editar_Senha_pro);
		
		$profissionalModel = new profissionalModel();
		$loginModel = new loginModel();
		$servicoModel = new servicoModel();
		
		$profissionalModel->setNome_pro($Editar_nome_pro);
		$profissionalModel->setCpf_pro($Editar_cpf_pro);
		$profissionalModel->setData_Nascimento_pro($Editar_data_pro);
		$profissionalModel->setEscolaridade_pro($Editar_escolaridade_pro);		
		$profissionalModel->setEndereco_pro($Editar_endereco_pro);
		$profissionalModel->setCep_pro($Editar_cep_pro);
		$profissionalModel->setBairro_pro($Editar_bairro_pro);
		$profissionalModel->setCidade_pro($Editar_cidade_pro);	
		$profissionalModel->setEstado_pro($Editar_estado_pro);
		$servicoModel->setId_serv($Editar_id_serv);
		$profissionalModel->setResumo_experiencia_pro($Editar_resumo_experiencia_pro);
		$profissionalModel->setTelefone_pro($Editar_telefone_pro);
		$profissionalModel->setEmail_pro($Editar_email_pro);
		$profissionalModel->setId_pro($idProf);
		//$loginModel->setLogin($Nome_usuario);
		
		
		if(strlen($Editar_Senha_pro) > 0){
			
			$loginModel->setSenha(sha1($Editar_Senha_pro));
			
		}
		
		
		$profissionalController = new profissionalController();
		session_start();
		
		if ($profissionalController->verificarCpfDiferente($profissionalModel)){
			
		//...	$profissionalController->retornarCpf($profissionalModel);
			
			$_SESSION["cpfProJaCadastrado"] = "Este CPF já existe cadastrado em nosso sistema, por favor digite um outro CPF";
			//$profissionalController->retornarCpf($profissionalModel);
			
			header("location:../views/administradorEditaCadastroProfissional.php?id=".$idProf);	
			
			
		}elseif($profissionalController->verificarEmailDiferente($profissionalModel)){
			
			
			$_SESSION["EmailProJaCadastrado"] = "Este E-mail já existe cadastrado em nosso sistema, por favor digite um outro E-mail";
			
			header("location:../views/administradorEditaCadastroProfissional.php?id=".$idProf);	

		}
		
		else{
			
			$mao_De_Obra_Dao = new mao_De_Obra_Dao();
			$resultado = $mao_De_Obra_Dao->editarCadastroProfissionalId($loginModel, $servicoModel, $profissionalModel );
		
			if ($resultado) {
				
				$_SESSION["atualizacaoProfissional"] = "Atualização realizado com sucesso!";
				
				
				$resp = "Cadastro atualizado com sucesso!";
				//header("location:../views/areaCliente.php?id=".$idProf);
				header("Location: ../views/administradorEditaCadastroProfissional.php?id=".$idProf);
				//$loginModel->getLogin();
				
			} else {
				
				$resp = "Erro ao cadastrar!";
				header("location:../views/administradorEditaCadastroProfissional.php?id=".$idProf);
				//header("Location: ../views/administradorEditaCadastroProfissional.php");
			}
		}
		
	}
	
	
	
	
	static function mostrarDadosProfissional($Nome_usuario) {
		
		//session_start();	
	//	$Nome_usuario = $_SESSION["nomeUsuario"];
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
        $result = $mao_De_Obra_Dao->mostrarDadosProfissional($Nome_usuario);
		
		$profissionalModel = new profissionalModel();
		$loginModel = new loginModel();
		$servicoModel = new servicoModel();
		
		
		$cadastroProfissionalModel = new cadastroProfissionalModel();
		
        if (($result -> rowCount()) == 1){
            foreach($result as $p) {
			  
			  
				$profissionalModel->setId_serv_pro($p[2]);
				$profissionalModel->setNome_pro($p[3]);
				$profissionalModel->setCpf_pro($p[4]);
				$profissionalModel->setData_Nascimento_pro($p[5]);
				$profissionalModel->setData_Cadastro_pro($p[6]);
				$profissionalModel->setEscolaridade_pro($p[7]);
				$profissionalModel->setEndereco_pro($p[8]);
				$profissionalModel->setCep_pro($p[9]);
				$profissionalModel->setBairro_pro($p[10]);
				$profissionalModel->setCidade_pro($p[11]);
				$profissionalModel->setEstado_pro($p[12]);
				$profissionalModel->setResumo_experiencia_pro($p[13]);
				$profissionalModel->setTelefone_pro($p[14]);
				$profissionalModel->setEmail_pro($p[15]);
				
				$servicoModel->setNome_serv($p[17]);
				
				$loginModel->setLogin($p[19]);
				$loginModel->setSenha($p[20]);
				$loginModel->setNivel_acesso($p[21]);
				
				$cadastroProfissionalModel->setProfissionalModel($profissionalModel);
				$cadastroProfissionalModel->setServicoModel($servicoModel);
				$cadastroProfissionalModel->setLoginModel($loginModel);
				
				
				
			}
		}
	
		return $cadastroProfissionalModel;	
		
	}
	
	
	
	static function mostrarDadosProfissionalId($id_profissional) {
		
		//session_start();	
		//$Nome_usuario = $_SESSION["nomeUsuario"];
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
        $result = $mao_De_Obra_Dao->mostrarDadosProfissionalId($id_profissional);
		
		$profissionalModel = new profissionalModel();
		$loginModel = new loginModel();
		$servicoModel = new servicoModel();
		
		
		$cadastroProfissionalModel = new cadastroProfissionalModel();
		
        if (($result -> rowCount()) == 1){
            foreach($result as $prof) {
			  
			  
				$profissionalModel->setId_serv_pro($prof[2]);
				$profissionalModel->setNome_pro($prof[3]);
				$profissionalModel->setCpf_pro($prof[4]);
				$profissionalModel->setData_Nascimento_pro($prof[5]);
				$profissionalModel->setData_Cadastro_pro($prof[6]);
				$profissionalModel->setEscolaridade_pro($prof[7]);
				$profissionalModel->setEndereco_pro($prof[8]);
				$profissionalModel->setCep_pro($prof[9]);
				$profissionalModel->setBairro_pro($prof[10]);
				$profissionalModel->setCidade_pro($prof[11]);
				$profissionalModel->setEstado_pro($prof[12]);
				$profissionalModel->setResumo_experiencia_pro($prof[13]);
				$profissionalModel->setTelefone_pro($prof[14]);
				$profissionalModel->setEmail_pro($prof[15]);
				
				$servicoModel->setNome_serv($prof[17]);
				
				$loginModel->setLogin($prof[19]);
				$loginModel->setSenha($prof[20]);
				$loginModel->setNivel_acesso($prof[21]);
				
				$cadastroProfissionalModel->setProfissionalModel($profissionalModel);
				$cadastroProfissionalModel->setServicoModel($servicoModel);
				$cadastroProfissionalModel->setLoginModel($loginModel);
				
				
				
			}
		}
	
		return $cadastroProfissionalModel;	
		
	}
	
	
	
	
	static function exibirDadosProfissionais(){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
        $result = $mao_De_Obra_Dao->exibirDadosProfissionais();
		
		
		$listaCadastrosProfissionais = array();
		$indice = 1;
		
		
        if (($result -> rowCount()) >= 1){
            foreach($result as $pr) {
			  
				$profissionalModel = new profissionalModel();
				$servicoModel = new servicoModel();
				$cadastroProfissionalModel = new cadastroProfissionalModel();
			  
				$profissionalModel->setId_pro($pr[0]);
				$profissionalModel->setId_login_pro($pr[1]);
				$profissionalModel->setId_serv_pro($pr[2]);
				$profissionalModel->setNome_pro($pr[3]);
				$profissionalModel->setCpf_pro($pr[4]);
				$profissionalModel->setData_Nascimento_pro($pr[5]);
				$profissionalModel->setData_Cadastro_pro($pr[6]);
				$profissionalModel->setEscolaridade_pro($pr[7]);
				$profissionalModel->setEndereco_pro($pr[8]);
				$profissionalModel->setCep_pro($pr[9]);
				$profissionalModel->setBairro_pro($pr[10]);
				$profissionalModel->setCidade_pro($pr[11]);
				$profissionalModel->setEstado_pro($pr[12]);
				$profissionalModel->setResumo_experiencia_pro($pr[13]);
				$profissionalModel->setTelefone_pro($pr[14]);
				$profissionalModel->setEmail_pro($pr[15]);
				$servicoModel->setid_serv($pr[16]);
				$servicoModel->setNome_serv($pr[17]);
				
	
				$cadastroProfissionalModel->setProfissionalModel($profissionalModel);
				$cadastroProfissionalModel->setServicoModel($servicoModel);
				
				$listaCadastrosProfissionais[$indice] = $cadastroProfissionalModel;
				$indice++;
				
			}
		}
		
		return $listaCadastrosProfissionais;	
	}
	
	
	
	
	static function clienteBuscaPorProfissao(){
		
		$BuscarProfissao = isset($_REQUEST["selecionar_profissao"]) ? $_REQUEST["selecionar_profissao"] : "";
		
		
		$listaCadastrosProfissionais = array();
		$indice = 1;
		
		if ($BuscarProfissao == 0){
			
			header("location:../views/areaCliente.php");	
			
		}else{	

			$mao_De_Obra_Dao = new mao_De_Obra_Dao();
			$result = $mao_De_Obra_Dao->exibirBuscaPorProfissao($BuscarProfissao );
		

		
			if (($result -> rowCount()) >= 1){
				foreach($result as $pr) {
			  
					$profissionalModel = new profissionalModel();
					$servicoModel = new servicoModel();
					$cadastroProfissionalModel = new cadastroProfissionalModel();
			  
					$profissionalModel->setId_pro($pr[0]);
					$profissionalModel->setId_login_pro($pr[1]);
					$profissionalModel->setId_serv_pro($pr[2]);
					$profissionalModel->setNome_pro($pr[3]);
					$profissionalModel->setCpf_pro($pr[4]);
					$profissionalModel->setData_Nascimento_pro($pr[5]);
					$profissionalModel->setData_Cadastro_pro($pr[6]);
					$profissionalModel->setEscolaridade_pro($pr[7]);
					$profissionalModel->setEndereco_pro($pr[8]);
					$profissionalModel->setCep_pro($pr[9]);
					$profissionalModel->setBairro_pro($pr[10]);
					$profissionalModel->setCidade_pro($pr[11]);
					$profissionalModel->setEstado_pro($pr[12]);
					$profissionalModel->setResumo_experiencia_pro($pr[13]);
					$profissionalModel->setTelefone_pro($pr[14]);
					$profissionalModel->setEmail_pro($pr[15]);
					$servicoModel->setid_serv($pr[16]);
					$servicoModel->setNome_serv($pr[17]);
				
	
					$cadastroProfissionalModel->setProfissionalModel($profissionalModel);
					$cadastroProfissionalModel->setServicoModel($servicoModel);
				
					$listaCadastrosProfissionais[$indice] = $cadastroProfissionalModel;
					$indice++;
				
				}
			
				
			}
		
			$_SESSION['listaCadastrosProfissionais'] = $listaCadastrosProfissionais;
			
		    
			header("location:../views/areaCliente.php");

		}	
		
	}
	
	
	
	static function  profissionalBuscaPorProfissao(){
		
		$BuscarProfissao = isset($_REQUEST["selecionar_pro"]) ? $_REQUEST["selecionar_pro"] : "";
		
		
		$listaCadastrosProfissionais = array();
		$indice = 1;
		
		if ($BuscarProfissao == 0){
			
			header("location:../views/areaProfissional.php");	
			
		}else{	

			$mao_De_Obra_Dao = new mao_De_Obra_Dao();
			$result = $mao_De_Obra_Dao->exibirBuscaPorProfissao($BuscarProfissao);
		

		
			if (($result-> rowCount()) >= 1){
				foreach($result as $pro) {
			  
					$profissionalModel = new profissionalModel();
					$servicoModel = new servicoModel();
					$cadastroProfissionalModel = new cadastroProfissionalModel();
			  
					$profissionalModel->setId_pro($pro[0]);
					$profissionalModel->setId_login_pro($pro[1]);
					$profissionalModel->setId_serv_pro($pro[2]);
					$profissionalModel->setNome_pro($pro[3]);
					$profissionalModel->setCpf_pro($pro[4]);
					$profissionalModel->setData_Nascimento_pro($pro[5]);
					$profissionalModel->setData_Cadastro_pro($pro[6]);
					$profissionalModel->setEscolaridade_pro($pro[7]);
					$profissionalModel->setEndereco_pro($pro[8]);
					$profissionalModel->setCep_pro($pro[9]);
					$profissionalModel->setBairro_pro($pro[10]);
					$profissionalModel->setCidade_pro($pro[11]);
					$profissionalModel->setEstado_pro($pro[12]);
					$profissionalModel->setResumo_experiencia_pro($pro[13]);
					$profissionalModel->setTelefone_pro($pro[14]);
					$profissionalModel->setEmail_pro($pro[15]);
					$servicoModel->setid_serv($pro[16]);
					$servicoModel->setNome_serv($pro[17]);
				
	
					$cadastroProfissionalModel->setProfissionalModel($profissionalModel);
					$cadastroProfissionalModel->setServicoModel($servicoModel);
				
					$listaCadastrosProfissionais[$indice] = $cadastroProfissionalModel;
					$indice++;
				
				}
			
				
			}
		
			$_SESSION['listaCadastrosProfissionais'] = $listaCadastrosProfissionais;
			
		    
			header("location:../views/areaProfissional.php");

		}	
		
	}
	
	//PROFISSIONAL CADASTRO - Metodo quando o profissional realiza o seu cadastro
	public function verificarCpf($profissionalModel){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->verificarCpfProfissional($profissionalModel);
		
		if (($result->rowCount()) > 0){
			
			return true;
			
		}else{
			
			return false;
		}
	}
	
	//NOVO
	//PROFISSIONAL EDITAR - Metodo para o profissional atualizar o seu CPF
	public function profVerificaCpfProfissional($profissionalModel, $loginModel){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->profVerificaCpfProfissional($profissionalModel, $loginModel);
		
		if (($result->rowCount()) > 0){
			
			return true;
			
		}else{
			
			return false;
		}
	}
	
	
	// PROFISSIONAL EDITAR - Metodo para o profissional atualizar o seu E-mail
	public function profVerificaEmailProfissional($profissionalModel, $loginModel){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->profVerificaEmailProfissional($profissionalModel, $loginModel);
		
		return $result;
	}
	
	
	
	//ADMINISTRADOR - Método para o Adminiatrador atualizar o e-mail do Profissional
	public function verificarEmailDiferente($profissionalModel){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->verificarEmailDoProfissionalDiferente($profissionalModel);
	
		return $result;
		
	}
	
	
	
	//ADMINISTRADOR - Metodo que valida o CPF do profissional quando o Administrador for editar o seus dados
	public function verificarCpfDiferente($profissionalModel){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->verificarCpfProfissionalDiferente($profissionalModel);
		
		if (($result->rowCount()) > 0){
			
			return true;
			
		}else{
			
			return false;
		}
	}
	
	//PROFISSIONAL CADASTRO - Método quando o profissional cadastra os seus dados
	public function retornarCpf($profissionalModel){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->verificarCpfProfissional($profissionalModel);
		
		$cpfDoProfissional = '';
		
		if (($result->rowCount()) > 0){
			
			foreach($result as $cpf) {
				
				$cpfDoProfissional = trim($cpf[0]);
				
			}
		}
		
		return $cpfDoProfissional;
	}

	
	
	public function excluirCadastroProfissional($idLoginProf){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->excluirCadastroProfissional($idLoginProf);
		
		if ($result){
			
			$_SESSION["excluirProf"] = "Profissional excluído com sucesso!";
			header("location:../views/areaAdministradorProfissionais.php");
			
			
		}
		else{
			
			header("location:../views/areaAdministradorProfissionais.php?erroExclui=".$idLoginProf);
			
		}
			
		
	}
	
	
	//PROFISSIONAL CADASTRO - Método para verificar se ja tem o e-mail do profissional ao cadastrar
	public function verificarEmailDoProfissional($profissionalModel){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->verificarEmailDoProfissional($profissionalModel);
		
		return $result;
		
	}
	
	
	//DEIXA DE EXISTIR
 /*	public function retornarEmailDoProfissional($profissionalModel){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->verificarEmailDoProfissional($profissionalModel);
		
		$emailDoProfissional = '';
		
		if (($result->rowCount()) > 0){
			
			foreach($result as $email) {
				
				$emailDoProfissional = trim($email[0]);
				
			}
		}
		
			return $emailDoProfissional;
	} */
	
	
	//public function verificarEmailDoProfissionalDiferente($profissionalModel){
		
	//	$mao_De_Obra_Dao = new mao_De_Obra_Dao();
	//	$result = $mao_De_Obra_Dao->verificarEmailDoProfissionalDiferente($profissionalModel);
		

		
	//	return $result;
		
		
		
	
	
	
	
	
	static function relatorioTodosProfissionais(){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
        $result = $mao_De_Obra_Dao->relatorioTodosProfissionais();
		
		
		$listaRelatorioProfissionais = array();
		$indice = 1;
		
		
        if (($result -> rowCount()) >= 1){
            foreach($result as $relpro) {
			  
				$profissionalModel = new profissionalModel();
				$servicoModel = new servicoModel();
				$cadastroProfissionalModel = new cadastroProfissionalModel();
			  
				$profissionalModel->setId_pro($relpro[0]);
				$profissionalModel->setId_login_pro($relpro[1]);
				$profissionalModel->setId_serv_pro($relpro[2]);
				$profissionalModel->setNome_pro($relpro[3]);
				$profissionalModel->setCpf_pro($relpro[4]);
				$profissionalModel->setData_Nascimento_pro($relpro[5]);
				$profissionalModel->setData_Cadastro_pro($relpro[6]);
				$profissionalModel->setEscolaridade_pro($relpro[7]);
				$profissionalModel->setEndereco_pro($relpro[8]);
				$profissionalModel->setCep_pro($relpro[9]);
				$profissionalModel->setBairro_pro($relpro[10]);
				$profissionalModel->setCidade_pro($relpro[11]);
				$profissionalModel->setEstado_pro($relpro[12]);
				$profissionalModel->setResumo_experiencia_pro($relpro[13]);
				$profissionalModel->setTelefone_pro($relpro[14]);
				$profissionalModel->setEmail_pro($relpro[15]);
				$servicoModel->setid_serv($relpro[16]);
				$servicoModel->setNome_serv($relpro[17]);
				
	
				$cadastroProfissionalModel->setProfissionalModel($profissionalModel);
				$cadastroProfissionalModel->setServicoModel($servicoModel);
				
				$listaRelatorioProfissionais[$indice] = $cadastroProfissionalModel;
				$indice++;
				
			}
		}
		
		return $listaRelatorioProfissionais;	
	}
	
	
	
	static function relatorioProfissionaisPorProfissao(){
		
		$RelatorioProfissao = isset($_REQUEST["selecionar_profissionais_profissao"]) ? $_REQUEST["selecionar_profissionais_profissao"] : "";
		
		
		$listaRelatorioProfissionais = array();
		$indice = 1;
		
		if ($RelatorioProfissao == 0){
			
			header("location:../views/relatorioDoProfissional.php");	
			
		}else{	

			$mao_De_Obra_Dao = new mao_De_Obra_Dao();
			$result = $mao_De_Obra_Dao->relatorioProfissionaisPorProfissao($RelatorioProfissao );
		

		
			if (($result -> rowCount()) >= 1){
				foreach($result as $relatopro) {
			  
					$profissionalModel = new profissionalModel();
					$servicoModel = new servicoModel();
					$cadastroProfissionalModel = new cadastroProfissionalModel();
			  
					$profissionalModel->setId_pro($relatopro[0]);
					$profissionalModel->setId_login_pro($relatopro[1]);
					$profissionalModel->setId_serv_pro($relatopro[2]);
					$profissionalModel->setNome_pro($relatopro[3]);
					$profissionalModel->setCpf_pro($relatopro[4]);
					$profissionalModel->setData_Nascimento_pro($relatopro[5]);
					$profissionalModel->setData_Cadastro_pro($relatopro[6]);
					$profissionalModel->setEscolaridade_pro($relatopro[7]);
					$profissionalModel->setEndereco_pro($relatopro[8]);
					$profissionalModel->setCep_pro($relatopro[9]);
					$profissionalModel->setBairro_pro($relatopro[10]);
					$profissionalModel->setCidade_pro($relatopro[11]);
					$profissionalModel->setEstado_pro($relatopro[12]);
					$profissionalModel->setResumo_experiencia_pro($relatopro[13]);
					$profissionalModel->setTelefone_pro($relatopro[14]);
					$profissionalModel->setEmail_pro($relatopro[15]);
					$servicoModel->setid_serv($relatopro[16]);
					$servicoModel->setNome_serv($relatopro[17]);
				
	
					$cadastroProfissionalModel->setProfissionalModel($profissionalModel);
					$cadastroProfissionalModel->setServicoModel($servicoModel);
				
					$listaRelatorioProfissionais[$indice] = $cadastroProfissionalModel;
					$indice++;
				
				}
			
				
			}
		
			$_SESSION['listaRelatorioProfissionais'] = $listaRelatorioProfissionais;
			
		    
			header("location:../views/relatorioDoProfissional.php");
			

		}	
		
	}
	
	
}

