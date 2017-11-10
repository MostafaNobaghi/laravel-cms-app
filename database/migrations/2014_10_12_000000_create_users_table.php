<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('role_id')->index();
            $table->integer('is_active')->default(0)->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });


        // Insert admin user
        DB::table('users')->insert(
            array(
                'role_id' => 1,
                'is_active' => 1,
                'name' => 'admin',
                'email' => 'admin@domain.com',
                'password' => '$2y$10$d..YjTVD.cbZqdQpJaXHO.upT5zEJs7I13Ides.kzdYrnCiJDMUSy',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
