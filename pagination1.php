<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" id="font-awesome-style-css" href="https://www.phpflow.com/code/css/bootstrap3.min.css" type="text/css" media="all">
<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<title></title>
</head>
<body>

<div>
<div id="target-content" >loading...</div>
 
<?php
include('db.php'); 
$limit = 2;
$sql = "SELECT COUNT(id) FROM messages";  
$rs_result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit); 
?>
<div align="center">
<td class='pagination text-right' id="pagination">
<?php if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):  
			if($i == 1):?>
            <tr class='active'  id="<?php echo $i;?>"><a href='pagination2.php?page=<?php echo $i;?>'><?php echo $i;?></a></li> 
			<?php else:?>
			<tr id="<?php echo $i;?>"><a href='pagination2.php?page=<?php echo $i;?>'><?php echo $i;?></a></li>
		<?php endif;?>			
<?php endfor;endif;?>  
</div>
</div>
</body>
<script>
jQuery(document).ready(function() {
jQuery("#target-content").load("pagination2.php?page=1");
    jQuery("#pagination li").live('click',function(e){
	e.preventDefault();
		jQuery("#target-content").html('loading...');
		jQuery("#pagination li").removeClass('active');
		jQuery(this).addClass('active');
        var pageNum = this.id;
        jQuery("#target-content").load("pagination2.php?page=" + pageNum);
    });
    });
</script>