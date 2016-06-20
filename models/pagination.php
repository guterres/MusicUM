<?php

class Pagination{
  private $limit;
  private $page;
  private $query;
  private $total;


  public function __construct($query){
    $this->query = $query;
    $db = Database::getInstance();
    $res = $db->query( $this->query );
    $this->total = $res->rowCount();
  }

  public function getData($limit, $page){
    $this->limit = $limit;
    $this->page  = $page;

    if($this->limit == 'all'){
      $query = $this->query;
    }else {
      $query = $this->query." LIMIT ".(($this->page-1)*$this->limit).", $this->limit";
    }
    $db = Database::getInstance();
    $res = $db->query( $query );
    $results = [];
    while ($row = $res->fetch()){
      $results[] = $row;
    }

    $result = new stdClass();
    $result->page = $this->page;
    $result->limit = $this->limit;
    $result->total = $this->total;

    $result->data = $results;

    return $result;
  }

  public function createLinks($links, $list_class, $url){
    if($this->limit == 'all'){
      return '';
    }

    $last = ceil($this->total/$this->limit);

    $start = (($this->page-$links) > 0) ? $this->page-$links : 1;
    $end = (($this->page+$links) < $last) ? $this->page+$links : $last;

    $html = '<ul class="'.$list_class.'">';

    $class = ($this->page == 1 ) ? "disabled" : "";
    $html .= '<li class="'.$class.'"><a href="'.$url.'&limit='.$this->limit.'&page='.($this->page-1).'">&laquo;</a></li>';

    if($start > 1){
      $html .= '<li><a href="'.$url.'&limit='.$this->limit.'&page=1">1</a></li>';
      $html .= '<li class="disabled"><span>...</span></li>';
    }

    for($i = $start; $i <= $end; $i++){
      $class = ($this->page == $i) ? "active" : "";
      $html .= '<li class="'.$class.'"><a href="'.$url.'&limit='.$this->limit.'&page='.$i.'">'.$i.'</a></li>';
    }

    if($end < $last){
      $html .= '<li class="disabled"><span>...</span></li>';
      $html .= '<li><a href="'.$url.'&limit='.$this->limit.'&page='.$last.'">'.$last.'</a></li>';
    }

    $class = ($this->page == $last) ? "disabled" : "";
    $html .= '<li class="'.$class.'"><a href="'.$url.'&limit='.$this->limit.'&page='.($this->page+1).'">&raquo;</a></li>';

    $html .= '</ul>';

    return $html;
  }
}
?>
