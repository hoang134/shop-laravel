<?php

use App\Helpers\Constant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('url_product');
            $table->bigInteger('category_id');
            $table->string('url_image')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->double('price');
            $table->unsignedInteger('quantity');
            $table->enum('status', [
                Constant::STATUS_DELETED,
                Constant::STATUS_ACTIVE,
                Constant::STATUS_INACTIVE
            ])->default(Constant::STATUS_ACTIVE);
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
