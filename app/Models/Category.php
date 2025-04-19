<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status', 'parent_id'];

    // parent relation
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // child relationship
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Helper functn to get full path wise name
    public function fullPath()
    {
        $path = $this->name;
        if ($this->parent) {
            $path = $this->parent->fullPath() . ' > ' . $path;
        }
        return $path;
    }
}
