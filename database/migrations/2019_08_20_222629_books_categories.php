<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BooksCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('book_id')
                ->comment('идентификатор книги');
            $table->unsignedBigInteger('category_id')
                ->comment('идентификатор категории');
        });

        Schema::table('books_categories', function (Blueprint $table) {
            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumns('books_categories', ['book_id', 'categories_id'])) {
            Schema::table('books_categories', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
                $table->dropForeign(['book_id']);
            });
        }

        Schema::dropIfExists('books_categories');
    }
}
