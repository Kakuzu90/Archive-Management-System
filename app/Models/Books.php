<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Traits\HasDeletedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Books extends Model
{
    use HasFactory, HasDeletedScope;

    public const PENDING = 1;
    public const ACCEPTED = 2;
    public const REJECTED = 3;

    protected $fillable = [
        "user_id", "title", "slug", "book_type",
        "abstract", "college_id", "published_at",
        "book_status", "deleted_at"
    ];

    protected $hidden = [
        "deleted_at", "created_at", "updated_at"
    ];

    protected $casts = [
        "deleted_at" => "date",
        "published_at" => "date"
    ];

    public function setSlugAttribute($value) {
        return $this->attributes["slug"] = Str::slug($value);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function reviews() {
        return $this->hasMany(BookReview::class);
    }

    public function downloads() {
        return $this->hasMany(BookDownload::class);
    }

    public function college() {
        return $this->belongsTo(College::class);
    }

    public function scopeByCollege($query, $id) {
        return $query->where("college_id", $id);
    }

    public function statusText() {
        if ($this->book_status == self::PENDING) {
            return "Pending";
        }else if ($this->book_status == self::ACCEPTED) {
            return "Accepted";
        }

        return "Rejected";
    }

    public function statusColor() {
        if ($this->book_status == self::PENDING) {
            return "warning";
        }else if ($this->book_status == self::ACCEPTED) {
            return "success";
        }

        return "danger";
    }

}
