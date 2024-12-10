@extends('master')

@section('content')
    <div class="container">
        <div class="admin-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Edit Membership</h2>
                    <a href="membership.php" class="btn btn-success float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                        </svg>
                        Membership List
                    </a>
                </div>
                <div class="card-body position-relative">
                    <div class="message"></div>

                    <form class="yourform" id="update-membership" action="" method="post" autocomplete="off">
                        <div class="form-group">
                            <label>Membership Name</label>
                            <input type="hidden" id="membership_id" name="membership_id" value="{{ $membership->id }}">
                            <input type="text" id="name" class="form-control membership_name"
                                placeholder="Membership Name" name="name" value="{{ $membership->name }}" required>
                        </div>
                        <div class="form-group">
                            <label>Membership Category</label>

                            <select class="form-control membership_cat" id="category_id" name="category_id"
                                style="width:100%;" required>
                                @foreach ($category as $categories)
                                    <option
                                        @if ($categories->id == $membership->category_id) {{ 'selected' }}
                                      @else
                                      {{ '' }} @endif
                                        value="{{ $categories->id }}">{{ $categories->category_name }}</option>
                                @endforeach


                            </select>

                        </div>
                        <div class="form-group">
                            <label>Membership Period</label>
                            <input type="text" id="period" class="form-control membership_period"
                                placeholder="No. Of Days" name="period" value="{{ $membership->period }}" required>
                        </div>
                        <div class="form-group">
                            <label>Membership Amount</label>
                            <input type="text" id="amount" class="form-control membership_amount"
                                placeholder="Membership Amount" name="amount" value="{{ $membership->amount }}" required>
                        </div>
                        <div class="form-group">
                            <label>Membership Description</label>
                            <textarea name="description" id="description" class="form-control membership_desc" placeholder="Membership Description"
                                rows="8" cols="80">{{ $membership->description }}</textarea>
                        </div>
                        <input type="submit" id="updateMembership" name="save" class="btn btn-info float-right"
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
            $("#updateMembership").on('click', function(e) {

                e.preventDefault();

                var id = $("#membership_id").val();
                var name = $("#name").val();
                var category_id = $("#category_id").val();
                var period = $("#period").val();
                var amount = $("#amount").val();
                var description = $("#description").val();

                $.ajax({
                    url: `/api/membership/${id}`,
                    type: 'POST',
                    data: {
                        id: id,
                        name: name,
                        category_id: category_id,
                        period: period,
                        amount: amount,
                        description: description
                    },
                    headers: {
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    success: function(response) {
                        // console.log(response);
                        alert(response.message);
                        window.location.href = '/showMembership'
                    }
                })

            })
        })
    </script>
@endsection
