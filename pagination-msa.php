<?php 
function pagi_msa($name_page) {
    echo '<div class="pagination">';
    global $wp_query;
      $total_page = $wp_query->max_num_pages; // получаем общее количество страниц       
      $start_url = get_home_url() . '/' . $name_page; //адресс страницы пагинации
      $blog_link = $start_url.'?page_nv='; //формат ссылок пагинации
      $pagi_step = 3; //количество отображемых страниц до и после текуй страницы(-1)
      if ( $total_page > 1 )  {
        if(!$current_page = $_GET['page_nv']){
          $current_page = 1;
      } 
      $s = $current_page+1;
        for ($i=1; $i<=$total_page; $i++) {
          $previous_p = $current_page-1;
          if($i==1&&$current_page!=1&&$previous_p==1){
            echo '<a class="paggi-nav" href="'.$start_url.'">←</a>';          
          }
          elseif($i==1&&$current_page!=1){
            echo '<a class="paggi-nav" href="'.$blog_link.$previous_p.'">←</a>';          
          }
            if($i<=$total_page&&$i>$current_page-$pagi_step&&$i<$current_page+$pagi_step&&$i>0){            
              if($i==$current_page){
                echo '<span class="paggi-nav">'.$i.'</span>';
              }
              elseif($i!=$current_page&&$i==1) {
                echo '<a class="paggi-nav" href="'.$start_url.'">'.$i.'</a>';
              }
              else {
                echo '<a class="paggi-nav" href="'.$blog_link.$i.'">'.$i.'</a>';
              }           
            }
         $next_p = $current_page+1;
          if($i==$total_page&&$current_page!=$total_page){
            echo '<a class="paggi-nav" href="'.$blog_link.$next_p.'">→</a>';        
          } 
        }
      }   
wp_reset_query();
   echo '</div>';
}

?>