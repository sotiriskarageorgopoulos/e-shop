<?php 
include "../php/config.php";
include "../php/product.php";

$query1 = "SELECT DISTINCT P.scName FROM Product AS P
           INNER JOIN Subcategory AS S
           ON P.scName = S.scName AND S.categoryName = 'PC'";
$res1 = $con->query($query1);
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
    <a href="./index.html" id="sitename">Gaming</a>
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
                        <p class="desc"><?php echo $product->getDesc(); ?></p>
                    <?php } ?>
                    <p>Διαθέσιμη Ποσότητα: <?php echo $product->getQunatity() ?></p>
                    <legend for="<?php echo "quantity".$product->getProductId(); ?>">Ποσότητα:
                        <input type="number" id="<?php echo "quantity".$product->getProductId(); ?>" class="quantity-boxes" value="<?php echo "quantity".$product->getProductId(); ?>" min="0">
                    </legend>
                    <input type="checkbox" class="checkboxes" id="<?php echo $product->getProductName();?>" 
                    name="<?php echo $product->getProductName();?>" value="<?php echo $product->getProductName();?>">
                </figcaption>
            </figure>
            <?php }}?>
        </section>
        <?php }}
           $con->close();
           $res1->close();
           $res2->close();
        ?>
        <section class="shopping-cart">
            <p class="sc-icon" id="amount">Ποσό: 0 &euro;</p>
            <div id="sc-list1"></div>
        </section>
        <section class="display" id="form1">
            <form>
                <label for="road">Oδός*
                    <input type="text" id="road" name="road" placeholder="π.χ. Σωκράτους" value="" required>
                </label>
                <label for="road number">Αριθμός Oδού*
                    <input type="number" id="road number" name="road number" placeholder="π.χ. 24" value="" required>
                </label>
                <label for="region">Περιοχή*
                    <input type="text" id="region" name="region" placeholder="π.χ. Νέα Ιωνία" value="" required>
                </label>
                <label for="postcode">Τ.Κ*
                    <input type="number" id="postcode" name="postcode" placeholder="π.χ. 55555" value="" required>
                </label>
                <label for="express">Express Παράδοση
                    <input type="checkbox" id="express" class="form-checkbox" name="express" 
                        value="express_delivery" onclick="formCheckBox()" required>
                </label>
                <button type="button" class="next-form-button" onclick="nextFormButton()">Επόμενο</button>
                <button type="button" class="previous-form-button" onclick="previousFormButton(1)">Προηγούμενο</button>
            </form>
            <div class="new-shopping-cart display">
                <p class="sc-icon">Ποσό: 0 &euro;</p>
                <div id="sc-list"></div>
            </div>
        </section>
        <section class="display2" id="form2">
            <form>
                <label for="name" class="display3">Όνομα*
                    <input type="text" id="name" name="name" placeholder="π.χ. Γιώργος" required>
                </label>
                <label for="surname" class="display3">Επίθετο*
                    <input type="text" id="surname" name="surname" placeholder="π.χ. Παπάς" required>
                </label>
                <label for="payment">Τρόπος Πληρωμής*
                    <select id="payment" onclick="paymentChoice()" required>
                        <option value="">Επέλεξε...</option>
                        <option value="cod">Αντικαταβολή</option>
                        <option value="credit_card">Πιστωτική Κάρτα</option>
                    </select>
                </label>
                <label for="credit_card" class="display4">Πιστωτική κάρτα*
                    <select id="credit_card" required>
                        <option value="">Επέλεξε...</option>
                        <option value="VISA">VISA</option>
                        <option value="Mastercard">Mastercard</option>
                        <option value="Maestro">Maestro</option>
                        <option value="American Express">American Express</option>
                        <option value="Diners">Diners</option>
                    </select>
                </label>
                <label for="credit_card_num" class="display4">Αριθμός Κάρτας*
                    <input type="number" id="credit_card_num" name="credit_card_num" placeholder="π.χ. 1234567890234567"
                        required>
                </label>
                <label for="expiration" class="display4">Ημερομηνία Λήξης*
                    <input type="date" id="expiration" name="expiration" required>
                </label>
                <button type="button" class="confirm-form-button" onclick="confirmFormButton()">Επιβεβαίωση</button>
                <button type="button" class="previous-form-button" onclick="previousFormButton(2)">Προηγούμενο</button>
            </form>
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