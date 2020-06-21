<?php 
    include "../models/config.php";
    include "../models/category.php";

    session_start();
    $query1 = "SELECT * FROM Category";
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
        <section>
            <h1 class="heading initial-heading">Κατηγορίες</h1>
        </section>
        <section class="main-boxes layout layout-category">
            <?php 
                if($res1->num_rows > 0){
                   while ($cat = $res1->fetch_assoc()){
                       $category = new Category($cat["categoryName"],$cat["categoryImg"]);
                       $categoryName = $category->getCategoryName();
                ?>
            <figure>
                    <a href="./category_product.php?name=<?php echo $categoryName; ?>" target="_blank">
                    <p class="heading"><?php echo $categoryName; ?></p>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($category->getCategoryImg());?>" alt="<?php echo $categoryName; ?>" />
                    <div class="overlay-category">
                        <div id="text-category">
                        <?php 
                          $query2="SELECT * FROM Subcategory WHERE categoryName = '$categoryName'";
                          $res2 = $con->query($query2);
                          if($res2->num_rows > 0){
                          while ($subCat = $res2->fetch_assoc()){
                              $category->setSubcategoryName($subCat["scName"]);  
                              $scName = $category->getSubcategoryName();
                            ?>
                            <p class="tick"><?php echo $scName;?></p>
                        <?php }
                        ?>
                        </div>
                    </div>
                </a>
            </figure>
            <?php 
                }}}
                $con->close();
                $res1->close();
                $res2->close();
            ?>
    </article>
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