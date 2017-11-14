//Student Name: Naga Sri Rama Yashwanth Thota
//Student ID:1001507395
var myVarx;
var myVary;
var x =Math.floor(Math.random()*250)+10;
var movex=0;
var movey=0;
var y= 10;
var temp=0;
var control;
//adjust the speeds during the gameplay
function setSpeed(speed){
  if(speed==0&&control==1)
  {
    clear();
    Interval(10);
  }
  if(speed==1&&control==1)
  {
    clear();
    Interval(5);
  }
  if(speed==2&&control==1)
  {
    clear();
    Interval(1);
  }
}
//resets the game
function resetGame(){
  clear();
  y = 0;
  count = 0;
  temp=0;
  document.getElementById("1").checked = true;
  document.getElementById('ball').style.left= 0;
  document.getElementById('strikes').innerHTML=count;
  document.getElementById('score').innerHTML=0;
}
function Interval(sp){
  myVarx =setInterval(Xaxis,sp);
  myVary = setInterval(Yaxis,sp);
}
//starts the game
function startGame(){
  var a = document.getElementById("1").checked;
  var b = document.getElementById("2").checked;
  var c = document.getElementById("3").checked;
  control=1;
  //start the game with different speeds
  if(a==true)
  {
    clear();
    Interval(10);
  }
  if(b==true)
  {
    clear();
    Interval(5);
  }
  if(c==true)
  {
    clear();
    Interval(1);
  }
   count=0;
   document.getElementById('strikes').innerHTML=count;
}
//moves the ball in vertical direction
 function Xaxis() {
 if((x == -80) || (movex == 0)){
   document.getElementById('ball').style.top= x +"px";
   x = x + 1;
   movex=0;
 }
 if((x == 400) || (movex==1)) {
  document.getElementById('ball').style.top= x +"px";
  x=x-1;
  movex=1;
 }
 }
 //moves the ball in horizontal direction
 function Yaxis() {
 if((y == 0)|| (movey == 0)){
   document.getElementById('ball').style.left= y +"px";
   y = y + 2;
   movey=0;
 }
 var top=parseInt(document.getElementById('ball').style.top);
 var k=parseInt(document.getElementById('paddle').style.top) + 35;
 var t=parseInt(document.getElementById('paddle').style.top) - 105;
 if((y == 750)&&(top>t)&&(top<k)|| (movey == 1))
  {
    if((y == 750)&&(parseInt(top)>t)&&(top<k))
    {
      count=count+1;
      document.getElementById('strikes').innerHTML=count;
    }
    document.getElementById('ball').style.left= y +"px";
    y = y - 2;
    movey=1;
  }
 if(y == 800)
 {
   clear();
   y = 0;
   maxscore(count);
   control=0;
 }
 }
 //moves the paddle
 function movePaddle(e)
 {
  Ymouse =  e.clientY ;
   if (Ymouse < 400){
     document.getElementById('paddle').style.top= Ymouse + "px";
   }
 }
 //sets the high score
 function maxscore(v){
   if(v>temp){
   document.getElementById('score').innerHTML=v;
   temp=v;
 }
 }
 //clear the interval
 function clear(){
   clearTimeout(myVarx);
   clearTimeout(myVary);
 }
