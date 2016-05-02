<?php
function spg_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  
     global $paged;
	 $paged = isset($_GET['spg-page'] ) ? $_GET['spg-page'] : 1;
	 
	 $query = $_GET;
	 unset($query['spg-page']);
	 
     if(empty($paged)) $paged = 1;
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
     if(1 != $pages)
     {
         echo "<div class='spg-pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='?spg-page=1'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='?spg-page=".($paged - 1)."'>&lsaquo;</a>";
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
				 $query['spg-page'] = $i;
				 $url = http_build_query($query);
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='?".$url."' class='inactive' >".$i."</a>";
             }
         }
		$query['spg-page'] = $paged + 1;
		$url = http_build_query($query);
         if(is_home()){
		 	if ($paged < $pages && $showitems < $pages) echo "<a href='?".$url."'>&rsaquo;</a>";  
		 } else {
			if ($paged < $pages && $showitems < $pages) echo "<a href='?".$url."'>&rsaquo;</a>";   
		}
		
		$query['spg-page'] = $pages;
		$url = http_build_query($query);
		
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='?".$url."'>&raquo;</a>";
         echo "</div>\n";
     }
}