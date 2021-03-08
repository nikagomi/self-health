<?php
/**
 * Breadcrumb navigation class
 * @author Randal Neptune
 * @package motida
 */

class BreadCrumb{

   var $output;
   var $crumbs = array();
   var $location;
   /*
    * Constructor
    */
   public function __construct(){  
   
      if (!empty($_SESSION['breadcrumb'])){// != null){
          $this->crumbs = $_SESSION['breadcrumb'];
      }  
    }

   /*
    * Add a crumb to the trail:
    * @param $label - The string to display
    * @param $url - The url underlying the label
    * @param $level - The level of this link.  
    *
    */
   public function add($label, $url, $level){

      $crumb = array();
      $crumb['label'] = $label;
      $crumb['url'] = $url;

      if($crumb['label'] != null && $crumb['url'] != null && isset($level)){   
         
         /*while(count($this->crumbs) > $level){
            //array_pop($this->crumbs); //prune until we reach the $level we've allocated to this page
         }*/

         if (!isset($this->crumbs[0]) && $level > 0){ //If there's no session data yet, assume a homepage link
            $this->crumbs[0]['url'] = " ";//applicationListing.php";
            $this->crumbs[0]['label'] = " ";//Listing";
         }
         $this->crumbs[$level] = $crumb;  
     }
     $_SESSION['breadcrumb'] = $this->crumbs; //Persist the data
     
     $this->crumbs[$level]['url'] = null; //Ditch the underlying url for the current page.
   }

   public function output(){
         $x = 0;
         foreach ($this->crumbs as $crumb){ 
           if($crumb['url'] == null){
             $idx = floor($x/9);
             break;
           }
           $x++;
         }
       $trail = "<table width='99%' border='0' cellspacing='0' cellpadding='0' height='30px'><tr>";
       if(count($this->crumbs) > 9){
            $trail .= "<td width='20px' style='text-align:right;'><img title='Click to scroll back through list' id='prevSlide' src='/mot/images/rwd-button.png' width='20px' height='40px'/></td>";
       }      
       $trail .= "<td><div id='breadcrumb'>";
       
       $cnt = 0;
     
       for($i = 0; $i < count($this->crumbs); $i++){
          if($cnt  == 0){
              $trail .= "<div class='slide'><ul>";
          }
          if($this->crumbs[$i]['url'] != null){
            if($i == 0){
                $trail .= "<li> <a href='".$this->crumbs[$i]['url']."' title='".$this->crumbs[$i]['label']."'>".$this->crumbs[$i]['label']."</a></li> ";
            }else{
		$trail .= "<li>&#187; <a href='".$this->crumbs[$i]['url']."' title='".$this->crumbs[$i]['label']."'>".$this->crumbs[$i]['label']."</a></li> ";
            }
          } else {
            if($i == 0){
                $trail .= "<li> ".$this->crumbs[$i]['label']."</li> ";
                break;
            }else{
                 $trail .= "<li>&#187; ".$this->crumbs[$i]['label']."</li> ";
                 //break;
            }
          }
          if($cnt == 8){
              $trail .= "</ul></div>";
              $cnt = 0;
          }else{
              $cnt++;
          }
          
      }
       if($cnt != 0){$trail .= "</ul></div>";}
       
       $trail .= "</div>";
       
       $trail .= "</td>";
       if(count($this->crumbs) > 9){
            $trail .= "<td  style='text-align:left;' width='20px'><img title='Click to scroll forward through list' id='nextSlide' src='/mot/images/fwd-button.png' width='20px' height='20px'/></td>";
       }
       $trail .= "</tr></table>";
       $trail .= "<script type='text/javascript'>$(document).ready(function(){ $('#breadcrumb').cycle(".$idx.");});</script>";
       return $trail;
   }
  
  /* public function output(){
       $x = 0;
     foreach ($this->crumbs as $crumb){ 
       if($crumb['url'] == null){
         $idx = $x;
         break;
       }
       $x++;
     }
     //echo $idx;
     //Check where this should be going
     $startIdx = (($idx - 4) < 0) ? 0 : ($idx - 4);
     $endIdx = (($idx + 4) > count($this->crumbs)) ? count($this->crumbs) : ($idx + 4);
     //echo "<br/>".$startIdx." - ".$endIdx." * ".count($this->crumbs);
     $trail = "";
     //$trail .= "<table id='breadcrumb' border='0' cellspacing='4' cellpadding='0' align='left'>";
      //$trail .= "<tr><td><div id='breadcrumb'>" ;
     $trail .= "<div id='breadcrumb'>" ;
      $trail .= "<ul >";//<li>Click trail: </li>";
      //$i = 0;
      if(($endIdx - 9) >= 0){ 
          $startIdx = $endIdx - 9;
      }else{
          $startIdx = 0;
          if(count($this->crumbs) >= 9){
              $endIdx = 9;
          }
      }
      for($i = $startIdx; $i < $endIdx; $i++){
          //echo '<br/>Hello '.$this->crumbs[$i]['url'];
          if($this->crumbs[$i]['url'] != null){
            if($i == 0){
                $trail .= "<li> <a href='".$this->crumbs[$i]['url']."' title='".$this->crumbs[$i]['label']."'>".$this->crumbs[$i]['label']."</a></li> ";
            }else{
		$trail .= "<li> &#187; <a href='".$this->crumbs[$i]['url']."' title='".$this->crumbs[$i]['label']."'>".$this->crumbs[$i]['label']."</a></li> ";
            }
        } else {
            if($i == 0){
                $trail .= "<li> ".$this->crumbs[$i]['label']."</li> ";
                break;
            }else{
                 $trail .= "<li> &#187; ".$this->crumbs[$i]['label']."</li> ";
                 //break;
            }
       }
      }
   $trail .= "</ul>";
   $trail .= "</div>";
    //$trail .= "</div></td></tr>";
   //$trail .= "</table>";
   return $trail;
 }*/
 

}
?> 
