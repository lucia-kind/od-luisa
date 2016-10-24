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
             <div class="container">  
                <ul>
            
                Name:

                <?php 
                  $array = [];//leerer Array für 20 Namen
                while ($dog = mysqli_fetch_assoc($result)) { ?>
                    <!-- hier werden 20 Namen aufgelistet-->
                    <div id="<?php echo $dog['id']?>" class="dogname">
                        <?php $newVar = $dog['hundename'];
                        array_push($array, $dog['hundename']);
                            //und im Array gespeichert
                                   echo $dog['hundename'];
                             //wird angezeigt
                        ?>

                    </div>
                    <?php } 
                        ?>
                </ul>

       
            <button type="button" id="button">click me </button>
            <!--invisible versuch ende-->
            <button onclick="like();">LIKE</button>
            <button onclick="dislike();">DISLIKE</button>

        
         
             </div> <!-- container -->
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
    
        <pre>
            <?php
               print_r($array);?><!--letzter?-->
             <!--damit js das lesen kann-->  
        </pre>
    
<!-- STOP FILTER TIME --> 
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

        

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/onSwipe.js"></script>
    <script type="text/javascript" src="js/load.js"></script>
        
    <!-- Isa CODE-->
            <script>
            //der aktuelle Name
            //achtung, später nur id übergeben

            var disliked = [];
            var liked = [];

            //Tinderfunktionen
            function like() {
                liked.push("<?php echo array_shift($array); ?>");
                //wendet es so oder so an? why?
                console.log("liked:" + liked);
            }

            function dislike() {
                disliked.push("<?php echo array_shift($array); ?>");
                //wendet es so oder so an? why?
                console.log("disliked:" + disliked);

            }
            //Tinderfunktionen Ende

            //übergang zum Duell

            function onSubmit() { //Wenn auf Duell gewechselt wird
                form.hiddenName.value = names;
            }

            //localStorage.setItem("names", names);
            //speichere aktuelle Namen
            //console.log(names);

            //übergang zum Duell Ende
            console.log("<?php echo $array[0]; ?>"); //der erste name des Arrays
        </script>
        <script>
            //hier wird das Tinder initiert bzw nur ein name angezeigt
            $(document).ready(function () {
                // mache alle unsichtbar ausser das erste
                $('.dogname').not(':first').addClass("invisible");
                //gibt dem ersten die class visible
                $('.dogname').first().addClass("visible");
                //spreche den angezeigten über klasse namen an
                document.getElementsByClassName('visible')[0].style.color = "blue";
            });

            //zeige den nächsten namen in der Liste an
            $(function () {
                $("#button").click(function () {
                    $("div.container div.invisible").first().addClass("visible").removeClass("invisible");
                    $("div.container div.visible").first().addClass("shown").removeClass("visible");

                });
            });
        </script>
    
    
    <!-- Slide Einstellungen / Filter -->
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