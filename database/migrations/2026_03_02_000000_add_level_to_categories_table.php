<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('level')->default(1)->after('parent_id');
        });

        // Tính toán level dựa trên parent_id
        $this->calculateLevels();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('level');
        });
    }

    /**
     * Tính toán level cho tất cả danh mục
     */
    private function calculateLevels()
    {
        // Lấy tất cả danh mục, sắp xếp để parent được xử lý trước con
        $categories = Category::orderBy('parent_id')->get();

        foreach ($categories as $category) {
            if (!$category->parent_id) {
                // Không có parent → level 1
                $category->level = 1;
            } else {
                // Có parent → level = level của parent + 1
                $parent = Category::find($category->parent_id);
                if ($parent) {
                    $category->level = $parent->level + 1;
                } else {
                    $category->level = 1;
                }
            }
            $category->save();
        }
    }
};
