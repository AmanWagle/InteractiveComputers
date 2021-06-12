<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $appends = ['icon_url', 'parent_level', 'category_full_name'];

    protected $fillable = ['name', 'slug', 'icon', 'parent_id', 'status', 'is_featured', 'meta_title', 'meta_keywords', 'meta_description'];

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id');
    }

    public function getIconUrlAttribute()
    {
        return url("/storage/images/uploads/{$this->icon}");
    }

    public function getParentLevelAttribute()
    {
        $level = [];
        $category = $this;
        if ($category->parent) {
            while ($category->parent) {
                $parent = $category->parent;
                array_push($level, $parent->name);
                $category = ProductCategory::find($parent->id);
            }
        }
        return implode(' / ', array_reverse($level));
    }

    public function getCategoryFullNameAttribute()
    {
        $parent_level = $this->parent_level;
        return ($this->parent_id) ? $parent_level . ' / ' . $this->name  : $this->name;
    }

}
