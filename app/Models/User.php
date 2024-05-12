<?php

namespace App\Models;

use App\Scopes\Deleted;
use App\Traits\HasDeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
	use HasFactory, HasDeletedScope;

	protected $fillable = [
		"first_name", "middle_name", "last_name",
		"username", "password", "college_id",
		"role_id", "year_level", "verified_at",
		"deleted_at", "avatar", "verified_till_at"
	];

	protected $hidden = [
		"deleted_at", "created_at", "updated_at",
		"password", "remember_token",
	];

	protected $casts = [
		"deleted_at" => "date",
		"verified_at" => "date",
		"verified_till_at" => "date"
	];

	public function setFirstNameAttribute($value)
	{
		return $this->attributes["first_name"] = strtolower($value);
	}

	public function setMiddleNameAttribute($value)
	{
		return $this->attributes["middle_name"] = strtolower($value);
	}

	public function setLastNameAttribute($value)
	{
		return $this->attributes["last_name"] = strtolower($value);
	}

	public function setPasswordAttribute($value)
	{
		return $this->attributes["password"] = Hash::make($value);
	}

	public function getFullNameAttribute()
	{
		$ini = " ";
		if ($this->middle_name) {
			$ini = $this->middle_name[0] . ". ";
		}
		return $this->first_name . " " . $ini . $this->last_name;
	}

	public function getFirstNameAttribute($value)
	{
		return $this->attributes["first_name"] = ucwords($value);
	}

	public function getMiddleNameAttribute($value)
	{
		return $this->attributes["middle_name"] = ucwords($value);
	}

	public function getLastNameAttribute($value)
	{
		return $this->attributes["last_name"] = ucwords($value);
	}

	public function scopeNotVerify($query)
	{
		$query->where("verified_at", null)->where("role_id", "!=", Role::SUPER_ADMIN);
		if (Auth::user()->isAdmin()) {
			$query->where("college_id", Auth::user()->college_id);
		}
		return $query;
	}

	public function scopeStudent($query)
	{
		$query->where("role_id", Role::STUDENT);
		if (Auth::user()->isAdmin()) {
			$query->where("college_id", Auth::user()->college_id);
		}
		return $query;
	}

	public function scopeFaculty($query)
	{
		$query->where("role_id", Role::FACULTY);
		if (Auth::user()->isAdmin()) {
			$query->where("college_id", Auth::user()->college_id);
		}
		return $query;
	}

	public function scopeAdmin($query)
	{
		$query->where("role_id", Role::ADMIN);
		if (Auth::user()->isAdmin()) {
			$query->where("college_id", Auth::user()->college_id);
		}
		return $query;
	}

	public function canUpload()
	{
		return $this->isStudent() && in_array($this->year_level, ["4th Year", "5th Year"]);
	}

	public function isSuperAdmin()
	{
		return $this->role_id === Role::SUPER_ADMIN;
	}

	public function isAdmin()
	{
		return $this->role_id === Role::ADMIN;
	}

	public function isStudent()
	{
		return $this->role_id === Role::STUDENT;
	}

	public function isFaculty()
	{
		return $this->role_id === Role::FACULTY;
	}

	public function college()
	{
		return $this->belongsTo(College::class)->withoutGlobalScope(Deleted::class);
	}

	public function books()
	{
		return $this->hasMany(Books::class)->withoutGlobalScope(Deleted::class);
	}

	public function role()
	{
		return $this->belongsTo(Role::class)->withoutGlobalScope(Deleted::class);
	}

	public function roleColor()
	{
		if ($this->role_id === Role::ADMIN) {
			return "secondary";
		}
		if ($this->role_id === Role::FACULTY) {
			return "info";
		}
		return "primary";
	}

	public function accountText()
	{
		if ($this->verified_at) {
			if (Carbon::today()->gt($this->verified_till_at)) {
				return "Expired";
			} else {
				return "Verified";
			}
		}
		return "Pending";
	}

	public function accountColor()
	{
		if ($this->verified_at) {
			if (Carbon::today()->gt($this->verified_till_at)) {
				return "warning";
			} else {
				return "success";
			}
		}
		return "danger";
	}

	public function avatar()
	{
		return asset("assets/img/avatar/avatar-" . $this->avatar . ".png");
	}
}
