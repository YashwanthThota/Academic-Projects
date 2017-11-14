// Put your Last.fm API key here
//Name: Naga Sri Rama Yashwanth Thota
//Student ID: 1001507395
var api_key = "c0aafcac6e09ebed17890183f7f53c88";
function sendRequest () {
      var a = setInterval("request1()",1000);
      var b = setInterval("request2()",1000);
      var c = setInterval("request3()",1000);
      var d = setInterval("request4()",1000);
}
function request1() {
    var xhr = new XMLHttpRequest();
    var method = "artist.getinfo";
    var artist = encodeURI(document.getElementById("form-input").value);
    xhr.open("GET", "proxy.php?method="+method+"&artist="+artist+"&api_key="+api_key+"&format=json", true);
    xhr.setRequestHeader("Accept","application/json");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4) {
            var json = JSON.parse(this.responseText);
            var image = json.artist.image[2]['#text'];
            var images='';
            images += '<img style="border:5px double black;" src="' + image + '" />';
            document.getElementById( 'image' ).innerHTML = "<pre>"+ images +"</pre>";
        }
    };
    xhr.send(null);
}
function request2() {
    var xhr = new XMLHttpRequest();
    var method = "artist.getinfo";
    var artist = encodeURI(document.getElementById("form-input").value);
    xhr.open("GET", "proxy.php?method="+method+"&artist="+artist+"&api_key="+api_key+"&format=json", true);
    xhr.setRequestHeader("Accept","application/json");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4) {
            var json = JSON.parse(this.responseText);
            var str='';
            str+="<h2> Artist Name: "+ json.artist.name +"</h2>";
            str+="<h2> Artist URL: "+ json.artist.url +"</h2>";
            str+="<h2> Artist Scrobbles: "+ json.artist.stats.playcount +"<h2>";
            str+="<h2> Artist listeners: "+ json.artist.stats.listeners +"<h2>";
            str+="<h2> Bio:</h2>"
            str+="<h3>  "+ json.artist.bio.content +"</h3>";
            document.getElementById("info").innerHTML = "<pre>" + str + "</pre>";
        }
    };
    xhr.send(null);
}
function request3() {
  var xhr = new XMLHttpRequest();
  var method = "artist.getsimilar";
  var artist = encodeURI(document.getElementById("form-input").value);
  xhr.open("GET", "proxy.php?method="+method+"&artist="+artist+"&api_key="+api_key+"&format=json", true);
  xhr.setRequestHeader("Accept","application/json");
  xhr.onreadystatechange = function () {
      if (this.readyState == 4) {
          var json = JSON.parse(this.responseText);
          var i=0;
          var len=   json.similarartists.artist.length
          var sim = '<h1><u>Similar Artists</u></h1>';
          sim+="<ul>"
          while( i<len ) {
            sim+="<li>  "+ json.similarartists.artist[i]['name']+"</li>";
            i++;
          }
          sim+="</ul>"
          document.getElementById("similar").innerHTML = "<pre>" + sim + "</pre>";
      }
  };
  xhr.send(null);
}
function request4() {
    var xhr = new XMLHttpRequest();
    var method = "artist.gettopalbums";
    var artist = encodeURI(document.getElementById("form-input").value);
    xhr.open("GET", "proxy.php?method="+method+"&artist="+artist+"&api_key="+api_key+"&format=json", true);
    xhr.setRequestHeader("Accept","application/json");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4) {
            var json = JSON.parse(this.responseText);
            var j=0;
            var images='';
            var image;
            var len=json.topalbums.album.length
            var sim = '<h1><u>Titles & Pictures</u></h1>';
            while( j<len ) {
              image = json.topalbums.album[j].image[2]['#text'];
              sim +="<h3> <b>TITLE:</b> "+ json.topalbums.album[j]['name']+ '</br><img style="border:5px double black;" src="' + image + '" /></b>' +"</h3>";
              document.getElementById("gettop").innerHTML = "<pre>" + sim + "</pre>";
              j++;
            }
        }
    };
    xhr.send(null);
}
