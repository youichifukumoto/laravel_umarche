{{-- <p class="mb-4">{{ $product['ownerName'] }} 様の商品が注文されました。</p> --}}

<div class="mb-4">注文内容</div>
{{-- @foreach ($products as $product) --}}
<ul class="mb-4">
    {{-- <li>ブランド名: {{ $brand['brand_name'] }}</li> --}}
    <li>品番: {{ $product['number'] }}</li>
    <li>商品: {{ $product['name'] }}</li>
    {{-- <li>上代: {{ number_format($product['price']) }}円</li>
    <li>下代: {{ number_format($product['price'] * $user->betting_rate /100 )}}円</li>
    <li>点数: {{ $product['quantity'] }}点</li>
    <li>合計: {{ number_format($product['price'] * $product['quantity'] * $user->betting_rate /100)}}円(下代合計)</li> --}}
</ul>
{{-- @endforeach --}}

{{-- <div class="mb-4">店舗名</div>
<ul>
    <li>{{ $user->name }}様</li>
    <li>掛け率{{ $user->betting_rate }}％</li>
</ul> --}}
