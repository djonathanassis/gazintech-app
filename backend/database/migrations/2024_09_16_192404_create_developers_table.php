<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    final public function up(): void
    {
        Schema::create('developers', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')->constrained('levels');
            $table->string('name');
            $table->char('sex');
            $table->dateTime('dt_birth');
            $table->integer('age');
            $table->string('hobby');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    final public function down(): void
    {
        Schema::dropIfExists('developers');
    }
};
