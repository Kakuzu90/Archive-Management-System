<?php

namespace App\Models;

use App\Traits\HasDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, HasDeletedScope;

    protected $fillable = [
        "first_name", "middle_name", "last_name",
        "username", "password", "college_id",
        "role_id", "year_level", "verified_at",
        "deleted_at"
    ];

    protected $hidden = [
        "deleted_at", "created_at", "updated_at",
        "password", "remember_token",
    ];

    protected $casts = [
        "deleted_at" => "date",
        "verified_at" => "date",
    ];

    public function setFirstNameAttribute($value) {
        return $this->attributes["first_name"] = strtolower($value);
    }

    public function setMiddleNameAttribute($value) {
        return $this->attributes["middle_name"] = strtolower($value);
    }

    public function setLastNameAttribute($value) {
        return $this->attributes["last_name"] = strtolower($value);
    }

    public function setPasswordAttribute($value) {
        return $this->attributes["password"] = Hash::make($value);
    }

    public function getFirstNameAttribute() {
        return $this->first_name . " " . $this->middle_name[0] . ". " . $this->last_name;
    }
    
    public function college() {
        return $this->belongsTo(College::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function accountText() {
        if ($this->verified_at) {
            return "Verified";
        }
        return "Pending";
    }

    public function accountColor() {
        if ($this->verified_at) {
            return "success";
        }
        return "danger";
    }
}
