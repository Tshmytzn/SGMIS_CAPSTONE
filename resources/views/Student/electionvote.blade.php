<!doctype html>
<html lang="en">

@include('Student.components.head', ['title' => 'Election'])
@include('Student.components.header')
@include('Student.components.nav')

<style>
    /* Styling for container */
    .position-relative {
        position: relative;
    }

    /* Card styling */
    .card-link {
        text-decoration: none;
        color: inherit;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .card-link:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Initially hide the dropdown cards */
    .dropdown-card {
        display: none;
        width: 100%;
        opacity: 0;
        transform: translateY(-20px);
        /* Start from above */
        transition: opacity 0.3s ease, transform 0.3s ease;
        /* Smooth transition */
    }

    .dropdown-card.show {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    /* Style for the submit button */
    .submit-button-container {
        text-align: center;
        margin-top: 20px;
        display: none;
        /* Initially hidden */
    }

    .submit-button-container .btn {
        border-radius: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .submit-button-container .btn:hover {
        background-color: #0056b3;
    }
</style>

@include('Admin.components.adminstyle')
<body>

       <div class="empty" id="sub_body">
                    <div class="empty-img"><img src="{{ asset('./static/illustrations/undraw_voting_nvu7.svg') }}" height="128" alt="">
                    </div>
                    <p class="empty-title" id="notifT">No Available Election</p>
                    <p class="empty-subtitle text-secondary" id="notif">
                      No elections are open for voting at this time.
                    </p>
                  </div>
    <div class="page" id="main_body">
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">Election</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">

                    <div class="container mt-5">
                        <div class="accordion" id="accordionExample">
                            <!-- First Item -->
                            <form action="" id="votingForm" method="post">
                                @csrf
                            
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" id="button1" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" onclick="getCandi('1','1','President')">
                                        <div class="d-flex justify-content-between w-100 px-1">
                                        <span >PRESIDENT</span>
                                        <span id="canLabel1"></span>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <input type="text" name="candi_id1" id="candi_id1" hidden>
                                        <input type="text" name="party_id1" id="party_id1" hidden>
                                        @include('Admin.components.lineLoading', ['loadID' => 'cardload1'])
                                        <div class="row row-cards" id="cards1">

                                            

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" id="button2" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" onclick="getCandi('2','1','Vice President')">
                                        
                                        <div class="d-flex justify-content-between w-100 px-1">
                                        <span >VICE PRESIDENT</span>
                                        <span id="canLabel2"></span>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <input type="text" name="candi_id2" id="candi_id2" hidden>
                                        <input type="text" name="party_id2" id="party_id2" hidden>
                                        @include('Admin.components.lineLoading', ['loadID' => 'cardload2'])
                                        <div class="row row-cards" id="cards2">

                                            

                                        </div>

                                    </div>
                                </div>
                            </div>


                            <!-- SENATORS -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" id="button3" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree" onclick="getCandi('3','1','Senator')">
                                   
                                        <div class="d-flex justify-content-between w-100 px-1">
                                        <span >SENATOR</span>
                                        <span id="canLabel3"></span>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <input type="text" name="candi_id3" id="candi_id3" hidden>
                                        <input type="text" name="party_id3" id="party_id3" hidden>
                                        @include('Admin.components.lineLoading', ['loadID' => 'cardload3'])
                                        <div class="row row-cards" id="cards3">

                                            

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- GOVERNOR -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" id="button4" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour" onclick="getCandi('4','2','Governor')">
                                   
                                        <div class="d-flex justify-content-between w-100 px-1">
                                        <span >GOVERNORS</span>
                                        <span id="canLabel4"></span>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <input type="text" name="candi_id4" id="candi_id4" hidden>
                                        <input type="text" name="party_id4" id="party_id4" hidden>
                                        @include('Admin.components.lineLoading', ['loadID' => 'cardload4'])
                                        <div class="row row-cards" id="cards4">

                                            

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- VICE GOVERNOR -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed" id="button5" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                        aria-expanded="false" aria-controls="collapseFive" onclick="getCandi('5','2','Vice Governor')">
                                       
                                        <div class="d-flex justify-content-between w-100 px-1">
                                        <span >VICE GOVERNOR</span>
                                        <span id="canLabel5"></span>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse"
                                    aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <input type="text" name="candi_id5" id="candi_id5" hidden>
                                        <input type="text" name="party_id5" id="party_id5" hidden>
                                        @include('Admin.components.lineLoading', ['loadID' => 'cardload5'])
                                        <div class="row row-cards" id="cards5">

                                            

                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!-- BSIS REPRESENTATIVE -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSix">
                                    <button class="accordion-button collapsed" id="button6" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false"
                                        aria-controls="collapseSix" onclick="getCandi('6','3','Representative')">
                                        <div class="d-flex justify-content-between w-100 px-1">
                                        <span >BSIS REPRESENTATIVE</span>
                                        <span id="canLabel6"></span>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse"
                                    aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <input type="text" name="candi_id6" id="candi_id6" hidden>
                                        <input type="text" name="party_id6" id="party_id6" hidden>
                                        @include('Admin.components.lineLoading', ['loadID' => 'cardload6'])
                                        <div class="row row-cards" id="cards6">

                                            

                                        </div>

                                    </div>
                                </div>

                            </div>
                            </form>
                        </div>
                        <div class="text-center mt-4 col-12">
                            <Button class="btn btn-primary col-12" type="button" onclick="verify()"> Submit Vote</Button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php
    use Carbon\Carbon;
    $election = App\Models\Election::where('elect_status','1')->first();
    
    if(!$election){
   ?>
   <script>
    document.getElementById('sub_body').style.display = '';
    document.getElementById('main_body').style.display='none'
   </script>
   <?php
    }else{
    
    $vote = App\Models\ElectionVote::where('elect_id',$election->elect_id)->where('student_id',session('student_id'))->first();
    if($vote){
    $start = '';
    $end = '';
        // $url = route('StudentDashboard');
        // header("Location: " . $url);
        // exit();
        ?>
        <script>
            console.log('q')
            document.getElementById('sub_body').style.display = '';
            document.getElementById('notifT').textContent = 'Vote Submitted'
            document.getElementById('notif').textContent = 'Your vote has been submitted and recorded.'
            document.getElementById('main_body').style.display='none'
        </script>
        <?php
    }else{
    $start = $election->elect_start;
    $end = $election->elect_end;
    }  
        ?>
        <script>
    const startDate = new Date('{{$start}}');
    console.log(startDate)
    const endDate = new Date("{{$end}}");
    const currentDate = new Date();
     if (currentDate >= startDate) {
         if (currentDate >= endDate) {
           document.getElementById('sub_body').style.display = '';
        document.getElementById('main_body').style.display='none'
         }else {
        document.getElementById('sub_body').style.display = 'none';
        document.getElementById('main_body').style.display=''               
        }
     }else {
         document.getElementById('sub_body').style.display = '';
        document.getElementById('main_body').style.display='none'  
     }
</script>
        <?php
    }
    
?>

    @include('Student.components.footer')
    @include('Student.components.scripts')
    @include('Student.components.electionvote')

</body>

</html>
