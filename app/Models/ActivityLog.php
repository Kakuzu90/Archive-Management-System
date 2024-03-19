<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLog extends Model
{
    use HasFactory;

    public const LOGIN = 1;
    public const LOGOUT = 2;
    public const ADD = 3;
    public const EDIT = 4;
    public const DELETE = 5;
    public const ACCEPT = 6;
    public const REJECT = 7;
    public const DOWNLOAD = 8;
    public const REVIEW = 9;

    public static function booted() : void {
        static::creating(function (ActivityLog $item) {
            if (Auth::id()) {
                $item->user_id = Auth::id();
            }
            $item->ip_address = request()->ip();
        });
    }

    protected $fillable = [
        "user_id", "ip_address",
        "context", "type"
    ];

    protected $hidden = [
        "created_at", "updated_at"
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeExcludeSuperAdmin($query) {
        return $query->whereNotIn("user_id", [1]); // 1 is the account of super admin
    }

    public function typeText() {
        if ($this->type === self::LOGIN) {
            return "Login";
        }
        if ($this->type === self::LOGOUT) {
            return "Logout";
        }
        if ($this->type === self::ADD) {
            return "Create";
        }
        if ($this->type === self::EDIT) {
            return "Update";
        }
        if ($this->type === self::DELETE) {
            return "Delete";
        }
        if ($this->type === self::ACCEPT) {
            return "Accept";
        }
        if ($this->type === self::REJECT) {
            return "Reject";
        }
        if ($this->type === self::DOWNLOAD) {
            return "Download";
        }
        if ($this->type === self::REVIEW) {
            return "Review";
        }
    }

    public function typeColor() {
        if (in_array($this->type, [self::LOGIN, self::LOGOUT])) {
            return "secondary";
        }
        if (in_array($this->type, [self::ACCEPT, self::ADD])) {
            return "success";
        }
        if (in_array($this->type, [self::REJECT, self::DELETE])) {
            return "danger";
        }
        return "warning";
    }
}
