<?php 
  include '../models/config.php';
  session_start();
  
  if(isset($_SESSION["username"])){
    $username = $_SESSION["username"];

    $query1 = "SELECT DISTINCT O.orderId,O.productId,O.quantity,O.submissionDate 
      FROM OrderProduct AS O
      WHERE O.username='$username'";

    function console( $data ){
        echo '<script>';
        echo "console.log($data)";
        echo '</script>';
    }
      
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
    <figure class="ipad-style-nav-style">
        <img src="../icons/logo.jpg" alt="Το logo του e-gaming shop." class="img-logo">
        <figcaption>Το μόνο eshop που απευθύνεται για gamers στην Ελλάδα!</figcaption>
    </figure>
</nav>
<body>
<article>
        <section class="buttons-box">
            <button class="print-order-btn" onclick="printOrderHistory()">Εκτύπωση</button>
        </section>
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
       <form class="order-layout" action="" method="POST">
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
                <input name="delQuantity" value="<?php echo $quantity; ?>">
            </div>
            <div id="addDelQuantities"></div>
            <button type="submit" class="delete-order-btn">Aκύρωση</button>
        </form>
       <?php }?>
        <?php 
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if(isset($_POST["deletedPid"]) && isset($_POST["delQuantity"])){
                    $delPid = $_POST["deletedPid"];
                    $newQuantity = intval($_POST["delQuantity"]);

                    $query4 = "SELECT quantity FROM Product WHERE productId = $delPid";
                    $res4 = $con->query($query4);
                    if($res4->num_rows > 0) {
                        console("'$res4->num_rows'");
                        while($prod = $res4->fetch_assoc()){
                            $prodQuantity = intval($prod["quantity"]);
                            $prodQuantity += $newQuantity;
                            $query5 = "UPDATE Product SET quantity='$prodQuantity' WHERE productId = $delPid";
                            $res5 = $con->query($query5);
                        }
                    }
                    
                    $query3 = "DELETE FROM OrderProduct 
                                WHERE productId = $delPid";
                    $con->query($query3);
                    
                    echo '<script language="javascript">';
                    echo 'window.location.href = window.location.href;';
                    echo '</script>';
            }   
          }
        ?>
    <?php 
    }
   }
    $con->close();
    ?>
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