<?php
	$m = new MongoClient('localhost:27017');
	$db = $m->TC;
	$collection = $db->Professor;
    include '../class/classProfessor.php';
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
		$collection = $db->Professor;
		
		$Professor = new DadosProfessor();
        $Professor->setProfessor($_POST["Professor"]);
        $Professor->setFormacao($_POST["Formacao"]);
        $Professor->setCurso($_POST["Curso"]);
		$Professor->setId($_POST["Id"]);

		$document = array( 
			"Professor" => $Professor->getProfessor(),
			"Formacao" => $Professor->getFormacao(),
			"Curso" =>$Professor->getCurso()
		);

		$collection->insert($document);
		header("location:../menu/Professor.php?");
		$m->close();
	}
	function Excluir(){
		$m = new MongoClient('localhost:27017');
		$db = $m->TC;
		$collection = $db->Professor;

		$Id = '';
		$cursor2 = '';
		$Professor = new DadosProfessor();
		$Professor->setId($_GET["Id"]);
		$cursor2 = $collection->findOne(array("_id" => new MongoId($Professor->getId())));
		
		$collection->remove($cursor2);
		header("location:../menu/listProfessor.php?");
		$m->close();
	}
	function alterar(){

		$Professor = new DadosProfessor();
        $Professor->setProfessor($_POST["Professor"]);
        $Professor->setFormacao($_POST["Formacao"]);
        $Professor->setCurso($_POST["Curso"]);
		$Professor->setId($_POST["Id"]);

		$document = array( 
			"Professor" => $Professor->getProfessor(),
			"Formacao" => $Professor->getFormacao(),
			"Curso" =>$Professor->getCurso()
		);
		$id=array(
			"_id" => new MongoId($Professor->getId())
		);

		$collection->update($Id, $document);
		header("location:../menu/listProfessor.php?");
		$m->close();
	}

?>
