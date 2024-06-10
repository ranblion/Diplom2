<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download($filePath)
    {
        $pathofFile =storage_path('app/' .$filePath);
        // Проверяем, существует ли файл
        if (Storage::disk('local')->exists($pathofFile)) {
            // Скачиваем файл
            return response()->download($pathofFile);
        } else {
            
        }
    }
}
