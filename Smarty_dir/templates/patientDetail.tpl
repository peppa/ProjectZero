<!DOCTYPE HTML>
<html>
	<head>
		<title>Scheda paziente</title>
	</head>

	<body>
		<br>
		Scheda del paziente {$name} {$surname}
		<br>
		<br>

		<form method="POST">

			<div>

		Nome: {$name}
		<br>
		Cognome: {$surname}
		<br>
		Sesso: {$gender}
		<br>
		DataNascita: {$dateBirth}
		<br>
		Codice Fiscale: {$CF}
		<br>
		Data Visita: {$dateCheck}
		<br>
		Anamnesi: {$medHistory}
		<br>
		Esame Obiettivo: {$medExam}
		<br>
		Conclusione: {$conclusions}
		<br>
		Prescrizione Esami: {$toDoExams}
		<br>
		Terapia: {$terapy}
		<br>
		Controllo: {$checkup}

	</div>

	<br>
	<br>


		<button type="submit" formaction="index.php?controllerAction=manageDB&action=modify&mod={$link}">modifica</button>
		<button type="submit" formaction="index.php?controllerAction=manageDB&action=printReport">stampa report</button>
	</form>
