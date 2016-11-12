<?php
	require_once("system/data.php");
	require_once("system/security.php");
	require_once("system/functions.php");

    //$result = get_dogs_name();
    $hauf ="";
    $anfang="";
    $nachname="";
    $max="";
    $min="";
    $geschlecht="";
     if(isset($_GET["typ"])) {
        $type = $_GET["typ"];
     } else {
         $type = "not defined";
     }

    if(isset($_POST['SubmitButton'])){ //check if form was submitted
        if($_POST['Haeufigkeit'] != 'haeufigkeit') $hauf = $_POST['Haeufigkeit'];//Achtung: wie berechnen wir die?
        //$hauf = $_POST['Haeufigkeit'];
        $anfang = $_POST["abuchstabe"];
        $nachname = $_POST["vname"];//What tun wir damit?
        $max = $_POST["maxi"];
        $min = $_POST["mini"];
        if(isset($_POST["geschlecht"])) {
           $geschlecht = $_POST['geschlecht'];
            }
        //update_namelist($type, $hauf, $anfang, $max, $min, $geschlecht);
    }
    $result = update_namelist($type, $hauf, $anfang, $max, $min, $geschlecht);
    //macht die Abfrage über die Datenbank

?>
    <!DOCTYPE html>
    <html>

    <head>

        <title>Luisa - Die Namensapp</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link rel="stylesheet" href="css/style.css">

        <link rel="stylesheet" type="text/css" href="css/filterSlide.css">

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


            //AJAX FORM
            /*$(document).ready(function () {
                // bind 'myForm' and provide a simple callback function 
                $('#myForm').ajaxForm(function () {
                    alert("Filter angewendet.");
                });
            });*/
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
                    <input style="height: 100px;" type="image" src="img/sheart.svg" onclick="like();" />
                </div>
                <div class="bheart">
                    <input style="height: 100px;" type="image" src="img/sbheart.svg" onclick="dislike();" />
                </div>
                <div class="clear"></div>
            </div>
            <!-- hearts -->

            <div class="menu">
                <div id="duell_start" class="duell">
                    <a href="registrieren.php" class="duell_startscreen_button">Duell!</a>
                </div>
                <!-- duell_start -->

                <div class="einstellungen">
                    <a href="#" id="clickme" class="button"><img style="height: 40px;" src="img/einstellungen.svg"></a>
                </div>

            </div>
            <!-- menu -->
        </div>
        <!-- section -->
        <!-- Ende STARTSCREEN --!>
        

        <!-- STOP FILTER TIME -->
        <div id="newsbox">
            <section id="object">

                <!--FORMULAR ANFANG-->
                <form id="myForm" method="post">
                    <!--action="filter.php"-->

                    <div class="section">

                        <div class="topbar">
                            <div class="txt_topbar">Einstellungen</div>
                        </div>

                        <div class="formline">
                            <input type="text" placeholder="Nachname" id="vname" name="vname">
                        </div>

                        <div class="formline">
                            <input type="text" maxlength="1" placeholder="Anfangsbuchstabe" id="abst" name="abuchstabe">
                        </div>

                        <div class="formline">
                            <input type="radio" name="geschlecht" value="männlich">männlich
                            <input type="radio" name="geschlecht" value="weiblich">weiblich
                        </div>

                        <div class="formline">
                            Maximal
                            <input type="number" placeholder="x" max="20" id="minimaxi" name="maxi"> Zeichen
                        </div>

                        <div class="formline">
                            Minimal
                            <input type="number" max="20" placeholder="x" id="minimaxi" name="mini"> Zeichen
                        </div>

                        <div class="formline">
                            <select id="dropdown" name="Haeufigkeit">
                                <option value="haeufigkeit">Häufigkeit</option>
                                <option value="sehr beliebt">Sehr beliebt</option>
                                <option value="beliebt">Beliebt</option>
                                <option value="selten">Selten</option>
                            </select>
                        </div>

                        <div class="formline">
                        </div>

                        <div class="formline">
                        </div>

                        <div id="filter" style="padding: 10px;" class="tickbox">
                            <input class="newsClose" id="filtersubmit" style=" width: 100px; height: 40px; background:url(img/tick.svg);background-repeat: no-repeat;" type="submit" name="SubmitButton" value="submit" />
                        </div>
                        <!-- filter tickbox -->
                        <!--geht nicht ohne-->
                        <!-- <input style="padding-top: 5%; height: 35%;" type="image" src="img/tick.png" onclick="window.location.href='/startscreen.php';" /> -->
                    </div>
                    <!-- section -->

                </form>
                <!--FORM ENDE -->

            </section>
            <!-- section -->
        </div>

        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script src="http://malsup.github.com/jquery.form.js"></script>
        <!-- TINDER CODE-->
        <?php 
        //like und dislike mit php?
        
        
        ?>

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
                }

                function dislike() {
                    disliked.push(namensArray[0]);
                    namensArray.shift();

                    console.log("disliked:" + disliked);
                    //nächster Name
                    $("div.container div.invisible").first().addClass("visible").removeClass("invisible");
                    $("div.container div.visible").first().addClass("shown").removeClass("visible");

                }
                //Tinderfunktionen Ende

                //übergang zum Duell
                var typ = "<?php echo $type; ?>";

                $("#duell_start").click(function () {
                    localStorage.setItem("liked", JSON.stringify(liked));
                    localStorage.setItem("type", typ);
                });



                //übergang zum Duell Ende
                console.log("<?php echo $array[0]; ?>"); //der erste name des Arrays
            </script>

            <!--Tinder Ende -->

            <!-- Filter kommt hoch beim laden -->
            <script>
                $("#clickme").click(function (e) {
                    e.preventDefault();
                    jQuery('#newsbox').slideDown();
                    // Animation complete.
                });


                $(document).ready(function () {
                    jQuery('#newsbox').delay(2000).slideDown();
                    jQuery('.newsClose').click(function (e) {
                        e.preventDefault();
                        jQuery('#newsbox').slideUp();

                    });
                });
            </script>



    </body>

    </html>