@extends('master')

@section('content')
    <div class="container">
        <div class="admin-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Membership List</h2>
                    <a href="{{ route('createMembership') }}" class="btn btn-info float-right">Add New Membership</a>
                </div>
                <div class="card-body position-relative">
                    <div class="message"></div>
                    <div id="table-data">

                        <table class="table-data table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Period</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="data">

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td> days</td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <ul class="action-list">
                                            <li><a href="view-membership.php?msid=" class="btn btn-success btn-sm"><img
                                                        src="images/eye.png" alt=""></a></li>
                                            <li><a href="update-membership.php?msid=" class="btn btn-primary btn-sm"><img
                                                        src="images/edit.png" alt=""></a></li>
                                            <li><a href="#" data-msid=""
                                                    class="btn btn-danger btn-sm delete-membership"><img
                                                        src="images/delete.png" alt=""></a></li>
                                        </ul>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            function loadData() {
                $.ajax({
                    url: 'api/membership',
                    type: 'GET',
                    success: function(response) {
                        // console.log(response);
                        $("#data").empty()

                        $.each(response.memberships, function(key, value) {
                            const url = `editShowMembership/${value.id}`;
                            var output =
                                `
                 <tr>
                                    <td>${value.id}</td>
                                    <td>${value.name}</td>
                                    <td>${value.period} days</td>
                                    <td>${value.category.category_name}</td>
                                    <td>${value.amount}</td>
                                    <td>
                                        <ul class="action-list">
                                            <li><a href="view-membership.php?msid=" class="btn btn-success btn-sm"><img
                                                        src="images/eye.png" alt=""></a></li>
                                            <li><a href="${url}" class="btn btn-primary btn-sm"><img
                                                        src="images/edit.png" alt=""></a></li>
                                            <li><a href="#" data-msid=""
                                                    class="btn btn-danger btn-sm delete-membership"><img
                                                        src="images/delete.png" alt=""></a></li>
                                        </ul>
                                    </td>
                                </tr>
                `

                            $("#data").append(output)
                        })
                    }
                })
            }
            loadData();
        })
    </script>
@endsection
