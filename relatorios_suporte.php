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

// Processa o formulário quando for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Salvar'])) {
        $id = $_POST["id"];
        $observacao = $_POST["observacao"];

        // Atualize a observação no banco de dados
        $sql = "UPDATE agendamentos_noc SET observacao = '$observacao' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Observação atualizada com sucesso!";
        } else {
            echo "Erro ao atualizar a observação: " . $conn->error;
        }
    } elseif (isset($_POST['Excluir'])) {
        $id = $_POST["id"];

        // Exclua a linha do banco de dados
        $sql = "DELETE FROM agendamentos_noc WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Registro excluído com sucesso!";
        } else {
            echo "Erro ao excluir o registro: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios de Agendamentos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Relatórios de Agendamentos</h1>

        <table class='table'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data e Hora</th>
                    <th>Protocolo</th>
                    <th>Observação</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta SQL para buscar agendamentos
                $sql = "SELECT id, DATE_FORMAT(dataHora_noc, '%d/%m/%Y %H:%i') as dataHora_noc, Protocolo_noc, Observacao FROM agendamentos_noc ORDER BY dataHora_noc ASC";
                $result = $conn->query($sql);

                if ($result === FALSE) {
                    die("Erro na consulta: " . $conn->error);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row['dataHora_noc'] . "</td>";
                        echo "<td>" . $row["Protocolo_noc"] . "</td>";
                        echo "<td>";
                        echo "<form method='post' action=''>";
                        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                        echo "<textarea name='observacao'>" . $row["Observacao"] . "</textarea>";
                        echo "</td>";
                        echo "<td>";
                        echo "<button type='submit' class='btn btn-success' name='Salvar'>Salvar</button>";
                        echo "</form>";
                        echo "<form method='post' action=''>";
                        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                        echo "<button type='submit' class='btn btn-danger' name='Excluir'>Excluir</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Nenhum agendamento encontrado.";
                }
                ?>
            </tbody>
        </table>

        <!-- Botão para copiar protocolos e datas com horários -->
        <div class="text-center mt-3">
            <button class="btn btn-primary" id="btnCopiar">Copiar atualização de grupo</button>
        </div>

    </div>

    <!-- Script JavaScript para copiar o conteúdo da tabela -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("btnCopiar").addEventListener("click", function () {
            const table = document.querySelector(".table");
            const rows = table.querySelectorAll("tbody tr");
            let texto = "Protocolo\tData e Hora\n";

            rows.forEach(function (row) {
                const columns = row.querySelectorAll("td");
                texto += columns[2].textContent + "\t" + columns[1].textContent + "\n";
            });

            const textarea = document.createElement("textarea");
            textarea.value = texto;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");
            document.body.removeChild(textarea);

            alert("Protocolos e Datas com Horários foram copiados para a área de transferência!");
        });
    });
    </script>

    <!-- Resto do código HTML ... -->

    <!-- Botão para voltar à página anterior (index.php) -->
    <div class="text-center mt-3">
        <a href="agendado_noc_suporte.php" class="btn btn-primary">Voltar</a>
    </div>

    <?php
    // Fechar a conexão com o banco de dados
    $conn->close();
    ?>

</body>
</html>
