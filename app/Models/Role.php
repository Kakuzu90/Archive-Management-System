<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Traits\HasDeletedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory, HasDeletedScope;

    public const ADMIN = 1;
    public const FACULTY = 2;
    public const STUDENT = 3;

    protected $fillable = [
        "name", "slug", "deleted_at"
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
}
