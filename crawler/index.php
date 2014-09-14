<?php
include("functions.php");
$loeschen = "DELETE FROM data";
$loesch = mysql_query($loeschen);

set_time_limit(900);
ini_set('memory_limit', '1024M');




$namen = array();
$query = mysql_query("SELECT bezeichnung FROM strassen WHERE latitude != ''") or die (mysql_error());
while($row = mysql_fetch_array($query))
{
   $namen[] = $row['bezeichnung']; 
}
$array_count = count($namen);

$u = "http://www.berlin.de/polizei/polizeimeldungen/archiv/2014/";
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
$eintrag = "INSERT INTO data
(longitude, latitide, strasse, bezirk, anzahl, url)
VALUES
('".$row->longitude."', '".$row->latitude."',
 '".$row->bezeichnung."', '".$row->bezirk."', '1', '".$url."')";

$eintragen = mysql_query($eintrag); 
   } }
	
	       }
      }
     }
    }

$u = "http://www.berlin.de/polizei/polizeimeldungen/archiv/2014/?page_at_1_0=2";
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
$eintrag = "INSERT INTO data
(longitude, latitide, strasse, bezirk, anzahl, url)
VALUES
('".$row->longitude."', '".$row->latitude."', '".$row->bezeichnung."', '".$row->bezirk."', '1', '".$url."')";

$eintragen = mysql_query($eintrag); 
   } }
	
	       }
      }
     }
    }
	

	
$u = "http://www.berlin.de/polizei/polizeimeldungen/archiv/2014/?page_at_1_0=3";
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
$eintrag = "INSERT INTO data
(longitude, latitide, strasse, bezirk, anzahl, url)
VALUES
('".$row->longitude."', '".$row->latitude."',
 '".$row->bezeichnung."', '".$row->bezirk."', '1', '".$url."')";

$eintragen = mysql_query($eintrag); 

   } }
	
	       }
      }
     }
    }
	
   ?>