
<?php

	require_once("../controllers/administradorController.php");
	require_once("../Model/cadastroAdministradorModel.php");
	require_once("../Model/administradorModel.php");
	require_once("../Model/loginModel.php");

	session_start();
	$validar = $_SESSION["nomeUsuario"];

	$resp = isset($_REQUEST["resp"]) ? $_REQUEST["resp"] : "";

	if (empty($validar)){

		header("Location:../index.php");
		
	}else{
		
		$administradorController = new administradorController();
		$cadastroAdministradorModel = $administradorController->mostrarDadosAdministrador($validar);
		
		$administradorModel = new administradorModel();
		$loginModel = new loginModel();
		
		$administradorModel = $cadastroAdministradorModel->getAdministradorModel();
		$loginModel = $cadastroAdministradorModel->getLoginModel();
	}

?>

<!DOCTYPE html>
<html lang="pt-br">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>CLICWORKS - Buscas de Profissionais de construção civil</title>

		<!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
		<link href="../views/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="../views/bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<link href="../views/bootstrap/css/signin.css" rel="stylesheet">
		<link href="../views/bootstrap/css/default.min.css" rel="stylesheet"> 

		<!-- Custom CSS --> 
		<link href="../views/bootstrap/css/freelancer.css" rel="stylesheet">
	
		<!-- jQuery Função: após minimizar o site. O menu é exibido através de um botão na parte superior à direita do site. -->
		<script src="../views/bootstrap/js/jquery.js"></script>
		<script src="../views/bootstrap/js/jquery-1.5.2.min.js"></script>
		<script src="../views/bootstrap/js/jquery.maskedinput-1.3.min.js"></script>

		<script>
			jQuery(function($){
				$("#data").mask("99/99/9999");
				$("#campoTelefone").mask("(99) 99999999?9")
				.live('focusout', function (event) {
					var target, phone, element;
					target = (event.currentTarget) ? event.currentTarget : event.srcElement;
					phone = target.value.replace(/\D/g, '');
					element = $(target);
					element.unmask();
				
					if(phone.length > 10) {
						element.mask("(99) 99999-999?9");
					} else {
						element.mask("(99) 9999-9999?9");
					}
				});

				$("#cep").mask("99999-999");
			}); 
		</script>
 
		<!-- Bootstrap Core JavaScript -->
		<script src="../views/bootstrap/js/bootstrap.min.js"></script>
		<script src="../views/bootstrap/js/ie-emulation-modes-warning.js"></script>
			
		<!-- Custom Fonts -->
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

	</head>


	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			
			<!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header page-scroll">
		       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					
					<span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		       </button>
		        
				<a class="navbar-brand" href="../index.php"><b>CLICWORKS<b/> <br/>
				<p>Buscas de Profissionais de construção civil<p/></a>
				
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		        
				<ul class="nav navbar-nav navbar-right">
		             
		            <li class="page-scroll">
					
						<a href="../views/areaAdministrador.php">Retornar a área restrita</a>
						
		            </li> 
		        </ul>	
		    </div>
		   
		<!-- /.navbar-collapse -->
		</div>
		
	<!-- /.container-fluid -->
	</nav>

	
	<div class="container">
		<div>
		
			<br><br><br><br>
		
			<h5>Área Restrita do Administrador / Editar Cadastro</h5>
			<h6> <?php echo "Seja bem-vindo(a) ". $validar;?> </h6> 
			
			</br>
			<p><center style="color:ciano;">
				<?php
					if(isset($_SESSION['atualizacaoAdministrador'])){
						echo $_SESSION['atualizacaoAdministrador'];
						unset ($_SESSION['atualizacaoAdministrador']);
					}
				?>
			</center></p>
			
			<p><center style="color:red;">
				<?php
					if(isset($_SESSION['emailDoAdministradorEdita'])){
						echo $_SESSION['emailDoAdministradorEdita'];
						unset ($_SESSION['emailDoAdministradorEdita']);
					}
				?>
			</center></p>
		
		
			</br>
			<p style="font-size: 12px;">* Campos obrigatórios</p>
			</br>
			
		</div>
	
	
		<form   method="POST" action="../controllers/administradorController.php">
		
			<div  class="col-sm-4 form-group">
			
				<label for="nome">Nome Completo*</label>
				<input class="form-control"  type="text" name="editar_nome_adm" value="<?php echo $administradorModel->getNome_adm();?>" size="35" placeholder="Nome Completo">
				
				</br>
				<label for="email">E-mail*</label><br>
				<input  class="form-control" type="email" value="<?php echo $administradorModel->getEmail_adm();?>" size="35" name="editar_email_adm" placeholder="exemplo@email.com">
				
			</div>            
	
		
			<div  class="col-sm-4 form-group">
			
				
				
				<label for="email">Nova Senha </br>(CASO QUEIRA TROCAR A SENHA)</label>
				<input  class="form-control" type="password" name="editar_senha_adm" size="25" placeholder="***********">
		
				</br></br>
				<button class="btn btn-primary" type="submit">Salvar</button>
				<input type="hidden" name="acao" id="acao" value="editarCadastroAdministrador">
				
				
			</div>
		
		</form>
		
		<div  class="col-sm-4 form-group">
			<h2 class="form-signin-heading text-center"><img alt= class="img-responsive" center src="..\imagens\foto_editar.jpg	" width="390px" height="264px"> </h2>
		</div>
	
	</div>
</html>
