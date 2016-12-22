<?php

// This is a helper class to make Pagination
// records easter

/**
 *  Classs Pagination
 */
class Pagination{
  public $current_page;
  public $per_page;
  public $total_count;

  public function __construct( $page = 1, $per_page, $total_count ){
    $this->current_page  =(int) $page;
    $this->per_page      =(int) $per_page;
    $this->total_count   =(int) $total_count;
  }

  public function total_page(){
    return ceil( $this->total_count / $this->per_page );
  }

  public function next_page(){
    return $this->current_page + 1;
  }

  public function previous_page(){
    return $this->current_page - 1;
  }

  public function has_next_page(){
    return $this->next_page() <= $this->total_page() ? true : false;
  }

  public function has_previous_page(){
    return $this->previous_page() >= 1 ? true : false;
  }

  public function offset(){
    return ($this->current_page -1) * $this->per_page;
  }

}
