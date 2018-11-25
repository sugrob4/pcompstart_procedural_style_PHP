<?php
header("Content-Type: application/rss+xml");
echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
<atom:link href="https://pcompstart/rss.php" rel="self" type="application/rss+xml" />
<title>Новинки от pcompstart</title>
<link>https://pcompstart</link>
<description>Много полезной информации по операционной системе</description>
<language>ru</language>
<image>
   <url>https://pcompstart/views/pcompstart/images/favicon.png</url>
   <link>https://pcompstart</link>
   <title>Новинки от pcompstart</title>
</image>
<?php
define('PCOMPSTART', true);
require_once ('config.php');
$db = mysqli_connect(HOST,USER,PASS,DB);
$query = "SELECT product_id, title, link_browser, anons, products_typeid, date 
                FROM products WHERE visible='1' ORDER BY product_id DESC LIMIT 10";
$result = mysqli_query($db,$query) or die(mysqli_error());
$row = array();
while ($row=mysqli_fetch_array($result))
{
 $id=$row['product_id'];
 $link_browser = $row['link_browser'];
 $products_typeid = $row['products_typeid'];
 $title=htmlspecialchars(strip_tags($row['title']));
 $text=htmlspecialchars(strip_tags($row['anons']));
 $date=date("D, d M Y H:i:s O", strtotime($row['date']));
echo "<item>
	<title>$title</title>
	<link>https://pcompstart/$products_typeid/$id-$link_browser</link>
	<description>$text</description>
	<author>pcompstart@gmail.com (Mordechai Aleksey Povar)</author>
    <pubDate>$date</pubDate>
	<guid>https://pcompstart/$products_typeid/$id-$link_browser</guid>
 	</item>";
}
mysqli_close($db);
?>
</channel>
</rss>