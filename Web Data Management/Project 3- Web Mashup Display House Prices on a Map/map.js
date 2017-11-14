//Name: Naga Sri Rama Yashwanth Thota
//StudentID: 1001507395
var zwsid = "X1-ZWz1g1ogfhhv63_adn99";
var request = new XMLHttpRequest();
var test;
var revg;
var marker = [];
var value;
var li;
var address;
var infowindow;
var map;
var geocoder;
var his="<h2> history log </h2>";
function initialize () {
   map = new google.maps.Map(document.getElementById('googleMap'), {
          zoom: 17,
          center: {lat: 32.75, lng: -97.13}
        });
        test=0;
          google.maps.event.addListener(map, 'click', function (e) {
            if(test==1)
            {
              clearMarkers();
              test=0;
            }
            test++;
         document.getElementById("address").value= e.latLng.lat()+" "+e.latLng.lng();
         revgeocodeAddress(geocoder, map)
         });

         geocoder = new google.maps.Geocoder();
        document.getElementById('submit').addEventListener('click', function() {
          if(test==1)
          {
            clearMarkers();
            test=0;
          }
          test++;
        });
}
function clearMarkers() {
marker.setMap(null);
}
function revgeocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            document.getElementById("address").value= results[0].formatted_address;
            sendRequest ();
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
function geocodeAddress(geocoder, resultsMap) {
        var address = document.getElementById('address').value;
        console.log(address);
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            li = "<label>"+results[0].formatted_address+" cost: no zestimate value "+"</label>"
            if(value>0.001)
            {
              li="<label>"+results[0].formatted_address +" cost: $"+ value +"</label>"
              value=0;
            }
            his+= li+"</br>";
            document.getElementById("historylog").innerHTML = his;
             infowindow = new google.maps.InfoWindow({
            content: li
            });
             marker = new google.maps.Marker({
              map: resultsMap,
              position: results[0].geometry.location
            });
              infowindow.open(resultsMap, marker);

          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
function displayResult () {
    if (request.readyState == 4) {
      geocodeAddress(geocoder, map);
        document.getElementById("output").innerHTML = "<label> <label>";
        var xml = request.responseXML.documentElement;
        value = xml.getElementsByTagName("zestimate")[0].getElementsByTagName("amount")[0].innerHTML;
        if (value>0.001)
        {
	      document.getElementById("output").innerHTML = "<label>"+ " the value of the house is: $"+ value+"<label>";
      }
    }
}
function sendRequest () {
    request.onreadystatechange = displayResult;
    address = document.getElementById("address").value;
    var streetaddress= address.substr(0,address.indexOf(' '));
    var cit= address.substr(address.indexOf(' ')+1);
    request.open("GET","proxy.php?zws-id="+zwsid+"&address="+streetaddress+"&citystatezip="+cit);
    request.withCredentials = "true";
    request.send(null);
}
function fire () {
  document.getElementById("address").value="";
}
