<x-app-layout>
<div class="container">
    <h1 class="mb-4">Upload Document</h1>
    
    <form action="{{ route('documents.store') }}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Заголовок</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="content">Содержание</label>
            <input type="text" id="content" name="content" required>
        </div>
        <div>
            <label for="version">Версия</label>
            <input type="text" id="version" name="version" required>
        </div>
        <div>
            <label for="state">Состояние</label>
            <input type="text" id="state" name="state">
        </div>
        <div>
            <label for="document_link">Ссылка на документ</label>
            <input type="text" id="document_link" name="document_link">
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Upload File</label>
            <input type="file" class="form-control" id="file" name="file" required>
        </div>
        <button type="submit" class="btn btn-primary ms-3">Upload</button>
        @foreach($tags as $tag)
            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"> {{ $tag->name }}<br>
        @endforeach
        <button type="submit">Добавить документ</button>
    </form>
</div>

</x-app-layout>
