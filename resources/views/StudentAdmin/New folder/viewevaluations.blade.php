<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Evaluation Details'])
<script src="{{ asset('./js_components/evaluation.js') }}"></script>
@php
$eval = App\Models\Evaluation::join('school_event', 'evaluation.event_id', '=', 'school_event.event_id')
            ->select('evaluation.*', 'school_event.event_name as event_name')
            ->where('evaluation.eval_id', $eval_id)
            ->first();
$questionCount = App\Models\EvalQuestion::where('eval_id', $eval_id)->get()->count();
@endphp
<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>

    <div class="page">

        @include('Admin.components.nav', ['active' => ''])
        @include('Admin.components.loading')
        <div class="page-wrapper">

            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">

                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Overview
                            </div>
                            <h2 class="page-title">
                                Event: {{ $eval->event_name }} / {{ $eval->eval_name }}
                            </h2>
                        </div>


                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">

                        <div class="position-relative" style="margin-top: -3%;">
                            <div class="display-flex justify-content-end position-absolute top-0 end-0 p-3">
                                <button onclick="SaveSwitchNumQuestion('{{route('switchQuestionNum')}}')" class="btn btn-primary" style="display: none" id="saveChanges">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-sd-card">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 21h10a2 2 0 0 0 2 -2v-14a2 2 0 0 0 -2 -2h-6.172a2 2 0 0 0 -1.414 .586l-3.828 3.828a2 2 0 0 0 -.586 1.414v10.172a2 2 0 0 0 2 2z" />
                                        <path d="M13 6v2" />
                                        <path d="M16 6v2" />
                                        <path d="M10 7v1" />
                                      </svg> Save Changes
                                </button>

                                <button class="btn btn-danger" style="display: none" id="discardChanges" onclick="LoadEvalQuestion('{{route('getAllEvalQuestion')}}?eval_id={{$eval_id}}', '{{route('deleteEvalQuestion')}}', '{{route('updateEvalQuestion')}}', '{{route('getEvalQuestion')}}', 'discard')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M18 6l-12 12" />
                                        <path d="M6 6l12 12" />
                                      </svg> Discard Changes
                                </button>


                                <a href="{{ route('evaluationResult') }}?eval_id={{ $eval_id }}" class="btn btn-outline-info" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-chart-infographic">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M7 3v4h4" />
                                        <path d="M9 17l0 4" />
                                        <path d="M17 14l0 7" />
                                        <path d="M13 13l0 8" />
                                        <path d="M21 12l0 9" />
                                      </svg> View Results
                                </a>
                                <button class="btn btn-outline-primary" id="addQuestionBtn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-plus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                        <path d="M13.5 6.5l4 4" />
                                        <path d="M16 19h6" />
                                        <path d="M19 16v6" />
                                    </svg> Add Questions
                                </button>
                            </div>
                        </div>

                        <div class="card mt-5">
                            <div class="card-body">
                                <h5 class="card-title">Question List</h5>

                                <table class="table table-hover table-success" id="questionTable">
                                    <thead>
                                        <tr id="tr_head">
                                            <th scope="col">Question #</th>
                                            <th scope="col">Questions</th>
                                            <th scope="col">Response Scale</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="question_list_data">
                                        <tr id="loading-question">
                                            <td colspan="6" class="text-center">
                                              <div class="text-muted mb-3">Loading Questions...</div>
                                              <div class="progress progress-sm ">
                                                <div class="progress-bar progress-bar-indeterminate"></div>
                                              </div>
                                            </td>
                                            </tr>  
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            @include('Admin.components.footer')

        </div>
    </div>

    <form method="POST" id="formQuestions">
        @csrf
        <input type="hidden" name="eval_id" value="{{ $eval_id }}">
        <input type="hidden" name="eval_question" id="eval_question">
        <input type="hidden" name="eval_scale" id="eval_scale">
        <input type="hidden" name="eval_num" id="eval_num">
    </form>

    <form method="POST" id="switchQuestion">
        @csrf
        <input type="hidden" name="eval_id" value="{{ $eval_id }}">
        <input type="hidden" name="allupdate" id="allnewplace">
    </form>

    <form method="POST" id="deleteQuestion">
        @csrf
        <input type="hidden" name="eval_id" value="{{$eval_id}}">
        <input type="hidden" name="eq_id" id="delete_eq_id">
    </form>

    <form method="POST" id="updateQuestion">
        @csrf
    <input type="hidden" name="q_id" id="update_q_id">
    <input type="hidden" name="q_name" id="update_q_name" >
    <input type="hidden" name="q_scale" id="update_q_scale">
    </form>

    <input type="hidden" id="forKeepQuestionCount" value=" {{$questionCount > 0 ? $questionCount + 1 : '1'}}">
    <input type="hidden" id="updateNumbering" value="{{route('switchQuestionNum')}}">
    <input type="hidden" value="{{asset('static/illustrations/undraw_joyride_hnno.svg')}}" id="empty_asset">
    @include('Admin.components.scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var table = document.getElementById('questionTable').getElementsByTagName('tbody')[0];
            new Sortable(table, {
             animation: 150,
             ghostClass: 'blue-background-class',
             onEnd: function (evt) {
   
                    EvalQuestionSwitchNum();
                }
             });

            LoadEvalQuestion("{{route('getAllEvalQuestion')}}?eval_id={{$eval_id}}", "{{route('deleteEvalQuestion')}}", "{{route('updateEvalQuestion')}}", "{{route('getEvalQuestion')}}", "load");

            const addQuestionBtn = document.getElementById('addQuestionBtn');
            const questionTableBody = document.querySelector('#questionTable tbody');
            let questionCount = Number(document.getElementById('forKeepQuestionCount').value);
       
    
            addQuestionBtn.addEventListener('click', function() {
                var emptyData = document.getElementById('empty_question');
                if(emptyData){
                    emptyData.remove();
                }
                const newRow = `
                    <tr class="alltrquestions" id="question_list${questionCount}">
                        <td id="qnum${questionCount}" scope="row">${questionCount}</td>
                       
                        <td id="question_content${questionCount}">
                        <input type="text" id="eval_form_question${questionCount}" class="form-control question-input" name="evalname" placeholder="Question ${questionCount}">
                        <label  id="eval_form_question_e${questionCount}" style="display:none" class="text-sm text-danger" for="eval_form_question${questionCount}">(No Input in this field)</label>
                        </td>
                        <td id="question_scale${questionCount}">
                            <select id="eval_form_scale${questionCount}" class="form-control">
                                <option value="0" selected disabled>-------Select Scale-------</option>
                                <option value="1">Likert Scale(1-5) Strongly Disagree-Strongly Agree</option>   
                                <option value="2">Rating Scale(1-5) Poor-Excellent</option>
                                <option value="3">Performance Scale(1-5) Needs Improvement-Excellent</option>
                                <option value="4">Close Ended (Yes/No)</option>  
                                <option value="5">Open Ended (Describe)</option> 
                            </select>
                            <label style="display:none" id="eval_form_scale_e${questionCount}" class="text-sm text-danger" for="eval_form_scale${questionCount}">(No Selected Scale in this field)</label>
                        </td>
                        <td id="question_action${questionCount}">
                            <button class="btn btn-outline-primary me-2 m-auto" 
                            onclick="SubmitQuestion('${questionCount}', '{{ route('addEvalQuestion') }}', '{{route('deleteEvalQuestion')}}', '{{route('updateEvalQuestion')}}', '{{route('getEvalQuestion')}}')">
                            Save</button>
                            <button class="btn btn-outline-danger me-2 m-auto" 
                            onclick="CancelAddQuestion('${questionCount}')">
                            Cancel</button>
                        </td>
                    
                    </tr>
                `;
                questionTableBody.insertAdjacentHTML('beforeend', newRow);
                questionCount++;
            });
        });
    </script>

</body>

</html>
