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
		
		if (isset($_SESSION['listaRelatorioCliente'])){
				
				$listaRelClientes = $_SESSION['listaRelatorioCliente'];
				if (sizeof($listaRelClientes)==0){$teste = 'Nenhum registro encontrado!';
				
				
				}else{
					$teste = '';
				};
				unset($_SESSION['listaRelatorioCliente']);
				
				
			}else{
			$teste = '';
			$clienteController = new clienteController();
			$listaRelClientes = $clienteController->relatorioTodosClientes();
			}
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
	 <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
	    <link href="../views/bootstrap/css/estilo.css" rel="stylesheet">


</head>
 	<p class='center sub-titulo'><p>

	 <fieldset>
						<h1>Relatório dos Clientes Cadastrados </h1>
	 	                <p>____________________________________________________________________________________</p>
									<center><?php echo $teste; ?></center>
<?php 
									$cont = 1;

									foreach($listaRelClientes as $itemLista){
							
										$cont++;
									    echo "<strong>Nome: </strong>".$itemLista->getClienteModel()->getNome_cli()."</p>";						
										echo "<strong>Data de Nascimento: </strong>".$itemLista->getClienteModel()->getData_nascimento_cli()."</p>";
										echo "<strong>Data de Cadastro: </strong>".$itemLista->getClienteModel()->getData_cadastro_cli()."</p>";
										echo "<strong>Endereço: </strong>".$itemLista->getClienteModel()->getEndereco_cli()."</p> ";																
										echo "<strong>Cep: </strong>".$itemLista->getClienteModel()->getCep_cli()."</p>";
										echo "<strong>Bairro: </strong>".$itemLista->getClienteModel()->getBairro_cli()."</p>";
										echo "<strong>Cidade: </strong>".$itemLista->getClienteModel()->getCidade_cli()."</p>";
										echo "<strong>Estado: </strong>".$itemLista->getClienteModel()->getEstado_cli()."</p>";
										echo "<strong>Telefone: </strong>".$itemLista->getClienteModel()->getTelefone_cli()."</p>";
										echo "<strong>E-mail: </strong>".$itemLista->getClienteModel()->getEmail_cli()."</p>";
								        echo"<p>...........................................................................................................................................................................</p>";
									}?>	<button   class='btn btn-lg btn-primary btn-block'  type='submit' >
									<img  src="../imagens/impressora.png" width="32" height="32"   onclick="javascript:window.print();"></button>
 </fieldset>
	 	


			
					
	
					
					
			



</html>