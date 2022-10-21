
<?php
	
	require_once("../controllers/clienteController.php");
	require_once("../Model/cadastroClienteModel.php");
	require_once("../Model/clienteModel.php");
	require_once("../Model/loginModel.php");
	
	
	//session_start();
	$validar = $_SESSION["nomeUsuario"];

	$resp = isset($_REQUEST["resp"]) ? $_REQUEST["resp"] : "";

	if (empty($validar)){

		header("Location:../index.php");
		
	}else{
		
		
		$clienteController = new clienteController();
		$cadastroClienteModel = $clienteController->mostrarDadosCliente($validar);
		
		$clienteModel = new clienteModel();
		$loginModel = new loginModel();
		
		$clienteModel = $cadastroClienteModel->getClienteModel();
		$loginModel = $cadastroClienteModel->getLoginModel();
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
				//$("#data").mask("99/99/9999");
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
					
						<a href="../views/areaCliente.php">Retornar a área restrita</a>
						
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
		
			<h5>Área Restrita do Cliente / Editar Cadastro</h5>
			<h6> <?php echo "Seja bem-vindo(a) ". $validar;?> </h6> 
			
			</br><p><center style="color:ciano;">
					<?php
						if(isset($_SESSION['atualizacaoCliente'])){
							echo $_SESSION['atualizacaoCliente'];
							unset ($_SESSION['atualizacaoCliente']);
						}
					?>
				</center></p>
				
				<p><center style="color:red;">
					<?php
						if(isset($_SESSION['emailDoClienteEdita'])){
							echo $_SESSION['emailDoClienteEdita'];
							unset ($_SESSION['emailDoClienteEdita']);
						}
					?>
				</center></p>
			
		
			<p style="font-size: 12px;">* Campos obrigatórios</p>
			</br>
			
		</div>
	
	
		<form   method="POST" action="../controllers/clienteController.php">
		
			<div  class="col-sm-4 form-group">
			
			
			
				<label for="nome">Nome Completo*</label>
				<input class="form-control"  type="text" name="editar_nome_cli" value="<?php echo $clienteModel->getNome_cli();?>" size="35" pattern="[aA-zZçÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ\s]+$" placeholder="Nome Completo" required autofocus>
				</br>
				
				
				
				
				<label 	 for="data_de_nascimento">Data de Nascimento*</label>
				<input  class="form-control"  type="date" name="editar_data_cli"  value="<?php echo $clienteModel->getData_nascimento_cli();?>" width="10%" required autofocus>
				</br>
				
				<label  for="endereco" > Endereço*</label>
				<input  class="form-control" type="text" name="editar_endereco_cli" value="<?php echo $clienteModel->getEndereco_cli();?>" size="25" pattern="[aA-zZ0-9çÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ.:ºª-\s]+$" placeholder="Endereço" required autofocus>
				</br>
				
				<label for="cep">CEP*</label>
				<input  class="form-control" type="text" name="editar_cep_cli" value="<?php echo $clienteModel->getCep_cli();?>" id="cep" size="25" placeholder="00000-000" required autofocus>
				</br>
				
				<label for="bairro">Bairro*</label>
				<input   class="form-control" type="text" name="editar_bairro_cli" size="25" value="<?php echo $clienteModel->getBairro_cli();?>" pattern="[aA-zZçÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ\s]+$" placeholder="Nome do bairro" required autofocus>
				</br>
				
				<label for="cidade">Cidade*</label>
				<input  class="form-control" type="text" name="editar_cidade_cli" value="<?php echo $clienteModel->getCidade_cli();?>" size="25" pattern="[aA-zZçÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ\s]+$" placeholder="Nome da cidade" required autofocus>
				</br>
				
			</div>            
	
		
			<div  class="col-sm-4 form-group">
			
				
				<label for="inputCadastro" class="sr-only">Estado</label>ESTADO*
								<select class="form-control" name="editar_estado_cli" id="txt_plataforma" required autofocus>
									<option value="<?php echo $clienteModel->getEstado_cli();?>"> <?php echo $clienteModel->getEstado_cli();?></option>
									<option value="Acre">Acre</option>
									<option value="Alagoas">Alagoas</option>
									<option value="Amapá">Amapá</option>
									<option value="Amazonas">Amazonas</option>
									<option value="Bahia">Bahia</option>
									<option value="Ceará">Ceará</option>
									<option value="Distrito Federal">Distrito Federal</option>
									<option value="Espírito Santo">Espírito Santo</option>
									<option value="Goiás">Goiás</option>
									<option value="Maranhão">Maranhão</option>
									<option value="Mato Grosso">Mato Grosso</option>
									<option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
									<option value="Minas Gerais">Minas Gerais</option>
									<option value="Pará">Pará</option>
									<option value="Paraíba">Paraíba</option>
									<option value="Paraná">Paraná</option>
									<option value="Pernambuco">Pernambuco</option>
									<option value="Piauí">Piauí</option>
									<option value="Rio de Janeiro">Rio de Janeiro</option>
									<option value="Rio Grande do Norte">Rio Grande do Norte</option>
									<option value="Rio Grande do Sul">Rio Grande do Sul</option>
									<option value="Rondônia">Rondônia</option>
									<option value="Roraima">Roraima</option>
									<option value="Santa Catarina">Santa Catarina</option>
									<option value="São Paulo">São Paulo</option>
									<option value="Sergipe">Sergipe</option>
									<option value="Tocantins">Tocantins</option>
								
								</select>
								<br/>
				
				<label for="telefone">Telefone*</label>
				<input  class="form-control" type="text" name="editar_telefone_cli" id="campoTelefone" value="<?php echo $clienteModel->getTelefone_cli();?>" placeholder="(_) 0000-0000" required autofocus>
				</br>
				
				<label for="email">E-mail*</label>
				<input  class="form-control" type="email" size="35" name="editar_email_cli" value="<?php echo $clienteModel->getEmail_cli();?>"  pattern="[a-zA-Z0-9._%+-wWyYkK]+@[a-zA-Z0-9.-wWyYkK]+\.[a-zA-ZwWyYkK]{2,4}$" placeholder="exemplo@email.com" required autofocus>
				</br>
				
				<label for="senha">Nova Senha</br>(CASO QUEIRA TROCAR A SENHA)</label>
				<input  class="form-control" type="password" name="editar_senha_cli" size="25"   placeholder="***********" >
				</br></br>
				
				<button class="btn btn-primary" type="submit">Salvar</button>
				<input type="hidden" name="acao" id="acao" value="editarCadastroCliente">
				
				
			</div>
		
		</form>
		
		<div  class="col-sm-4 form-group">
			<h2 class="form-signin-heading text-center"><img alt= class="img-responsive" center src="..\imagens\foto_editar.jpg	" width="390px" height="320px"> </h2>
		</div>
	
	</div>
</html>
