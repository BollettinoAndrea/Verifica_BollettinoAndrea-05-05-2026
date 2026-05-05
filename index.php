<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "bollettino_gym";

$istanza = new mysqli($host, $user, $pass, $db);

f ($istanza->connect_error) {
    die("Database non raggiungibile.");
}

$notifica = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = $_POST['task'] ?? '';
    
    if ($task === 'nuovo_membro') {
        $id_membro = $istanza->real_escape_string($_POST['id_membro']);
        $nome = $istanza->real_escape_string($_POST['nome']);
        $cognome = $istanza->real_escape_string($_POST['cognome']);
        $data_nascita = $istanza->real_escape_string($_POST['data_nascita']);
        $tipo_abbonamento = $istanza->real_escape_string($_POST['tipo_abbonamento']);
        $stato_pagamento = $istanza->real_escape_string($_POST['stato_pagamento']);
        $istanza->query("INSERT INTO Membro (id_membro, nome, cognome, data_nascita, tipo_abbonamento, stato_pagamento) VALUES ('$id_membro', $nome, '$cognome', '$data_nascita', '$tipo_abbonamento', '$stato_pagamento')");
        $notifica = "Membro aggiunto corettamente.";
    } 
}

if (isset($_GET['return_membro'])) {
    $item_id = intval($_GET['return_membro']);
    $istanza->query("UPDATE Membri SET aggiunto = 1 WHERE id_membro = $id_membro");
    $notifica = ".";
}

$membri_full = $istanza->query("SELECT M.*, C.nome_corso, C.livello_difficolta FROM Membri M  JOIN Corsi C ON M.id_corso = C.id_corso ORDER BY M.id_membro DESC");

$lista_corsi = $istanza->query("SELECT * FROM Corsi");
$lista_istruttori = $istanza->query("SELECT * FROM Istruttori");
$lista_membri = $istanza->query("SELECT * FROM Membri");
?>

