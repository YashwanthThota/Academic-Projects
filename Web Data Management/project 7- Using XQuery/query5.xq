for $p in doc("auction.xml")/site/people/person
let $name := $p/name
let $catnumber  := $p/profile/interest/@category/string()
for $catid in doc("auction.xml")/site/categories/category
let $temp := $catid/@id/string()

for $d in $temp
where $catnumber = $d
group by $temp
return {"CATEGORY NUMBER:",$temp ," CATEGORY:", $catid/name/string(),":","COUNT: ",count($name),"&#xa;"}
