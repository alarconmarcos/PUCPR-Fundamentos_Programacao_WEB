<?php
	session_start();
	include('includes/conexao.php');

	if(empty($_POST['email']) || empty($_POST['senha'])) {
		header('Location: index.php');
		exit();
	}

	$email = mysqli_real_escape_string($conexao, $_POST['email']);
	$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

	$sql = "select * from usuarios where email = '{$email}' and senha = md5('{$senha}')";

	$resultado = mysqli_query($conexao, $sql) or die("Erro ao conectar");

	while ($registro = mysqli_fetch_assoc($resultado)) 
	{
		$usuario = $registro['nome'];
		$adm = $registro['adm'];
		$id = $registro['id'];

	}

	$row = mysqli_num_rows($resultado);


	if($row == 1) {
		$_SESSION['usuario'] = $usuario;
		$_SESSION['adm'] = $adm;
		$_SESSION['id'] = $id;
		header('Location: rel_emprestimos.php');
		exit();
	} else {
		$_SESSION['nao_autenticado'] = true;
		header('Location: index.php');
		exit();
	}
?>