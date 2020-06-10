<?php 
    include "../models/config.php";
    include "../models/product.php";

    function console( $data ){
        echo '<script>';
        echo "console.log($data)";
        echo '</script>';
      }
     
    session_start();
    $query1 = "SELECT DISTINCT P.scName FROM Product AS P
            INNER JOIN Subcategory AS S
            ON P.scName = S.scName AND S.categoryName = 'Playstation 3'";
    $res1 = $con->query($query1);

    $randomCompletionDate = null;
    $road = "-";
    $roadNumber = 0;
    $region = "-";
    $postcode = 0;
    $delivery = "-";
    $name = "-";
    $surname = "-";
    $payment = "-";
    $username = "-";
    $cardNumber = 0;
    $typeOfCard = "-";
    $expirationDate = null;
    $products = [];
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
    <figure>
        <img src="../icons/logo.jpg" alt="Το logo του e-gaming shop." class="img-logo">
        <figcaption>Το μόνο eshop που απευθύνεται για gamers στην Ελλάδα!</figcaption>
    </figure>
    <ul class="list-heading">
        <li><a href="./login.php" id="logout-layout">Αποσύνδεση</a></li>
    </ul>
</nav>

<body>
    <article>
        <section class="buttons-box">
            <button class="next-button" onclick="nextButton()">Επόμενο</button>
            <button class="random-button" id="check-button" onclick="checkRandomProducts()">Τυχαία Επιλογή</button>
        </section>
        <?php 
           if($res1->num_rows > 0){
             while ($subCat = $res1->fetch_assoc()){
        ?>
        <section>
            <h1 class="heading initial-heading"><?php echo $subCat["scName"]?></h1>
        </section>
        <section class="main-boxes layout layout-subcategories">
        <?php 
            $scName = $subCat["scName"];
            $query2 = "SELECT * FROM Product AS P WHERE P.scName = '$scName'";
            $res2 = $con->query($query2);

            if($res2->num_rows > 0){
                 while ($prod = $res2->fetch_assoc()){
                    $product = new Product($prod["productId"],$prod["productName"],$prod["price"],$prod["quantity"],
                                    $prod["description"],$prod["productImg"],$prod["scName"]);
                     ?>
            <figure>
                <h1 class="heading"><?php echo $product->getProductName();?></h1>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($product->getProductImg());?>" alt="<?php echo $product->getProductName();?>">
                <figcaption>
                    <p>Τιμή: <span class="price"><?php echo $product->getPrice();?></span>&euro;</p><br>
                    <?php if($product->getDesc() !== '-') {?>
                        <p><?php echo $product->getDesc(); ?></p>
                    <?php } ?>
                    <p>Διαθέσιμη Ποσότητα: <?php echo $product->getQunatity() ?></p>
                    <legend for="<?php echo "quantity".$product->getProductId(); ?>">Ποσότητα:
                        <input type="number" id="<?php echo "quantity".$product->getProductId(); ?>" class="quantity-boxes" value="" min="0">
                    </legend>
                    <input type="checkbox" class="checkboxes" id="<?php echo $product->getProductName();?>" name="products[]"
                    value="<?php echo $product->getProductName();?>" onchange="checkProduct()">
                </figcaption>
            </figure>
         <?php }}?>
        </section>
        <?php }}
           $res1->close();
           $res2->close();
        ?>
        <section class="shopping-cart">
            <p class="sc-icon" id="amount">Ποσό: 0 &euro;</p>
            <div id="sc-list1"></div>
        </section>
        <section class="display" id="form1">
            <form name="form1" action="" method="POST" target="content"  onsubmit="return nextFormButton()">
                <label for="road">Oδός*
                    <input type="text" id="road" name="road" placeholder="π.χ. Σωκράτους" value="" required>
                </label>
                <label for="road_number">Αριθμός Oδού*
                    <input type="number" id="road_number" name="road_number" placeholder="π.χ. 24" value="" required>
                </label>
                <label for="region">Περιοχή*
                    <input type="text" id="region" name="region" placeholder="π.χ. Νέα Ιωνία" value="" required>
                </label>
                <label for="postcode">Τ.Κ*
                    <input type="number" id="postcode" name="postcode" placeholder="π.χ. 55555" value="" required>
                </label>
                <label for="delivery">Express Παράδοση
                    <input type="checkbox" id="delivery" class="form-checkbox" name="delivery" 
                        value="delivery" onclick="formCheckBox()">
                </label>
                <button type="submit" name="submit1" class="next-form-button">Επόμενο</button>
                <button type="button" class="previous-form-button" onclick="previousFormButton(1)">Προηγούμενο</button>
            </form>
            <div class="new-shopping-cart display">
                <p class="sc-icon">Ποσό: 0 &euro;</p>
                <div id="sc-list"></div>
            </div>
        </section>
        <section class="display2" id="form2">
            <form name="form2" action="" method="POST" onsubmit="return confirmFormButton()">
                <label for="name" class="display3">Όνομα*
                    <input type="text" id="name" name="name" placeholder="π.χ. Γιώργος" required>
                </label>
                <label for="surname" class="display3">Επίθετο*
                    <input type="text" id="surname" name="surname" placeholder="π.χ. Παπάς" required>
                </label>
                <label for="payment">Τρόπος Πληρωμής*
                    <select name="payment" id="payment" onclick="paymentChoice()" required>
                        <option value="">Επέλεξε...</option>
                        <option value="cod">Αντικαταβολή</option>
                        <option value="credit_card">Πιστωτική Κάρτα</option>
                    </select>
                </label>
                <label for="credit_card" class="display4">Πιστωτική κάρτα*
                    <select name="credit_card" id="credit_card">
                        <option value="">Επέλεξε...</option>
                        <option value="VISA">VISA</option>
                        <option value="Mastercard">Mastercard</option>
                        <option value="Maestro">Maestro</option>
                        <option value="American Express">American Express</option>
                        <option value="Diners">Diners</option>
                    </select>
                </label>
                <label for="credit_card_num" class="display4">Αριθμός Κάρτας*
                    <input type="number" id="credit_card_num" name="credit_card_num" placeholder="π.χ. 1234567890234567">
                </label>
                <label for="expiration" class="display4">Ημερομηνία Λήξης*
                    <input type="date" id="expiration" name="expiration">
                </label>
                <div id="newCheckboxes"></div>
                <div id="newInputs"></div>
                <button type="submit" name="submit2" class="confirm-form-button">Επιβεβαίωση</button>
                <button type="button" class="previous-form-button" onclick="previousFormButton(2)">Προηγούμενο</button>
            </form>
           <?php
           
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if($_POST['name'] !== null && $_POST['surname'] !== null && $_POST['payment'] !== null){
                
                    $road = $_POST["road"];
                    $roadNumber = $_POST["road_number"];
                    $region = $_POST["region"];
                    $postcode = $_POST["postcode"];
                    $delivery = $_POST["delivery"];
                    $products = $_POST['products'];
                    $name = $_POST["name"];
                    $surname = $_POST["surname"];
                    $payment = $_POST["payment"];
                    $submissionDate = date_create()->format('Y-m-d H:i:s');

                    if($payment === "credit_card"){
                        $cardNumber = $_POST["credit_card_num"];
                        $expirationDate = $_POST["expiration"];
                        $typeOfCard = $_POST["credit_card"];
                    }
                   
                    $query3 = "SELECT username 
                            FROM Person 
                            WHERE name = '$name' AND surname = '$surname'";

                    $res3 = $con->query($query3);
                    
                    while($user = $res3->fetch_assoc()){
                        $username = $user["username"];
                    }

                    $quantities = $_POST["quantities"];

                    for($i=0; $i < count($products);$i++){

                        $product = $products[$i];
                        $quantity = $quantities[$i];

                        $query4 = "SELECT productId FROM Product WHERE productName = '$product'";
                        $res4 = $con->query($query4);
                        while($prod = $res4->fetch_assoc()){
                            $pid = $prod["productId"];

                            if($payment === "cod"){
                                $insert = "INSERT INTO OrderProduct 
                                (roadNumber,postalcode,delivery,wayOfPayment,cardNumber,expirationDateOfCard,completionDate,
                                productId,username,typeOfCard,road,quantity,submissionDate)
                                VALUES('$roadNumber','$postcode','$delivery','$payment','$cardNumber',NULL,NULL,
                                '$pid','$username','$typeOfCard','$road','$quantity','$submissionDate')";
                            
                                $res5 = $con->query($insert);
                            }
                            else {
                                $insert = "INSERT INTO OrderProduct 
                                (roadNumber,postalcode,delivery,wayOfPayment,cardNumber,expirationDateOfCard,completionDate,
                                productId,username,typeOfCard,road,quantity)
                                VALUES('$roadNumber','$postcode','$delivery','$payment','$cardNumber','$expirationDate',NULL,
                                '$pid','$username','$typeOfCard','$road','$quantity','$submissionDate')";
                            
                                $res5 = $con->query($insert);
                            }
                        }
                    }
                    echo "<script language='javascript'>";
                    echo "window.location.href = 'login.php';";
                    echo "</script>";
                }
           }
           $con->close();
            ?>
            <iframe name="content"></iframe>
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