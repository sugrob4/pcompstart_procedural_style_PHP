<?php
defined('PCOMPSTART') or die('Access denied');
function getdataadmin($query) {
    $db = mysqli_connect(HOST,USER,PASS,DB);
    if (!$db) {
        die('Ошибка подключения '.mysqli_connect_error());
    }
    $res = mysqli_query($db,$query);
    return $res;
    mysqli_close($db);
}

function clear_admin($var) {
  	$db = mysqli_connect(HOST,USER,PASS,DB);
	$var = mysqli_real_escape_string($db,$var);
	return $var;
    mysqli_close($db);
}
function active_url($str = 'view=pages') {
	$uri = $_SERVER['QUERY_STRING'];
	if(!$uri) $uri = "view=pages";
	$uri = explode("&", $uri);
	if(preg_match("#page=#", end($uri))) array_pop($uri);
	if (in_array($str, $uri)) {
		return "class='nav_active'";
	}
}
/* ===Ресайз картинок=== */
function resize($target, $dest, $wmax, $hmax, $ext){
    /*
    $target - путь к оригинальному файлу
    $dest - путь сохранения обработанного файла
    $wmax - максимальная ширина
    $hmax - максимальная высота
    $ext - расширение файла
    */
    list($w_orig, $h_orig) = getimagesize($target);
    $ratio = $w_orig / $h_orig; // =1 - квадрат, <1 - альбомная, >1 - книжная

    if(($wmax / $hmax) > $ratio){
        $wmax = $hmax * $ratio;
    }else{
        $hmax = $wmax / $ratio;
    }

    $img = "";
    // imagecreatefromjpeg | imagecreatefromgif | imagecreatefrompng
    switch($ext){
        case("gif"):
            $img = imagecreatefromgif($target);
            break;
        case("png"):
            $img = imagecreatefrompng($target);
            break;
        default:
            $img = imagecreatefromjpeg($target);
    }
    $newImg = imagecreatetruecolor($wmax, $hmax); // создаем оболочку для новой картинки

    if($ext == "png"){
        imagesavealpha($newImg, true); // сохранение альфа канала
        $transPng = imagecolorallocatealpha($newImg,0,0,0,127); // добавляем прозрачность
        imagefill($newImg, 0, 0, $transPng); // заливка
    }

    imagecopyresampled($newImg, $img, 0, 0, 0, 0, $wmax, $hmax, $w_orig, $h_orig); // копируем и ресайзим изображение
    switch($ext){
        case("gif"):
            imagegif($newImg, $dest);
            break;
        case("png"):
            imagepng($newImg, $dest);
            break;
        default:
            imagejpeg($newImg, $dest);
    }
    imagedestroy($newImg);
}
/* ===Ресайз картинок=== */
function catalog() {
	$query = "SELECT type_id, type_name, link_browser_type FROM types ORDER BY type_id";
	$res = getdataadmin($query);
	$cat = array();
	while ($row = mysqli_fetch_assoc($res)) {
        $cat[] = $row;
	}
		return $cat;
}
function cheifinformer() {
	$query = "SELECT * FROM pages ORDER BY position";
    $res = getdataadmin($query);
	$cheifinformers = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$cheifinformers[] = $row;
	}
	return $cheifinformers;
}
function get_page($page_id) {
	$query = "SELECT * FROM pages WHERE page_id = $page_id";
    $res = getdataadmin($query);
	$page = array();
	$page = mysqli_fetch_assoc($res);
	return $page;
}
function edit_page($page_id) {
    $link_browser = trim($_POST['link_browser']);
    $title = trim($_POST['title']);
    $meta_title = trim($_POST['meta_title']);
	$keywords = trim($_POST['keywords']);
	$description = trim($_POST['description']);
	$position = (int)($_POST['position']);
	$text = trim($_POST['text']);
	if (empty($title)) {
		$_SESSION['edit_page']['res'] = "<div class='error'>Должно быть название страницы!</div>";
		return false;
	}
	else {
        $link_browser = clear_admin($link_browser);
        $title = clear_admin($title);
        $meta_title = clear_admin($meta_title);
		$keywords = clear_admin($keywords);
		$description = clear_admin($description);
		$text = clear_admin($text);

		$db = mysqli_connect(HOST,USER,PASS,DB);
		$query = "UPDATE pages SET link_browser = '$link_browser', title = '$title',
                                    meta_title = '$meta_title', keywords = '$keywords',
                                    description = '$description', position = '$position',
                                    text = '$text' WHERE page_id = '$page_id'";
		$res = mysqli_query($db,$query) or die(mysqli_error());
		if (mysqli_affected_rows($db) > 0) {
			$_SESSION['answer'] = "<div class='success'>Страница обновлена!</div>";
			return true;
		}
		else {
			$_SESSION['edit_page']['res'] = "<div class='error'>Ошибка или Вы ничего не меняли!</div>";
			return false;
		}
		mysqli_close($db);
	}
}
function add_page() {
    $link_browser = trim($_POST['link_browser']);
    $title = trim($_POST['title']);
    $meta_title = trim($_POST['meta_title']);
	$keywords = trim($_POST['keywords']);
	$description = trim($_POST['description']);
	$position = (int)($_POST['position']);
	$text = trim($_POST['text']);
	if (empty($title)) {
		$_SESSION['add_page']['res'] = "<div class='error'>Должно быть название страницы!</div>";
        $_SESSION['add_page']['link_browser'] = $link_browser;
        $_SESSION['add_page']['title'] = $title;
        $_SESSION['add_page']['meta_title'] = $meta_title;
		$_SESSION['add_page']['keywords'] = $keywords;
		$_SESSION['add_page']['description'] = $description;
		$_SESSION['add_page']['position'] = $position;
		$_SESSION['add_page']['text'] = $text;
		return false;
	}
	else {
        $link_browser = clear_admin($link_browser);
        $title = clear_admin($title);
        $meta_title = clear_admin($meta_title);
		$keywords = clear_admin($keywords);
		$description = clear_admin($description);
		$text = clear_admin($text);

		$db = mysqli_connect(HOST,USER,PASS,DB);
		$query = "INSERT INTO pages (link_browser, title, meta_title,
                                    keywords, description, position, text)
					VALUES ('$link_browser', '$title', '$meta_title',
					        '$keywords', '$description', $position, '$text')";
		$res = mysqli_query($db,$query) or die(mysqli_error());
		if (mysqli_affected_rows($db) > 0) {
			$_SESSION['answer'] = "<div class='success'>Страница добавлена!</div>";
			return true;
		}
		else {
			$_SESSION['add_page']['res'] = "<div class='error'>Ошибка при добавлениии страницы!</div>";
			return false;
		}
        mysqli_close($db);
	}
}
function del_page($page_id) {
	$db = mysqli_connect(HOST,USER,PASS,DB);
	$query = "DELETE FROM pages WHERE page_id = $page_id";
	$res = mysqli_query($db,$query) or die(mysqli_error());
	if (mysqli_affected_rows($db) > 0) {
		$_SESSION['answer'] = "<div class='success'>Страница удалена</div>";
		return true;
	}
	else {
		$_SESSION['answer'] = "<div class='error'>Ошибка удаления страницы!</div>";
		return false;
	}
	mysqli_close($db);
}
function add_type() {
    $meta_title = clear_admin(trim($_POST['meta_title']));
    $keywords = clear_admin(trim($_POST['keywords']));
    $description = clear_admin(trim($_POST['description']));
	$type_name = clear_admin(trim($_POST['type_name']));
    $link_browser_type = clear_admin(trim($_POST['link_browser_type']));
	$krohi_text = clear_admin(trim($_POST['krohi_text']));
	if (empty($type_name)) {
		$_SESSION['add_type']['res'] = "<div class='error'>Вы не указали название раздела!</div>";
		return false;
	}
	else {
		$db = mysqli_connect(HOST,USER,PASS,DB);
		$query = "SELECT type_id FROM types WHERE type_name = '$type_name'";
		$res = mysqli_query($db,$query) or die(mysqli_error());
		if (mysqli_num_rows($res) > 0) {
			$_SESSION['add_type']['res'] = "<div class='error'>Раздел с таким названием уже есть</div>";
			return false;
		}
		else {
			$query = "INSERT INTO types (title, keywords, description,
                                        type_name, link_browser_type, krohi_text)
                                        VALUES ('$meta_title','$keywords', '$description',
                                        '$type_name', '$link_browser_type', '$krohi_text')";
			$res = mysqli_query($db,$query) or die(mysqli_error());
			if (mysqli_affected_rows($db) > 0) {
				$_SESSION['answer'] = "<div class='success'>Раздел добавлен!</div>";
				return true;
			}
			else {
				$_SESSION['add_type']['res'] = "<div class='error'>Ошибка при добавлениии раздела!</div>";
				return false;
			}
		}
	}
}
function edit_type($type_id) {
    $meta_title = clear_admin(trim($_POST['meta_title']));
    $keywords = clear_admin(trim($_POST['keywords']));
    $description = clear_admin(trim($_POST['description']));
	$type_name = clear_admin(trim($_POST['type_name']));
    $link_browser_type = clear_admin(trim($_POST['link_browser_type']));
	$krohi_text = clear_admin(trim($_POST['krohi_text']));
	if (empty($type_name)) {
		$_SESSION['edit_type']['res'] = "<div class='error'>Вы не указали название раздела!</div>";
		return false;
	}
	else {
		$db = mysqli_connect(HOST,USER,PASS,DB);
		$query = "UPDATE types SET title = '$meta_title', keywords = '$keywords',
                                    description = '$description', type_name = '$type_name',
                                    link_browser_type = '$link_browser_type',
                                    krohi_text = '$krohi_text' WHERE link_browser_type = '$type_id'";
		$res = mysqli_query($db,$query) or die(mysqli_error());
		if (mysqli_affected_rows($db) > 0) {
			$_SESSION['answer'] = "<div class='success'>Раздел обновлён!</div>";
			return true;
		}
		else {
			$_SESSION['edit_type']['res'] = "<div class='error'>Ошибка при редактировании раздела!</div>";
			return false;
		}
		mysqli_close($db);
	}
}
function del_type($type_id) {
    getdataadmin("DELETE FROM products WHERE products_typeid = '$type_id'");
    getdataadmin("DELETE FROM types WHERE link_browser_type = '$type_id'");
	$_SESSION['answer'] = "<div class='success'>Раздел успешно удалён</div>";
}
function krohi_types($type_id) {
	$query = "SELECT title, keywords, description, type_name, link_browser_type,
                    krohi_text FROM types WHERE link_browser_type = '$type_id'";
	$res = getdataadmin($query);
	$krohi_types = array();
	$krohi_types = mysqli_fetch_assoc($res);
	return $krohi_types;
}
function count_rows($category) {
	$query = "SELECT COUNT(product_id) as count_rows FROM products WHERE products_typeid = '$category'";
	$res = getdataadmin($query);
	while($row = mysqli_fetch_assoc($res)){
		if($row['count_rows']) $count_rows = $row['count_rows'];
	}
	return $count_rows;
}
function informer() {
	$query = "SELECT * FROM anons_types ORDER BY parent_type";
	$res = getdataadmin($query);
	$informers = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$informers[$row['id_anons']] = $row;
	}
	return $informers;
}
function add_informer() {
	$name_informer = trim($_POST['name_informer']);
	$parenttype_informer = (int)$_POST['parenttype_informer'];
	$text_informer = trim($_POST['text_informer']);
	if (empty($name_informer)) {
		$_SESSION['add_informer']['res'] = "<div class='error'>У информера должно быть название!</div>";
		$_SESSION['add_informer']['text_informer'] = $text_informer;
		return false;
	}
	else {
		$name_informer = clear_admin($name_informer);
		$text_informer = clear_admin($text_informer);
		$db = mysqli_connect(HOST,USER,PASS,DB);
		$query = "INSERT INTO anons_types (name, text, parent_type) VALUES ('$name_informer', '$text_informer', '$parenttype_informer')";
		$res = mysqli_query($db,$query) or die(mysqli_error($db));
		if (mysqli_affected_rows($db) > 0) {
			$_SESSION['answer'] = "<div class='success'>Информер добавлен!</div>";
			return true;
		}
		else {
			$_SESSION['add_informer']['res'] = "<div class='error'>Ошибка при добавлениии информера!</div>";
			return false;
		}
		mysqli_close($db);
	}
}
function get_informers($id_anons) {
	$query = "SELECT * FROM anons_types WHERE id_anons = $id_anons";
	$res = getdataadmin($query);
	$informer = array();
	$informer = mysqli_fetch_assoc($res);
	return $informer;
}
function edit_informer($id_anons) {
	$name_informer = trim($_POST['name_informer']);
	$parenttype_informer = (int)$_POST['parenttype_informer'];
	$text_informer = trim($_POST['text_informer']);
	if (empty($name_informer)) {
		$_SESSION['edit_informer']['res'] = "<div class='error'>Вы не указали название информера!</div>";
		return false;
	}
	else {
		$name_informer = clear_admin($name_informer);
		$text_informer = clear_admin($text_informer);
		$db = mysqli_connect(HOST,USER,PASS,DB);
		$query = "UPDATE anons_types SET name = '$name_informer', text = '$text_informer', parent_type = '$parenttype_informer'
					WHERE id_anons = '$id_anons'";
		$res = mysqli_query($db,$query) or die(mysqli_error($db));
		if (mysqli_affected_rows($db) > 0) {
			$_SESSION['answer'] = "<div class='success'>Информер обновлён!</div>";
			return true;
		}
		else {
			$_SESSION['edit_informer']['res'] = "<div class='error'>Ошибка при обновлении информера!</div>";
			return false;
		}
		mysqli_close($db);
	}
}
function del_informer($id_anons) {
	$db = mysqli_connect(HOST,USER,PASS,DB);
	$query = "DELETE FROM anons_types WHERE id_anons = $id_anons";
	$res = mysqli_query($db,$query) or die(mysqli_error($db));
	if (mysqli_affected_rows($db) > 0) {
		$_SESSION['answer'] = "<div class='success'>Информер удалён</div>";
		return true;
	}
	else {
		$_SESSION['answer'] = "<div class='error'>Ошибка удаления информера!</div>";
		return false;
	}
	mysqli_close($db);
}
function products($category,$start_pos, $perpage) {
	$query = "SELECT product_id, title, img_icon, products_typeid, anons, date, visible
				FROM products WHERE products_typeid = '$category '
				LIMIT $start_pos, $perpage";
	$res = getdataadmin($query);
	$products = array();
	while ($row = mysqli_fetch_assoc($res)) {
		$products[] = $row;
	}
	return $products;
}
function add_product() {
	$name = trim($_POST['name']);
    $link_browser = trim($_POST['link_browser']);
    $meta_title = trim($_POST['meta_title']);
	$keywords = trim($_POST['keywords']);
	$description = trim($_POST['description']);
	$products_typeid = trim($_POST['category']);
	$anons = trim($_POST['anons']);
	$content = trim($_POST['content']);
	$visible = (int)$_POST['visible'];
	$date = date("Y-m-d", strtotime(trim($_POST['date'])));

	if (empty($name)) {
		$_SESSION['add_product']['res'] = "<div class='error'>У продукта должно быть название!</div>";
        $_SESSION['add_product']['link_browser'] = $link_browser;
        $_SESSION['add_product']['meta_title'] = $meta_title;
		$_SESSION['add_product']['keywords'] = $keywords;
		$_SESSION['add_product']['description'] = $description;
		$_SESSION['add_product']['anons'] = $anons;
		$_SESSION['add_product']['content'] = $content;
        $_SESSION['add_product']['date'] = $date;
		return false;
	} elseif (mb_strlen($meta_title) > 100) {
        $_SESSION['add_product']['res'] = "<div class='error'>Максимальная длина мета тега title 100 символов!</div>";
        $_SESSION['add_product']['name'] = $name;
        $_SESSION['add_product']['link_browser'] = $link_browser;
        $_SESSION['add_product']['keywords'] = $keywords;
        $_SESSION['add_product']['description'] = $description;
        $_SESSION['add_product']['anons'] = $anons;
        $_SESSION['add_product']['content'] = $content;
        $_SESSION['add_product']['date'] = $date;
        return false;
    } else {
		$name = clear_admin($name);
        $link_browser = clear_admin($link_browser);
        $meta_title = clear_admin($meta_title);
		$keywords = clear_admin($keywords);
		$description = clear_admin($description);
		$anons = clear_admin($anons);
		$content = clear_admin($content);
        $date = clear_admin($date);

		$db = mysqli_connect(HOST,USER,PASS,DB);
		$query = "INSERT INTO products (title, link_browser, meta_title, keywords, description,
                                        anons, content, products_typeid, date, visible)
					VALUES ('$name', '$link_browser', '$meta_title', '$keywords',
					        '$description', '$anons', '$content', '$products_typeid',
					        '$date', '$visible')";
		$res = mysqli_query($db,$query) or die(mysqli_error());
		if (mysqli_affected_rows($db) > 0) {
			$id = mysqli_insert_id($db); // ID сохраненного товара
			$types = array("image/gif", "image/png", "image/jpeg", ".image/pjpeg", "image/x-png"); // массив допустимых расширений
			if ($_FILES['baseimg']['name']) {
				$baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['baseimg']['name']));  // расширение картинки
				$baseimgName = "{$id}.{$baseimgExt}";  // новое имя картинки
				$baseimgTmpName = $_FILES['baseimg']['tmp_name'];  // временное имя файла
				$baseimgSize = $_FILES['baseimg']['size']; // вес файла
				$baseimgType = $_FILES['baseimg']['type']; // тип файла
				$baseimgError = $_FILES['baseimg']['error']; // 0 - OK, иначе - ошибка
				$error = "";

				if(!in_array($baseimgType, $types)) $error .= "Допустимые расширения - .gif, .png, .jpg<br />";
				if($baseimgSize > SIZE) $error .= "Максимальный вес файла - 1 Мб";
				if($baseimgError) $error .= "Ошибка при загрузке файла. Возможно, файл слишком большой";
				if(!empty($error)) $_SESSION['answer'] = "<div class='error'>Ошибка при загрузке картинки товара! <br /> {$error} </div>";

				// если нет ошибок
				if (empty($error)) {
					if (@move_uploaded_file($baseimgTmpName, "../userfiles/tmp/$baseimgName")) {
						resize("../userfiles/tmp/$baseimgName", "../userfiles/baseimg/$baseimgName", 120, 120, $baseimgExt);
                        resize("../userfiles/tmp/$baseimgName", "../userfiles/forhome/$baseimgName", 48, 48, $baseimgExt);
						@unlink("../userfiles/tmp/$baseimgName");
						mysqli_query($db, "UPDATE products SET img_icon = '$baseimgName' WHERE product_id = $id");
					}
					else {
						$_SESSION['answer'] .= "<div class='error'>Не удалось переместить загруженную картинку.
						Проверьте права на папки в каталоге /userfiles/</div>";
					}
				}
			}

			$_SESSION['answer'] .= "<div class='success'>Продукт добавлен!</div>";
			return true;
		}
		else {
			$_SESSION['add_product']['res'] = "<div class='error'>Ошибка при добавлении продукта!</div>";
			return false;
		}
		mysqli_close($db);
	}
}
function get_product($product_id) {
	$query = "SELECT * FROM products WHERE product_id = $product_id";
	$res = getdataadmin($query);
	$product = array();
	$product = mysqli_fetch_assoc($res);
	return $product;
}
function del_img() {
	$product_id = (int)$_POST['product_id'];
	$img = clear_admin($_POST['img']);
	$db = mysqli_connect(HOST,USER,PASS,DB);
	$query = "UPDATE products SET img_icon = 'noimage_Icon.png' WHERE product_id = $product_id";
    @unlink("../userfiles/baseimg/$img");
	mysqli_query($db,$query);
	if (mysqli_affected_rows($db) > 0) {
		return '<input type="file" name="baseimg">';
	}
	else {
		return false;
	}
	mysqli_close($db);
}
function edit_product($id) {
	$name = trim($_POST['name']);
    $link_browser = trim($_POST['link_browser']);
    $meta_title = trim($_POST['meta_title']);
	$keywords = trim($_POST['keywords']);
	$description = trim($_POST['description']);
	$products_typeid = trim($_POST['category']);
	$anons = trim($_POST['anons']);
	$content = trim($_POST['content']);
    $date = date("Y-m-d", strtotime(trim($_POST['date'])));
	$visible = (int)$_POST['visible'];
	if (empty($name)) {
		$_SESSION['edit_product']['res'] = "<div class='error'>У продукта должно быть название!</div>";
		return false;
	} elseif (mb_strlen($meta_title) > 100) {
        $_SESSION['edit_product']['res'] = "<div class='error'>Максимальная длина мета тега title 100 символов!</div>";
        return false;
    } else {
		$name = clear_admin($name);
        $link_browser = clear_admin($link_browser);
        $meta_title = clear_admin($meta_title);
		$keywords = clear_admin($keywords);
		$description = clear_admin($description);
		$anons = clear_admin($anons);
		$content = clear_admin($content);
        $date = clear_admin($date);
		$db = mysqli_connect(HOST,USER,PASS,DB);
		$query = "UPDATE products SET title = '$name', link_browser = '$link_browser',
                    meta_title = '$meta_title', keywords = '$keywords',
                    description = '$description', anons = '$anons',
                    content = '$content', products_typeid = '$products_typeid',
                    date='$date', visible = '$visible'
					WHERE product_id = $id";
		$res = mysqli_query($db,$query) or die(mysqli_error($db));
		$types = array("image/gif", "image/png", "image/jpeg", ".image/pjpeg", "image/x-png"); // массив допустимых расширений
		if ($_FILES['baseimg']['name']) {
			$baseimgExt = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES['baseimg']['name']));  // расширение картинки
			$baseimgName = "{$id}.{$baseimgExt}";  // новое имя картинки
			$baseimgTmpName = $_FILES['baseimg']['tmp_name'];  // временное имя файла
			$baseimgSize = $_FILES['baseimg']['size']; // вес файла
			$baseimgType = $_FILES['baseimg']['type']; // тип файла
			$baseimgError = $_FILES['baseimg']['error']; // 0 - OK, иначе - ошибка
			$error = "";
			if(!in_array($baseimgType, $types)) $error .= "Допустимые расширения - .gif, .png, .jpg<br />";
			if($baseimgSize > SIZE) $error .= "Максимальный вес файла - 1 Мб";
			if($baseimgError) $error .= "Ошибка при загрузке файла. Возможно, файл слишком большой";
			if(!empty($error)) $_SESSION['answer'] = "<div class='error'>Ошибка при загрузке картинки товара! <br /> {$error} </div>";

			if (empty($error)) {
				if (@move_uploaded_file($baseimgTmpName, "../userfiles/tmp/$baseimgName")) {
					resize("../userfiles/tmp/$baseimgName", "../userfiles/baseimg/$baseimgName", 120, 120, $baseimgExt);
                    resize("../userfiles/tmp/$baseimgName", "../userfiles/forhome/$baseimgName", 48, 48, $baseimgExt);
					@unlink("../userfiles/tmp/$baseimgName");
					mysqli_query($db, "UPDATE products SET img_icon = '$baseimgName' WHERE product_id = $id");
				}
				else {
					$_SESSION['answer'] .= "<div class='error'>Не удалось переместить загруженную картинку.
					Проверьте права на папки в каталоге /userfiles/</div>";
				}
			}
		}
		$_SESSION['answer'] .= "<div class='success'>Продукт обновлён!</div>";
		return true;
	}
	mysqli_close($db);
}
function del_product($product_id) {
	$db = mysqli_connect(HOST,USER,PASS,DB);
	mysqli_query($db, "DELETE FROM products WHERE product_id = $product_id");
	if (mysqli_affected_rows($db) > 0) {
		$_SESSION['answer'] = "<div class='success'>Продукт удалён</div>";
		return true;
	}
	else {
		$_SESSION['answer'] = "<div class='error'>Ошибка при удалениии продукта!</div>";
		return false;
	}
	mysqli_close($db);
}
function count_comments($start_pos, $perpage) {
	$query = "SELECT comment_id, name, date_comment, product_id FROM comments ORDER BY comment_id DESC
				LIMIT $start_pos, $perpage";
	$res = getdataadmin($query);
	$count_comments = array();
	while($row = mysqli_fetch_assoc($res)){
		$count_comments[] = $row;
	}
	return $count_comments;
}
function show_comment($comment_id) {
	$query = "SELECT * FROM comments WHERE comment_id = $comment_id";
	$res = getdataadmin($query);
	$comments = mysqli_fetch_assoc($res);
	return $comments;
}
function del_comment($comment_id) {
	$db = mysqli_connect(HOST,USER,PASS,DB);
	mysqli_query($db, "DELETE FROM comments WHERE comment_id = $comment_id");
	if (mysqli_affected_rows($db) > 0) {
		$_SESSION['answer'] = "<div class='success'>Коментарий удалён</div>";
		return true;
	}
	else {
		$_SESSION['answer'] = "<div class='error'>Ошибка при удалениии коментария!</div>";
		return false;
	}
	mysqli_close($db);
}
function pagination_comments() {
	$query = "SELECT COUNT(comment_id) FROM comments";
    $res = getdataadmin($query);
	$count_commentid = mysqli_fetch_row($res);
    return $count_commentid[0];
}
function count_users() {
	$query = "SELECT COUNT(customer_id) FROM customers";
    $res = getdataadmin($query);
	$count_users = mysqli_fetch_row($res);
    return $count_users[0];
}
function get_users($start_pos, $perpage) {
	$query = "SELECT customer_id, name, login, email, name_role FROM customers
				LEFT JOIN roles
				ON customers.id_role = roles.id_role LIMIT $start_pos, $perpage";
	$res = getdataadmin($query);
	$users = array();
	while($row = mysqli_fetch_assoc($res)){
		$users[] = $row;
	}
	return $users;
}
function get_roles() {
	$query = "SELECT id_role, name_role FROM roles";
	$res = getdataadmin($query);
	$roles = array();
	while($row = mysqli_fetch_assoc($res)){
		$roles[] = $row;
	}
	return $roles;
}
function add_user() {
	$db = mysqli_connect(HOST,USER,PASS,DB);
	$error = '';
	$name = trim($_POST['name']);
	$login = trim($_POST['login']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$retrypassword = trim($_POST['retrypassword']);
	$id_role = (int)$_POST['id_role'];

	if (empty($name)) $error .= '<li>Не указано Имя</li>';
	if (empty($login)) $error .= '<li>Не указан Логин</li>';
	if (empty($email)) $error .= '<li>Не указан Email</li>';
	if (empty($password)) $error .= '<li>Не указан пароль</li>';
	if ($password != $retrypassword) {
		$error .= '<li>Введите корректное подтверждение пароля в поле &quot;Повторите пароль&quot;</li>';
	}

	if (empty($error)) {
		$query = "SELECT customer_id FROM customers WHERE login = '" .clear($login). "' LIMIT 1";
		$res = mysqli_query($db,$query) or die(mysqli_error());
		$row = mysqli_num_rows($res);
		if ($row) {
			$_SESSION['add_user']['res'] = "<div class='error'>Пользователь с таким логином уже зарегестрирован на сайте. Введите другой логин.</div>";
			$_SESSION['add_user']['name'] = $name;
			$_SESSION['add_user']['email'] = $email;
			$_SESSION['add_user']['password'] = $password;
			$_SESSION['add_user']['retrypassword'] = $retrypassword;
			return false;
		}
		else {
			$name = clear($name);
			$login = clear($login);
			$email = clear($email);

			$pass = md5($password);
			$retrypass = md5($retrypassword);
			$query = "INSERT INTO customers (name, login, email, password, 	retrypassword, id_role)
						VALUES ('$name', '$login', '$email', '$pass', '$retrypass', '$id_role')";
			$res = mysqli_query($db,$query) or die(mysqli_error());
			if (mysqli_affected_rows($db) > 0) {
				$_SESSION['answer'] = "<div class='success'>Пользователь добавлен</div>";
				return true;
			}
			else {
				$_SESSION['add_user']['res'] = "<div class='error'>Ошибка!<div>";
				$_SESSION['add_user']['name'] = $name;
				$_SESSION['add_user']['login'] = $login;
				$_SESSION['add_user']['email'] = $email;
				$_SESSION['add_user']['password'] = $password;
				$_SESSION['add_user']['retrypassword'] = $retrypassword;
				return false;
			}
		}
	}
	else {
		$_SESSION['add_user']['res'] = "<div class='error'>Не заполнены обязательные поля: <ul> $error </ul></div>";
		$_SESSION['add_user']['name'] = $name;
		$_SESSION['add_user']['login'] = $login;
		$_SESSION['add_user']['email'] = $email;
		$_SESSION['add_user']['password'] = $password;
		$_SESSION['add_user']['retrypassword'] = $retrypassword;
		return false;
	}
	mysqli_close($db);
}
function get_user($user_id) {
	$query = "SELECT name, login, email, id_role FROM customers WHERE customer_id = $user_id";
	$res = getdataadmin($query);
	$user = array();
	$user = mysqli_fetch_assoc($res);
	return $user;
}
function edit_user($user_id) {
	$db = mysqli_connect(HOST,USER,PASS,DB);
	foreach ($_POST As $key => $val) {
		if($key == "x" OR $key == "y") continue;
		if($key == "password" OR $key == "retrypassword"){
			$val = trim($val);
			if (!empty($val)) {
				$val = md5($val);
			}
			else {
				continue;
			}
		}
		else {
			$val = clear($val);
		}
		$data[$key] = $val;
	}
	$fields = array_keys($data);
	$values = array_values($data);
	$str = '';
	for ($i = 0; $i < count($fields); $i ++) {
		$str .= "{$fields[$i]} = '{$values[$i]}',";
	}
	$str = substr($str, 0, -1);
	mysqli_query($db, "UPDATE customers SET {$str} WHERE customer_id = $user_id");
	if (mysqli_affected_rows($db) > 0) {
		$_SESSION['answer'] = "<div class='success'>Данные обновлены</div>";
		if($user_id == $_SESSION['auth']['user_id']) {
			$_SESSION['auth']['admin'] = htmlspecialchars($_POST['name']);
		}
		return true;
	}
	else {
		$_SESSION['edit_user']['res'] = "<div class='error'>Ошибка!</div>";
		return false;
	}
	mysqli_close($db);
}
function del_user($user_id) {
	if ($_SESSION['auth']['user_id'] == $user_id) {
		$_SESSION['answer'] = "<div class='error'>Вы не можете удалить сами себя</div>";
	}
	else {
		$db = mysqli_connect(HOST,USER,PASS,DB);
		mysqli_query($db, "DELETE FROM customers WHERE customer_id = $user_id");
		if (mysqli_affected_rows($db) > 0) {
			$_SESSION['answer'] = "<div class='success'>пользователь удалён!</div>";
			return true;
		}
		else {
			$_SESSION['edit_user']['res'] = "<div class='error'>Ошибка при удалении пользователя!</div>";
			return false;
		}
		mysqli_close($db);
	}
}
?>
