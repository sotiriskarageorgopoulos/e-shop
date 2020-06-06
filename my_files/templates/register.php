<?php 
   session_start();
   if($_SESSION["existUsername"] !== null){
       $msg = $_SESSION["existUsername"];
       $_SESSION["existUsername"] = null;
       echo '<script language="javascript">';
       echo 'alert("Το όνομα χρήστη υπάρχει ήδη!")';
       echo '</script>';
   }
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
    <a href="./login.php" id="sitename">Gaming</a>
    <figure class="ipad-style-nav-style">
        <img src="../icons/logo.jpg" alt="Το logo του e-gaming shop." class="img-logo">
        <figcaption>Το μόνο eshop που απευθύνεται για gamers στην Ελλάδα!</figcaption>
    </figure>
</nav>

<body>
    <h1 class="heading initial-heading">Εγγραφή</h1>
    <form method="POST" action="./insert_register_db.php" onsubmit="return validRegister()">
        <label for="username">Όνομα Χρήστη*
            <input type="text" id="username" name="username" placeholder="π.χ. George" required>
        </label>
        <label for="name">Όνομα*
            <input type="text" id="name" name="name" placeholder="π.χ. Γιώργος" required>
        </label>
        <label for="surname">Επίθετο*
            <input type="text" id="surname" name="surname" placeholder="π.χ. Παπάς" required>
        </label>
        <label for="road">Οδός*
            <input type="text" id="road" name="road" placeholder="π.χ. Σωκράτους" required>
        </label>
        <label for="roadnumber">Αριθμός Οδού*
            <input type="text" id="roadnumber" name="roadnumber" placeholder="π.χ.42" required>
        </label>
        <label for="region">Περιοχή*
            <input type="text" id="region" name="region" placeholder="π.χ. Νέα Σμύρνη" required>
        </label>
        <label for="postcode">Τ.Κ*
            <input type="number" id="postcode" name="postcode" placeholder="π.χ. 55555" required>
        </label>
        <label for="phonenumber">Τηλέφωνο*
            <input type="text" id="phonenumber" name="phonenumber" placeholder="π.χ. 690000000" required>
        </label>
        <label for="e-mail">Email*
            <input type="email" id="e-mail" name="e-mail" placeholder="π.χ.crisbrown@domain.com" required>
        </label>
        <button type="submit" class="register-button">Εγγραφή</button>
    </form>
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