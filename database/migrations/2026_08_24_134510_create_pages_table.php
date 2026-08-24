<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('custom');
            $table->string('route_name')->nullable()->unique();
            $table->string('slug')->nullable()->unique();
            $table->string('h1');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->longText('body')->nullable();
            $table->string('status')->default('published');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        // Seed the three existing static routes as CMS-editable "system" pages,
        // pre-filled with the H1 text already hard-coded in their Blade views.
        $now = now();
        DB::table('pages')->insert([
            [
                'type' => 'system',
                'route_name' => 'home',
                'slug' => null,
                'h1' => 'Get found everywhere people search',
                'meta_title' => null,
                'meta_description' => null,
                'body' => null,
                'status' => 'published',
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type' => 'system',
                'route_name' => 'services',
                'slug' => null,
                'h1' => 'Our services',
                'meta_title' => null,
                'meta_description' => null,
                'body' => null,
                'status' => 'published',
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'type' => 'system',
                'route_name' => 'quote',
                'slug' => null,
                'h1' => 'Get a free quote',
                'meta_title' => null,
                'meta_description' => null,
                'body' => null,
                'status' => 'published',
                'published_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
