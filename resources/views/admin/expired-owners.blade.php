<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            削除中のメーカー一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <section class="text-gray-600 body-font">
                    <div class="container px-5 mx-auto">

                       <x-flash-message status="session('status')"/>
                        @if (count($expiredOwners) > 0)
                        <div class="lg:w-3/3 w-full mx-auto overflow-auto">
                                <div class="flex justify-end mb-4 mt-6">
                                <button onclick="location.href='restore_all'" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-400 rounded text-lg">全件復元</button>
                             </div>
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                             <thead>
                            <tr>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">メーカー名</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">期限切れ日</th>
                                <th class="px-4 py-3  title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                <th class="px-4 py-3  title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($expiredOwners as $owner)
                            <tr>
                                <td class="px-4 py-3">{{ $owner->name }}</td>
                                <td class="px-4 py-3">{{ $owner->email }}</td>
                                {{-- <td class="px-4 py-3">{{ $owner->created_at}}</td> --}}
                                <td class="px-4 py-3">{{ $owner->deleted_at}}</td>
                                <td class="px-4 py-3">
                                    <a href="restore/{{ $owner->id }}"  class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-400 rounded">復元</a>
                                </td>
                                <form id="delete_{{$owner->id}}" method="POST" action="{{ route('admin.expired-owners.destroy',  ['owner'=>$owner->id])}}">
                                    @csrf
                                   <td class="px-4 py-3">
                                <a href="#" data-id="{{ $owner->id }}" onclick="deletePost(this)" class="text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-400 rounded ">完全に削除</a>
                                   </td>
                                </form>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                            @else
                             <div class='flex justify-center'>削除中のメーカー情報はありません。</div>
                            @endif
                        </div>
                    </div>
                    </section>
                    {{--クエリービルダー
                     @foreach ($q_get as $q_owner)
                    {{ $q_owner->name }}
                    {{ Carbon\Carbon::parse($q_owner->created_at)->diffForHumans() }}
                    @endforeach--}}
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
