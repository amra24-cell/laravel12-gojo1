<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Product List</h1>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="text-primary fw-bold">${{ number_format($product->price, 2) }}</p>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary w-100">Add to Cart</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    
    <style>
        /* เพิ่มปุ่มลอย */
        .floating-btn {
            position: fixed;
            bottom: 50px;
            right: 50px;
            z-index: 9999;
            /* ให้ปุ่มลอยอยู่เหนือทุกวัตถุ */
            background-color: #007bff;
            line-height: 1;
            color: white;
            font-size: 50px;
            font-weight: 900;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align : center;
        }

        .floating-btn:hover {
            background-color: #0056b3;
        }
    </style>
    <!-- ปุ่ม + ที่ลอยอยู่ -->
    <a href="{{ route('product.form') }}">
        <div class="floating-btn py-auto pb-2">
            +
        </div>
    </a>



    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>