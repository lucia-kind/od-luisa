<?php
	require_once("system/data.php");
	require_once("system/security.php");
?>

    <!DOCTYPE html>
    <html>

    <head>

        <title>Luisa - Die Namensapp</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="css/style.css">


    </head>

    <body>
        <div class="section">
            <div class="topbar">
                <div class="txt_topbar">Ich suche einen...</div>
            </div>
            <div id="baby" class="select_babyname">
                <div id="baby_name" class="txt_baby">Babynamen</div>
            </div>
            <div id="hund" class="select_hundename">
                <div class="txt_hundename">Hundenamen</div>
            </div>
        </div>

        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>

        <form id="hidden-form" method="POST">
            <input type="hidden" name="typ" id="typ">
        </form>

        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <script>
            var form = document.getElementById("hidden-form");
            document.getElementById("baby").addEventListener("click", function () {
                document.getElementById("typ").value = "baby";
                //form.submit();
            });
            //            document.getElementById("baby").onclick = function () {
            //                document.getElementById("typ").value = "baby";
            //                //form.submit();
            //            }
        </script>

    </body>

    </html>