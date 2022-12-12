<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}
                    <form method="POST" action="{{ route('owner.brands.update', ['brand' => $brand->id]) }}"   enctype="multipart/form-data">
                          @csrf
                            <div class="-m-2">
                                <div class="p-2 w-2/3 mx-auto">
                                    <div class="relative">
                                        <label for="brand_name" class="leading-7 text-sm text-gray-600">ブランド名 ※必須</label>
                                        <input type="text" id="brand_name" name="brand_name" autofocus value="{{ $brand->brand_name }}" repuired class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>
                                    <div class="text-sm text-red-600">
                                        @if ($errors->has('brand_name'))
                                        <li>{{$errors -> first('brand_name')}}</li>
                                        @endif
                                    </div>
                                </div>
                                <div class="p-2 w-2/3 mx-auto">
                                    <div class="relative">
                                        <div class="w-50">
                                         <x-thumbnail  :filename="$brand->filename" type="brands" />
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 w-2/3 mx-auto">
                                    <div class="relative">
                                        <label for="image" class="leading-7 text-sm text-gray-600">ブランドイメージ画像</label>
                                        <input type="file" id="image" name="image" accept=“image/png,image/jpeg,image/jpg” class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>
                                </div>
                                 <div class="p-2 w-2/3 mx-auto">
                                    <div class="relative flex justify-around">
                                        <label for="is_selling">
                                            <input class="mr-2" id="is_selling" type="radio" name="is_selling" value="1" @if ($brand->is_selling === 1){
                                                checked
                                            }
                                        @endif>受注受付中</label>
                                        <label for="close">
                                            <input class="mr-2" id="close" type="radio" name="is_selling" value="0" @if ($brand->is_selling === 0){
                                                checked
                                            }
                                        @endif>受注受付終了</label>
                                    </div>
                                 </div>
                                <div class="p-2 w-2/3 mx-auto">
                                    <div class="relative">
                                        <label for="information" class="leading-7 text-sm text-gray-600">ブランド情報 </label>
                                        <textarea id="information" name="information" rows="10" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $brand->information }}</textarea>
                                    </div>
                                </div>
                                <div class="p-2 w-full flex justify-around mt-4">
                                    <button  type="button" onclick="location.href='{{ route('owner.brands.index') }}'" class="text-white bg-gray-400 border-0 py-2 px-8 focus:outline-none hover:bg-gray-300 rounded text-lg">戻る</button>
                                    <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-400 rounded text-lg">更新</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
