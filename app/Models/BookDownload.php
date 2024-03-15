<?php

namespace App\Models;

use App\Traits\HasDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BookDownload extends Model
{
    use HasFactory, HasDeletedScope;

    protected $fillable = [
        "book_id", "user_id", "deleted_at"
    ];

    protected $hidden = [
        "deleted_at", "created_at", "updated_at"
    ];

    protected $casts = [
        "deleted_at" => "date"
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function book() {
        return $this->belongsTo(Books::class);
    }

    public function scopeIsNotAlreadyDownloaded($query, $id) {
        return $query->where("book_id", $id)->where("user_id", Auth::id())->doesnExist();
    }
}
