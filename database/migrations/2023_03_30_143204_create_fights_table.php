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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->comment("用戶id");
            $table->text("category_id")->comment("分類id");
            $table->string("tittle")->comment("文章標題");
            $table->text("content")->comment("文章內容");
            $table->tinyInteger("status")->default(1)->comment("文章狀態 0未發布 1發布");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
