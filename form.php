<?php
	$page_title = "Form";
	$page_subtitle = "Basic Template";

    //Is the user submiting the form?
    $post = $_SERVER['REQUEST_METHOD'] == "POST"; //Bool

    //Is the entry going to be new or updating?
    $new = !(isset($_REQUEST['hiddenid']) && !empty($_REQUEST['hiddenid'])); //Bool

    //We need to handle the case that we are updating the data
    if(!$new && !$post) { //If we use post it could overwrite data
        //Use this line to get data from the database when you are updating the object
        $query = array();
        $data = array_unique(array_merge($_REQUEST, $query));
    }
    else {
        $data = $_REQUEST;
    }


    function validate_submit() {
        /*
        This function returns true only if the form has been SUBMITTED with VALID data
        If it has been SUBMITTED but INVALID errors will be rendered and false will be returned
        */
        global $post;
        global $data;
        $form_errors = array();
        $valid = False;
        //If the method is POST
        if($post) {
            //Validation Rules Here
            if(empty($data['formitem']))
                $form_errors += ["Required Item: formitem is Blank"];
            if($data['formitem'] == "1")
                $form_errors += ["formitem cannot be 1"];
            //End Validation Rules
            if(!count($form_errors)) {
                $valid = True; 
            }
            else {
                render_errors($form_errors, "Please Fix the Following Items:");
            }
        }
        return $valid;
    }
    
    
    function echo_data($formitem) {
        /*
        Echos existing data, makes sure that it exists
        */ 
        global $data;
        if(isset($data[$formitem]) && !empty($data[$formitem])) {
            echo $data[$formitem];
        }
    }

    
    function update_database() {
        /*
        Inserts or Updates the database with the current data
        Child Functions could render error messages (Unlikely)
        */
        if($new) {
            //Insert Function Call Here takes $data
        }
        else {
            //Update Function Call Here takes $data
        }
    }

//////////////////////////////////
//Template Zone, try to keep functionality out of here when possible. Limiting to simple loops and if statements
//////////////////////////////////

	include("templates/header.php");
    if(validate_submit()): //If Valid and Sumbited, Render Success Message; else form...
        update_database();


//Success Message ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo "Successfully " . ($new ? "Created" : "Updated") . "!" ; ?></h3>
    </div>
    <div class="panel-body">
        <p>The formitem you entered was <?php echo_data("formitem");?></p>
        <a href='.' class="btn btn-default">Continue</a>
    </div>
</div>
<?php //End Success


    else:


//Form only rendered if validate ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Form Title</h3>
    </div>
    <div class="panel-body">
        <form method="POST">

          <input name="hiddenid" type="hidden" value="<?php echo_data("hiddenid");?>">

          <div class="form-group">
            <label for="formitem">formitem description</label>
            <input name="formitem" type="text" class="form-control"placeholder="" value="<?php echo_data("formitem");?>">
          </div>

          <button type="submit" class="btn btn-default">Submit</button>

        </form>
    </div>
</div>
<?php //End Success


    endif;
	include("templates/footer.php");
?>
