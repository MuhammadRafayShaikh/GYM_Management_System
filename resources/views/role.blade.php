@extends('master')

@section('content')
    <div class="message"></div>
    <div class="container">
        <div class="admin-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Role List</h2>
                    <a href="{{ route('createRole') }}" class="btn btn-info float-right">Add New Role</a>
                </div>
                <div class="card-body position-relative">
                    <div id="table-data">

                        <table class="table-data table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>S.No</th>
                                    <th>Role Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="data">

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <ul class="action-list">
                                            <li><a href="update-role.php?roid=" class="btn btn-primary btn-sm"><img
                                                        src="images/edit.png" alt=""></a></li>
                                            <li><a href="#" data-roid=""
                                                    class="btn btn-danger btn-sm delete-role"><img src="images/delete.png"
                                                        alt=""></a></li>
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
                // jQuery AJAX request example
                $.ajax({
                    url: '/api/role', // your API endpoint
                    type: 'GET',

                    success: function(response) {
                        console.log(response);
                        $("#data").empty();

                        $.each(response.roles, function(key, value) {
                            const url = `editRole/${value.id}`
                            var output =
                                `
                           <tr>
                                    <td>${value.id}</td>
                                    <td>${value.name}</td>
                                    <td>
                                        <ul class="action-list">
                                            <li><a href="${url}" class="btn btn-primary btn-sm"><img
                                                        src="images/edit.png" alt=""></a></li>
                                            <li><a href="#" data-roid=""
                                                    class="btn btn-danger btn-sm delete-role"><img src="images/delete.png"
                                                        alt=""></a></li>
                                        </ul>
                                    </td>
                                </tr>
                          `
                            $("#data").append(output)

                        })
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', error);
                    }
                });

            }
            loadData();
        })
    </script>
@endsection
