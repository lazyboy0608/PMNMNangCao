<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #DDD;
        }

        tr:hover {
            background-color: #D6EEEE;
        }
    </style>
</head>

<body>
    <h1>{{ $title }}</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Price</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product['id'] }}</td>
            <td>{{ $product['name'] }}</td>
            <td>${{ number_format($product['price'], 2) }}</td>
        </tr>
        @endforeach
    </table>
    <a href="{{ route('add') }}">Add New Product</a>
</body>

</html>