<?php

include("functions.php");
include("dummydata.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Gunmetal</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>

  $(document).ready(function() {
    $('.info').hide();
    $('.expand_info').click(function() {
      $(this).children('.info').slideToggle('fast');
    });
  });

</script>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="gunmetal/css/1.css" type="text/css" media="screen,projection" />
</head>
<body>

<?php
  if (isset($_GET['delete'])) {
    if (isset($_GET['id_num_upc'])) {
      $id_num = $_GET['id_num_upc'];
      $id_type = 'upc';
    } elseif (isset($_GET['id_num_isbn'])) {
      $id_num = $_GET['id_num_isbn'];
      $id_type = 'isbn';
    }
    delete_entry($id_num, $id_type);
    ?>
    <script>
        document.location="index3.php";
    </script>
    <?php
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
    <li><a href="#"><b>»</b>link :3</a></li>7
  </ul>
</div>
<div id="content">
  <table>

    <tr>
      <td id="left_col">
      <div>
        <h3>books</h3>
          <?php
          books_list_view();
          ?>
    </div>
    </td>

      <td id="right_col">
      <div>
        <h3>dvds</h3>
          <?php
          dvds_list_view();
          ?>
      </div>
      </td>
    </tr>
  </table>
</div>

<div id="footer"> template design by <a href="http://www.sixshootermedia.com">Six Shooter Media</a>.<br />
 product info provided by <a href="http://docs.aws.amazon.com/AWSECommerceService/latest/DG/Welcome.html">AWS</a> </div>
</body>
</html>