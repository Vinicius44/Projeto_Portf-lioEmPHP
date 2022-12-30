
<?php

	$site = Painel::select("tb_site.config", false);

?>


<div class="box-content">
	<h2><i class="fas fa-pencil-alt"></i> Editar Configurações do Site</h2>

	<form method="post" enctype="multipart/form-data">

		<?php 

			if(isset($_POST["acao"])){
				
				if(Painel::update($_POST, true)){
					Painel::alertSucesso("sucesso", "O site foi editado com sucesso!");

					$site = Painel::select("tb_site.config", false);

				}else{
					Painel::alertSucesso("erro", "Campos vazios não são permitidos!");
				}	

				
				

				

			
			}

		?>


		

		<div class="form-group">
			<label>Titulo do site:</label>
			<input type="text" name="titulo"  value="<?php echo $site["titulo"]?>"/>
		</div><!--form-group-->

		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome"  value="<?php echo $site["nome"]?>"/>
		</div><!--form-group-->

		<div class="form-group">
			<label>Descrição do autor do site:</label>
			<textarea><?php echo $site["descricao"]?></textarea>
		</div><!--form-group-->

		<div class="form-group">
			<label>Icone 1:</label>
			<input type="text" name="icone1"  value="<?php echo $site["icone1"]?>"/>
		</div><!--form-group-->

		<div class="form-group">
			<label>Descrição do icone 1:</label>
			<textarea name="descricao1"><?php echo $site["descricao1"]?></textarea>
		</div><!--form-group-->

		<div class="form-group">
			<label>Icone 2:</label>
			<input type="text" name="icone2"  value="<?php echo $site["icone2"]?>"/>
		</div><!--form-group-->

		<div class="form-group">
			<label>Descrição do icone 2:</label>
			<textarea name="descricao2"><?php echo $site["descricao2"]?></textarea>
		</div><!--form-group-->

		<div class="form-group">
			<label>Icone 3:</label>
			<input type="text" name="icone3"  value="<?php echo $site["icone3"]?>"/>
		</div><!--form-group-->

		<div class="form-group">
			<label>Descrição do icone 3:</label>
			<textarea name="descricao3"><?php echo $site["descricao3"]?></textarea>
		</div><!--form-group-->




		
		<div class="form-group">
			
			<input type="hidden" name="nome_tabela" value="tb_site.config" />
			<input type="submit" name="acao" value="Atualizar">
		</div><!--form-group-->

		
	</form>



</div><!--box-content-->
