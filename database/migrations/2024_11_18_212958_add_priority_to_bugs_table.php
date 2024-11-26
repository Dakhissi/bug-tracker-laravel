<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bugs', function (Blueprint $table) {
            $table->string('priority')->default('P3'); 
        });
    }
    
    public function down()
    {
        Schema::table('bugs', function (Blueprint $table) {
            $table->dropColumn('priority');
        });
    }
};
