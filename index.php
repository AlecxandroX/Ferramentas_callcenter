<?php 
include('conexao.php');

$NOK = false; // Variável utilizada para verificar se o usuário fez login

if(isset($_POST['nome']) && isset($_POST['senha'])) {

    $nome  = $conexao->real_escape_string($_POST['nome']);
    $senha = $conexao->real_escape_string($_POST['senha']);

    // Criando uma Query
    $sql = "SELECT * FROM usuarios WHERE nome = '$nome' AND senha = '$senha'";

    // Rodando a Query
    $resposta = $conexao->query($sql) or die("Falha na execução do código SQL: " . $conexao->error);

    $quantidade = $resposta->num_rows; // Código que vai me retornar a quantidade de consultas no banco de dados

    if($quantidade == 1) {

        $usuario = $resposta->fetch_assoc(); // Retornando os campos do banco de dados em formato de objeto para podermos acessar via ->

        if(!isset($_SESSION)) { // Criando uma sessão caso não tenha
            session_start();
        }

        $_SESSION['id_usuario'] = $usuario['id'];    // Atribuindo o id do usuário que está no banco de dados para a session id_usuario
        $_SESSION['usuario']    = $usuario['nome'];  // Atribuindo o valor do nome do usuário do banco para a session usuario
        $_SESSION['email']      = $usuario['email']; // Atribuindo o valor do email do usuario do banco de dados na session email

        header('Location: home.php'); // Redirecionando o usuário para a página principal
    } else {
        $NOK = true;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Link Ionicons (Icones)-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js" defer></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js" defer></script>

    <!-- Link CSS index.css -->
    <link rel="stylesheet" href="login_registro.css">

    <title>Login</title>
</head>
<body>
    
    <section> <!--- Inicio Section -->
        <div class="form-caixa">
            <div class="form-value">
                 <form action="" method="POST">
                    <h2>Login</h2>
                    <div class="input-caixa">
                        <ion-icon name="person-circle-outline"></ion-icon>
                        <input type="text" name="nome" id="nome" required>
                        <label for="nome">Nome de usuário</label>
                    </div>
                    <div class="input-caixa">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="senha" id="senha" required>
                        <label for="senha">Senha</label>
                    </div>

                    <div class="esquecer">
                        <label for="marca_box"><input type="checkbox" id="marca_box">Lembre-me</label>
                    </div>

                    <button type="submit">Login</button>

                    <?php
                        if($NOK == true) {
                            ECHO '<p style="color: red; text-align: center; margin-top: 10px; border: 0px;" class="input-caixa"   >Falha no login! Usuario ou senha incorretos!, verifique </p>';
                        }
                    ?>

                    <div class="registrar">
                        <p>Não tem uma Conta? <a href="registro.php">Registre-se</a></p>
                    </div>
                 </form>
            </div>
        </div>
    </section> <!--- Fim Section -->
    
</body>
</html>
