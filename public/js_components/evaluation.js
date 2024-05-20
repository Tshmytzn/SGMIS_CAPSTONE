/*
All codes For Evaluation of Events
Author: Rheyan
Date: 2024, May, 19
Status: In Progress
*/

function DisplayAddForm(){
  document.getElementById('eval_name_div').style.display = '';
  document.getElementById('eval_description_div').style.display = '';
}

function VerifyCreateEvalForm(route, evalForm, viewEval, images){
    const evalName = document.getElementById('evalname');
    const evalDesc = document.getElementById('evaldesc');

    const evalName_e = document.getElementById('eval_name_e');
    const evalDesc_e = document.getElementById('eval_description_e');

    let validity = 0;
    
    if(evalDesc.value === ''){
        evalDesc_e.style.display = '';
        evalDesc.classList.add("border", "border-danger");
    }else{
        evalDesc_e.style.display = 'none';
        evalDesc.classList.remove("border", "border-danger");
        validity++;
    }

    if(evalName.value === ''){
        evalName_e.style.display = '';
        evalName.classList.add("border", "border-danger");
    }else{
        evalName_e.style.display = 'none';
        evalName.classList.remove("border", "border-danger");
        validity++;
    }

    if(validity === 2){
        CreateEvalForm(route, evalForm, viewEval, images);
    }

}

function CreateEvalForm(route,evalForm,viewEval, images){
    var formData = $('form#createeval').serialize();
    document.getElementById('mainLoader').style.display = 'flex';
    const empty = document.getElementById('empty_eval');
    $.ajax({
      type: "POST",
      url: route,
      data: formData,
      success: res=>{
        if(res.status=== 'success'){
         alertify.set('notifier','position', 'top-right');
         alertify.success('Evaluation Form Added');
         if(empty){
            empty.remove();
         }
         AddEvalForm(evalForm, res.eval_id, viewEval, images);
         document.getElementById('closeEvalForm').click();
         document.getElementById('mainLoader').style.display = 'none';
        }
      }, error: xhr=>{
        console.log(xhr.responseText);
      }
    });
}

function AddEvalForm(evalForm, eval_id, viewEval, images){

    const route = evalForm + "?eval_id=" + eval_id;
    const list = document.getElementById('eval_list');
    $.ajax({
        type:"GET",
        url: route,
        dataType:"json",
        success: res=>{
            list.innerHTML += ` <div class="row row-deck row-cards">
            <div class="col-md-6 col-lg-3">
                <a href="${viewEval}" class="card-link">
                <div class="card">
                    <div class="ribbon bg-${res.event.event_status === 0 ? 'red': 'green'}">${res.event.event_status === 0 ? 'Unpublished Event': 'Published Event'}</div>
                    <div class="img-responsive img-responsive-21x9 card-img-top";
                    href="${viewEval}";
                    style="background-image: url('${images}/${res.event.event_pic}')">
                </div>                            
                    <div class="card-body" href="${viewEval}" >
                        <h3 class="card-title">${res.eval.eval_name}</h3>
                        <p class="text-muted">${res.eval.eval_description}
                        </p>
                    </div>
                </a>
                    <div class="d-flex">
                        <a href="${viewEval}" data-bs-toggle="modal" data-bs-target="#editeval"
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
                            &nbsp; Edit
                        </a>
                        <a href="#"
                            class="card-btn">
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            &nbsp; Delete</a>
                    </div>
                </div>
            </div>`;
         
        }, error: xhr=>{
            console.log(xhr.responseText);
        }
    })
}

function LoadEvaluationForm(valForm, eval_id, viewEval, images){

}