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


                            <div class="display-flex justify-content-end col-12 gap-2">

                                <a href="{{ route('ViewEvaluations') }}?eval_id={{ $eval_id }}" class="btn btn-outline-secondary" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-big-left-lines">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 15v3.586a1 1 0 0 1 -1.707 .707l-6.586 -6.586a1 1 0 0 1 0 -1.414l6.586 -6.586a1 1 0 0 1 1.707 .707v3.586h3v6h-3z" />
                                        <path d="M21 15v-6" />
                                        <path d="M18 15v-6" />
                                      </svg> Back
                                </a>
                                <button class="btn btn-outline-info" id="refreshResult">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-rotate-clockwise">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5" />
                                      </svg> Refresh
                                </button>
                            </div>



                    </div>

                </div>

                <div  id="evaluationResultCharts">

                </div>



            </div>

            @include('Admin.components.footer')

        </div>
    </div>


    @include('Admin.components.scripts')
    <script src="/dist/libs/apexcharts/dist/apexcharts.min.js?1684106062" defer></script>
    <script>
 window.onload = () => {
    LoadEvaluationResults('{{ $eval_id }}');
 }

    </script>
</body>

</html>
