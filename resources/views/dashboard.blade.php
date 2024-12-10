@extends('master')
@section('content')
    <div class="admin-content">
        <div class="container">
            <div id="admin-dashboard">
                <div class="row">
                    <div class="col-md-3">

                        <div class="card bg-success">
                            <div class="card-body text-center" style="padding: 30px 20px;">
                                <img src="images/member.png" class="mb-4" alt="" style="width:40%;">
                                <p class="card-text mb-3">{{ $total_members }}</p>
                                <h5 class="card-title text-white mb-0">Total member</h5>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">

                        <div class="card bg-secondary">
                            <div class="card-body text-center" style="padding: 30px 20px;">
                                <img src="images/staff-member.png" class="mb-4" alt="" style="width:40%;">
                                <p class="card-text mb-3">{{ $total_staffs }}</p>
                                <h5 class="card-title text-white mb-0">Total Staff Member</h5>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">

                        <div class="card bg-dark">
                            <div class="card-body text-center" style="padding: 30px 20px;">
                                <img src="images/group.png" class="mb-4" alt="" style="width:40%;">
                                <p class="card-text mb-3">{{ $total_groups }}</p>
                                <h5 class="card-title text-white mb-0">Total Group</h5>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">

                        <div class="card bg-danger">
                            <div class="card-body text-center" style="padding: 30px 20px;">
                                <img src="images/membership.png" class="mb-4" alt="" style="width:40%;">
                                <p class="card-text mb-3">{{ $total_memberships }}</p>
                                <h5 class="card-title text-white mb-0">Total Membership</h5>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
