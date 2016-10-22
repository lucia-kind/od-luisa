<?php
	require_once("system/data.php");
	require_once("system/security.php");

    $result = get_dogs_name();
?>

<!DOCTYPE html>
<html>
<head>

  <title>Luisa - Die Namensapp</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animations.css">
    
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>

</head>
<body>
    
  <div  class="section">
    <div class="topbar">
        <div class="txt_topbar">Babyname</div>
    </div> <!-- topbar -->
    <div class="name_tinder">
        <div id="demo slider">
            <ul>
                <?php while ($dog = mysqli_fetch_assoc($result)) { ?>
                  <li class="dragend-page">
                    <p id="<?php echo $dog['id']?>" class="name"><?php echo $dog['hundename']; ?></p>
                    <p>0.01% in Z&uuml;rich</p>
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
      	<section id="actions">

		<div class="container einstellungen">
			<a href="#" id="slideUpBtn" class="button">Einstellungen</a>
		</div>

	</section>
    </div> <!-- menu -->
  </div> <!-- section --> 
    
    <section id="animation">

		<div class="animation-container">
            <div id="object" class="animate tossing">
                <div class="section">
                    <div class="topbar">
                        <div class="txt_topbar">Einstellungen</div>
                    </div>

                    <div class="formline">
                        <input type="text" placeholder="Nachname" id="vname" name="vname">
                    </div>

                    <div class="formline">
                        <input type="text" placeholder="Anfangsbuchstabe" id="abst" name="abuchstabe">
                    </div>

                    <div class="formline">
                         <input type="checkbox" id="mw" name="alter"> m
                         <input type="checkbox" id="wm" name="alter"> w
                    </div>

                    <div class="formline">
                        Maximal <input type="text" placeholder="x" id="minimaxi" name="maxi"> Zeichen
                    </div>

                    <div class="formline">
                        Minimal <input type="text" placeholder="x" id="minimaxi" name="mini"> Zeichen
                    </div>

                    <div class="formline">

                        <select id="dropdown"name="Häufigkeit">
                            <option value="häufigkeit">Häufigkeit</option>
                            <option value="sehr beliebt">Sehr beliebt</option>
                            <option value="beliebt">Beliebt</option>
                            <option value="selten">Selten</option>
                            <option value="sehr selten">Sehr selten</option>
                        </select>

                    </div>

                    <div class="formline">
                    </div>

                    <div class="formline">
                    </div>

                    <div class="tickbox">
                        <div class="container einstellungen">
                        <a href="#" id="slideDownBtn" class="button">Slide Down &#8595;</a>
                        </div>
                    </div>
                </div> <!-- section -->
            
            </div>
            
		</div>


	</section>

        
        <pre>
            <?php $newVar = json_encode($newVar); ?>
                 
        </pre> 
    
    <script type="text/javascript" src="js/jquery.min.js"></script>
    
    <script>

	$(window).scroll(function() {
		$('#examples-cta').each(function(){
		var imagePos = $(this).offset().top;
		
		var topOfWindow = $(window).scrollTop();
			if (imagePos < topOfWindow+400) {
				$(this).addClass("slideUp, slideDown");
			}
		});
	});

        /* ENTRANCES */
		$('#slideUpBtn').click(function() {
			$(this).each(function(){
					$('#object').removeClass();	
					$('#object').addClass("slideUp");
				});
		});
        
        $('#slideDownBtn').click(function() {
			$(this).each(function(){
					$('#object').removeClass();				
					$('#object').addClass("slideDown");
				});
		});	
</script>


</body>
</html>