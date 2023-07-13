<?php
include_once('./views/site/header.php');
?>
<!-- header -->
<?php
$page = '';
if (isset($_GET['page'])) {
  $page= trim(strip_tags($_GET['page']));
}else{
    $page = '';
}
// switch ($page){
//     case "product" : include_once './views/site/product.php'; break;
//     case "category" : include_once './views/site/category.php'; break;
//     default: include_once './views/site/main.php'; 
//  }//switch
if (isset($_GET['page'])) {
  $page=$_GET['page'];
}
if($page=='')$page='main';
$page=str_replace('./views/site/','',$page);
if(is_file("./views/site/{$page}.php"))
  include_once("./views/site/{$page}.php");
else
  echo 'page not invalid';
?>

<!-- footer -->
<?php
include_once('./views/site/footer.php');
?>
