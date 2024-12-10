@extends('master')

@section('content')
    <div class="message"></div>
    <div class="container">
        <div class="admin-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Edit Specialization</h2>
                    <a href="specialization.php" class="btn btn-success float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                        </svg>
                        Specialization List
                    </a>
                </div>
                <div class="card-body position-relative">

                    <form class="yourform" id="update-Specialization" action="" method="post" autocomplete="off">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="hidden" id="special_id" name="special_id" value="{{ $special->id }}" required>
                            <input type="text" id="name" class="form-control speci_name" placeholder="Name"
                                name="name" value="{{ $special->name }}" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="description" class="form-control speci_desc" placeholder="Description" rows="8"
                                cols="80">{{ $special->description }}</textarea>
                        </div>
                        <input type="submit" id="updateSpecial" name="save" class="btn btn-info float-right"
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
            $("#updateSpecial").on('click', function(e) {
                e.preventDefault();

                var id = $("#special_id").val()
                var name = $("#name").val()
                var description = $("#description").val()

                $.ajax({
                    url: `/api/specialization/${id}`,
                    type: 'POST',
                    data: {
                        name: name,
                        description: description
                    },
                    headers: {
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    success: function(response) {
                        // console.log(response);
                        alert(response.message)
                        window.location.href = '/showspecial'
                    }
                })
            })
        })
    </script>
@endsection
