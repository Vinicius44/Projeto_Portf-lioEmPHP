<?php

	verificaPermissaoPagina(2);


?>



<div class="box-content">
	<h2><i class="fas fa-pencil-alt"></i> Adicionar Usuário</h2>

	<form method="post" enctype="multipart/form-data">

		<?php 

			if(isset($_POST["acao"])){
				$login = $_POST["login"];
				$nome = $_POST["nome"];
				$password = $_POST["password"];
				$imagem = $_FILES["imagem"];
				$cargo = $_POST["cargo"];


				if($login == ""){
					Painel::alertSucesso("erro", "O login está vazio!");
				}else if($nome == ''){
					Painel::alertSucesso("erro", "O nome está vazio!");
				}else if($password == ""){
					Painel::alertSucesso("erro", "A senha está vazia!");
				}else if($cargo == ""){
					Painel::alertSucesso("erro", "O cargo precisa estar selecionado!");
				}else if($imagem == ""){
					Painel::alertSucesso("erro", "A imagem precisa estar selecionada!");
				}else{

					if($cargo >= $_SESSION['cargo']){
						Painel::alertSucesso("erro", "Você precisa solucionar um cargo menor que o seu!");
					}else if(Painel::imagemValida($imagem) == false){
						Painel::alertSucesso("erro", "O formato espeficicado não está correto!");
					}else if(Usuario::userExits($login)){
						Painel::alertSucesso("erro","O login já existe, selecione outro por favor!");

					}else{
						$usuario = new Usuario();
						$imagem = Painel::uploadFile($imagem);
						$usuario->cadastrarUsuario($login, $password, $imagem, $nome, $cargo);
						Painel::alertSucesso("sucesso", "O cadastro do usuário ".$login." foi feito com sucesso!");

					}
				}


				

				

			
			}

		?>


		<div class="form-group">
			<label>Login:</label>
			<input type="text" name="login">
		</div><!--form-group-->

		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome">
		</div><!--form-group-->

		<div class="form-group">
			<label>Senha:</label>
			<input type="password" name="password">
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
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="acao" value="Atualizar!">
		</div><!--form-group-->

		
	</form>



</div><!--box-content-->