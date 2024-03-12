<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
{
    Schema::table('messages', function (Blueprint $table) {
        $table->unsignedBigInteger('article_id')->nullable()->after('recipient_id');
        $table->foreign('article_id')->references('id')->on('items')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('messages', function (Blueprint $table) {
        $table->dropForeign(['article_id']);
        $table->dropColumn('article_id');
    });
}

};
