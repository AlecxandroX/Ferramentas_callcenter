<?php
include('conexao.php');

$NOK = false;
$existeConexao = false;

if (isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['nome'])) {
    
    $existeConexao = true;

    $email = $conexao->real_escape_string($_POST['email']);
    $senha = $conexao->real_escape_string($_POST['senha']);
    $nome  = $conexao->real_escape_string($_POST['nome']);

    // Criando uma Query de inserção
    $sql_code = "INSERT INTO usuarios (email, senha, nome) VALUES ('$email', '$senha', '$nome')";

    // Executando a Query de inserção
    $sql_query = $conexao->query($sql_code) or die("Falha na execução do código sql" . $conexao->error);

    if ($sql_query) {
        // Inserção bem-sucedida, redirecionar para a página de sucesso
        header("Location: index.php");
        exit;
    } else {
        $NOK = true;
        // Exibir mensagem de falha ao inserir
        //echo "Falha ao inserir dados no banco de dados";
    }
}




?>

<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Links Ionicons (Icones)-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" defer></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js" defer></script>

    <!-- Link CSS index.css -->
    <link rel="stylesheet" href="login_registro.css">

    <title>Página Registro</title>
</head>
<body>
    
    <section> <!--- Inicio Section -->
        <div class="form-caixa">
            <div class="form-value">
                 <form action="" method="POST">
                    <h2>Registrar</h2>

                    <!-- Input Nome -->
                    <div class="input-caixa">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" name="nome" required>
                        <label for="">Nome de Usuário</label>
                    </div>

                    <!-- Input E-mail -->
                    <div class="input-caixa">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" required>
                        <label for="">Email</label>
                    </div>

                    <!-- Input Senha -->
                    <div class="input-caixa">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="senha" required>
                        <label for="">Senha</label>
                    </div>

                    <!-- Botão enviar -->
                    <button type="submit">Registrar</button>

                    <!-- Validando os campos inseridos -->
                    <?php 

                        if($NOK == true) {
                            ECHO '<p style="color: #c00d0d; text-align: center;">Falha no Registro! Não foram inseridos registros no banco de dados</p>';
                        }
                    ?>

                    <div class="registrar">
                        <p>Já tem conta? <a href="index.php">Faça login aqui!</a></p>
                    </div>
                 </form>
            </div>
        </div>
    </section> <!--- Fim Section -->
    
</body>
</html>