
<div class="box-content">
	<h2><i class="fas fa-pencil-alt"></i> Cadastrar Slides</h2>

	<form method="post" enctype="multipart/form-data">

		<?php 



			if(isset($_POST["acao"])){
				
				$nome = $_POST["nome"];		
				$imagem = $_FILES["imagem"];
				


				if($nome == ""){
					Painel::alertSucesso("erro", "O campo nome não pode ficar vazio!");
				}else{

					if(Painel::imagemValida($imagem) == false){
						Painel::alertSucesso("erro", "O formato espeficicado não está correto!");
					}else{
						
						include("../classes/lib/WideImage.php");
						$imagem = Painel::uploadFile($imagem);
						//WideImage::load('uploads/'.$imagem)->resize(100)->saveToFile('uploads/'.$imagem);
						$arr = ["nome" => $nome, "slide"=> $imagem, "order_id" => "0", "nome_tabela" => "tb_site.slides"];
						Painel::insert($arr);
						Painel::alertSucesso("sucesso", "O cadastro do slide foi realizado com sucesso");

					}
				}			
			}

		?>


		

		<div class="form-group">
			<label>Nome do slide:</label>
			<input type="text" name="nome">
		</div><!--form-group-->

		

		<div class="form-group">
			<label>Imagem:</label>
			<input type="file" name="imagem"/>
		</div><!--form-group-->

		<div class="form-group">
			<input type="submit" name="acao" value="Cadastrar!">
		</div><!--form-group-->

		
	</form>



</div><!--box-content-->