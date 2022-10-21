<?php

    require_once("../controllers/clienteController.php");
	require_once("../Model/cadastroClienteModel.php");
	require_once("../Model/clienteModel.php");
	
	
	//session_start();
	$validar = $_SESSION["nomeUsuario"];
	
	$resp = isset($_REQUEST["resp"]) ? $_REQUEST["resp"] : "";
	
	if (empty($validar)){
		
		header("Location:../index.php");
		
	}else{
		
		$clienteController = new clienteController();
		$listaCadastrosClientes = $clienteController->exibirDadosClientes();
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
	<link rel="stylesheet" href="../views/bootstrap/css/tabela_adm.css" media="screen" />

    

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
					
					 <h5>Dados dos Clientes</h5>
					 
                     <h6> <?php echo "Seja bem-vindo(a) ". $validar;?> </h6> 
					 
					 </br>
					 <p><center style="color:red;">
						<?php
							if(isset($_SESSION['erroExclui'])){
								echo $_SESSION['erroExclui'];
								unset ($_SESSION['erroExclui']);
							}
						
						?>
						</center></p>
						
						 <p><center style="color:ciano;">
						<?php
							if(isset($_SESSION['excluirCli'])){
								echo $_SESSION['excluirCli'];
								unset ($_SESSION['excluirCli']);
							}
						
						?>
					</center></p>
					 
                </div>
				
            </div>
			
			
			</br>
			<table  class="table">
			
				<thead >
					<tr>
						<th class="text-center">Nome</th>
						<th class="text-center">Data de  Nascimento</th>
						<th class="text-center">Cidade</th>
						<th class="text-center">Estado</th>
						<th class="text-center">Telefone</th>
						<th class="text-center">E-mail</th>
						<th class="text-center">Editar</th>
						<th class="text-center">Excluir</th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<?php 
							$cont = 1;
						
			 
							foreach($listaCadastrosClientes as $itemLista){
							
								if(($cont%2) == 0){
									
									$estilo = "success"; 
								}
								else{
								
									$estilo = "info"; 
								}
								$cont++;
								
								echo "<td>".$itemLista->getClienteModel()->getNome_cli()."</td>" ;
							
								echo "<td>".$itemLista->getClienteModel()->getData_nascimento_cli()."</td>";

								echo "<td>".$itemLista->getClienteModel()->getCidade_cli()."</td> ";
							
								echo "<td>".$itemLista->getClienteModel()->getEstado_cli()."</td>";
						
								echo "<td>".$itemLista->getClienteModel()->getTelefone_cli()."</td>";
							
								echo "<td>".$itemLista->getClienteModel()->getEmail_cli()."</td>";
	
								echo" <td><a href='administradorEditaCadastroCliente.php?id=".$itemLista->getClienteModel()->getId_cli()."'><button class='btn btn-lg btn-primary btn-block' type='submit' ><img src=\"../imagens/edit.png\"a href='#'></button>
								<input type='hidden' name='acao' id='".$itemLista->getClienteModel()->getId_cli()."' value='mostrarDadosClienteId'></a></td>";
								
								echo" <td><a href='excluiCliente.php?idLogin=".$itemLista->getClienteModel()->getId_login_cli()."'><button class='btn btn-lg btn-primary btn-block' type='submit' Onclick=\"return deleta();\" excluir ><img src=\"../imagens/delete.png\"</a></button>
								<input type='hidden' name='acao' id='".$itemLista->getClienteModel()->getId_login_cli()."' value='XXX'></a></td></tr>";
								
                              
							}
						?>	
						
				</tbody>
			</table>
		
		
			<br/><br/><br/><br/>
	
   

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
	<script>
    $(function(){
      
      $('table > tbody > tr:odd').addClass('odd');
      
      $('table > tbody > tr').hover(function(){
        $(this).toggleClass('hover');
      });
      
      $('#marcar-todos').click(function(){
        $('table > tbody > tr > td > :checkbox')
          .attr('checked', $(this).is(':checked'))
          .trigger('change');
      });
      
      $('table > tbody > tr > td > :checkbox').bind('click change', function(){
        var tr = $(this).parent().parent();
        if($(this).is(':checked')) $(tr).addClass('selected');
        else $(tr).removeClass('selected');
      });
      
      $('form').submit(function(e){ e.preventDefault(); });
      
      $('#pesquisar').keydown(function(){
        var encontrou = false;
        var termo = $(this).val().toLowerCase();
        $('table > tbody > tr').each(function(){
          $(this).find('td').each(function(){
            if($(this).text().toLowerCase().indexOf(termo) > -1) encontrou = true;
          });
          if(!encontrou) $(this).hide();
          else $(this).show();
          encontrou = false;
        });
      });
      
      $("table") 
        .tablesorter({
          dateFormat: 'uk',
          headers: {
            0: {
              sorter: false
            },
            5: {
              sorter: false
            }
          }
        }) 
        .tablesorterPager({container: $("#pager")})
        .bind('sortEnd', function(){
          $('table > tbody > tr').removeClass('odd');
          $('table > tbody > tr:odd').addClass('odd');
        });
      
    });
    </script>
<script>
function deleta() {
    if (confirm("Deseja realmente excluir este cliente?")) 
   return true;
else
   return false;
}
</script>

	
    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="../views/bootstrap/js/classie.js"></script>
    <script src="../views/bootstrap/js/cbpAnimatedHeader.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../views/bootstrap/js/freelancer.js"></script>

</body>

</html>