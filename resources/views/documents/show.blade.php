<x-app-layout>
    @section('title', $document->title)
    <div class="container col-9 mt-6 ">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $document->title}}
            </h2>
        </x-slot>
    
        <hr>
        <div class="container mt-3 mb-4">
            <p class="" >Описание документа: {!! $document->content !!}</p>
            <p class="mb-4"></p>
        <hr class="mb-4">
            <p class="mb-4">Состояние документа: {{ $document->state }}</p>
            
        <hr class="mb-4">
            <p class="">Категории:  
                @foreach ($document->tags as $tag)
                <p>{{$tag->name}}</p>
                @endforeach
            </p>
        <hr class="mb-4">
            <p class="">Дата создания: {{$document->created_at}}</p>
            <p class="mb-4">Дата обновления: {{$document->updated_at}}</p>
        <hr  class="mb-4">
        
        <div class="d-flex justify-content-center align-items-center mb-4" >
            <a class="mb-4 btn btn-success mx-auto" href="{{ route('documents.download', basename($document->id)) }}" target="_blank">Скачать документ</a>
        </div>
    </div>
</x-app-layout>