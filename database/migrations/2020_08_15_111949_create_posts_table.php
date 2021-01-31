<?php

use App\Helpers\Constant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('url_post');
            $table->string('url_image');
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->bigInteger('user_id');
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
        Schema::dropIfExists('posts');
    }
}
