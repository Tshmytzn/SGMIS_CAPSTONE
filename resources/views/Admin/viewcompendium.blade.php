<!doctype html>

<html lang="en">


@include('Admin.components.header', ['title' => 'Compendium'])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>



<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>

    <div class="page">

        @include('Admin.components.nav', ['active' => ''])

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
                                Compendium Name
                            </h2>
                        </div>


                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        @php
                            $com_id = request()->query('com_id');
                        @endphp

                        <div class="col-lg-12" style="height: 100vh; display: flex; flex-direction: column;">
                            <div class="card" style="flex: 1; display: flex; flex-direction: column;">
                                <div class="card-body" style="flex: 1; display: flex; flex-direction: column;">
                                    <h3 class="card-title">Multiple File Upload</h3>
                                    <form class="dropzone" id="dropzone-multiple"
                                        action="{{ route('UploadCompendiumFile') }}" autocomplete="off" novalidate
                                        style="flex: 1; display: flex; flex-direction: column; justify-content: center;">
                                        @csrf
                                        <div class="page-body">
                                            <div class="container-xl">
                                                <div class="row row-deck row-cards" id="comfile"></div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="com_id" id="com_id" value="{{ $com_id }}">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

              {{-- Edit Admin Student Modal --}}
                <div class="modal modal-blur fade" id="viewFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header text-white" style="background-color: #3E8A34;">
                        <h5 class="modal-title" id="staticBackdropLabel">View File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                      <iframe src="" class="displayfile" style="width:600px; height:500px;" frameborder="0"></iframe>
                     {{-- <embed class="displayfile" src="" width="300px" height="auto" /> --}}
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- Edit Student Modal --}}

            @include('Admin.components.footer')

        </div>
    </div>



    @include('Admin.components.scripts')
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/pptxgenjs@3.4.0/dist/pptxgen.min.js"></script>

    @include('Admin.components.functionscript')



</body>

</html>
