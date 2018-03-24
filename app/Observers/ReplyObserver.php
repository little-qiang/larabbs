<?php

namespace App\Observers;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver {
	protected $fillable = ['content'];

	public function topic() {
		return $this->belongsTo(Topic::class);
	}

	public function user() {
		return $this->belongsTo(User::class);
	}
}