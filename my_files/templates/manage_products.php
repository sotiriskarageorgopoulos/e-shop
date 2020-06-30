<?php 
    include "../models/config.php"; 
    session_start();
    $query1 = "SELECT categoryName,categoryImg FROM Category";
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
    <a href="./admin_page.php" id="sitename">Gaming</a>
    <figure>
        <img src="../icons/logo.jpg" alt="Το logo του e-gaming shop." class="img-logo">
        <figcaption>Το μόνο eshop που απευθύνεται για gamers στην Ελλάδα!</figcaption>
    </figure>
    <ul class="list-heading">
        <li id="logout-layout" onclick="logOut()">Αποσύνδεση</li>
    </ul>
</nav>
<body>
    <section class="buttons-box">
        <button class="admin-ins-btn" onclick="displayAdminInsForm('category')">Εισαγωγή Κατηγορίας</button>
        <button class="admin-ins-btn" onclick="displayAdminInsForm('product')">Εισαγωγή Προϊόντος</button>
        <button class="admin-ins-btn" onclick="displayAdminInsForm('message')">Αποστολή Μηνύματος</button>
    </section>
    <section>
        <form action="" method="POST" id="admin-ins-form-message">
            <p class="heading">Αποστολή Μηνύματος</p>
            <label for="subject">Θέμα
                <input type="text" id="subject" class="admin-category-input" name="subject" value="" required>
            </label>
            <label for="productDesc">
                <textarea id="productDesc" class="admin-category-textarea tetxarea-message" maxlength="400" name="message"></textarea>
            </label>
            <button type="submit" class="ins-admin-btn">Αποστολή</button>
        </form>
    </section>
    <section>
        <form action="" method="POST" enctype="multipart/form-data" id="admin-ins-form-prod">
            <p class="heading">Εισαγωγή Προϊόντος</p>
            <label for="productName">Τίτλος Προϊόντος
                <input type="text" id="productName" class="admin-category-input" name="insProductName" value="" required>
            </label>
            <label for="productPrice">Τιμή Προϊόντος
                <input type="number" id="productPrice" class="admin-category-input" name="insProductPrice" min="0" value="" required>
            </label>
            <label for="quantity">Απόθεμα Προϊόντος
                <input type="number" id="quantity" class="admin-category-input" name="insProductQuantity" min="0" value="" required>
            </label>
            <label for="productSc">Υποκατηγορία Προϊόντος
            <select name="insProductSc" id="productSc" class="admin-category-input" required>
                <option value="">Επέλεξε...</option>
                <?php 
                    $query9 = "SELECT scName FROM Subcategory";
                    $res9 = $con->query($query9);
                    while($sc = $res9->fetch_assoc()){
                ?>
                <option value="<?php echo $sc["scName"]; ?>"><?php echo $sc["scName"]; ?></option>
                    <?php } ?>
            </select>
            </label>
            <label for="productDesc">Περιγραφή Προϊόντος
                <textarea id="productDesc"  rows="5" cols="1" class="admin-category-textarea" maxlength="400" name="insProductDesc"></textarea>
            </label>
            <label for="productImg">Εικόνα Προϊόντος
                <input type="file" id="productImg" name="productImg" required>
            </label>
            <button type="submit" class="ins-admin-btn">Εισαγωγή</button>
        </form>
    </section>
    <section>
        <form action="" method="POST" enctype="multipart/form-data" id="admin-ins-form">
            <p class="heading">Εισαγωγή Κατηγορίας</p>
            <label for="categoryName">Όνομα Κατηγορίας
                <input type="text" id="categoryName" class="admin-category-input" name="insCategoryName" value="">
            </label>
            <label for="categoryImg">Επιλογή Εικόνας Κατηγορίας
                <input type="file" id="categoryImg" name="image">
            </label>
            <div id="subcategoriesInputs"></div>
            <button type="button" class="ins-admin-btn" onclick="createSubCategoryInputs()">Εισαγωγή Υποκατηγορίας</button>
            <button type="submit" class="ins-admin-btn">Εισαγωγή</button>
        </form>
    </section>
    <section>
        <h1 class="heading initial-heading">Κατηγορίες Προϊόντων</h1>
    </section>
    <section class="main-boxes layout admin-categories">
        <?php 
        while($cat = $res1->fetch_assoc()){
            $img = $cat["categoryImg"];
            $categoryName = $cat["categoryName"];
        ?>
        <form action="" method="POST">
            <p class="heading"><?php echo $categoryName?></p>
            <?php if(ctype_xdigit($img)) {?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode(hex2bin($img));?>" alt="<?php echo $categoryName;?>">
            <?php } else { ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($img);?>" alt="<?php echo $categoryName;?>" />
            <?php }?>
            <input type="hidden" name="delCategoryName" value="<?php echo $categoryName;?>">
            <button type="submit" class="del-admin-btn">Διαγραφή</button>
            <button type="button" class="upd-admin-btn" onclick="displayAdminUpFormTitle('<?php echo $categoryName;?>')">Ενημέρωση Tίτλου</button>
            <button type="button" class="upd-admin-btn" onclick="displayAdminUpFormImg('<?php echo $categoryName;?>')">Ενημέρωση Εικόνας</button>
        </form>
        <?php }?>
    </section>
    <section>
        <form action="" method="POST" id="admin-up-form">
            <p class="heading">Ενημέρωση Κατηγορία Προϊόντος</p>
            <label for="categoryName">Όνομα Κατηγορίας
                <input type="text" id="categoryName" class="admin-category-input" name="upCategoryName" value="">
            </label>
            <input type="hidden" name="prevCategoryName" id="prevCategoryName">
            <button type="submit" class="upd-admin-btn">Ενημέρωση</button>
        </form>
    </section>
    <section>
        <form action="" method="POST" enctype="multipart/form-data" id="admin-up-form1">
            <p class="heading">Ενημέρωση Εικόνας Κατηγορίας</p>
            <label for="categoryImg">Επιλογή Εικόνας Κατηγορίας
                <input type="file" id="categoryImg" name="img1" value="">
            </label>
            <input type="hidden" name="prevCategoryName" id="prevCategoryName1">
            <button type="submit" class="upd-admin-btn">Ενημέρωση</button>
        </form>
    </section>
    <section>
        <h1 class="heading initial-heading">Προϊόντα</h1>
    </section>
    <section class="main-boxes layout admin-categories">
        <?php 
           $query8 = "SELECT * FROM Product";
           $res8 = $con->query($query8);
           while($prod = $res8->fetch_assoc()){
               $pid = $prod["productId"];
               $img = $prod["productImg"];
        ?>
        <form action="" method="POST">
            <p class="heading"><?php echo $prod["productName"]?></p>
            <?php if(ctype_xdigit($img)) {?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode(hex2bin($img));?>" alt="<?php echo $prod["productName"];?>">
            <?php } else { ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($img);?>" alt="<?php echo $prod["productName"];?>" />
            <?php }?>
            <input type="hidden" name="delPid" value="<?php echo $pid;?>">
            <button type="submit" class="del-admin-btn">Διαγραφή</button>
            <button type="button" class="upd-admin-btn" onclick="displayAdminUpFormProdName('<?php echo $pid;?>')">Ενημέρωση Tίτλου</button>
            <button type="button" class="upd-admin-btn" onclick="displayAdminUpFormProdImg('<?php echo $pid;?>')">Ενημέρωση Εικόνας</button>
            <button type="button" class="upd-admin-btn" onclick="displayAdminUpFormProdPrice('<?php echo $pid;?>')">Ενημέρωση Τιμής</button>
        </form>
         <?php } ?>
    </section>
    <section>
        <form action="" method="POST" id="admin-up-prod-form-title">
            <p class="heading">Ενημέρωση Τίτλου Προϊόντος</p>
            <label for="productName">Τίτλος Προϊόντος
                <input type="text" id="productName" class="admin-category-input" name="upProductName" value="">
            </label>
            <input type="hidden" name="pid1" id="pid1">
            <button type="submit" class="upd-admin-btn">Ενημέρωση</button>
        </form>
    </section>
    <section>
        <form action="" method="POST" id="admin-up-prod-form-price">
            <p class="heading">Ενημέρωση Τιμής Προϊόντος</p>
            <label for="productPrice">Τιμή Προϊόντος
                <input type="number" id="productPrice" class="admin-category-input" name="upProductPrice" min="0" value="">
            </label>
            <input type="hidden" name="pid2" id="pid2">
            <button type="submit" class="upd-admin-btn">Ενημέρωση</button>
        </form>
    </section>
    <section>
        <form action="" method="POST" enctype="multipart/form-data" id="admin-up-prod-form-img">
            <p class="heading">Ενημέρωση Εικόνας Προϊόντος</p>
            <label for="productImg">Επιλογή Εικόνας Προϊόντος
                <input type="file" id="productImg" name="img2" value="">
            </label>
            <input type="hidden" name="pid3" id="pid3">
            <button type="submit" class="upd-admin-btn">Ενημέρωση</button>
        </form>
    </section>
    <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if(isset($_POST["insProductName"]) && isset($_POST["insProductPrice"]) && isset($_FILES["productImg"]) &&
            isset($_POST["insProductQuantity"]) && isset($_POST["insProductSc"])){
                $pname = $_POST["insProductName"];
                $img = bin2hex(file_get_contents($_FILES["productImg"]["tmp_name"]));
                $price = $_POST["insProductPrice"];
                $quantity = $_POST["insProductQuantity"];
                $productSc = $_POST["insProductSc"];
                $desc = "-";

                if(isset($_POST["insProductDesc"])){
                    $desc = $_POST["insProductDesc"];
                }

                $query8 = "INSERT INTO Product (productName,price,quantity,`description`,productImg,scName)
                           VALUES('$pname','$price','$quantity','$desc','$img','$productSc')";

                $res8 = $con->query($query8);

                echo '<script language="javascript">';
                echo 'window.location.href = window.location.href;';
                echo '</script>';   
            }

            if(isset($_POST["delPid"])){
                $pid = $_POST["delPid"];
                $query10 = "DELETE FROM Product WHERE productId = '$pid'";
                $res10 = $con->query($query10);

                echo '<script language="javascript">';
                echo 'window.location.href = window.location.href;';
                echo '</script>';   
            }

            if(isset($_POST["upProductName"])){
                $newProductName = $_POST["upProductName"];
                $pid = $_POST["pid1"];
                $query11 = "UPDATE Product SET productName='$newProductName' WHERE productId='$pid'";
                $res11 = $con->query($query11);

                echo '<script language="javascript">';
                echo 'window.location.href = window.location.href;';
                echo '</script>';   
            }

            if(isset($_POST["upProductPrice"])){
                $newProductPrice = $_POST["upProductPrice"];
                $pid = $_POST["pid2"];
                $query12 = "UPDATE Product SET price='$newProductPrice' WHERE productId='$pid'";
                $res12 = $con->query($query12);

                echo '<script language="javascript">';
                echo 'window.location.href = window.location.href;';
                echo '</script>';   
            }

            if(isset($_FILES["img2"])){
                $pid = $_POST["pid3"];
                $img = bin2hex(file_get_contents($_FILES["img2"]["tmp_name"]));
                $query13 = "UPDATE Product SET productImg='$img' WHERE productId='$pid'";
                $res13 = $con->query($query13);

                echo '<script language="javascript">';
                echo 'window.location.href = window.location.href;';
                echo '</script>'; 
            }

            if(isset($_POST["insCategoryName"])){
                $insertCategoryName = $_POST["insCategoryName"];
                $insertImg = bin2hex(file_get_contents($_FILES["image"]["tmp_name"]));
                
                $query2 = "INSERT INTO Category (categoryName,categoryImg)
                          VALUES('$insertCategoryName','$insertImg')";
                $res2 = $con->query($query2);

                if(isset($_POST["sc"])){
                    $subcategories = $_POST["sc"];
                    for($i=0;$i<count($subcategories);$i++){
                        $sc = $subcategories[$i];
                        $query3 = "INSERT INTO Subcategory (scName,categoryName)
                        VALUES ('$sc','$insertCategoryName')";
                        $res3 = $con->query($query3);
                    }
                }

                echo '<script language="javascript">';
                echo 'window.location.href = window.location.href;';
                echo '</script>';    
            }

            if(isset($_POST["delCategoryName"])){
                $delCategoryName = $_POST["delCategoryName"];
                $query4 = "DELETE FROM Subcategory WHERE categoryName = '$delCategoryName'";
                $query5 = "DELETE FROM Category WHERE categoryName = '$delCategoryName'";
                $res4 = $con->query($query4);
                $res5 = $con->query($query5);

                echo '<script language="javascript">';
                echo 'window.location.href = window.location.href;';
                echo '</script>'; 
            }

            if(isset($_POST["upCategoryName"])){
               $existedName = $_POST["prevCategoryName"];
               $newName = $_POST["upCategoryName"];
               $query6 = "UPDATE Category SET categoryName='$newName' WHERE categoryName='$existedName'";
               $res6 = $con->query($query6);

               echo '<script language="javascript">';
               echo 'window.location.href = window.location.href;';
               echo '</script>'; 
            }

            if(isset($_FILES["img1"])){
                $existedName = $_POST["prevCategoryName"];
                $img = bin2hex(file_get_contents($_FILES["img1"]["tmp_name"]));
                $query7 = "UPDATE Category SET categoryImg='$img' WHERE categoryName='$existedName'";
                $res7 = $con->query($query7);

                echo '<script language="javascript">';
                echo 'window.location.href = window.location.href;';
                echo '</script>'; 
             }

             if(isset($_POST["message"]) && isset($_POST["subject"])){
                $query14 = "SELECT email FROM Person WHERE notify = '1'";
                $res14 = $con->query($query14);
                $message = $_POST["message"];

                while($user = $res14->fetch_assoc()) {
                   $email = $user["email"];
                   $subject = $_POST["subject"];
                   $msg = wordwrap($message,70);
                   mail($email,$subject,$msg); 
                }
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