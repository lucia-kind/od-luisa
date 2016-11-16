<!DOCTYPE html>
<html>

<head>
    <title>Page Title</title>
</head>

<body>

    <h1>My First Heading</h1>
    <p>My first paragraph.</p>
        <!--action="filter.php"-->

        <form id="myForm" method="post" onsubmit="return validateForm();">

            <input type="text" placeholder="Nachname" id="vname" name="vname">

            <input type="text" maxlength="1" placeholder="Anfangsbuchstabe" id="abst" name="abuchstabe">

            <input type="radio" name="geschlecht" value="männlich">männlich
            <input type="radio" name="geschlecht" value="weiblich">weiblich Maximal
            <input type="number" placeholder="x" max="20" id="minimaxi" name="maxi"> Zeichen Minimal
            <input type="number" max="20" placeholder="x" id="minimaxi" name="mini"> Zeichen

            <select id="dropdown" name="Haeufigkeit">
                <option value="haeufigkeit">Häufigkeit</option>
                <option value="sehr beliebt">Sehr beliebt</option>
                <option value="beliebt">Beliebt</option>
                <option value="selten">Selten</option>
            </select>

            <div id="filter" style="padding: 10px;" class="tickbox">
                <input type="submit" name="SubmitButton" value="submit"  />
            </div>
        </form>


        <script>
            //FORM darf nicht leer sein
            function validateForm() {
                //alert("juhu");
                var geschlecht = document.forms["myForm"]["geschlecht"].value;
                //var nachname = document.forms["myForm"]["vname"].value;
                var anfang = document.forms["myForm"]["abuchstabe"].value;
                var max = document.forms["myForm"]["maxi"].value;
                var min = document.forms["myForm"]["mini"].value;
                var haufigkeit = document.forms["myForm"]["Haeufigkeit"].value;
                console.log(geschlecht + " " + anfang + " " + max + " " + min + " " + haufigkeit);

                if (geschlecht != "" || anfang != "" || max != "" || min != "" || haufigkeit != "haeufigkeit") {
                    alert("ok");

                } else {
                    alert("Form must be filled out");
                }
            }
        </script>
</body>

</html>