<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin Sinh viên</title>
</head>

<body>
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>Thông tin Sinh viên</h1>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>Họ và tên:</th>
                                <td>{{ $name }}</td>
                            </tr>
                            <tr>
                                <th>Mã sinh viên:</th>
                                <td>{{ $mssv }}</td>
                            </tr>
                        </table>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>