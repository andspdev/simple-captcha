<?php

session_start();

if (isset($_POST['captcha']) && (!empty($_POST['captcha']))) 
{
    if (strcasecmp($_SESSION['captcha'], $_POST['captcha']) != 0)
        $msg = '<span class="error">Kode captcha salah, silahkan coba lagi.</span>';
    else
        $msg = '<span class="sukses">Kode captcha Anda benar.</span>';
}

?>

<html>
    <head>
        <title>Captcha Sederhana - Script PHP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <style type="text/css">
            body {
                margin: 20px;
                font-size: 15px
            }
            a {
                text-decoration: none
            }
            .error {
                background: #ff0000;
                padding: 5px 8px;
                color: #fff
            }
            .sukses {
                background: #46ab4a;
                padding: 5px 8px;
                color: #fff
            }
        </style>
    </head>

    <body>
        <h1>Captcha Sederhana - Script PHP</h1>

        <form name="form" method="post" action="">
            <?=isset($msg) ? $msg.'<br/><br/>' : ''?>

            <label><strong>Ketik kode Captcha:</strong></label><br/>
            
            <input type="text" name="captcha" />
            <p><br /><img src="captcha.php?rand=<?=rand();?>" id="captcha_image" width="150" /></p>
            
            <p>Sulit membaca captcha? <a href='javascript:ulangCaptcha();'>klik disini</a> untuk ulang.</p>
            <input type="submit" name="submit" value="Submit">
        </form>
        
        <br /><br/>

        <script>
            function ulangCaptcha()
            {
                const img = document.images['captcha_image'];
                img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random() * 1000;
            }
        </script>
    </body>
</html>