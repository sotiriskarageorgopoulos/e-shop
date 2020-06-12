<?php 
    include "../models/config.php";
    include "../models/person.php";
   
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
    <a href="./index.html" id="sitename">Gaming</a>
    <figure class="ipad-style-nav-style">
        <img src="../icons/logo.jpg" alt="Το logo του e-gaming shop." class="img-logo">
        <figcaption>Το μόνο eshop που απευθύνεται για gamers στην Ελλάδα!</figcaption>
    </figure>
</nav>
<body>
<?php   
    $query = "SELECT username FROM Person";
    $res = $con->query($query);
    $isUniqueUsername = true;

    while($p = $res->fetch_assoc()){
        if($p["username"] === $_POST["username"]){
            $isUniqueUsername = false;
        }
    }

    if($isUniqueUsername === true){
        $password = generateRandomString();

        $person = new Person($_POST["name"],$_POST["surname"],$_POST["username"],$_POST["e-mail"],$password,
             $_POST["road"],$_POST["roadnumber"],$_POST["region"],$_POST["postcode"],$_POST["phonenumber"]);
                    
        $person->setPassword(encryptPassword($password));
        $person->setNotify(0); //the user is not notified for offers(default)

        $insert = "INSERT INTO Person (username,name,surname,email,password,road,roadNumber,region,postalcode,phoneNumber,notify)
                    VALUES ('".$person->getUsername()."','".$person->getName()."','".$person->getSurname()."',
                    '".$person->getEmail()."','".$person->getPassword()."','".$person->getRoad()."',
                    '".$person->getRoadNumber()."','".$person->getRegion()."','".$person->getPostalCode()."',
                    '".$person->getPhoneNumber()."','".$person->getNotify()."')"; 
        $res = $con->query($insert);

        $msg = "Ο κωδικός σας για την σύνδεση στο E-Gaming είναι: ".$password;
        $msg = wordwrap($msg,70);
        $subject = "Εγγραφή στο E-Gaming!";
        $mail= mail($person->getEmail(),$subject,$msg);
        
        if($mail){ ?>
        
        <div class="notification-layout">
            <h1>Σας έχει σταλεί στο email ο κωδικός πρόβασης!</h1>
        </div>
    
    <?php }
        else{ ?>
        <div class="notification-layout">
            <h1>Απέτυχε η αποστολή του κωδικού στο email σας.</h1>
        </div>
    <?php    }
    
        $con->close();
   }
    else {
        $_SESSION["existUsername"] = "Το όνομα χρήστη υπάρχει ήδη!";
        header('Location: ./register.php');
    }
                
    function encryptPassword($password){
        $pass = '3sc3RLrpd17';
        $key = substr(hash('sha256', $pass, true), 0, 32);
        $cipher = 'aes-256-gcm';
        $iv_len = openssl_cipher_iv_length($cipher);
        $tag_length = 16;
        $iv = openssl_random_pseudo_bytes($iv_len);
        $tag = ""; // will be filled by openssl_encrypt
        
        $ciphertext = openssl_encrypt($password, $cipher, $key, OPENSSL_RAW_DATA, $iv, $tag, "", $tag_length);
        $encrypted = base64_encode($iv.$tag.$ciphertext);
        return $encrypted;
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
 ?>

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
