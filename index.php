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
            <div id="baby" class="select_babyname" onclick="hidden_type(baby);">
                <div id="baby_name" class="txt_baby">Babynamen</div>
            </div>
            <div id="hund" class="select_hundename" onclick="hidden_type(hund);">
                <div class="txt_hundename">Hundenamen</div>
            </div>
        </div>

        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>

        <form id="hidden-form">
            <input type="hidden" name="typ" id="typ">
        </form>

        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <script>
            function hidden_type(type) {
                var form = document.getElementById("hidden-form");
                if (type == baby) {
                    document.getElementById("typ").value = "baby";
                    form.submit();
                    window.location.href = 'startscreen.php';
                } else if (type == hund) {
                    document.getElementById("typ").value = "hund";
                    form.submit();
                    window.location.href = 'startscreen.php';
                } else {
                    console.log("Fehler. Kein Typ ausgewählt.")
                }


            }
        </script>

    </body>

    </html>