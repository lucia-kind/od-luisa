<?php
	require_once("system/data.php");
	require_once("system/security.php");
?>
    
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>Luisa - die Namensapp</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Path to Framework7 Library CSS-->
    <link rel="stylesheet" href="css/framework7.ios.min.css">
    <!-- Path to your custom app styles-->
    <link rel="stylesheet" href="css/my-app.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
      
    <script>
        var duell = localStorage.getItem('liked');
        var duell_array = JSON.parse(duell);
        console.log(duell_array);
        console.log(duell_array.length);
        $(document).ready(function () {
            var i = 0;
            var laenge = duell_array.length - 2;
            document.getElementById('name01').innerHTML = duell_array.shift();
            document.getElementById('name02').innerHTML = duell_array.shift();

            document.getElementById('name01').onclick = function () {
                if (i < laenge) {
                    document.getElementById('name02').innerHTML = duell_array.shift();
                    i++;
                } else {
                    console.log("Halt! Du bist zu weit gegangen.");
                }
            }
            document.getElementById('name02').onclick = function () {
                if (i < laenge) {
                    document.getElementById('name01').innerHTML = duell_array.shift();
                    i++;
                } else {
                    console.log("Halt! Du bist zu weit gegangen.");
                }

            }
        });
    </script>
      
  </head>
<body>
<!-- On right side -->
    <div class="navbar">
        <div class="navbar-inner">
            <div class="left">Zwischenstand</div>
       </div> <!-- navbar-inner -->
    </div> <!-- navbar -->
<div class="list-block">
  <ul>
    <!-- one element -->
    <li class="swipeout">
      <div class="swipeout-content item-content duell_bg">
        <div id="name01" class="item-media">Duell noch 2 Tage</div>
      </div>
      <div class="swipeout-actions-right">
        <!-- Add this button and item will be deleted automatically -->
        <a style="color:black; background-color:#D7FFF8;" href="#" class="action1">teilen</a>
      </div>
    </li>
    <li class="swipeout">
      <div class="swipeout-content item-content">
        <div class="item-media">Luisa</div>
    <div class="item-after"><span class="badge bg-green">5</span></div>
      </div>
    </li>
    <li class="swipeout">
      <div class="swipeout-content item-content">
        <div class="item-media">Lilly-Rosé </div>
    <div class="item-after"><span class="badge bg-green">5</span></div>
      </div>
    </li>
    <li class="swipeout">
      <div class="swipeout-content item-content">
        <div class="item-media">Valentina </div>
    <div class="item-after"><span class="badge bg-green">5</span></div>
      </div>
    </li>
    <li class="swipeout">
      <div class="swipeout-content item-content">
        <div class="item-media">Nymeria </div>
    <div class="item-after"><span class="badge bg-green">5</span></div>
      </div>
    </li>
    <li class="swipeout">
      <div class="swipeout-content item-content">
        <div class="item-media">Mischelle</div>
    <div class="item-after"><span class="badge bg-green">5</span></div>
      </div>
    </li>
    <li class="swipeout">
      <div class="swipeout-content item-content">
        <div class="item-media">Aline </div>
    <div class="item-after"><span class="badge bg-green">5</span></div>
      </div>
    </li>
    <li class="swipeout">
      <div class="swipeout-content item-content">
        <div class="item-media">Isabelle </div>
    <div class="item-after"><span class="badge bg-green">5</span></div>
      </div>
    </li>
    <li class="swipeout">
      <div class="swipeout-content item-content">
        <div class="item-media">Lucia</div>
    <div class="item-after"><span class="badge bg-green">5</span></div>
      </div>
    </li>
  </ul>
</div>
    <script>
    var myApp = new Framework7();
    var $$ = Dom7;

    $$('.action1').on('click', function () {
      myApp.alert('Action 1');
    });
    $$('.action2').on('click', function () {
      myApp.alert('Action 2');
    });  

    </script>
    <!-- Path to Framework7 Library JS-->
    <script type="text/javascript" src="js/framework7.min.js"></script>
    <!-- Path to your app js-->
    <script type="text/javascript" src="js/my-app.js"></script>

</body>
</html>