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

            </div>
            <button type="button" id="button">click me </button>
            <!--invisible versuch ende-->
            <button onclick="like();">LIKE</button>
            <button onclick="dislike();">DISLIKE</button>

        </div>

        <pre>
            <?php
               print_r($array);?><!--letzter?-->
             <!--damit js das lesen kann-->  
        </pre>

        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/onSwipe.js"></script>
        <script type="text/javascript" src="js/load.js"></script>

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

    </body>

    </html>