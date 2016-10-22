<?php
	require_once("system/data.php");
	require_once("system/security.php");

    $result = get_dogs_name();
    //$row = mysqli_fetch_row ($result);
    
?>
    <!DOCTYPE html>
    <html>

    <head>

        <title>Hundenamen</title>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="css/style.css">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>

    </head>

    <body>

        <div id="demo2">
            <!--versuch mit invisible-->
            <div class="container">

                Name:

                <?php while ($dog = mysqli_fetch_assoc($result)) { ?>
                    <!--                   hier werden 20 Namen aufgelistet-->
                    <div id="<?php echo $dog['id']?>" class="dogname">

                        <?php echo $dog['hundename'];
                        $newVar = $dog['hundename'];
                        ?>

                    </div>
                    <?php } 
                        ?>


            </div>
            <button type="button" id="button">click me </button>
            <!--invisible versuch ende-->
            <button onclick="like()">LIKE</button>
            <button onclick="dislike()">DISLIKE</button>

        </div>

        <pre>
            <?php $newVar = json_encode($newVar);?> <!--damit js das lesen kann-->  
        </pre>

        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/onSwipe.js"></script>
        <script type="text/javascript" src="js/load.js"></script>

        <script>
            var names = <?php echo $newVar ?>; //der aktuelle Name
            //achtung, später nur id übergeben

            var disliked = [];
            var liked = [];
            var gezeigt = [];


            function like() {
                liked.push('<?php echo $newVar ?>');
                gezeigt.push('<?php echo $newVar ?>');
                console.log(liked);
            }

            function dislike() {
                disliked.push('<?php echo $newVar ?>');
                gezeigt.push('<?php echo $newVar ?>');
                console.log(disliked);

            }

            function onSwipe() {
                if (Right) {
                    names.push('gewswipter Name');
                }
                //ul li delete gswipter name
            }

            function onSubmit() { //Wenn auf Duell gewechselt wird
                form.hiddenName.value = names;
            }

            localStorage.setItem("names", names); //speichere aktuelle Namen
            console.log(names);
        </script>
        <script>
            $(document).ready(function () {

                // mache alle unsichtbar ausser das erste
                $('.dogname').not(':first').addClass("invisible");
                $('.dogname').first().addClass("visible"); //gibt dem ersten die class visible

            });

            $(function () { //zeige den nächsten namen in der Liste an
                $("#button").click(function () {
                    $("div.container div.invisible").first().addClass("visible").removeClass("invisible");
                    $("div.container div.visible").first().addClass("shown").removeClass("visible");
                });
            });

            //name speichern für später
            $(document).ready(function () {
                document.getElementsByClassName('.visible').style.color = "blue"; //greift nicht, wieso?
                console.log("aktueller Name:" + aktuellerName);
            });
        </script>

    </body>

    </html>