for $x in doc("auction.xml")/site/regions//item
order by $x/name
return {"NAME:",$x/name/string()," LOCATION:",$x/location/string(),"&#xa;"}
