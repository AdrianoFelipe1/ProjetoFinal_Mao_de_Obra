<?php

require_once("../Model/clienteModel.php");
require_once("../Model/profissionalModel.php");
require_once("../Model/administradorModel.php");
require_once("../Model/loginModel.php");
require_once("../Model/servicoModel.php");
require_once("../dao/mao_De_Obra_Dao.php");
require_once("C:/xampp/htdocs/ProjetoFinal_Mao_de_Obra/controllers/PHPMailer/class.phpmailer.php");
require_once("C:/xampp/htdocs/ProjetoFinal_Mao_de_Obra/controllers/PHPMailer/class.smtp.php");
set_include_path("C:/xampp/htdocs/ProjetoFinal_Mao_de_Obra/controllers/PHPMailer");

session_start();
$acao = isset($_REQUEST["acao"]) ? $_REQUEST["acao"] : ""  ;
$email = isset($_REQUEST["email"]) ? $_REQUEST["email"] : "";



switch ($acao) {

    case "validaLogin":
        loginController::validaLogin();
        break;
		
	case "atualizaSenhaCliente":

        loginController::atualizaSenhaCliente($email);
        break;
		
	case "atualizaSenhaProfissional":

        loginController::atualizaSenhaProfissional($email);
        break;

	
 }
 
 

class loginController {

    
	static function validaLogin() {

       
		$Login = isset($_REQUEST["login"]) ? $_REQUEST["login"] : "" ;
		$Senha = isset($_REQUEST["senha"]) ? $_REQUEST["senha"] : "" ;
		
		$Login = trim($Login);
		$Senha = sha1(trim($Senha));
		
		$loginModel = new loginModel();
		$loginModel->setLogin($Login);
		$loginModel->setSenha($Senha);
		

        $mao_De_Obra_Dao = new mao_De_Obra_Dao();
        $result = $mao_De_Obra_Dao->validaLogin($loginModel);
		
		
        if (($result -> rowCount()) == 1){
            foreach($result as $r) {
			  $nivelAcesso = $r[3];
			  
			}
	
			session_start();
			
		
		
			$_SESSION["nomeUsuario"]=$Login;
			
			if($nivelAcesso == '1'){
		
				header("Location:../views/areaAdministrador.php");
			}
		
			elseif($nivelAcesso == '2'){
				
				header("Location:../views/areaProfissional.php");
			}
			
			else{
			
				header("Location:../views/areaCliente.php");
			} 
	
        }else{
	
			
			$_SESSION['loginErro'] = "Login ou senha Inválido";
			header("Location: ../index.php");
	
        }
		
    }
	
	
	
	public function verificarLogin($loginModel){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->verificarLoginExistente($loginModel);
		
		if (($result->rowCount()) > 0){
			
			return true;
			
		}
		else{
			return false;
		}
	}
	

	public function retornarLogin($loginModel){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->verificarLoginExistente($loginModel);
			
		$loginDoUsuario = '';
		
		if (($result->rowCount()) > 0){
			
			foreach($result as $login) {
				
				$loginDoUsuario = trim($login[0]);
			
			}
		}
		
		return $loginDoUsuario;
	}
	
	
	
	public function verificaEmailCliente($email){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->verificarEmail($email);
		
		if($result){
			
			return true;
			
		}else{
			
			return false;
		}
		
	}
	
	
	public function verificaLoginCliente($email){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->verificarLoginCliente($email);
		$login = '';
		if($result){
			
			foreach($result as $log) {
				
				$login = trim($log);
				
			}
			
			return $login;
			
		}
	}
	
	
	
	
	
	
	
	
	//NOVOOOOOO email
		public function atualizaSenha($login, $senha){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->atualizaSenha($login, $senha);
		

		return $result;
		
	}
	
	
	
	//NOVOOOOOO email
		public function obterLoginCliente($email){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->obterLoginCliente($email);
		$login = '';
		
			
		foreach($result as $log) {
				
			$login = trim($log[0]);
			
		}
	
		return $login;
		
	}
	
	
	//NOVO
	public function envioDeEmail($email, $login, $senha){
		
		/*
		Supondo que o arquivo esteja dentro do
		diretório raíz e sub-diretório phpmailer/
		*/
		//require "phpmailer/class.phpmailer.php"; 
		
 
		// conteúdo da mensagem
		$mensagem = "<strong>Login: </strong>".$login."	<br /> <strong>Senha: </strong>".$senha;
 
		// Estrutura HTML da mensagem
		$msg = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">";
		$msg .= "<html>";
		$msg .= "<head></head>";
		$msg .= "<body style=\"background-color:#fff;\" >";
		$msg .= "<strong>MENSAGEM:</strong><br /><br />";
		$msg .= $mensagem;
		$msg .= "</body>";
		$msg .= "</html>";
 
		// Abaixo começaremos a utilizar o PHPMailer. 
 
		/*
		Aqui criamos uma nova instância da classe como $mail.
		Todas as características, funções e métodos da classe
		poderão ser acessados através da variável (objeto) $mail.
		*/
		$mail = new PHPMailer(); // 
 
		// Define o método de envio
		$mail->Mailer     = "smtp";
 
		// Define que a mensagem poderá ter formatação HTML
		$mail->IsHTML(true); //
 
		// Define que a codificação do conteúdo da mensagem será utf-8
		$mail->CharSet    = "utf-8";
 
		// Define que os emails enviadas utilizarão SMTP Seguro tls
		$mail->SMTPSecure = "tls";
 
		// Define que o Host que enviará a mensagem é o Gmail
		$mail->Host       = "smtp.gmail.com";
 
		//Define a porta utilizada pelo Gmail para o envio autenticado
		$mail->Port       = "587";                   
 
		// Deine que a mensagem utiliza método de envio autenticado
		$mail->SMTPAuth   = "true";
 
		// Define o usuário do gmail autenticado responsável pelo envio
		$mail->Username   = "clicwork2016@gmail.com";
 
		// Define a senha deste usuário citado acima
		$mail->Password   = "clic_rodri";
 
		// Defina o email e o nome que aparecerá como remetente no cabeçalho
		$mail->From       = "clicwork2016@gmail.com";
		$mail->FromName   = "clicwork2016@gmail.com";
 
		// Define o destinatário que receberá a mensagem
		$mail->AddAddress($email);
 
		/*
		Define o email que receberá resposta desta
		mensagem, quando o destinatário responder
		*/
		$mail->AddReplyTo("clicwork2016@gmail.com", $mail->FromName);
 
		// Assunto da mensagem
		$mail->Subject    = "Clicworks - Recuperação de Login e Senha";
 
		// Toda a estrutura HTML e corpo da mensagem
		$mail->Body       = "Olá, redefinimos seu Login e Senha. <br /><br />
							 $msg	<br /><br />  
							 Obrigado!<br /><br />
                             Esta é uma mensagem automática, por favor não responda!";
 
		// Controle de erro ou sucesso no envio
		if (!$mail->Send())
		{
 
			//echo "Erro de envio: " . $mail->ErrorInfo;
			return false;
		}
		else{
 
			//echo "Mensagem enviada com sucesso!";
			return true;
		}
 
	}
	

	
	
	public static function atualizaSenhaCliente($email){
		
		$loginController = new loginController();
		
		if ($loginController->verificaEmailCliente($email)){
			
			$senha = rand(30000,32768);
			$login = $loginController->obterLoginCliente($email);
			
			$loginController->atualizaSenha($login, sha1($senha));
			
			//$headers = "MIME-Version: 1.1\r\n";
			//$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
			//$headers .= "From: clicworks@clicworks.com\r\n"; // remetente
			//$headers .= "Return-Path: clicworks@clicworks.com\r\n"; // return-path
			//$envio = mail("juliodiass@gmail.com", "Recuperação de senha", "login: ".$login."<br>\n senha: ".$senha, //$headers);
			

			$envio = $loginController->envioDeEmail($email, $login, $senha);
			
			//$envio = mail("juliodiass@gmail.com", "Recuperação de senha", "login: <br>\n senha: ", $headers);
			if ($envio){
			
				//mail("rodrigo.soares.rj@gmail.com","Recuperação de senha","login: ".$login."<br>\n senha: ".$senha);
			
				$_SESSION["SucessoSenha"] = "O login e a senha foi enviado para o e-mail com sucesso!";
				header("location:../views/loginSenhaCliente.php");
		
			}else{
				
				$_SESSION["ErroRecSenha"] = 'Nao foi possivel recuperar a senha do profissional';
				header("location:../views/loginSenhaCliente.php");
			}
			
		}else{
			
			$_SESSION["ErroRecSenha"] = 'Nao foi possivel recuperar a senha do profissional';
			header("location:../views/loginSenhaCliente.php");
			
		}
		
	}
	
	
	

	
	
	//NOME COM METODO ALTERADO email
	public function obterLoginProfissional($email){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->obterLoginProfissional($email);
		$login = '';
		
			
		foreach($result as $log) {
				
			$login = trim($log[0]);
			
		}
	
		return $login;
		
	}
	
	
	//Metodo que irá verifivar na DAO se o e-mail existe
	public function verificaEmailProfissional($email){
		
		$mao_De_Obra_Dao = new mao_De_Obra_Dao();
		$result = $mao_De_Obra_Dao->verificarEmail($email);
		
		return $result;
		
	}
	
	
	//Metodo - Quando o profissional digitar o e-mail passa por este método
	public function atualizaSenhaProfissional($email){
		
		$loginController = new loginController();
		
		if ($loginController->verificaEmailProfissional(trim($email))){
			
			$senha = rand(30000,32768);
			$login = $loginController->obterLoginProfissional($email);
			
			$loginController->atualizaSenha($login, sha1($senha));
			
			//$headers = "MIME-Version: 1.1\r\n";
			//$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
			//$headers .= "From: clicworks@clicworks.com\r\n"; // remetente
			//$headers .= "Return-Path: clicworks@clicworks.com\r\n"; // return-path
			//$envio = mail("juliodiass@gmail.com", "Recuperação de senha", "login: ".$login."<br>\n senha: ".$senha, //$headers);
			

			$envio = $loginController->envioDeEmail($email, $login, $senha);
			
			//$envio = mail("juliodiass@gmail.com", "Recuperação de senha", "login: <br>\n senha: ", $headers);
			if ($envio){
			
				//mail("rodrigo.soares.rj@gmail.com","Recuperação de senha","login: ".$login."<br>\n senha: ".$senha);
			
				$_SESSION["SucessoSenha"] = "O login e a senha foi enviado para o e-mail com sucesso!";
				header("location:../views/loginSenhaProfissional.php");
		
			}else{
				
				$_SESSION["ErroRecSenha"] = 'Nao foi possivel enviar o e-mail';
				header("location:../views/loginSenhaProfissional.php");
			}
			
		}else{
			
			$_SESSION["ErroRecSenha"] = 'Nao foi possivel gerar nova senha para o profissional';
			header("location:../views/loginSenhaProfissional.php");
			
		}
		
		
	}
	
	
	
}


