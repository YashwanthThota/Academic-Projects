for $x in doc("auction.xml")/site/regions//item
let $name := $x/name
let $location := $x/location
group by $location
return <country code="{$location}">{
         for $i in $name
         return $i, count($name)}</country>
