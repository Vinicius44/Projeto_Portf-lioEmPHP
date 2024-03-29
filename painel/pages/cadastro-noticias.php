
<div class="box-content">
	<h2><i class="fas fa-pencil-alt"></i> Cadastrar Notícias</h2>

	<form method="post" enctype="multipart/form-data">

		<?php 



			if(isset($_POST["acao"])){
				
				$categoria_id = $_POST["categoria_id"];
				$titulo = $_POST["titulo"];		
				$conteudo = $_POST["conteudo"];
				$capa = $_FILES["capa"];
				

				if($titulo == "" || $conteudo == ""){
					Painel::alertSucesso("erro", "Campos Vázios não são permitidos");
				}else if($capa["tmp_name"] == ""){
					Painel::alertSucesso("erro", "A imagem de capa precisa ser selecionada.");
				}else{
					if(Painel::imagemValida($capa)){
						$verifica = Mysql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE titulo=? AND categoria_id = ?");
						$verifica->execute(array($titulo, $categoria_id));
						if($verifica->rowCount() == 0){
							$imagem = Painel::uploadFile($capa);
							$slug = Painel::generateSlug($titulo);
							$arr = ["categoria_id"=> $categoria_id, "data" =>date("Y-m-d"), "titulo"=> $titulo, "conteudo" => $conteudo, "capa" => $imagem, "slug" => $slug, "order_id" => 0, "nome_tabela" => "tb_site.noticias"
							];

							if(Painel::insert($arr)){
								Painel::redirect(INCLUDE_PATH_PAINEL."cadastro-noticias?sucesso");
								
							}
						}else{
							Painel::alertSucesso("erro", "Já existe uma notícia com esse titulo e categoria!");
						}


					}else{
						Painel::alertSucesso("erro","Selecione uma imagem válida.");
					}
					
				}
				


					
			}
			if(isset($_GET["sucesso"]) && !isset($_POST["acao"])){
				Painel::alertSucesso("sucesso", "O cadastro foi realizado com sucesso!");
			}

		?>

		<div class="form-group">
		<label>Categoria:</label>
		<select name="categoria_id">
			
				<?php
					$categorias = Painel::selectAll("tb_site.categorias");
					foreach ($categorias as $key => $value){

					
				?>
			<option <?php if ($value["id"] == @$_POST["categoria_id"]) echo "selected" ?> value="<?php echo $value["id"]?>"><?php echo $value["nome"] ?></option>

				<?php 

					}

				?>
		</select>
	</div>
		<div class="form-group">
			<label>Titulo:</label>
			<input type="text" name="titulo" value="<?php recoverPost("titulo");?>">
		</div><!--form-group-->

		<div class="form-group">
			<label>Conteúdo:</label>
			<textarea class="tinymce" name="conteudo"><?php recoverPost("conteudo");?></textarea>
		</div><!--form-group-->

		<div class="form-group">
			<label>Imagem:</label>
			<input type="file" name="capa"/>
		</div><!--form-group-->

		<div class="form-group">
			<input type="hidden" name="order_id" value="0">
			<input type="hidden" name="nome_tabela" value="tb_site.noticias" />
			<input type="submit" name="acao" value="Cadastrar!">
		</div><!--form-group-->

		
	</form>



</div><!--box-content-->