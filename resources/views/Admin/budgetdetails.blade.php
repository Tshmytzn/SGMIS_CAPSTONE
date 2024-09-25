<!doctype html>

<html lang="en">

@include('Admin.components.header', ['title' => 'Budgeting Details'])
@include('Admin.components.adminstyle')

<body>
    <script src="{{ asset('./dist/js/demo-theme.min.js?1684106062') }}"></script>

    <div class="page">

        @include('Admin.components.nav', ['active' => 'Budgetingdetails'])

        <div class="page-wrapper">

            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">

                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Budgeting Details
                            </div>
                            <h2 class="page-title">
                                Category/Group
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">

                        <form id="committeeForm"
                            onsubmit="event.preventDefault(); submitCommitteeForm('committeeForm');">
                            @csrf

                            <div class="mb-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Committee</th>
                                            <th>Expense Type</th>
                                            <th>Person-in-Charge</th>
                                            <th>Members</th>
                                            <th>Total Members</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="committeeTable">
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter committee name" required>
                                            </td>
                                            <td>
                                                <label><input type="checkbox" name="committees[0][expense_types][]"
                                                        value="Morning Snacks"> Morning Snacks</label><br>
                                                <label><input type="checkbox" name="committees[0][expense_types][]"
                                                        value="Lunch"> Lunch</label><br>
                                                <label><input type="checkbox" name="committees[0][expense_types][]"
                                                        value="Afternoon Snacks"> Afternoon Snacks</label><br>
                                                <label><input type="checkbox" name="committees[0][expense_types][]"
                                                        value="Dinner"> Dinner</label><br>
                                            </td>

                                            <td>
                                                <div class="person-in-charge-list">
                                                    <input type="text"
                                                        class="form-control mb-2 person-in-charge-name"
                                                        name="committees[0][persons_in_charge][]"
                                                        placeholder="Enter head(s)" required>
                                                </div>
                                                <button type="button"
                                                    class="btn btn-primary add-person-in-charge-btn">Add Another
                                                    Person-in-Charge</button>
                                            </td>
                                            <td>
                                                <div class="member-list">
                                                    <input type="text" class="form-control mb-2 member-name"
                                                        name="committees[0][members][]" placeholder="Enter member name"
                                                        required>
                                                </div>
                                                <button type="button" class="btn btn-primary w-100 add-member-btn">Add
                                                    Member</button>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control total-members" value="2"
                                                    readonly>
                                                <!-- Initial count of 2 -->
                                            </td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-danger remove-committee-btn">Remove
                                                    Committee</button>
                                                <!-- Remove Committee Button -->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-primary w-100" id="addCommitteeRow">Add Another
                                    Committee</button>
                                <button type="submit" style="background-color: #0065a0 !important; color: #ffffff"
                                    class="btn w-100 mt-2">Save Changes</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @include('Admin.components.footer')

        </div>
    </div>

    @include('Admin.components.scripts')
    @include('Admin.components.budgetdetailsscripts')

</body>

</html>
