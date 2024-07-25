$(document).ready(function() {
    function loadMessages() {
        $.ajax({
            url: 'LoadMessages.php',
            method: 'GET',
            success: function(data) {
                $('#chat-box').html(data);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            }
        });
    }

    $('#send-btn').on('click', function() {
        var message = $('#chat-input').val().trim();
        if (message !== '') {
            $.post('SendMessage.php', {message: message}, function() {
                $('#chat-input').val('');
                loadMessages();
            });
        }
    });

    $('#chat-input').on('keypress', function(event) {
        if (event.key === 'Enter') {
            $('#send-btn').click();
        }
    });

    loadMessages();
    setInterval(loadMessages, 10); // Mesajları her 1 saniyede bir yükle
});
