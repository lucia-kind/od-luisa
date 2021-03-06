<?php
	require_once("system/data.php");
	require_once("system/security.php");
?>

    <!DOCTYPE html>
    <html>

    <head>
        <title>Luisa - Die Namensapp</title>
         <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="css/style.css">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>


    </head>

    <body>
        <div id="orr"></div>
        <div class="section">
            <div class="topbar">
                <div class="txt_topbar">Ich suche einen...</div>
            </div>
            <div id="baby" class="select_babyname" onclick="hidden_type(baby);">
                <div id="baby_name" class="txt_baby">Babynamen</div>
            </div>
            <div id="hund" class="select_hundename" onclick="hidden_type(hund);">
                <div class="txt_hundename">Hundenamen</div>
            </div>
        </div>


        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <script>
            function hidden_type(type) {
                var form = document.getElementById("hidden-form");
                if (type == baby) {
                    //                    document.getElementById("typ").value = "baby";
                    //                    form.submit();
                    window.location.href = 'startscreen.php?typ=baby';
                } else if (type == hund) {
                    //                    document.getElementById("typ").value = "hund";
                    //                    form.submit();
                    window.location.href = 'startscreen.php?typ=hund';
                } else {
                    console.log("Fehler. Kein Typ ausgewählt.")
                }


            }
        </script>
        
        <!-- verhindert das die App gedreht werden darf-->
        <script>
                        jQuery(function($) {
                        $('body').bind('orientationchange', function(e) {
                            check_orientation();
                        });

                        check_orientation();
                        });
                            var check_orientation = function() {
                            if(typeof window.orientation == 'undefined') {
                                //not a mobile 
                                return true;
                            }
                            if(Math.abs(window.orientation) != 0) {
                                //landscape mode
                                $('#orr').fadeIn().bind('touchstart', function(e) {
                                    e.preventDefault();
                                });
                                alert("Bitte drehen sie das Gerät");
                                return false;
                            }
                            else {
                                //portrait mode
                                $('#orr').fadeOut();
                                return true;
                            }
                        };
        </script>

    </body>

    </html>