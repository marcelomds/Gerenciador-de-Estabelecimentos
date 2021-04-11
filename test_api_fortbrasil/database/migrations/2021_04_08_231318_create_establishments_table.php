<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEstablishmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishments', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('fantasy_name')->nullable();
            $table->string('document');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('complement')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('establishments')->insert([
            [
                'company_name' => 'MM Barbershop',
                'fantasy_name' => 'Barbearia do Marcelo',
                'document' => '038.254.654-30',
                'phone' => '(85) 99819-3813',
                'email' => 'marcelo_mmds@hotmail.com',
                'street' => 'Rua João Gentil',
                'number' => '469',
                'neighborhood' => 'Benfica',
                'complement' => 'Ap 126',
                'state' => 'CE',
                'city' => 'Fortaleza',
                'zipcode' => '60020100'
            ],
            [
                'company_name' => 'Pizzaria Ltda',
                'fantasy_name' => 'Nossa Pizza',
                'document' => '62.652.665/0001-56',
                'phone' => '(85) 99632-6512',
                'email' => 'pizzaria@email.com',
                'street' => 'Rua Waldery Uchôa',
                'number' => '498',
                'neighborhood' => 'Benfica',
                'complement' => 'casa',
                'state' => 'CE',
                'city' => 'Fortaleza',
                'zipcode' => '60020110'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('establishments');
    }
}
