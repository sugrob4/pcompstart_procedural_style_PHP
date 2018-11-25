<?php
defined('PCOMPSTART') or die('Access denied');

session_start();

require_once MODEL;

require_once('functions/functions.php');

$cat = catalog();

$meta = array();

$meta_graph = array();

$cheifinformers = cheifinformer();
if (isset($cheifinformers[0])) {
    $meta['title'] = "{$cheifinformers[0]['meta_title']}";
    $meta['description'] = "{$cheifinformers[0]['description']}";
    $meta['keywords'] = "{$cheifinformers[0]['keywords']}";
}

if ($_POST['reg']) {
    registration();
    redirect();
}

if ($_POST['auth']) {
    authorization();
    if ($_SESSION['auth']['user']) {
        echo "<p class='welcome'>Добро пожаловать <br /> {$_SESSION['auth']['user']}</p>";
        exit();
    }
    else {
        echo $_SESSION['auth']['error'];
        unset ($_SESSION['auth']);
        exit();
    }
}

if ($_GET['do'] == 'logout') {
    logout();
    redirect();
}

$view = empty($_GET['view']) ? 'catalogindex' : $_GET['view'];

switch ($view) {
    case('catalogindex'):
        $srv = $_SERVER['REQUEST_URI'];
        if ($srv == "/index.php") {
            get301($val='');
        } elseif (strpos($srv, '?') == true) {
            get404();
        }
        $lastarticles = thirtylast();
        $meta_graph['og_image'] = 'https://pcompstart/userfiles/upload/images/img_icon/loginkontakts.png';
        $meta_graph['og_url'] = "https:".PATH;
        break;

    case ('cat'):
        $category = $_GET['category'];

        // Редирект 301 и 404 ошибка для всех предыдущих url
        $srv = $_SERVER['REQUEST_URI'];
        $a = preg_split('[/+]', $srv);
        if (strpos($srv, '&') != false) {
            $oldurl_val = explode('&', $srv);
        }
        $w = substr($oldurl_val[1], -1);
        $check_val = explode("=", $srv);
        foreach ($cat as $k) {
            if ($a[2] == $k['type_id']) {
                $cts = $k['link_browser_type'];
            }
            if ($category == $k['link_browser_type']) {
                $lnk = $k['link_browser_type'];
            }
            if ($w == $k['type_id']) {
                $newurl = $k['link_browser_type'];
            }
            if (substr($check_val[2], 0, 1) == $k['type_id']) {
                $check_url = $k['link_browser_type'];
            }
        }
        // Разбивка адресса непонятно откуда ошибки google, на мобильных телефонах
        // пример адреса `https://pcompstart.com/index.php/2?view=cat&category=2/page=2`
        // Сюда относится переменные `$check_val`, `$check_url`
        if (explode('/', $srv)[1] == 'index.php') {
            if (isset($check_val[3]) and is_numeric($check_val[3])) {
                get301($val=$check_url, $pag='page='.$check_val[3]);
            } else {
                get301($val=$check_url);
            }
        }

        // Разбивка адресса непонятно откуда ошибки google на ПК
        // пример адреса `https://pcompstart/?view=cat&category=2?view=page&page_id=2&page=3`
        // Сюда относится переменные `$check_val`, `$check_url`
        // редирект происходит на категорию `category=2`
        if ($check_val[3] == 'page&page_id') {
            if (isset($check_val[5]) and is_numeric($check_val[5])) {
                get301($val=$check_url, $pag='page='.$check_val[5]);
            } else {
                get301($val=$check_url);
            }
        }

        // Для редиректа на без `www`
        $m = explode('?', $srv);
        if ($m[0] == '/index.php' and !empty(explode('=', $m[1])[2])) {
            $for_www = explode('&', $srv);
            if (isset($for_www[2]) and is_numeric(explode('=', $for_www[2])[1])) {
                get301($val=$lnk, $pag=$for_www[2]);
            } else {
                get301($val=$lnk);
            }
        }
        // Конец для редиректа на без `www`
        $e = '/category/'.$a[2];
        $pag_old = '/category/'.$a[2].'/'.$a[3];
        if (!empty($w)) {
            $cur_oldurl = '/?view=cat&category='.$w;
            $cur_oldurl_pag = '/?view=cat&category='.$w.'&'.$oldurl_val[2];
            if ($cur_oldurl == $srv) {
                get301($val=$newurl);
            } elseif ($cur_oldurl_pag == $srv) {
                get301($val=$newurl, $pag=$oldurl_val[2]);
            } elseif (strpos(
                    htmlspecialchars($srv),
                    htmlspecialchars('?view=cat&amp;category')) !== false) {
                // Редирект с адреса
                // `https://pcompstart.com/?view=cat&amp;category=1&amp;page=2`
                $amp = explode(';', $oldurl_val[2])[1];
                if (isset($amp)) {
                    get301($val=$newurl, $pag=$amp);
                } else {
                    get301($val=$newurl);
                }
            } elseif (isset($oldurl_val[2]) and $cur_oldurl_pag != $srv) {
                // Репдирект с адреса типа
                // `https://pcompstart.com/?view=cat&category=6?view=cat&category=3`
                $double_url = explode('?', $srv);
                if (strpos($double_url[2], substr($cur_oldurl, 2, -1)) !== false) {
                    get301($val=$check_url);
                }
                // Репдирект с адреса типа
                // `https://pcompstart.com/?view=cat&category=3&page_id=2?view=cat&page=4`
                if (strpos($srv, $cur_oldurl) !== false) {
                    $current_page = end(explode('&', $srv));
                    if (!empty($current_page)) {
                        get301($val=$newurl, $pag=$current_page);
                    } else {
                        get301($val=$newurl);
                    }
                } else {
                    get404();
                }
            } elseif (!isset($oldurl_val[2]) and $cur_oldurl != $srv) {
                // Редирект с url типа `https://pcompstart.com/?view=cat&category=`
                // на главную
                if (strpos($cur_oldurl, $srv) !== false) {
                    get301($val='');
                } else {
                    get404();
                }
            }
        }

        // Редирект с url `https://pcompstart.com/?view=cat&` на главную
        if (empty($oldurl_val[1]) and $oldurl_val[0] == '/?view=cat') {
            get301($val='');
        }

        if ($e == $srv and is_numeric($a[2])) {
            get301($val=$cts);
        } elseif ($pag_old == $srv and is_numeric(end(explode('=', $a[3])))) {
            get301($val=$cts, $pag=$a[3]);
        } elseif (isset($a[3]) and $srv != '/'.$lnk.'/'.$a[2]) {
            get404();
        } elseif ('/'.$a[1] != '/'.$lnk) {
            get404();
        }

        // Редирект с `page=1` на без `page=1`
        if ($a[2] == 'page=1') {
            get301($val=$a[1]);
        }

        // Конец редиректа 301 и 404 ошибки

        //параметры для навигации
        $perpage = PERPAGE; // кол-во товаров на страницу
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
        $brand_name = brand_name($category);
        $products = products($category, $start_pos, $perpage);
        $krohi_types = krohi_types($category);
        if ($page > 1) $pg = ', страница '.$page;
        $meta['title'] = "{$brand_name[0]['title']}{$pg}";
        $meta['keywords'] = "{$brand_name[0]['keywords']}{$pg}";
        $meta['description'] = "{$brand_name[0]['description']}{$pg}";
        $meta_graph['og_image'] = "https:".PATH.TEMPLATE.'images/logo_right.png';
        if ($page > 1) {
            $meta_graph['og_url'] = "https:".PATH.$lnk.'/page='.$page;
        } else {
            $meta_graph['og_url'] = "https:".PATH.$lnk;
        }
        break;

    case ('reg'):
        if ('/reg' == $_SERVER['REQUEST_URI']) {
            get301($val='registration');
        } elseif (strpos($_SERVER['REQUEST_URI'], 'index.php') ==  true) { // Для редиректа на без `www`
            get301($val='registration');
        }
        $meta_reg = getmeta_pages()[1];
        $meta['title'] = $meta_reg['meta_title']." | ".TITLE;
        $meta['keywords'] = $meta_reg['keywords'];
        $meta['description'] = $meta_reg['description'];
        break;

    case ('sitemap'):
        // Для редиректа на без `www`
        if (strpos($_SERVER['REQUEST_URI'], 'index.php') ==  true) {
            get301($val='sitemap');
        }
        // Конец для редиректа на без `www`
        $sitemap = sitemap();
        $meta_sitemap = getmeta_pages()[0];
        $meta['title'] = $meta_sitemap['meta_title'].' | '.TITLE;
        $meta['keywords'] = $meta_sitemap['keywords'];
        $meta['description'] = $meta_sitemap['description'];
        $meta_graph['og_image'] = 'https://pcompstart/userfiles/upload/images/img_icon/loginkontakts.png';
        $meta_graph['og_url'] = "https:".PATH;
        break;

    case ('page'):
        // Для редиректа на без `www` СПЕЦЕФИЧЕСКИ ДЛЯ `contacts`
        if (strpos($_SERVER['REQUEST_URI'], 'index.php') ==  true) {
            get301($val='contacts');
        }
        // Конец для редиректа на без `www`
        for ($i=1;$i<count($cheifinformers);$i++) {
            if ($_SERVER['REQUEST_URI'] == '/'.$cheifinformers[$i]['link_browser']) {
                $get_page = $cheifinformers[$i];
                $meta['title'] = "{$get_page['meta_title']}";
                $meta['keywords'] = "{$get_page['keywords']}";
                $meta['description'] = "{$get_page['description']}";
            }
        }
        if ($_POST['submit_mail']) {
            mail_contacts();
            redirect();
        }
        break;

    case ('search'):
        $result_search = search();

        //параметры для навигации
        $perpage = PERPAGE; // кол-во товаров на страницу
        if (isset($_GET['page'])) {
            $page = (int)$_GET['page'];
            if($page < 1) $page = 1;
        }
        else {
            $page = 1;
        }
        $count_rows = count($result_search);
        $pages_count = ceil($count_rows / $perpage);
        if(!$pages_count) $pages_count = 1;
        if($page > $pages_count) $page = $pages_count; // если запрошенная страница больше максимума
        $start_pos = ($page - 1) * $perpage; // начальная позиция для запроса
        $endpos = $start_pos + $perpage; // до какого товара будет вывод на странице
        if($endpos > $count_rows) $endpos = $count_rows;
        $meta['title'] = "Поиск по сайту | " .TITLE;
        $meta['keywords'] = "результаты поиска | ".TITLE;
        $meta['description'] = "результаты поиска по сайту | " .TITLE;
        break;

    case ('product'):
        $product_id = abs((int)$_GET['product_id'] );
        if ($product_id) {
            $product = get_product($product_id);
            $brand_name = brand_name($product['products_typeid']);
            $request = $_SERVER['REQUEST_URI'];
            if($product) {
                // Редирект 301 и 404 ошибка в статьях
                $a = $brand_name[0]['link_browser_type'].'/'.$product['product_id'].'-'.$product['link_browser'];
                $forredict = '/'.$brand_name[0]['link_browser_type'].'/'.$product['product_id'];
                $b = '/product/'.$product['product_id'];
                $old_prod_url = '?view=product&product_id='.$product['product_id'];
                if ('/'.$old_prod_url == $request) {
                    get301($val=$a);
                } elseif ($b == $request) {
                    get301($val=$a);
                } elseif ($forredict == $request) {
                    get301($val=$a);
                } elseif (explode('/', $request)[1] == "index.php") {
                    get301($val=$a);
                } elseif (explode('?', $request)[0] == "/index.php") { // Для редиректа на без `www`
                    get301($val=$a);
                } elseif ('/'.$a !== $request) {
                    // редирект если не хватает составляющей в по порядку в ссылке
                    $badlnk = explode('?', $request)[1];
                    if (strpos('/'.$a, $request) !== false) {
                        get301($val=$a);
                    } elseif (explode('&', $badlnk)[0] == 'product_id='.$product['product_id']) {
                        get301($val=$a);
                    } else {
                        get404();
                    }
                }
            } else {
                $ar = explode('/', $request);
                foreach ($cat as $itm) {
                    if ($ar[1] == $itm['link_browser_type']) {
                        $cur = $itm['link_browser_type'];
                    }
                }
                $realis = '/'.$cur.'/'.$ar[2];
                if ($realis == $request) {
                    "<div class=\"error\">Такого продукта нет</div>";
                } elseif ($cur == false) {
                    get404();
                } else {
                    "<div class=\"error\">Такого продукта нет</div>";
                }
                // Конец редирект 301 и 404 ошибка в статьях
            }
        }

        // Выборка ссылок на 5 статьей, внизу публикации.
        if (!empty($product['title'])) {
            $select_p = links_prod($product['title']);
        }

        $meta['title'] = "{$product['meta_title']}";
        $meta['keywords'] = "{$product['keywords']}";
        $meta['description'] = "{$product['description']}";
        $comments = comments($product_id);
        if ($_POST['submit_comm']) {
            insert_comm($product_id);
            redirect();
        }
        $smiles = get_smiles();
        preg_match_all('!(https?:)?//\S+\.(?:jpe?g|jpg|png|gif)!Ui', $product['content'], $result);
        $meta_graph['og_image'] = $result[0];
        $meta_graph['og_url'] = "https:".PATH.$brand_name[0]['link_browser_type']."/".$product['product_id']."-".$product['link_browser'];
        $meta_graph['published_time'] = date('Y-m-d', strtotime($product['date']));
        break;

    default :
        get404();

}

require_once $_SERVER['DOCUMENT_ROOT'].'/'.TEMPLATE.'index.php';
