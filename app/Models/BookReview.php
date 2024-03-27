<?php

namespace App\Models;

use App\Scopes\Deleted;
use App\Traits\HasDeletedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookReview extends Model
{
    use HasFactory, HasDeletedScope;

    protected $fillable = [
        "book_id", "user_id", "rate",
        "comment", "deleted_at"
    ];

    protected $hidden = [
        "deleted_at", "created_at", "updated_at"
    ];

    protected $casts = [
        "deleted_at" => "date",
    ];

    public function user() {
        return $this->belongsTo(User::class)->withoutGlobalScope([Deleted::class]);
    }

    public function book() {
        return $this->belongsTo(Books::class)->withoutGlobalScope([Deleted::class]);
    }
}
