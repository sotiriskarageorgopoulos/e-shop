<?php 
    include "../models/config.php";
    session_start();
    if(isset($_SESSION["username"])){
    $query1 = "SELECT username,postImg 
               FROM Post";
    $res1 = $con->query($query1);
    function console( $data ){
        echo '<script>';
        echo "console.log($data)";
        echo '</script>';
      }
      
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
    <figure class="ipad-style-nav-style">
        <img src="../icons/logo.jpg" alt="Το logo του e-gaming shop." class="img-logo">
        <figcaption>Το μόνο eshop που απευθύνεται για gamers στην Ελλάδα!</figcaption>
    </figure>
</nav>
<body>
    <article>
        <section class="buttons-box">
            <button class="foto-submission-btn" onclick="createSubmitFotoForm()">Υποβολή Φωτογραφίας</button>
        </section>
        <section>
            <form class="foto-submit-form" action="" enctype="multipart/form-data" method="POST">
                <label for="foto" id="labelFoto">
                    <p>Υποβολή Φωτογραφίας</p>
                    <input type="file" id="foto" name="image">
               </label>
               <button type="submit" class="foto-submit-btn">Υποβολή</button>
            </form>
            <?php 
               if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $username = $_SESSION["username"];
                        $submissionDate = date_create()->format('Y-m-d H:i:s');
                        $img = bin2hex(file_get_contents($_FILES["image"]["tmp_name"]));
                        $query2 = "INSERT INTO Post (postImg,username,submissionDate)
                                            VALUES('$img','$username','$submissionDate')";
                        $res2 = $con->query($query2); 
                        echo '<script language="javascript">';
                        echo 'window.location.href = window.location.href;';
                        echo '</script>';                   
               }
            ?>
        </section>
        <section class="main-boxes layout">
            <?php 
              while($post = $res1->fetch_assoc()){?>
              <figure>
                <img src="data:image/jpeg;base64,<?php echo base64_encode(hex2bin($post["postImg"]));?>">
                <figcaption><?php echo $post["username"]; ?></figcaption>
              </figure>
              <?php } 
            }?>
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