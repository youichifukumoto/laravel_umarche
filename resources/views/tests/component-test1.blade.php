<x-tests.app>
    <x-slot name="header">ヘッダー1</x-slot>
テスト1

<x-tests.card title="タイトル" content="本文" :massage="$massage"/>
<x-tests.card title="タイトル100" />
<x-tests.card title="cssを変更したい" class="bg-red-300" />
</x-tests.app>
