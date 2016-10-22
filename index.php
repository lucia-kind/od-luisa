<?php
	require_once("system/data.php");
	require_once("system/security.php");

    $result = get_dogs_name();
    $row = mysqli_fetch_row ($result);
    
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

        <div id="demo">
            <ul>
                <li class="list">
                    <p id="<?php echo $row['1']?>">
                        <?php echo $row['0']; ?>
                    </p>
                    <p>0.01% in Zürich</p>
                    <p>99 Herzen</p>
                    <p>1/19</p>
                    <p>Test:
                        <br>
                        <!--geht jede Zeile durch-->
                        <? 
                        print_r($row); 
                        print_r(mysqli_fetch_row ($result));
                        ?>
                    </p>
                    <!--like und disklike-->
                    <button onclick="like();">Like</button>
                    <button onclick="dislike();">Dislike</button>
                </li>
            </ul>
            <? $newVar[] = $row['0']; ?>
                <!--speichere den aktuellen Namen-->

                <!--geklaut-->
                <p>Achtung neu</p>
                <div id="results">
                    <div class="result"></div>
                    <div class="result"></div>
                    <div class="result"></div>
                </div>
                <a href="#" id="showMore">Show more</a>
                <!--geklaut Ende-->

                <!--versuch mit invisible-->
                <div class="container">
                    <div class="visible">

                        <?php echo $row['0']; ?>

                    </div>

                    Name:
                    <?php while ($dog = mysqli_fetch_assoc($result)) { ?>
                        <div class="invisible">

                            <?php echo $dog['hundename']; ?>

                        </div>
                        <?php } ?>
                </div>
                <button type="button" id="button">click me </button>
                <!--invisible versuch ende-->
        </div>

<<<<<<< HEAD
  <title>Hundenamen</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="css/style.css">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>

</head>
<body>

    
    
  <div id="demo">
    <ul>
        <?php while ($dog = mysqli_fetch_assoc($result)) { ?>
         
         
         <? $newVar[] = $dog['hundename']; ?>
         
          <li class="dragend-page">
            <p id="<?php echo $dog['id']?>"><?php echo $dog['hundename']; ?></p>
            <p>0.01% in Z&uuml;rich</p>
            <p>99 Herzen</p>
            <p>1/19</p>
          </li>
        <? } ?>
    </ul>

  </div>
    
=======
>>>>>>> origin/master
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
                liked.push('<?php echo $row[0] ?>');
                gezeigt.push('<?php echo $row[0] ?>');
                console.log(liked);
            }

            function dislike() {
                disliked.push('<?php echo $row[0] ?>');
                gezeigt.push('<?php echo $row[0] ?>');
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
            $(function () {
                $("#button").click(function () {
                    $("div.container div.invisible").first().addClass("visible").removeClass("invisible");
                    //$("div.container div.visible").first().addClass("invisible").removeClass("visible");
                });
            });
        </script>

    </body>

    </html>