<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chessboard {{ $n }} x {{ $n }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: white;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 28px;
        }
        .size {
            color: #666;
            margin-bottom: 30px;
            font-size: 16px;
            text-align: center;
        }
        .content {
            text-align: center;
            margin-bottom: 20px;
        }
        .chessboard {
            display: inline-block;
            border: 3px solid #333;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
        .chessboard-row {
            display: flex;
        }
        .chessboard-cell {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 24px;
            border: 1px solid #ccc;
        }
        .black {
            background-color: #2c3e50;
            color: white;
        }
        .white {
            background-color: #ecf0f1;
            color: #333;
        }
    </style>
</head>
<body>
    <div>
        <h1 class="content">Chessboard</h1>
        <p class="size">Size: {{ $n }} × {{ $n }}</p>
        <div class="chessboard">
            @for ($row = 0; $row < $n; $row++)
                <div class="chessboard-row">
                    @for ($col = 0; $col < $n; $col++)
                        @php
                            $isBlack = ($row + $col) % 2 == 0;
                            $cellClass = $isBlack ? 'black' : 'white';
                        @endphp
                        <div class="chessboard-cell {{ $cellClass }}">

                        </div>
                    @endfor
                </div>
            @endfor
        </div>
    </div>
</body>
</html>
