@extends('master')

@section('content')
    <div class="container">
        <div class="admin-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Edit Member</h2>
                    <a href="member.php" class="btn btn-success float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                        </svg>
                        Member List
                    </a>
                </div>
                <div class="card-body position-relative">
                    <div class="message"></div>

                    <form class="yourform" id="update-member" action="" method="post" autocomplete="off">
                        <h5 class="border-bottom pb-2 mb-4">Personal Information</h5>
                        <div class="form-group">
                            <input type="hidden" name="member_id" id="member_id" value="{{ $member->id }}">
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file"
                                onchange="document.querySelector('#image').src=window.URL.createObjectURL(this.files[0])"
                                class="new_logo image" id="new_image" name="new_image" />
                            <input type="hidden" class="old_logo image" name="old_image" id="old_image"
                                value="{{ $member->image }}">

                            @if ($member->image != null)
                                <img id="image" src="{{ '/uploads/' . $member->image }}" width="50px" />
                                <a id="removeImg" class="btn btn-warning float-right">Remove Image</a>
                            @else
                                @if ($member->gender == 'male')
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
                            <input type="text" class="form-control fname" id="fname" placeholder="First Name"
                                name="fname" value="{{ $member->fname }}" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" id="lname" class="form-control lname" placeholder="Last Name"
                                name="lname" value="{{ $member->lname }}" required>
                        </div>
                        <div class="form-group">
                            <label class="mr-2 mb-0">Gender: </label>
                            @if ($member->gender == 'male')
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
                                value="{{ $member->birth }}" required>
                        </div>
                        <div class="form-group">
                            <label>Group</label>

                            <select class="form-control select2 group" id="group" name="group[]" multiple="multiple"
                                style="width:100%;" required>

                                @foreach ($groups as $group)
                                    <option
                                        @if (in_array($group->id, $groupId)) {{ 'selected' }} @else {{ '' }} @endif
                                        value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach



                            </select>

                        </div>

                        <h5 class="border-bottom pb-2 mb-4">Contact Information</h5>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control address" id="address" name="address"
                                value="{{ $member->address }}" required>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control city" id="city" name="city"
                                value="{{ $member->city }}" required>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control state" id="state" name="state"
                                value="{{ $member->state }}" required>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" class="form-control phone" id="phone" name="phone"
                                value="{{ $member->phone }}" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control email" id="email" name="email"
                                value="{{ $member->email }}" required>
                        </div>

                        <h5 class="border-bottom pb-2 mb-4">Physical Information</h5>
                        <div class="form-group">
                            <label>Weight</label>
                            <input type="text" class="form-control weight" id="weight" name="weight"
                                placeholder="KG" value="{{ $member->weight }}">
                        </div>
                        <div class="form-group">
                            <label>Height</label>
                            <input type="text" class="form-control height" id="height" name="height"
                                placeholder="Centimeter" value="{{ $member->height }}">
                        </div>
                        <div class="form-group">
                            <label>Chest</label>
                            <input type="text" class="form-control chest" id="chest" name="chest"
                                placeholder="Inches" value="{{ $member->chest }}">
                        </div>
                        <div class="form-group">
                            <label>Waist</label>
                            <input type="text" class="form-control waist" id="waist" name="waist"
                                placeholder="Inches" value="{{ $member->waist }}">
                        </div>
                        <div class="form-group">
                            <label>Thigh</label>
                            <input type="text" class="form-control thigh" id="thigh" name="thigh"
                                placeholder="Inches" value="{{ $member->thigh }}">
                        </div>
                        <div class="form-group">
                            <label>Arms</label>
                            <input type="text" class="form-control arms" id="arm" name="arm"
                                placeholder="Inches" value="{{ $member->arm }}">
                        </div>
                        <div class="form-group">
                            <label>Fat</label>
                            <input type="text" class="form-control fat" id="fat" name="fat"
                                placeholder="Percentage" value="{{ $member->fat }}">
                        </div>
                        <h5 class="border-bottom pb-2 mb-4">More Information</h5>
                        <div class="form-group">
                            <label>Select Staff Member</label>

                            <select class="form-control select2 staff" id="staff_member" name="staff_member[]"
                                multiple="multiple" style="width:100%;" required>

                                @foreach ($staff_members as $staff_member)
                                    <option
                                        @if (in_array($staff_member->id, $staff_memberId)) {{ 'selected' }} @else {{ '' }} @endif
                                        value="{{ $staff_member->id }}">
                                        {{ $staff_member->fname . ' ' . $staff_member->lname }}
                                    </option>
                                @endforeach


                            </select>

                        </div>
                        <div class="form-group">
                            <label>Membership</label>

                            <select class="form-control membership_update" id="membership" name="membership"
                                style="width:100%;" required>

                                @foreach ($memberships as $membership)
                                    <option
                                        @if ($membership->id == $member->membership) {{ 'selected' }} @else {{ '' }} @endif
                                        value="{{ $membership->id }}">{{ $membership->name }}</option>
                                @endforeach


                            </select>

                        </div>
                        <div class="form-group">
                            <label>Membership Valid From</label>
                            <div class="row">
                                <div class="col-md-5">
                                    <span id="select_days_update" class="d-none"></span>
                                    <input type="date" class="form-control start_date_update" id="start_date"
                                        name="start_date" value="{{ $member->start_date }}" required>
                                </div>
                                <div class="col-md-2">
                                    <h5 class="d-block text-center py-2 mb-0">To</h5>
                                </div>
                                <div class="col-md-5">
                                    <input type="date" class="form-control end_date_update bg-secondary text-white"
                                        name="end_date" id="end_date" value="{{ $member->end_date }}" required>
                                </div>
                            </div>
                        </div>
                        <input type="submit" name="save" id="updateMember" class="btn btn-info float-right"
                            value="Save" required>
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
            $("#updateMember").on('click', function(e) {
                e.preventDefault();

                var id = $("#member_id").val();
                var fname = $("#fname").val();
                var lname = $("#lname").val();
                var gender = $("input[name='gender']:checked").val();
                var birth = $("#birth").val();
                var address = $("#address").val();
                var city = $("#city").val();
                var state = $("#state").val();
                var phone = $("#phone").val();
                var email = $("#email").val();
                var weight = $("#weight").val();
                var height = $("#height").val();
                var chest = $("#chest").val();
                var waist = $("#waist").val();
                var thigh = $("#thigh").val();
                var arm = $("#arm").val();
                var fat = $("#fat").val();
                var membership = $("#membership").val();
                var start_date = $("#start_date").val();
                var end_date = $("#end_date").val();

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
                formData.append('weight', weight);
                formData.append('height', height);
                formData.append('chest', chest);
                formData.append('waist', waist);
                formData.append('thigh', thigh);
                formData.append('arm', arm);
                formData.append('fat', fat);
                formData.append('membership', membership);
                formData.append('start_date', start_date);
                formData.append('end_date', end_date);

                // Append roles and specializations as arrays
                var group = $("#group").val();
                if (group) {
                    group.forEach(function(group) {
                        formData.append('group[]', group);
                    });
                }
                var staff_member = $("#staff_member").val();
                if (staff_member) {
                    staff_member.forEach(function(staff_member) {
                        formData.append('staff_member[]', staff_member);
                    });
                }

                if ($("#new_image")[0].files.length > 0) {
                    formData.append('new_image', $("#new_image")[0].files[0]);
                } else if ($("#imageDropdown").is(":visible")) {
                    formData.append('imageDropdown', $("#imageDropdown").val());
                } else {
                    formData.append('old_image', $("#old_image").val());
                }


                $.ajax({
                    url: `/api/member/${id}`,
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
                        window.location.href = '/showMember'
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>

@endsection
