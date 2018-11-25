<?php
define('PCOMPSTART', true);

session_start();

if ($_GET['do'] == "logout") {
	unset($_SESSION['auth']);
}

if (!$_SESSION['auth']['admin']) {
	include $_SERVER['DOCUMENT_ROOT'].'/admin/auth/index.php';
}

require_once('../config.php');

require_once('../functions/functions.php');

require_once('functions/functions.php');

if ($_POST['img']) {
	$res = del_img();
	exit($res);
}

$cat = catalog();

$view = empty($_GET['view']) ? 'pages' : $_GET['view'];

switch ($view) {
	case ('pages') :
		$cheifinformers = cheifinformer();
	break;

	case ('forums'):
	break;

	case ('add_type'):
		if ($_POST) {
			if (add_type()) redirect('?view=forums');
			else redirect();
		}
	break;

	case ('edit_type'):
        $type_id = $_GET['type_link'];
		$krohi_types = krohi_types($type_id);
		if ($_POST) {
			if (edit_type($type_id)) redirect('?view=forums');
			else redirect();
		}
	break;

	case ('del_type'):
		$type_id = $_GET['type_link'];
		$ktext =  $_GET['type_link'];
		del_type($type_id);
		redirect();
	break;

	case ('edit_page'):
		$page_id = (int)$_GET['page_id'];
		$get_page = get_page($page_id);
		if ($_POST) {
			if (edit_page($page_id)) {
				redirect('?view=pages');
			}
			else {
				redirect();
			}
		}
	break;

	case ('add_page'):
		if ($_POST) {
			if (add_page()) redirect('?view=pages');
			else redirect();
		}
	break;

	case ('del_page'):
		$page_id = (int)$_GET['page_id'];
		del_page($page_id);
		redirect();
	break;

	case ('cat'):
        $category = $_GET['category'];

		//pagination
		$perpage = 15;
		if (isset($_GET['page'])) {
				$page = (int)$_GET['page'];
		  if($page < 1) $page = 1;
		}
		else {
			  $page = 1;
		}
		$count_rows = count_rows($category);
		$pages_count = ceil($count_rows / $perpage);
		if(!$pages_count) $pages_count = 1;
		if($page > $pages_count) $page = $pages_count; // если запрошенная страница больше максимума
		$start_pos = ($page - 1) * $perpage; // начальная позиция для запроса
		//pagination

		$products = products($category, $start_pos, $perpage);
	break;

	case ('informers'):
		$informers = informer();
    break;
	case ('add_informer'):
		if ($_POST) {
			if (add_informer()) redirect('?view=informers');
			else redirect();
		}
	break;
	case ('edit_informer'):
		$id_anons = (int)$_GET['id_anons'];
		$get_informer = get_informers($id_anons);
		if ($_POST) {
			if (edit_informer($id_anons)) redirect('?view=informers');
			else redirect();
		}
	break;
	case ('del_informer'):
		$id_anons = (int)$_GET['id_anons'];
		del_informer($id_anons);
		redirect();
	break;

	case ('add_product'):
		$type_id = $_GET['type_link'];
		if ($_POST) {
			if (add_product()) redirect("?view=cat&category=$type_id");
			else redirect();
		}
	break;

	case ('edit_product'):
		$product_id = (int)$_GET['product_id'];
		$get_product = get_product($product_id);
		$type_id = $get_product['products_typeid'];
		if ($get_product['img_icon'] != "noimage_Icon.png") {
			$baseimg = '<img class="delimg" src="' .PRODUCTIMG.$get_product['img_icon']. '" alt="' .$get_product['img_icon']. '">';
		}
		else {
			$baseimg = '<input type="file" name="baseimg">';
		}
		if ($_POST) {
			if (edit_product($product_id)) redirect("?view=cat&category=$type_id");
			else redirect();
		}
	break;

	case ('del_product'):
		$product_id = (int)$_GET['product_id'];
		del_product($product_id);
		redirect();
	break;

	case ('mod_comment'):
		//pagination
		$perpage = 15;
		if (isset($_GET['page'])) {
				$page = (int)$_GET['page'];
		  if($page < 1) $page = 1;
		}
		else {
			  $page = 1;
		}
		$count_rows = pagination_comments();
		$pages_count = ceil($count_rows / $perpage);
		if(!$pages_count) $pages_count = 1;
		if($page > $pages_count) $page = $pages_count; // если запрошенная страница больше максимума
		$start_pos = ($page - 1) * $perpage; // начальная позиция для запроса
		$count_comments = count_comments($start_pos, $perpage);
		//pagination
	break;
	case ('show_comment'):
		$comment_id = (int)$_GET['comment_id'];
		$comment = show_comment($comment_id);
	break;
	case ('del_comment'):
		$comment_id = (int)$_GET['comment_id'];
		del_comment($comment_id);
		redirect("?view=mod_comment");
	break;

	case ('users'):
		$perpage = 25;
		if (isset($_GET['page'])) {
				$page = (int)$_GET['page'];
		  if($page < 1) $page = 1;
		}
		else {
			  $page = 1;
		}
		$count_rows = count_users();
		$pages_count = ceil($count_rows / $perpage);
		if(!$pages_count) $pages_count = 1;
		if($page > $pages_count) $page = $pages_count;
		$start_pos = ($page - 1) * $perpage;
		$users = get_users($start_pos, $perpage);
	break;
	case ('add_user'):
		$roles = get_roles();
		if ($_POST) {
			if(add_user()) redirect("?view=users");
			else redirect();
		}
	break;
	case ('edit_user'):
		$user_id = (int)$_GET['user_id'];
		$get_user = get_user($user_id);
		$roles = get_roles();
		if ($_POST) {
			if(edit_user($user_id)) redirect("?view=users");
				else redirect();
		}
	break;
	case ('del_user'):
		$user_id = (int)$_GET['user_id'];
		del_user($user_id);
		redirect();
	break;

	default :
		$view = 'pages';
		$cheifinformers = cheifinformer();
}

include ADMIN_TEMPLATE.'header.php';

include ADMIN_TEMPLATE.'leftbar.php';

include ADMIN_TEMPLATE.$view.'.php';

include ADMIN_TEMPLATE.'footer.php';
?>
