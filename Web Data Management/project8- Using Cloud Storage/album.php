<?php

// display all errors on the browser
error_reporting(E_ALL);
ini_set('display_errors','On');
require_once 'demo-lib.php';
demo_init(); // this just enables nicer output

// if there are many files in your Dropbox it can take some time, so disable the max. execution time
set_time_limit( 0 );

require_once 'DropboxClient.php';

/** you have to create an app at @see https://www.dropbox.com/developers/apps and enter details below: */
/** @noinspection SpellCheckingInspection */
$dropbox = new DropboxClient( array(
	'app_key' => "ng3a1qkwp10n5md",      // Put your Dropbox API key here
	'app_secret' => "ro913i6vjj551tf",   // Put your Dropbox API secret here
	'app_full_access' => false,
) );


/**
 * Dropbox will redirect the user here
 * @var string $return_url
 */
$return_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_NAME'] . "?auth_redirect=1";

// first, try to load existing access token
$bearer_token = demo_token_load( "bearer" );

if ( $bearer_token ) {
	$dropbox->SetBearerToken( $bearer_token );
	//echo "loaded bearer token: " . json_encode( $bearer_token, JSON_PRETTY_PRINT ) . "\n";
} elseif ( ! empty( $_GET['auth_redirect'] ) ) // are we coming from dropbox's auth page?
{
	// get & store bearer token
	$bearer_token = $dropbox->GetBearerToken( null, $return_url );
	demo_store_token( $bearer_token, "bearer" );
} elseif ( ! $dropbox->IsAuthorized() ) {
	// redirect user to Dropbox auth page
	$auth_url = $dropbox->BuildAuthorizeUrl( $return_url );
	die( "Authentication required. <a href='$auth_url'>Continue.</a>" );
}
?>
<html>
<h3>FILE UPLOAD:</h3>
<form enctype = "multipart/form−data" action = "album.php">
<input type= "hidden" name = "MAX FILE SIZE" value= "3000000" />
Submit this file : <input name= "userfile" type= "file"  /><br/>
<input type= "submit" value= "Send File" method = "GET" />
</form>
<?php
if(isset($_GET['userfile'])) {
   $dropbox->UploadFile($_GET['userfile']);
 }
?>
<?php
if(isset($_GET['delete']))
{
  echo "<h3>image deleted</h3>";
  echo substr($_GET['delete'],1);
  $dropbox->Delete($_GET['delete']);
}
  ?>
<h3>DISPLAY WINDOW:</h3>
<form action="album.php">
<?php
$files = $dropbox->GetFiles("",false);
echo "\n\n<b>Files:</b>\n";
$keys = array_keys( $files);
$i=0;
echo "<table border='1'>";
echo "<tr>";
 echo "<th>Name</th>";
 echo "<th>link</th>";
 echo "<th>delete</th>";
 echo "</tr>";
while($i < count($keys))
{
  echo "<tr>";
   echo "<td>$keys[$i]</td>";
   if ( ! empty( $files ) ) {
     $file = current($files);
    echo '<td><a href="album.php?compna='.$file->path.'">'.$file->path.'</a></td>';
    //echo "<td> <a href=''>$file->path</a></td>";
    next($files);
  }
  echo"<td><button name='delete' type='submit' method='get' value='".$file->path."'>delete</button></td>";
$i = $i + 1;
echo "</tr>";
  }
  echo "<table border='1'>";
?>
</form>
<h3>CURRENT IMAGE:</h3>
<?php
if(isset($_GET['compna'])){
$jpg_files = $dropbox->Search( "/", ".jpg", 5 );
if ( empty( $jpg_files ) ) {
	echo "Nothing found.";
} else {
  $pic = substr($_GET['compna'],1);
	echo "\n\n<b>image of ".$pic.":</b>\n";
  echo "</br>";
	$img_data = base64_encode( $dropbox->GetThumbnail($_GET['compna']) );
	echo "<img src=\"data:image/jpeg;base64,$img_data\" alt=\"Generating PDF thumbnail failed!\" style=\"border: 1px solid black;\" />";
}
}
?>
</html>
