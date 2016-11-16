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
      
  </head>
<body>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="left">Duelle</div>
       </div> <!-- navbar-inner -->
    </div> <!-- navbar -->
    
    <div class="list_container">
        <div class="list-block">
          <ul>
            
            <!-- one element -->
            <li class="swipeout">
              <div class="swipeout-content item-content">
                <div class="item-media">Fam. Kreisch in Baby</div>
            <div class="item-after"><span class="badge bg-green">5</span></div>
              </div>
              <div class="swipeout-actions-right">
                <!-- Add this button and item will be deleted automatically -->
                <a href="#" class="swipeout-delete">
                    <img class="trash" src="img/trash.svg">
                </a>
                 <a class="share" href="#">teilen</a>
              </div>
            </li>
              
            <!-- one element -->
            <li class="swipeout">
              <div class="swipeout-content item-content">
                <div class="item-media">Fam. Kreisch in Baby</div>
            <div class="item-after"><span class="badge bg-green">5</span></div>
              </div>
              <div class="swipeout-actions-right">
                <!-- Add this button and item will be deleted automatically -->
                <a href="#" class="swipeout-delete">
                    <img class="trash" src="img/trash.svg">
                </a>
                 <a class="share" href="#">teilen</a>
              </div>
            </li>

          </ul>
        </div> <!-- list-block -->
    </div> <!-- list_container -->
    
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
    
    <!-- verhindert das die App gedreht werden darf-->
    <script>
            jQuery(function($) {
            $('body').bind('orientationchange', function(e) {
                check_orientation();
            });
                
            check_orientation();
            });
                var check_orientation = function() {
                if(typeof window.orientation == 'undefined') {
                    //not a mobile 
                    return true;
                }
                if(Math.abs(window.orientation) != 0) {
                    //landscape mode
                    $('#orr').fadeIn().bind('touchstart', function(e) {
                        e.preventDefault();
                    });
                    alert("Bitte drehen sie das Gerät");
                    return false;
                }
                else {
                    //portrait mode
                    $('#orr').fadeOut();
                    return true;
                }
            };
    </script>
    <!-- Path to Framework7 Library JS-->
    <script type="text/javascript" src="js/framework7.min.js"></script>
    <!-- Path to your app js-->
    <script type="text/javascript" src="js/my-app.js"></script>
    
    

</body>
</html>
