@extends('master')

@section('content')
    <div class="container">
        <div class="admin-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Add Membership</h2>
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
                    @if ($category->count() < 0)
                        <div class="alert alert-danger">First Add Categories</div>
                    @endif

                    <form class="yourform" id="add-membership" action="" method="post" autocomplete="off">
                        <div class="form-group">
                            <label>Membership Name</label>
                            <input type="text" class="form-control membership_name" id="name" name="name"
                                placeholder="Membership Name" value="" required>
                        </div>
                        <div class="form-group">
                            <label>Membership Category</label>
                            <select class="form-control membership_cat" id="category_id" name="category_id"
                                style="width:100%;" required>
                                <option value="" selected disabled>Select Category</option>
                                @foreach ($category as $categories)
                                    <option value="{{ $categories->id }}">{{ $categories->category_name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Membership Period</label>
                            <input type="number" id="period" class="form-control membership_period"
                                placeholder="No. Of Days" name="period" value="" required>
                        </div>
                        <div class="form-group">
                            <label>Membership Amount</label>
                            <input type="number" id="amount" class="form-control membership_amount"
                                placeholder="Membership Amount" name="amount" value="" required>
                        </div>
                        <div class="form-group">
                            <label>Membership Description</label>
                            <textarea name="description" id="description" class="form-control membership_desc" placeholder="Membership Description"
                                rows="8" cols="80"></textarea>
                        </div>
                        <input type="submit" id="addmembership" name="save" class="btn btn-info float-right"
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
            $("#addmembership").on('click', function(e) {
                e.preventDefault();

                var name = $("#name").val()
                var category_id = $("#category_id").val()
                var period = $("#period").val()
                var amount = $("#amount").val()
                var description = $("#description").val()

                $.ajax({
                    url: '/api/membership',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF Token
                        name: name,
                        category_id: category_id,
                        period: period,
                        amount: amount,
                        description: description
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // Inspect the error message
                    }
                });

            })
        })
    </script>
@endsection
