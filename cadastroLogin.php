<!DOCTYPE html>
<?php
$title="new Campus";
$m = new Mongo('localhost:27017');
$db = $m->Login;
$collection = $db->Login;
?>
<html>
<head>	
	<title>Cadastrar-se</title>
    <script src="js/jquery.js"></script>
    <script src="js/jquery.maskedinput-1.0.js"></script> 

	<script src="js/js.js"></script>
	<script>
		jQuery(function($){
        	$("#CPF").mask("999.999.999-99");
   		});
	</script>
</head>
<body>
	
		<form method="post" action="Opindex.php">
		<input type="Hidden" name="Id" id="Id" value="<?php foreach ($cursor as $entry){echo $Id;} ?>"/>
		<input type="hidden" name="codigo" id="codigo" value="<?php if($Id == ''){echo "0";}else{echo '1';} ?>"/>
		<table>
			<tr>
				<td>
					Nome completo
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="Nome" id="Nome" value="<?php foreach ($cursor as $entry){echo $entry['Nome'];} ?>" size="30%" required/>
				</td>
			</tr>
			<tr>
				<td>
					E-mail valido
				</td>
			</tr>
			<tr>
				<td>
					<input type="email" name="email" id="email" value="<?php foreach ($cursor as $entry){echo $entry['email'];} ?>" size="30%" required/>
				</td>
			</tr>
			<tr>
				<td>
					CPF
				</td>
			</tr>
			<tr>
				<td>
					<input type="text" name="CPF" ID="CPF" class="cpf" value="<?php foreach ($cursor as $entry){echo $entry['CPF'];} ?>" size="30%" maxlength="15"  required/>
				</td>
			</tr>
			<tr>
				<td>
					Senha
				</td>
			</tr>
			<tr>
				<td>
					<input type="password" name="Pass" id="Password" value="<?php foreach ($cursor as $entry){echo $entry['Password'];} ?>" size="30%" required/>
				</td>
			</tr>
			<tr>
				<td>
					Curso
				</td>
			</tr>
			<tr>
				<td>        
					<select name="Curso" id="Curso" class="select">
						<?php
							$m = new Mongo('localhost:27017');
							$db = $m->TC;
							$collection2 = $db->Curso;
							$Cursor = $collection2->find();
							foreach ($Cursor as $entry){
								echo '<option value="'. $entry['_id'].'"';
								if ($Id != '')
									echo ' selected';
								echo '>Curso: '.$entry['Curso'].', ';
								$collection3 = $db->Campus;
								$cursor2 = $collection3->find(array("_id" => new mongoId($entry['Campus'])));
								foreach ($cursor2 as $entry) {
									echo 'Campus: '.$entry['Campus'].'-'.$entry['Cidade'];
								}
								echo'</option>';
							}
						?>
					</select>
				</td>
			</tr>
		</table>
		<button name="acao" value="salvar" id="acao" type="submit">Salvar</button>
	</form>
</body>
</html>