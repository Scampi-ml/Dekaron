<?php
class page_class {
        var $count = 0;         //total pages
        var $start = 0;         //starting record
        var $pages = 0;         //number of pages available
        var $page = 1;          //current page
        var $maxpages;          //shows up to 2 * this number and makes a sliding scale
        var $show;              //number of results per page
        function page_class($count=0,$show=5,$max=9){
                $this->count = $count;
                $this->show = $show;
                $this->maxpages = $max;
                ($this->count % $this->show == 0)? $this->pages = intval($this->count/$this->show) :$this->pages = intval($this->count/$this->show) +1;
                if(!empty($_GET['search_page'])){
                        $this->page = $_GET['search_page'];
                        $this->start = $this->show * $this->page -$this->show;
                }
        }
        function get_limit(){
                $limit = '';
                if($this->count > $this->show) $limit = 'LIMIT'.$this->start.','.$this->show;
                return $limit;
        }
        function get_start(){
                 return $this->start;
        }
        function get_end(){
                 return ($this->start + $this->show);
        }
        function make_head_string($pre){
                $r = $pre.' ';
                $end = $this->start + $this->show;
                if($end > $this->count) $end = $this->count;
                $r .= ($this->start +1).' - '.$end.' of '.$this->count;
                return $r;
        }
        function make_page_string($words,$pre=''){
                $r = $pre.' ';
                if($this->page > 1){
                        $y = $this->page - 1;
                        $r .= '<a href="'.$_SERVER['PHP_SELF'].'?search_page='.$y.$words.'">Previous</a>&nbsp;';
                }
                $end = $this->page + $this->maxpages-1;
                if($end > $this->pages) $end = $this->pages;
                $x = $this->page - $this->maxpages;
                $anchor = $this->pages - (2*$this->maxpages) +1;
                if($anchor < 1) $anchor = 1;
                if($x < 1) $x = 1;
                if($x > $anchor) $x = $anchor;
                while($x <= $end){
                        if($x == $this->page){
                                $r .= '<span class="s">'.$x.'</span>&nbsp;';
                        }
                        else{
                                $r.= '<a href="'.$_SERVER['PHP_SELF'].'?search_page='.$x.$words.'">'.$x.'</a>&nbsp;';
                        }
                        $x++;
                }
                if($this->page < $this->pages){
                        $y = $this->page + 1;
                        $r .= '<a href="'.$_SERVER['PHP_SELF'].'?search_page='.$y.$words.'">Next</a>&nbsp;';
                }
                return $r;
        }

}

//Usage
$searchword = 'a';
$whatever = 'user=me';
//$conn = mssql_connect("Driver={SQL Server};Server=localhost;Database=account;", "sa", "xxxxxxxx") or die('Cant connect to account db');
$conn = mssql_connect("localhost", "sa", "xxxxxxxx") or die('Cant connect to account db');


$Query = "SELECT COUNT(*) AS cnt FROM account.dbo.user_profile WHERE user_id LIKE '%" .$searchword. "%'";
if(!$result = mssql_query($Query)){
        echo 'oops: '.mssql_error();
        exit;
}

$row = mssql_fetch_array($result);
$count = $row['cnt'];

if($count > 0){
      //start class total number of results,number of results to show,max number of pages on a sliding scale (ends up as 2x this number..ie 20)
    $page = new page_class($count,10,10);
    $start = $page->get_start();
    $end = $page->get_end();
    $Query2= "SELECT * FROM account.dbo.user_profile WHERE user_id LIKE '%".$searchword. "%' ORDER BY  user_id ASC ";
    $result = mssql_query($Query2) or die('mssql error');
    $hstring = $page->make_head_string('Results');
	
    $pstring = $page->make_page_string("&amp;searchword=".$searchword."&amp;whatever=".$whatever);//add the other variables to pass to next page in a similar fashion
    echo "<table><tr><td>".$hstring."</td></tr>";
    $x = 0;
    while($row = mssql_fetch_array($result)){
      if($x >= $start){
        echo '<tr><td>'.$x.' '.$row['user_id'].'</td></tr>';
      }
      $x++;
      if($x > $end) break;
    }
    echo '<tr><td>'.$pstring.'</td></tr></table>';
}

//Note: the search variables on subsequent pages will be passed by GET method
?> 