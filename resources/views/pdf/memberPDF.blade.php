<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
</head>

<body>
    <h2>Members Report</h2>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Join - Expire</th>
                            <th>Trainer</th>
                            <th>Phone</th>
                            <th>Email</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <td>{{ $member->id }}</td>
                                <td>
                                    @if ($member->image != null && $member->image != '')
                                        <img src="{{ asset('uploads/' . $member->image) }}" width="40px"
                                            height="40px" style="border-radius:50%; object-fit: cover;" alt="">
                                    @else
                                        @if ($member->gender == 'male')
                                            <img src="{{ asset('images/member/man.png') }}" width="40px"
                                                height="40px" style="border-radius:50%; object-fit: cover;"
                                                alt="">
                                        @else
                                            <img src="{{ asset('images/member/woman.png') }}" width="40px"
                                                height="40px" style="border-radius:50%; object-fit: cover;"
                                                alt="">
                                        @endif
                                    @endif
                                </td>

                                <td>{{ $member->fname . ' ' . $member->lname }}</td>
                                <td>{{ $member->start_date . ' ' . $member->end_date }}</td>
                                <td>{{ $member->staff_members }}</td>
                                <td>{{ $member->phone }}</td>
                                <td>{{ $member->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
