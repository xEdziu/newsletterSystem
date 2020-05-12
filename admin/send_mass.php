<?php 
    session_start();

    if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== 1){
        header("Location: http://yourpage.com/admin/login_admin.html");
    } 
    
?>

<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN: SEND NEWSLETTER</title>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <style>
        textarea {
            outline: none;
            resize: none;
        }
    </style>
</head>

<body>
    <hr>
    <a href="logs_newsletter.php">LOGS NEWSLETTER</a>
    <hr>
    <a href="#">MAIN PAGE</a>
    <hr>
    <form action="send_massXO.php" method="post">
        <label>Email title:</label><br><input type="text" name="title" id="title" required/><br>
        <label>Email body:</label><br><textarea cols="35" rows="10" name="body" id="body" required></textarea></br>
        <button type="submit" name="submit">Send</button>
    </form>
</body>
<script type="text/javascript">
    $(function() {
        $('form').on('submit', function(e) {
            
            e.preventDefault();

            let title = $('#title').val();
            let body = $('#body').val();
            
            body = body.replace(/\n/g, "[nl]");

            Swal.fire({
                title: "Sending messeage",
                text: "It will take a while, don't worry.",
                icon: "info",
                showConfirmButton: false,
                allowOutsideClick: false,
                allowEscapeKey: false
            });
            $.ajax({
                type: 'POST',
                url: 'send_massXO.php',
                data: {
                    title: title,
                    body: body
                },
                success: function(result) {
        
                    let data_php = JSON.parse(result);

                    Swal.fire({
                        title: data_php.title,
                        text: data_php.error_msg,
                        icon: data_php.icon,
                        confirmButtonText: data_php.btn_text,

                    })
                    $('#title').val("");
                    $('#body').val("");

                },
                error: function(data) {
                    alert("Error.");
                },
            });
        })
    });
</script>

</html>