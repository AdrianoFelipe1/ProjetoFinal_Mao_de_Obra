<?php

	session_start();
	
	$resp = isset($_REQUEST["resp"]) ? $_REQUEST["resp"] : "";
	
	//<?php {echo "<script>alert('".$mensagem."');</script>";};

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
    

    <!-- Custom CSS --> 
    <link href="../views/bootstrap/css/freelancer.css" rel="stylesheet">
	
	<!-- jQuery Função: após minimizar o site. O menu é exibido através de um botão na parte superior à direita do site. -->
    <script src="../views/bootstrap/js/jquery.js"></script> 
	<script src="../views/bootstrap/js/jquery-1.5.2.min.js"></script>
	<script src="../views/bootstrap/js/jquery.maskedinput-1.3.min.js"></script>
	

	<script>
		jQuery(function($){
			$("#data").mask("99/99/9999");
			$("#cpf").mask("999.999.999-99");
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
	
	
	
	<script>
			function validarCPF( cpf ){
				var filtro = /^\d{3}.\d{3}.\d{3}-\d{2}$/i;
	
				if(!filtro.test(cpf))
				{
					window.alert("CPF inválido. Tente novamente.");
					return false;
				}
   
				cpf = remove(cpf, ".");
				cpf = remove(cpf, "-");
	
				if(cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" ||
				cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" ||
				cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" ||
				cpf == "88888888888" || cpf == "99999999999")
				{
					window.alert("CPF inválido. Tente novamente.");
					return false;
				}

				soma = 0;
				for(i = 0; i < 9; i++)
				{
					soma += parseInt(cpf.charAt(i)) * (10 - i);
				}
	
				resto = 11 - (soma % 11);
				if(resto == 10 || resto == 11)
				{
					resto = 0;
				}
				if(resto != parseInt(cpf.charAt(9))){
					window.alert("CPF inválido. Tente novamente.");
					return false;
				}
	
				soma = 0;
				for(i = 0; i < 10; i ++)
				{
					soma += parseInt(cpf.charAt(i)) * (11 - i);
				}
				
				resto = 11 - (soma % 11);
				if(resto == 10 || resto == 11)
				{
					resto = 0;
				}
	
				if(resto != parseInt(cpf.charAt(10))){
					window.alert("CPF inválido. Tente novamente.");
					return false;
				}
	
				return true;
			}
 
			function remove(str, sub) {
				i = str.indexOf(sub);
				r = "";
				if (i == -1) return str;
				{
					r += str.substring(0,i) + remove(str.substring(i + sub.length), sub);
				}
	
				return r;
			}

			/**
			* MASCARA ( mascara(o,f) e execmascara() ) CRIADAS POR ELCIO LUIZ
			* elcio.com.br
			*/
			function mascara(o,f){
				v_obj=o
				v_fun=f
				setTimeout("execmascara()",1)
			}

			function execmascara(){
				v_obj.value=v_fun(v_obj.value)
			}

			function cpf_mask(v){
				v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
				v=v.replace(/(\d{3})(\d)/,"$1.$2")    //Coloca ponto entre o terceiro e o quarto dígitos
				v=v.replace(/(\d{3})(\d)/,"$1.$2")    //Coloca ponto entre o setimo e o oitava dígitos
				v=v.replace(/(\d{3})(\d)/,"$1-$2")   //Coloca ponto entre o decimoprimeiro e o decimosegundo dígitos
				return v
			}
		</script>
	
	
	
	
	
	
	<script type="text/javascript"> function blocTexto(valor) { quant = 85; total = valor.length; if(total <= quant) { resto = quant - total; document.getElementById('cont').innerHTML = resto; } else { document.getElementById('texto').value = valor.substr(0,quant); } } </script> 
	
	
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
				
					
                    <h4>Cadastro do Profissional</h4>
                     
                </div>
				
            </div>
			
            
			<div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
				
					
                    <form class="form-signin" method="POST" action="../controllers/profissionalController.php">
	  
								<h3 class="form-signin-heading text-center"><img alt= class="img-responsive" center src="..\imagens\logomarca.pgz	" > </h3>
								
								</br>
								<p style="font-size: 12px;">* Campos obrigatórios</p>
								<p style="color:red;"><?php //echo $mensagem; ?></p>
								
								<p><center style="color:red;">
								<?php
									if(isset($_SESSION['logPro'])){
										echo $_SESSION['logPro'];
										unset ($_SESSION['logPro']);
									}
								
								?>
							</center></p></br>
							
								<p><center style="color:red;">
								<?php
									if(isset($_SESSION['cpfPro'])){
										echo $_SESSION['cpfPro'];
										unset ($_SESSION['cpfPro']);
									}
								
								?>
							</center></p>
							
							<p><center style="color:red;">
								<?php
									if(isset($_SESSION['emailProfissional'])){
										echo $_SESSION['emailProfissional'];
										unset ($_SESSION['emailProfissional']);
									}
								
								?>
							</center></p>
								
								
								
								<label for="inputCadastro" class="sr-only">Nome</label><br/>NOME*
								<input type="text" name="nomep" class="form-control"  pattern="[aA-zZçÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ\s]+$" placeholder="Digitar o nome completo" required autofocus>
								<br/>
								
								<label for="inputCadastro" class="sr-only">CPF</label><br/>CPF*
								<input type="text" name="cpfp" maxlength="14" class="form-control" id="cpf" placeholder="999.999.999-99" onblur="javascript: validarCPF(this.value);" onkeypress="javascript: mascara(this, cpf_mask);"  maxlength="14" required autofocus>
								<br/>
								
								<label for="inputCadastro" class="sr-only">Data de Nascimento</label>DATA DE NASCIMENTO*
								<input type="date" name="data_nascimentop" class="form-control" placeholder="__/__/____" required autofocus>
								<br/>
								
								<label for="inputCadastro" class="sr-only">Escolaridade</label>ESCOLARIDADE*
								<select required class="form-control" name="escolaridadep" id="txt_plataforma" >
										<option value="">Selecione sua escolaridade</option>
										<option value="Ensino fundamental incompleto">Ensino fundamental incompleto</option>
										<option value="Ensino fundamental completo">Ensino fundamental completo</option>
										<option value="Ensino medio incompleto">Ensino medio incompleto</option>
										<option value="Ensino medio completo">Ensino medio completo</option>
										<option value="Ensino superior incompleto">Ensino superior incompleto</option>
										<option value="Ensino superior completo">Ensino superior completo</option>
								
									</select>
								
								
								<br/><br/>
								<label for="inputCadastro" class="sr-only">Endereço</label>ENDEREÇO*
								<input type="text" name="enderecop" class="form-control" pattern="[aA-zZ0-9çÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ.:ºª-\s]+$"  placeholder="Digitar o endereço completo" required autofocus>
								<br/>
								
								<label for="inputCadastro" class="sr-only">CEP</label>CEP*
								<input type="text" name="cepp" class="form-control" id="cep" placeholder="00.000-000" required autofocus>
								<br/>
								
								<label for="inputCadastro" class="sr-only">Bairro</label>BAIRRO*
								<input type="text" name="bairrop" class="form-control"  pattern="[aA-zZçÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ\s]+$" placeholder="Digitar o nome do bairro" required autofocus>
								<br/>
								
								<label for="inputCadastro" class="sr-only">Cidade</label>CIDADE*
								<input type="text" name="cidadep" class="form-control" pattern="[aA-zZçÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ\s]+$" placeholder="Digitar o nome da cidade" required autofocus>
								<br/>
								
								<label for="inputCadastro" class="sr-only">Estado</label>ESTADO*
								<select required class="form-control" name="estadop" id="txt_plataforma"  >
										<option value="">Selecione o seu estado</option>
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
									</br>
						
								<label for="inputCadastro" class="sr-only">Profissão</label>PROFISSÃO*
									<select required class="form-control" name="profissaop" id="txt_plataforma" >
										<option value="">Escolha sua profissão</option>
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
								<br/>
								
								
								<label for="inputCadastro" class="sr-only">Experiência profissional</label>EXPERIENCIA PROFISSIONAL* <br/><span id="cont">(No máximo 85 caracteres)</span>
								<textarea name="experienciap" class="form-control" onkeyup="blocTexto(this.value)"  id="texto"  cols="35" rows ="5" tabindex="2" pattern="[aA-zZ0-9çÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ.-_,:;!ªº\s]+$" placeholder="Digite aqui a experiência de sua profissão" required autofocus></textarea>
								<br/><br/>
								
								
								
								<label for="inputCadastro" class="sr-only">Telefone</label>TELEFONE*
								<input type="text" name="telefonep" class="form-control" id="campoTelefone" placeholder="(_) 0000-0000" required autofocus>
								<br/>
								
								<label for="inputCadastro" class="sr-only">Email</label>E-MAIL*
								<input type="text" name="emailp" class="form-control" pattern="[a-zA-Z0-9._%+-wWyYkK]+@[a-zA-Z0-9.-wWyYkK]+\.[a-zA-ZwWyYkK]{2,4}$" placeholder="Digitar o endereço de E-mail" required autofocus>
								<br/>
								
								<label for="inputCadastro" class="sr-only">Login</label>LOGIN*
								<input type="text" name="loginp" class="form-control" pattern="[aA-zZ0-9._-çÇwWyYkKáéíóúãâôîêûÁÉÍÓÚÃÂÊÎÔÛ\s]+$" placeholder="Digite o nome do seu login" required autofocus>
								<br/>
								
								<label for="inputPassword" class="sr-only">Senha</label>SENHA*
								<input type="password" name="senhap" class="form-control" placeholder="Digite a sua Senha" required autofocus>
								<br/>
       
							<button class="btn btn-lg btn-primary btn-block" type="submit">Cadastrar</button>
							<input type="hidden" name="acao" id="acao" value="cadastrarProfissional">
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