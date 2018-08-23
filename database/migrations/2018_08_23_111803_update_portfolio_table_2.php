<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePortfolioTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('portfolios', function($table) {
            $table->string('credential_file')->after('company')->nullable();
            $table->string('credential_file_desc')->after('company')->nullable();
            $table->string('database_backup_file')->after('company')->nullable();
            $table->string('database_backup_desc')->after('company')->nullable();
            $table->string('project_backup_file')->after('company')->nullable();
            $table->string('project_backup_desc')->after('company')->nullable();
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
            $table->dropColumn('credential_file');
            $table->dropColumn('credential_file_desc');
            $table->dropColumn('database_backup_file');
            $table->dropColumn('database_backup_desc');
            $table->dropColumn('project_backup_file');
            $table->dropColumn('project_backup_desc');
        });
    }
}
