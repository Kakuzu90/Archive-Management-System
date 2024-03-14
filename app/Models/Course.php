<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Traits\HasDeletedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, HasDeletedScope;

    protected $fillable = [
        "name", "slug", "college_id", "deleted_at"
    ];

    protected $hidden = [
        "deleted_at", "created_at", "updated_at"
    ];

    protected $casts = [
        "deleted_at" => "date"
    ];

    public function setNameAttribute($value) {
        return $this->attributes["name"] = strtolower($value);
    }

    public function setSlugAttribute($value) {
        return $this->attributes["slug"] = Str::slug($value);
    }

    public function getNameAttribute($value) {
        return $this->attributes["name"] = ucwords($value);
    }

    public function college() {
        return $this->belongsTo(College::class);
    }
}
