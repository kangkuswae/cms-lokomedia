<?php               
echo "<ul>";
   $main=mysql_query("SELECT * FROM mainmenu WHERE aktif='Y'");

   while($r=mysql_fetch_array($main)){
     echo "<li><a href='$r[link]'>$r[nama_menu]</a>
             <ul>";
          $sub=mysql_query("SELECT * FROM submenu, mainmenu  
                            WHERE submenu.id_main=mainmenu.id_main 
                            AND submenu.id_main=$r[id_main]");
	        while($w=mysql_fetch_array($sub)){
              echo "<li><a href='$w[link_sub]'>&#187; $w[nama_sub]</a></li>";
	         }
	       echo "</ul>
            </li>";
  }        
echo "</ul>";
?>
