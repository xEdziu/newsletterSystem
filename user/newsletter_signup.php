<?php 

    require_once('config.php');
    require_once(__DIR__.'/PHPMailer-5.2-stable/PHPMailerAutoload.php');

    ob_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $email = $link->real_escape_string($_POST['email']);
        $title = 'Thanks for joining our newsletter!';
        $body = 'Type your message here!';

        $tab_news=["status"=>"OK", "error_code"=>"0", "error_msg"=>"You are signed up for our newsletter", "title"=>"Success!", "icon"=>"success", "btn_text"=>"Cool!"];

        $checkEmail = $link->query("SELECT email FROM news_subscribe WHERE email='$email'");

        if ($checkEmail->num_rows > 0){

            $tab_news["status"]="ALREADY_REGISTRED_NEWSLETTER";
            $tab_news["error_code"]="9";
            $tab_news["error_msg"]= "You're already registered for our newsletter!";
            $tab_news["title"]="Wait a minute...";
            $tab_news["icon"]="warning";
            $tab_news["btn_text"]="Oh!";
                      
        } else {

            $query = $link->query("INSERT INTO news_subscribe VALUES (0,'$email')");

            $mail = new PHPMailer();
                $mail->CharSet = "UTF-8";
                $mail->IsSMTP();
                $mail->Host = $serwer_smtp; 
                $mail->Port = $port_smtp; 
                $mail->SMTPAuth = true; 
                $mail->Username = $smtplog;
                $mail->Password = $smtppass;
                $mail->From = 'from who?'; 
                $mail->SMTPSecure = 'ssl';
                $mail->FromName = 'from who?'; 
                $mail->AddAddress($email);
                $mail->WordWrap = 50;
                $mail->Priority = 1;
                $mail->Subject = 'Newsletter';
                $mail->Body='<!DOCTYPE html>
                <html>
                
                <head>
                    <meta charset="utf-8">
                    <title>Newsletter</title>
                    <style type="text/css">
                        body {
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            height: 100vh;
                            overflow: hidden;
                        }
                        
                        main {
                            height: 100vh;
                            width: 100%;
                        }
                        
                        header {
                            background-color: rgb(84, 150, 255);
                            height: 10vh;
                            text-align: center;
                            font-size: 7vh;
                            font-family: "Arial";
                            line-height: 10vh;
                            color: white;
                            margin-top: 10vh;
                            margin-right: 20%;
                            margin-left: 20%;
                            margin-bottom: 10vh;
                        }
                        
                        .textt {
                            font-size: 20px;
                            font-size: 3vh;
                            text-align: center;
                            font-family: "verdana";
                            margin-right: 20%;
                            margin-left: 20%;
                            margin-bottom: 10vh;
                        }
                        
                        .c {
                            font-size: 3vh;
                            margin-right: 1vh;
                            color: black;
                            position: absolute;
                            right: 50vh;
                            font-family: "verdana";
                        }
                </head>
                
                <body>
                    <main>
                        <header>
                            SIGN UP
                        </header>
                        <div class="textt">
                            '.$body.'
                        </div>
                        <div class="c">
                            Your company name.
                        </div>
                    </main>
                
                </body>
                
                </html>';
                $mail->isHTML(true);
                $mail->AltBody = $body;
                

                if(!$mail->send()) {
                    echo 'Message was not sent.';
                    echo 'Mailer error: ' . $mail->ErrorInfo;
                    
                    $tab_news["error_msg"]= "Mail hasn't been send, contact administration, to activate your account manually.";
                    $tab_news["title"]="System failure. ".$mail->ErrorInfo;
                    $tab_news["icon"]="error";
                    $tab_news["btn_text"]="OK"; 

                }
        }

        $link->close();

        ob_end_clean();
        echo json_encode($tab_news);

        
    } else {
        echo 'NO DATA';
    }

?>
