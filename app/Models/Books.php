<?php

namespace App\Models;

use App\Scopes\Deleted;
use Illuminate\Support\Str;
use App\Traits\HasDeletedScope;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
		"authors", "course_id", "uploaded_by",
		"book_status", "deleted_at"
	];

	protected $hidden = [
		"deleted_at", "created_at", "updated_at"
	];

	protected $casts = [
		"deleted_at" => "date",
		"published_at" => "date"
	];

	public function setSlugAttribute($value)
	{
		return $this->attributes["slug"] = Str::slug($value);
	}

	public function user()
	{
		return $this->belongsTo(User::class)->withoutGlobalScope(Deleted::class);
	}

	public function course()
	{
		return $this->belongsTo(Course::class)->withoutGlobalScope(Deleted::class);
	}

	public function reviews()
	{
		return $this->hasMany(BookReview::class, "book_id", "id")->latest();
	}

	public function downloads()
	{
		return $this->hasMany(BookDownload::class, "book_id", "id");
	}

	public function average()
	{
		return $this->reviews()->avg("rate") > 0 ? number_format($this->reviews()->avg("rate"), "1", ".") : 0;
	}

	public function getRatingPercentage()
	{
		$ratingsCount = $this->reviews()
			->select(DB::raw('rate, COUNT(*) as count'))
			->groupBy('rate')
			->orderBy('rate', 'desc')
			->pluck('count', 'rate')
			->toArray();

		$percentages = [];

		$totalRatings = array_sum($ratingsCount);
		foreach (range(5, 1) as $star) {
			$percentage = isset($ratingsCount[$star]) ? round(($ratingsCount[$star] / $totalRatings) * 100) : 0;
			$count = isset($ratingsCount[$star]) ? $ratingsCount[$star] : 0;
			$percentages[] = [$star, $percentage, $count];
		}

		return $percentages;
	}

	public function college()
	{
		return $this->belongsTo(College::class)->withoutGlobalScope(Deleted::class);
	}

	// public function scopeByCollege($query, $id) {
	//     return $query->where("college_id", $id);
	// }

	public function scopeAccepted($query)
	{
		$query->where("book_status", self::ACCEPTED);
		if (!Auth::user()->isSuperAdmin()) {
			$query->where("college_id", Auth::user()->college_id);
		}
		return $query;
	}

	public function scopePending($query)
	{
		$query->where("book_status", self::PENDING);
		if (Auth::user()->isAdmin()) {
			$query->where("college_id", Auth::user()->college_id);
		}
		return $query;
	}

	public function scopeRejected($query)
	{
		$query->where("book_status", self::REJECTED);
		if (Auth::user()->isAdmin()) {
			$query->where("college_id", Auth::user()->college_id);
		}
		return $query;
	}

	public function typeArray()
	{
		return explode(",", $this->book_type);
	}

	public function authorArray()
	{
		return explode(",", $this->authors);
	}

	public function statusText()
	{
		if ($this->book_status == self::PENDING) {
			return "Pending";
		} else if ($this->book_status == self::ACCEPTED) {
			return "Accepted";
		}

		return "Rejected";
	}

	public function statusColor()
	{
		if ($this->book_status == self::PENDING) {
			return "warning";
		} else if ($this->book_status == self::ACCEPTED) {
			return "success";
		}

		return "danger";
	}

	public function isPending()
	{
		return $this->book_status === self::PENDING;
	}

	public function isAccepted()
	{
		return $this->book_status === self::ACCEPTED;
	}

	public function isRejected()
	{
		return $this->book_status === self::REJECTED;
	}
}
