<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('document_tag', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('document_id')->unsigned();
            $table->bigInteger('tag_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('document_tag', function($table)
        {
            $table->foreign('document_id')
            ->references('id')->on('documents');
            $table->foreign('tag_id')
            ->references('id')->on('tags');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_tag');
    }
};
