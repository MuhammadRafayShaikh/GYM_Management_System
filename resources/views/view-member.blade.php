@extends('master')

@section('content')
    <div class="message"></div>
    <div class="container">
        <div class="admin-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">View Member Profile</h2>
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
                    <div id="table-data">

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card-header bg-info">
                                    <h5 class="d-inline text-white">Personal Information</h5>
                                </div>
                                <div class="border p-3">

                                    <img src="images/member/" style="margin-bottom:20px;" width="100px" height="100px"
                                        alt="">

                                    <img src="images/member/" width="100px" height="100px" style="margin-bottom:20px;"
                                        alt="">

                                    <table width="100%" class="view-member">
                                        <tbody>
                                            <tr>
                                                <td class="label">Member Name :</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Mobile No :</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Email :</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Date Of Birth :</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Gender :</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Address :</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="label">City :</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td class="label">State :</td>
                                                <td></td>
                                            </tr>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="offset-md-1 col-md-5" style="height:100%;">
                                <div class="card-header bg-info">
                                    <h5 class="d-inline text-white">Physical Information</h5>
                                </div>
                                <div class="border p-3">
                                    <table width="100%" class="view-member">
                                        <tbody>
                                            <tr>
                                                <td class="label">Member Weight :</td>
                                                <td><?php echo $row['member_weight'] != '' ? $row['member_weight'] . ' kg' : ''; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Member Height :</td>
                                                <td><?php echo $row['member_height'] != '' ? $row['member_height'] . ' cm' : ''; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Member Chest :</td>
                                                <td><?php echo $row['member_chest'] != '' ? $row['member_chest'] . ' cm' : ''; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Member Waist :</td>
                                                <td><?php echo $row['member_waist'] != '' ? $row['member_waist'] . ' Inch' : ''; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Member Thigh :</td>
                                                <td><?php echo $row['member_thigh'] != '' ? $row['member_thigh'] . ' inch' : ''; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Member Arm :</td>
                                                <td><?php echo $row['member_arm'] != '' ? $row['member_arm'] . ' Inch' : ''; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Member Fat :</td>
                                                <td><?php echo $row['member_fat'] != '' ? $row['member_fat'] . '%' : ''; ?></td>
                                            </tr>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-header bg-info">
                                    <h5 class="d-inline text-white">More Information</h5>
                                </div>
                                <div class="border p-3">
                                    <table width="100%" class="view-member">
                                        <tbody>
                                            <tr>
                                                <td class="label">Membership :</td>
                                                <td><?php echo $row['membership_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Joining Date :</td>
                                                <td><?php echo date('j F,Y', strtotime($row['start_date'])); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Expiring Date :</td>
                                                <td><?php echo date('j F,Y', strtotime($row['end_date'])); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Group :</td>
                                                <td><?php echo $row['group_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Staff Member :</td>
                                                <td><?php echo $row['staff_fname'] . ' ' . $row['staff_lname']; ?></td>
                                            </tr>
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
    </div>
    </div>
    </div>
@endsection
