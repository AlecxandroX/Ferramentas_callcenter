<?php
// Função para verificar agendamentos e exibir um pop-up se necessário
function verificarAgendamentos() {
    // Conecte-se ao banco de dados
    $conn = new mysqli("ws4.altcloud.net.br", "ggnet_nocsz", "ae7$6bPiLz/gp#iF", "ggnet_nocsz");

    // Verifique se a conexão foi bem-sucedida
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Obtenha a data e hora atual do servidor
    $dataHoraAtual = date("Y-m-d H:i:s");

    // Consulte a tabela de agendamentos
    $sql = "SELECT * FROM agendamentos WHERE dataHora <= ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $dataHoraAtual);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Exiba um sinal para que o JavaScript mostre um pop-up na página
        echo "<script>exibirPopUp();</script>";
    }

    // Feche a conexão com o banco de dados
    $stmt->close();
    $conn->close();
}

// Função JavaScript para exibir o pop-up
function exibirPopUp() {
    echo "
        <script>
            alert('Você tem um agendamento no passado ou no presente.');
        </script>
    ";
}

// Chame a função de verificação
verificarAgendamentos();
?>