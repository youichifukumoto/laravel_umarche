@props(['status' => 'info'])

@php
if(session('status') === 'info'){ $bgColor = 'bg-blue-300';}
if(session('status') === 'alert'){$bgColor = 'bg-red-500';}
@endphp

@if(session('message'))
    <div class="{{ $bgColor }} w-1/2 mx-auto p-2 mb-7 text-white text-center">
    {{ session('message' )}}
    </div>
@endif
