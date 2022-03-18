<!doctype html>
<html class="fixed">

    <?php include APPPATH.'views/parts/head.php';?>
    
	<body>
	
		<?php echo $contents;?>

        <?php include APPPATH.'views/parts/script.php';?>
        
        <!-- Load Javascript from Controller -->
        <?php
    	    $file_javascript = isset($file_javascript) ? $file_javascript : '';
        	if (is_array($file_javascript) && count($file_javascript) > 0) {
        		foreach ($file_javascript as $value) {
        			echo '<script src="'.BASE_URL.'public/'.$value.'"></script>';
        		}
        	}
        ?>

	</body>
</html>