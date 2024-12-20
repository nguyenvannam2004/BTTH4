<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('computers', function (Blueprint $table) {
        // Cho phép các trường dưới đây có thể NULL
        $table->string('operating_system')->nullable()->change();
        $table->string('processor')->nullable()->change();
        $table->string('memory')->nullable()->change();
        $table->boolean('available')->nullable()->change(); // Nếu là boolean thì dùng nullable() 
    });
}

public function down()
{
    Schema::table('computers', function (Blueprint $table) {
        // Khi rollback, không cho phép các trường này là NULL
        $table->string('operating_system')->nullable(false)->change();
        $table->string('processor')->nullable(false)->change();
        $table->string('memory')->nullable(false)->change();
        $table->boolean('available')->nullable(false)->change();
    });
}

};
