<?php
	require_once("system/data.php");
	require_once("system/security.php");

    $result = get_dogs_name();
?>

<!DOCTYPE html>
<html>
<head>

<<<<<<< Updated upstream
  <title>Hundenamen</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="css/style.css">
=======
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

        <head>
            <title>Hundenamen</title>
>>>>>>> Stashed changes

            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
            <link rel="stylesheet" href="css/style.css">

            <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>

<<<<<<< Updated upstream
    
    
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
    
        <pre>
            <?php $newVar = json_encode($newVar); ?>            
        </pre>    
    
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/dragend.js"></script>

  <script>
      
    //var names = <?php echo $newVar ?>;
    //nur id übergeben? als klasse? oder id?!
      var names = [];
      
    function onSwipe () {
        if(Right) {
            names.push('gewswipter Name');            
        }
        //ul li delete gswipter name
    }
      
    function onSubmit () {
        form.hiddenName.value = names;
    }
      
    
    //localStorage.setItem("names", names);
    
    console.log(names);

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
=======
        </head>

        <body>



            <div id="demo">
                <ul>
                    <?php while ($dog = mysqli_fetch_assoc($result)) { ?>


                        <? $newVar[] = $dog['hundename']; ?>

                            <li class="dragend-page">
                                <p id="<?php echo $dog['id']?>">
                                    <?php echo $dog['hundename']; ?>
                                </p>
                                <p>0.01% in Z&uuml;rich</p>
                                <p>99 Herzen</p>
                                <p>1/19</p>
                            </li>
                            <? } ?>
                </ul>

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
>>>>>>> Stashed changes
