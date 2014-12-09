<?php
	//Global Variables and functions, do not echo text
	$website_name = "Custom Orders";
	$website_desc = "Custom Hanging Baskets and Pot Orders";
	$website_author = "Cody Hoeft, Kyle Nichols";
	
    if(!isset($page_title))
        $page_title = ""; //Override these per page
    if(!isset($page_subtitle))
        $page_subtitle = ""; //Override these per page
	
	$db_host = "oniddb.cws.oregonstate.edu";
	$db_user = "";
	$db_pass = "";
	$db_data = $db_user;


    function render_errors($errors, $text) {
        /*
        Makes Error Messages Pretty
        */
        //Error Rendering ?>
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">There Was An Error</h3>
            </div>
            <div class="panel-body">
                <p><?php echo $text; ?></p>
                <ul>
                <?php foreach($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php //End Error Rendering
    }
?>
