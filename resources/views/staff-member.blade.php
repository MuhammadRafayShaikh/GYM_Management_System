@extends('master')

@section('content')
    <div class="container">
        <div class="admin-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Staff Member List</h2>
                    <a href="{{ route('createStaff') }}" class="btn btn-info float-right m-2">Add Staff Member</a>
                    <a href="{{ route('staffPDF') }}" class="btn btn-warning float-right m-2">Download PDF</a>
                </div>
                <div class="card-body position-relative">
                    <div class="message"></div>
                    <div id="table-data">

                        <table class="table-data table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>S.No</th>
                                    <th>Photo</th>
                                    <th>Staff Member Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Mobile No.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="data">

                                <tr>
                                    <td></td>
                                    <td>

                                        <img src="images/staff-member/" width="40px" height="40px"
                                            style="border-radius:50%; object-fit: cover;" alt="">

                                        <img src="images/staff-member/" width="40px" height="40px"
                                            style="border-radius:50%; object-fit: cover;" alt="">

                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <ul class="action-list">
                                            <li><a href="view-staff-member.php?stid=" class="btn btn-success btn-sm"><img
                                                        src="images/eye.png" alt=""></a></li>
                                            <li><a href="update-staff.php?stid=" class="btn btn-primary btn-sm"><img
                                                        src="images/edit.png" alt=""></a></li>
                                            <li><a href="#" data-stid=""
                                                    class="btn btn-danger btn-sm delete-staff"><img src="images/delete.png"
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
                $.ajax({
                    url: 'api/staffMember',
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        $("#data").empty();

                        $.each(response.staffmembers, function(key, value) {
                            const url = `editStaff/${value.id}`;
                            if (value.image != "" && value.image != null) {
                                var picture = `<img src="uploads/${value.image}" width="40px" height="40px"
                                            style="border-radius:50%; object-fit: cover;" alt="">`
                            } else {
                                if (value.gender == "male") {
                                    var picture = `<img src="images/member/man.png" width="40px" height="40px"
                                            style="border-radius:50%; object-fit: cover;" alt="">`
                                } else {
                                    var picture = `<img src="images/member/woman.png" width="40px" height="40px"
                                            style="border-radius:50%; object-fit: cover;" alt="">`
                                }
                            }
                            var output =
                                `
                            <tr>
                                    <td>${value.id}</td>
                                    <td>

                                        ${picture}

                                    </td>
                                    <td>${value.fname + ' '+ value.lname}</td>
                                    <td>${value.roles}</td>
                                    <td>${value.email}</td>
                                    <td>${value.phone}</td>
                                    <td>
                                        <ul class="action-list">
                                            <li><a href="" class="btn btn-success btn-sm"><img
                                                        src="images/eye.png" alt=""></a></li>
                                            <li><a href="${url}" class="btn btn-primary btn-sm"><img
                                                        src="images/edit.png" alt=""></a></li>
                                            <li><a href="#" data-stid=""
                                                    class="btn btn-danger btn-sm delete-staff"><img src="images/delete.png"
                                                        alt=""></a></li>
                                        </ul>
                                    </td>
                                </tr>

                            `
                            $("#data").append(output);
                        })
                    }
                })
            }
            loadData();
        })
    </script>
@endsection
