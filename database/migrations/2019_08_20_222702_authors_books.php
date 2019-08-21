<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuthorsBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors_books', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id')
                ->comment('идентификатор категории');
            $table->unsignedBigInteger('book_id')
                ->comment('идентификатор книги');
        });

        Schema::table('authors_books', function (Blueprint $table) {
            $table->foreign('book_id')
                ->references('id')
                ->on('books')
                ->onDelete('cascade');

            $table->foreign('author_id')
                ->references('id')
                ->on('authors')
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
        if (Schema::hasColumns('authors_books', ['author_id', 'book_id'])) {
            Schema::table('authors_books', function (Blueprint $table) {
                $table->dropForeign(['author_id']);
                $table->dropForeign(['book_id']);
            });
        }

        Schema::dropIfExists('authors_books');
    }
}
