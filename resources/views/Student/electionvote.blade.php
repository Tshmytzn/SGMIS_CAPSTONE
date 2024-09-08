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
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

/* Initially hide the dropdown cards */
.dropdown-card {
    display: none;
    width: 100%;
    opacity: 0;
    transform: translateY(-20px); /* Start from above */
    transition: opacity 0.3s ease, transform 0.3s ease; /* Smooth transition */
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
    display: none; /* Initially hidden */
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

<body>
    <div class="page">
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
                    <div class="col-md-12 col-lg-12">
                        <div id="container">
                            <!-- Initial Vote Here card -->
                            <div class="position-relative mb-4">
                                <a href="#" class="card card-link card-link-pop p-3" id="vote-card-1">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">President</h5>
                                    </div>
                                </a>
                                <div class="dropdown-card" id="dropdown-card-1">
                                    <div class="row row-cards">
                                        <div class="col-md-6 col-lg-3 mb-4">
                                            <div class="card card-link card-link-pop">
                                                <img src="{{ asset('/student_images/student.png') }}" class="card-img-top" alt="Student Image">
                                                <div class="card-body text-center">
                                                    <h6 class="card-title">Student Name - 1</h6>
                                                    <p class="card-text text-muted">Position - President</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Placeholder for additional Vote Here cards -->
                            <div id="additional-cards"></div>

                            <!-- Submit button -->
                            <div class="submit-button-container">
                                <button type="button" class="btn btn-primary" id="submit-vote">Submit Vote</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Student.components.footer')
    @include('Student.components.scripts')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var cardCount = 1; // Start with the first card
            var positions = ['President', 'Vice President', 'Secretary', 'Treasurer', 'Public Relations Officer', 'Member']; // Define positions
            var isLastCardRevealed = false; // Flag to track if the last card is revealed

            $('#container').on('click', '.card-link', function(e) {
                e.preventDefault(); // Prevent the default anchor click behavior

                var clickedCardId = $(this).attr('id');
                var clickedCardNumber = parseInt(clickedCardId.split('-')[2]);

                if (isLastCardRevealed && clickedCardNumber === cardCount - 1) {
                    // If the last card is revealed and it is clicked, show the student card
                    var lastDropdownId = '#dropdown-card-' + (cardCount - 1);
                    var $lastDropdown = $(lastDropdownId);

                    if ($lastDropdown.hasClass('show')) {
                        // If the last dropdown is already visible, hide it
                        $lastDropdown.removeClass('show');
                    } else {
                        // Otherwise, show the last dropdown
                        $('.dropdown-card').not($lastDropdown).removeClass('show');
                        $lastDropdown.addClass('show');
                    }
                    return; // Prevent further action
                }

                // Proceed to reveal the next card if it’s not the last one
                if (!isLastCardRevealed) {
                    var currentDropdownId = '#dropdown-card-' + clickedCardNumber;
                    var $currentDropdown = $(currentDropdownId);

                    if ($currentDropdown.hasClass('show')) {
                        // If the current dropdown is already visible, hide it
                        $currentDropdown.removeClass('show');
                    } else {
                        // Otherwise, show the current dropdown and add the next Vote Here card below
                        $('.dropdown-card').not($currentDropdown).removeClass('show');
                        $currentDropdown.addClass('show');

                        // Increment cardCount and add a new Vote Here card below
                        cardCount++;
                        var nextCardId = 'vote-card-' + cardCount;
                        var nextDropdownId = 'dropdown-card-' + cardCount;

                        // Get the next position from the array
                        var nextPosition = positions[cardCount - 1] || 'Position';

                        if (nextPosition === 'Member') {
                            isLastCardRevealed = true; // Set the flag to true if the last card is revealed
                        }

                        $('#additional-cards').append(`
                            <div class="position-relative mb-4">
                                <a href="#" class="card card-link card-link-pop p-3" id="${nextCardId}">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">${nextPosition}</h5>
                                    </div>
                                </a>
                                <div class="dropdown-card" id="${nextDropdownId}">
                                    <div class="row row-cards">
                                        <div class="col-md-6 col-lg-3 mb-4">
                                            <div class="card card-link card-link-pop">
                                                <img src="{{ asset('/student_images/student.png') }}" class="card-img-top" alt="Student Image">
                                                <div class="card-body text-center">
                                                    <h6 class="card-title">Student Name - ${cardCount}</h6>
                                                    <p class="card-text text-muted">Position - ${nextPosition}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `);

                        // Show the submit button if the last card is revealed
                        if (isLastCardRevealed) {
                            $('.submit-button-container').show();
                        }
                    }
                }
            });

            $('#submit-vote').click(function() {
                alert('Vote submitted!');
                // Add form submission logic or other actions here
            });
        });
    </script>
</body>

</html>
