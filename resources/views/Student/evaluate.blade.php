<!doctype html>

<html lang="en">

@include('Student.components.head', ['title'=>'Evaluate'])

@php
    $eval = App\Models\Evaluation::where('eval_id', $eval_id)->first();
    $event = App\Models\SchoolEvents::where('event_id', $eval->event_id)->first();
    $question = App\Models\EvalQuestion::where('eval_id', $eval_id)->orderBy('eq_num', 'asc')->get();   
    $num = 1;
@endphp
  <body >
    @include('Admin.components.loading')
    @include('Student.components.header')
@include('Student.components.nav')

    <div class="page">
      <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">
                  <a href="{{ route('ViewDetails') }}?event_id={{ $eval->event_id }}">{{ $event->event_name }}({{ $eval->eval_name }})</a>
                </h2>
              </div>
            </div>
          </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl" id="container">
            <p>Description: {{ $eval->eval_description }}</p>
            <p>Published At: {{ $eval->updated_at }}</p>

            <div class="d-flex justify-content-between w-100 mt-4">
             <h2>Questions</h2>
              <button onclick="SubmitEvaluationStudent()" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mood-edit">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M20.955 11.104a9 9 0 1 0 -9.895 9.847" />
                <path d="M9 10h.01" />
                <path d="M15 10h.01" />
                <path d="M9.5 15c.658 .672 1.56 1 2.5 1c.126 0 .251 -.006 .376 -.018" />
                <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
              </svg> Evaluate this event</button>
            </div>
             <form id="questionList" class="mt-4">
               @csrf
               <input type="hidden" name="student_id" value="{{session('student_id')}}"> 
             </form>
           
          </div>
        </div>
      </div>
    </div>
    @include('Student.components.footer')
    @include('Student.components.scripts')
    <script>
      window.onload = function (){
        LoadEvaluateQuestion("{{ route('loadQuestionEvaluate') }}?eval_id={{ $eval_id }}");
       
      }
    </script>
  </body>
</html>