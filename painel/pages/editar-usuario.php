<div class="box-content">
	<h2><i class="fas fa-pencil-alt"></i> Editar Usuário</h2>

	<form method="post" enctype="multipart/form-data">

		<?php 

			if(isset($_POST["acao"])){
				
				$nome = $_POST["nome"];
				$password = $_POST["password"];
				$imagem = $_FILES["imagem"];
				$imagem_atual = $_POST["imagem_atual"];
				$usuario = new Usuario();

				if($imagem["name"] != ""){
					if(Painel::imagemValida($imagem)){
						Painel::deleteFile($imagem_atual);
						$imagem = Painel::uploadFile($imagem);
						if($usuario->atualizarUsuario($nome, $password, $imagem)){
							
							Painel::alertSucesso("sucesso", "Atualizado com sucesso junto com a imagem!");
							$_SESSION['img'] = $imagem;
							$_SESSION["nome"] = $nome;
							$_SESSION["password"] = $password;
						
						}else{
							Painel::alertSucesso("erro", "Ocorreu um erro ao atualizar junto com a imagem.");
						}
					}else{
						Painel::alertSucesso("erro"," O formato da imagem não é valido.");
					}	
				}else{
					$imagem = $imagem_atual;
					if($usuario->atualizarUsuario($nome, $password, $imagem)){
						Painel::alertSucesso("sucesso", "Atualizado com sucesso!");
						$_SESSION["nome"] = $nome;
						$_SESSION["password"] = $password;
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
			<label>Cargo</label>
			<select name="cargo">
				<?php

					foreach (Painel::$cargos as $key => $value){
						if($key < $_SESSION['cargo']){
							echo '<option value="'.$key.'">'.$value."</option>";
						}
					}


				?>
			</select>
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