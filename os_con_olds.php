<?php
	session_start();
	include("config/banco.php");
	header ('Content-type: text/html; charset=utf-8');
	
	if(isset($_SESSION["login"])){
		
		if($_SESSION["login"] == 0){
			
			header("location:index.php");
			
		}
		
	}else{
		header("location:index.php");
	}
	
	
?>
<!DOCTYPE HTML>
<html>
	<head><link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Consultar Ordem de Serviço</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
  		
  		<script  src="js/JQuery_1.11.1/jquery-ui.js"></script>
        
        
        <script>
			
			function tabela(nome, dtIni, dtFim) {
				
				//window.alert(nome+" - "+dtIni+" - "+dtFim);
				
				if (nome == "" && dtIni == "" && dtFim == "") {
    				document.getElementById("tbOs").innerHTML="";
    				return;
  				} 
  				if (window.XMLHttpRequest) {
    				// code for IE7+, Firefox, Chrome, Opera, Safari
    				xmlhttp=new XMLHttpRequest();
  				} else { // code for IE6, IE5
    				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  				}
  				xmlhttp.onreadystatechange=function() {
    				if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      					document.getElementById("tbOs").innerHTML=xmlhttp.responseText;
    				}
  				}
  				xmlhttp.open("GET","os_con_get_olds.php?a="+nome+"&b="+dtIni+"&c="+dtFim,true);
  				xmlhttp.send();
			}
			
			function seleciona(cod){
			
				//window.alert(cod);
				
				document.getElementById('altcodigo').value = cod;
				
				document.getElementById("form").submit();
			
			}
			
			function ponteiro(){
			
				//document.getElementById('linha').style.cursor = 'pointer';
				
				$('.linha').css('cursor','pointer');
				
				
			
			}
			
			
			
			$(document).ready(function(){
			
				$( "#dtIni" ).datepicker();
				$( "#dtFim" ).datepicker();
			
			});
			
		</script>
        
        
	</head>
    
    

	<body>
    	
        <div id="conteudo">
        
	    	<h1>Consultar Ordem de Serviços Antigas</h1>
 			
            <p><br>
                     <a href='principal.php'><img class='voltar' src='img/voltar.png'></a>
					 
					 <a href='os_con_olds.php'><img class='Ordem de Serviços Antigas' src='img/olds.png'></a>
                     
                     
                     
                     
            </p>
            
			<table>
        
        		<tr>
            		<td>
                	Colaborador:
                	</td>
                	<td>
                    	
                        <?php
						
							if($_SESSION["admin"] == true){
								$sql_col = "select * from colaborador";
								$todosColabor = '<option value="todos">Todos</option>';
							}else{
								$sql_col = "select * from colaborador where Cod_colaborador = '".$_SESSION["Cod_colaborador"]."'";
								$todosColabor = '';
							}
						
						?>
                        
                    	<select id="slCol" onChange="tabela(this.value,document.getElementById('dtIni').value,document.getElementById('dtFim').value)">
                        
                        	<option value="">Selecione</option>
							
                            <?php
		
								//$sql_col = "select * from colaborador";
								
								echo $todosColabor;
								
								$query_col = mysqli_query($conexao, $sql_col);
			
								while($sql_col = mysqli_fetch_array($query_col)){
				
									echo "<option value='".$sql_col["Cod_colaborador"]."'>".$sql_col["Nome_colaborador"]."</option>";
				
								}
		
							?>
                            
                        </select>
                    
                	</td>
            	</tr>
            
            	<tr>
                	<td>
                    	De
                    </td>
                    <td>
                    	<input type="text" maxlength="10" size="10" id="dtIni" onChange="tabela(document.getElementById('slCol').value,this.value,document.getElementById('dtFim').value)"/>
                    </td>
                    <td>
                    at&eacute;
                    </td>
                    <td>
                    	<input type="text" maxlength="10" size="10" id="dtFim" onChange="tabela(document.getElementById('slCol').value,document.getElementById('dtIni').value,this.value)"/>
                    </td>
            	</tr>
        
        	</table>
            
            <br>
            
            <?php
					 
					 	$sql_count = "select count(Cod_os) as result from os";
						$query_count = mysqli_query($conexao, $sql_count);
						
						while($sql_count = mysqli_fetch_array($query_count)){
							
							echo "<span class='count'>Atualmente existem  ".$sql_count['result']." Ordens de Serviço</span><br><br>";
						}
						
						
						
						
					 
					 ?>
            
            <hr>
            
            <div id="tbOs">
            </div>
			
            <form id="form" action="os_con_form.php" method="post" >

				<input type="hidden" id="altcodigo" name="altcodigo">

            </form>
		
    	</div>
	</body>
</html>