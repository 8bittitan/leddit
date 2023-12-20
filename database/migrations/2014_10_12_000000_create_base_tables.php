<?php

use App\Models\Sub;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('display_name');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->index('username');
        });

        Schema::create('subs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->longText('description');
            $table->integer('visibility')->default(0);
            $table->timestamps();

            $table->index('name', 'subs_name_index');
            $table->index('slug', 'subs_slug_index');
            $table->index(['slug', 'visibility'], 'subs_slug_visibility_index');
        });

        Schema::create('sub_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sub_id');

            // Owner
            // Mod
            // Follower
            $table->string('role')->default('follower');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sub_id')->references('id')->on('subs');
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('name');
            $table->string('slug');
            $table->text('content');
            $table->foreignId('owner_id')->references('id')->on('users');
            $table->foreignIdFor(Sub::class);
            $table->timestamps();

            $table->index(['slug'], 'posts_slug_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('subs');
        Schema::dropIfExists('posts');
    }
};
