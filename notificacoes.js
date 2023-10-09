$(document).ready(function () {
    // Define a função para verificar notificações
    function checkNotifications() {
        $.ajax({
            url: 'check_notifications.php',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                if (data.notify) {
                    // Exibe um pop-up de notificação
                    alert('Novo agendamento disponível: ' + data.protocolo);
                }
            },
            error: function () {
                console.error('Erro ao verificar notificações.');
            }
        });
    }

    // Verifica notificações a cada 60 segundos
    setInterval(checkNotifications, 60000);
});
