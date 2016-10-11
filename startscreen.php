<?php
	require_once("system/data.php");
	require_once("system/security.php");

    $result = get_dogs_name();
?>

<!DOCTYPE html>
<html>
<head>

  <title>Luisa - Die Namensapp</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="css/style.css">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>

</head>
<body>
    
  <div  class="section">
    <div class="topbar">
        <div class="txt_topbar">Babyname</div>
    </div> <!-- topbar -->
    <div class="name_tinder">
        <div id="demo">
            <ul>
                <?php while ($dog = mysqli_fetch_assoc($result)) { ?>
                  <li class="dragend-page">
                    <p class="name"><?php echo $dog['hundename']; ?></p>
                    <p>0.01% in Z&uuml;rich</p>
                    <p>99 Herzen</p>
                    <p>1/19</p>
                  </li>
                <? } ?>
            </ul>
        </div> <!-- demo -->
    </div> <!-- name_tinder -->
    <div class="hearts">
        <div class="bheart"><img src="img/bheart.png"/></div>
        <div class="bheart"><img src="img/heart.png"/></div>
        <div class="clear"></div>
    </div> <!-- hearts -->
    <div class="menu">
        <div class="duell"><a href="registrieren.php">Duell!</a></div>
        <div class="einstellungen"><a href="filter.php">Einstellungen</a>     </div>
        <div class="clear"></div>
    </div> <!-- menu -->
  </div> <!-- section --> 
    
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/dragend.js"></script>

  <script>

    $(function() {
      new Dragend($("#demo").get(0), {
        afterInitialize: function() {
          $("#demo").css("visibility", "visible");
        }
      });
    });

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-219062-10']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

  </script>

</body>
</html>