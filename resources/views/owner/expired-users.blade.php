<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            削除中の顧客一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <section class="text-gray-600 body-font">
                    <div class="container px-5 mx-auto">

                       <x-flash-message status="session('status')"/>

                        <div class="lg:w-3/3 w-full mx-auto overflow-auto">
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                            <thead>
                            <tr>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ショップ名</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">メールアドレス</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">掛け率</th>
                                <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">期限切れ日</th>
                                <th class="px-4 py-3  title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                                <th class="px-4 py-3  title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($expiredUsers as $user)
                            <tr>
                                <td class="px-4 py-3">{{ $user->name }}</td>
                                <td class="px-4 py-3">{{ $user->email }}</td>
                                <td class="px-4 py-3">{{ $user->betting_rate }}％</td>
                                <td class="px-4 py-3">{{ $user->deleted_at}}</td>
                                <td class="px-4 py-3">
                                <a href="#" data-id="{{ $user->id }}" onclick="deletePost(this)" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-400 rounded">復元</a>
                                   </td>
                                <form id="delete_{{$user->id}}" method="POST" action="{{ route('owner.expired-users.destroy',  ['user'=>$user->id])}}">
                                    @csrf
                                   <td class="px-4 py-3">
                                <a href="#" data-id="{{ $user->id }}" onclick="deletePost(this)" class="text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-400 rounded ">完全に削除</a>
                                   </td>
                                </form>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
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
