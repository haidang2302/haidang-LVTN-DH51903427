<h3>Users</h3>
<ul>
    @foreach($users as $user)
        <li>{{ $user['name'] }} ({{ $user['email'] }})</li>
    @endforeach
</ul>

<h3>Categories</h3>
<ul>
    @foreach($categories as $category)
        <li>{{ $category['name'] }}</li>
    @endforeach
</ul>

<h3>Products</h3>
<ul>
    @foreach($products as $product)
        <li>{{ $product['name'] }} - {{ number_format($product['price'], 0, ',', '.') }}đ</li>
    @endforeach
</ul>

<h3>Templates</h3>
<ul>
    @foreach($templates as $template)
        <li>{{ $template['name'] }}</li>
    @endforeach
</ul>
