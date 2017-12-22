for $x in doc("auction.xml")/site/regions/europe/item
return {"&#xa;","NAME: ",{data($x/name)},"&#xa;","DESCRIPTION: ",{data($x/description)},"&#xa;"}
