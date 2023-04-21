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
        Schema::create('soncomments', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->comment("用戶id");
            $table->integer("blog_id")->comment("文章id");
            $table->integer("comment_id")->comment("父留言");
            $table->text("content")->comment("留言內容");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soncomments');
    }
};
