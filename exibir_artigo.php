<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Artigo - Minha Wiki</title>
    <link rel="stylesheet" href="wiki.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Minha Wiki</h1>
            <nav>
                <ul>
                    <li><a href="documentacao.php" class="btn">Página Principal</a></li>
                    <li><a href="criar_artigo.php" class="btn">Criar Artigo</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

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

                // Consulta para obter o artigo pelo ID
                $stmt = $conn->prepare("SELECT titulo, conteudo FROM artigos WHERE id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $stmt->bind_result($titulo, $conteudo);

                if ($stmt->fetch()) {
                    echo "<h2 class='article-title'>$titulo</h2>";
                    echo "<div class='article-content'>" . nl2br($conteudo) . "</div>";
                } else {
                    echo "<p class='article-content'>Artigo não encontrado.</p>";
                }

                $stmt->close();
                $conn->close();
            } else {
                echo "<p class='article-content'>Artigo não especificado.</p>";
            }
            ?>
        </main>
        <footer>
            <p>&copy; 2023 CodeVerse</p>
        </footer>
    </div>
</body>
</html>
