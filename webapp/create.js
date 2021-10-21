var num_questions = 1;

function new_question(){
    var num = num_questions = num_questions + 1;
    var question = document.createElement("div");
    question.className = "form-group";
    question.innerHTML = `
    </br>
    <label>Pregunta numero ${num}</label>
    <input type="text" name="question${num}" class="form-control id=${num}<?php echo (!empty($question_err)) ? 'is-invalid' : ''; ?>" 
    value="">
    <span class="invalid-feedback"><?php echo $question_err;?></span>

    `
    document.getElementById("form").appendChild(question);
    update_en(num);
    
}

function update_en(id){
    var xhttp
    xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        
        }
      };

    var ids = id.toString();

    xhttp.open("GET", "update_questions.php?q="+ids, true);
    xhttp.send();
    
  }