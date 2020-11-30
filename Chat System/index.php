<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="chat.svg" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js" 
  integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
  crossorigin="anonymous"></script>
    <title>CHAT ROOM</title>
</head>
<body>
   
    <div id="wrapper">
        <h1 class="head">Welcome <?php session_start(); echo $_SESSION['username']; ?></h1>
        <div class="chat_wrapper">
            <div id="chat" ></div>
            <form method="POST" id="Form">
            <textarea name="message" cols="30" rows="4" class="textarea"></textarea>
            </form>
        </div>
    </div>

    <script>
        Load();
        function Load(){
            $.post('handlers/messages.php?action=MessageFetch',function(response){
                // To prevent auto scroll down
                var scrollpos=$('#chat').scrollTop();
                var scrollpos=parseInt(scrollpos)+520;
                var scrollHeight=$('#chat').prop('scrollHeight');
                $('#chat').html(response);
                if(scrollpos<scrollHeight){
                
                }else{
                    $('#chat').scrollTop($('#chat').prop('scrollHeight'));  //show scrolling at bottom. Recent chats visible
                }
            });
        }

// TO auto Load all screens ,when multiple users use our application
setInterval(() => {
    Load();
}, 1000);

        $('.textarea').keyup(function(e){
            if(e.which == 13){          //To submit text when enter is pressed
                $('form').submit();
                document.getElementById('Form').reset();
                Load();
            }
        });

        $('form').submit(function(){
            var message=$('.textarea').val();
            $.post('handlers/messages.php?action=MessageSend&message='+message,function(response){
                if(response == 1){
                    document.getElementById('Form').reset();
                }
            });
        });
    </script>

</body>
</html>