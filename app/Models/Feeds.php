<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Feeds
 * @package App\Models
 * @version June 15, 2017, 11:58 pm UTC
 */
class Feeds extends Model
{
   // use SoftDeletes;

    public $table = 'feeds';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'type',
        'name',
        'description',
        'url',
    	'users_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type' => 'string',
        'name' => 'string',
        'description' => 'string',
        'url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type' => 'required'
    ];

    public function getFeeds()
    {
    	$res = $this->select("id","url")->get();
    	if($res->count()>0)
    	{
    		return $res;
    	}
    	else 
    	{
    		return "0";
    	}
    }
}
