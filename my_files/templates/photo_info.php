<?php 
    include "../models/config.php";
    session_start();
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
    <section class="info-layout">
    <?php 
       $url = $_SERVER['REQUEST_URI'];
       $urlParsed = parse_url($url);
       $postId = intval($urlParsed["query"]);
       $query1 = "SELECT * FROM Post WHERE postId = $postId";
       $res1 = $con->query($query1);
       while($post = $res1->fetch_assoc()){    
        ?>
        <figure>
            <img src="data:image/jpeg;base64,<?php echo base64_encode(hex2bin($post["postImg"]));?>">
            <figcaption>
                <p><?php echo $post["username"]; ?></p>
                <p><?php echo $post["submissionDate"]; ?></p>
                <?php 
                  $query3 = "SELECT AVG(grade) AS avgGrade
                  FROM PostComment AS P 
                  WHERE P.postId = $postId;";
                  $res3 = $con->query($query3);
                  while($a = $res3->fetch_assoc()){
                ?>
                <p>Μέση Βαθμολογία: <?php echo floatval($a["avgGrade"])?></p>
                <?php } ?>
            </figcaption>
        </figure>
       <?php 
       }
       ?>
        <div class="comments-layout">
            <h1>Σχόλια Χρηστών</h1>
            <?php
              $query2 = "SELECT * FROM PostComment WHERE postId = '$postId'";
              $res2 = $con->query($query2);
              while($comment = $res2->fetch_assoc()){
            ?>
            <div class="comment-layout">
                <h1><?php echo $comment["username"]; ?></h1>
                <div class="comment-info">
                    <p><?php echo $comment["description"]; ?></p>
                    <p class="comment-grade" onla>Βαθμολογία: <?php echo $comment["grade"]; ?></p>
                </div>
                <p class="comment-date">Ημερομηνία Υποβολής:
                <?php echo $comment["submissionDate"]; ?></p>
            </div>
              <?php 
            }
            ?>
        </div>
        <form action="" method="POST" class="comment-form">
          <h1 class="grade-title">Βαθμολογία</h1>
          <div class="grade-stars">
             <span class="star-icon"  onclick="ratingStars(0)"></span>
             <span class="star-icon"  onclick="ratingStars(1)"></span>
             <span class="star-icon"  onclick="ratingStars(2)"></span>
             <span class="star-icon"  onclick="ratingStars(3)"></span>
             <span class="star-icon"  onclick="ratingStars(4)"></span>
         </div>
         <input id="grade-result" name="grade" value="">
         <label class="comment-text">
             <p>Σχόλιο :</p>
             <textarea name="desc" rows="7" columns="3" class="comment-text" maxlength="400"></textarea>
         </label>
         <button type="submit" class="comment-btn">Υποβολή</button>
        </form>
        <?php 
           if ($_SERVER['REQUEST_METHOD'] === 'POST') {
               $grade = $_POST["grade"];
               $username = $_SESSION["username"];
               $desc = $_POST["desc"];
               $submissionDate = date_create()->format('Y-m-d H:i:s');

               $insert = "INSERT INTO PostComment (description,grade,submissionDate,username,postId)
                          VALUES('$desc','$grade','$submissionDate','$username','$postId')";
               $res3 = $con->query($insert);
               echo '<script language="javascript">';
               echo 'window.location.href = window.location.href;';
               echo '</script>'; 
           }
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