<?php

	session_start();
	
	$resp = isset($_REQUEST["resp"]) ? $_REQUEST["resp"] : "";
	
	
	//$mensagem = $_SESSION["logCli"];
	//$alerta = false;
	
	
	//if (isset($_SESSION["logCli"])){
		
		//$loginDoCliente = $_SESSION["logCli"];
		//header("location:../views/areaCliente.php?=".$loginDoCliente);
		//$alerta = true;
		//$mensagem = "O login ".$loginDoCliente. "  já encontra-se cadastrado!!!";
		//unset($_SESSION["logCli"]);
		//<?php if ($alerta) {echo "<script>alert('".$mensagem."');</script>";};
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
	<script src="../views/bootstrap/js/ie10-viewport-bug-workaround.js"></script>

	
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

</head>


<body id="page-top" class="index">
	
    <!-- Navigation -->
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
                        <a href="../index.php">Retornar a Página Inicial</a>
                    </li>
                   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
				
					
                    <h4>Cadastro do Cliente</h4>
                    
					
					
					
                </div>
            </div>
			
		
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
				
					
						<form class="form-signin" method="POST" action="../controllers/clienteController.php">
	  
							<h3 class="form-signin-heading text-center"><img alt= class="img-responsive" center src="..\imagens\logomarca.pgz	"> </h3>
							
							</br>
							
							<p style="font-size: 12px;" >* Campos obrigatórios</p>
							<p style="color:red;"><?php// echo $mensagem; ?></p>
							
							<p><center style="color:red;">
								<?php
									if(isset($_SESSION['logCli'])){
										echo $_SESSION['logCli'];
										unset ($_SESSION['logCli']);
									}
								
								?>
							</center></p>
							
							<p><center style="color:red;">
								<?php
									if(isset($_SESSION['emailDoCliente'])){
										echo $_SESSION['emailDoCliente'];
										unset ($_SESSION['emailDoCliente']);
									}
								
								?>
							</center></p>
							
							
							
							
							<label for="inputCadastro" class="sr-only">Nome</label><br/>NOME*
							<input type="text" name="nome" class="form-control" pattern="[aA-zZçÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ\s]+$" placeholder="Digitar o nome completo" required>
							<br/>
							
							<label for="inputCadastro" class="sr-only">Data de Nascimento</label>DATA DE NASCIMENTO*
							<input type="date" name="data_nascimento" class="form-control"  placeholder="__/__/____" required autofocus>
							<br/>
							
							<label for="inputCadastro" class="sr-only">Endereço</label>ENDEREÇO*
							<input type="text" name="endereco" class="form-control" pattern="[aA-zZ0-9çÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ.:ºª-\s]+$" placeholder="Digitar o Endereço completo" required autofocus>
							<br/>
							
							<label for="inputCadastro" class="sr-only">CEP</label>CEP*
							<input type="text" name="cep" class="form-control" id="cep" placeholder="00.000-000" required autofocus>
							<br/>
							
							<label for="inputCadastro" class="sr-only">Bairro</label>BAIRRO*
							<input type="text" name="bairro" class="form-control" pattern="[aA-zZçÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ\s]+$" placeholder="Digitar o nome do Bairro" required autofocus>
							<br/>
							
							<label for="inputCadastro" class="sr-only">Cidade</label>CIDADE*
							<input type="text" name="cidade" class="form-control" pattern="[aA-zZçÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ\s]+$" placeholder="Digitar o nome da Cidade" required autofocus>
							<br/>
							
							<label for="inputCadastro" class="sr-only">Estado</label>ESTADO*
								<select required class="form-control" name="estado" id="txt_plataforma"  >
									<option value="" >Selecione o seu estado</option>
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
								
								<label for="inputCadastro" class="sr-only">Telefone</label>TELEFONE*
								<input type="text" name="telefone" class="form-control" id="campoTelefone" placeholder="(_) 0000-0000" required autofocus>
								<br/>
								
								<label for="inputCadastro" class="sr-only">Email</label>E-MAIL*
								<input type="text" name="email" class="form-control" pattern="[a-zA-Z0-9._%+-wWyYkK]+@[a-zA-Z0-9.-wWyYkK]+\.[a-zA-ZwWyYkK]{2,4}$" placeholder="Digitar o endereço de E-mail" required autofocus>
								<br/>
								
								<label for="inputCadastro" class="sr-only">Login</label>LOGIN*
								<input type="text" name="login" class="form-control" pattern="[aA-zZ0-9._-çÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ\s]+$" placeholder="Digitar o nome para Login" required autofocus>
								<br/>
								
								<label for="inputPassword" class="sr-only">Senha</label>SENHA*
								<input type="password" name="senha" class="form-control" placeholder="Digitar a Senha de login" required autofocus>
								<br/>
       
							<button class="btn btn-lg btn-primary btn-block" type="submit">Cadastrar</button>
							<input type="hidden" name="acao" id="acao" value="cadastrarCliente">
						</div></form><center><h4>
                </div>
				
            </div>
		
		
		</div>
		
    </section>
	

 

    <!-- Footer -->
    <footer class="text-center">
       
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
					</br>
                        Copyright &copy; CLICWORKS 2016
					</br></br>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- jQuery -->
    <script src="../views/bootstrap/js/jquery.js"></script>
	
    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="../views/bootstrap/js/classie.js"></script>
    <script src="../views/bootstrap/js/cbpAnimatedHeader.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../views/bootstrap/js/freelancer.js"></script>

</body>

</html>