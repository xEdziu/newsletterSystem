<?php

    session_start();

    require_once('config.php');

    if(!isset($_SESSION['admin']) || $_SESSION['admin'] !== 1){
        header("Location: http://yourpage.com/admin/login_admin.html");
    } 
    
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGS - NEWSLETTER</title>
</head>

<body>
<hr>
<a href="send_mass.php">SEND MASS EMAIL</a>
<hr>
<a href="#">MAIN PAGE</a>
<hr>
<table>
<thead>
    <th>ID</th>
    <th>TITLE MESSEAGE</th>
    <th>BODY MESSEAGE</th>
    <th>DATE</th>
</thead>
    <?php 
        $query = $link->query("SELECT * FROM news_messeages ORDER BY id ASC");
        echo "<tbody>";
        while($row = $query->fetch_assoc()){
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['title'] . '</td>';
            echo '<td>' . $row['body'] . '</td>';
            echo '<td>' . $row['date'] . '</td>';
            echo '</tr>';
        } 
        echo "</tbody>";
    ?>
</table>

</body>

</html>

