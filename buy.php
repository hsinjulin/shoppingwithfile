<?php   
    session_start();
    //將總金額及輸入帳號以session帶出
    $price = $_SESSION["price"];
    $tel = $_SESSION["tel"];
    echo "<h1>感謝您的購買，總金額為$price 元。<h1>";

    //抓取文字檔
    $file = "bill.txt";
    //開啟並宣告
    $fp = fopen($file,"a");
    date_default_timezone_set('Asia/Taipei'); //設定時間為台北時區
    //撈取日期
    $date = date('YmdHis');
    //將日期、帳號、總金額存入內容參數
    $content = "$date,$tel,$price";
    //將內容寫入文字檔
    fwrite($fp,"$content");
  
    //關閉
    fclose($fp);


    //phpmailer
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'yourEmail@gmail.com';                     //SMTP username
        $mail->Password   = 'yourPassword';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('yourEmail@gmail.com');
        $mail->addAddress('recipient@gmail.com');     //Add a recipient


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'phpmailer test';
        $mail->Body    = "編號:$date\n電話:$tel\n價格:$price";
        $mail->AltBody = "phpmailer test";

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>