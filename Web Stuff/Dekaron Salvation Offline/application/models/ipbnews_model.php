<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ipbnews_model extends MY_Model 
{
	public function __construct(){
		parent::__construct();
	}
	
	public function getIpbWebsiteNews($count){
		$news_url = $this->config->item('rss_news_url');
		$xml = $this-> GetXml($news_url);
		
		$html_news = '';
		
		for ($i=0; $i<=$count; $i++)
		{
			$item_title 	= $xml->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
			$item_link 		= $xml->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
			$item_desc 		= $xml->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
			$pubDate 		= $xml->item($i)->getElementsByTagName('pubDate')->item(0)->childNodes->item(0)->nodeValue;
			
			$html_news .= '<article>';
			$html_news .= '<h1 class="news-head"><a class="top" href="'.$item_link.'">'.$item_title.'</a><p>'.date("d M Y",strtotime($pubDate)).'</p></h1>';
			$html_news .= '<section class="body">';
			$html_news .= $item_desc;
			$html_news .= '<div class="clear"></div>';
			$html_news .= '</section>';
			$html_news .= '</article> ';			
		}
		$this->cache->save('news/news', $html_news, '600');
		return $html_news;		
	}
	
	public function GetXml($url){
		$xmlDoc = new DOMDocument();
		$xmlDoc->load($url);
		$x = $xmlDoc->getElementsByTagName('item');
		return $x;	
	}		
}
