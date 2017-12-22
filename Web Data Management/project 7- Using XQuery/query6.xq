for $x in doc("auction.xml")/site/regions//europe/item
let $y := $x/@id/string()
for $a in doc("auction.xml")/site/closed_auctions/closed_auction
let $b := $a/itemref/@item/string()
let $z := doc("auction.xml")/site/people/person
for $c in $b
where $y = $b
let $perno := $a/buyer/@person/string()
let $itemname := $x[@id = $y]/name/string()
let $personname := $z[@id = $perno]/name/string()
return {"NAME:",$personname,"    NAME OF THE ITEM BOUGHT IN EUROPE:",$itemname,"&#xa;"}
