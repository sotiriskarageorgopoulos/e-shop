<?php 
 session_start();
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
        <li><a href="./index.html" id="logout-layout">Αποσύνδεση</a></li>
    </ul>
</nav>

<body>
    <article>
        <section id="pop">
            <button id="close" onclick="delPopUp()">X</button>
            <h1 id="popup-title">Gaming</h1>
            <label for="e-mail-popup" id="popup-text">Για νέες προσφορές κάνε subscribe στο newsletter μας !
                <input type="email" id="e-mail-popup" name="e-mail" placeholder="π.χ.crisbrown@domain.com" required>
            </label>
            <div id="pop-up-buttons">
                <button onclick="registerPopUp()">Εγγραφή</button>
                <button onclick="delPopUp()">Δεν επιθυμώ</button>
            </div>
        </section>
        <section class="list-of-buttons">
            <a href="./category.html" class="menu-button">Κατηγορίες Προϊόντων</a>
            <a href="" class="menu-button">Ιστορικό Παραγγελιών</a>
            <a href="" class="menu-button">Συλλογή Φωτογραφιών</a>
        </section>
    </article>
</body>
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