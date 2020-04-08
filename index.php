<?php
if(isset($_POST['nome']) && !empty($_POST['nome'])){
	$nome = addslashes($_POST['nome']);
	$email = addslashes($_POST['email']);


	require 'config.php';
	$pdo->query("INSERT INTO usuarios SET nome = '$nome', email = '$email'");
	$id = $pdo->lastInsertId();

	$md5 = md5($id);
	$link = 'http://www.nome_do_dominio.com.br/cadastro_com_aprovacao/confirmar.php?h='.$md5;
//mensagem de email (estrutura)
	$assunto = "Confirme seu cadastro";
	$msg = "Clique no link abaixo para confirmar seu cadastro:\n\n".$link;
	$headers = "From: rodrigoviecheneski@gmail.com"."\r\n".
				"X-Mailer: PHP/".phpversion();
	mail($email, $assunto, $msg, $headers);

	echo "<h2>OK! Confirme seu cadastro agora!</h2>";
}
?>

<form method="POST">
	Nome:<br/>
	<input type="text" name="nome" /><br/><br/>

	Email:<br/>
	<input type="email" name="email" /><br/><br/>

	<input type="submit" value="Cadastrar" />
</form>