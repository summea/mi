<?php

function myExceptionHandler($e) {
?>
<html>
<head>
<title>Error</title>
<script type="text/javascript" src="<?php echo Configure::read('LIB_PUBLIC_URL') ?>javascript/jquery-latest.js"></script>
<script type="text/javascript" src="<?php echo Configure::read('LIB_PUBLIC_URL') ?>javascript/default.js"></script>
<script type="text/javascript" src="<?php echo Configure::read('LIB_PUBLIC_URL') ?>javascript/exceptions.js"></script>
<link rel="stylesheet" href="<?php echo Configure::read('LIB_PUBLIC_URL') ?>css/default.css" type="text/css" media="screen" />
</head>
<body>
<div id="error_box">Error: <?php echo $e->getMessage(); ?>
<a href="" id="error_details_toggle">Show Details</a>
<div id="error_details">
<pre>
<?php print_r($e); ?>
</pre>
</div>
</div>
</body>
</html>

<?php
}

set_exception_handler('myExceptionHandler');

?>
