<?php
	require_once("system/data.php");
	require_once("system/security.php");
	require_once("system/functions.php");

    //$result = get_dogs_name();
    $result= update_namelist($type, $hauf, $anfang, $max, $min, $geschlecht);
    //macht die Abfrage über die Datenbank

?>
    <!DOCTYPE html>
    <html>

    <head>

        <title>Luisa - Die Namensapp</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/animations.css">
         <link rel="stylesheet" href="css/SlideUp.css">

        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>

        <script>
            //hier wird das Tinder initiert bzw nur ein name angezeigt
            //muss am Anfang stehen
            $(document).ready(function () {
                // mache alle unsichtbar ausser das erste
                $('.dogname').not(':first').addClass("invisible");
                //gibt dem ersten die class visible
                $('.dogname').first().addClass("visible");
                //spreche den angezeigten über klasse namen an
            });


            //Variablen definieren
            var haufen;
            var nachname;
            var max;
            var min;
            var anfang;
            var geschlecht;

            //<!-- test post form-->

            var haufen = <?php echo json_encode($hauf); ?>;
            var nachname = <?php echo json_encode($nachname); ?>;
            var max = <?php echo json_encode($max); ?>;
            var min = <?php echo json_encode($min); ?>;
            var anfang = <?php echo json_encode($anfang); ?>;
            var geschlecht = <?php echo json_encode($geschlecht); ?>;
            var type = <?php echo json_encode($type); ?>;
            console.log("Häufigkeit: " + haufen + "min: " + min + "max: " + max + "anfang:" + anfang + "nachname: " + nachname + "geschlecht:" + geschlecht + "typ:" + type);
        </script>

    </head>

    <body>

        <div class="section">
            <div class="topbar">

                <div class="txt_topbar">
                    <?php if($type == "baby"){
                echo "Babyname";
                } else if($type == "hund"){
                echo "Hundename";
                } ?>


                </div>
                <!--txt_topbar-->
            </div>
            <!-- topbar -->


            <div class="name_tinder">
                <div id="demo slider">
                    <div class="container">
                        <ul>
                            <?php 
                  $array = [];//leerer Array für Namen
                              //<!-- hier werden X Namen aufgelistet-->
                            
                while ($dog = mysqli_fetch_assoc($result)) { ?>

                                <div id="<?php echo $dog['id']?>" class="dogname">
                                    <?php
                        array_push($array, $dog['name']);
                            //und im Array gespeichert
                                   echo $dog['name'];
                             //wird angezeigt
                        ?>

                                </div>
                                <?php } ?>
                                    <?php echo $nachname;?>
                        </ul>
                    </div>
                    <!-- container -->
                </div>
                <!-- demo -->
            </div>
            <!-- name_tinder -->
            <div class="hearts">
                <!--<button type="button" id="button">click me </button>-->
                <!--invisible versuch ende-->
                <div class="bheart">
                    <input type="image" src="img/heart.png" onclick="like();" />
                </div>
                <div class="bheart">
                    <input type="image" src="img/bheart.png" onclick="dislike();" />
                </div>
                <div class="clear"></div>
            </div>
            <!-- hearts -->

            <div class="menu">
                <div id="duell_start" class="duell"><a href="registrieren.php">Duell!</a></div>

                <section id="actions">

                    <div class="container einstellungen">
                        <a href="#" id="slideUpBtn" class="button">Einstellungen</a>
                    </div>

                </section>
                <!-- actions -->
            </div>
            <!-- menu -->
        </div>
        <!-- section -->

        <div id="newsbox">
            <div class="news-text">
            <div class="lol">lmao</div>
            <section id="animation">
            <div class="animation-container">
                <div id="object" class="animate tossing">
                    <!--FORMULAR ANFANG-->
                    <form method="post">

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
                                <input type="radio" name="geschlecht" value="männlich">männlich
                                <input type="radio" name="geschlecht" value="weiblich">weiblich
                            </div>

                            <div class="formline">
                                Maximal
                                <input type="text" placeholder="x" id="minimaxi" name="maxi"> Zeichen
                            </div>

                            <div class="formline">
                                Minimal
                                <input type="text" placeholder="x" id="minimaxi" name="mini"> Zeichen
                            </div>

                            <div class="formline">
                                <select id="dropdown" name="Häufigkeit">
                                    <option value="häufigkeit">Häufigkeit</option>
                                    <option value="sehr beliebt">Sehr beliebt</option>
                                    <option value="beliebt">Beliebt</option>
                                    <option value="selten">Selten</option>
                                </select>
                            </div>

                            <div class="formline">
                            </div>

                            <div class="formline">
                            </div>

                            <div id="filter" class="tickbox">
                                <input style="width: 1000px; height: 100px; background:url(img/tick.png);" type="submit" name="SubmitButton" value="Submit" />
                            </div>
                            <!-- filter tickbox -->
                            <!--geht nicht ohne-->
                            <!-- <input style="padding-top: 5%; height: 35%;" type="image" src="img/tick.png" onclick="window.location.href='/startscreen.php';" /> -->
                        </div>
                        <!-- section -->

                    </form>
                    <!--FORM ENDE -->
                </div>
                <!-- object -->
            </div>
            <!-- animation container -->
        </section>
        <!-- section -->
                            
        </div> <!-- news-text -->
        <div class="news-close"><a href="#" class="newsClose">Close X</a>
        </div>
    
    </body>
        
        <script>
            $(document).ready(function() {
	jQuery('#newsbox').delay(2000).slideDown();
	jQuery('.newsClose').click(function (e) {
		e.preventDefault();
		jQuery('#newsbox').slideUp();
	});	
});	
        </script>
    </html>