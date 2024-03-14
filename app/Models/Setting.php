<?php

namespace App\Models;

use App\Traits\HasDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, HasDeletedScope;

    public const STUDENT = 1;
    public const FACULTY = 2;
    public const ABOUT = 3;
    public const TERMS = 4;

    protected $fillable = [
        "title", "context", "setting_type", "deleted_at"
    ];

    protected $hidden = [
        "deleted_at", "created_at", "updated_at"
    ];

    protected $casts = [
        "deleted_at" => "date"
    ];

    public function scopeStudent($query) {
        return $query->where("setting_type", self::STUDENT);
    }

    public function scopeFaculty($query) {
        return $query->where("setting_type", self::FACULTY);
    }

    public function scopeAbout($query) {
        return $query->where("setting_type", self::ABOUT);
    }

    public function scopeTerms($query) {
        return $query->where("setting_type", self::TERMS);
    }
}
