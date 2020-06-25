<?php 
 include "../models/config.php"; 
 session_start();
 if($_SESSION["username"]){
     $username = $_SESSION["username"];
     $query1 = "SELECT notify FROM Person WHERE username='$username'";
     $res1 = $con->query($query1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../icons/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../css/my_app.css">
    <title>E-Gaming</title>
</head>
<nav>
    <a href="./login.php" id="sitename">Gaming</a>
    <figure>
        <img src="../icons/logo.jpg" alt="Το logo του e-gaming shop." class="img-logo">
        <figcaption>Το μόνο eshop που απευθύνεται για gamers στην Ελλάδα!</figcaption>
    </figure>
    <ul class="list-heading">
    <li id="logout-layout" onclick="logOut()">Αποσύνδεση</li>
    </ul>
</nav>

<body>
    <article>
        <?php 
          while($user = $res1->fetch_assoc()){
            $notify = intval($user["notify"]);
            if($notify === 0){
        ?>
        <form action="" method="POST" id="pop" onsubmit="registerPopUp()">
            <button id="close" onclick="delPopUp()">X</button>
            <h1 id="popup-title">Gaming</h1>
            <label for="e-mail-popup" id="popup-text">Για νέες προσφορές κάνε subscribe στο newsletter μας !
                <input type="email" id="e-mail-popup" name="e-mail" placeholder="π.χ.crisbrown@domain.com" required>
            </label>
            <div id="pop-up-buttons">
                <button type="submit">Εγγραφή</button>
                <button type="button" onclick="delPopUp()">Δεν επιθυμώ</button>
            </div>
        </form>
          <?php }
             if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if(isset($_POST["e-mail"])){
                    $email = $_POST["e-mail"];
                    $notify = 1;
                    $query2 = "UPDATE Person SET notify='$notify' WHERE email='$email'";
                    $res2 = $con->query($query2);

                    echo '<script language="javascript">';
                    echo 'window.location.href = window.location.href;';
                    echo '</script>';
                }
             }
            }
          ?>
        <section class="list-of-buttons">
            <a href="./category.php" class="menu-button">Κατηγορίες Προϊόντων</a>
            <a href="./order_history.php" class="menu-button">Ιστορικό Παραγγελιών</a>
            <a href="./photo_collection.php" class="menu-button">Συλλογή Φωτογραφιών</a>
        </section>
    </article>
</body>
 <?php } ?>
<footer>
    <article class="footer-layout">
        <section>
            <p id="footer-msg">Άμεση εξυπηρέτηση <br>σε 24 ώρες από την στιγμή της παραγγελίας</p>
        </section>
        <section>
            <p id="footer-copyright">&copy; Copyright
                <script>
                    document.write(new Date().getFullYear());
                </script>
            </p>
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