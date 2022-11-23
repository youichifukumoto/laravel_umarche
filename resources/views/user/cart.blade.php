<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            カート
        </h2>
    </x-slot>
    <div class="py-4 flex justify-center">
        <div><span class="text-sm text-gray-700">合計＠</span>
            {{ number_format($bettingRateTotalPrice)}}
            <span class="text-sm text-gray-700"></span>
        </div>
        <div><span class="text-sm text-gray-700">合計￥</span>
            {{ number_format($totalPrice)}}
            <span class="text-sm text-gray-700"></span>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (count($products) > 0)
                      @foreach ($products as $product)
                      <div class="md:flex md:items-center mb-2">
                          <div class="md:w-2/12">
                           @if($product->imageFirst->filename !== null)
                                <img src="{{ asset('storage/products/' . $product->imageFirst->filename )}}">
                           @else
                                <img src="">
                           @endif
                          </div>
                          <div class="md:w-2/12 ml-2"><span class="mr-2 text-sm text-gray-700">品番</span>{{ $product->number }}</div>
                          {{-- <div class="md:w-2/12 md:ml-2">{{ $product->name }}</div> --}}
                          <div class="md:w-2/12 ml-2"><span class="text-sm md:ml-2 text-gray-700">￥</span>{{ number_format($product->price) }}</div>
                          <div class="md:w-3/12 flex justify-around text-center">
                            <div>カラー表記</div>
                            <div>×</div>
                            <div>{{ $product->pivot->quantity }}</div>
                            <div>=</div>
                            <div><span class="text-sm text-gray-700">＠</span>{{ number_format($product->pivot->quantity * $product->price * $bettingRatePrice)}}</div>
                          </div>
                          <div class="md:w-3/12 text-right">
                           <form method="post" action="{{route('user.cart.delete', ['item' => $product->id ])}}">
                                @csrf
                                <button><span class="text-sm text-gray-700">削除</span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg></button>
                            </form>
                        </div>
                      </div>
                      @endforeach
                    @else
                       <div class="text-center">
                         カートに商品が入っていません。
                       </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
