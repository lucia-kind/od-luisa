<?php
	require_once("system/data.php");
	require_once("system/security.php");
	require_once("system/functions.php");

    $filterTab = "<script>var filterClosed = false;</script>";
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
?>
    <script>
        function validateForm() {
            var geschlecht = document.forms["myForm"]["geschlecht"].value;
            //var nachname = document.forms["myForm"]["vname"].value;
            var anfang = document.forms["myForm"]["abuchstabe"].value;
            var max = document.forms["myForm"]["maxi"].value;
            var min = document.forms["myForm"]["mini"].value;
            var haufigkeit = document.forms["myForm"]["Haeufigkeit"].value;
            console.log(geschlecht + " " + anfang + " " + max + " " + min + " " + haufigkeit);

            if (geschlecht != "" || anfang != "" || max != "" || min != "" || haufigkeit != "haeufigkeit") {
                alert("ok");
    </script>
    <?php 
    if(isset($_POST['SubmitButton'])){ //check if form was submitted         
        $filterTab = '<script>var filterClosed = true;</script>';
        
        if($_POST['Haeufigkeit'] != 'haeufigkeit') $hauf = $_POST['Haeufigkeit'];
        $anfang = $_POST["abuchstabe"];
        $nachname = $_POST["vname"];
        $max = $_POST["maxi"];
        $min = $_POST["mini"];
        if(isset($_POST["geschlecht"])) {
           $geschlecht = $_POST['geschlecht'];
            }
    }
    $result = update_namelist($type, $hauf, $anfang, $max, $min, $geschlecht);
    ?>
        <script>
            } else {
                alert("Form must be filled out");
            }
        </script>
        <?php


   
    //macht die Abfrage über die Datenbank

?>
            <!DOCTYPE html>
            <html>

            <head>

                <title>Luisa - Die Namensapp</title>

                <!-- Meta Information -->
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

                <!-- CSS -->
                <link rel="stylesheet" href="css/style.css">
                <link rel="stylesheet" type="text/css" href="css/filterSlide.css">

                <!-- SCRIPT -->
                <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>

                <!-- FONT -->
                <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
                <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>

                <script>
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
                            
                $firstloop = true; 
                
                            
                while ($dog = mysqli_fetch_assoc($result)) { 
                    if($firstloop) { 
                            // falls name ungleich schon gesehene namen
                            ?>
                                        <div id="<?php echo $dog['id']?>" class="dogname visible">
                                            <?php $firstloop = false; ?>
                                                <?php  } else{ 
                                    // falls name ungleich schon gesehene namen
                                    ?>
                                                    <div id="<?php echo $dog['id']?>" class="dogname invisible">
                                                        <?php  }  
                        array_push($array, $dog['name']);
                            //und im Array gespeichert
                                   echo $dog['name'];
                             //wird angezeigt
                        ?>
                                                    </div>
                                                    <!-- ! div für entweder visible oder invisible -->
                                                    <?php }
                                        
                                        ?>
                                                        <?php echo $nachname;?>

                                </ul>
                                </div>
                                <!-- container -->
                            </div>
                            <!-- demo -->
                        </div>
                        <!-- name_tinder -->

                        <div class="count">
                            <span id="aktuell"></span> /
                            <?php echo count($array)?>
                        </div>

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
                            <div class="clear"></div>
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
                                        <div class="radio_float">
                                            <input type="radio" name="geschlecht" value="männlich"> <span class="radio">männlich</span>
                                        </div>
                                        
                                        <div class="radio_float">
                                        <input type="radio" name="geschlecht" value="weiblich"><span class="radio">weiblich</span>
                                        </div>
                                        
                                        <div class="clear"></div>
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
                                        <input class="newsClose" id="filtersubmit" style=" width: 100px; height: 40px; background:url(img/tick.svg);background-repeat: no-repeat;" type="submit" onclick="validateForm()" name="SubmitButton" value="submit" />
                                    </div>
                                    <!-- filter tickbox -->

                                </div>
                                <!-- section -->

                            </form>
                            <!--FORM ENDE -->

                        </section>
                        <!-- section -->
                    </div>
                    <!-- newsbox-->

                    <script type="text/javascript" src="js/jquery.min.js"></script>
                    <script src="http://malsup.github.com/jquery.form.js"></script>
                    <!-- TINDER CODE-->

                    <script>
                        //der aktuelle Name
                        //achtung, später nur id übergeben
                        var namensArray = <?php echo json_encode($array); ?>;
                        console.log(namensArray);

                        var disliked = [];
                        var liked = [];
                        var clicks = 1;
                        document.getElementById('aktuell').innerHTML = clicks;

                        //Tinderfunktionen
                        function like() { //parameter übergeben
                            liked.push(namensArray[0]);
                            namensArray.shift();

                            console.log("liked:" + liked);
                            //nächster Name
                            $("div.container div.invisible").first().addClass("visible").removeClass("invisible");
                            $("div.container div.visible").first().addClass("shown").removeClass("visible");
                            clicks = clicks + 1;
                            document.getElementById('aktuell').innerHTML = clicks;
                        }

                        function dislike() {
                            disliked.push(namensArray[0]);
                            namensArray.shift();

                            console.log("disliked:" + disliked);
                            //nächster Name
                            $("div.container div.invisible").first().addClass("visible").removeClass("invisible");
                            $("div.container div.visible").first().addClass("shown").removeClass("visible");
                            clicks = clicks + 1;
                            document.getElementById('aktuell').innerHTML = clicks;

                        }
                        //Tinderfunktionen Ende

                        //übergang zum Duell
                        var typ = "<?php echo $type; ?>";

                        $("#duell_start").click(function () {
                            localStorage.setItem("liked", JSON.stringify(liked));
                            localStorage.setItem("type", typ);
                        });
                        //übergang zum Duell Ende
                    </script>

                    <!--Tinder Ende -->

                    <!-- Filtervariable -->
                    <?php echo $filterTab; ?>

                        <!-- Filter kommt hoch beim laden -->
                        <script>
                            $("#clickme").click(function (e) {
                                e.preventDefault();
                                jQuery('#newsbox').slideDown();
                                // Animation complete.
                            });

                            $(document).ready(function () {
                                if (!filterClosed) {
                                    jQuery('#newsbox').delay(500).slideDown();
                                }

                            });
                        </script>

            </body>

            </html>