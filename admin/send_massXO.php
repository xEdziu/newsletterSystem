<?php

    
    require_once('config.php');
    require_once('/PHPMailer-5.2-stable/PHPMailerAutoload.php');

    ob_start();
        if ( $_SERVER["REQUEST_METHOD"] == "POST"){ 
            
            $title = $link->real_escape_string($_POST["title"]);

            $body = $link->real_escape_string($_POST["body"]);
            $body = preg_replace("#\[nl\]#", "<br>\n", $body);

            $time = date("Y-m-d");

            $logQuery = $link->query("INSERT INTO news_messeages VALUES (0, '$title', '$body', '$time')");


            $tabSendMail =["unsend"=>"null","status"=>"OK", "error_code"=>"0", "error_msg"=>"Messeage send!", "title"=>"Success!", "icon"=>"success", "btn_text"=>"Jej!"];

            $listEmail = $link->query("SELECT * FROM news_subscribe");
            
            while ($row = $listEmail->fetch_assoc()){

                $tmpEmail = $row['email'];
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
                $mail->AddAddress($regEmail);
                $mail->WordWrap = 50;
                $mail->Priority = 1;
                $mail->Subject = 'MESSEAGE';
                $mail->Body='<!DOCTYPE html>
                <html>
                
                <head>
                    <meta charset="utf-8">
                    <title>MESSEAGE</title>
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
                            MESSEAGE
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
                    
                    $tabSendMail["error_msg"]= "Mail hasn't been send, contact administration, to activate your account manually.";
                    $tabSendMail["title"]="System failure. ".$mail->ErrorInfo;
                    $tabSendMail["icon"]="error";
                    $tabSendMail["btn_text"]="OK"; 

                }else{
                    $mail->clearAddresses();
                }
                
            }

            $link->close();

            ob_end_clean();

            echo json_encode($tabSendMail);
        } else {
            echo "No data";
        }
        
        
    
?>