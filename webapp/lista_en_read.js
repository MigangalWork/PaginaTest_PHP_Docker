var num_questions = 0;

function new_question(name){
    
    num_questions = num_questions + 1;
    var num = num_questions;
    var question = document.createElement("div");
    question.className = "form-group";
    question.innerHTML = `
    </br>
    <label>Respuesta:</label>
    <lable>${name}</lable>

    `
    document.getElementById("form").appendChild(question);
    
    update_p(num);
    
  }
  
  function update_p(id){
      var xhttp
      xhttp = new XMLHttpRequest();
      
      var ids = id.toString();
  
      xhttp.open("GET", "update_questions.php?q="+ids, true);
      xhttp.send();
      
    }

function create_list(id, name){

    var div = document.createElement("div");
    div.setAttribute("class", "form-group");
    div.setAttribute("id", `${id}`);


    var label = document.createElement("label");
    label.innerHTML = name;

    var input = document.createElement("input");
    input.setAttribute("type", "text");
    input.setAttribute("class", "form-control");
  

    /*<div class="form-group">
    <label>fecha inicio</label>
    <input type="date" name="fecha_inicio" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="">
    <span class="invalid-feedback"><?php echo $nombre_err;?></span>
</div>*/
    
    

    div.appendChild(label);
    div.appendChild(input);


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
    window.location.href='/update1.php'
  }