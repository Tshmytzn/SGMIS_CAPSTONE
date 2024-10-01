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

                        <form id="committeeForm">
                            @csrf
                            <div class="mb-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Committee</th>
                                            <th>Person-in-Charge</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="committeeTable">
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" name="committees[0][name]"
                                                    placeholder="Enter committee name" required>
                                            </td>
                                            <td>
                                                <div class="person-in-charge-list">
                                                    <input type="text"
                                                        class="form-control mb-2 person-in-charge-name"
                                                        name="committees[0][persons_in_charge][]"
                                                        placeholder="Enter head(s)" required>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <button type="button"
                                                        class="btn btn-primary add-person-in-charge-btn col-6">Add
                                                        Another Person-in-Charge</button>
                                                    &nbsp;
                                                    <button type="button"
                                                        class="btn btn-danger remove-person-in-charge-btn col-6">Remove
                                                        Person-in-Charge</button>
                                                </div>
                                            </td>
                                            <td class="d-flex justify-content-center">
                                                <button type="button"
                                                    class="btn btn-danger remove-committee-btn col-12">Remove
                                                    Committee</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-primary w-100" id="addCommitteeRow">Add Another
                                    Committee</button>
                                <button type="button" style="background-color: #0065a0 !important; color: #ffffff"
                                    onclick="submitForm()" class="btn w-100 mt-2">Save and Proceed</button>
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
