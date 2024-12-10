@extends('master')

@section('content')
    <style>
        /* Button Styling */
        /* .attendance-btn {
                                                                    padding: 10px 20px;
                                                                    font-size: 16px;
                                                                    border: none;
                                                                    border-radius: 8px;
                                                                    font-weight: bold;
                                                                    cursor: pointer;
                                                                    transition: transform 0.2s ease, box-shadow 0.2s ease;
                                                                } */

        .present-btn {
            background-color: #28a745;
            /* Green for Present */
            color: white;
            box-shadow: 0px 4px 10px rgba(40, 167, 69, 0.3);
        }

        .absent-btn {
            background-color: #dc3545;
            /* Red for Absent */
            color: white;
            box-shadow: 0px 4px 10px rgba(220, 53, 69, 0.3);
        }

        .attendance-btn:hover {
            transform: scale(1.05);
            /* Slightly enlarge the button on hover */
            box-shadow: 0px 6px 14px rgba(0, 0, 0, 0.2);
        }

        .attendance-btn:active {
            transform: scale(0.95);
            /* Shrink the button slightly on click */
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.15);
        }

        .attendance-btn.fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
    <div class="message"></div>
    <div class="container">
        <div class="admin-content">
            <div class="card mb-4">
                <div class="card-header">
                    <h2 class="d-inline">Member Attendance</h2>
                </div>
                <div class="card-body position-relative">
                    <form class="yourform" id="show-attendance" action="" method="post" autocomplete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" id="attendanceDate" class="form-control date" name="date"
                                        value="" required>
                                </div>
                            </div>
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label>Group</label>
                                    <select class="form-control select2 group" id="group" name="group[]"
                                        multiple="multiple" style="width:100%;" required>
                                        <option value="" disabled>Select Group</option>

                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                            </div>

                            <div class="col-md-3">
                                <input type="submit" id="memberAttendance" name="save" class="btn btn-info float-right"
                                    style="margin-top:31px;" value="Take/View Attendance" required>
                                {{-- <a href="" id="memberPDF" class="btn btn-warning">Download PDF</a> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="member-attendance">
                <div class="card">
                    <div class="card-header bg-info">
                        <h5 class="d-inline text-white">Member List</h5>
                    </div>
                    <div class="card-body">
                        <table class="member-table table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Action</th>
                                    <th>Member Photo</th>
                                    <th>Member Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="data">
                                <tr role="row" class="odd">
                                    <td class="sorting_1">
                                        <input type="text" name="member[]" class="member_id" id="member4"
                                            value="1" hidden>
                                        <div class="checkbox">
                                            <input type="checkbox" name="att[]" class="att" id="checkbox4" checked>
                                            <label for="checkbox4">

                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <img src="" width="40px" height="40px"
                                            style="border-radius: 50%; object-fit: cover;" alt="">
                                    </td>
                                    <td>xyz</td>
                                    <td>taken</td>
                                </tr>
                            </tbody>
                        </table>

                        {{-- <button type="button" class="save-att btn btn-dark mt-2" name="button">Save</button> --}}

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
            $(".member-attendance").hide();
            $("#memberAttendance").on('click', function() {
                var formData = {
                    group: $("#group").val(),
                    date: $(".date").val() // Add date if required
                };

                $.ajax({
                    url: '/api/getmemberAttendance',
                    type: 'GET',
                    data: formData,
                    success: function(response) {
                        console.log(response);

                        if (!response.error) {
                            $(".member-attendance").show();
                            $("#data").empty();
                            $.each(response.members, function(key, value) {
                                var image;
                                if (value.image != "" && value.image != null) {
                                    image =
                                        `<img src="uploads/${value.image}" width="40px" height="40px" style="border-radius: 50%; object-fit: cover;" alt="">`;
                                } else {
                                    image = value.gender == "male" ?
                                        `<img src="images/member/man.png" width="40px" height="40px" style="border-radius: 50%; object-fit: cover;" alt="">` :
                                        `<img src="images/member/woman.png" width="40px" height="40px" style="border-radius: 50%; object-fit: cover;" alt="">`;
                                }

                                var attendanceStatus = value.attendance_taken ==
                                    'taken' ? value.attendance_status : 'Not Taken';

                                // Set the disabled property based on attendance status
                                var presentDisabled = attendanceStatus === 'Present' ?
                                    'disabled' : '';
                                var absentDisabled = attendanceStatus === 'Absent' ?
                                    'disabled' : '';

                                var output = `
                            <tr role="row" class="odd">
                                <td class="sorting_1">
                                    <button class="attendance-btn btn-sm btn btn-success present-btn fade-in" data-member-id="${value.id}" data-group-id="${response.groupIds}" data-status="1" ${presentDisabled}>Present</button>
                                    <button class="attendance-btn btn-sm btn btn-danger absent-btn fade-in" data-member-id="${value.id}" data-group-id="${response.groupIds}" data-status="0" ${absentDisabled}>Absent</button>
                                </td>
                                <td>
                                    ${image}
                                </td>
                                <td>${value.fname + ' ' + value.lname}</td>
                                <td class="status-text">${attendanceStatus}</td>
                            </tr>
                        `;
                                $("#data").append(output);
                            });

                            // Attendance button click logic
                            $(".attendance-btn").on('click', function() {
                                var $button = $(this);
                                var attendanceDate = $("#attendanceDate").val();
                                var memberId = $button.data('member-id');
                                var groupId = $button.data('group-id');
                                var status = $button.data('status');
                                var currentStatusText = $button.closest('tr').find(
                                    '.status-text').text().toLowerCase();

                                // Check if the current status matches the clicked button's status
                                if ((status === 1 && currentStatusText === 'present') ||
                                    (status === 0 && currentStatusText === 'absent')) {
                                    alert(
                                        'Attendance for this status has already been marked!'
                                    );
                                    return; // Prevent further execution
                                }

                                var formData = {
                                    date: attendanceDate,
                                    member_id: memberId,
                                    group_id: groupId,
                                    status: status
                                };

                                $.ajax({
                                    url: '/api/updateAttendance',
                                    type: 'POST',
                                    data: formData,
                                    success: function(response) {
                                        alert(response.message);

                                        // Update the status text in the row
                                        if (status === 1) {
                                            $button.closest('tr').find(
                                                '.status-text').text(
                                                'Present');
                                            // Disable the "Present" button and enable the "Absent" button
                                            $button.prop('disabled', true);
                                            $button.siblings('.absent-btn')
                                                .prop('disabled', false);
                                        } else {
                                            $button.closest('tr').find(
                                                '.status-text').text(
                                                'Absent');
                                            // Disable the "Absent" button and enable the "Present" button
                                            $button.prop('disabled', true);
                                            $button.siblings('.present-btn')
                                                .prop('disabled', false);
                                        }
                                    },
                                    error: function(xhr) {
                                        alert('Error updating attendance!');
                                    }
                                });
                            });

                        } else {
                            $(".member-attendance").show();
                            $("#data").empty();
                            $("#data").append(
                                `<tr class="text-center"><td colspan="4">${response.error}</td></tr>`
                            )
                        }
                    },

                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });

                
            });

           
        });
    </script>
@endsection
