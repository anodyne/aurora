<?php namespace App;

use App\Data\Reply;
use App\Events\DiscussionWasAnswered;

trait AnswersDiscussion
{
	/*public function answer()
	{
		return $this->hasOne(Reply::class, 'id', 'answer_id');
	}*/

	public function answer()
	{
		return $this->replies->where('id', $this->answer_id)->first();
	}

	public function isAnswered()
	{
		return $this->answer_id !== null;
	}

	public function markAsBestAnswer($replyId)
	{
		$reply = Reply::find($replyId);

		$answer = $this->fill(['answer_id' => $replyId])->save();

		event(new DiscussionWasAnswered(auth()->user(), $this, $reply));

		return $answer;
	}
}
