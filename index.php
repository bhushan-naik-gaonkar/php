<?php header("Status: 200 OK"); 

?>
<!DOCTYPE html>
<?php
 //echo "<script>alert('ok')</script>";

$sql_header_type="select header_type,gif_loader_path,comp_ins from ja_comp_master";
$res_header_type=mysqli_query($connection,$sql_header_type);
$row_header_type=mysqli_fetch_assoc($res_header_type);
$sql_header_typec="select gif_loader_path,initial from club_master where club_id=$_SESSION[club_id]";
$res_header_typec=mysqli_query($connection,$sql_header_typec);
$row_header_typec=mysqli_fetch_assoc($res_header_typec);
$page = $row_header_type[header_type];
//echo $_SESSION['club_id'];
if($_SESSION[club_id]==''){$club=1;}else{$club=$_SESSION[club_id];}
//echo "select loader_display,mob_transparent_header from header_master where club_id='$club'";
 $sql_loader=mysqli_query($connection,"select loader_display,mob_transparent_header from header_master where club_id='$club'");
 $res_loader=mysqli_fetch_assoc($sql_loader);
// echo "here-".$res_loader[mob_transparent_header];

 if($row_header_type[comp_ins]=='MCMP'){?>
 
<script language="javascript">
window.top.location="mcmp_slider.php";
</script>
 <?
    }
if($res_loader[loader_display]=='Yes'){
?>
<script>
    window.onload=function(){
       document.getElementById('loading').style.display="none";
       document.getElementById('fpage-p').style.display="block";
    }
</script>
<style>
    #loading {
  position: absolute;
  height: 300px;
  width: 300px;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}
#loading img{
    width: 300px; 
}
#fpage-p{
    display:none;
}

</style>

<?
if($row_header_typec[gif_loader_path]!=''){
    $gif=explode('../',$row_header_typec[gif_loader_path]);
$gif_loader_path="RUHA/".$gif[1];

}else if($row_header_type[gif_loader_path]!=''){
    $gif=explode('../',$row_header_type[gif_loader_path]);
$gif_loader_path="RUHA/".$gif[1];

}
else{
  $gif_loader_path='img/POINTER.gif';  
}
?>
<div id="loading"><img src="<?=$gif_loader_path?>"></div>
<?}?>


<?

$php  = '.php';
 $both = $page . $php;
//var_dump($both);
if($page==''){
}else{
    if($row_header_type[comp_ins]=='MCMP'){
    }else{
include $both;
}
}?>
<div id="fpage-p">
<?
 if($res_loader[mob_transparent_header]=='Yes'){?>
     <style>
        
    @media (max-width:767px){
        #header {
background-color: transparent!important;
}
.w3-content {
padding-top: 0px!important;
}

.bg-dark {
    background: #ffffff99 !important;
}
.bg-primary{
     background: #ffffff99 !important; 
}
.navbar{
 background: #ffffff99 !important;   
}
    }
</style>
     
<?}
?>




<script>
var ua = navigator.userAgent.toLowerCase(); 
if (ua.indexOf('safari') != -1) { 
  if (ua.indexOf('chrome') > -1) {
   // alert("1") // Chrome
  
  } else {
    // window.top.location='safari.php';
  }
}

</script>
<?
 $sqlmx= "SELECT upload_advertise.id AS advId,display_on,img_path,redirect  FROM  `upload_advertise`,`advertise_loc` Where upload_advertise.start_date<='".date("Y-m-d")."' AND upload_advertise.end_date>='".date("Y-m-d")."' and upload_advertise.flag=advertise_loc.id AND advertise_loc.display_pattern_type='Top' AND advertise_loc.link_name='Home' AND advertise_loc.img_visible='Yes'";
$resultmx=mysqli_query($connection,$sqlmx);
$rowsmx=mysqli_num_rows($resultmx);
if($rowsmx==''){?> 
<div style="height:0px;"></div>
<?}else{?>
<div style="height:0px;"></div> 
<?}?>
 
<?
 $sqlmx= "SELECT upload_advertise.id AS advId,display_on,img_path,redirect  FROM  `upload_advertise`,`advertise_loc` Where upload_advertise.start_date<='".date("Y-m-d")."' AND upload_advertise.end_date>='".date("Y-m-d")."' and upload_advertise.flag=advertise_loc.id AND advertise_loc.display_pattern_type='Top' AND advertise_loc.link_name='Home' AND advertise_loc.img_visible='Yes'";
$resultmx=mysqli_query($connection,$sqlmx);
$rowsmx=mysqli_num_rows($resultmx);
if($rowsmx==0)
{ 
//echo "iff";
$sql_stmt= "SELECT image,id FROM  `advertise_loc` Where img_visible='Yes' AND link_name='Home' AND display_pattern_type='Top' AND display_on='Website' ";
$result_stmt=mysqli_query($connection,$sql_stmt);
$data_stmt=mysqli_fetch_assoc($result_stmt);
$path11=explode("../",$data_stmt['image']);
//echo $path11[1];
$row_no=mysqli_num_rows($result_stmt);
$sqlm= "SELECT * FROM  `add_ticker` Where start_date<='".date("Y-m-d")."' AND end_date>='".date("Y-m-d")."'";
	  $result=mysqli_query($connection,$sqlm);
	  
	$rows=mysqli_num_rows($result);
if($row_no>0 && $rows==0)
{
    
?>

<div class="advertise-div noadvt_notick" id="advertise-div" align="center"><a href="connect_us.php?id=1&&nm=<?=$data_stmt['id'];?>" style="cursor:pointer"><img src="RUHA/<?=$path11[1]?>" class="img-responsive " style="width:auto;display: block !important"></a></div>

<style>

.advertise-div{
    margin-bottom:0px;
    /*margin-top:3%;*/
}

@media (max-width:767px){
        .advertise-div{margin-top:0%;margin-bottom:0%;}
    }</style>

<? 
}
else if($row_no>0 && $rows!=0){?>

<div class="advertise-div noadvt_notick" id="advertise-div" align="center"><a href="connect_us.php?id=1&&nm=<?=$data_stmt['id'];?>" style="cursor:pointer"><img src="RUHA/<?=$path11[1]?>" class="img-responsive " style="width:auto;display: block !important"></a></div>
  <style>

.advertise-div{
    margin-bottom:0px;
    margin-top:0%;
}

@media (max-width:767px){
        .advertise-div{margin-top:0%;margin-bottom:0%;}
    }</style>  
    
<? }
}
else
{
//echo "elseeee";
while ($datamx=mysqli_fetch_assoc($resultmx))
{
if($datamx[display_on]=="Website")
{
$pathx=explode("../",$datamx[img_path]);
?>
<div style="margin-bottom::50px;margin-top:0%;" align="center"><a <? if($datamx[redirect]!='NO') { ?> href="advertise.php?id=<?=$datamx[advId];?>" <? } ?> style="cursor:pointer" ><img src="RUHA/<?=$pathx[1]?>" class="img-responsive" style="width:auto;display: block !important"></a></div>

<? 
}
}
}
?> 
<?			
			$sql="select * from ja_comp_master";
				$res2=mysqli_query($connection,$sql);
				$rs1=mysqli_fetch_assoc($res2);
				$sql1="Select * from countdown where display='YES' and date_time>='".date("Y-m-d")."'";
$resC=mysqli_query($connection,$sql1);
$row_clr=mysqli_fetch_assoc($resC);

$sql11="Select status1 from front_slider where id=1";
$res11=mysqli_query($connection,$sql11);
$row_clr11=mysqli_fetch_assoc($res11);

$sql12="Select status1 from front_slider where id=2";
$res12=mysqli_query($connection,$sql12);
$row_clr12=mysqli_fetch_assoc($res12);

$sql13="Select status1 from front_slider where id=3";
$res13=mysqli_query($connection,$sql13);
$row_clr13=mysqli_fetch_assoc($res13);

$sql14="Select status1 from front_slider where id=4";
$res14=mysqli_query($connection,$sql14);
$row_clr14=mysqli_fetch_assoc($res14);

$sql15="Select status1 from front_slider where id=5";
$res15=mysqli_query($connection,$sql15);
$row_clr15=mysqli_fetch_assoc($res15);

$sql16="Select status1 from front_slider where id=6";
$res16=mysqli_query($connection,$sql16);
$row_clr16=mysqli_fetch_assoc($res16);

$sql17="Select status1 from front_slider where id=7";
$res17=mysqli_query($connection,$sql17);
$row_clr17=mysqli_fetch_assoc($res17);

$sql18="Select status1 from front_slider where id=8";
$res18=mysqli_query($connection,$sql18);
$row_clr18=mysqli_fetch_assoc($res18);

$sql19="Select status1 from front_slider where id=9";
$res19=mysqli_query($connection,$sql19);
$row_clr19=mysqli_fetch_assoc($res19);

$sql10="Select status1 from front_slider where id=10";
$res10=mysqli_query($connection,$sql10);
$row_clr10=mysqli_fetch_assoc($res10);
				
			
?>
<?$color_theme=$_SESSION['color_theme'];
if($color_theme==''){
     $color_theme=givedata("ja_comp_master","comp_id",1,"color_theme",$connection);
}
?>
<!-- Function for light Color -->
<?php
function adjustBrightness($hex, $steps) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Normalize into a six character long hex string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Split into three parts: R, G and B
    $color_parts = str_split($hex, 2);
    $return = '#';

    foreach ($color_parts as $color) {
        $color   = hexdec($color); // Convert to decimal
        $color   = max(0,min(255,$color + $steps)); // Adjust color
        $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
    }

    return $return;
}
?>
<!-- End Function -->
<!--<?if(givedata("ja_comp_master","comp_id",1,"header_type",$connection)!='header_with_middle_logo'  || givedata("ja_comp_master","comp_id",1,"comp_ins",$connection)!='SHLR'){?> 
<link rel="stylesheet" href="css/font-awesome.min.css">
<?}?>
<link rel="stylesheet" type="text/css" href="slick/slick.css">
<link rel="stylesheet" type="text/css" href="slick/slick-theme.css">
<link rel="stylesheet" type="text/css" href="css/font_family.css">
<link rel="stylesheet" type="text/css" href="css/w44.css">
<link rel="stylesheet" type="text/css" href="css/shhm.css">
<link rel="stylesheet" href="css/flipclock.css" type="text/css" >
<link rel="stylesheet" href="css/flip_clock_style.css" type="text/css" >
<link href="css/photo_frame.css" rel="stylesheet">
<link href="css/Frontpage.css" rel="stylesheet" type="text/css" >
<link href="css/team_new.css" rel="stylesheet" type="text/css" >
<script src="js/owl.carousel-4ee3697cf0eceb22ffb29e696e21db29.js"></script>
<link rel="stylesheet" media="screen" href="css/owl.carousel-00e9a6c32e0114d4bca3dbdfcf28e0e3.css" >
<script language="javascript" src="js/frontend-276561085db747d497bd1726625e9e5e.js" type="text/javascript"></script>
<link href="css/product.css" rel="stylesheet" type="text/css" >
-->
<!-- ======================== Font size For All Main heading display in Index Page Start ========================== -->

    <?if(givedata("ja_comp_master","comp_id",1,"index_heading_font",$connection)!=0){?>
    <style> 
     .fnt{
        font-size:<?=givedata("ja_comp_master","comp_id",1,"index_heading_font",$connection)?>px; 
     }
     </style>   
    <?}?>

<!-- ======================== Font size For All Main heading display in Index Page End ========================== -->


<!-- seq div code start  -->

<? 
/*if($_SESSION[club_id]==''){$club=1;
    $sql_first_page="select * from first_page_setting where flag='YES' and branch_id IN(0,1) order by seq";
}else{$c1=$_SESSION[club_id];
   $sql_first_page="select * from first_page_setting where flag='YES' and branch_id IN ($_SESSION[club_id],1,0) order by seq"; 
}*/
//echo "kk".$sql_first_page;
//$sql_first_page="select * from first_page_setting where flag='YES' and branch_id='$club' order by seq";
 $sql_first_page="select * from first_page_setting where flag='YES' order by seq";
$res_first_page=mysqli_query($connection,$sql_first_page);
?>
<?if($row_header_type[comp_ins]=='MCMP'){?>
<div class="col-sm-9" style="padding-right: 0;padding-left: 0;">
<?}?>
<?
while($row_first_page=mysqli_fetch_assoc($res_first_page)){  
    
$page = $row_first_page['div_info'];

$php  = '.php';
 $both = 'front_page_pattern/'.$page . $php;
//var_dump($both);
?>

<?include $both;
}?>
<?if($row_header_type[comp_ins]=='MCMP'){?>
</div>
<?}?>
 
 

<?if($row_header_type[comp_ins]=='KRIS'){?>
<style>
    @media (max-width:767px){
        #boxes{
            display:none;
        }
    }
</style>
    <div id="boxes">
      <!--  <div class="w3-center">

    <div class="w3-content w3-section">-->

<div id="dialog" class="window popup_main" style="">
     
<? 
if($_SESSION[club_id]!='')
{
     $sql_mx1= "SELECT upload_advertise.id AS advId,display_on,img_path,flag,redirect,web_address FROM  `upload_advertise`,`advertise_loc` Where upload_advertise.start_date<='".date("Y-m-d")."' AND upload_advertise.end_date>='".date("Y-m-d")."' and upload_advertise.flag=advertise_loc.id AND advertise_loc.display_pattern_type='PopUp' and upload_advertise.branch_id='$_SESSION[club_id]'";
}else{
 $sql_mx1= "SELECT upload_advertise.id AS advId,display_on,img_path,flag,redirect,web_address FROM  `upload_advertise`,`advertise_loc` Where upload_advertise.start_date<='".date("Y-m-d")."' AND upload_advertise.end_date>='".date("Y-m-d")."' and upload_advertise.flag=advertise_loc.id AND advertise_loc.display_pattern_type='PopUp' and upload_advertise.branch_id='1'";
}
//echo "ok123-".$sql_mx1;
$result_mx2=mysqli_query($connection,$sql_mx1);
$rows_mx1=mysqli_num_rows($result_mx2);
if($rows_mx1==0)
{ 
$sql_st1= "SELECT * FROM  `advertise_loc` Where img_visible='Yes' and display_on='Website' and display_pattern_type='PopUp'";
$result_st1=mysqli_query($connection,$sql_st1);
$i=1;
while ($data_st1=mysqli_fetch_assoc($result_st1))
{
$path_st1=explode("../",$data_st1[image]);
//echo "uu".$path11[1];
?>
<a href="connect_us.php?id=1"><img src="RUHA/<?=$path_st1[1];?>"  alt="pop-up image"></a>
<?  
}
}
else
{
 ?>
 
 <div class="owl-carousel owl-theme" id="owl-carousel-1-ad" style="max-width: 500px;max-height: 500px;">
 <?
 $ig=1;
while ($data_mx2=mysqli_fetch_assoc($result_mx2))
{
$data_mx2[flag];
$data_mx2[img_path];
$img_visible=givedata("advertise_loc","id",$data_mx2[flag],"img_visible",$connection);
$display_pattern_type=givedata("advertise_loc","id",$data_mx2[flag],"display_pattern_type",$connection);
$display_on	=givedata("advertise_loc","id",$data_mx2[flag],"display_on",$connection);
$width=givedata("advertise_loc","id",$data_mx2[flag],"width",$connection);
$height=givedata("advertise_loc","id",$data_mx2[flag],"height",$connection);

if($display_on=="Website")
{
if($display_pattern_type=="PopUp")
{
$path_x3=explode("../",$data_mx2[img_path]);

?>
<!--<a <? if($data_mx2[redirect]!='No') { ?> href="advertise.php?id=<?=$data_mx2[advId]?>" <? }else{ ?> href="<?=$data_mx2[web_address]?>"<?}?> ><img src="RUHA/<?=$path_x3[1];?>" class="img-responsive" ></a>-->
<!--
<a class="" target="_blank" <? if($data_mx2[redirect]!='No') { ?> href="<?=$data_mx2[web_address]?>" <? }else{ ?> href="<?=$data_mx2[web_address]?>"<?}?> >
    <img src="RUHA/<?=$path_x3[1];?>" class="img-responsive mySlides1 active"  alt="pop-up image">
    </a>
    -->
     <div class="item <?if($ig==1){?>active<?}?>">
        <a class="" target="_blank" <? if($data_mx2[redirect]!='No') { ?> href="<?=$data_mx2[web_address]?>" <? }else{ ?> href="<?=$data_mx2[web_address]?>"<?}?> >
    <img src="RUHA/<?=$path_x3[1];?>" class="img img-responsive mySlides1"  alt="pop-up image" style="max-width: 500px;max-height: 500px;">
    </a>
        </div>


<? } 
}
$ig++;
}
$i++;
}
?>
</div>

<script>
$('#owl-carousel-1-ad').owlCarousel({
    loop:true,
    margin:10,
    autoplay:true,
    autoplayTimeout:4000,
    autoplayHoverPause:true,
    dots: true,
    slideBy: 1,
   nav:true,
    navText : ['<button type="button" class="slick-prev slick-arrow"><i class="fa fa-angle-left" aria-hidden="true" style="color:<?=$color_theme?>;display: inline-block;"></i></button>','<button type="button" class="slick-next slick-arrow"><i class="fa fa-angle-right" aria-hidden="true" style="color:<?=$color_theme?>;display: inline-block;"></i></button>'],
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            //nav:true
           dots: false,
        },
        600:{
            items:1,
           // nav:false
        },
        1000:{
            items:1,
            
            //nav:true,
            //loop:false
        }
    }
})
       $(document).ready(function(){
           var x = window.matchMedia("(max-width: 700px)")
function myFunction(x) {
  if (x.matches) { // If media query matches
    } else {
  const scrollingElement = (document.scrollingElement || document.body);

  const scrollSmoothToBottom = () => {
  $(scrollingElement).animate({
  scrollTop: document.body.scrollHeight,
  }, 500);
 }
 scrollSmoothToBottom();
  }
}
  
})
</script>
<style>
    .owl-prev ,.owl-next{display: inline-block!important;}
</style>

<div id="popupfoot" style="margin: 0 auto;text-align: center;">
    <a  id="fancybox-close" style="display:block;" onclick="fancybox_close()" class="agree"></a>  
    </div>
  <!--  </div></div>-->
</div>
<div id="mask"></div>
</div>

   <!-- <script>

var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides1");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 5000); // Change image every 2 seconds
}

$(document).ready(function(){
  const scrollingElement = (document.scrollingElement || document.body);

  const scrollSmoothToBottom = () => {
  $(scrollingElement).animate({
  scrollTop: document.body.scrollHeight,
  }, 500);
 }
 scrollSmoothToBottom();
})
</script>-->

<?}else{?>
<div id="boxes">
<div id="dialog" class="window popup_main">
<? 
if($_SESSION[club_id]!='')
{
     $sql_mx1= "SELECT upload_advertise.id AS advId,display_on,img_path,flag,redirect,web_address FROM  `upload_advertise`,`advertise_loc` Where upload_advertise.start_date<='".date("Y-m-d")."' AND upload_advertise.end_date>='".date("Y-m-d")."' and upload_advertise.flag=advertise_loc.id AND advertise_loc.display_pattern_type='PopUp' and upload_advertise.branch_id='$_SESSION[club_id]'";
}else{
 $sql_mx1= "SELECT upload_advertise.id AS advId,display_on,img_path,flag,redirect,web_address FROM  `upload_advertise`,`advertise_loc` Where upload_advertise.start_date<='".date("Y-m-d")."' AND upload_advertise.end_date>='".date("Y-m-d")."' and upload_advertise.flag=advertise_loc.id AND advertise_loc.display_pattern_type='PopUp' and upload_advertise.branch_id='1'";
}
//echo "ok123-".$sql_mx1;
$result_mx2=mysqli_query($connection,$sql_mx1);
$rows_mx1=mysqli_num_rows($result_mx2);
if($rows_mx1==0)
{ 
$sql_st1= "SELECT * FROM  `advertise_loc` Where img_visible='Yes' and display_on='Website' and display_pattern_type='PopUp'";
$result_st1=mysqli_query($connection,$sql_st1);
while ($data_st1=mysqli_fetch_assoc($result_st1))
{
$path_st1=explode("../",$data_st1[image]);
//echo "uu".$path11[1];
?>
<a href="connect_us.php?id=1"><img src="RUHA/<?=$path_st1[1];?>"  alt="pop-up image"></a>
<?  
}
}
else
{
    
while ($data_mx2=mysqli_fetch_assoc($result_mx2))
{
$data_mx2[flag];
$data_mx2[img_path];
$img_visible=givedata("advertise_loc","id",$data_mx2[flag],"img_visible",$connection);
$display_pattern_type=givedata("advertise_loc","id",$data_mx2[flag],"display_pattern_type",$connection);
$display_on	=givedata("advertise_loc","id",$data_mx2[flag],"display_on",$connection);
$width=givedata("advertise_loc","id",$data_mx2[flag],"width",$connection);
$height=givedata("advertise_loc","id",$data_mx2[flag],"height",$connection);

if($disp


lay_on=="Website")
{
if($display_pattern_type=="PopUp")
{
$path_x3=explode("../",$data_mx2[img_path]);

?>
<!--<a <? if($data_mx2[redirect]!='No') { ?> href="advertise.php?id=<?=$data_mx2[advId]?>" <? }else{ ?> href="<?=$data_mx2[web_address]?>"<?}?> ><img src="RUHA/<?=$path_x3[1];?>" class="img-responsive" ></a>-->

<a target="_blank" <? if($data_mx2[redirect]!='No') { ?> href="<?=$data_mx2[web_address]?>" <? }else{ ?> href="<?=$data_mx2[web_address]?>"<?}?> ><img src="RUHA/<?=$path_x3[1];?>" class="img-responsive" alt="pop-up image"></a>


<? } 
}
}
}
?>

<div id="popupfoot" style="margin: 0 auto;text-align: center;">
    <a  id="fancybox-close" style="display:block;" onclick="fancybox_close()" class="agree"></a>  
    </div>
</div>
<div id="mask"></div>
</div>
<?}?>

<div id="boxes_rgt">
<div id="dialog_rgt" class="window_rgt popup_main_rgt">
<? 
$sql_mx22= "SELECT * FROM  `upload_advertise`,`advertise_loc`, Where upload_advertise.start_date<='".date("Y-m-d")."' AND upload_advertise.end_date>='".date("Y-m-d")."' and upload_advertise.flag=advertise_loc.id AND advertise_loc.display_pattern_type='Right'";
$result_mx22=mysqli_query($connection,$sql_mx22);
$rows_mx22=mysqli_num_rows($result_mx22);
if($rows_mx22==0)
{ 
$sql_st22= "SELECT * FROM  `advertise_loc` Where img_visible='Yes' and display_on='Website' and display_pattern_type='Right'";
$result_st22=mysqli_query($connection,$sql_st22);
while ($data_st22=mysqli_fetch_assoc($result_st22))
{

$path_st22=explode("../",$data_st22[image]);
//echo "uu".$path11[1];
?>
<a href="connect_us.php?id=1"><img src="RUHA/<?=$path_st22[1];?>" class="img img-responsive" ></a>
<? 
}
}
else
{
while ($data_mx22=mysqli_fetch_assoc($result_mx22))
{
$data_mx22[flag];
$data_mx22[img_path];
$img_visible22=givedata("advertise_loc","id",$data_mx22[flag],"img_visible",$connection);
$display_pattern_type22=givedata("advertise_loc","id",$data_mx22[flag],"display_pattern_type",$connection);
$display_on22	=givedata("advertise_loc","id",$data_mx22[flag],"display_on",$connection);
$width22=givedata("advertise_loc","id",$data_mx22[flag],"width",$connection);
$height22=givedata("advertise_loc","id",$data_mx22[flag],"height",$connection);

if($display_on=="Website")
{
if($display_pattern_type=="Right")
{
$path_x22=explode("../",$data_mx22[img_path]);
?>
<a <? if($data_mx22[redirect]!='No') { ?> href="advertise.php?id=<?=$data_mx22[id]?>" <? }else{ ?> href="<?=$data_mx22[web_address]?>"<?}?> ><img src="RUHA/<?=$path_x22[1];?>" class="img-responsive" ></a>
<? } 
}
}
}
?>

<div id="popupfoot_rgt" style="margin:0 auto;text-align: center;"><a  id="fancybox-close1" onclick="fancybox_close()" style="display:block;" class="agree_rgt"></a>   </div>
</div>
</div>
 
 <?  $sqlmxx= "SELECT upload_advertise.id AS advId,display_on,img_path,redirect,web_address FROM  `upload_advertise`,`advertise_loc` Where upload_advertise.start_date<='".date("Y-m-d")."' AND upload_advertise.end_date>='".date("Y-m-d")."' and upload_advertise.flag=advertise_loc.id AND advertise_loc.display_pattern_type='Bottom' AND advertise_loc.link_name='Home'";
$resultmxx=mysqli_query($connection,$sqlmxx);
$rowsmxx=mysqli_num_rows($resultmxx);
if($rowsmxx==0)
{ 

$sql_stmtx= "SELECT image,id FROM  `advertise_loc` Where img_visible='Yes' AND link_name='Home' AND display_pattern_type='Bottom' AND display_on='Website' ";
$result_stmtx=mysqli_query($connection,$sql_stmtx);
$data_stmtx=mysqli_fetch_assoc($result_stmtx);
$path11x=explode("../",$data_stmtx[image]);
//echo "uu".$path11[1];
$row_nox=mysqli_num_rows($result_stmtx);
if($row_nox>0)
{
?>
<div style="margin-bottom::50px;" align="center"><a href="connect_us.php?id=1&&nm=<?=$data_stmtx['id'];?>" ><img src="RUHA/<?=$path11x[1]?>" class="img-responsive" ></a></div>
<?  
}
}
else
{
//echo "<br>else  else else";
while ($datamxx=mysqli_fetch_assoc($resultmxx))
{
if($datamxx[display_on]=="Website")
{
$pathxx=explode("../",$datamxx[img_path]);
?>
<div style="margin-bottom::50px;" align="center"><a <? if($datamxx[redirect]!='No') { ?>  href="advertise.php?id=<?=$datamxx[advId];?>" <? }else{ ?> href="<?=$datamxx[web_address]?>"<?}?>><img src="RUHA/<?=$pathxx[1]?>" class="img-responsive"></a></div>
<?  
}
}
}
?>
<script>
    $(function () {
        $("#fancybox-close").click(function () {
            $("#boxes").modal("hide");
        });
        $("#fancybox-close1").click(function () {
            $("#boxes").modal("hide");
        });
    });
    function fancybox_close(){
       // alert("ii");
        $("#boxes").css("display", "none"); 
    }
</script>
<script>
$(document).ready(function(){
 <? if($path_st1[1]!='' || $path_x3[1]!='')
 {
 ?>
 var id = '#dialog';
    
//Get the screen height and width

var maskHeight = $(document).height();

var maskWidth = $(window).width();

   

//Set heigth and width to mask to fill up the whole screen

$('#mask').css({'width':maskWidth,'height':maskHeight});

$('#mask').fadeIn(500);

$('#mask').fadeTo("slow",0.9); 

var winH = $(window).height();

var winW = $(window).width();

$(id).css('left', winW/2-$(id).width()/2);
/*var x = window.matchMedia("(max-width: 700px)")
function myFunction(x) {
  if (x.matches) { // If media query matches
    $(id).css('left', winW/2-$(id).width()/2);
  } else {
  $(id).css('left', winW/2-$(id).width()/2);
  }
}*/

// Create a MediaQueryList object


$(id).fadeIn(2000);  

$('.window .agree').click(function (e) {

e.preventDefault();

$('#mask').hide();

$('.window').hide();

});

$('#mask').click(function () {

$(this).hide();

$('.window').hide();

});
<?
}
?>
 <? if($path_st22[1]!='' || $path_x22[1]!='')
 {
 ?>
var id_rgt = '#dialog_rgt';
$(id_rgt).css('right',10);
$(id_rgt).fadeIn("medium");  

$('.window_rgt .agree_rgt').click(function (e) {
$('.window_rgt').hide();

});
   <?
   }
   ?> 
  
  $('.responsive').slick({
  dots: true,
  infinite: false,
  speed: 5000,
  autoplay: true,
  autoplaySpeed: 5000,
  slidesToShow: 6,
  slidesToScroll: 6,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
                    // Gritter notification intro 2
                        
                            // (string | optional) the image to display on the left
<? 
$sql_mx1= "SELECT * FROM  `upload_advertise`,`advertise_loc` Where upload_advertise.start_date<='".date("Y-m-d")."' AND upload_advertise.end_date>='".date("Y-m-d")."' and upload_advertise.flag=advertise_loc.id AND advertise_loc.display_pattern_type='Right'";
$result_mx1=mysqli_query($connection,$sql_mx1);
$rows_mx1=mysqli_num_rows($result_mx1);
if($rows_mx1==0)
{ 
$sql_st1= "SELECT * FROM  `advertise_loc` Where img_visible='Yes'";
$result_st1=mysqli_query($connection,$sql_st1);
while ($data_st1=mysqli_fetch_assoc($result_st1))
{
if($data_st1[display_on]=="Website")
{
if($data_st1[display_pattern_type]=="Right")
{
$path_x1=explode("../",$data_st1[image]);
//echo "uu".$path11[1];
?>


<? } 
}
}
}
else
{
while ($data_mx1=mysqli_fetch_assoc($result_mx1))
{
$data_mx1[flag];
$data_mx1[img_path];
$img_visible=givedata("advertise_loc","id",$data_mx1[flag],"img_visible",$connection);
$display_pattern_type=givedata("advertise_loc","id",$data_mx1[flag],"display_pattern_type",$connection);
$display_on	=givedata("advertise_loc","id",$data_mx1[flag],"display_on",$connection);
$width=givedata("advertise_loc","id",$data_mx1[flag],"width",$connection);
$height=givedata("advertise_loc","id",$data_mx1[flag],"height",$connection);

if($display_on=="Website")
{
if($display_pattern_type=="Right")
{
$path_x1=explode("../",$data_mx1[img_path]);
?>


<? } 
}
}
}
?>
		
                   

                
});
</script>
<script>
$(document).ready(function(){
    
   $('.responsive').slick({
  dots: true,
  infinite: false,
  speed: 5000,
  autoplay: true,
  autoplaySpeed: 5000,
  slidesToShow: 6,
  slidesToScroll: 6,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
   
  
});
</script>
<?
//echo "kkkkkkk".$page_name[1];
if($page_name[1]!='index' and givedata("ja_comp_master","comp_id","1","annimation_type",$connection)=='Yes'){?>
<?

$animation_heading_nm=givedata("animation_setting","element_name","heading","animation_name",$connection);
if($animation_heading_nm=='wave'){
?>
<style>
     .fnt ,.subhead_info , .subsubhead_info
{
   text-transform: uppercase;
  background-image: linear-gradient(
    -225deg,
    #231557 0%,
    #0861a3 29%,
    #76b776 67%,
    #247524 100%
  );
  /*background-image: linear-gradient(
    -225deg,
    #231557 0%,
    #44107a 29%,
    #ff1361 67%,
    #fff800 100%
  );*/
  background-size: auto auto;
  background-clip: border-box;
  background-size: 200% auto;
  color: #fff;
  background-clip: text;
  text-fill-color: transparent;
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  animation: textclip 3s linear infinite;
  display: inline-block;
      
}

@keyframes textclip {
  to {
    background-position: 200% center;
  }
}
 </style>
<script>
$(document).ready(function () {
//alert('<?=$animation_heading_nm?>');
//alert('<?=givedata("animation_master","animation_class","$animation_heading_nm","animation_name",$connection)?>');

 //$('.fnt').addClass('<?=$animation_heading_nm?>');
//$('.fnt').addClass('animate__heartBeat');
//$('.fnt').prop('class', 'animate__heartBeat')
//$("p").addClass("GFG2");


});
</script>
<style>
/*.fnt{ text-shadow: 2px 7px 5px rgba(0,0,0,0.3), 
    0px -4px 10px rgba(255,255,255,0.3);}
    
    .main_head{
  animation: <?=givedata("animation_master","animation_class","$animation_heading_nm","animation_name",$connection)?>!important; /* referring directly to the animation's @keyframe declaration */
  animation-duration: 60s!important; /* don't forget to set a duration! 
}*/
</style>
<?}?>
<?
//echo "kkkkkkk".$page_name[1];
if(givedata("ja_comp_master","comp_id","1","annimation_type",$connection)=='Yes'){
 if($page_name[1]==null){
?>
<style>
<?
$animation_heading_nm=givedata("animation_setting","element_name","heading","animation_name",$connection);
if($animation_heading_nm!='none'){
?>
.main_head{
  animation: <?=givedata("animation_master","animation_class","$animation_heading_nm","animation_name",$connection)?>!important; /* referring directly to the animation's @keyframe declaration */
  animation-duration: 2s!important; /* don't forget to set a duration! */
}
<?}?>
<?
$animation_row_nm=givedata("animation_setting","element_name","row","animation_name",$connection);
if($animation_row_nm!='none'){
?>
.row{
   animation: <?=givedata("animation_master","animation_class","$animation_row_nm","animation_name",$connection)?>; /* referring directly to the animation's @keyframe declaration */
   animation-duration: 2s;
}
<?}?>
<?
$animation_button_nm=givedata("animation_setting","element_name","button","animation_name",$connection);
if($animation_button_nm!='none'){
?>
.btn,.button{
   animation: <?=givedata("animation_master","animation_class","$animation_button_nm","animation_name",$connection)?>; /* referring directly to the animation's @keyframe declaration */
   animation-duration: 2s;
}
<?}?>
<?
$animation_img_nm=givedata("animation_setting","element_name","image","animation_name",$connection);
if($animation_img_nm!='none'){
?>
.img{
   animation: <?=givedata("animation_master","animation_class","$animation_img_nm","animation_name",$connection)?>; /* referring directly to the animation's @keyframe declaration */
   animation-duration: 2s;
}
<?}?>
<?
$animation_description_nm=givedata("animation_setting","element_name","description","animation_name",$connection);
if($animation_description_nm!='none'){
?>
p{
   animation: <?=givedata("animation_master","animation_class","$animation_description_nm","animation_name",$connection)?>; /* referring directly to the animation's @keyframe declaration */
   animation-duration: 2s;
}
<?}?>
<?
$animation_col_nm=givedata("animation_setting","element_name","coloum","animation_name",$connection);
if($animation_col_nm!='none'){
?>
.col-md-4,.col-md-3,.col-md-6{
   animation: <?=givedata("animation_master","animation_class","$animation_col_nm","animation_name",$connection)?>; /* referring directly to the animation's @keyframe declaration */
   animation-duration: 2s;
}
<?}?>
<?
$animation_div_nm=givedata("animation_setting","element_name","div","animation_name",$connection);
if($animation_div_nm!='none'){
?>
div{
   animation: <?=givedata("animation_master","animation_class","$animation_div_nm","animation_name",$connection)?>; /* referring directly to the animation's @keyframe declaration */
   animation-duration: 2s;
}
<?}?>
</style>
<script>
$(document).ready(function () {
     $('.row').addClass('wow animate__animated');
    $('.main_head').addClass('wow animate__animated');
    //$('.fnt').addClass('wow animate__animated');
    $('.btn').addClass('wow animate__animated');
    $('.button').addClass('wow animate__animated');
    $('.img').addClass('wow animate__animated');
    // $('.main-wrapper-container').addClass('wow');
     $('.col-md-4,.col-md-3,.col-md-6').addClass('wow animate__animated');
     /*$('.col-md-4,.col-md-3,.col-md-6').setAttribute('data-wow-duration','2s');
     $('.col-md-4,.col-md-3,.col-md-6').setAttribute('data-wow-delay','5s');
     $('.main_head').setAttribute('data-wow-duration','2s');
     $('.main_head').setAttribute('data-wow-delay','5s');*/
});
</script>
<?}}?>
    <?}?>
    <script src="animation_js/wow.min.js"></script>
              <script>
              wow = new WOW(
  {
    animateClass: 'animated',
    offset: 100
  }
);
wow.init();
              </script>
 <? if(givedata("ja_comp_master","comp_id",1,"comp_ins",$connection)!='SUNF'){?>
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" >
<script src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script>
$(".showphoto").fancybox({
  'speedIn'  : 600, 
  'speedOut'  : 200,        
  'overlayShow' : false,
  'autoresize' :  true
 /* 'titlePosition' 		: 'inside',
	'titleFormat'		: 'formatTitle'*/
 }); 

</script>
<?}?>
<!-- </div>
  </div>
 </div>
</div> -->
 </div>
 <?php
                if(givedata("ja_comp_master","comp_id",1,"comp_ins",$connection)=='SUTE')
                {?>
                
        <script type="text/javascript" src="css/sun_animation.min.js"></script>
        <link rel="stylesheet" href="css/sun_animation.min.css" type="text/css">
                <?}?>
<!--Footer Code-->
<? $sql_footer_type="select footer_type from ja_comp_master";
$res_footer_type=mysqli_query($connection,$sql_footer_type);


while($row_footer_type=mysqli_fetch_assoc($res_footer_type)){  
    
$page = $row_footer_type['footer_type'];

$php  = '.php';
 $both = $page . $php;
//var_dump($both);
if($page==''){
}else{
include $both;
}
}

 ?>
