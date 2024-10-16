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
                                Expenses
                            </h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">

                        <!-- Set Meal Budget Table -->
                        <div class="card-body">
                            <h2 class="m-3">Set Meal Budget</h2>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Expense Type</th>
                                        <th>Set Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Morning Snacks</td>
                                        <td>
                                            <input type="number" class="form-control" name="budget[morning_snacks]"
                                                placeholder="Enter price for morning snacks" min="0"
                                                step="0.01">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Lunch</td>
                                        <td>
                                            <input type="number" class="form-control" name="budget[lunch]"
                                                placeholder="Enter price for lunch" min="0" step="0.01">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Afternoon Snacks</td>
                                        <td>
                                            <input type="number" class="form-control" name="budget[afternoon_snacks]"
                                                placeholder="Enter price for afternoon snacks" min="0"
                                                step="0.01">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dinner</td>
                                        <td>
                                            <input type="number" class="form-control" name="budget[dinner]"
                                                placeholder="Enter price for dinner" min="0" step="0.01">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary w-100">Save Meal Budget</button>
                        </div>

                        {{-- set meal expenses table --}}
                        <div class="card-body">
                            <h2 class="m-3"> Meal Expenses </h2>
                            <form id="committeemembers">
                                @csrf
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Committee Name</th>
                                            <th>Set Expense Type</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="committeeMembersTable">
                                        @foreach ($committees as $committee)
                                            <tr data-committee-id="{{ $committee->id }}">
                                                <td>{{ $committee->name }}</td>
                                                <td>
                                                    <div class="member-check">
                                                        <label><input type="checkbox"
                                                                name="members[{{ $committee->id }}][snacks][]"
                                                                value="morning_snacks"> Morning Snacks</label><br>
                                                        <label><input type="checkbox"
                                                                name="members[{{ $committee->id }}][snacks][]"
                                                                value="lunch"> Lunch</label><br>
                                                        <label><input type="checkbox"
                                                                name="members[{{ $committee->id }}][snacks][]"
                                                                value="afternoon_snacks"> Afternoon Snacks</label><br>
                                                        <label><input type="checkbox"
                                                                name="members[{{ $committee->id }}][snacks][]"
                                                                value="dinner"> Dinner</label>
                                                    </div>

                                                </td>
                                                <td>
                                                    <input type="text" class="form-control total-amount" name="" placeholder="Total" readonly>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-primary w-100"
                                    onclick="submitCommitteeMembers()">Save Meal Expenses</button>
                            </form>
                        </div>

                        {{-- other expenses table --}}
                        <div class="card-body">
                            <h2 class="m-3">Other Expenses</h2>
                            <table class="table table-bordered" id="additional-expenses-table">
                                <thead>
                                    <tr>
                                        <th>Quantity</th>
                                        <th>Description</th>
                                        <th>Unit Price</th>
                                        <th>Total Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="number" class="form-control qty" name="additional_expenses[0][quantity]" placeholder="Enter quantity" min="0" step="1" oninput="calculateTotal(this)">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="additional_expenses[0][description]" placeholder="Enter description">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control unit-price" name="additional_expenses[0][unit_price]" placeholder="Enter unit price" min="0" step="0.01" oninput="calculateTotal(this)">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control total-amount" name="additional_expenses[0][total_amount]" placeholder="Total" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger remove-expense-btn" onclick="removeExpenseRow(this)">Remove</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-primary" onclick="addExpenseRow()">Add Expense</button>

                        </div>

                    </div>
                </div>
            </div>

            @include('Admin.components.footer')

        </div>
    </div>
    @include('Admin.components.budgetexpensescripts')
    @include('Admin.components.scripts')

</body>

</html>
