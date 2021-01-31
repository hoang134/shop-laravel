<?php

use App\Helpers\Constant;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->enum('role', [User::ROLE_USER, User::ROLE_ADMIN]);
            $table->string('email')->unique();
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
}
