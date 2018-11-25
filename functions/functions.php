<?php
defined('PCOMPSTART') or die('Access denied');

function print_arr($arr) {
	echo "<pre>";
		print_r($arr);
	echo "</pre>";
}
// Функция для обрезки тегов и знаков переноса строки, либо с новой строки,
// из данных выводимых в `<script type="application/ld+json">`
function for_ldjson($dat) {
    $a = strip_tags($dat);
    $b = trim(preg_replace("/\r\n|\r|\n|\t/", ' ', $a));
    return $b;
}
// Фунция выбокри всех изображений и текста `product.php`
function get_prod_data($prod_img) {
    $val = '';
    preg_match_all( '@src="([^"]+)"@' , $prod_img, $result);
    $res = array_pop($result);
    foreach ($res as $endres) {
        $im = explode(':', $endres)[1];
        $val .= '"'.'https:'.$im.'"'.','."\n";
    }
    $val = rtrim($val, ','."\n");
    echo '"'.'image'.'"'.': '.'['.$val.']'.','."\n",
        '"'.'articleBody'.'"'.': '.json_encode(for_ldjson($prod_img), JSON_UNESCAPED_UNICODE);
}
// Функция разборки переменной массива
// и обратной сборке в качестве масива для `ld-json`, файл `cat.php`,`catalogindex.php`
function jsl($prod, $artsec=false) {
    $a = array();
   foreach ($prod as $itm) {
        if ($artsec == true) {
            $a[0] = $a[0] .'"'.$itm['type_name'].'"'.','."\n";
        }
        $a[1] = $a[1].json_encode($itm['title'], JSON_UNESCAPED_UNICODE).','."\n";
        $a[2] = $a[2].'"'.'https:'.PRODUCTIMG.$itm['img_icon'].'"'.','."\n";
        $a[3] = $a[3].'"'.'https:'.PATH.$itm['products_typeid'].'/'.$itm['product_id'].'-'.$itm['link_browser'].'"'.','."\n";
        $a[4] = $a[4].'"'.date('Y-m-d', strtotime($itm['date'])).'"'.','."\n";
        $a[5] = $a[5].'"'.date('Y-m-d', strtotime($itm['date'])).'"'.','."\n";
        $a[6] = $a[6].json_encode(for_ldjson($itm['anons']), JSON_UNESCAPED_UNICODE).','."\n";
    }
    for ($i=0;$i<count($a);$i++) {
        $a[$i] = rtrim($a[$i], ','."\n");
    }
    if ($artsec == true) {
        echo '"'.'articleSection'.'"'.':'.'['.$a[0].']'.','."\n",
            '"'.'headline'.'"'.':'.'['.$a[1].']'.','."\n",
            '"'.'image'.'"'.':'.'['.$a[2].']'.','."\n",
            '"'.'url'.'"'.':'.'['.$a[3].']'.','."\n",
            '"'.'datePublished'.'"'.':'.'['.$a[4].']'.','."\n",
            '"'.'dateModified'.'"'.':'.'['.$a[5].']'.','."\n",
            '"'.'description'.'"'.':'.'['.$a[6].']'.','."\n";
    } else {
        echo '"'.'headline'.'"'.':'.'['.$a[1].']'.','."\n",
            '"'.'image'.'"'.':'.'['.$a[2].']'.','."\n",
            '"'.'url'.'"'.':'.'['.$a[3].']'.','."\n",
            '"'.'datePublished'.'"'.':'.'['.$a[4].']'.','."\n",
            '"'.'dateModified'.'"'.':'.'['.$a[5].']'.','."\n",
            '"'.'description'.'"'.':'.'['.$a[6].']'.','."\n";
    }
}
/*Функция разборки $informers для ld+json файл `catalogindex.php`,
`Главная` страница*/
function getJsonInformers($inform) {
    $inf = array();
    foreach ($inform as $key => $item) {
        preg_match_all('!(https?:)?//\S+\.(?:jpe?g|jpg|png|gif)!Ui', $item['text'], $matches);
        $inf[0] = $inf[0].'"'.$item['name'].'"'.','."\n";
        $inf[1] = $inf[1].'"'.$matches[0][0].'"'.','."\n";
        $inf[2] = $inf[2].'"'.'https:'.PATH.'category/'.$item['parent_type'].'"'.','."\n";
        $inf[3] = $inf[3].'"'.for_ldjson($item['text']).'"'.','."\n";
    }
    $inf[1] = str_replace('http://', 'https://', $inf[1]);
    for ($i=0;$i<count($inf);$i++) {
        $inf[$i] = rtrim($inf[$i], ','."\n");
    }
    echo '"'.'articleSection'.'"'.':'.'['.$inf[0].']'.','."\n",
        '"'.'image'.'"'.':'.'['.$inf[1].']'.','."\n",
        '"'.'url'.'"'.':'.'['.$inf[2].']'.','."\n",
        '"'.'description'.'"'.':'.'['.$inf[3].']'.','."\n";
}
// Функция 301 редиректа используется в `controller.php`
function get301($val, $pag=false) {
    $path = PATH;
    if ($pag == false) {
        header("Location: https:$path$val", true, 301);
        exit;
    } else {
        header("Location: https:$path$val/$pag", true, 301);
        exit;
    }
}
// Функция 404 ошибки используется в `controller.php`
function get404() {
    header('HTTP/1.1 404 Not Found');
    $_GET['e'] = 404;
    include 'page404.html';
    exit();
}
// Функция транслита, пример использования `echo translit("Всем привет!");`
function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
    return str_replace($rus, $lat, $str);
}
function clear($var) {
  	$db = mysqli_connect(HOST,USER,PASS,DB);
	$var = mysqli_real_escape_string($db,strip_tags($var));
	return $var;
}
function redirect($http = false) {
	if ($http) {
		$redirect = $http;
	}
	else {
		$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
	}
	header("Location: $redirect");
	exit();
}
function logout() {
	unset($_SESSION['auth']);
}
function pagination($page, $pages_count, $modrew = 1) {
    if ($modrew == 0) {
        // если функция вызывается на странице без ЧПУ
        if ($_SERVER['QUERY_STRING']) { // если есть параметры в запросе
            $uri = "?";
            foreach ($_GET As $key => $value) {
                // формируем строку параметров без номера страницы... номер передается параметром функции
                if($key != 'page') $uri .= "{$key}={$value}&amp;";
            }
        }
    }else{
        // если функция вызвана на странице с ЧПУ
        $uri = $_SERVER["REQUEST_URI"];
        $params = explode("/", $uri);
        $uri = null;
        foreach($params as $param) {
            if (!empty($param) AND !preg_match("#page=#", $param)) {
                $uri .= "/$param";
            }
        }
        $uri .= "/";
    }
	// формирование ссылок
	$back = ''; // ссылка НАЗАД
	$forward = ''; // ссылка ВПЕРЕД
	$startpage = ''; // ссылка В НАЧАЛО
	$endpage = ''; // ссылка В КОНЕЦ
	$page2left = ''; // вторая страница слева
	$page1left = ''; // первая страница слева
	$page2right = ''; // вторая страница справа
	$page1right = ''; // первая страница справа

	if ($page > 1) {
		$back = "<a class='nav_link' href='{$uri}page=" .($page-1). "'>&lt;</a>";
	}
	if ($page < $pages_count) {
		$forward = "<a class='nav_link' href='{$uri}page=" .($page+1). "'>&gt;</a>";
	}
	if ($page > 3) {
		$startpage = "<a class='nav_link' href='{$uri}page=1'>В начало</a>";
	}
	if ($page < ($pages_count-2)) {
		$endpage = "<a class='nav_link' href='{$uri}page={$pages_count}'>В конец</a>";
	}
	if ($page-2 > 0) {
		$page2left = "<a class='nav_link' href='{$uri}page=" .($page-2). "'>" .($page-2). "</a>";
	}
	if ($page-1 > 0) {
		$page1left = "<a class='nav_link' href='{$uri}page=" .($page-1). "'>" .($page-1). "</a>";
	}
	if ($page+2 <= $pages_count) {
		$page2right = "<a class='nav_link' href='{$uri}page=" .($page+2). "'>" .($page+2). "</a>";
	}
	if ($page+1 <= $pages_count) {
		$page1right = "<a class='nav_link' href='{$uri}page=" .($page+1). "'>" .($page+1). "</a>";
	}

	// формируем вывод навигации
	echo '<div class="pagination">' .$startpage.$back.$page2left.$page1left.'<a class="nav_active">'.$page.'</a>'.$page1right.$page2right.$forward.$endpage. '</div>';
}
function bbTags($var){
	$bb = array('[b]', '[/b]');
	$tag = array('<b>', '</b>');
	return str_ireplace($bb, $tag, $var);
}
function smile($var){
	$symbol = array(':mellow:',
					':sorr;',
					':)',
					':wub:',
					':angry:',
					':(',
					':unsure:',
					':wacko:',
					':blink:',
					'-_-',
					':rolleyes:',
					':huh:',
					'^_^',
					':o',
					';)',
					':P',
					':D',
					':lol:',
					'B)',
					':ph34r:');
	$graph = array('<img src="../views/pcompstart/images/mellow.png">',
					'<img src="../views/pcompstart/images/dry.png">',
					'<img src="../views/pcompstart/images/smile.png">',
					'<img src="../views/pcompstart/images/wub.png">',
					'<img src="../views/pcompstart/images/angry.png">',
					'<img src="../views/pcompstart/images/sad.png">',
					'<img src="../views/pcompstart/images/unsure.png">',
					'<img src="../views/pcompstart/images/wacko.png">',
					'<img src="../views/pcompstart/images/blink.png">',
					'<img src="../views/pcompstart/images/sleep.png">',
					'<img src="../views/pcompstart/images/rolleyes.gif">',
					'<img src="../views/pcompstart/images/huh.png">',
					'<img src="../views/pcompstart/images/happy.png">',
					'<img src="../views/pcompstart/images/ohmy.png">',
					'<img src="../views/pcompstart/images/wink.png">',
					'<img src="../views/pcompstart/images/tongue.png">',
					'<img src="../views/pcompstart/images/biggrin.png">',
					'<img src="../views/pcompstart/images/laugh.png">',
					'<img src="../views/pcompstart/images/cool.png">',
					'<img src="../views/pcompstart/images/ph34r.png">');
	return str_replace($symbol, $graph, $var);
}
function mail_contacts() {
	$name_mail = htmlspecialchars(substr($_POST['name_mail'],0,30));
	$mail = htmlspecialchars(substr($_POST['mail'],0,40));
	$aspsm = $_POST['aspam'];
	$text_mail = htmlspecialchars(substr($_POST['text_mail'],0,1500));
	$patern = "/^[a-z0-9_\-]+@[a-z0-9_\-]+\.[a-z]{2,6}$/i"; // name@to.com  - проверка на правильность введённого email
	$error = '';

	if(empty($name_mail)) $error .= "<li>Не заполнено поле \"Имя\"</li>";
	if(empty($mail)) $error .= "<li>Не заполнено поле \"e-mail\"</li>";
	if($aspsm == 'on') $error .= "<li>Не пройдена проверка на человечность</li>";
	if(empty($text_mail)) $error .= "<li>Не заполнено поле \"Текст сообщения\"</li>";
	if(!empty($mail) and !preg_match($patern,$mail)) $error .= "<li>Поле \"e-mail\" не соответствует установленному формату</li>";

	if (empty($error)) {
		$to = 'pcompstart@gmail.com';
		$subject = 'Заполнена форма на сайте';
		$message = "Имя:   ".$_POST['name_mail']."\r\n\r\n";
		$message .= "Обратный e-mail:   ".$_POST['mail']."\r\n\r\n";
		$message .= "Текст сообщения:\r\n ".$_POST['text_mail'];
		$headers = "Content-type: text/plain; charset = \"utf-8\"";

		if (mail($to, $subject, $message, $headers)) {
			$_SESSION['submit_mail']['res'] = "<div class='success'>$name_mail, Ваше сообщение отправлено.</div>";
		}
		else {
			$_SESSION['submit_mail']['res'] = "<div class='error'>Произошла ошибка. Попробуйте еще раз</div>";
			$_SESSION['submit_mail']['name_mail'] = $name_mail;
			$_SESSION['submit_mail']['mail'] = $mail;
			$_SESSION['submit_mail']['text_mail'] = $text_mail;
		}
	}
	else {
		$_SESSION['submit_mail']['res'] = "<div class='error'>Вы не заполнили обязательные поля: <ul>".$error."</ul></div>";
		$_SESSION['submit_mail']['name_mail'] = $name_mail;
		$_SESSION['submit_mail']['mail'] = $mail;
		$_SESSION['submit_mail']['text_mail'] = $text_mail;
	}
}
// Функция обрезки текста для блоков на главной странице
function summary($str, $limit=320) {
    if (strlen($str) > $limit) {
        $str = substr($str, 0, $limit - 3);
        return (rtrim(substr($str, 0, strrpos($str, ' ')), ',').'...');
    }
    return trim($str);
}
// Функция для замены протокола `http://` на `https://` для старых ссылок картинок
//  а также добавления тега title для всех картинок
function get_seo_content($prod, $prod_title) {
    $a = str_replace('src="http://', 'src="https://', $prod);
    $img_title = '<img title='.'"'.$prod_title.'"';
    $b = str_replace('<img', $img_title, $a);
    return $b;
}
// Функция удаления ненужных картинок из папки `userfiles/forhome` для `catalogindex.php`
// 30 последних статей сайта
function remove_catindex_img($img) {
    $dir = 'userfiles/forhome';
    $files = array_diff(scandir($dir), array('..', '.'));
    $exist_img = array_diff($files, $img);
    foreach ($exist_img as $forremove) {
        if ($forremove == 'noimage_Icon.png') {
            return true;
        } else {
            @unlink("userfiles/forhome/$forremove");
        }
    }
}
