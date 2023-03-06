<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('phones', static function (Blueprint $table): void {
            $table->id();
            $table->uuid();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('slug');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->boolean('status')->default(true); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('phones');
    }
};
