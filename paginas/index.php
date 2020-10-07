<?PHP
require_once("../config/conexaodb.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <p>Select local CSV File:</p>
    <input id="csv" type="file">

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

        //var csv is the CSV file with headers
        function csvJSON(csv) {

            var lines = csv.split("\n");

            var result = [];

            // var headers=lines[0].split(",");
            console.log(lines);
            for (var i = 1; i < lines.length; i++) {
                if (lines[i] != "") {
                    var obj = {};
                    var currentline = lines[i].split(",");
                    obj[i] = currentline[0];
                    for (var j = 0; j < lines.length; j++) {
                        if (lines[i] != "") {
                            // obj[0] = currentline[j];
                        }
                    }

                    // for(var j=0;j<lines.length;j++){
                    //     if(lines[i] != ""){
                    //     obj[currentline[0]] = currentline[j];
                    //     }
                    // }

                    result.push(obj);
                }


            }

            //return result; //JavaScript object
            return JSON.stringify(result); //JSON
        }
    </script>
</body>

</html>