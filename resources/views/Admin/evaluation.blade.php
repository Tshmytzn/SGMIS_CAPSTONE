<!doctype html>

<html lang="en">
  
@include('Admin.components.header' , ['title' => 'Evaluation'])

  <body >
    <script src="{{asset('./dist/js/demo-theme.min.js?1684106062')}}"></script>

    <div class="page">

@include('Admin.components.nav' , ['active' => 'Evaluation'])

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
                  Evaluations
                </h2>
              </div>
              <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                  <div class="me-3">
                    <div class="input-icon">
                      <input type="text" value="" class="form-control" placeholder="Search…">
                      <span class="input-icon-addon">
                       <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                      </span>
                  </div>
                  </div>
  
                      <button class="btn" style="background-color: #DF7026; color: white;" data-bs-toggle="modal" data-bs-target="#createevaluation">Create Evaluation Form</button>
      
              </div>
            </div>
              

            </div>
          </div>
        </div>
        
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            <div class="row row-deck row-cards">
              

            </div>
          </div>
        </div>

        {{-- Modal --}}
{{-- Create Evaluation Modal --}}
<div class="modal modal-blur fade" id="createevaluation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header text-white" style="background-color: #3E8A34;">
        <h5 class="modal-title" id="staticBackdropLabel">Create Evaluation Form</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row g-3" id="createeval" method="POST" enctype="multipart/form-data">@csrf
          <div class="row g-2">
              <div class="col-12">
                  <label for="firstname" class="form-label">Associated Event</label>
                  <select name="" class="form-select" id="">
                      <option selected>Select Event</option>
                      <option value="">event #1</option>
                      <option value="">event #1</option>
                      <option value="">event #1</option>
                  </select>
              </div>
              <div class="col-12">
                  <label for="evalname" class="form-label">Evaluation Name</label>
                  <input type="text" class="form-control" name="evalname" id="evalname" placeholder="Evaluation Name">
              </div>
              <div class="col-12">
                  <label for="evaldesc" class="form-label">Evaluation Description</label>
                  <textarea class="form-control" name="evaldesc" id="evaldesc" placeholder="Add Short Description here..." cols="10" rows="2"></textarea>
              </div>
              <hr class="my-4 mt-3 mb-2">
              <div class="col-11">
                  <label for="evalname" class="form-label">Evaluation Questions</label>
              </div>
              <div class="col-1" id="addQuestion">
                  <span class="add-question-btn">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pencil-plus">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                          <path d="M13.5 6.5l4 4" />
                          <path d="M16 19h6" />
                          <path d="M19 16v6" />
                      </svg>
                  </span>
              </div>
              
          </div>
      </form>      

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="()">Save</button>
      </div>
    </div>
  </div>
</div>
{{-- Create Evaluation modal --}}
        {{-- Modal --}}


@include('Admin.components.footer')

      </div>
    </div>
    
    
@include('Admin.components.scripts')
{{-- scripts --}}
<script>
  document.addEventListener("DOMContentLoaded", function () {
      const addQuestionBtn = document.querySelector('.add-question-btn');
      const form = document.getElementById('createeval');

      addQuestionBtn.addEventListener('click', function () {
          const questionInputs = form.querySelectorAll('.question-input');
          const lastQuestionInput = questionInputs[questionInputs.length - 1];
          const newQuestionInput = document.createElement('input');
          newQuestionInput.setAttribute('type', 'text');
          newQuestionInput.setAttribute('class', 'form-control question-input');
          newQuestionInput.setAttribute('name', 'evalname');
          newQuestionInput.setAttribute('placeholder', 'Question ' + (questionInputs.length + 1));
          form.appendChild(newQuestionInput); // Append the new input to the form
      });
  });
</script>

{{-- scripts --}}

  </body>
</html>