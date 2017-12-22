for $x in doc("auction.xml")/site/regions
return {"NUMBER OF ITEMS: ",data (count($x//item))}
