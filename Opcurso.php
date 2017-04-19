<?php
	$m = new MongoClient('localhost:27017');
		$db = $m->TC;
		$collection = $db->Curso;
    require_once '../class/classCurso.php';

	$acao = '';
    if (isset($_GET["acao"]))
        $acao = $_GET["acao"];
    if ($acao == "Excluir"){
        Excluir();
    }else{
        if (isset($_POST["acao"])){
            $acao = $_POST["acao"];
            if ($acao == "salvar"){
                $codigo = 0;
                if (isset($_POST["codigo"])){
                    $codigo = $_POST["codigo"];
                    if ($codigo == 0)
                    inserir();
                    else
                    alterar();
                }
            }
        }
    }
	function inserir(){
		$m = new MongoClient('localhost:27017');
		$db = $m->TC;
		$collection = $db->Curso;

		$Curso = new DadosCurso();
        $Curso->setCurso($_POST["Curso"]);
        $Curso->setCampus($_POST["Campus"]);
        $Curso->setTurma($_POST["Turma"]);

		$document = array(
			"Curso" => $Curso->getCurso(),
			"Turma" => $Curso->getTurma(),	
			"Campus"=> $Curso->getCampus()
		);

		$collection->insert($document);
		header("location:../menu/Curso.php?");
		$m->close();
	}
	function Excluir(){
		$m = new MongoClient('localhost:27017');
		$db = $m->TC;
		$collection = $db->Curso;
		
		$Id = '';
		$cursor2 = '';
		$Curso = new DadosCurso();
		$Curso->setId($_GET["Id"]);
		$cursor2 = $collection->findOne(array("_id" => new MongoId($Curso->getId())));
		
		$collection->remove($cursor2);
		header("location:../menu/listCurso.php?");
		$m->close();
	}
	function alterar(){

		$Curso = new DadosCurso();
        $Curso->setCurso($_POST["Curso"]);
        $Curso->setCampus($_POST["Campus"]);
        $Curso->setTurma($_POST["Turma"]);
		$Curso->setId($_POST["Id"]);

		$document = array( 
			"Curso" => $Curso->getCurso(),
			"Turma" => $Curso->getTurma(),
			"Campus" =>$Curso->getCampus()
		);
		$id=array(
			"_id" => new MongoId($Curso->getId())
		);

		$collection->update($id,$document);
		header("location:../menu/listCurso.php?");
		$m->close();
	}

?>
