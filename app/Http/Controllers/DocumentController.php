<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\View\Docum;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\Tag;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Cache;

class DocumentController extends Controller
{
   
    public function index()
    {
        $documents = Document::orderBy('created_at', 'desc')->get();
        
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        if (auth()->user()) {
            // Код для редактирования статьи
        } else {
            // Ошибка доступа
            abort(403);
        }
        $tags = Tag::all();
        return view('documents.create',['tags'=>$tags]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'version' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'document_link' => 'nullable|string|max:255',
        ]);
        $document = new Document();
        $path = $request->file('file')->store('documents');
        $document->title = $request->input('title');
        $document->content = $request->input('content');
        $document->version = "0";
        $document->user_id = Auth::id(); // Предполагается, что пользователь аутентифицирован
        $document->state = $request->input('state');
        $document->document_link = $path;
        $document->save();
        
        $tags = $request->input('tags');
        $document->tags()->attach($tags);

        return redirect()->route('documents.index')->with('success', 'Document uploaded successfully.');
    }

    public function show($id)
    {
        $document = Document::findOrFail($id);
        return view('documents.show', compact('document'));
    }

    public function destroy(Document $document)
    {
        Storage::disk('s3')->delete($document->document_link);
        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document deleted successfully.');
    }
    public function search(Request $request)
    {
        $query = Document::query();

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->tag . '%');
            });
        }

        $cacheKey = 'documents_search_' . md5(serialize($request->all()));

        // Кэшируем результаты запроса на 60 минут
        $documents = Cache::remember($cacheKey, 60, function () use ($query) {
            return $query->get();
        });

        
        return view('documents.index', compact('documents'));

    }
    
    public function download($id)
    {
        // Найти документ по ID
        $document = Document::findOrFail($id);

        // Путь к файлу
        $filePath = storage_path('app/' . $document->document_link);

        // Проверка существования файла
        if (!file_exists($filePath)) {
            abort(404);
        }
        else{return response()->download($filePath, $document->title);}
        
    }
}
