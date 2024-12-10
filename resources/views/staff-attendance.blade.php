@extends('master')

@section('content')
    <style>
        .attendance-btn.active {
            opacity: 0.8;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
        }
    </style>
    <div class="message"></div>
    <div class="container">
        <div class="admin-content">
            <div class="card mb-4">
                <div class="card-header">
                    <h2 class="d-inline">Staff Member Attendance</h2>
                </div>
                <div class="card-body">
                    <form class="yourform" id="staff-attendance" action="" method="post" autocomplete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control staff_date" id="staffdate" name="current_date"
                                        value="" required>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="staff-attendance">
                        <div class="card-header bg-info border mb-4">
                            <h5 class="d-inline text-white">Staff Member List</h5>
                        </div>
                        <table class="staff-table table-data table table-bordered">

                            <thead class="thead-light">
                                <tr>
                                    <th>Action</th>
                                    <th>Photo</th>
                                    <th>Staff Member Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody id="data">
                                <tr>
                                    <td>
                                        <input type="text" name="staff_member[]" class="staff_id" id="staff"
                                            value="" hidden>
                                        <div class="checkbox">

                                            <input type="checkbox" name="staff_att[]" class="staff_att" id="checkbox"
                                                checked="">

                                            <input type="checkbox" name="staff_att[]" class="staff_att" id="checkbox">

                                            <input type="checkbox" name="staff_att[]" class="staff_att" id="checkbox"
                                                checked="">

                                            <input type="checkbox" name="staff_att[]" class="staff_att" id="checkbox"
                                                checked="">

                                            <label for="checkbox"></label>
                                        </div>
                                    </td>
                                    <td>

                                        <img src="images/staff-member/" width="40px" height="40px"
                                            style="border-radius:50%; object-fit: cover;" alt="">

                                        <img src="images/staff-member/staff-member.png" width="40px" height="40px"
                                            style="border-radius:50%; object-fit: cover;" alt="">

                                    </td>
                                    <td></td>

                                    <td>Present</td>

                                    <td>Absent</td>

                                    <td>Not Taken</td>

                                    <td>Not Taken</td>

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
            $(".staff-attendance").hide();

            $("#staffdate").on('change', function() {
                var staffdate = $("#staffdate").val();

                $.ajax({
                    url: '/api/getStaffAttendance',
                    type: 'GET',
                    data: {
                        staffdate: staffdate
                    },
                    success: function(response) {
                        $(".staff-attendance").show();
                        $("#data").empty();

                        $.each(response.staff_members, function(key, value) {
                            let attendanceRecord = response.attendance_records[value
                                .id];
                            let attendanceStatus = 'Not Taken';
                            let presentClass = '';
                            let absentClass = '';
                            let presentDisabled = '';
                            let absentDisabled = '';

                            if (attendanceRecord) {
                                if (attendanceRecord.status === 1) {
                                    attendanceStatus = 'Present';
                                    presentClass =
                                        'active'; // Highlight Present button if status is 1
                                    presentDisabled =
                                        'disabled'; // Disable Present button
                                } else if (attendanceRecord.status === 0) {
                                    attendanceStatus = 'Absent';
                                    absentClass =
                                        'active'; // Highlight Absent button if status is 0
                                    absentDisabled =
                                        'disabled'; // Disable Absent button
                                }
                            }

                            // Set image based on gender or existing image
                            let image = value.image ?
                                `<img src="uploads/${value.image}" width="40px" height="40px" style="border-radius:50%; object-fit: cover;" alt="">` :
                                (value.gender === "male" ?
                                    `<img src="images/member/man.png" width="40px" height="40px" style="border-radius:50%; object-fit: cover;" alt="">` :
                                    `<img src="images/member/woman.png" width="40px" height="40px" style="border-radius:50%; object-fit: cover;" alt="">`
                                );

                            var output = `
                                <tr role="row" class="odd">
                                    <td>
                                        <input type="text" name="staff_member[]" class="staff_id" id="staff" value="${value.id}" hidden>

                                        <button class="attendance-btn btn-sm btn btn-success present-btn ${presentClass}" data-staffmember-id="${value.id}" data-status="1" ${presentDisabled}>Present</button>
                                        <button class="attendance-btn btn-sm btn btn-danger absent-btn ${absentClass}" data-staffmember-id="${value.id}" data-status="0" ${absentDisabled}>Absent</button>
                                    </td>
                                    <td>${image}</td>
                                    <td>${value.fname + ' ' + value.lname}</td>
                                    <td class="status-text">${attendanceStatus}</td>
                                </tr>
                            `;

                            $("#data").append(output);
                        });


                        // Attach click events to attendance buttons
                        $(".attendance-btn").on('click', function(event) {
                            event.preventDefault();

                            var staffdate = $("#staffdate").val();
                            var staff_memberId = $(this).data("staffmember-id");
                            var status = $(this).data("status");

                            $.ajax({
                                url: '/api/updateStaffAttendance',
                                type: 'POST',
                                data: {
                                    staffdate: staffdate,
                                    staff_memberId: staff_memberId,
                                    status: status,
                                },
                                success: function(response) {
                                    alert(response.message);

                                    // Update attendance status on button click
                                    const row = $(
                                        `button[data-staffmember-id="${staff_memberId}"]`
                                    ).closest('tr');
                                    row.find('.status-text').text(status ===
                                        1 ? 'Present' : 'Absent');
                                    row.find('.present-btn').toggleClass(
                                        'active', status === 1);
                                    row.find('.absent-btn').toggleClass(
                                        'active', status === 0);
                                }
                            });
                        });
                    }
                });
            });
        });
    </script>
@endsection
