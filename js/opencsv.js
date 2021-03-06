
var fileInput = document.getElementById("csv");
$(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
readFile = function () {
    var reader = new FileReader();
    reader.onload = function () {
        csvJSON(reader.result);
    };
    reader.readAsText(fileInput.files[0], 'UTF-8');
};

fileInput.addEventListener('change', readFile);

function csvJSON(csv) {
    console.log(csv);
    var lines = csv.split("\n");
    // console.log(lines[0]);
    var result = [];
    var obj = {};
    const map1 = new Map();
    for (var i = 0; i < lines.length; i++) {
        if (lines[i] != "") {
            var quebrando = lines[i].split(',');
            if (quebrando[1].indexOf(" ") !== -1) {
                // console.log("errado : " + quebrando[1]);
                quebrando = lines[i].split('\",');
                quebrando[0] = quebrando[0].split('\"').pop();
            }
            quebrando[0] = quebrando[0].toLowerCase();
            quebrando[0] = quebrando[0][0].toUpperCase() + quebrando[0].substr(1);
            map1.set(quebrando[0], quebrando[1]);
            // obj[i] = quebrando[0];
        }
    }
    obj = Object.fromEntries(map1);
    // result = obj;
    // console.log(obj);
    sendcsv(obj);
    // return JSON.stringify(result); //JSON4
}

function sendcsv(dados) {
    json = JSON.stringify(dados);
    $.ajax({
        url: "consultas/consulta.php",
        type: 'post',
        data: { val: json },
        beforeSend: function () {
            $("#resultado").html('<img src="https://olaargentina.com/wp-content/uploads/2019/11/loading-gif-transparent-10.gif" alt="some text"class="rounded">');
            console.log("enviando");
        }
    })
        .done(function (msg) {
            $("#resultado").html(msg);
            OrdernarTabela();
            // console.log(msg);
        })
        .fail(function (jqXHR, textStatus, msg) {
            alert(msg);
        });
}