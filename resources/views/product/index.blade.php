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

        .btn-edit {
            background-color: #0099ff;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .btn-edit:hover {
            background-color: #00499c;
        }

        .btn-delete {
            background-color: #ff1100;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .btn-delete:hover {
            background-color: #8b0101;
        }

        .btn-add {
            margin-top: 20px;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .btn-add:hover {
            background-color: #1e7e34;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .action-buttons form {
            margin: 0;
            display: inline;
        }
    </style>
</head>

<body>
    <h1>Product List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product['id'] }}</td>
            <td>{{ $product['name'] }}</td>
            <td>${{ number_format($product['price'], 2) }}</td>
            <td>{{ $product['stock'] }}</td>
            <td>
                <div class="action-buttons">
                    <a href="{{ route('edit', ['id' => $product['id']]) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('delete', ['id' => $product['id']]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
    <a href="{{ route('add') }}" class="btn-add">Add New Product</a>
</body>

</html>