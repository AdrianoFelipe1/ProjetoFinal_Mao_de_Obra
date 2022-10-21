<?php
	session_start();
	$validar = $_SESSION["nomeUsuario"];
	
	$resp = isset($_REQUEST["resp"]) ? $_REQUEST["resp"] : "";
	
	if (empty($validar)){
		
		header("Location:../index.php");
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
	 <link href="../views/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="../views/bootstrap/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="../views/bootstrap/css/signin.css" rel="stylesheet">
    

    <!-- Custom CSS --> 
    <link href="../views/bootstrap/css/freelancer.css" rel="stylesheet">
	
	 <!-- jQuery Função: após minimizar o site. O menu é exibido através de um botão na parte superior à direita do site. -->
    <script src="../views/bootstrap/js/jquery.js"></script> 
	
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
						
						<a href="../views/areaAdministrador.php">Retornar a área restrita</a>
						
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
					
                    <h5>Relatório Profissional</h5>
                     <h6> <?php echo "Seja bem-vindo(a) ". $validar;?> </h6> 
					 
                </div>
				
            </div>
			
            
			<div class="container" >
            <div class="row" >
            <div class="col-lg-12 text-center">
				
				
					<form class="form-signin" method="POST" action="../controllers/profissionalController.php" target="_blank" >
				
						<label for="inputCadastro" class="sr-only"  >PESQUISAR POR TIPO DE SERVIÇO</label>Selecione uma profissão:
									
										<select class="form-control" name="selecionar_profissionais_profissao" id="txt_plataforma" >
										<option value="0" selected="selected">Todos</option>
										<option value="1">Ajudante</option>
										<option value="2">Arquiteto</option>
										<option value="3">Calheiro</option>
										<option value="4">Carpinteiro</option>
										<option value="5">Desenhista</option>
										<option value="6">Eletricista</option>
										<option value="7">Encanador</option>
										<option value="8">Gesseiro</option>
										<option value="9">Marceneiro</option>
										<option value="10">Pedreiro</option>
										<option value="11">Pintor</option>
										<option value="12">Projetista</option>
										<option value="13">Serralheiro</option>
										<option value="14">Telhadista</option>
										<option value="15">Vidraceiro</option>
										<option value="16">Outros</option>
								
									</select>
									
									<div class= "col-lg-offset-12">
										<button  class="btn btn-primary" type="submit">
											<span  class="glyphicon glyphicon-search"></span>
											<input type="hidden" name="acao" id="acao" value="relatorioProfissionaisPorProfissao">
										</button>
									</div>
									
									
					</form>
					<br/><br/><br/><br/><br/><br/><br/>
					
                    
					
					
					
					
					
					
					
					
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