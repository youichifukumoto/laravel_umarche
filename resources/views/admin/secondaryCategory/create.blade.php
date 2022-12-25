<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          セカンドカテゴリー新規登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                       <div class="container px-5 mx-auto">
                            <div class="flex flex-col text-center w-full mb-12">
                            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">セカンドカテゴリー登録</h1>
                            {{-- <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Whatever cardigan tote bag tumblr hexagon brooklyn asymmetrical gentrify.</p> --}}
                            </div>
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                 {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}
                            <form method="POST" action="{{ route('admin.secondaryCategory.store')}}">
                                    @csrf
                            <div class="-m-2">
                                <div class="p-2 w-2/3 mx-auto">
                                    <div class="relative">
                                        <label for="name" class="flex leading-7 text-sm text-gray-600">
                                            <div>カテゴリー名</div>
                                            <div class="leading-7 ml-2 text-sm text-red-600">※必須</div>
                                        </label>
                                        <input type="text" autofocus id="name" name="name" value="{{ old('name')}}" repuired class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>
                                    <div class="text-sm text-red-600">
                                        @if ($errors->has('name'))
                                        <li>{{$errors -> first('name')}}</li>
                                        @endif
                                    </div>
                                </div>
                                <div class="p-2 w-2/3 mx-auto">
                                    <div class="relative">
                                        <label for="sort_order" class="flex leading-7 text-sm text-gray-600">
                                            <div>ソートオーダー</div>
                                            <div class="leading-7 ml-2 text-sm text-red-600">※必須</div>
                                        </label>
                                        <input type="text" id="sort_order" name="sort_order" value="{{ old('sort_order')}}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>
                                    <div class="text-sm text-red-600">
                                        @if ($errors->has('sort_order'))
                                        <li>{{$errors -> first('sort_order')}}</li>
                                        @endif
                                    </div>
                                </div>
                                <div class="p-2 w-2/3 mx-auto">
                                    <div class="relative">
                                        <label for="primary_category_id" class="flex leading-7 text-sm text-gray-600">
                                            <div>プライマリーカテゴリーID</div>
                                            <div class="leading-7 ml-2 text-sm text-red-600">※必須</div>

                                        </label>
                                        <input type="text" autofocus id="primary_category_id" name="primary_category_id" value="{{ old('primary_category_id')}}" repuired class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>
                                    <div class="text-sm text-red-600">
                                        @if ($errors->has('primary_category_id'))
                                        <li>{{$errors -> first('primary_category_id')}}</li>
                                        @endif
                                    </div>
                                    <div class="mt-6">（プライマリーカテゴリ一覧）</div>
                                    @foreach ($primaries as $primary)
                                    <div class="flex ">
                                        <div class="mr-6">{{ $primary->id }}.</div>
                                        <div>{{ $primary->name}}</div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="p-2 w-full flex justify-around mt-4">
                                    <button  type="button" onclick="location.href='{{ route('admin.secondaryCategory.index') }}'" class="text-white bg-gray-400 border-0 py-2 px-8 focus:outline-none hover:bg-gray-300 rounded text-lg">戻る</button>
                                    <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-400 rounded text-lg">登録</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
