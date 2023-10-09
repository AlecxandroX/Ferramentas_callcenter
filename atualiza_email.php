<!DOCTYPE html>
<html>
<head>
    <title>Atualização de e-mail</title>
    <link rel="icon" href="https://png.pngtree.com/png-vector/20190927/ourlarge/pngtree-email-icon-png-image_1757854.jpg" type="image/x-icon">
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

        /* Estilo para o formulário */
        form {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 30px;
            width: 400px;
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            margin-top: 20px; /* Espaço entre o título e o formulário */
        }

        /* Estilo para o cabeçalho (título) */
        h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 20px;
            margin-top: 0; /* Remover margem superior */
        }

        /* Estilo para as etiquetas e campos de entrada */
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
            font-size: 16px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        /* Estilo para o botão de envio */
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Animação ao focar nos campos de entrada */
        input:focus, select:focus {
            border-color: #007bff;
            transition: border-color 0.3s ease;
        }

        /* Estilo para o formulário quando estiver em hover */
        form:hover {
            transform: scale(1.02);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
        }

        /* Estilo para o botão de relatórios */
        .btn-relatorios {
            margin-top: 20px;
        }
        /* Estilo para o botão de relatórios */
        .btn-relatorios {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-relatorios:hover {
            background-color: #0056b3;
        }

    </style>

</head>
<body>
    <h1>Atualização de e-mail </h1>
    <form action="processa_email.php" method="post">
        <label for="campo1">Codigo do cliente</label>
        <input type="text" name="campo1" id="campo1" required><br>

        <label for="campo2">E-MAIL</label>
        <input type="text" name="campo2" id="campo2" required><br>

        <label for="campo3">CONTATO</label>
        <input type="text" name="campo3" id="campo3" required><br>

        <label for="campo4">STATUS</label>
        <select name="campo4" id="campo4" required>
            <option value="Caixa postal">Caixa postal</option>
            <option value="Atendido">Atendido</option>
            <option value="Plano inativo/cancelado">Plano inativo/cancelado</option>
            <option value="Retornar">Retornar</option>
            <option value="Cadatro não encontrado">Cadatro não encontrado</option>
            <option value="Sem contato">Sem contato</option>
            <option value="Desligou">Desligou</option>
            <option value="Não informou">Não informou</option>
            <option value="Não possui e-mail">Não possui e-mail</option>
        </select><br>

        <input type="submit" value="Enviar">
    </form>
    <a class="btn-relatorios" href="relatorios_e-mail.php">Relatórios</a>
</body>
</html>
