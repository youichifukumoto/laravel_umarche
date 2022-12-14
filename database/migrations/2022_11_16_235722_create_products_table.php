<?php

use App\Models\Image;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('number');
            $table->string('name');
            $table->text('information')->nullable();
            $table->unsignedInteger('price');
            $table->boolean('is_selling');
            $table->integer('sort_order')->nullable();
            $table->foreignId('secondary_category_id')
            ->constrained();
            $table->foreignId('image1')
            ->nullable()
            ->constrained('images');
            $table->foreignId('image2')
            ->nullable()
            ->constrained('images');
            $table->foreignId('image3')
            ->nullable()
            ->constrained('images');
            $table->foreignId('image4')
            ->nullable()
            ->constrained('images');
            $table->foreignId('image5')
            ->nullable()
            ->constrained('images');
            $table->foreignId('image6')
            ->nullable()
            ->constrained('images');
            $table->foreignId('image7')
            ->nullable()
            ->constrained('images');
            $table->foreignId('image8')
            ->nullable()
            ->constrained('images');
            $table->foreignId('image9')
            ->nullable()
            ->constrained('images');
            $table->foreignId('image10')
            ->nullable()
            ->constrained('images');
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
        Schema::dropIfExists('products');
    }
}
