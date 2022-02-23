<?php

declare(strict_types=1);

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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();

            $table->foreignUuid('base_currency_code')
                ->references('code')
                ->on('currencies')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignUuid('target_currency_code')
                ->references('code')
                ->on('currencies')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->float('rate', 15, 5, true);
            $table->timestamp('timestamp');

            $table->index('base_currency_code');
            $table->index('target_currency_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rates');
    }
};
