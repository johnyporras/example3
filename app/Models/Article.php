<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	public $table = 'articles';
	public function insert()
	{
		try
		{
			if($this->save())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		catch ( \Exception $e)
		{
			echo $e->getMessage();
			return false;
		}
	}
	
	public function getArticles()
	{
		$us = $this->iduser;
		$res = $this->select("id","content")
		->whereIn('feed_id',function($query)use($us){
						$query->select("id")
								->from("feeds")
								->where("users_id",$us);
			})
			->orderBy('id','asc')
			->get();
		if($res->count()>0)
		{
			return $res;
		}
		else
		{
			return "0";
		}
	}
	
	
	public function exists()
	{
		$res = $this->select("id")
			->where("date","=",$this->date)
			->where("title","=",$this->title)
			->where("author","=",$this->author)
			->get();
		if($res->count()>0)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	public function getArticles2($arts)
	{
		$us = $this->iduser;
		$res = $this->select("id","content")
		->whereIn('feed_id',function($query)use($us){
			$query->select("id")
			->from("feeds")
			->where("users_id",$this->iduser);
		})
		->whereNotIn('id',$arts)
		->orderBy('id','asc')
		->get();
		if($res->count()>0)
		{
			return $res;
		}
		else
		{
			return "0";
		}
	}
	
	public function getFathers()
	{
		$res = $this->select("articles.fatherarticle_id as idpadre",
		    "articles2.title","articles2.author","articles2.description","articles2.link","articles2.date","articles2.id as idhijo")
					->selectRaw("COUNT(articles.fatherarticle_id) as cantidadhijos")
		->join("articles as articles2","articles.fatherarticle_id","=","articles2.id")
		->groupBy("articles.fatherarticle_id","articles2.title","articles2.author","articles2.description")
		->havingRaw("COUNT(articles.fatherarticle_id)>0")
		->orderBy("cantidadhijos", "desc");
		if($this->datefrom!="" && $this->dateto!="")
		{
			$res = $res->whereRaw("articles2.date between '{$this->datefrom}' and '{$this->dateto}'");
		}
		//echo $this->dateto;die();
		$res = $res->get();
	
		if($res->count()>0)
		{
			return $res;
		}
		else
		{
			return "0";
		}
	}
	
	public function getSons()
	{
		//dd($this->idpadre);
		$res = $this->select("*")
				->where("fatherarticle_id","=",$this->idpadre)
				->get();
				if($res->count()>0)
				{
					return $res;
				}
				else
				{
					return "0";
				}
	}
	
	public function getDetailsArticle()
	{
		$res = $this->findOrFail($this->id);
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
?>