<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Kolom user_id sudah ada, jadi tidak perlu apa-apa
    }

    public function down()
    {
        // Tidak perlu rollback apa-apa
    }
};
