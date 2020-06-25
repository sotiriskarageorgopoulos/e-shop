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
    <h1 id="sitename">Gaming</h1>
    <figure class="center-logo">
        <img src="../icons/logo.jpg" alt="Το logo του e-gaming shop." class="img-logo">
        <figcaption>Το μόνο eshop που απευθύνεται για gamers στην Ελλάδα!</figcaption>
    </figure>
</nav>

<body>
    <form class="admin-login" method="POST" action="">
        <label for="username">Όνομα Διαχειριστή
            <input type="text" id="username" name="username" placeholder="π.χ user123" required>
        </label>
        <label for="password">Συνθηματικό
            <input type="password" id="password" name="password" placeholder="π.χ 123" required>
        </label>
        <button type="submit" class="login-button">Σύνδεση</button>
    </form>
    <?php 
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           $username = $_POST["username"];
           $password = $_POST["password"];
           if($username === "admin" && $password === "admin"){
              header('Location: ./manage_products.php');
           }
       }
    ?>
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