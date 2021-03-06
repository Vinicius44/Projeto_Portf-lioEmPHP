<!DOCTYPE html>
<html>
<head>
	<title>Painel de controle</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--Fonts-->
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
	<!------>

	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/style.css">
	<link href="<?php echo INCLUDE_PATH;?>estilo/all.css" rel="stylesheet">
</head>
<body>

	<div class="box-login">
		<?php 
			if(isset($_POST["acao"])){
				$user = $_POST["user"];
				$password = $_POST["password"];
				$sql = Mysql::conectar()->prepare("SELECT * FROM  `tb_admin.usuarios` WHERE user = ? AND password = ?");
				$sql->execute(array($user,$password));
				if($sql->rowCount() == 1){
					//logamos 
					$info = $sql->fetch();
					$_SESSION["login"] = true;
					$_SESSION["user"] = $user;
					$_SESSION["password"] = $password;
					$_SESSION["cargo"] = $info["cargo"];
					$_SESSION["nome"] =  $info["nome"]; 
					$_SESSION["img"] = $info["img"];
					header("Location: ".INCLUDE_PATH_PAINEL);
					die();
				}else{
					//falhou
					echo '<div class="erro-box"><i class="fa fa-times"></i> Usuario ou senha incorreta</div>';
				}
			}

			

		?>
		<h2>Efetue o login:</h2>
		<form method="post">
			<input type="text" name="user" placeholder="Login" required="">
			<input type="password" name="password" placeholder="Senha" required="">
			<input type="submit" name="acao" value="Logar">
		</form>
	</div><!--box-login-->

</body>
</html>