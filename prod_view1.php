<?php
//die("test");
include("functions.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Gunmetal</title>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="gunmetal/css/1.css" type="text/css" media="screen,projection" />
</head>
<body>

      <?php
        if (isset($_GET['id_num_upc'])) {
          $id_num = $_GET['id_num_upc'];
          $id_type = 'id_num_upc';
        } elseif (isset($_GET['id_num_isbn'])) {
          $id_num = $_GET['id_num_isbn'];
          $id_type = 'id_num_isbn';
        }
      ?>

<div id="sidebar">
  <h1><a href="#">media catalog</a></h1>
  <p> keep track of your stuff </p>
  <ul id="nav">
    <li>
      <p>enter an 11 or 13 digit UPC number to search for dvd</p>
        <form action="prod_view1.php" method="get">
          <input type="text" name="id_num_upc">
          <input type="submit" name="btn" class="btn-style" value="submit" />
        </form> </li>
    <li><p>enter a 13 digit ISBN number to search for book</p>
          <form action="prod_view1.php" method="get">
          <input type="text" name="id_num_isbn">
          <input type="submit" name="btn" class="btn-style" value="submit" />
        </form></li>
    <li><a href="prod_view1.php?<?=$id_type?>=<?=$id_num?>&add=true"><b>»</b>add to list</a></li>
    <li><a href="index3.php"><b>»</b>cancel</a></li>

  </ul>
</div>
<div id="content">
  <?php
    if ($id_type == 'id_num_upc') {
      if (isset($_GET['add'])) {
        $dvd_info = dvd_info($id_num);
        $title = $dvd_info['dvd_title'];
        $img_url = $dvd_info['img_url_med'];
        $item_desc = $dvd_info['dvd_desc'];
        create_dvd($title, $img_url, $item_desc, $id_num);
        ?>
        <script>
            document.location="index3.php";   //redo this with php
        </script>
        <?php
      } else {
        dvd_info_neat($id_num);
      }
    } elseif ($id_type == 'id_num_isbn') {
      if (isset($_GET['add'])) {
        //die("test3");
        $book_info = book_info($id_num);
        $title = $book_info['book_title'];
        $author = $book_info['book_author'];
        $item_desc = $book_info['book_desc'];
        $img_url = $book_info['book_img_url'];
        create_book($title, $img_url, $item_desc, $author, $id_num);
        ?>
        <script>
            document.location="index3.php";
        </script>
        <?php
      } else {
        //print_r(book_info($id_num));
       // die("test4");
        book_info_neat($id_num);
      }
    }
  ?>

</div>

<div id="footer"> template design by <a href="http://www.sixshootermedia.com">Six Shooter Media</a>.<br />
 product info provided by <a href="http://docs.aws.amazon.com/AWSECommerceService/latest/DG/Welcome.html">AWS</a> </div>
</body>
</html>

