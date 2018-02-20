<?php
namespace App\Http\Controllers;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Feeds;
use App\Models\Article;
use SimplePie;
use App\Feed;
class ReaderController extends Controller
{
	public $stopWords=array("about", "above", "across", "afore", "aforesaid",
			"after", "again", "against", "agin", "ago", "aint",
			"albeit", "all", "almost", "alone", "along", "alongside",
			"already", "also", "although", "always", "am", "american",
			"amid", "amidst", "among", "amongst", " an ", "and",
			"anent", "another", "any", "anybody", "anyone", "anything",
			"are", "aren't", "around", " as ", "aslant", "astride",
			"at", "athwart", "away", " b ", "back", "bar",
			"barring", "be", "because", "been", "before", "behind",
			"being", "below", "beneath", "beside", "besides", "best",
			"better", "between", "betwixt", "beyond", "both", "but",
			"by", " c ", "can", "cannot", "can't", "certain",
			"circa", "close", "concerning", "considering", "cos", "could",
			"couldn't", "couldst", " d ", "dare", "dared", "daren't",
			"dares", "daring", "despite", "did", "didn't", "different",
			"directly", "do", "does", "doesn't", "doing", "done",
			"don't", "dost", "doth", "down", "during", "durst",
			" e ", "each", "early", "either", "em", "english",
			"enough", "ere", "even", "ever", "every", "everybody",
			"everyone", "everything", "except", "excepting", " f ", "failing",
			"far", "few", "first", "five", "following", "for",
			"four", "from", " g ", "gonna", "gotta", " h ",
			"had", "hadn't", "hard", "has", "hasn't", "hast",
			"hath", "have", "haven't", "having", "he", "he'd",
			"he'll", "her", "here", "here's", "hers", "herself",
			"he's", "high", "him", "himself", "his", "home",
			" how ", "howbeit", "however", "how's", " i ", "id",
			"if", "ill", "i'm", "immediately", "important", " in ",
			"inside", "instantly", "into", "is", "isn't", " it ",
			"it'll", "it's", "its", "itself", "i've", " j ",
			"just", "large", "last", "later",
			"least", "left", "less", "lest", "let's", "like",
			"likewise", "little", "living", "long", " m ", "many",
			"may", "mayn't", "me", "mid", "midst", "might",
			"mightn't", "mine", "minus", "more", "most", "much",
			"must", "mustn't", "my", "myself", " n ", "near",
			"'neath", "need", "needed", "needing", "needn't", "needs",
			"neither", "never", "nevertheless", "new", "next", "nigh",
			"nigher", "nighest", "nisi", "no", "no-one", "nobody",
			"none", "nor", "not", "nothing", "notwithstanding", "now",
			" o ", "o'er", "of", "off", "often", "on",
			"once", "one", "oneself", "only", "onto", "open",
			"or", "other", "otherwise", "ought", "oughtn't", "our",
			"ours", "ourselves", "out", "outside", "over", "own"
			, "past", "pending", "per", "perhaps", "plus",
			"possible", "present", "probably", "provided", "providing", "public",
			" q ", "qua", "quite", "rather", " re ",
			"real", "really", "respecting", "right", "round",
			"same", "sans", "save", "saving", "second", "several",
			"shall", "shalt", "shan't", "she", "shed", "shell",
			"she's", "short", "should", "shouldn't", "signal", "since", "six",
			"small", "so", "some", "somebody", "someone", "something",
			"sometimes", "soon", "special", "still", "such", "summat",
			"supposing", "sure", "than", "that", "that'd",
			"that'll", "that's", "the", "thee", "their", "theirs",
			"their's", "them", "themselves", "then", "there", "there's",
			"these", "they", " they'd ", "they'll", "they're", "they've",
			"thine", " this ", " tho ", "those", "thou", "though",
			"three", "thro'", "through", "throughout", "thru", "thyself",
			"till", " to ", "today", "together", "too", "touching",
			"toward", "towards", "true", "'twas", "'tween", "'twere",
			"'twill", "'twixt", "two", "'twould", "under",
			"underneath", "unless", "unlike", "until", "unto", "up",
			"upon", "used", "usually", "versus",
			"very", "via", "vice", "vis-a-vis", "wanna",
			"wanting", "was", "wasn't", "way", "we'd",
			"well", "were", "weren't", "wert", "we've", "what",
			"whatever", "what'll", "what's", "when", "whencesoever", "whenever",
			"when's", "whereas", "where's", "whether", "which", "whichever",
			"whichsoever", "while", "whilst", "who", "who'd", "whoever",
			"whole", "who'll", "whom", "whore", "who's", "whose",
			"whoso", "whosoever", "will", "with", "within", "without",
			"wont", "would", "wouldn't", "wouldst", " x ", " y ",
			"ye", "yet", "you're", "you'd", "you'll", "your",
			"you", "yours", "yourself", "yourselves", "you've", " z ",
			"Rand", "Fishkin", "Stewart", "Quealy", "Moderator:");
			
    public function PocessArticles()
    {
    	return view("process.form1");
	}
	
	public function  listArticles()
	{
		$oArt = new Article();
		$rs1 = $oArt->getFathers();
		if(is_object($rs1))
		{
			foreach ($rs1 as $item1)
			{
				$rs2 = $item1->getSons();
				$item1->sons=$rs2;
			}
			//dd($rs1[0]->sons);
		}
		return view("articles.list",compact('rs1'));
	}
	

	public function  getArticlesApi(Request $request)
	{
		$oArt = new Article();
		$oArt->date="";
		if(isset($request->date) && $request->date!="")
		{
		    $arrDate=explode("/", $request->date);
		    //dd($arrDate);
		    $request->date = $arrDate[2]."-".$arrDate[0]."-".$arrDate[1];
		    $oArt->datefrom=$request->date;
		    $oArt->dateto=$request->date;
		}
		
		$rs1 = $oArt->getFathers();
		
		if(is_object($rs1))
		{
			foreach ($rs1 as $item1)
			{
				$rs2 = $item1->getSons();
				$item1->title=strip_tags($item1->title);
				$item1->content=strip_tags($item1->content);
				$item1->description=strip_tags($item1->description);
				if(is_object($rs2))
				{
				    foreach ($rs2 as $item0)
				    {
				       $item0->title=strip_tags($item0->title);
				       $item0->content=strip_tags($item0->content);
				       $item0->description=strip_tags($item0->description);
					   $item1->sons=$rs2;
				    }
				}
				else
				{
					$item1->sons="";		
				}
			}
			//dd($rs1[0]->sons);
		}
		//dd(json_encode($rs1));
		
		return json_encode($rs1);
	}
	



	public function  listDetails($id)
	{
		if($id!="")
		{
			$Art = new Article();
			$Art->id=$id;
			$item =$Art->getDetailsArticle();
			return view("articles.details",compact('item'));
		}
	}
	
	public function  listDetailsApi($id)
	{
	    if($id!="")
	    {
	        $Art = new Article();
	        $Art->id=$id;
	        $item =$Art->getDetailsArticle();
	        return json_encode($item);;
	    }
	}
	
    public function readArticles()
    {
    	$oFeed = new Feeds();
    	$rsFeeds =$oFeed->getFeeds();
    	foreach ($rsFeeds as $itemFeed)
    	{
      $url = $itemFeed->url;
      $feed = new SimplePie();
      $feed->set_cache_location($_SERVER['DOCUMENT_ROOT'] . '/memeimporter/public');
      $feed->set_feed_url($url);
      $feed->init();
      if(count($feed->data)==0)
      {
         continue;
      }
      else
      {
      	
        $items = $feed->get_items();
        foreach ($items as $item) 
        {
            
        	$oArticl = new Article();
        	$oArticl->link=$item->get_link();
        	$oArticl->title=$item->get_title();
        	$oArticl->author=$item->get_author()->get_name();
        	$oArticl->date=$item->get_date('Y-m-d');
        	$oArticl->description=$item->get_description();
        	$oArticl->content=$item->get_content();
        	$oArticl->feed_id=$itemFeed->id;
        	if(!$oArticl->exists())
        	{
        		$oArticl->save();
        	}
        	            
        }
      }
      }		
      $response["success"]=true;
      return json_encode($response);
    }
    
    
  public function relateArticles()
  {
    	$oArt = new Article();
    	$oArt->iduser=1;
    	$rsArts = $oArt->getArticles();
    	$artProcessed = array();
    	foreach ($rsArts as $art)
    	{
    		$artProcessed[]=$art->id;
    		$base=strip_tags($art->content);
    		$base= preg_replace('/\s+/', ' ', trim($base));
    		//$base=$this->deleteStopWords($this->stopWords,$base);
    		//dd($base);
    		$rsArts2 = $oArt->getArticles2($artProcessed);
    		if(is_object($rsArts2))
    		{
	    		foreach ($rsArts2 as $art2)
	    		{
	    			$test = strip_tags($art2->content);
	    			$test= preg_replace('/\s+/', ' ', trim($test));
	    			$resp=$this->compareArticles($base,$test);
	    		//	dd($test);
	    			//echo $resp."<br>";
	    			if($resp>=60)
	    			{
	    				$art2->fatherarticle_id=$art->id;
	    				$art2->save();
	    			}
	    			
	    		}
    		}    		
    	}
    	$response["success"]=true;
    	return json_encode($response);
   	}
    



    public function deleteStopWords($stopWords,$articleBase)
    {
    	foreach ($stopWords as $word)
    	{
    		//if($word=='you') 
    			$articleBase=str_replace(strtolower($word),"",strtolower($articleBase));
    			//die($articleBase); 		
    	}
    	return $articleBase;
    }

    public function compareArticles($art1,$art2)
    {
        $arrTest =explode(" ",$art2);
        $canOcurr=0;
        $canTot=count($arrTest);
        foreach($arrTest as $word)
        {
            $res=strpos(strtolower($art1),strtolower($word));
            //var_dump($res);
            if($res!==false)
            {
                $canOcurr++;
            }
        }
        //dd($canOcurr);
        $porc=ceil(($canOcurr*100)/$canTot);
        return $porc;
    }
}
