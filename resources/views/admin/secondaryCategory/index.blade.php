<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            セカンドカテゴリ一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="md:p-6 bg-white border-b border-gray-200">

                    <section class="text-gray-600 body-font">
                    <div class="container md:px-5 mx-auto">
                       <x-flash-message status="session('status')"/>

                        <div class="lg:w-3/3 w-full mx-auto overflow-auto">
                             <div class="flex justify-end mb-4 mt-6">
                                <button onclick="location.href='{{ route('admin.secondaryCategory.create') }}'" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-400 rounded text-lg">新規登録</button>
                             </div>
                           <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                            <tr>
                                <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">プライマリー名</th>
                                 {{-- <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">id</th> --}}
                                <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">セコンダリー名</th>
                                <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">ソートオーダー</th>
                                {{-- <th class="md:px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">登録日</th> --}}
                                <th class="md:px-4 py-3  title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                <th class="md:px-4 py-3  title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($secondaryCategories as $secondaryCategory)
                            <tr>
                                <td class="md:px-4 py-3">{{ $secondaryCategory->primary->name}}</td>
                                {{-- <td class="md:px-4 py-3">{{ $secondaryCategory->id }}</td> --}}
                                <td class="md:px-4 py-3">{{ $secondaryCategory->name }}</td>
                                {{-- <td class="px-4 py-3">{{ $owner->created_at->diffForHumans()}}</td> --}}
                                <td class="md:px-4 py-3">{{ $secondaryCategory->sort_order }}</td>
                                <td class="md:px-4 py-3">
                                <button onclick="location.href='{{ route('admin.secondaryCategory.edit', ['secondaryCategory' => $secondaryCategory->id])}}'" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-400 rounded ">編集</button>
                                </td>
                                <form id="delete_{{$secondaryCategory->id}}" method="POST" action="{{ route('admin.secondaryCategory.destroy', ['secondaryCategory' => $secondaryCategory->id])}}">
                                    @csrf
                                    @method('delete')
                                   <td class="md:px-4 py-3">
                                <a href="#" data-id="{{ $secondaryCategory->id }}" onclick="deletePost(this)" class="text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-400 rounded ">削除</a>
                                   </td>
                                </form>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $secondaryCategories->links() }}
                        </div>
                    </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
<script>
 function deletePost(e) {
 'use strict';
    if (confirm('本当に削除してもいいですか?')) {
        document.getElementById('delete_' + e.dataset.id).submit();
        }
}
</script>
</x-app-layout>



