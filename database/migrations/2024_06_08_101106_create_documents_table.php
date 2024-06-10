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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('content');
            $table->string('version');
            $table->bigInteger('user_id')->unsigned();
            $table->string('state')->nullable();
            $table->string('document_link')->nullable();;
            $table->timestamps();
            $table->softDeletes();
            
        });

        Schema::table('documents', function($table)
        {
            $table->foreign('user_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropForeign('documents_user_id_foreig');
        Schema::dropIfExists('documents');
    }
};
