<div class="box-content">
	<h2><i class="fas fa-pencil-alt"></i> Editar Usuário</h2>

	<form method="post" enctype="multipart/form-data">

		<?php 

			if(isset($_POST["acao"])){
				
				$nome = $_POST["nome"];
				$password = $_POST["password"];
				$imagem = $_FILES["imagem"];
				$imagem_atual = $_POST["imagem_atual"];
				
				if($imagem["name"] != ""){
					if(Painel::imagemValida($imagem)){
						$imagem = Painel::uploadFile($imagem);
						if($usuario->atualizarUsuario($nome, $password, $imagem)){
							Painel::alertSucesso("sucesso", "Atualizado com sucesso!");
						}else{
							Painel::alertSucesso("erro", "Ocorreu um erro ao atualizar...");
						}
					}	
				}else{
					$imagem = $imagem_atual;
					$usuario = new Usuario();
					if($usuario->atualizarUsuario($nome, $password, $imagem)){
						Painel::alertSucesso("sucesso", "Atualizado com sucesso!");
					}else{
						Painel::alertSucesso("erro", "Ocorreu um erro ao atualizar...");
					}
				}
			}

		?>


		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome" required="" value="<?php echo $_SESSION["nome"]; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Senha:</label>
			<input type="password" name="password" required="" value="<?php echo $_SESSION["password"]; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Imagem:</label>
			<input type="file" name="imagem"/>
			<input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img']; ?>">
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

		
	</form>



</div><!--box-content-->