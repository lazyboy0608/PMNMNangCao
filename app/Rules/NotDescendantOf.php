<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Category;

class NotDescendantOf implements ValidationRule
{
    protected $categoryId;

    public function __construct($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Nếu không chọn parent, validation pass
        if (!$value) {
            return;
        }

        $currentCategory = Category::find($this->categoryId);
        $parentCategory = Category::find($value);

        if (!$parentCategory) {
            $fail('Parent category not found.');
            return;
        }

        // Khi chỉnh sửa: kiểm tra không được là chính nó
        if ($this->categoryId && $value == $this->categoryId) {
            $fail('A category cannot be its own parent.');
            return;
        }

        // Kiểm tra: parent phải có level nhỏ hơn category hiện tại
        // (parent phải cấp cao hơn)
        if ($currentCategory && $parentCategory->level >= $currentCategory->level) {
            $fail('Parent category must have a higher level (lower level number) than the current category.');
            return;
        }

        // Kiểm tra: parent không được là con cháu của category này
        if ($this->isDescendant($value, $this->categoryId)) {
            $fail('A category cannot be a parent of its own descendant.');
            return;
        }
    }

    /**
     * Kiểm tra xem $parentId có phải là con cháu của $categoryId không
     */
    protected function isDescendant($parentId, $categoryId)
    {
        $children = Category::where('parent_id', $categoryId)->pluck('id')->toArray();

        if (in_array($parentId, $children)) {
            return true;
        }

        // Kiểm tra con cháu (descendants)
        foreach ($children as $childId) {
            if ($this->isDescendant($parentId, $childId)) {
                return true;
            }
        }

        return false;
    }
}
