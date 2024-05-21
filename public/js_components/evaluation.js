/*
All codes For Evaluation of Events
Author: Rheyan
Date: 2024, May, 19
Status: In Progress
*/

function DisplayAddForm() {
  document.getElementById('eval_name_div').style.display = '';
  document.getElementById('eval_description_div').style.display = '';
}

function VerifyCreateEvalForm(route, evalForm, viewEval, images, deleteEval, empty) {
  const evalName = document.getElementById('evalname');
  const evalDesc = document.getElementById('evaldesc');

  const evalName_e = document.getElementById('eval_name_e');
  const evalDesc_e = document.getElementById('eval_description_e');

  let validity = 0;

  if (evalDesc.value === '') {
    evalDesc_e.style.display = '';
    evalDesc.classList.add("border", "border-danger");
  } else {
    evalDesc_e.style.display = 'none';
    evalDesc.classList.remove("border", "border-danger");
    validity++;
  }

  if (evalName.value === '') {
    evalName_e.style.display = '';
    evalName.classList.add("border", "border-danger");
  } else {
    evalName_e.style.display = 'none';
    evalName.classList.remove("border", "border-danger");
    validity++;
  }

  if (validity === 2) {
    CreateEvalForm(route, evalForm, viewEval, images, deleteEval, empty);
  }

}

function CreateEvalForm(route, evalForm, viewEval, images, deleteEval, emptys) {
  var formData = $('form#createeval').serialize();
  document.getElementById('mainLoader').style.display = 'flex';
  const empty = document.getElementById('empty_eval');
  $.ajax({
    type: "POST",
    url: route,
    data: formData,
    success: res => {
      if (res.status === 'success') {
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('Evaluation Form Added');
        if (empty) {
          empty.remove();
        }
        AddEvalForm(evalForm, res.eval_id, viewEval, images, deleteEval, emptys);
        document.getElementById('closeEvalForm').click();
        document.getElementById('mainLoader').style.display = 'none';
      } else {
        document.getElementById('mainLoader').style.display = 'none';
        alertify.set('notifier', 'position', 'top-right');
        alertify.error('Evaluation Form for this event was already added');
      }
    }, error: xhr => {
      console.log(xhr.responseText);
    }
  });
}

function AddEvalForm(evalForm, eval_id, viewEval, images, deleteEval, empty) {

  const route = evalForm + "?eval_id=" + eval_id;
  const list = document.getElementById('eval_list');
  $.ajax({
    type: "GET",
    url: route,
    dataType: "json",
    success: res => {
      list.innerHTML += `
            <div class="col-md-6 col-lg-3 evalFormListed" style="display:none" id="evalFormsListed${res.eval.eval_id}">
                <a href="${viewEval}?eval_id=${eval_id}" class="card-link">
                <div class="card">
                    <div class="ribbon bg-${res.event.event_status === 0 ? 'red' : 'green'}">${res.event.event_status === 0 ? 'Unpublished Event' : 'Published Event'}</div>
                    <div class="img-responsive img-responsive-21x9 card-img-top";
                    href="${viewEval}?eval_id=${eval_id}";
                    style="background-image: url('${images}/${res.event.event_pic}')">
                </div>                            
                    <div class="card-body" href="${viewEval}" >
                        <h3 class="card-title">${res.eval.eval_name}(${res.event.event_name})</h3>
                        <p class="text-muted">${res.eval.eval_description}
                        </p>
                    </div>
                </a>
                    <div class="d-flex">
                        <a href="${viewEval}?eval_id=${eval_id}" 
                            class="card-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                <path
                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                <path d="M16 5l3 3" />
                            </svg>
                                 Edit
                        </a>
                        <a href="#" onclick="DeleteEvalForm('${deleteEval}', '${res.eval.eval_id}', '${empty}')"
                            class="card-btn">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                             Delete</a>
                    </div>
                </div>
            </div>`;

      const name = document.getElementById(`evalFormsListed${res.eval.eval_id}`);
      name.style.display = '';
      setTimeout(() => {
        name.style.marginTop = '0px';
        name.style.opacity = '1';
      }, 50);

    }, error: xhr => {
      console.log(xhr.responseText);
    }
  })
}

function LoadEvaluationForm(getAll, empty, evalForm, viewEval, evalImage, deleteEval) {
  $.ajax({
    type: "GET",
    url: getAll,
    dataType: "json",
    success: res => {
      const list = document.getElementById('eval_list');
      const loading = document.getElementById('loading-eval');
      if (loading) {
        loading.remove();
      }
      if (res.eval.length === 0) {
        list.innerHTML = `<div class="empty" id="empty_eval">
         <div class="empty-img"><img src="${empty}" height="128" alt="">
         </div>
         <p class="empty-title">No Evaluation Forms found</p>
         <p class="empty-subtitle text-muted">
           Try adding one to let students evaluate the event.
         </p>
         <div class="empty-action">
           <button  data-bs-toggle="modal" data-bs-target="#createevaluation" class="btn btn-primary">
             <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
             Add Evaluation Form
           </button>
         </div>
       </div> `
      } else {
        res.eval.forEach(ev => {
          AddEvalForm(evalForm, ev.eval_id, viewEval, evalImage, deleteEval, empty);
        });
      }
    }, error: xhr => {
      console.log(xhr.responseText);
    }
  });
}

function DeleteEvalForm(route, eval_id, empty) {
  alertify.confirm('Delete Evaluation Form', 'Are you sure you want to delete this evaluation form? Please think more than 1000 times before clicking Ok', function () {
    document.getElementById('delete_eval_id').value = eval_id;
    document.getElementById('mainLoader').style.display = 'flex';
    var formData = $('form#deleteEvalForm').serialize();
    $.ajax({
      type: "POST",
      url: route,
      data: formData,
      success: res => {
        if (res.status === 'success') {
          const name = "evalFormsListed" + eval_id;
          const evalList = document.getElementById(name);
          evalList.style.marginTop = '100px';
          evalList.style.opacity = '0';
          document.getElementById('mainLoader').style.display = 'none';
          setTimeout(() => {
            evalList.remove();
            const list = document.querySelectorAll('.evalFormListed');
            if (list.length === 0) {
              document.getElementById('eval_list').innerHTML = `<div class="empty" id="empty_eval">
                     <div class="empty-img"><img src="${empty}" height="128" alt="">
                     </div>
                     <p class="empty-title">No Evaluation Forms found</p>
                     <p class="empty-subtitle text-muted">
                       Try adding one to let students evaluate the event.
                     </p>
                     <div class="empty-action">
                       <button  data-bs-toggle="modal" data-bs-target="#createevaluation" class="btn btn-primary">
                         <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                         <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                         Add Evaluation Form
                       </button>
                     </div>
                   </div> `;
            }
          }, 1000);
          alertify.set('notifier', 'position', 'top-right');
          alertify.warning('Evaluation Form was deleted').dismissOthers();

        }
      }, error: xhr => {
        console.log(xhr.responseText);
      }
    });
  }
    , function () { console.log('cancel') });

}

function SubmitQuestion(q_num, route) {
  const question = document.getElementById(`eval_form_question${q_num}`);
  const scale = document.getElementById(`eval_form_scale${q_num}`);

  const question_e = document.getElementById(`eval_form_question_e${q_num}`);
  const scale_e = document.getElementById(`eval_form_scale_e${q_num}`);

  let validity = 0;

  if (question.value === '') {
    question_e.style.display = '';
    question.classList.add('border', 'border-danger');
  } else {
    question_e.style.display = 'none';
    question.classList.remove('border', 'border-danger');
    validity++;
  }

  if (scale.value == 0) {
    scale_e.style.display = '';
    scale.classList.add('border', 'border-danger');
  } else {
    scale_e.style.display = 'none';
    scale.classList.remove('border', 'border-danger');
    validity++;
  }

  if (validity === 2) {
    document.getElementById('eval_question').value = question.value;
    document.getElementById('eval_scale').value = scale.value;
    document.getElementById('eval_num').value = q_num;
    SaveQuestion(route, question.value, scale.value, q_num);
  }
}

function SaveQuestion(route, question, scale, q_num) {
  document.getElementById('mainLoader').style.display = 'flex';
  var formData = $('form#formQuestions').serialize();
  $.ajax({
    type: "POST",
    url: route,
    data: formData,
    success: res => {
      if (res.status === 'success') {
        document.getElementById('mainLoader').style.display = 'none';
        const content = document.getElementById(`question_content${q_num}`);
        const scaleTD = document.getElementById(`question_scale${q_num}`);
        const actions = document.getElementById(`question_action${q_num}`);

        content.innerHTML = question;
        scaleTD.innerHTML = EvalScaleConvert(scale);
        actions.innerHTML = `<button class="btn btn-outline-primary me-2">Edit</button>
        <button class="btn btn-outline-danger">Delete</button>`;
      }
    }, error: xhr => {
      console.log(xhr.responseText)
    }
  });

}

function EvalScaleConvert(num) {
  switch (num) {
    case "1":
      return 'Likert Scale(1-5) Strongly Disagree-Strongly Agree';
      break;
    case "2":
      return 'Rating Scale(1-5) Poor-Excellent';
      break;
    case "3":
      return 'Performance Scale(1-5) Needs Improvement-Excellent';
      break;
    case "4":
      return 'Close Ended (Yes/No)';
      break;
    case "5":
      return 'Open Ended (Describe)';
      break
  }
}

function LoadEvalQuestion(route) {
  const list = document.getElementById('question_list');
  $.ajax({
    type: "GET",
    url: route,
    dataType: 'json',
    success: res => {
      res.question.forEach(q => {
        list.innerHTML += `<tr id="question_list${q.eq_num}">
         <td id="qnum${q.eq_num}" scope="row">${q.eq_num}</td>
        
         <td id="question_content${q.eq_num}">
          ${q.eq_question}
         </td>
         <td id="question_scale${q.eq_num}">
            ${EvalScaleConvert(q.eq_scale)}
         </td>
         <td id="question_action${q.eq_num}">
         <button class="btn btn-outline-primary me-2">Edit</button>
         <button class="btn btn-outline-danger">Delete</button>
         </td>
     
     </tr>`
      });
    }, error: xhr => {
      console.log(xhr.responseText);
    }
  });
}

function EvalQuestionSwitchNum() {
  const table = document.getElementById('questionTable');
  var rows = table.getElementsByTagName('tr');
  var rowsData = [];
  for (var i = 0; i < rows.length; i++) {
    rowsData.push(rows[i].id);
  }

  // Assign sequential numbers to the first cell of each <tr>
  for (let i = 1; i < rows.length; i++) {
    if(rows[1] != 'tr_head'){
      let firstCell = rows[i].cells[0]; // Use cells[0] to get the first cell regardless of its type
      if (firstCell) {
        firstCell.textContent = i;
      }
    }
  }


}
/**
 * Todo: 
 * Load Questions,
 * Edit Questions
 * Delete Questions
 * Adjust Numbering
 */