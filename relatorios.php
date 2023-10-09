<?php
    include 'conexao.php';
   
    $countSql = "SELECT COUNT(*) as total FROM agendamentos";
$countResult = $conexao->query($countSql);
$countRow = $countResult->fetch_assoc();
$totalAgendamentos = $countRow['total'];

    // Processa o formulário quando for enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['Salvar'])) {
            $id = $_POST["id"];
            $observacao = $_POST["observacao"];

            // Atualize a observação no banco de dados
            $sql = "UPDATE agendamentos SET observacao = '$observacao' WHERE id = $id";

            if ($conexao->query($sql) === TRUE) {
                echo "Observação atualizada com sucesso!";
            } else {
                echo "Erro ao atualizar a observação: " . $conexao->error;
            }
        } elseif (isset($_POST['Excluir'])) {
            $id = $_POST["id"];

            // Exclua a linha do banco de dados
            $sql = "DELETE FROM agendamentos WHERE id = $id";

            if ($conexao->query($sql) === TRUE) {
                echo "Registro excluído com sucesso!";
            } else {
                echo "Erro ao excluir o registro: " . $conexao->error;
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
    <style>
        /* Estilo para a tabela */
.table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    margin-top: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.table th,
.table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    transition: background-color 0.3s ease;
}

/* Adiciona animação de fundo para realçar a linha quando o mouse passa por cima */
.table tbody tr:hover {
    background-color: #f5f5f5;
    transition: background-color 0.3s ease;
}

/* Estilo para os botões "Salvar" e "Excluir" */
.btn-success,
.btn-danger {
    padding: 8px 16px;
    font-size: 14px;
    cursor: pointer;
    margin-right: 5px;
    border: none;
    border-radius: 4px;
}

.btn-success {
    background-color: #5cb85c;
    color: #fff;
}

.btn-success:hover {
    background-color: #449d44;
}

.btn-danger {
    background-color: #d9534f;
    color: #fff;
}

.btn-danger:hover {
    background-color: #c9302c;
}

/* Estilo para o botão "Copiar Dados" */
#copiarDados {
    margin-top: 20px;
    background-color: #337ab7;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
}

#copiarDados:hover {
    background-color: #286090;
}

/* Estilo para o botão "Voltar" */
.btn-primary {
    margin-right: 10px;
    background-color: #337ab7;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
}

.btn-primary:hover {
    background-color: #286090;
}

/* Estilo para a barra de rolagem no campo de observação */
textarea {
    resize: vertical;
    max-height: 150px;
    overflow-y: auto;
}

/* Estilo para a notificação */
.notification {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 15px;
    margin-top: 10px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Estilo para a mensagem de sucesso após copiar dados */
.success-message {
    background-color: #5cb85c;
    color: #fff;
    padding: 15px;
    text-align: center;
    margin-top: 20px;
    border-radius: 4px;
    animation: fadeOut 3s ease;
}

@keyframes fadeOut {
    0% {
        opacity: 1;
    }
    100% {
        opacity: 0;
        display: none;
    }
}

/* Estilo para o rodapé */
footer {
    text-align: center;
    background-color: #333;
    color: #fff;
    padding: 10px 0;
}

    </style>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var rows = document.querySelectorAll(".table tbody tr");

        rows.forEach(function (row) {
            var cells = row.querySelectorAll("td");

            var dataHoraAgendada = cells[1].textContent.trim(); // Coluna que contém a data/hora agendada
            var protocolo = cells[2].textContent.trim(); // Coluna que contém o protocolo

            // Quebra a data e a hora em partes
            var partesDataHora = dataHoraAgendada.split(" ");
            var data = partesDataHora[0];
            var hora = partesDataHora[1];

            // Divide a data em partes
            var partesData = data.split("/");
            var dia = partesData[0];
            var mes = partesData[1] - 1; // Os meses em JavaScript são de 0 a 11
            var ano = partesData[2];

            // Divide a hora em partes
            var partesHora = hora.split(":");
            var horas = partesHora[0];
            var minutos = partesHora[1];

            // Cria um objeto de data JavaScript com a data e a hora
            var dataHoraAgendadaObj = new Date(ano, mes, dia, horas, minutos);

            // Obtém a data/hora atual do navegador
            var dataHoraAtual = new Date();

            // Verifica se a data/hora agendada já passou ou é a mesma
            if (dataHoraAgendadaObj <= dataHoraAtual) {
                // Se a data/hora agendada já passou ou é a mesma, exibe uma notificação pop-up
                var observacao = cells[3].querySelector("textarea").value; // Obtém a observação
                var mensagem = "Protocolo: " + protocolo + "\n" +
                    "Data e Hora Agendada: " + dataHoraAgendada + "\n" +
                    "Observação: " + observacao;

                if (Notification.permission === "granted") {
                    // Se a permissão de notificação já foi concedida, exibe a notificação
                    var notification = new Notification("Seu agendamento chegou!!", {
                        body: mensagem
                    });
                } else if (Notification.permission !== "denied") {
                    // Se a permissão de notificação não foi negada, solicita a permissão
                    Notification.requestPermission().then(function (permission) {
                        if (permission === "granted") {
                            // Se o usuário conceder a permissão, exibe a notificação
                            var notification = new Notification("Seu agendamento chegou!!", {
                                body: mensagem
                            });
                        }
                    });
                }
            }
        });
    });
</script>

</head>
<body>
<div class="container">
    <h1>Relatórios de Agendamentos</h1>
    <p>Total de Agendamentos: <?php echo $totalAgendamentos; ?></p>
    
    <!-- Resto do seu código HTML ... -->
</div>

<div id="dataHora"></div>


    
    <div class="container">
      

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
                $sql = "SELECT id, DATE_FORMAT(dataHora, '%d/%m/%Y %H:%i') as dataHora, protocolo, observacao FROM agendamentos ORDER BY dataHora ASC" ;
                $result = $conexao->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row['dataHora'] . "</td>";
                        echo "<td>" . $row["protocolo"] . "</td>";
                        echo "<td>";
                        echo "<form method='post' action=''>";
                        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                        echo "<textarea name='observacao'>" . $row["observacao"] . "</textarea>";
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
        <!-- Script JavaScript para copiar dados sem o ID -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("copiarDados").addEventListener("click", function () {
        // Seleciona a tabela
        var table = document.querySelector(".table");

        // Obtém todas as linhas da tabela (exceto o cabeçalho)
        var rows = table.querySelectorAll("tbody tr");

        // Inicializa uma variável para armazenar os dados a serem copiados
        var dataToCopy = "";

        // Loop através das linhas da tabela
        rows.forEach(function (row) {
            // Obtém as células da linha (exceto a primeira célula que contém o ID)
            var cells = row.querySelectorAll("td:not(:first-child)");

            // Obtém o texto das células que você deseja copiar (Data e Hora, Protocolo)
            var dataHora = cells[0].textContent.trim();
            var protocolo = cells[1].textContent.trim();

            // Concatena os dados na variável
            dataToCopy += "Data e Hora: " + dataHora + ", Protocolo: " + protocolo + "\n";
        });

        // Cria um elemento de texto oculto para copiar os dados
        var textArea = document.createElement("textarea");
        textArea.value = dataToCopy;
        document.body.appendChild(textArea);

        // Seleciona o texto na área de texto
        textArea.select();

        // Copia o texto para a área de transferência
        document.execCommand("copy");

        // Remove o elemento de texto oculto
        document.body.removeChild(textArea);

        // Exibe uma mensagem de sucesso
        alert("Dados copiados para a área de transferência ");
    });
});
</script>
<script>
// Função para atualizar a página automaticamente a cada X segundos (defina o valor desejado em milissegundos)
function autoRefresh() {
    setTimeout(function () {
        location.reload(); // Recarrega a página
    }, 20000); // Atualize a cada 5 segundos (ajuste conforme necessário)
}

// Chame a função de atualização automática quando a página for carregada
window.addEventListener('load', autoRefresh);
</script>



        <!-- Resto do código HTML ... -->

        <?php
        // Fechar a conexão com o banco de dados
        $conexao->close();
        ?>
    </div>
    <!-- Resto do código HTML ... -->
<!-- Botão para copiar os dados para a área de transferência -->


<!-- Botão para voltar à página anterior (index.php) -->
<div class="text-center mt-3">
<button  id="copiarDados" class="btn btn-primary">Copiar Dados</button>
    <a href="agendadosSZ.php" class="btn btn-primary">Voltar</a>
</div>

<?php
// Fechar a conexão com o banco de dados
$conexao->close();
?>

</body>
</html>
