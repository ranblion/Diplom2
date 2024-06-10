<?php
namespace App\Observers;

use App\Models\Document;
use Illuminate\Support\Facades\Cache;

class DocumentObserver
{
    public function created(Document $document)
    {
        Cache::forget('documents');
    }

    public function updated(Document $document)
    {
        Cache::forget('documents');
        Cache::forget('documents_search_' . $document->title);
    }

    public function deleted(Document $document)
    {
        Cache::forget('documents');
        Cache::forget('documents_search_' . $document->title);
    }
}
