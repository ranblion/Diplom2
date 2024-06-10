<x-app-layout>
    @section('title', 'Управление документами')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Управление документами') }}
        </h2>
    </x-slot>
    
    <div class="container  col-9 mt-6 ">
        
        
        <form method="GET" action="{{ route('documents.search') }}" class="mb-4">
            <div class="form-row">
                <div class="col">
                    <input type="text" name="title" class="form-control" placeholder="Поиск по заголовку">
                </div>
                <div class="col">
                    <input type="text" name="tag" class="form-control" placeholder="Поиск по категориям">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Поиск</button>
                </div>
            </div>
        </form>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Ссылка на документ</th>
                    <th>Категории</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $document)
                    <tr>
                        <td>{{ $document->title }}</td>
                        <td><a class="mb-4 btn btn-success mx-auto" href="{{ route('documents.show', $document->id) }}" target="_blank">Ссылка на документ</a></td>
                        <td> 
                            @foreach ($document->tags as $tag)
                            <p>{{$tag->name}}</p>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    

</x-app-layout>