@extends('master')
@section('content')
    <div class="message"></div>
    <div class="container">
        <div class="admin-content">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-inline">Edit Category</h2>
                    <a href="category.php" class="btn btn-success float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                        </svg>
                        Category List
                    </a>
                </div>
                <div class="card-body position-relative">

                    <form class="yourform" id="update-category" action="" method="post" autocomplete="off">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="hidden" id="category_id" name="cat_id" value="{{ $category->id }}" required>
                            <input type="text" id="category_name" class="form-control cat_name" name="category_name"
                                value="{{ $category->category_name }}" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="category_description" id="category_description" class="form-control cat_desc" rows="8"
                                cols="80">{{ $category->category_description }}</textarea>
                        </div>
                        <input type="submit" id="updateCategory" name="save" class="btn btn-info float-right"
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
            $("#updateCategory").on('click', function(e) {
                e.preventDefault();

                var category_id = $("#category_id").val()
                var category_name = $("#category_name").val()
                var category_description = $("#category_description").val()

                $.ajax({
                    url: `/api/category/${category_id}`,
                    type: 'POST',
                    data: {
                        category_name: category_name,
                        category_description: category_description
                    },
                    headers: {
                        'X-HTTP-Method-Override': 'PUT'
                    },
                    success: function(response) {
                        // console.log(response);
                        alert(response.message)
                        window.location.href='/showCategory'
                    }
                })
            })
        })
    </script>
@endsection
