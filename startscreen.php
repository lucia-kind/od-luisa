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
                document.getElementsByClassName('visible')[0].style.color = "blue";
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
                <div class="txt_topbar">Babyname | Typ:
                    <?php print_r($type); ?>
                </div>
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
            </div>
            <!-- menu -->
        </div>
        <!-- section -->
        <!-- STOP FILTER TIME -->
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
                                <input type="submit" name="SubmitButton" />
                                <!--geht nicht ohne-->
                                <input style="padding-top: 5%; height: 35%;" type="image" src="img/tick.png" onclick="window.location.href='/startscreen.php';" />
                            </div>

                        </div>
                        <!-- section -->
                    </form>
                    <!--FORM ENDE -->

                </div>

            </div>


        </section>


        <script type="text/javascript" src="js/jquery.min.js"></script>
        <!-- TINDER CODE-->
        <script>
            //der aktuelle Name
            //achtung, später nur id übergeben
            var namensArray = <?php echo json_encode($array); ?>;
            console.log(namensArray);

            var disliked = [];
            var liked = [];

            //Tinderfunktionen
            function like() { //parameter übergeben
                liked.push(namensArray[0]);
                namensArray.shift();

                console.log("liked:" + liked);
                //nächster Name
                $("div.container div.invisible").first().addClass("visible").removeClass("invisible");
                $("div.container div.visible").first().addClass("shown").removeClass("visible");
                //document.getElementsByClassName('visible')[0].style.color = "blue";
            }

            function dislike() {
                disliked.push(namensArray[0]);
                namensArray.shift();

                console.log("disliked:" + disliked);
                //nächster Name
                $("div.container div.invisible").first().addClass("visible").removeClass("invisible");
                $("div.container div.visible").first().addClass("shown").removeClass("visible");
                //document.getElementsByClassName('visible')[0].style.color = "blue";

            }
            //Tinderfunktionen Ende

            //übergang zum Duell

            $("#duell_start").click(function () {
                localStorage.setItem("liked", JSON.stringify(liked));
            });


            //übergang zum Duell Ende
            console.log("<?php echo $array[0]; ?>"); //der erste name des Arrays
        </script>

        <!--Tinder Ende -->
        <!--filter hoch und runter-->

        <script>
            $(window).scroll(function () {
                $('#examples-cta').each(function () {
                    var imagePos = $(this).offset().top;

                    var topOfWindow = $(window).scrollTop();
                    if (imagePos < topOfWindow + 400) {
                        $(this).addClass("slideUp");
                    }
                });
            });

            /* ENTRANCES */
            $('#slideUpBtn').click(function () {
                $(this).each(function () {
                    $('#object').removeClass();
                    $('#object').addClass("slideUp");
                });
            });
        </script>


    </body>

    </html>