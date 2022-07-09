<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('tadas', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id');
      $table->foreign('user_id')->references('id')->on('users')
        ->onDelete('cascade');
      $table->unsignedBigInteger('tada_list_id');
      $table->foreign('tada_list_id')->references('id')->on('tada_lists')
        ->onDelete('cascade');
      $table->string('name');
      $table->boolean('is_completed')->default(false);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('tadas');
  }
};
