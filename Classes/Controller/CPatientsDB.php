<?php 

/*require_once "./Classes/View/VClinica.php";
require_once "./Classes/Entity/EPerson.php";
require_once "./Classes/Foundation/FDatabase.php";
require_once "./Classes/Utility/Updf.php";
//require_once "./Libs/fpdf/fpdf.php";*/


class CPatientsDB{

	private $patientsArray=array();

	private $rowPatient;

	public function __construct(){/*
		$view=Usingleton::getInstance('VClinica');
		$this->fillArray();
		//$view->display('Database_home.tpl');

		$action=$view->get('action');
		switch($action) {

			case 'insert':
			$this->insertPatient();
			break;

			case 'search':
			$this->searchPatient();
			break;

			case 'getFullData':
			$this->showPatientDetails();
			break;

			case 'printReport':
			$this->printReport();
			break;

			case 'modify':
			$this->modifyPatient();
			break;

			case 'delete':
			$this->deletePatient();
			break;

			default:
			$this->showAllPatients();
		}*/

	}

	public function setHomePatients(){
echo "iyg";
		$view=Usingleton::getInstance('VClinica');
		$this->fillArray();
		//$view->display('Database_home.tpl');

		$action=$view->get('action');
		switch($action) {

			case 'insert':
			$this->insertPatient();
			break;

			case 'search':
			$this->searchPatient();
			break;

			case 'getFullData':
			$this->showPatientDetails();
			break;

			case 'printReport':
			$this->printReport();
			break;

			case 'modify':
			$this->modifyPatient();
			break;

			case 'delete':
			$this->deletePatient();
			break;

			default:
			//$this->showAllPatients();
                            echo "subvr";
	}
        }

	private function insertPatient(){
		$view=Usingleton::getInstance('VClinica');
		if($view->get('gender')==null){ //controllo da fare co JavaScript
			$view->display('addPatient.tpl');
		}
		else {
			//var_dump($_REQUEST);
			$db=USingleton::getInstance('FDatabase');
			$query1="INSERT INTO `clinica`.`pazienti`(`Nome`, `Cognome`, `Sesso`, `DataNascita`, `Codice Fiscale`, `DataVisita`, `Anamnesi`, `Esame Obiettivo`, `Conclusione`, `Prescrizione Esami`, `Terapia`, `Controllo`)";
			//INSERT INTO `pazienti`(`Nome`, `Cognome`, `Sesso`, `DataNascita`, `Codice Fiscale`, `DataVisita`, `Anamnesi`, `Esame Obiettivo`, `Conclusione`, `Prescrizione Esami`, `Terapia`, `Controllo`)
			$query2="VALUES ('".$_REQUEST['name']."','".$_REQUEST['surname']."','".$_REQUEST['gender']."','".$_REQUEST['dateBirth']."','".$_REQUEST['CF']."','".$_REQUEST['dateCheck']."','".$_REQUEST['medHistory']."','".$_REQUEST['medExam']."','".$_REQUEST['conclusions']."','".$_REQUEST['toDoExams']."','".$_REQUEST['terapy']."','".$_REQUEST['checkup']."')";
			$query=$query1." ".$query2;
			$db->queryDb($query);
			echo "inserimento completato con successo <br>";
			echo "<a href='index.php?controllerAction=manageDB'>torna alla home</a>";
		}
	
	}

	private function searchPatient(){
		$view=Usingleton::getInstance('VClinica');
		if($view->get('keyValue')==null){
			$view->display('searchPatient.tpl');
		}
		else {
			$db=USingleton::getInstance('FDatabase');
			$searchKey=$view->get('keyValue');
			//SELECT * FROM `pazienti` WHERE `Nome`="Giulio" or `Cognome`="Giulio" or `Codice Fiscale`="Giulio"
			$query="SELECT `Nome`,`Cognome`,`Codice Fiscale` FROM `pazienti` WHERE `Nome`='".$searchKey."' or `Cognome`='".$searchKey."' or `Codice Fiscale`='".$searchKey."'"; //aggiungere caso cognome e CF
			$result=$db->queryDbSelect($query);

			$numRows=0;
			$results=array();
			while ( $row=$result->fetch_assoc() ){
				
				$results[$numRows]=array('name'=>$row['Nome'],'surname'=>$row['Cognome'],'cf'=>$row['Codice Fiscale'],'link'=>md5($row['Codice Fiscale']));
				$numRows++;

				}
			if ( $numRows!=0 ) {
				$mess="la ricerca ha prodotto ".$numRows." risultato/i";
				$view->assign('numResults',$numRows);
				$view->assign('rows',$results);
				$link1="index.php?controllerAction=manageDB&action=getFullData&show=";
				$view->assign('part1',$link1);
			}

	        else {
	        	$mess="La ricerca non ha prodotto nessun risultato";
	        	$view->assign('numResults',$numRows);
	        }
	        $view->assign('message',$mess);
	        $view->display('resultSearch.tpl');
	    }
	}

	private function showPatientDetails(){
		$view=Usingleton::getInstance('VClinica');
		$db=Usingleton::getInstance('FDatabase');
		$cf=$view->get('show'); //$cf è md5(codice fiscale) del paziente di cui si vogliono mostrare tutti i dati
		$query="SELECT `Codice Fiscale` FROM `pazienti`";
		$result=$db->queryDbSelect($query);

		while ( $row=$result->fetch_assoc() ){
				
				//$link2[$numRows]=array(md5($Patients[$numRows]['cf']));
				$codFisc=$row['Codice Fiscale'];
				if ( md5($codFisc)==$cf ) {
					$cfPatient=$codFisc;
				}
		}

		$query="SELECT * FROM `pazienti` WHERE `Codice Fiscale`='".$cfPatient."'";
		$result=$db->queryDbSelect($query);

		while ( $row=$result->fetch_assoc() ){ //stampare tutti i dati del paziente
				
				$name=$row['Nome'];
				$surname=$row['Cognome'];
				$gender=$row['Sesso'];
				$dateBirth=$row['DataNascita'];
				$CF=$row['Codice Fiscale'];
				$dateCheck=$row['DataVisita'];
				$medHistory=$row['Anamnesi'];
				$medExam=$row['Esame Obiettivo'];
				$conclusions=$row['Conclusione'];
				$toDoExams=$row['Prescrizione Esami'];
				$terapy=$row['Terapia'];
				$checkup=$row['Controllo'];
		}

		$view->assign('name',$name);
		$view->assign('surname',$surname);
		$view->assign('gender',$gender);
		$view->assign('dateBirth',$dateBirth);
		$view->assign('CF',$CF);
		$view->assign('dateCheck',$dateCheck);
		$view->assign('medHistory',$medHistory);
		$view->assign('medExam',$medExam);
		$view->assign('conclusions',$conclusions);
		$view->assign('toDoExams',$toDoExams);
		$view->assign('terapy',$terapy);
		$view->assign('checkup',$checkup);
		$view->assign('link',md5($CF));
		$view->display('patientDetail.tpl');
	}


	private function showAllPatients(){
		$db=USingleton::getInstance('FDatabase');
		$view=Usingleton::getInstance('VClinica');
		$query="SELECT `Nome`,`Cognome`,`Codice Fiscale` FROM `pazienti`";
		$result=$db->queryDbSelect($query);
		$link1="index.php?controllerAction=manageDB&action=getFullData&show=";
		$numRows=0;

		while ( $row=$result->fetch_assoc() ){
				
				//$link2[$numRows]=array(md5($Patients[$numRows]['cf']));
				$Patients[$numRows]=array('name'=>$row['Nome'],'surname'=>$row['Cognome'],'cf'=>$row['Codice Fiscale'],'link'=>md5($row['Codice Fiscale']));
				$numRows++;
				}

		$view->assign('rows',$Patients);
		$view->assign('part1',$link1);
		$view->display('Database_home.tpl');
	}



	private function printReport(){
		$view=USingleton::getInstance('VClinica');

		for ($i=0;$i<count($this->getPatientsArray());$i++) {
				if( md5($this->getPatientsArray()[$i]['cf'])==$view->get('pat') ) {
					$cfPatient=$this->getPatientsArray()[$i]['cf'];
					$row=$i;
				}
			}

		if ( $view->get('fields')=="sent" ){

				$pdf=USingleton::getInstance('Updf');
				//$patInfo=$this->getPatientsArray()[$row]['name']." ".$this->getPatientsArray()[$row]['surname'].", ".$this->getPatientsArray()[$row]['cf'].", ".$this->getPatientsArray()[$row]['dateBirth'];
				$patArray=$this->getPatientsArray()[$row];
				$patInfo=$patArray['name']." ".$patArray['surname'].", ".$patArray['dateBirth']." \n".$patArray['cf'];
				$arrayToPrint=array();

				foreach ($patArray as $key=>$value) {
					if ( $view->get($key) ) {
						$arrayPrint[$key]=$value;
					}
				}

				$pdf->printPage($patInfo,$arrayPrint);



				//$pdf=new FPDF();
				/*$string1="ASL 01 - Avezzano-Sulmona-L'Aquila \n P.O. San Salvatore - L'Aquila \n U.O.C. Pneumologia \n Dott. Paolo Carducci";
				$pdf->SetTitle($string1);
				$pdf->Addpage();
				$pdf->printField("anamnesi",$this->getPatientsArray()[$row]['medHistory']);*/
				/*
				$pdf->Addpage();
				//header
				$pdf->SetFont('Arial','',11);
				$string1="ASL 01 - Avezzano-Sulmona-L'Aquila \n P.O. San Salvatore - L'Aquila \n U.O.C. Pneumologia \n Dott. Paolo Carducci";
				//$string2="ANAMNESI \n ".$this->getPatientsArray()[$row]['medHistory'];
				$pdf->MultiCell(0,5,$string1,0,'C');
				$pdf->Ln(10);
				//patient info
				$pdf->Cell(0,5,$this->getPatientsArray()[$row]['name']." ".$this->getPatientsArray()[$row]['surname'].", ".$this->getPatientsArray()[$row]['cf'].", ".$this->getPatientsArray()[$row]['dateBirth'],0,1);
				$pdf->Ln(10);
				//fields

				$pdf->Ln(5);
				$pdf->SetFont('Arial','B',11);
				$pdf->Write(5,"ANAMNESI");
				$pdf->Ln(5);
				$pdf->SetFont('Arial','',11);
				$pdf->Write(5,$this->getPatientsArray()[$row]['medHistory']);
				$pdf->Ln(10);

				$pdf->Ln(5);
				$pdf->SetFont('Arial','B',11);
				$pdf->Write(5,"ESAME OBIETTIVO");
				$pdf->Ln(5);
				$pdf->SetFont('Arial','',11);
				$pdf->Write(5,$this->getPatientsArray()[$row]['medExam']);
				$pdf->Ln(10);

				$pdf->Ln(5);
				$pdf->SetFont('Arial','B',11);
				$pdf->Write(5,"CONCLUSIONE");
				$pdf->Ln(5);
				$pdf->SetFont('Arial','',11);
				$pdf->Write(5,$this->getPatientsArray()[$row]['conclusions']);
				$pdf->Ln(10);

				$pdf->Ln(5);
				$pdf->SetFont('Arial','B',11);
				$pdf->Write(5,"PRESCRIZIONE ESAMI");
				$pdf->Ln(5);
				$pdf->SetFont('Arial','',11);
				$pdf->Write(5,$this->getPatientsArray()[$row]['toDoExams']);
				$pdf->Ln(10);

				$pdf->Ln(5);
				$pdf->SetFont('Arial','B',11);
				$pdf->Write(5,"TERAPIA");
				$pdf->Ln(5);
				$pdf->SetFont('Arial','',11);
				$pdf->Write(5,$this->getPatientsArray()[$row]['terapy']);
				$pdf->Ln(10);

				$pdf->Ln(5);
				$pdf->SetFont('Arial','B',11);
				$pdf->Write(5,"CONTROLLO");
				$pdf->Ln(5);
				$pdf->SetFont('Arial','',11);
				$pdf->Write(5,$this->getPatientsArray()[$row]['checkup']);
				$pdf->Ln(10);*/

				//$pdf->Output();
		}
		else {
			$view->assign('link',md5($this->getPatientsArray()[$row]['cf']));
			$view->display('reportFields.tpl');			
		}
	}


	private function modifyPatient() {
		$view=USingleton::getInstance('VClinica');
		if ( $view->get('mod')!="completed" ) {
			for ($i=0;$i<count($this->getPatientsArray());$i++) { //usare while ?
				if (md5($this->getPatientsArray()[$i]['cf'])==$view->get('mod')) {
					//$view->assign('dateCheck',$this->getPatientsArray()[$i]['dateCheck']);
					//$this->setRowPatient($i);
					$view->assign('name',$this->getPatientsArray()[$i]['name']);
					$view->assign('surname',$this->getPatientsArray()[$i]['surname']);
					if (strtoupper($this->getPatientsArray()[$i]['gender'])=="M") {
						$view->assign('checkedM',"checked");
						$view->assign('checkedF',"");
					}
					else {
						$view->assign('checkedF',"checked");
						$view->assign('checkedM',"");				
					}
					$view->assign('dateBirth',$this->getPatientsArray()[$i]['dateBirth']);
					$view->assign('cf',$this->getPatientsArray()[$i]['cf']);
					$view->assign('medHistory',$this->getPatientsArray()[$i]['medHistory']);
					$view->assign('medExam',$this->getPatientsArray()[$i]['medExam']);
					$view->assign('conclusions',$this->getPatientsArray()[$i]['conclusions']);
					$view->assign('toDoExams',$this->getPatientsArray()[$i]['toDoExams']);
					$view->assign('terapy',$this->getPatientsArray()[$i]['terapy']);
					$view->assign('checkup',$this->getPatientsArray()[$i]['checkup']);
					$view->assign('link',md5($this->getPatientsArray()[$i]['cf']));
					$view->display('modifyPatient.tpl');
				}
			}
		}
		else {
			//$row=1; //non riesco ad accedere al valore di rowPatient impostato nel caso if
			//$cfPatient=$this->getPatientsArray()[$row]['cf'];
			$cfCryp=$view->get('pat');
			for ($i=0;$i<count($this->getPatientsArray());$i++) {
				if (md5($this->getPatientsArray()[$i]['cf'])==$cfCryp) {
					$cfPatient=$this->getPatientsArray()[$i]['cf'];
				}
			}
			$db=Usingleton::getInstance('FDatabase');
			$query="UPDATE `pazienti` SET `Nome`='".$view->get('name')."',`Cognome`='".$view->get('surname')."',`Sesso`='".$view->get('gender')."',`DataNascita`='".$view->get('dateBirth')."',`DataVisita`='".$view->get('dateCheck')."',`Anamnesi`='".$view->get('medHistory')."',`Esame Obiettivo`='".$view->get('medExam')."',`Conclusione`='".$view->get('conclusions')."',`Prescrizione Esami`='".$view->get('toDoExams')."',`Terapia`='".$view->get('terapy')."',`Controllo`='".$view->get('checkup')."' WHERE `Codice Fiscale`='".$cfPatient."' ";
			$db->query($query);
			echo "modifica completata con successo <br>";
			echo "<a href='index.php?controllerAction=manageDB'>torna alla home</a>";
		}
	}

	private function deletePatient(){
		$view=USingleton::getInstance('VClinica');
		$db=USingleton::getInstance('FDatabase');

		for ($i=0;$i<count($this->getPatientsArray());$i++) {
				if( md5($this->getPatientsArray()[$i]['cf'])==$view->get('pat') ) {
					$cfPatient=$this->getPatientsArray()[$i]['cf'];
				}
			}
			$query="DELETE FROM `pazienti` WHERE `Codice Fiscale`='".$cfPatient."'";
			$db->query($query);
			echo "eliminazione completata con successo <br>";
			echo "<a href='index.php?controllerAction=manageDB'>torna alla home</a>";	

		}

	private function fillArray(){
		$db=Usingleton::getInstance('FDatabase');
		$query="SELECT * FROM `pazienti`";
		$result=$db->queryDbSelect($query);
		while ( $row=$result->fetch_assoc() ){
			$this->patientsArray[]=array('name'=>$row['Nome'],
				                         'surname'=>$row['Cognome'],
				                         'gender'=>$row['Sesso'],
				                         'dateBirth'=>$row['DataNascita'],
				                         'cf'=>$row['Codice Fiscale'],
				                         'dateCheck'=>$row['DataVisita'],
				                         'medHistory'=>$row['Anamnesi'],
				                         'medExam'=>$row['Esame Obiettivo'],
				                         'conclusions'=>$row['Conclusione'],
				                         'toDoExams'=>$row['Prescrizione Esami'],
				                         'terapy'=>$row['Terapia'],
				                         'checkup'=>$row['Controllo']);
				}
		}

	private function getPatientsArray(){
		return $this->patientsArray;
	}

	private function getRowPatient(){
		return $this->rowPatient;
	}

	private function setRowPatient($value){
		$this->rowPatient=$value;
	}


// da scrivere su una classe esterna

	function PrintField($title, $string){
		$this->FieldTitle($title);
		$this->FieldBody($string);
	}

	function FieldTitle($title){
	    // Arial 11
		$this->SetFont('Arial','B',11);
		// Title
		$this->Cell(0,5,$title,1,1,'L');
		// Line break
		$this->Ln(5);
	}

    function FieldBody($string){
        // Times 12
        $this->SetFont('Arial','',11);
        // Output justified text
        $this->MultiCell(0,5,$string);
        // Line break
        $this->Ln();
    }


}




