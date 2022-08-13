<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bu_gits', function (Blueprint $table) {
            $table
                ->foreign('owner_id')
                ->references('id')
                ->on('owners')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bu_gits', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
        });
    }
};
