<?php
session_start();
if (isset($_GET['empty'])) {
	session_destroy();
	header("location:"."buy.php");
}
?>
<html>
<head><title>Buy Products</title></head>
<body>
<p>Shopping Basket:</p>
<?php
$sum=0;
$k=array();
$temparray=array();
//Stores the product into the shopping cart
if(!isset($_SESSION['tempcart'])){
	$_SESSION['tempcart']= array();
}
if(isset($_GET['buy'])){
		foreach ($_SESSION['info'] as $key => $value) {
			if($_GET['buy']===$value[0])
				array_push($_SESSION['tempcart'],$value);
		}
}
//eliminate duplicate products
foreach($_SESSION['tempcart'] as $tempitem)
{
	if(!in_array($tempitem[0],$k))
	{
		$k[]=$tempitem[0];
    $temparray[]=$tempitem;
	}
}
$_SESSION['tempcart']=$temparray;
//deletes the selected product from the shopping cart
if(isset($_GET['delete'])){
	foreach ($_SESSION['tempcart'] as $key => $value) {
			if (in_array($_GET['delete'], $value)){
				unset($_SESSION['tempcart'][$key]);
		}
	}
}
//display the shopping cart
echo "<table border='1'>";
	foreach ($_SESSION['tempcart'] as $iteminfo) {
			echo "<tr>";
			echo "<td><a href=".$iteminfo[5]."><img src=".$iteminfo[1]."></td>";
			echo "<td>".$iteminfo[2]."</td>";
			echo "<td>".$iteminfo[3]."</td>";
			echo "<td><a href=buy.php?delete=".$iteminfo[0].">delete</a></td>";
			echo "</tr>";
			$sum=$sum+$iteminfo[3];
	}
echo "<table border='1'>";
?>
<p/>
Total: <?php echo "$".$sum ?><p/>
<form action="buy.php" method="GET">
<input type="submit" name="empty" value="Empty Basket"/>
</form>
<p/>
<form action="buy.php" method="GET">
<fieldset><legend>Find products:</legend>
<label>Category:<select name="category">
  <?php
  error_reporting(E_ALL);
  ini_set('display_errors','On');
  $xmlstr = file_get_contents('http://sandbox.api.ebaycommercenetwork.com/publisher/3.0/rest/CategoryTree?apiKey=78b0db8a-0ee1-4939-a2f9-d3cd95ec0fcc&visitorUserAgent&visitorIPAddress&trackingId=7000610&categoryId=0&showAllDescendants=true');
  $xml = new SimpleXMLElement($xmlstr);
  $a= $xml->category->categories->category;
  foreach($a as  $b) {
      print "<option value='{$b['id']}'>$b->name</option>";
      echo "<optgroup label='$b->name'>";
      if (isset($b->categories->category)) {
       foreach($b->categories->category as $d){
        echo "<option value='{$d['id']}'>$d->name</option>";
        if (isset($d->categories->category)) {
         echo "<optgroup label='$d->name'>";
        foreach($d->categories->category as $f){
         echo "<option value='{$f['id']}'>$f->name</option>";
       }
       echo  "</optgroup>";
       }
     }
   }
    echo  "</optgroup>";
  }
  ?>
</select></label>
<label>Search for items: <input type="text" name="search"/><label>
<input type="submit" name="Submit" value="Search"/>
</fieldset>
</form>
<p/>
<?php
if(isset($_GET['search']))
  {
    error_reporting(E_ALL);
    ini_set('display_errors','On');
    $xmlstr = file_get_contents('http://sandbox.api.shopping.com/publisher/3.0/rest/GeneralSearch?apiKey=78b0db8a-0ee1-4939-a2f9-d3cd95ec0fcc&visitorUserAgent&visitorIPAddress&trackingId=7000610&categoryId='.$_GET['category'].'&keyword='.$_GET['search'].'&numItems=20');
    $xml = new SimpleXMLElement($xmlstr);
    $_SESSION['info']=array();
    $start=$xml->categories->category->items->product;
    if($xml){
      {
        $temp;
        foreach ($start as $dis)
        {
           $temp = array();
          $image_link=(string)$dis->images->image->sourceURL;
          $pro_name=(string)$dis->name;
          $pro_price=(string)$dis->minPrice;
          $pro_des=(string)$dis->fullDescription;
          $pro_id=(string)$dis['id'];
					$pro_offer=(string)$dis->productOffersURL;
          array_push($temp,$pro_id,$image_link,$pro_name,$pro_price,$pro_des,$pro_offer);
          array_push($_SESSION['info'],$temp);
        }
      }
    }
    echo "<table border='1'>";
			foreach ($_SESSION['info'] as $sess) {
					echo "<tr>";
					echo "<td><a href=buy.php?buy=".$sess[0]."><img src=".$sess[1]."></td>";
					echo "<td>".$sess[2]."</td>";
          echo "<td>".$sess[3]."</td>";
          echo "<td>".$sess[4]."</td>";
					echo "</tr>";
			}
		echo "<table border='1'>";
}
?>
</body>
</html>
