@extends('master')
@section('content')
    <div class="container">
        <div class="admin-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Add Member</h2>
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
                    @if ($group->count() < 0)
                        <div class="alert alert-danger">First Add Group</div>
                    @endif

                    @if ($staff_member->count() < 0)
                        <div class="alert alert-danger">First Add Staff Member</div>
                    @endif

                    @if ($membership->count() < 0)
                        <div class="alert alert-danger">First Add Membership</div>
                    @endif

                    <form class="yourform" id="add-member" action="" method="post" autocomplete="off">
                        <h5 class="border-bottom pb-2 mb-4">Personal Information</h5>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file"
                                onchange="document.querySelector('#previewimage').src=window.URL.createObjectURL(this.files[0])"
                                class="image" id="image" name="image" value="">
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
                                <input type="radio" class="mr-1 gender" id="gender" name="gender" value="male"
                                    checked="">
                                Male
                            </label>
                            <label for="" class="mb-0">
                                <input type="radio" class="mr-1 gender" id="gender" name="gender" value="female">
                                Female
                            </label>
                        </div>
                        <div class="form-group">
                            <label>Date Of Birth</label>
                            <input type="date" class="form-control birth" id="birth" name="birth" value=""
                                required>
                        </div>
                        <div class="form-group">
                            <label>Group</label>
                            <select class="form-control select2 group" id="group" name="group[]" multiple="multiple"
                                style="width:100%;" required>
                                <option value="" disabled>Select Group</option>

                                @foreach ($group as $groups)
                                    <option value="{{ $groups->id }}">{{ $groups->name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <h5 class="border-bottom pb-2 mb-4">Contact Information</h5>
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
                            <input type="text" class="form-control state" id="state" name="state" value=""
                                required>
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

                        <h5 class="border-bottom pb-2 mb-4">Physical Information</h5>
                        <div class="form-group">
                            <label>Weight</label>
                            <input type="number" class="form-control weight" id="weight" name="weight"
                                placeholder="KG" value="">
                        </div>
                        <div class="form-group">
                            <label>Height</label>
                            <input type="number" class="form-control height" id="height" name="height"
                                placeholder="Centimeter" value="">
                        </div>
                        <div class="form-group">
                            <label>Chest</label>
                            <input type="number" class="form-control chest" id="chest" name="chest"
                                placeholder="Centimeter" value="">
                        </div>
                        <div class="form-group">
                            <label>Waist</label>
                            <input type="number" class="form-control waist" id="waist" name="waist"
                                placeholder="Inches" value="">
                        </div>
                        <div class="form-group">
                            <label>Thigh</label>
                            <input type="number" class="form-control thigh" id="thigh" name="thigh"
                                placeholder="Inches" value="">
                        </div>
                        <div class="form-group">
                            <label>Arms</label>
                            <input type="number" class="form-control arms" id="arm" name="arm"
                                placeholder="Inches" value="">
                        </div>
                        <div class="form-group">
                            <label>Fat</label>
                            <input type="number" class="form-control fat" id="fat" name="fat"
                                placeholder="Percentage" value="">
                        </div>
                        <h5 class="border-bottom pb-2 mb-4">More Information</h5>
                        <div class="form-group">
                            <label>Select Staff Member</label>
                            <select class="form-control select2 staff" id="staff_member" name="staff_member[]"
                                multiple="multiple" style="width:100%;" required>
                                <option value="" disabled>Select Staff Member</option>

                                @foreach ($staff_member as $staff_members)
                                    <option value="{{ $staff_members->id }}">
                                        {{ $staff_members->fname . ' ' . $staff_members->lname }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Membership</label>
                            <select class="form-control membership" id="membership" name="membership"
                                style="width:100%;" required>
                                <option value="" selected disabled>Select Membership</option>

                                @foreach ($membership as $memberships)
                                    <option value="{{ $memberships->id }}">{{ $memberships->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Membership Valid From</label>
                            <div class="row">
                                <div class="col-md-5">
                                    <span id="select_days" class="d-none"></span>
                                    <input type="date" class="form-control start_date" id="start_date"
                                        name="start_date" value="" required>
                                </div>
                                <div class="col-md-2">
                                    <h5 class="d-block text-center py-2 mb-0">To</h5>
                                </div>
                                <div class="col-md-5">
                                    <input type="date" class="form-control end_date bg-secondary text-white"
                                        name="end_date" id="end_date" value="" required>
                                </div>
                            </div>
                        </div>

                        <input type="submit" name="save" class="btn btn-info float-right" id="addMember"
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
            document.getElementById("start_date").addEventListener("change", function() {
                let startDate = new Date(this.value); // Start date ko lete hain
                let endDate = new Date(
                    startDate); // Us date ko copy karte hain taake modifications kar saken

                endDate.setMonth(endDate.getMonth() + 1); // Ek mahine (1 month) add kar dete hain
                let year = endDate.getFullYear();
                let month = String(endDate.getMonth() + 1).padStart(2,
                    '0'); // Month ko 2 digits me format karte hain
                let day = String(endDate.getDate()).padStart(2,
                    '0'); // Day ko bhi 2 digits me format karte hain

                // Formatted date ko end date ke input field me set karte hain
                document.getElementById("end_date").value = `${year}-${month}-${day}`;
            });

            $("#addMember").on('click', function(e) {
                e.preventDefault();

                var formData = new FormData();
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
                formData.append('weight', $("#weight").val());
                formData.append('height', $("#height").val());
                formData.append('chest', $("#chest").val());
                formData.append('waist', $("#waist").val());
                formData.append('thigh', $("#thigh").val());
                formData.append('arm', $("#arm").val());
                formData.append('fat', $("#fat").val());
                formData.append('membership', $("#membership").val());
                formData.append('start_date', $("#start_date").val());
                formData.append('end_date', $("#end_date").val());

                // Role ko array ke taur pe append karne ke liye
                var staff_member = $("#staff_member").val();
                if (staff_member) {
                    staff_member.forEach(function(staff_member) {
                        formData.append('staff_member[]', staff_member);
                    });
                }

                // Specialization ko array ke taur pe append karne ke liye
                var group = $("#group").val();
                if (group) {
                    group.forEach(function(group) {
                        formData.append('group[]', group);
                    });
                }
                $.ajax({
                    url: '/api/member',
                    type: 'POST',
                    data: formData,
                    contentType: false, 
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        alert(response.message);
                        window.location.href = '/showMember';
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
