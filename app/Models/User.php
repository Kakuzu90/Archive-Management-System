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
        "deleted_at", "avatar"
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

    public function getFullNameAttribute() {
        return $this->first_name . " " . $this->middle_name[0] . ". " . $this->last_name;
    }

    public function getFirstNameAttribute($value) {
        return $this->attributes["first_name"] = ucwords($value);
    }

    public function getMiddleNameAttribute($value) {
        return $this->attributes["middle_name"] = ucwords($value);
    }

    public function getLastNameAttribute($value) {
        return $this->attributes["last_name"] = ucwords($value);
    }

    public function scopeNotVerify($query) {
        return $query->where("verified_at", null)->where("role_id", "!=", Role::SUPER_ADMIN);
    }

    public function scopeStudent($query) {
        return $query->where("role_id", Role::STUDENT);
    }

    public function scopeFaculty($query) {
        return $query->where("role_id", Role::FACULTY);
    }

    public function scopeAdmin($query) {
        return $query->where("role_id", Role::ADMIN);
    }
    
    public function college() {
        return $this->belongsTo(College::class);
    }

    public function books() {
        return $this->hasMany(Books::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function roleColor() {
        if ($this->role_id === Role::ADMIN) {
            return "secondary";
        }
        if ($this->role_id === Role::FACULTY) {
            return "info";
        }
        return "primary";
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

    public function avatar() {
        return asset("assets/img/avatar/avatar-" . $this->avatar . ".png");
    }
}
