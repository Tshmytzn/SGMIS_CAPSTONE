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
          document.getElementById('mainLoader').style.display = 'none';
        }
      }, error: xhr => {
        console.log(xhr.responseText);
      }
    });
  }
    , function () { console.log('cancel') });

}

function SubmitQuestion(q_num, route, deleteQuestion, updateQuestion, getEvalQuestion) {
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
    SaveQuestion(route, question.value, scale.value, q_num, deleteQuestion, updateQuestion, getEvalQuestion);
  }
}

function SaveQuestion(route, question, scale, q_num, deleteQuestion, updateQuestion, getEvalQuestion) {
  document.getElementById('mainLoader').style.display = 'flex';
  var formData = $('form#formQuestions').serialize();
  $.ajax({
    type: "POST",
    url: route,
    data: formData,
    success: res => {
      if (res.status === 'success') {
        document.getElementById('mainLoader').style.display = 'none';
        const questionList = document.getElementById(`question_list${q_num}`);
        const content = document.getElementById(`question_content${q_num}`);
        const scaleTD = document.getElementById(`question_scale${q_num}`);
        const actions = document.getElementById(`question_action${q_num}`);
        questionList.classList.add("alltrquestions");
        questionList.id = `question_list${q_num}-${res.id}`;


        content.innerHTML = question;
        scaleTD.innerHTML = EvalScaleConvert(scale);
        actions.innerHTML = `<button class="btn btn-outline-primary me-2" onclick="ChangeUpdateDataQuestion('${updateQuestion}', '${res.id}', '${q_num}', '${getEvalQuestion}', '${deleteQuestion}')">Edit</button>
        <button class="btn btn-outline-danger" onclick="SubmitDeleteQuestion('${deleteQuestion}', '${res.id}')">Delete</button>`;

        document.getElementById('saveChanges').style.display = 'none';
        document.getElementById('discardChanges').style.display = 'none';
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

function LoadEvalQuestion(route, deleteQuestion, updateQuestion, getEvalQuestion, method) {
  if(method === 'discard'){
    document.getElementById('mainLoader').style.display = 'flex';
  }
  const list = document.getElementById('question_list_data');
  $.ajax({
    type: "GET",
    url: route,
    dataType: 'json',
    success: res => {
      list.innerHTML = '';
      if(res.question.length > 0){
        
      res.question.forEach(q => {
        list.innerHTML += `<tr class="alltrquestions" id="question_list${q.eq_num}-${q.eq_id}">
         <td id="qnum${q.eq_num}" scope="row">${q.eq_num}</td>
        
         <td id="question_content${q.eq_num}">
          ${q.eq_question}
         </td>
         <td id="question_scale${q.eq_num}">
            ${EvalScaleConvert(q.eq_scale)}
         </td>
         <td id="question_action${q.eq_num}">
         <button class="btn btn-outline-primary me-2" onclick="ChangeUpdateDataQuestion('${updateQuestion}', '${q.eq_id}', '${q.eq_num}', '${getEvalQuestion}', '${deleteQuestion}')">Edit</button>
         <button class="btn btn-outline-danger" onclick="SubmitDeleteQuestion('${deleteQuestion}', '${q.eq_id}')">Delete</button>
         </td>
     
     </tr>`
      });
    }else{
      list.innerHTML = `<tr id="empty_question">
      <td colspan="6" class="text-center">
      <div class="empty-img"><img src="${document.getElementById('empty_asset').value}" height="128" alt="">
      </div>
      <p class="empty-title">No Questions Added Yet</p>
      <p class="empty-subtitle text-muted">
        Please Add Questions to start publishing the evaluation form
      </p>
      </td>
  </tr>`
    }
      if(method === 'discard'){
        document.getElementById('mainLoader').style.display = 'none';
        alertify.set('notifier','position', 'top-right');
        alertify.warning('Questions Sequence Discarded');
        document.getElementById('saveChanges').style.display = 'none';
        document.getElementById('discardChanges').style.display = 'none';
      }
   
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

  for (let i = 1; i < rows.length; i++) {
    if(rows[1] != 'tr_head'){
      let firstCell = rows[i].cells[0];
      if (firstCell) {
        firstCell.textContent = i;
      }
    }

  }
  document.getElementById('saveChanges').style.display = '';
  document.getElementById('discardChanges').style.display = '';
}

  function SaveSwitchNumQuestion(route){
    const table = document.getElementById('questionTable');
    var rows = table.getElementsByTagName('tr');
    var rowsData = [];
    var dataUpdate = '';
    for (var i = 0; i < rows.length; i++) {
      rowsData.push(rows[i].id);
    }
    for (var i = 0; i < rows.length; i++) {
      const getId = rowsData[i].split('-')[1];

      if(i!=0){
        const concatData = getId + '-' + i + ',';
        dataUpdate += concatData;
      }
    }

    document.getElementById('allnewplace').value = dataUpdate;
    
    SubmitSwitchNumQuestion(route);
  
}
function SubmitSwitchNumQuestion(route){
  document.getElementById('mainLoader').style.display = 'flex';
   var formData = $('form#switchQuestion').serialize();

   $.ajax({
    type: "POST",
    url: route,
    data: formData,
    success: res=>{
      if(res.status == 'success'){
        console.log(res.status);
       document.getElementById('mainLoader').style.display = 'none';
       alertify.set('notifier','position', 'top-right');
       alertify.success('Questions Sequence Changed');
       document.getElementById('discardChanges').style.display = 'none';
       document.getElementById('saveChanges').style.display = 'none';
      }
    }, error: xhr => {
      console.log(xhr.responseText);
    }
   })
}


function SubmitDeleteQuestion(route, id){
  alertify.confirm('Delete Question', 'Are you sure do you want to delete this question?',
   function(){ 
  document.getElementById('delete_eq_id').value = id;
  document.getElementById('mainLoader').style.display = 'flex';
  DeleteQuestion(route);
    }
  , function(){ console.log('cancel')});
  
}

function DeleteQuestion(route){
 $.ajax({
   type:"POST",
   url: route,
   data: $('form#deleteQuestion').serialize(),
   success: res=>{
    if(res.status === 'success'){
      document.getElementById(`question_list${res.num}-${res.id}`).remove();
      document.getElementById('forKeepQuestionCount').value = res.q_num;
      EvalQuestionSwitchNum();
      setTimeout(()=>{
        SaveSwitchNumQuestion(document.getElementById('updateNumbering').value);
      },100);

      
      document.getElementById('mainLoader').style.display = 'none';
      alertify.set('notifier', 'position', 'top-right');
      alertify.warning('Question Deleted');
      DisplayEmpty();
    }
   },error: xhr=>{
    console.log(xhr.responseText);
   }
 });
}

function ChangeUpdateDataQuestion(route, id, q_num, getQuestion, deleteQuestion){
  alertify.set('notifier', 'position', 'top-center')
  alertify.warning('Processing....');
  $.ajax({
    type:"GET",
    url: getQuestion + "?q_id=" + id,
    dataType:"json",
    success: res=>{
      const trData = document.getElementById(`question_list${q_num}-${id}`);
      trData.innerHTML = `<td  id="qnum${q_num}" scope="row">${q_num}</td>
      <td id="question_content${q_num}">
      <input type="text" id="eval_form_question${q_num}" class="form-control question-input" value="${res.question.eq_question}" name="evalname" placeholder="Question ${q_num}">
      <label  id="eval_form_question_e${q_num}" style="display:none" class="text-sm text-danger" for="eval_form_question${q_num}">(No Input in this field)</label>
      </td>
      <td id="question_scale${q_num}">
      <select id="eval_form_scale${q_num}" class="form-control">
      <option ${res.question.eq_scale === 1 ? 'selected' : ''} value="1">Likert Scale(1-5) Strongly Disagree-Strongly Agree</option>   
      <option ${res.question.eq_scale === 2 ? 'selected' : ''} value="2">Rating Scale(1-5) Poor-Excellent</option>
      <option ${res.question.eq_scale === 3 ? 'selected' : ''} value="3">Performance Scale(1-5) Needs Improvement-Excellent</option>
      <option ${res.question.eq_scale === 4 ? 'selected' : ''} value="4">Close Ended (Yes/No)</option>  
      <option ${res.question.eq_scale === 5 ? 'selected' : ''} value="5">Open Ended (Describe)</option> 
      </select>
      <label style="display:none" id="eval_form_scale_e${q_num}" class="text-sm text-danger" for="eval_form_scale${q_num}">(No Selected Scale in this field)</label>
      </td>
      <td id="question_action${q_num}">
      <button class="btn btn-outline-primary me-2 m-auto" 
      onclick="SubmitUpdateQuestion('${route}', '${q_num}', '${id}', '${getQuestion}', '${deleteQuestion}')">
      Update</button>
      <button class="btn btn-outline-danger me-2 m-auto" 
      onclick="DiscardUpdate('${q_num}','${id}', '${res.question.eq_question}', '${res.question.eq_scale}', '${getQuestion}', '${deleteQuestion}', '${route}')">
      Discard</button>
      </td>
      `
    }, error: xhr=>{
      console.log(xhr.responseText);
    }
  });

}
function SubmitUpdateQuestion(route, q_num, id, getQuestion, deleteQuestion){
  document.getElementById('mainLoader').style.display = 'flex';

  document.getElementById('update_q_id').value = id;
  document.getElementById('update_q_name').value = document.getElementById(`eval_form_question${q_num}`).value;
  document.getElementById('update_q_scale').value = document.getElementById(`eval_form_scale${q_num}`).value;

  UpdateQuestion(route, q_num, id, getQuestion, deleteQuestion);
}

function UpdateQuestion(route, q_num, id, getQuestion,deleteQuestion){

  $.ajax({
    type:"POST",
    url: route,
    data: $('form#updateQuestion').serialize(),
    success: res=>{
      if(res.status === 'success'){
        const trData = document.getElementById(`question_list${q_num}-${id}`);
        trData.innerHTML = `<td id="qnum${q_num}" scope="row">${q_num}</td>
        
        <td id="question_content${q_num}">
         ${res.question}
        </td>
        <td id="question_scale${q_num}">
           ${EvalScaleConvert(res.scale)}
        </td>
        <td id="question_action${q_num}">
        <button class="btn btn-outline-primary me-2" onclick="ChangeUpdateDataQuestion('${route}', '${id}', '${q_num}', '${getQuestion}')">Edit</button>
        <button class="btn btn-outline-danger" onclick="SubmitDeleteQuestion('${deleteQuestion}', '${id}')">Delete</button>
        </td>`;

        document.getElementById('mainLoader').style.display = 'none';
        alertify.set('notifier', 'position', 'top-right');
        alertify.success('Question has been updated');
      }
    },error: xhr => {
      console.log(xhr.responseText);
    }
  })
}

function DiscardUpdate(q_num, id, question, scale, getQuestion, deleteQuestion, updateQuestion){
 const trData = document.getElementById(`question_list${q_num}-${id}`);

 trData.innerHTML = ` <td id="qnum${q_num}" scope="row">${q_num}</td>
        
 <td id="question_content${q_num}">
  ${question}
 </td>
 <td id="question_scale${q_num}">
    ${EvalScaleConvert(scale)}
 </td>
 <td id="question_action${q_num}">
 <button class="btn btn-outline-primary me-2" onclick="ChangeUpdateDataQuestion('${updateQuestion}', '${id}', '${q_num}', '${getQuestion}', '${deleteQuestion}')">Edit</button>
 <button class="btn btn-outline-danger" onclick="SubmitDeleteQuestion('${deleteQuestion}', '${id}')">Delete</button>
 </td>`;
}

function CancelAddQuestion(q_num){
  const trData = document.getElementById(`question_list${q_num}`);
  trData.remove();

  EvalQuestionSwitchNum();

  DisplayEmpty();
}

function DisplayEmpty(){
  const allTr = document.querySelectorAll('.alltrquestions');

  if(allTr.length === 0){
    document.getElementById('question_list_data').innerHTML = `<tr id="empty_question">
    <td colspan="6" class="text-center">
    <div class="empty-img"><img src="${document.getElementById('empty_asset').value}" height="128" alt="">
    </div>
    <p class="empty-title">No Questions Added Yet</p>
    <p class="empty-subtitle text-muted">
      Please Add Questions to start publishing the evaluation form
    </p>
    </td>
</tr>`;
  }
}