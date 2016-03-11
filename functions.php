<?php

include('aws_signed_request.php');
include('../Requests/library/Requests.php');

function prod_info_array ($id_num, $id_type='UPC') {
	$associate_tag = 'jlhopper-20';
	$public_key = "AKIAI5KITZMQQYY3PVHA";
	$private_key = "69Hm8K8SQuznaaKnMmNYHN4qkFDDikb3W/pt4YpM";

	$url = aws_signed_request('com', array(
	        'Operation' => 'ItemLookup',
	        'SearchIndex'=> 'All',
	        'IdType' => $id_type,
	        'ItemId' => $id_num,
	        'ResponseGroup' => 'Medium'), $public_key, $private_key, $associate_tag);

	//echo $url;

	Requests::register_autoloader();
	$response = Requests::get($url);
	$xml_response = simplexml_load_string($response->body);
	$json = json_encode($xml_response);
	//echo $json;
	$response_array_decode = json_decode($json, true);

	return $response_array_decode;
}

//test
//$upc = "794043838026";
//$isbn = "9780441012688";
//print_r(prod_info_array($upc));

function dvd_info ($upc) {
	$response_array_decode = prod_info_array($upc);

	$dvd_info = [];

	if (is_assoc_array($response_array_decode['Items']['Item'])) {
		$item = $response_array_decode['Items']['Item'];
	} else {
		$item = $response_array_decode['Items']['Item'][0];
	}

	//print_r($item);
	//print_r(array_keys($item));

	$dvd_info['dvd_title'] = $item['ItemAttributes']['Title'];
	if (!isset($item['EditorialReviews']['EditorialReview'][0]['Content'])) {
		$dvd_info['dvd_desc'] = $item['EditorialReviews']['EditorialReview']['Content'];
	} else {
		$dvd_info['dvd_desc'] = $item['EditorialReviews']['EditorialReview'][0]['Content'];
	}
	$dvd_info['img_url_med'] = $item['MediumImage']['URL'];

	return($dvd_info);
}

function book_info($isbn) {

	$response_array_decode = prod_info_array($isbn, 'ISBN');

	//print_r($response_array_decode);

	$book_info = [];

	if (is_assoc_array($response_array_decode['Items']['Item'])) {
		$item = $response_array_decode['Items']['Item'];
	} else {
		$item = $response_array_decode['Items']['Item'][0];
	}

	$book_info['book_title'] = $item['ItemAttributes']['Title'];
	$book_info['book_author'] = $item['ItemAttributes']['Author'];
	if (!isset($item['EditorialReviews']['EditorialReview'][0]['Content'])) {
		$book_info['book_desc'] = $item['EditorialReviews']['EditorialReview']['Content'];
	} else {
		$book_info['book_desc'] = $item['EditorialReviews']['EditorialReview'][0]['Content'];
	}
	$book_info['book_img_url'] = $item['MediumImage']['URL'];

	return $book_info;
}

//test
//$isbn = "9780756404741";
//print_r(book_info($isbn));

function book_info_neat($isbn) {
	$book_info = book_info($isbn);
	?>
		<h2><?=$book_info['book_title']?></h2>
		<div>
			<img src="<?=$book_info['book_img_url']?>">
			<p><?=$book_info['book_author']?></p>
			<p><?=$book_info['book_desc']?></p>

		</div>
		<?php
}

function dvd_info_neat($upc) {
	$dvd_info = dvd_info($upc);
	?>
		<h2><?=$dvd_info['dvd_title']?></h2>
		<div>
			<img src="<?=$dvd_info['img_url_med']?>">
			<p><?=$dvd_info['dvd_desc']?></p>
		</div>
		<?php
}

function is_assoc_array($array) {
  return count(array_filter(array_keys($array), 'is_string')) > 0;
}

//test
// print_r(dvd_info('794043150067'));

//everything above pertains to viewing from API call, below is viewing from db

$db = connect_to_database("127.0.0.1", "root", "Tuesday135", "media_catalog");

function connect_to_database($local_host, $user, $pw, $database) {
    $db = mysqli_connect($local_host, $user, $pw, $database);
    if (!$db) {
        die('connection failed');
    } else {
        return $db;
    }
}

function books_array($sort="items.id DESC") {
    $parent_table = "items";
    global $db;
    if ($db) {
        $result = mysqli_query($db, "SELECT items.title, items.img_url, items.item_desc, books.author, books.isbn FROM $parent_table INNER JOIN books ON items.id=books.item_id ORDER BY $sort") or die(mysqli_error($db));
        $book_rows = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $book_rows[] = $row;
        }
        return $book_rows;
    } else {
        die('failed to connect to database');
	}
}

function books_list_view () {
	global $db;
	$book_rows = books_array();
	?>
	<ul>
        <?php
        foreach ($book_rows as $book) {
        ?>
          <li class="expand_info"><a href="#"><?=$bo ok['title']?></a>
            <div class="info">
              <p><?=$book['author']?></p>
              <p><img src="<?=$book['img_url']?>"></p>
              <p><?=$book['item_desc']?></p>
              <a href="index3.php?delete=true&id_num_isbn=<?=$book['isbn']?>">delete?</a>
            </div>
          </li>
        <?php
        }
        ?>
      </ul>
      <?php
}

function dvds_array($sort="items.id DESC") {
    $parent_table = "items";
    global $db;
    if ($db) {
        $result = mysqli_query($db, "SELECT items.title, items.img_url, items.item_desc, dvds.upc FROM $parent_table INNER JOIN dvds ON items.id=dvds.item_id ORDER BY $sort") or die(mysqli_error($db));
        $dvd_rows = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $dvd_rows[] = $row;
        }
        return $dvd_rows;
    } else {
        die('failed to connect to database');
	}
}

function dvds_list_view () {
	global $db;
	$dvd_rows = dvds_array();
	?>
	<ul>
        <?php
        foreach ($dvd_rows as $dvd) {
        ?>
          <li class="expand_info"><a href="#"><?=$dvd['title']?></a>
            <div class="info">
              <p><img src="<?=$dvd['img_url']?>"></p>
              <p><?=$dvd['item_desc']?></p>
              <a href="index3.php?delete=true&id_num_upc=<?=$dvd['upc']?>">delete?</a>
            </div>
          </li>
        <?php
        }
        ?>
      </ul>
      <?php
}

function create_item($title, $img_url, $item_desc) {
	global $db;
	mysqli_query($db, "INSERT INTO items (title, img_url, item_desc) VALUES ('$title', '$img_url', '$item_desc')") or die(mysqli_error($db));
	$result = mysqli_query($db, "SELECT LAST_INSERT_ID()");
    $row = mysqli_fetch_assoc($result);
    $last_id = $row['LAST_INSERT_ID()'];
    return $last_id;
}

function create_book ($title, $img_url, $item_desc, $author, $isbn) {
	global $db;
	$item_desc = mysqli_real_escape_string($db, $item_desc);
	$isbn = mysqli_real_escape_string($db, $isbn);
	$last_id = create_item($title, $img_url, $item_desc);
	mysqli_query($db, "INSERT INTO books (author, isbn, item_id) VALUES ('$author', '$isbn', '$last_id')") or die(mysqli_error($db));
}

function create_dvd ($title, $img_url, $item_desc, $upc) {
	global $db;
	$item_desc = mysqli_real_escape_string($db, $item_desc);
	$upc = mysqli_real_escape_string($db, $usb);
	$last_id = create_item($title, $img_url, $item_desc);
	mysqli_query($db, "INSERT INTO dvds (upc, item_id) VALUES ('$upc', '$last_id')") or die(mysqli_error($db));
}

function delete_entry ($id_num, $id_type) {
	global $db;
	if ($id_type == 'upc') {
		$table_name = 'dvds';
	} elseif ($id_type == 'isbn') {
		$table_name = 'books';
	}
	mysqli_query($db, "DELETE FROM items, $table_name USING items INNER JOIN $table_name WHERE items.id = $table_name.item_id AND $table_name.$id_type = $id_num") or die(mysqli_error($db));
}

?>
