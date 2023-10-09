<?php
// Conexão com o banco de dados (ajuste as informações conforme seu ambiente)
$servername = "ws4.altcloud.net.br";
$username = "ggnet_nocsz";
$password = "ae7$6bPiLz/gp#iF";
$dbname = "ggnet_nocsz";

// Cria uma conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Verificar agendamentos para notificação
$currentDateTime = date("Y-m-d H:i:s");
$sql = "SELECT id, protocolo FROM agendamentos WHERE dataHora <= '$currentDateTime' AND notificado = 0 LIMIT 1";
$result = $conn->query($sql);

$response = array("notify" => false, "protocolo" => "");

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response["notify"] = true;
    $response["protocolo"] = $row["protocolo"];

    // Marcar o agendamento como notificado
    $idAgendamento = $row["id"];
    $updateSql = "UPDATE agendamentos SET notificado = 1 WHERE id = $idAgendamento";
    $conn->query($updateSql);
}

// Fechar a conexão com o banco de dados
$conn->close();

// Retorna a resposta JSON
header("Content-Type: application/json");
echo json_encode($response);
?>
