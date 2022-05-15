<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<style>
	body{
		font-family: arial;
	}
	section{
		background-color: rgb(123,104,238,.4);
		width: 70%;
		margin: auto;
	}
	input, label, textarea{
		display: block;
		width: 100%;
		height: 30px;
	}
	label{
		line-height: 30px;
		margin-top: 10px;
	}
	textarea{
		height: 150px;
	}
	form{
		
		width: 60%;
		margin: auto;
		box-sizing: border-box;
		padding: 20px;
	}
	#botao{
		margin-bottom: 10px;
		width: 50%;
		background-color: rgba(0,0,0,.8);
		color: white;
		height: 40px;
		cursor: pointer;
		border: none;
		font-size: 15pt;
	}
	h1{
		text-align: center;
	}
	#foto{
		margin-top: 20px;
		margin-bottom: 20px;
	}

	a{
		background-color: rgb(0,255,127);
		display: block;
		width: 220px;
		height: 50px;
		color: black;
		text-decoration: none;
		float: right;
		text-align: center;
		line-height: 50px;
		margin: 20px;
		border: 1px solid rgba(0,0,0,.2);
	}
	</style>
</head>
<body>
	<section>
	<a href="produtos.php">Ver todos os produtos</a>
	<form method="POST" enctype="multipart/form-data">
		<h1>ENVIO DE IMAGENS</h1>
		<label for="nome">Nome do Produto</label>
		<input type="text" name="nome" id="nome">
		<label for="des">Descrição</label>
		<textarea name="desc" id="desc"></textarea>
		<input type="file" name="foto[]" multiple id="foto">
		<input type="submit" id="botao">
	</form>
	</section>
</body>
</html>