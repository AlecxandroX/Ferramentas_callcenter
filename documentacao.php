<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Minha Wiki</title>
    <link rel="stylesheet" href="wiki.css">
</head>
<body>
    <br>
    <img src="https://s3.amazonaws.com/mktzap-media-storage-master/whitelabel/companies/logo_login/7ae26d275da4474d90ad043a6ab4ca046d87af48" alt="" style="display: block; margin: 0 auto; max-width: 100%; height: auto; vertical-align: middle; margin-top: 10px;">

    <div class="container">
        <header>
            <h1>Wiki GGNET</h1>
            <nav>
                <ul>
                    <li><a href="documentacao.php" class="btn">Página Princial</a></li>
                    <li><a href="criar_artigo.php" class="btn">Criar uma documentação</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <h2>Documentos existentes</h2>
            <ul>
                <?php
                // Conexão com o banco de dados
                $server = 'ws4.altcloud.net.br';
                $usuario = 'ggnet_nocsz';
                $senha = 'ae7$6bPiLz/gp#iF';
                $base = 'ggnet_nocsz';

                $conn = new mysqli($server, $usuario, $senha, $base);

                // Verificar conexão
                if ($conn->connect_error) {
                    die("Falha na conexão: " . $conn->connect_error);
                }

                // Consulta para obter os artigos mais recentes
                $sql = "SELECT id, titulo FROM artigos ORDER BY data_publicacao DESC LIMIT 5";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<li><a href='exibir_artigo.php?id=" . $row["id"] . "' class='btn-link'>" . $row["titulo"] . "</a></li>";
                    }
                } else {
                    echo "<li>Nenhum artigo disponível.</li>";
                }

                $conn->close();
                ?>
            </ul>
        </main>
        <footer>
            <p>&copy; 2023 CodeVerse</p>
        </footer>
    </div>
</body>
</html>
