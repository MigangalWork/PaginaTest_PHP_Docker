function create_list(id, name){

    var div = document.createElement("div");
    div.setAttribute("class", "container sm-4");
    div.setAttribute("id", `${id}`);
    var name0 = document.createElement("h1");
    name0.innerHTML = name
    var but1 = document.createElement("button");
    but1.setAttribute("onclick", `update_en(${id})`);
    but1.setAttribute("type", "submit");
    but1.setAttribute("class", "btn btn-primary");
    but1.innerHTML = "Responder Encuesta";


    

    div.appendChild(name0);
    div.appendChild(but1);

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
    window.location.href='/respond.php';
  }