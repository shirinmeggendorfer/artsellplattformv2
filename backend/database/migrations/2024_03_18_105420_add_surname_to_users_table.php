<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname')->after('name')->nullable(); // Fügt die Spalte nach der 'name'-Spalte hinzu und macht sie optional
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('surname'); // Entfernt die Spalte, falls die Migration rückgängig gemacht wird
        });
    }
};
