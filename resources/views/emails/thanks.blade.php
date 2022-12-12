<p class="mb-4">{{ $user->name }} 御中</p>

<p class="mb-4">いつもお世話になっております。</p>
<p class="mb-4">下記のご注文ありがとうございます。</p>

注文内容
@foreach ($products as $product)
<ul class="mb-4">
    <li>ブランド名: {{ $product['brand_name'] }}</li>
    <li>品番: {{ $product['number'] }}</li>
    <li>商品: {{ $product['name'] }}</li>
    <li>上代: {{ number_format($product['price']) }}円</li>
    <li>下代: {{ number_format($product['price'] * $user->betting_rate /100 )}}円</li>
    <li>点数: {{ $product['quantity'] }}点</li>
    <li>合計: {{ number_format($product['price'] * $product['quantity'] * $user->betting_rate /100)}}円(下代合計)</li>
</ul>

@endforeach
