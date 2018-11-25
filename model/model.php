<?php
defined('PCOMPSTART') or die('Access denied');
function getdatadb($query) {
    $db = mysqli_connect(HOST,USER,PASS,DB);
    if (!$db) {
        die('Ошибка подключения '.mysqli_connect_error());
    }
    $res = mysqli_query($db,$query);
    return $res;
    mysqli_close($db);
}
function catalog() {
	$query = "SELECT type_id, type_name, link_browser_type FROM types ORDER BY type_id";
    $res = getdatadb($query);
	$cat = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$cat[] = $row;
	}
		return $cat;
}
function informer() {
	$query = "SELECT * FROM anons_types ORDER BY id_anons";
    $res = getdatadb($query);
	$informers = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$informers[$row['id_anons']] = $row;
	}
	return $informers;
}
function thirtylast() {
    $query = "SELECT link_browser_type, type_name,
                products.product_id, products.title, products.link_browser, products.img_icon,
                products.anons, products.products_typeid, products.date
                FROM types INNER JOIN products ON
                types.link_browser_type = products.products_typeid AND visible = '1'
                ORDER BY products.date DESC LIMIT 30";
    $res= getdatadb($query);
    $arimages = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $arimages[] = $row['img_icon'];
        $lastart[] = $row;
    }
    remove_catindex_img($arimages);
    return $lastart;
}
function cheifinformer() {
	$query = "SELECT * FROM pages WHERE position != 0 ORDER BY position";
    $res = getdatadb($query);
	$cheifinformers = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$cheifinformers[] = $row;
	}
	return $cheifinformers;
}
function getmeta_pages() {
    $query = "SELECT meta_title, keywords, description FROM pages
                WHERE position = 0 ORDER BY page_id";
    $res = getdatadb($query);
    while($row = mysqli_fetch_assoc($res)) {
        $getmetapages[] = $row;
    }
    return $getmetapages;
}
function count_rows($category) {
	$query = "SELECT COUNT(product_id) as count_rows FROM products
                WHERE products_typeid = '$category' AND visible ='1'";
    $res = getdatadb($query);
	while($row = mysqli_fetch_assoc($res)){
		if($row['count_rows']) $count_rows = $row['count_rows'];
	}
	return $count_rows;
}
function products($category, $start_pos, $perpage) {
	$query = "SELECT product_id, title, link_browser, img_icon, products_typeid,
                anons, date FROM products WHERE products_typeid = '$category' AND visible ='1'
			  ORDER BY product_id LIMIT $start_pos, $perpage";
    $res = getdatadb($query);
	$products = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$products[] = $row;
	}
	return $products;
}
function brand_name($category) {
	$query = "SELECT * FROM types WHERE link_browser_type = '$category'";
    $res = getdatadb($query);
	$brand_name = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $brand_name[] = $row;
    }
	return $brand_name;
}
function krohi_types($category) {
	$query = "SELECT krohi_text FROM types WHERE type_id = '$category'";
    $res = getdatadb($query);
	$krohi_types = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$krohi_types[] = $row;
	}
	return $krohi_types;
}
function registration() {
	$db = mysqli_connect(HOST,USER,PASS,DB);
	$error = '';
	$name = trim($_POST['name']);
	$login = trim($_POST['login']);
	$email = trim($_POST['email']);
	$pass = trim($_POST['pass']);
	$retrypass = trim($_POST['retrypass']);

	if (empty($name)) $error .= '<li>Не указано Имя</li>';
	if (empty($login)) $error .= '<li>Не указан Логин</li>';
	if (empty($email)) $error .= '<li>Не указан Email</li>';
	if (empty($pass)) $error .= '<li>Не указан пароль</li>';
	if ($pass != $retrypass) {
		$error .= '<li>Введите корректное подтверждение пароля в поле &quot;Повторите пароль&quot;</li>';
	}

	if (empty($error)) {
		$query = "SELECT customer_id FROM customers WHERE login = '" .clear($login). "' LIMIT 1";
		$res = mysqli_query($db,$query) or die(mysqli_error());
		$row = mysqli_num_rows($res);
		if ($row) {
			$_SESSION['reg']['res'] = "<div class='error'>Пользователь с таким логином уже зарегестрирован на сайте. Введите другой логин.</div>";
			$_SESSION['reg']['name'] = $name;
			$_SESSION['reg']['email'] = $email;
		}
		else {
			$name = clear($name);
			$login = clear($login);
			$email = clear($email);

			$pass = md5($pass);
			$retrypass = md5($retrypass);
			$query = "INSERT INTO customers (name, login, email, password, 	retrypassword)
						VALUES ('$name', '$login', '$email', '$pass', '$retrypass')";
			$res = mysqli_query($db,$query) or die(mysqli_error());
			if (mysqli_affected_rows($db) > 0) {
				$_SESSION['reg']['res'] = "<div class='success'>Регистрация прошла успешно.</div>";
				$_SESSION['auth']['user'] = $_POST['name'];
			}
			else {
				$_SESSION['reg']['res'] = "<div class='error'>Ошибка!<div>";
				$_SESSION['reg']['name'] = $name;
				$_SESSION['reg']['login'] = $login;
				$_SESSION['reg']['email'] = $email;
			}
		}
	}
	else {
		$_SESSION['reg']['res'] = "<div class='error'>Не заполнены обязательные поля: <ul> $error </ul></div>";
		$_SESSION['reg']['name'] = $name;
		$_SESSION['reg']['login'] = $login;
		$_SESSION['reg']['email'] = $email;
	}
}
function authorization() {
	$db = mysqli_connect(HOST,USER,PASS,DB);
	$login = mysqli_real_escape_string($db,trim($_POST['login']));
	$pass = trim($_POST['pass']);
	if(empty($login) OR empty($pass)) {
		$_SESSION['auth']['error'] = "Поля логин и пароль должны быть заполнены!";
	}
	else {
		$pass = md5($pass);
		$query = "SELECT name FROM customers WHERE login = '$login' AND password = '$pass' LIMIT 1";
		$res = mysqli_query($db,$query) or die(mysqli_error());
		if (mysqli_num_rows($res) == 1) {
			$row = mysqli_fetch_row($res);
			$_SESSION['auth']['user'] = $row[0];
		}
		else {
			$_SESSION['auth']['error'] = "Логин или пароль введены неверно!";
		}
	}
}
function sitemap() {
	$query = "SELECT type_id, type_name, link_browser_type, products.product_id,
                products.title, products.link_browser FROM types
                INNER JOIN products ON
                types.link_browser_type = products.products_typeid
                AND visible = '1' ORDER BY types.type_id, products.product_id";
    $res = getdatadb($query);
	$sitemap = array();
    $name = '';
	while($row = mysqli_fetch_assoc($res)) {
        if($row['type_name'] != $name){ // если такого информера в массиве еще нет
            $sitemap[$row['type_id']][] = [$row['link_browser_type'], $row['type_name']]; // добавляем информер в массив
            $name = $row['type_name'];
        }
		$sitemap[$row['type_id']]['sub'][$row['product_id']] = $row;
	}
	return $sitemap;
}
function search() {
	$search = clear($_GET['search']);
	$result_search = array();

	if (mb_strlen($search, 'UTF-8') < 3) {
		$result_search['notfound'] = "<div class='error1'>Поисковый запрос должен содержать не менее 3-х символов</div>";
	}
	else {
		$query = "SELECT product_id, title, meta_title, link_browser, img_icon, products_typeid, anons
					FROM products
					WHERE MATCH(title, meta_title, anons) AGAINST('{$search}*' IN BOOLEAN MODE) 
                    AND visible = '1'";
        $res = getdatadb($query);

		if (mysqli_num_rows($res) > 0) {
			while($row_search = mysqli_fetch_assoc($res)) {
				$result_search[] = $row_search;
			}
		}
		else {
			$result_search['notfound'] = "<div class='error1'>По Вашему запросу ничего не найдено</div>";
		}
	}
	return $result_search;
}
function get_product($product_id) {
	$query = "SELECT product_id, title, link_browser, img_icon, meta_title,
                    keywords, description, products_typeid, date, content FROM products
				WHERE product_id = $product_id AND visible = '1'";
    $res = getdatadb($query);
	$product = array();
	$product = mysqli_fetch_assoc($res);
    if ($product['date']) {
        $date = date_create($product['date']);
		$product['date'] = date_format($date, 'd.m.Y');
	}
	return $product;
}

function comments($product_id) {
    $query = "SELECT name, comment, date_comment, comment_img
                FROM comments WHERE product_id = '$product_id'
                ORDER BY comment_id DESC";
    $res = getdatadb($query);
    $comments = array();
	while($row = mysqli_fetch_assoc($res)){
		$comments[] = $row;
	}

    return $comments;
}
function insert_comm($product_id) {
    $name_comm = trim(mb_substr($_POST['name_comm'],0,35,'UTF-8'));
    $comment = trim(mb_substr($_POST['comment'],0,1000,'UTF-8'));
    $date_comment = date("Y-m-d");
    $error = '';

	if(empty($name_comm)) $error .=  "<div class='error'>Вы не представились!</div>";
	if(empty($comment)) $error .= "<div class='error'>Вы не прокоментировали!</div>";
	if($_POST['aspam'] == 'on') $error .= "<div class='error'>Вы не прошли проверку на человечность!</div>";

	if (empty($error)) {
		$db = mysqli_connect(HOST,USER,PASS,DB);
		$name_comm = clear($_POST['name_comm']);
		$comment = clear($_POST['comment']);
		$query = "INSERT INTO comments SET name = '$name_comm', comment = '$comment', date_comment = '$date_comment', product_id = '$product_id'";
		$res = mysqli_query($db,$query) or die(mysqli_error());
		if (mysqli_affected_rows($db) > 0) {
            if (stristr($name_comm, 'admin') === false) {
                mail(
                    "pcompstart@gmail.com",
                    "Оставлен коментарий на сайте",
                    "product_id = ".$product_id."\n"."коментарий: ".$comment,
                    "Content-type: text/plain; charset = \"utf-8\"");
            }
			$_SESSION['res'] = "<p  class='success'>Ваш коментарий успешно добавлен!</p>";
			header("Location: {$_SERVER['REQUEST_URI']}#res");
      		exit();
		}
		else {
			$_SESSION['res'] = "<p  class='error'>Ошибка поробуйте позже</p>";
			header("Location: {$_SERVER['REQUEST_URI']}#res");
      		exit();
		}
	}
	else {
		$_SESSION['res'] = "<div class='error'><strong>Ошибка заполнения формы:</strong></div>".$error;
		$_SESSION['name_comm'] = $name_comm;
		$_SESSION['comment'] = $comment;
		header("Location: {$_SERVER['REQUEST_URI']}#res");
      	exit();
	}
}
function get_smiles() {
	$query = "SELECT * FROM smiles ORDER BY id_smile";
    $res = getdatadb($query);
	$smiles = array();
	while($row = mysqli_fetch_assoc($res)){
		$smiles[] = $row;
	}

	return $smiles;
}
// Фукнция для подбора ссылок на близкие по смыслу статеи в конец публикации
function links_prod($prod_title) {
    $result_search = array();
    $res = getdatadb("SELECT product_id, title, link_browser, products_typeid
                        FROM products WHERE MATCH(title, anons)
                        AGAINST('{$prod_title}*' IN BOOLEAN MODE)
                        AND visible = '1'  LIMIT 6");
    while($row_search = mysqli_fetch_assoc($res)) {
        $result_search[] = $row_search;
    }
    if (empty($result_search) or count($result_search) < 6) {
        $result_search = null;
        $res = getdatadb("SELECT product_id, title, link_browser, products_typeid
                            FROM products WHERE MATCH(title, anons, content)
                            AGAINST('{$prod_title}*' IN BOOLEAN MODE)
                            AND visible = '1' LIMIT 6");
        while($row_search = mysqli_fetch_assoc($res)) {
            $result_search[] = $row_search;
        }
    }
    $kl = array();
    foreach ($result_search as $sel) {
        if ($sel['title'] != $prod_title) {
            $kl[] = $sel;
        }
    }
    if (count($kl) > 5) {
        unset($kl[count($kl) - 1]);
    }
    return $kl;
}
