<?php namespace App;

use App\Data\Favorite;

trait Favoritable
{
	protected static function bootFavoritable()
	{
		static::deleting(function ($model) {
			$model->favorites->each->delete();
		});
	}

	public function favorites()
	{
		return $this->morphMany(Favorite::class, 'favorited');
	}

	public function getFavoritesCountAttribute()
	{
		return $this->favorites->count();
	}

	public function favorite()
	{
		$attributes = ['user_id' => auth()->id()];

		if (! $this->favorites()->where($attributes)->exists()) {
			$favorite = $this->favorites()->create($attributes);

			event(new Events\ItemWasFavorited($favorite));

			return $favorite;
		}
	}

	public function isFavorited()
	{
		return !! $this->favorites->where('user_id', auth()->id())->count();
	}

	public function getIsFavoritedAttribute()
	{
		return $this->isFavorited();
	}

	public function unfavorite()
	{
		$attributes = ['user_id' => auth()->id()];

		$this->favorites()->where($attributes)->get()->each->delete();
	}
}
