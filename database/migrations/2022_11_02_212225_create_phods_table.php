<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhodsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Schema::hasTable('phods')) {
            Schema::create('phods', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('place');
                $table->string('image');
                $table->text('body');
                $table->foreignId('user_id')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->foreignId('tag_id')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('phods');
    }
}
