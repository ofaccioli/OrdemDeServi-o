﻿<?php
	session_start();
	include("config/banco.php");
	
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
        <link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
		<title>Setores</title>
	</head>

	<body>
    
    <?php
		
		 $cod = $_POST['selset'];
		 
		 foreach( $cod as $remove_item ){

			   
				
				$sql = "delete from Setor where Cod_setor = ".$remove_item;
				
				$query = mysqli_query($conexao, $sql);
				

		}
		 		 

		
	?>
    
    <div id="conteudo">
	
    	<h1>Os setores selecionados foram deletados com sucesso </h1>
        
        <h3>O que deseja fazer agora?</h3>
        
        <br><hr><br>
        
        <table class="tbprincipal">
        	<tr>
            	<td><a href="principal.php"><img src="img/home.png"></a></td>
                <td><a href="principal.php">Página Principal</a></td>
            </tr>
            <tr>
            	<td><a href="emp_exc.php"><img src="img/delete_0.png"></a></td>
                <td><a href="emp_exc.php">Excluir outro setor</a></td>
            </tr>
        </table>
        
       
        
       <a href='logout.php'><img class='sair' src='img/sair.png'></a><br>
       
       <hr color="#EEE9E9">

    </div>
    
	</body>
</html>