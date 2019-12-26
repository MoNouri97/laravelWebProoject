<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	//
	protected $table = 'posts';
	protected $primaryKey = 'id';

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'tags' => 'array',
	];

	public function user() {
		return $this->belongsTo('App\User');
	}

}
