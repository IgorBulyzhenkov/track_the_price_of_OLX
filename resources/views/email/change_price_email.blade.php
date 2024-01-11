<body style="font-family: Arial, sans-serif;">

<div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">

    <h2 style="color: #007BFF;">Ціна змінилася</h2>

    <p>Ціна на товар "{{ $product['name'] }}" змінилася.</p>

    <p>Нова ціна <strong>{{ $product['price'] }} грн.</strong></p>

    <p style="text-align: center; margin-top: 20px;">
        <a href="{{$product['link']}}" style="display: inline-block; padding: 10px 20px; background-color: #28A745; color: #fff; text-decoration: none; border-radius: 3px;">{{ $product['name'] }}</a>
    </p>

    <p>Дякуємо за обрання нас!</p>

    <p>З повагою,<br>Ігор Булиженков!</p>

</div>

</body>
