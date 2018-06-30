<?php 

function clean2($str, $replace=array(), $delimiter=' ') {
  if( !empty($replace) ) {
    $str = str_replace((array)$replace, ',', $str);
  }

  $clean2 = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
  $clean2 = preg_replace("/[^a-z-,A'#()-Z0-><?9.\/_|+ -]/", '', $clean2);
  $clean2 = strtolower(trim($clean2, ''));
  $clean2 = preg_replace("/[\/_()|:'+, .#-]+/", $delimiter, $clean2);

  return $clean2;
}
require('function.php');

$protocol = isset($_SERVER['HTTPS']) ? 'https' : 'https';

$timeUTC = date('Y-m-d') . 'T' . date('H:i:s') . '+00:00';

if (isset($_GET['sitemap'])) 
{
	ini_set('display_errors', 1);
	// Set header for XML
	header('Content-Type: application/xml; charset=UTF-8');
	// Print XML header
	echo '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';


	if ($handle = opendir('data')) {
		while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != ".." && preg_match("/keyword_/", $entry)) {
				$entry = str_replace(array("keyword_", ".txt"), "",  $entry);
				if (!empty($entry)) {
					echo "	<sitemap>\n";
					echo "		<loc> ".  $protocol.'://'.$_SERVER['HTTP_HOST'] ."/114561221545664212451sitemap_part" . $entry . ".xml\n</loc>\n";
					echo "	</sitemap>\n";
				}
			}
		}
		closedir($handle);
	}
echo "</sitemapindex>"; 
}

else if (isset($_GET['book'])) 
{
	$siteMapRs = dirname(__file__).'/data/keyword_'.$_GET['book'].".txt";
	$siteMapRS = @file_get_contents($siteMapRs);
	if (empty($siteMapRS))
	{
		header("location: index.php");
	}
	else
	{
		header('Content-Type: application/xml; charset=UTF-8');
		echo '<?xml version="1.0" encoding="UTF-8"?>';
		echo "\n\n";
		echo '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		echo "\n";

		$siteMapRs = dirname(__file__).'/data/keyword_'.$_GET['book'].".txt";
		$siteMapRS = @file_get_contents($siteMapRs);
		$siteMapRS = explode("\n", $siteMapRS);
		$counting = 0;
		krsort($siteMapRS);
		$number_siteMaps_to_show = '10000';
		foreach($siteMapRS as $siteMapR) {
			$splitsiteMapD = explode("___", $siteMapR);
			$ASIN = $splitsiteMapD[0];
	        $Title = $splitsiteMapD[1];
			$counting ++;
			if (!empty($ASIN) && !empty($Title)) {
			$strings = preg_replace('/[^\p{L}\p{N}\s]/u', '', $Title);
			$string = truncate($strings, 232, 80);
      		$url = str_replace(" ", "-", clean2($string));
			$counting ++;
			echo "    <url>\n";
			echo "        <loc>" .$protocol.'://'.$_SERVER['HTTP_HOST'] ."/file-".$ASIN."/".$url.".pdf</loc>\n";
			echo "        <lastmod>".$timeUTC."</lastmod>\n";
			echo "        <changefreq>daily</changefreq>\n";
			echo "        <priority>" . rand(50, 60) / 100 . "</priority>\n";
			echo "    </url>\n";
			}
			if($counting >= $number_siteMaps_to_show) { break; }
		}
		echo "</urlset>\n";
	}
}


else if (isset($_GET['as'])) 
{

	// Set header for XML
	header('Content-Type: application/xml; charset=UTF-8');

	// Print XML header
	echo '<?xml version="1.0" encoding="UTF-8"?>';
	echo "\n\n";

	echo '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	echo "\n";
	
	$siteMapRs = dirname(__file__).'/data/keyword_'.$_GET['book'].".txt";
	$siteMapRS = @file_get_contents($siteMapRs);
	$siteMapRS = explode("\n", $siteMapRS);
	krsort($siteMapRS);
	$counting = 0;
	$number_siteMaps_to_show = COUNT_SITEMAP;

	echo "    <url>\n";
	echo "        <loc>".  $protocol.'://'.$_SERVER['HTTP_HOST'] ."/sitemap/".$_GET['book']."</loc>\n";
	echo "        <lastmod>".$timeUTC."</lastmod>\n";
	echo "        <changefreq>daily</changefreq>\n";
	echo "        <priority>" . rand(60, 60) / 100 . "</priority>\n";
	echo "    </url>\n";
	
	echo "</urlset>\n";
}
?>