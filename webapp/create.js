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
    
}