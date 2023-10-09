<?php
    include 'conexao.php'; //Include de conexao com o Banco de dados
    include 'protect.php'; //Include utilizado para não deixar o usuário entrar nas páginas sem utilizar o login

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Iniciar</title>
    <!-- Inclua o Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="home.css">
    <link rel="icon" href="data:image/png;base64,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" type="image/x-icon">
</head>
<body>
<?php
// Inicie ou retome a sessão
session_start();

// Verifique se o usuário está logado
if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];

    // Consulta SQL para buscar o nome do usuário pelo ID
    $sql = "SELECT nome FROM usuarios WHERE id = $usuario_id";

    // Execute a consulta
    $result = $conn->query($sql);

    // Verifique se a consulta foi bem-sucedida
    if ($result->num_rows > 0) {
        // Extrai os dados do resultado
        $row = $result->fetch_assoc();
        $nomeUsuario = $row['nome'];

        // Exibe o nome do usuário no topo da página
        echo '<div id="user">Usuário logado: ' . $nomeUsuario . '</div>';
    }
}
?>

    
    <h1>Ferramentas-NOC</h1>
    <div id="menu">
        <div  id="title">Menu</div>
        
        
        <div class="menu-row">
        <div class="menu-item">
                <a href="https://nocsz.gegnet.com.br/agendadosSZ.php" target="_blank">
                    <img src="https://img.freepik.com/vetores-premium/icone-de-calendario-em-estilo-simples-ilustracao-vetorial-de-agenda-em-fundo-branco-isolado-conceito-de-negocios-de-planejador-de-agenda_157943-2476.jpg" alt="Agendados SZ" class="icone-agendados">
                    <span>Agendados SZ.CHAT</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="https://nocsz.gegnet.com.br/agendado_noc_suporte.php" target="_blank">
                    <img src="https://cdn.icon-icons.com/icons2/37/PNG/512/clock_theapplication_2900.png" alt="Agendados SZ" class="icone-nocsuporte">
                    <span>Agendados NOC suporte</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="documentacao.php" target="_blank">
                    <img src="data:image/png;base64,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" alt="Agendados SZ" class="icone-nocsuporte">
                    <span>Wiki documentação</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="atualiza_email.php" target="_blank">
                    <img src="https://png.pngtree.com/png-vector/20190927/ourlarge/pngtree-email-icon-png-image_1757854.jpg" alt="Planilha de  Ligações Perdidas" class="icone-agendados">
                    <span>ATUALIZAR E-MAILS</span>
                </a>
            </div>
             <div class="menu-item">
                <a href="ligações_perdidas.php" target="_blank">
                    <img src="https://static.vecteezy.com/ti/vetor-gratis/p3/4956037-icone-de-chamada-vetor.jpg" alt="Planilha de  Ligações Perdidas" class="icone-agendados">
                    <span>Ligações Perdidas</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="https://ggnet.gcommit.com.br/login" target="_blank">
                    <img src="https://ggnet.gcommit.com.br/assets/img/logo.png" alt="Gcommit" class="icone-gcommit">
                    <span>gCOMMIT</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="https://plutao.geogridmaps.com.br/ggnet/" target="_blank">
                    <img src="https://eros.geogridmaps.com.br/acessoline/geogridlayout/imagensLogin/nova-logo.png" alt="Ícone do Programa 2" class="icone-geogrid">
                    <span>Geogrid</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="https://integrator6.gegnet.com.br/#/app" target="_blank">
                    <img src="https://integrator6.gegnet.com.br/assets/img/integrator6.png" alt="Ícone do Programa 3" class="icone-integrator">
                    <span>Integrator 6</span>
                </a>
            </div>
        </div>

        <div class="menu-row">

            <!-- Adicione mais ícones aqui, seguindo o mesmo padrão -->
            <div class="menu-item">
                <a href="http://grafana.acessoline.net.br/login" target="_blank">
                    <img src="https://www.ambientelivre.com.br/media/k2/items/cache/218fa54275e0e31c37b4e5091d9112ba_L.jpg" alt="Ícone do Programa 4" class="icone-grafana">
                    <span>Grafana</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="http://zabbix.gegnet.com.br/zabbix.php?action=dashboard.list" target="_blank">
                    <img src="https://made4it.com.br/wp-content/uploads/2020/10/zabbix_logo_500x131.png" alt="Ícone do Programa 5" class="icone-integrator">
                    <span>Zabbix</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="https://ggnet.sz.chat/" target="_blank">
                    <img src="https://play-lh.googleusercontent.com/fvozbxumHSsM5EZLpXGAnGMp5JT3QiRzcn42h9Dwo8l8gFKJ3D_vUsGcDSL5VdgodN8" alt="Ícone do Programa 6" class="icone-SZCHAT">
                    <span>SZ.CHAT</span>
                </a>
            </div>
        </div>

        <div class="menu-row">
            <!-- Adicione mais ícones aqui, seguindo o mesmo padrão -->
            <div class="menu-item">
                <a href="http://myisp.gegnet.com.br/MyIspWeb/admin/index.jsp" target="_blank">
                    <img src="https://cdn-icons-png.flaticon.com/512/630/630886.png" alt="MYisp GGnet" class="icone-SZCHAT">
                    <span>MYISP GGNET</span>
                </a>
            </div>
           
           
            
            <div class="menu-item">
                <a href="https://unifi.infopasa.net.br:8443/manage/account/login?redirect=%2Fmanage%2Fsite%2F3wqtxnv1%2Fdevices%2F1%2F50" target="_blank">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_Kej4CUUvPp6HuWQ7E5oV7NuBLkvPsNK-wg&usqp=CAU" alt="Agendados SZ" class="icone-nocsuporte">
                    <span>Unifi Infopasa</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="https://omada.tplinkcloud.com/login" target="_blank">
                    <img src="https://play-lh.googleusercontent.com/FW3wu85sc7EtgSnPoCY_NBQq4yeB0ZcUL62dkruhcDTs7u3OsnbGL0-mzFMiGbmiaw=w600-h300-pc0xffffff-pd" alt="Agendados SZ" class="icone-nocsuporte">
                    <span>Omada TP-link</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="https://187.85.152.170:8060/#/home" target="_blank">
                    <img src="https://187.85.152.170:8060/res/images/logo_ispti.png" alt="Agendados SZ" class="icone-nocsuporte">
                    <span>ISP TI LOGS</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="https://aowin.smartolt.com/auth/login" target="_blank">
                    <img src="data:image/png;base64,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" alt="Agendados SZ" class="icone-nocsuporte">
                    <span>Aowin smart OLT</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="https://atendimento.itelfibra.com.br/atendente/" target="_blank">
                    <img src="https://atendimento.itelfibra.com.br/atendente/login/images/opasuite.svg" alt="Agendados SZ" class="icone-nocsuporte">
                    <span>OPA! suite</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="https://ixc.itelfibra.com.br/login.php" target="_blank">
                    <img src="https://demo.ixcsoft.com.br/images/Logo_IXC-Provedor-Color.png" alt="Agendados SZ" class="icone-nocsuporte">
                    <span>IXC Provedor</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="https://integrator.aowin.com.br/#/login" target="_blank">
                    <img src="https://integrator6.gegnet.com.br/assets/img/integrator6.png" alt="Agendados SZ" class="icone-nocsuporte">
                    <span> Integrator 6 Aowin</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="https://srv-rad-01.gegnet.net.br/login" target="_blank">
                    <img src="https://srv-rad-01.gegnet.net.br/public/img/grafana_icon.svg" alt="Agendados SZ" class="icone-nocsuporte">
                    <span>PrimeAuth Dashboard</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="https://manutencao.gegnet.com.br/indexNovo.php?page=dashboard" target="_blank">
                    <img src="https://png.pngtree.com/png-vector/20210927/ourmid/pngtree-maintenance-icon-flat-png-image_3958973.png" alt="Agendados SZ" class="icone-nocsuporte">
                    <span>Manutenções</span>
                </a>
            </div>
           
        </div>
    </div>

    <!-- Inclua o Bootstrap JS e jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Inclua o FontAwesome para ícones -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <BR></BR>
    <footer>
        <p>&copy; 2023 Desenvolvido por <a href="https://codeversesolutions.com.br">CodeVerse</a>.</p>
    </footer>
</body>
</html>
