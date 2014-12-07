<?php

	include("inc/sql_queries.php");
	$page_title = "Customer";

    //Is the user submiting the form?
    $post = $_SERVER['REQUEST_METHOD'] == "POST"; //Bool

    //Is the entry going to be new or updating?
    $new = !(isset($_REQUEST['CustomerID']) && !empty($_REQUEST['CustomerID'])); //Bool
	$page_subtitle = $new ? "Create" : "Edit";

    //We need to handle the case that we are updating the data
    if(!$new && !$post) { //If we use post it could overwrite data
        $query = get_customer($_REQUEST['CustomerID']);
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
            if(empty($data['Name']))
                $form_errors[] = "Required Item: Name is Blank";
            if(empty($data['Address']))
                $form_errors[] = "Required Item: Address is Blank";
            if(empty($data['Phone']))
                $form_errors[] = "Required Item: Phone is Blank";
            if(empty($data['Email']))
                $form_errors[] = "Required Item: Email is Blank";
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
		global $new;
		global $data;
        /*
        Inserts or Updates the database with the current data
        Child Functions could render error messages (Unlikely)
        */
        if($new) {
            //Insert Function Call Here takes $data
			create_customer($data);
        }
        else {
            //Update Function Call Here takes $data
			update_customer($data);
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
        <p>Welcome, <?php echo_data("Name");?></p>
        <a href='viewcustomer.php?customerid=<?php echo $customerid; ?>' class="btn btn-default">View Customer</a>
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

          <input name="CustomerID" type="hidden" value="<?php echo_data("CustomerID");?>">

          <div class="form-group">
            <label for="Name">Name</label>
            <input name="Name" type="text" class="form-control"placeholder="" value="<?php echo_data("Name");?>">
          </div>
          <div class="form-group">
            <label for="Address">Address</label>
            <input name="Address" type="text" class="form-control"placeholder="" value="<?php echo_data("Address");?>">
          </div>
          <div class="form-group">
            <label for="Phone">Phone</label>
            <input name="Phone" type="tel" class="form-control"placeholder="" value="<?php echo_data("Phone");?>">
          </div>
          <div class="form-group">
            <label for="Email">Email</label>
            <input name="Email" type="email" class="form-control"placeholder="" value="<?php echo_data("Email");?>">
          </div>

          <button type="submit" class="btn btn-default">Submit</button>

        </form>
    </div>
</div>
<?php //End Success


    endif;
	include("templates/footer.php");
?>
