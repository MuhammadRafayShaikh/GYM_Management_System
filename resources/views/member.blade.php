@extends('master')

@section('content')
    <div class="container">
        <div class="admin-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Member List</h2>
                    <a href="{{ route('createMember') }}" class="btn btn-info float-right m-2">Add Member</a>
                    <a href="{{ route('memberPDF') }}" class="btn btn-warning float-right m-2">Download PDF</a>
                </div>
                <div class="card-body position-relative">
                    <div class="message"></div>
                    <div id="table-data">

                        <table class="table-data table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>S.No</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Join-Expire</th>
                                    <th>Trainer</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th style="width:100px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="data">

                                <tr>
                                    <td></td>
                                    <td>

                                        <img src="images/member/" width="40px" height="40px"
                                            style="border-radius:50%; object-fit: cover;" alt="">

                                        <img src="images/member/" width="40px" height="40px"
                                            style="border-radius:50%; object-fit: cover;" alt="">

                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>


                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <ul class="action-list">
                                            <li><a href="update-member.php?mid=" class="btn btn-primary btn-sm"><img
                                                        src="images/edit.png" alt=""></a></li>
                                            <li><a href="#" data-mid=""
                                                    class="btn btn-danger btn-sm delete-member"><img src="images/delete.png"
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
                    url: 'api/member',
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        $("#data").empty();

                        $.each(response.members, function(key, value) {
                            const url = `editMember/${value.id}`;
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
                            <td><small>${value.start_date + '-' + value.end_date}</small></td>
                            <td>${value.staff_members}</td>
                            <td>${value.phone}</td>
                            <td>${value.email}</td>
                            <td>
                                <ul class="action-list">
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
