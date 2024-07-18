<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->unsignedSmallInteger('response_code')->default(\Symfony\Component\HttpFoundation\Response::HTTP_OK);
            $table->string('response_content_type')->nullable();
            $table->string('response_body')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->unique([
                'user_id',
                'name',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
