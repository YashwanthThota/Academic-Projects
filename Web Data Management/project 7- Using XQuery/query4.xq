for $p in doc("auction.xml")/site/people/person
let $name := $p/name
let $catnumber  := $p/profile/interest/@category/string()
for $catid in doc("auction.xml")/site/categories/category
let $temp := $catid/@id/string()

for $d in $temp
where $catnumber = $d
return {"NAME: ",$name/string()," CATEGORY:", $catid/name/string(),"&#xa;"}
