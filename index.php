<?php
	
	session_start();

	$resp = isset($_REQUEST["resp"]) ? $_REQUEST["resp"] : "";


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
    <link href="views/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="views/bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="views/bootstrap/css/signin.css" rel="stylesheet">
	
	

	
    	

    <!-- Custom CSS --> 
    <link href="views/bootstrap/css/freelancer.css" rel="stylesheet">
	
	 <!-- jQuery Função: após minimizar o site. O menu é exibido através de um botão na parte superior à direita do site. -->
    <script src="views/bootstrap/js/jquery.js"></script> 
	
	    <!-- Bootstrap Core JavaScript -->
    <script src="views/bootstrap/js/bootstrap.min.js"></script>
	<script src="views/bootstrap/js/ie-emulation-modes-warning.js"></script>
	<script src="views/bootstrap/js/ie10-viewport-bug-workaround.js"></script>

	
    <!-- Custom Fonts -->
    <link href="views/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="views/bootstrap/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

</head>

  <body role="document">
	<!-- Inicio navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>


                <a class="navbar-brand" href="index.php"><b>CLICWORKS<b/> <br/>
				<p>Buscas de Profissionais de construção civil<p/></a>
            </div>
<br/>
            <!-- Collect the nav links, forms, and other content for toggling -->
           <div id="navbar" class="navbar-collapse collapse" > 
           <ul class="nav navbar-nav navbar-right">
		   <li class="dropdown">

		   <a href="#portfolio"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastre-se<span class="caret"></span></a>
           <ul class="dropdown-menu" >

            <li><a href="views/clienteCadastro.php">Cliente</a></li>
			<li><a href="views/profissionalCadastro.php">Profissional</a></li>        
          
         </ul>
        </li>
            <li><a href="views/sobre.php">Sobre</a></li>
            <li><a href="views/contato.php">Contato</a></li>
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
				
					<br/>
					<p><center style="color:ciano;">
					<?php
						if(isset($_SESSION['cadastroCliente'])){
							echo $_SESSION['cadastroCliente'];
							unset ($_SESSION['cadastroCliente']);
						}
					?>
				</center></p>
				
				<p><center style="color:ciano;">
					<?php
						if(isset($_SESSION['cadastroProfissional'])){
							echo $_SESSION['cadastroProfissional'];
							unset ($_SESSION['cadastroProfissional']);
						}
					?>
				</center></p>
				
				
					
                    <h3>Bem vindo ao Clicworks - Buscas de Profissionais de construção civil</h3>
                    <hr class="star-primary"> 
                </div>
				
            </div>
			
            <div class="row">
                <div class="col-sm-9">
                    
					<img class="esquerda" vspace="35px"	src="imagens/banner.png" class= "img-responsive" alt="" >
                </div>
				
				
        
			
               <div class= "col-lg-offset-5" class="img-responsive" alt="">
					<div class="container">
					
						<?php 
							session_destroy();
							//unset($_SESSION['nomeUsuario']);
						?>

							<form  class="form-signin" method="POST" action="controllers/loginController.php">
	  
								<h2 class="form-signin-heading text-center"><img alt= class="img-responsive"  src= "imagens\logomarca.pgz" <br/> </h2>
		
								<label  for="inputEmail" class="sr-only">Usuário</label>
								<input type="text" name="login" class="form-control" placeholder="Digite o Login" required autofocus>
								<br/>
								<label for="inputPassword" class="sr-only">Senha</label>
								<input type="password" name="senha" class="form-control" placeholder="Digite a Senha" required>
	
       
								<button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
								<input type="hidden" name="acao" id="acao" value="validaLogin">  
							
								<p><center style="color:red;">
								<?php
									if(isset($_SESSION['loginErro'])){
										echo $_SESSION['loginErro'];
										unset ($_SESSION['loginErro']);
									}
								
								?>
							</center></p>
							
							<a  href="views/esqueciLoginSenha.php"  ><center>Esqueci minha senha</center></a>
						</div></form><center><h4>
				       
                </div>

			</div>

		</div>
		
    </section>
	
	
    <!-- Objetivo do Site -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
						<p>As vantagens para usuários cadastrados<p/>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
					
					<p class="text-center">Usuários<p/></br>
					
                    <p  style="text-align: justify;">Seje agora mesmo um cliente, e aproveitem as grandes vantagens de poder buscar mão de obra qualificada na área de construção civil. Aqui você encontram grandes profisfionais de várias especialidade em construção civil. Aproveitem essa oportunidade se cadastrando em nosso sistema</p>
                </div>
               
			   <div class="col-lg-4">
			   
					<p class="text-center">Profissionais<p/></br>
					
                    <p style="text-align: justify;">Não percam, agora chegou a grande oportunidade de poder divulgar suas experiências em construção civil totalmente gratuíto, bantando apenas um clique e se cadastrando em nosso sistema. Não fique de fora dessa, aproveitem.</p>
	
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
    <script src="views/bootstrap/js/jquery.js"></script>
	
    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="views/bootstrap/js/classie.js"></script>
    <script src="views/bootstrap/js/cbpAnimatedHeader.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="views/bootstrap/js/freelancer.js"></script>

	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="views/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
	
</body>

</html>