<x-app-layout>
    @section('title', 'Поиск документов')
    <div class="container ">
        <h1 class="mb-4">Document Management</h1>
        
        
        <form method="GET" action="{{ route('documents.search') }}" class="mb-4">
            <div class="form-row">
                <div class="col">
                    <input type="text" name="title" class="form-control block mt-1 w-full" placeholder="Search by title">
                </div>
                <div class="col">
                    <input type="text" name="tag" class="form-control block mt-1 w-full" placeholder="Search by tag">
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-success">Search</button>
                </div>
            </div>
        </form>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Document Link</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documents as $document)
                    <tr>
                        <td>{{ $document->title }}</td>
                        <td><a href="{{ $document->id }}" target="_blank">View Document</a></td>
                        <td>
                            <form action="{{ route('documents.destroy', $document->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</x-app-layout>