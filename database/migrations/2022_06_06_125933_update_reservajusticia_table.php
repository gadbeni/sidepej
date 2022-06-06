<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateReservajusticiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservajusticias', function (Blueprint $table) {
            $table->smallInteger('status')->default(1);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reservajusticias', function (Blueprint $table) {
            $table->dropColumn(['status', 'deleted_at']);
            $table->dropColumn(['deleted_at']);
        });
    }
}
