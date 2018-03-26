<?php

namespace App\Observers;

use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver {
	public function creating(User $user) {
		//
	}

	public function saving(User $user) {
		// 这样写扩展性更高，只有空的时候才指定默认头像
		if (empty($user->avatar)) {
			$user->avatar = 'https://fsdhubcdn.phphub.org/uploads/images/201710/30/1/TrJS40Ey5k.png';
		}
	}

	public function updating(User $user) {
		//
	}

	public function deleting(User $user) {
		$topic_ids = $user->topics()->pluck('id')->toArray();
		//删除用户的话题
		\DB::table('topics')->where('user_id', $user->id)->delete();
		//删除话题对应的回复, 删除用户所有的回复
		\DB::table('replies')->where('user_id', $user->id)->orWhere('topic_id', $topic_ids)->delete();
	}
}