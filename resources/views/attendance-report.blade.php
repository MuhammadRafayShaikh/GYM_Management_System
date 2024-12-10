@extends('master')

@section('content')
    <div class="message"></div>
    <div class="container">
        <div class="admin-content">
            <div class="card mb-4">
                <div class="card-header">
                    <h2 class="d-inline">Attendance Report</h2>
                </div>
                <div class="card-body position-relative">
                    <form class="yourform" id="attendance-report" action="" method="post" autocomplete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" id="start_date" class="form-control start_date" name="start_date"
                                        value="" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="date" id="end_date" class="form-control endd_date" name="endd_date"
                                        value="" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <input type="submit" id="getReport" name="saves" class="btn btn-info float-right"
                                    style="margin-top:31px;" value="Take/View Report" required>
                                <a href="#" id="attendancePDF" class="btn btn-warning float-right">Download PDF</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="attendance-report">
                <div class="card">
                    <div class="card-header bg-info">
                        <h2 class="d-inline text-white">Attendance Report List</h2>
                    </div>
                    <div class="card-body">
                        <table class="attendance-table table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>S.No</th>
                                    <th>Member Photo</th>
                                    <th>Member Name</th>
                                    <th>Group Name</th>
                                    <th>Attendance Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="data">

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
            $("#getReport").on('click', function() {
                var start_date = $("#start_date").val();
                var end_date = $("#end_date").val();

                $.ajax({
                    url: '/api/reports',
                    type: 'GET',
                    data: {
                        start_date: start_date,
                        end_date: end_date
                    },
                    success: function(response) {
                        console.log(response);

                        $("#data").empty();

                        $.each(response.members, function(key, value) {

                            console.log(value);


                            if (value.member.image != null && value.member.image !=
                                "") {
                                image = `<img src="uploads/${value.member.image}" width="40px" height="40px"
                                            style="border-radius:50%; object-fit: cover;" alt="">`
                            } else {
                                image = value.member.gender == "male" ? `<img src="images/member/man.png" width="40px" height="40px"
                                            style="border-radius:50%; object-fit: cover;" alt="">` : `<img src="images/member/woman.png" width="40px" height="40px"
                                            style="border-radius:50%; object-fit: cover;" alt="">`
                            }

                            if (value.status == 1) {
                                var status = "Present"
                            } else {
                                var status = "Absent"
                            }
                            var output =
                                `
                                    <tr>
                                        <td>${value.id}</td>
                                        <td>${image}</td>
                                        <td>${value.member.fname + ' ' + value.member.lname}</td>
                                        <td>${value.group.name}</td>
                                        <td>${value.attendance_date}</td>
                                        <td>${status}</td>
                                    </tr>
                                 `
                            $("#data").append(output)
                        })
                    }
                })
            })


            $("#attendancePDF").on('click', function() {
                var start_date = $("#start_date").val();
                var end_date = $("#end_date").val();

                var pdfurl = `
                {{ route('memberAttendancePDF') }}?start_date=${start_date}&end_date=${end_date}
                `;

                window.location.href = pdfurl;
            })
        })
    </script>
@endsection
