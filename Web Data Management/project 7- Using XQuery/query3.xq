for $x in doc("auction.xml")/site/closed_auctions/closed_auction
let $y := $x/buyer/@person/string()
group by $y
let $p := doc("auction.xml")/site/people/person[@id=$y]/name
let $quantity := sum($x/quantity)
return {"NAME: ",$p/string()," QUANTITY:",$quantity,"&#xa;"}
