@extends('master')

@section('content')
    <div class="container">
        <div class="admin-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Edit Staff Member</h2>
                    <a href="staff-member.php" class="btn btn-success float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                        </svg>
                        Staff Member List
                    </a>
                </div>
                <div class="card-body position-relative">
                    <div class="message"></div>

                    <form class="yourform" id="update-staff" action="" method="post" autocomplete="off">
                        <h6 class="border-bottom pb-2 mb-4">Personal Information</h6>
                        <div class="form-group">
                            <input type="hidden" id="staff_id" name="staff_id" value="{{ $staffmember->id }}">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file"
                                onchange="document.querySelector('#image').src=window.URL.createObjectURL(this.files[0])"
                                class="new_logo image" id="new_image" name="new_image" />
                            <input type="hidden" class="old_logo image" id="old_image" name="old_image"
                                value="{{ $staffmember->image }}">
                            @if ($staffmember->image != '' || $staffmember->image != null)
                                <img id="image" src="/uploads/{{ $staffmember->image }}" width="50px" />
                                <a id="removeImg" class="btn btn-warning float-right">Remove Image</a>
                            @else
                                @if ($staffmember->gender == 'male')
                                    <img id="image" src="/images/member/man.png" width="50px" />
                                @else
                                    <img id="image" src="/images/member/woman.png" width="50px" />
                                @endif
                            @endif

                            <select id="imageDropdown" class="form-control mt-4" style="display: none;">
                                <option value="1" selected>Remove Image</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control fname" id="fname" name="fname"
                                value="{{ $staffmember->fname }}" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control lname" id="lname" name="lname"
                                value="{{ $staffmember->lname }}" required>
                        </div>
                        <div class="form-group">
                            <label class="mr-2 mb-0">Gender: </label>
                            @if ($staffmember->gender == 'male')
                                <label for="" class="mb-0 mr-2">
                                    <input type="radio" class="mr-1 gender" id="gender" name="gender" value="male"
                                        checked="">
                                    Male
                                </label>
                                <label for="" class="mb-0 mr-2">
                                    <input type="radio" class="mr-1 gender" id="gender" name="gender" value="female">
                                    Female
                                </label>
                            @else
                                <label for="" class="mb-0 mr-2">
                                    <input type="radio" class="mr-1 gender" id="gender" name="gender" value="male">
                                    Male
                                </label>
                                <label for="" class="mb-0">
                                    <input type="radio" class="mr-1 gender" id="gender" name="gender" value="female"
                                        checked="">
                                    Female
                                </label>
                            @endif

                        </div>
                        <div class="form-group">
                            <label>Date Of Birth</label>
                            <input type="date" class="form-control birth" id="birth" name="birth"
                                value="{{ $staffmember->birth }}" required>
                        </div>
                        <div class="form-group">
                            <label>Assign Role</label>

                            <select class="form-control select2 role" name="role" multiple="multiple"
                                style="width:100%;" id="role" required>
                                @foreach ($roles as $role)
                                    <option @if (in_array($role->id, $roleIds)) selected @endif value="{{ $role->id }}">
                                        {{ $role->name }}</option>
                                @endforeach


                            </select>

                        </div>
                        <div class="form-group">
                            <label>Specialization</label>
                            <select class="form-control select2 speci" name="special" multiple="multiple"
                                style="width:100%;" id="special" required>
                                @foreach ($specializations as $specialization)
                                    <option value="{{ $specialization->id }}"
                                        @if (in_array($specialization->id, $specialIds)) selected @endif>
                                        {{ $specialization->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>



                        <h6 class="border-bottom pb-2 mb-3">Contact Information</h6>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control address" id="address" name="address"
                                value="{{ $staffmember->address }}" required>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control city" id="city" name="city"
                                value="{{ $staffmember->city }}" required>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control state" id="state" name="state"
                                value="{{ $staffmember->state }}" required>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" class="form-control phone" id="phone" name="phone"
                                value="{{ $staffmember->phone }}" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control email" id="email" name="email"
                                value="{{ $staffmember->email }}" required>
                        </div>
                        <input type="submit" id="updateStaff" name="save" class="btn btn-info float-right"
                            value="Update" required>
                    </form>

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
            $("#removeImg").on('click', function(e) {
                e.preventDefault();

                // Clear file input and remove the image
                // $("#new_image").style.display("none");
                document.getElementById("new_image").style.display = "none";
                $("#new_image").val('');
                $("#image").remove();

                // Show the dropdown for removing the image
                $("#imageDropdown").show();
            });

            // Update staff button click event
            $("#updateStaff").on('click', function(e) {
                e.preventDefault();

                var id = $("#staff_id").val();
                var fname = $("#fname").val();
                var lname = $("#lname").val();
                var gender = $("input[name='gender']:checked").val();
                var birth = $("#birth").val();
                var address = $("#address").val();
                var city = $("#city").val();
                var state = $("#state").val();
                var phone = $("#phone").val();
                var email = $("#email").val();

                var formData = new FormData();
                formData.append('staff_id', id);
                formData.append('fname', fname);
                formData.append('lname', lname);
                formData.append('gender', gender);
                formData.append('birth', birth);
                formData.append('address', address);
                formData.append('city', city);
                formData.append('state', state);
                formData.append('phone', phone);
                formData.append('email', email);

                // Append roles and specializations as arrays
                var roles = $("#role").val();
                if (roles) {
                    roles.forEach(function(role) {
                        formData.append('role[]', role);
                    });
                }
                var specials = $("#special").val();
                if (specials) {
                    specials.forEach(function(special) {
                        formData.append('special[]', special);
                    });
                }

                // Append the image data
                if ($("#new_image")[0].files.length > 0) {
                    formData.append('new_image', $("#new_image")[0].files[0]);
                } else if ($("#imageDropdown").is(":visible")) {
                    formData.append('imageDropdown', $("#imageDropdown").val());
                } else {
                    formData.append('old_image', $("#old_image").val());
                }


                $.ajax({
                    url: `/api/staffMember/${id}`,
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-HTTP-Method-Override': 'PUT',
                    },
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // console.log(response);
                        alert(response.message);
                        window.location.href = '/showStaff'
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endsection
