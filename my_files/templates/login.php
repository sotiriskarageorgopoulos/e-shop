<?php 
    include "../models/config.php"; 
    session_start();
?>
<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../icons/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../css/my_app.css">
    <title>E-Gaming</title>
</head>
<nav>
    <h1 id="sitename" href="login.php">Gaming</h1>
    <figure>
        <img src="../icons/logo.jpg" alt="Το logo του e-gaming shop." class="img-logo">
        <figcaption>Το μόνο eshop που απευθύνεται για gamers στην Ελλάδα!</figcaption>
    </figure>
    <p id="admin-choice-btn" onclick="goToAdminPage()">Σελίδα Διαχειριστή</p>
    <ul class="list-heading-login">
        <li id="register-layout" onclick="goToRegisterPage()">Εγγραφή</li>
    </ul>
</nav>

<body>
    <article>
        <section id="slogan-layout">
            <p>&quot; Ψάχνεις να βρείς gaming εξοπλισμό;</p>
            <p>Εδώ θα βρεις ότι χρειάζεσαι! &quot;</p>
        </section>
        <section>
            <form method="POST" action="login.php">
                <label for="username">Όνομα Χρήστη
                    <input type="text" id="username" name="username" placeholder="π.χ user123" required>
                </label>
                <label for="password">Συνθηματικό
                    <input type="password" id="password" name="password" placeholder="π.χ 123" required>
                </label>
                <button type="submit" class="login-button">Σύνδεση</button>
            </form>
            <?php 

            function decryptPassword($password){
                $encrypted = base64_decode($password);
                $pass = '3sc3RLrpd17';
                $key = substr(hash('sha256', $pass, true), 0, 32);
                $cipher = 'aes-256-gcm';
                $iv_len = openssl_cipher_iv_length($cipher);
                $tag_length = 16;
                $iv = substr($encrypted, 0, $iv_len);
                $tag = substr($encrypted, $iv_len, $tag_length);
                $ciphertext = substr($encrypted, $iv_len + $tag_length);
                
                $decrypted = openssl_decrypt($ciphertext, $cipher, $key, OPENSSL_RAW_DATA, $iv, $tag);
                return $decrypted;
            }

            function console($msg){
                echo "<script language='javascript'>";
                echo "console.log($msg)";
                echo "</script>";
            }
              if(isset($_POST['username']) && isset($_POST["password"])){
                $username = $_POST['username'];
                $password = $_POST["password"];
                $_SESSION["username"] = $username;
                $_SESSION["password"] = $password;
                $isValidUsername = false;

                $query = "SELECT username FROM Person";
                $res = $con->query($query);
                
                while($user = $res->fetch_assoc()){
                    if($username === $user["username"]){
                        $isValidUsername = true;
                    }
                }
            
                if($isValidUsername){
                    $query = "SELECT password FROM Person WHERE username = '$username'";
                    $res1 = $con->query($query);
                    $_SESSION["username"] = $username;
                    while($user = $res1->fetch_assoc()){
                        $decryptedPass = decryptPassword($user["password"]);
                        if($decryptedPass === $password){
                           header('Location: ./menu.php');
                        }
                        else{
                            echo "<script language='javascript'>";
                            echo "alert('Τα στοιχεία σας είναι λανθασμένα!')";
                            echo "</script>";
                        }
                    }
                }
            }
            ?>
        </section>
        <section>
            <div class="final-result">
                <div class="content">
                    <div>
                        <div class="final__path">
                            <div class="final__pacman"></div>
                            <div class="final__ghost">
                                <div class="final__eyes"></div>
                                <div class="final__skirt"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>
</body>
<footer>
    <article class="footer-layout">
        <section>
            <p id="footer-msg">Άμεση εξυπηρέτηση <br>σε 24 ώρες από την στιγμή της παραγγελίας</p>
        </section>
        <section>
            <p id="footer-copyright">&copy; Copyright 2020</p>
        </section>
        <section id="footer-contact-details">
            <a href="tel:+302100000000000">
                <p class="phone-icon icon"> +302100000000000</p>
            </a>
            <a href="mailto:gaming@eshop.com">
                <p class="envelope-icon icon"> gaming@eshop.com</p>
            </a>
        </section>
    </article>
</footer>
<script src="https://use.fontawesome.com/4d997e20ff.js"></script>
<script src="../js/index.js"></script>

</html>