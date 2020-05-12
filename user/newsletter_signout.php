<?php 

    require_once("config.php");
    ob_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $email = $link->real_escape_string($_POST['email']);

        $tab_news=["status"=>"OK", "error_code"=>"0", "error_msg"=>"You have signed out of our newsletter!", "title"=>"Success!", "icon"=>"success", "btn_text"=>"Cool!"];

        $checkEmail = $link->query("SELECT email FROM news_subscribe WHERE email='$email'");

        if ($checkEmail->num_rows > 0){

            $query = $link->query("DELETE FROM news_subscribe WHERE email='$email'");
                      
        } else {
            
            $tab_news["status"]="NOT_REGISTRED_NEWSLETTER";
            $tab_news["error_code"]="10";
            $tab_news["error_msg"]= "This email is not signed up for our newsletter.";
            $tab_news["title"]="Wait a minute...";
            $tab_news["icon"]="warning";
            $tab_news["btn_text"]="Really?";
        }

        $link->close();

        ob_end_clean();
        echo json_encode($tab_news);

        
    } else {
        
    }

?>