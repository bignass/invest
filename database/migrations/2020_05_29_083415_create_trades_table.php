<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('trades', function (Blueprint $table) {
      $table->id();
      $table->unsignedInteger('user');
      $table->string('stock', 10);
      $table->integer('active_shares');
      $table->integer('number_of_shares_bought');
      $table->integer('number_of_shares_sold')->nullable();
      $table->date('open_time');
      $table->date('close_time')->nullable();
      $table->decimal('open_price');
      $table->decimal('close_price')->nullable();
      $table->text('buy_notes')->nullable();
      $table->text('close_notes')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('trades');
  }
}
