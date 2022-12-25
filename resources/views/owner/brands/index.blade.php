<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ブランド情報
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                      <x-flash-message status="session('status')"/>
                    @foreach ($brands as $brand)
                    <div class="md:w-1/2 p-4"> {{-- このw-2を記載すると画面の表示を2分割している--}}
                         <a href="{{ route('owner.brands.edit', ['brand' => $brand->id]) }}">
                      <div class="border rounded-md p-4">
                          <div class="mb-4">
                           @if ($brand->is_selling)
                             <span class="border p-2 rounded-md bg-blue-400 text-white">受注受付中</span>
                           @else
                             <span class="border p-2 rounded-md bg-red-400 text-white">受注受付終了</span>
                           @endif
                          </div>
                          <div class="text-xl">{{ $brand -> brand_name }}</div>
                          <x-thumbnail  :filename="$brand->filename" type="brands" />
                      </div>
                      </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
