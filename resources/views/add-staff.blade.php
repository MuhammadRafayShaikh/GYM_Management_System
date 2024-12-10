@extends('master')

@section('content')
    <div class="container">
        <div class="admin-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Add Staff Member</h2>
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
                    @if ($role->count() < 0)
                        <div class="alert alert-danger">First Add Role</div>
                    @endif
                    @if ($special->count() < 0)
                        <div class="alert alert-danger">First Add Specialization</div>
                    @endif

                    <form class="yourform" id="add-staff" action="" method="post" autocomplete="off">
                        <h6 class="border-bottom pb-2 mb-4">Personal Information</h6>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file"
                                onchange="document.querySelector('#previewimage').src=window.URL.createObjectURL(this.files[0])"
                                id="image" class="image" name="image" value="" />
                            <img id="previewimage" src="" width="100px" />
                        </div>
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" id="fname" class="form-control fname" placeholder="First Name"
                                name="fname" value="" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" id="lname" class="form-control lname" placeholder="Last Name"
                                name="lname" value="" required>
                        </div>
                        <div class="form-group">
                            <label class="mr-2 mb-0">Gender: </label>
                            <label for="" class="mb-0 mr-2">
                                <input type="radio" class="mr-1 gender" name="gender" id="gender" value="male"
                                    checked="">
                                Male
                            </label>
                            <label for="" class="mb-0">
                                <input type="radio" class="mr-1 gender" name="gender" id="gender" value="female">
                                Female
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Date Of Birth</label>
                            <input type="date" class="form-control birth" id="birth" name="birth" value=""
                                required>
                        </div>
                        <div class="form-group">
                            <label>Assign Role</label>
                            <select class="form-control select2 role" id="role" name="role[]" multiple="multiple"
                                style="width:100%;" id="role_list" required>
                                <option value="" disabled>Select Role</option>
                                @foreach ($role as $roles)
                                    <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                                @endforeach

                                <option value=''></option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Specialization</label>
                            <select class="form-control select2 speci" id="special" name="special[]" multiple="multiple"
                                style="width:100%;" id="speci_list" required>
                                <option value="" disabled>Select Specialization</option>

                                @foreach ($special as $specials)
                                    <option value="{{ $specials->id }}">{{ $specials->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <h6 class="border-bottom pb-2 mb-3">Contact Information</h6>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control address" id="address" name="address" value=""
                                required>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control city" id="city" name="city" value=""
                                required>
                        </div>
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control state" id="state" name="state"
                                value="" required>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="number" class="form-control phone" id="phone" name="phone"
                                value="" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control email" id="email" name="email"
                                value="" required>
                        </div>
                        <input type="submit" id="addStaff" name="save" class="btn btn-info float-right"
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
            $("#addStaff").on('click', function(e) {
                e.preventDefault();

                // FormData object create karo
                var formData = new FormData();

                // Form fields ko FormData mein append karo
                if (!$("#image")[0].files[0] == "") {
                    formData.append('image', $("#image")[0].files[0]);
                }
                formData.append('fname', $("#fname").val());
                formData.append('lname', $("#lname").val());
                formData.append('gender', $("input[name='gender']:checked").val());
                formData.append('birth', $("#birth").val());
                formData.append('address', $("#address").val());
                formData.append('city', $("#city").val());
                formData.append('state', $("#state").val());
                formData.append('phone', $("#phone").val());
                formData.append('email', $("#email").val());

                // Role ko array ke taur pe append karne ke liye
                var roles = $("#role").val();
                if (roles) {
                    roles.forEach(function(role) {
                        formData.append('role[]', role);
                    });
                }

                // Specialization ko array ke taur pe append karne ke liye
                var specials = $("#special").val();
                if (specials) {
                    specials.forEach(function(special) {
                        formData.append('special[]', special);
                    });
                }

                $.ajax({
                    url: '/api/staffMember',
                    type: 'POST',
                    data: formData,
                    contentType: false, // FormData ke liye zaroori hai
                    processData: false, // jQuery ko data process karne se rokta hai
                    success: function(response) {
                        console.log(response);
                        alert(response.message)
                        window.location.href = '/showStaff';
                        // Success response ko handle karo
                    },
                    error: function(error) {
                        console.log(error);
                        // Error response ko handle karo
                    }
                });
            });
        });
    </script>
@endsection
