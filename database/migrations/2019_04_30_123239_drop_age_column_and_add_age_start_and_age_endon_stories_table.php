<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropAgeColumnAndAddAgeStartAndAgeEndonStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->dropColumn('age');
            $table->integer("age_from")->default(1)->after("image_name");
            $table->integer("age_to")->default(5)->after("age_from");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stories', function (Blueprint $table) {
            $table->string("age")->after("image_name");
            $table->dropColumn("age_from");
            $table->dropColumn("age_to");
        });
    }
}
