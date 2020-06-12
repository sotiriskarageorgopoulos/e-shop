<?php 
  include '../models/config.php';
  session_start();
  
  if(isset($_SESSION["username"])){
    $username = $_SESSION["username"];

    $query1 = "SELECT DISTINCT O.orderId,O.productId,O.quantity,O.submissionDate 
      FROM OrderProduct AS O
      WHERE O.username='$username'";
      
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
    <a href="./index.html" id="sitename">Gaming</a>
    <figure class="ipad-style-nav-style">
        <img src="../icons/logo.jpg" alt="Το logo του e-gaming shop." class="img-logo">
        <figcaption>Το μόνο eshop που απευθύνεται για gamers στην Ελλάδα!</figcaption>
    </figure>
</nav>
<body>
<article>
    <section>
        <h1 class="heading initial-heading">Παραγγελίες</h1>
    </section>
    <?php 
    ?>
  <section class="main-boxes layout layout-subcategories">
    <?php  
       if($res1->num_rows > 0){
        while($order = $res1->fetch_assoc()){ 
          $quantity = $order["quantity"]; 
          $id = $order["orderId"];
        ?>
       <form class="order-layout" action="" method="POST">
           <?php 
               $pid = $order["productId"];
               $query2 = "SELECT P.productName,P.price
               FROM Product AS P
               WHERE P.productId = $pid;";
               $res2 = $con->query($query2);
               while($prod = $res2->fetch_assoc()){
                $productName = $prod["productName"];
                $price = $prod["price"];
           ?>
           <p class="order-details">Προϊόν: <?php echo $productName;?></p>
           <p class="order-details">Ποσότητα: <?php echo $quantity;?></p>
           <p class="order-details">Τιμή: <?php echo $price;?></p>
           <p class="order-details">Συνολικά Έξοδα: <?php echo $quantity*$price;?></p>
            <?php }
            $submissionDate = $order["submissionDate"];
            ?>
            <p class="order-details">Ημερομηνία Διεκπεραίωσης: <?php echo $submissionDate;?></p>
            <div id="value">
                <input name="deletedPid" value="<?php echo $pid; ?>">
            </div>
            <button type="submit" class="delete-order-btn">Aκύρωση</button>
        </form>
        <?php 
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if(isset($_POST["deletedPid"])){
                    $delPid = $_POST["deletedPid"];
                    $query3 = "DELETE FROM OrderProduct 
                               WHERE productId = $delPid";
                    $con->query($query3);
                    echo '<script language="javascript">';
                    echo 'window.location.href = window.location.href;';
                    echo '</script>';
                }
            }   
          }
        ?>
    <?php   
      }
      $con->close();
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