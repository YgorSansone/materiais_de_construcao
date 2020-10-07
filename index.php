<?PHP
require_once("config/conexaodb.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <p>Select local CSV File:</p>
    <input id="csv" type="file">
    <div class="resultado" id="resultado"></div>
    <output id="out">
        file contents will appear here
    </output>
    <script>
        var fileInput = document.getElementById("csv"),

            readFile = function() {
                var reader = new FileReader();
                reader.onload = function() {
                    document.getElementById('out').innerHTML = reader.result;
                    console.log(reader.result);
                    console.log(JSON.stringify(reader.result));
                    console.log(csvJSON(reader.result));
                };
                // start reading the file. When it is done, calls the onload event defined above.
                reader.readAsText(fileInput.files[0], 'UTF-8');
            };

        fileInput.addEventListener('change', readFile);

        function csvJSON(csv) {
            var lines = csv.split("\n");
            // console.log(lines[0]);
            var result = [];
            var obj = {};
            const map1 = new Map();
            for (var i = 0; i < lines.length; i++) {
                if (lines[i] != "") {
                    var quebrando = lines[i].split(",");
                    map1.set(quebrando[0], quebrando[1]);
                    // obj[i] = quebrando[0];
                }
            }
            obj = Object.fromEntries(map1);
            result.add(obj);
            // console.log(obj);
            sendcsv(result);
            return JSON.stringify(result); //JSON
        }

        function sendcsv(dados) {
            // json = JSON.stringify(dados);
            $.ajax({
                    url: "consultas/consulta.php",
                    type: 'post',
                    data: {val: dados},
                    beforeSend: function() {
                        $("#resultado").html("ENVIANDO...");
                        console.log("enviando");
                    }
                })
                .done(function(msg) {
                    $("#resultado").html(msg);
                    console.log(msg);
                })
                .fail(function(jqXHR, textStatus, msg) {
                    alert(msg);
                    console.log(msg);
                });
        }
    </script>
</body>

</html>