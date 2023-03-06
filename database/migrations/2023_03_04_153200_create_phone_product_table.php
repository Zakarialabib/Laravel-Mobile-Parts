<?php

use App\Models\Phone;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhoneProductTable extends Migration
{
    public function up()
    {
        Schema::create('phone_product', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Phone::class)->constrained()->restrictOnDelete();
            $table->foreignIdFor(Product::class)->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('phone_product');
    }
}