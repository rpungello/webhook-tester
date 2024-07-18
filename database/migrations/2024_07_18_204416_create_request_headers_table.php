<?php

use App\Models\Request;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('request_headers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Request::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('value');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('request_headers');
    }
};
