function create_list(id, name){

    var div = document.createElement("div");
    div.setAttribute("class", "container sm-4");
    div.setAttribute("id", `${id}`);
    var name0 = document.createElement("h1");
    name0.innerHTML = name
    var but1 = document.createElement("button");
    but1.setAttribute("onclick", `read(${id})`);
    but1.setAttribute("type", "button");
    but1.setAttribute("class", "btn btn-primary");
    but1.innerHTML = "Ver respuestas";
    
    var but2 = document.createElement("button");
    but2.setAttribute("onclick", `update_en(${id})`);
    but2.setAttribute("type", "button");
    but2.setAttribute("class", "btn btn-success");
    but2.innerHTML = "Modificar";
    var but3 = document.createElement("button");
    but3.setAttribute("onclick", `delete_en(${id})`);
    but3.setAttribute("type", "button");
    but3.setAttribute("class", "btn btn-danger");
    but3.innerHTML = "Borrar";

    

    div.appendChild(name0);
    div.appendChild(but1);
    div.appendChild(but2);
    div.appendChild(but3);

    document.getElementById("result").appendChild(div);
}

var selected = 0;

function delete_en(id) {
    var xhttp
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    var ids = id.toString();
    xhttp.open("GET", "delete1.php?q="+ids, true);
    xhttp.send();
    var parent = document.getElementById("result");
    var child = document.getElementById(id);
    var deleted = parent.removeChild(child);
  }

  function update_en(id){
    console.log(id);
    var xhttp
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    var ids = id.toString();
    xhttp.open("GET", "update_session.php?q="+ids, true);
    xhttp.send();

    let nuevaURL = 'update1.php'; // La URL de destino.
    let espera   =  1;
    espera = parseInt(espera);
    setTimeout('location.href="'+nuevaURL+'"', espera*1000);
    
  }

  function read(id){
    console.log(id);
    var xhttp
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    var ids = id.toString();
    xhttp.open("GET", "update_session.php?q="+ids, true);
    xhttp.send();

    let nuevaURL = 'read_res.php'; // La URL de destino.
    let espera   =  1;
    espera = parseInt(espera);
    setTimeout('location.href="'+nuevaURL+'"', espera*1000);
  }