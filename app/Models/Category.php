<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'image',
        'parent_id',
        'level',
        'is_active',
        'is_delete',
    ];

    /**
     * Get the parent category
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the level/depth of this category in the hierarchy
     * Level 1 = no parent, Level 2 = has parent, etc.
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Get all descendants (children, grandchildren, etc.) of this category
     */
    public function getAllDescendants()
    {
        $descendants = [];
        $children = Category::where('parent_id', $this->id)->get();
        
        foreach ($children as $child) {
            $descendants[] = $child->id;
            // Recursively get descendants of each child
            $descendants = array_merge($descendants, $child->getAllDescendants());
        }
        
        return $descendants;
    }

    /**
     * Boot the model
     */
}
