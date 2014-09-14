<?php
set_time_limit(900);
ini_set('memory_limit', '1024M');
include("functions.php");
$coords = getCoordinates('Rhinow Ahornweg 7');
echo 'lat:'.$coords[0].'<br>';
echo 'lng:'.$coords[1].'<br>';
/*$url = "http://www.internetwache.brandenburg.de/sixcms/list.php?page=rss_hvl";
    $output = "";
    if ( $rss = @simplexml_load_file( $url ) ) {
        foreach ( $rss->channel->item as $item ) {
            $output .= "<h2>{$item->title}</h2>";
			$output .= "{$item->link}<br><br>";
            $output .= "{$item->description}";
        }
        echo utf8_decode ("<div class='headlines'>{$output}</div>");
    } else {
        echo "<div>Auslesen nicht erfolgreich! URL des Feeds überprüfen!</div>";
    }
}*/

$namen = array();
$query = mysql_query("SELECT bezeichnung FROM strassen WHERE latitude != ''") or die (mysql_error());
while($row = mysql_fetch_array($query))
{
   $namen[] = $row['bezeichnung']; 
}
$array_count = count($namen);



$a = 1;
while($a < 4)
   {
   $a++;
if ($a == 1) {
$ausgabe = ""; } 
elseif ($a == 2){
$ausgabe = "?page_at_1_0=2";}
 else { $ausgabe = "?page_at_1_0=3"; }

$u = "http://www.berlin.de/polizei/polizeimeldungen/archiv/2014/".$ausgabe."";
  $uen=urlencode($u);
    if((array_key_exists($uen,$crawled_urls)==0 || $crawled_urls[$uen] < date("YmdHis",strtotime('-25 seconds', time())))){
     $html = file_get_html($u);
     $crawled_urls[$uen]=date("YmdHis");
     foreach($html->find("a") as $li){
      $url=perfect_url($li->href,$u);
      $enurl=urlencode($url);
      if($url!='' && substr($url,0,4)!="mail" && substr($url,0,4)!="java" && array_key_exists($enurl,$found_urls)==0){
       $found_urls[$enurl]=1;
	   if(strpos($url,"pressemitteilung")== true) {
	   $homepage = url_get_contents($url);
	   $charset = 'utf-8';
	   $bericht = strip_tags($homepage);
	  $content = htmlentities($bericht, ENT_COMPAT, $charset);
	if (strpos_arr($content, $namen) == true) { $abfrage = "SELECT * FROM strassen WHERE id =  '".strpos_arr($content, $namen)."' ";
$ergebnis = mysql_query($abfrage);
while($row = mysql_fetch_object($ergebnis))
   {
echo "".$row->longitude."'<br>'".$row->latitude."'<br>
 '".$row->bezeichnung."'<br>'".$row->bezirk."'<br>";

   } }
	
	       }
      }
     }
    }
} /*
$a = 1;
while($a < 4)
   {
   $a++;
if ($a == 1) {
$ausgabe = ""; } 
elseif ($a == 2){
$ausgabe = "?page_at_1_0=2";}
 else { $ausgabe = "?page_at_1_0=3"; }

  $url = "http://www.berlin.de/polizei/polizeimeldungen/archiv/2014/".$ausgabe."";
  //datei einlesen
  $input = @file_get_contents($url) or die("no access");
  // regulärer ausdruck
  $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
  
    if(preg_match_all("/$regexp/siU", $input, $matches, PREG_SET_ORDER)) {
       foreach($matches as $match) {
	// nur pressmitteilungs-urls
	if(strpos($match[2],"pressemitteilung") == true) {
	 // tld einfügen
     $url = 'http://www.berlin.de'.$match[2];
	 // url zu string
	  $inhalt = htmlentities(strip_tags(url_get_contents($url)), ENT_COMPAT, "utf-8");
	 
	  //init strassennamen-array
	  $namen = array();
	  // strassennamen aus sql-db auslesen
      $query = mysql_query("SELECT bezeichnung FROM strassen WHERE latitude != ''") or die (mysql_error());
      while($row = mysql_fetch_array($query)) { $namen[] = $row['bezeichnung']; }
	   
	       // wenn in $inhalt ein strassennamen aus $namen enthalten ist
	      if (strpos_arr($inhalt, $namen) == true) {
		  echo '<br>'.strpos_arr($inhalt, $namen).'<br>';
		   while($row = mysql_fetch_object(mysql_query("SELECT bezeichnung FROM strassen WHERE id =  '".strpos_arr($inhalt, $namen)."' ")) )
			    {
				//echo $row->bezeichnung.'<br>';	
				}
		  }
	   }
    }
  }
   }

  */
 
?>