for $auction in doc("auction.xml")/site/open_auctions/open_auction
let $auc := $auction/@id/string()
let $per3date := $auction/bidder[personref/@person="person3"]/date
let $per3time := $auction/bidder[personref/@person="person3"]/time
let $per6date := $auction/bidder[personref/@person="person6"]/date
let $per6time := $auction/bidder[personref/@person="person6"]/time

return if($per3date < $per6date)
then {"reserve: ",$auction/reserve/string()}
else if($per3date = $per6date)
then {if($per3time < $per6time)
    then {"reserve: ",$auction/reserve/string()}
    else()
}
else()
