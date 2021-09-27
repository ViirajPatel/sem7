
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>OpenWeatherMap Api</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- <div class="main">
    <div class="header">
      <h1>OpenWeatherMap API</h1>`
      <p>Enter any city name in the input box below to get the data</p>
    </div> -->
  
<?php
$zipcode=388235;

?>
  <div class="container">
    <div class="card">
      <h1 class="name" id="name"></h1>
      <p class="temp" id="temp"></p>
      <p class="clouds"></p>
      <p class="desc"></p>
    </div>
  </div>
<script type="text/javascript">
//var input = 388235;
var main = document.getElementById('name');
var temp = document.getElementById('temp');
// var desc = document.querySelector('.desc');
// var clouds = document.querySelector('.clouds');
// var button= document.querySelector('.submit');
var i;

addEventListener('load', function(name){
fetch('http://api.openweathermap.org/data/2.5/weather?zip=<?=$zipcode?>,in&units=metric&appid=8b684dd4d67c04c51544d0aed2c9ca20')
.then(response => response.json())
.then(data => {
  for(i=1;i<=10;i++)
  {
  var tempValue = data['main']['temp'];
  var nameValue = data['name'];
  var descValue = data['weather'][0]['description'];

  main.innerHTML = nameValue;
  //desc.innerHTML = "Desc - "+descValue;
  temp.innerHTML = "Temp - "+tempValue;
 
  }

})

.catch(err => alert("Wrong city name!"));
})
</script>
</body>
</html>