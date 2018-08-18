<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolios', function($table) {
            $table->string('production_url')->after('image')->nullable();
            $table->string('development_url')->after('image')->nullable();
            $table->dropColumn('link');
            $table->dropColumn('link_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('portfolios', function($table) {
            $table->dropColumn('production_url');
            $table->dropColumn('development_url');
            $table->string('link')->after('image');
            $table->string('link_type')->after('image');
        });
    }
}
