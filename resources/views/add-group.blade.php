@extends('master')

@section('content')
    <div class="message"></div>
    <div class="container">
        <div class="admin-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Add Group</h2>
                    <a href="group.php" class="btn btn-success float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                        </svg>
                        Group List
                    </a>
                </div>
                <div class="card-body position-relative">
                    <form class="yourform" id="add-group" action="" method="post" autocomplete="off">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="name" name="name" class="form-control group_name"
                                placeholder="Name" name="group_name" value="" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="group_desc" id="description" name="description" class="form-control group_desc"
                                placeholder="Description" rows="8" cols="80"></textarea>
                        </div>
                        <input type="submit" id="addGroup" name="save" class="btn btn-info float-right" value="Save"
                            required>
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
            $("#addGroup").on('click', function(e) {
                e.preventDefault();

                var name = $("#name").val();
                var description = $("#description").val();

                $.ajax({
                    url: '/api/group',
                    type: 'POST',
                    data: {
                        name: name,
                        description: description
                    },
                    success: function(response) {
                        console.log(response);
                        alert(response.message);
                        window.location.href = '/showGroup'
                    }
                })
            })
        })
    </script>
@endsection
