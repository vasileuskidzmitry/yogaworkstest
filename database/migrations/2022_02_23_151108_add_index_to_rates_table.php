<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rates', function (Blueprint $table) {
            $table->index(
                ['base_currency_code', 'timestamp'],
                'rates_base_timestamp_index'
            );

            $table->unique(
                ['base_currency_code', 'target_currency_code', 'timestamp'],
                'rates_base_target_timestamp_index'
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rates', function (Blueprint $table) {
            $table->dropIndex('rates_base_timestamp_index');
            $table->dropIndex('rates_base_target_timestamp_index');
        });
    }
};
