<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Evaluation Details'])
<script src="{{ asset('./js_components/evaluation.js') }}"></script>
@php
$eval = App\Models\Evaluation::join('school_event', 'evaluation.event_id', '=', 'school_event.event_id')
            ->select('evaluation.*', 'school_event.event_name as event_name')
            ->where('evaluation.eval_id', $eval_id)
            ->first();
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

                                <table class="table table-hover table-success text-center" id="questionTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Question #</th>
                                            <th scope="col">Questions</th>
                                            <th scope="col">Response Scale</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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
    </form>

    @include('Admin.components.scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addQuestionBtn = document.getElementById('addQuestionBtn');
            const questionTableBody = document.querySelector('#questionTable tbody');
            let questionCount = 1;
    
            addQuestionBtn.addEventListener('click', function() {
                const newRow = `
                    <tr id="question_list${questionCount}">
                        <th scope="row">${questionCount}</th>
                       
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
                            <button class="btn btn-outline-primary me-2" 
                            onclick="SubmitQuestion('${questionCount}', '{{ route('addEvalQuestion') }}')">
                            Save</button>
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
