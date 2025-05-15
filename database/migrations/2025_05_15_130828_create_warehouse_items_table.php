<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehouseItemsTable extends Migration
{
    public function up()
    {
        Schema::create('warehouse_items', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->text('description')->nullable();
            $t->unsignedInteger('quantity')->default(0);
            $t->decimal('price',10,2)->default(0);
            $t->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('warehouse_items');
    }
}
