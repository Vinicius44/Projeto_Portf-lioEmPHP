



<div class="box-content">
	<h2><i class="fas fa-pencil-alt"></i> Adicionar Serviço</h2>

	<form method="post" enctype="multipart/form-data">

		<?php 

			if(isset($_POST["acao"])){
				
				if(Painel::insert($_POST)){

					Painel::alertSucesso("sucesso", "O cadastro do serviço foi realizado com sucesso!");
				}else{
					Painel::alertSucesso("erro", "Campos vazios não são permitidos.");
				}

				

			
			}

		?>


		

		<div class="form-group">
			<label>Descreva o serviço:</label>
			<textarea name="servico"></textarea>
		</div><!--form-group-->

		

		
		<div class="form-group">
			<input type="hidden" name="order_id" value="0">
			<input type="hidden" name="nome_tabela" value="tb_site.servicos" />
			<input type="submit" name="acao" value="Cadastrar">
		</div><!--form-group-->

		
	</form>



</div><!--box-content-->
