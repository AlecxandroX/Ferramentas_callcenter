<!DOCTYPE html>
<html>
<head>
    <title>Relatório de Formulários Preenchidos</title>
    <style>
        /* Estilo básico para o corpo da página */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; /* Colocar os elementos em coluna */
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* Estilo para o cabeçalho (título) */
        h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
            margin-top: 0;
        }

        /* Estilo para a tabela de relatório */
        table {
            border-collapse: collapse;
            width: 80%;
            max-width: 800px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Estilo para o botão de voltar */
        .btn-voltar {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-voltar:hover {
            background-color: #0056b3;
        }

        /* Estilo para o botão de excluir */
        .btn-excluir {
            background-color: #ff3333;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Relatório de Formulários Preenchidos</h1>

    <?php
    // Dados de conexão com o banco de dados
    $server = 'ws4.altcloud.net.br';
    $usuario = 'ggnet_nocsz';
    $senha = 'ae7$6bPiLz/gp#iF';
    $base = 'ggnet_nocsz';

    try {
        // Cria uma conexão com o banco de dados MySQL usando PDO
        $pdo = new PDO("mysql:host=$server;dbname=$base", $usuario, $senha);
        
        // Configura o PDO para lançar exceções em caso de erros
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verifica se o botão "Excluir" foi clicado
        if (isset($_POST['excluir'])) {
            $idExcluir = $_POST['excluir'];

            // Prepara e executa uma consulta SQL para excluir o registro com base no ID
            $sql = "DELETE FROM formulario WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $idExcluir, PDO::PARAM_INT);
            $stmt->execute();
        }

        // Prepara e executa uma consulta SQL para buscar os dados da tabela 'formulario'
        $sql = "SELECT * FROM formulario";
        $stmt = $pdo->query($sql);

        if ($stmt->rowCount() > 0) {
            echo "<table border='1'>";
            echo "<tr><th>DATA</th><th>Motivo da perda?</th><th>DNIS</th><th>ESPERA</th><th>Posição</th><th>Originador</th><th>Ação</th></tr>";
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['data_hora']}</td>";
                echo "<td>{$row['campo1']}</td>";
                echo "<td>{$row['campo2']}</td>";
                echo "<td>{$row['campo3']}</td>";
                echo "<td>{$row['campo4']}</td>";
                echo "<td>{$row['campo5']}</td>";
                echo "<td><form method='POST'><input type='hidden' name='excluir' value='{$row['id']}'><button class='btn-excluir'>Excluir</button></form></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "Nenhum registro encontrado.";
        }
    } catch (PDOException $e) {
        // Em caso de erro na conexão ou execução da consulta SQL, exibe uma mensagem de erro
        echo "Erro de conexão com o banco de dados: " . $e->getMessage();
    }
    ?>

    <a class="btn-voltar" href="ligações_perdidas.php">Voltar para Ligações Perdidas</a>
</body>
</html>
