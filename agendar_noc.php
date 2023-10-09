<?php
// Verifique se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Conecte-se ao banco de dados (substitua com suas credenciais)
    $servername = "ws4.altcloud.net.br";
    $username = "ggnet_nocsz";
    $password = "ae7$6bPiLz/gp#iF";
    $dbname = "ggnet_nocsz";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifique a conexão com o banco de dados
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Obtenha os valores dos campos do formulário
    $protocolo_noc = $_POST["protocolo_noc"];
    $dataHora_noc = $_POST["dataHora_noc"];

    // Insira os dados na tabela "agendamentos_noc"
    $sql = "INSERT INTO agendamentos_noc (dataHora_noc, protocolo_noc) VALUES ('$dataHora_noc', '$protocolo_noc')";

    if ($conn->query($sql) === TRUE) {
        echo "Agendamento realizado com sucesso!";
    } else {
        echo "Erro ao agendar: " . $conn->error;
    }

    // Verifique se o horário já existe na tabela
    $sql2 = "SELECT *, DATE_FORMAT(dataHora_noc, '%Y-%m-%d %H:%i') as data_hora_sem_segundos FROM agendamentos_noc";
    $consulta  = mysqli_query($conn, $sql2);

    $dataAtual = date('Y-m-d H:i');
    
    foreach($consulta as $consultas) {
        $dataFinal = $consultas['data_hora_sem_segundos'];
        $descricao = $consultas['protocolo_noc'];

        if ($dataFinal == $dataHora_noc) {
            echo "<script>alert('O protocolo: $descricao Data e horário: $dataFinal está sendo chamado! Verifique')</script>";
            break; // Interrompe o loop após encontrar uma correspondência
        }
    }

    // Feche a conexão com o banco de dados
    $conn->close();
}
?>
