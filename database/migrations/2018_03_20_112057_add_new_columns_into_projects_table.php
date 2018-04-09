<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsIntoProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('status')->index();
            $table->string('type')->index();
            $table->integer('hours')->index()->nullable();
            $table->string('priority')->index();
            $table->date('date_end')->index()->nullable();
        });

        if (class_exists('App\Models\Project')) {
            \App\Models\Project::query()->update([
                'status'   => 'ACTIVE',
                'type'     => 'FIXED',
                'priority' => 'LOW'
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('status')->dropIndex('status');
            $table->dropColumn('type')->dropIndex('type');
            $table->dropColumn('hours')->dropIndex('hours');
            $table->dropColumn('priority')->dropIndex('priority');
            $table->dropColumn('date_end')->dropIndex('date_end');
        });
    }
}
