<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ホーム
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <x-flash-message status="session('status')"/>
                    <form method="POST" action="{{ route('owner.products.update', ['product' => $product->id]) }}">
                          @csrf
                          @method('put')
                            <div class="-m-2">

                                <div class="p-2 w-2/3 mx-auto">
                                    <div class=" relative">
                                        <div>
                                        <label for="brand_id" class="flex leading-7 text-sm text-gray-600">
                                            <div>ブランド名</div>
                                            <div class="leading-7 ml-2 text-sm text-red-600">※必須</div>
                                        </label>
                                        </div>
                                        <select name="brand_id" id="brand_id">
                                            @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" @if ($brand->id === $product->brand_id) selected @endif>
                                               {{ $brand->brand_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="p-2 w-2/3 mx-auto">
                                    <div class="relative">
                                        <label for="number" class="flex leading-7 text-sm text-gray-600">
                                            <div>品番</div>
                                            <div class="leading-7 ml-2 text-sm text-red-600">※必須</div>
                                        </label>
                                        <input type="text" id="number" name="number" autofocus value="{{ $product->number }}" repuired class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>
                                </div>

                                <div class="p-2 w-2/3 mx-auto">
                                    <div class="relative">
                                        <label for="name" class="flex leading-7 text-sm text-gray-600">
                                            <div>商品名</div>
                                            <div class="leading-7 ml-2 text-sm text-red-600">※必須</div>
                                        </label>
                                        <input type="text" id="name" name="name" autofocus value="{{ $product->name }}" repuired class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>
                                </div>

                                <div class="p-2 w-2/3 mx-auto">
                                    <div class="relative">
                                        <label for="information" class="leading-7 text-sm text-gray-600">商品情報</label>
                                        <textarea id="information" name="information" rows="5" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $product->information }}</textarea>
                                    </div>
                                </div>

                                <div class="p-2 w-2/3 mx-auto">
                                    <div class="relative">
                                        <label for="price" class="flex leading-7 text-sm text-gray-600">
                                            <div>価格</div>
                                            <div class="leading-7 ml-2 text-sm text-red-600">※必須</div>
                                        </label>
                                        <input type="number" id="price" name="price" value="{{ $product->price }}" repuired class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>
                                </div>

                                <div class="p-2 w-2/3 mx-auto">
                                    <div class="relative">
                                        <label for="sort_order" class="leading-7 text-sm text-gray-600">表示順</label>
                                        <input type="number" id="sort_order" name="sort_order" value="{{ $product->sort_order }}"  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>
                                </div>

                                 <div class="p-2 w-2/3 mx-auto">
                                    <div class="relative">
                                        <label for="current_quantity" class="flex leading-7 text-sm text-gray-600">
                                            <div>現在の在庫数</div>
                                            <div class="leading-7 ml-2 text-sm text-red-600">※必須</div>
                                        </label>
                                        <input type="hidden" id="current_quantity" name="current_quantity" value="{{ $quantity }}">
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded text-base outline-none text-gray-700 py-1 px-3 leading-8">{{ $quantity }}</div>
                                    </div>
                                </div>

                                <div class="p-2 w-2/3 mx-auto">
                                    <div class="relative">
                                        <label for="quantity" class="leading-7 text-sm text-gray-600">下記数量を入力後、次項目でその数量分を（追加or削減）選択して完了です。</label>
                                        <input type="number" id="quantity" name="quantity" value="0" repuired class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        <span class="text-sm">0〜999の範囲で入力してください</span>
                                    </div>
                                </div>

                                <div class="p-2 w-2/3 mx-auto">
                                    <div class="relative flex justify-around">
                                        <label for="add">
                                            <input class="mr-2" id="add" type="radio" name="type" value="{{ \Constant::PRODUCT_LIST['add'] }}"
                                            checked>追加</label>
                                        <label for="reduce">
                                            <input class="mr-2" id="reduce" type="radio" name="type" value="{{ \Constant::PRODUCT_LIST['reduce'] }}">
                                            削減</label>
                                    </div>
                                 </div>

                                 <div class="p-2 w-2/3 mx-auto">
                                    <div class=" relative">
                                        <label for="category" class="flex leading-7 text-sm text-gray-600">
                                            <div>商品カテゴリー</div>
                                            <div class="leading-7 ml-2 text-sm text-red-600">※必須</div>
                                        </label>
                                        <select name='category' id="category" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" >
                                            @foreach ($categories as $category)
                                              <optgroup label="{{ $category->name }}">
                                              @foreach ($category->secondary as $secondary)
                                                <option value="{{ $secondary->id }}"  @if($secondary->id === $product->secondary_category_id) selected @endif>
                                                  {{ $secondary->name }}
                                                </option>
                                              @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="p-2 w-2/3 mx-auto">
                                    <label class="leading-7 text-sm text-gray-600">商品画像</label>
                                </div>
                                <x-select-image :images="$images" currentId="{{$product->image1}}" currentImage="{{$product->imageFirst->filename ?? ''}}" name="image1" />
                                <x-select-image :images="$images" currentId="{{$product->image2}}" currentImage="{{$product->imageSecond->filename ?? ''}}" name="image2" />
                                <x-select-image :images="$images" currentId="{{$product->image3}}" currentImage="{{$product->imageThird->filename ?? ''}}" name="image3" />
                                <x-select-image :images="$images" currentId="{{$product->image4}}" currentImage="{{$product->imageFourth->filename ?? ''}}" name="image4" />
                                <x-select-image :images="$images" currentId="{{$product->image5}}" currentImage="{{$product->imageFifth->filename ?? ''}}" name="image5" />
                                <x-select-image :images="$images" currentId="{{$product->image6}}" currentImage="{{$product->imageSixth->filename ?? ''}}" name="image6" />
                                <x-select-image :images="$images" currentId="{{$product->image7}}" currentImage="{{$product->imageSeventh->filename ?? ''}}" name="image7" />
                                <x-select-image :images="$images" currentId="{{$product->image8}}" currentImage="{{$product->imageEighth->filename ?? ''}}" name="image8" />
                                <x-select-image :images="$images" currentId="{{$product->image9}}" currentImage="{{$product->imageNinth->filename ?? ''}}" name="image9" />
                                <x-select-image :images="$images" currentId="{{$product->image10}}" currentImage="{{$product->imageTenth->filename ?? ''}}" name="image10" />

                                 <div class="p-2 w-2/3 mx-auto">
                                    <div class="relative flex justify-around">
                                        <label for="is_selling">
                                            <input class="mr-2" id="is_selling" type="radio" name="is_selling" value="1"
                                            @if ($product->is_selling === 1) checked @endif
                                            >販売可能</label>
                                        <label for="close">
                                            <input class="mr-2" id="close" type="radio" name="is_selling" value="0"
                                            @if ($product->is_selling === 0) checked @endif
                                            >販売停止</label>
                                    </div>
                                 </div>

                                <div class="p-2 w-full flex justify-around mt-4">
                                    <button  type="button" onclick="location.href='{{ route('owner.products.index') }}'" class="text-white bg-gray-400 border-0 py-2 px-8 focus:outline-none hover:bg-gray-300 rounded text-lg">戻る</button>
                                    <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-400 rounded text-lg">更新</button>
                                </div>
                            </div>
                        </form>
                          <form id="delete_{{$product->id}}" method="POST" action="{{ route('owner.products.destroy',      ['product'=>$product->id])}}">
                            @csrf
                            @method('delete')
                            <div class="p-2 w-full flex justify-around mt-20">
                                <a href="#" data-id="{{ $product->id }}" onclick="deletePost(this)" class="text-white bg-red-500 border-0 py-2 w-2/3 focus:outline-none hover:bg-red-400 rounded text-lg text-center">削  除</a>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    'use strict'
        const images = document.querySelectorAll('.image') //全てのimageタグを取得

        images.forEach(image => { // 1つずつ繰り返す
         image.addEventListener('click', function(e){ // クリックしたら
         const imageName = e.target.dataset.id.substr(0, 6) //data-idの6文字
         const imageId = e.target.dataset.id.replace(imageName + '_', '') // 6文字カット
         const imageFile = e.target.dataset.file
         const imagePath = e.target.dataset.path
         const modal = e.target.dataset.modal// サムネイルと input type=hiddenのvalueに設定
        document.getElementById(imageName + '_thumbnail').src = imagePath + '/' + imageFile
        document.getElementById(imageName + '_hidden').value = imageId
        MicroModal.close(modal); //モーダルを閉じる
        });
    });

    function deletePost(e) {
        'use strict';
            if (confirm('本当に削除してもいいですか?')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
    }
    </script>
</x-app-layout>
