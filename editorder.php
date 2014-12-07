<?php
	$page_title = "Order";
	$page_subtitle = "Edit";

    //Is the user submiting the form?
    $post = $_SERVER['REQUEST_METHOD'] == "POST"; //Bool

    //Is the entry going to be new or updating?
    $new = !(isset($_REQUEST['orderid']) && !empty($_REQUEST['orderid'])); //Bool
	
    if(isset($_REQUEST['orderid']) && !empty($_REQUEST['orderid'])) {
        $orderid = $_REQUEST['orderid']; 
    }
    else {
        $orderid = NULL;
    }
	
    if(isset($_REQUEST['customerid']) && !empty($_REQUEST['customerid'])) {
        $customerid = $_REQUEST['customerid']; 
    }
    else {
        $customerid = NULL;
    }
	
	//There is the special case here that there is a new basket being created, this is done automatically in the background
	if($new && $customerid != NULL) {
		//$orderid = createorder($customerid);
		$orderid = 10;
		header("Location: editorder.php?orderid=".$orderid);
		exit(0);
	}
	
	function echo_data($data, $item) {
        /*
        Echos existing data, makes sure that it exists
        */ 
        if(isset($data[$item])) {
            echo $data[$item];
        }
    }
	
    //We need to handle the case that we are updating the data
    if(!$post) { //If we use post it could overwrite data
        //query = getorder($orderid);
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
            if( empty($data['DateOrdered']) && ( $data["Complete"] || $data["PickUp"] ) )
                $form_errors[] = "If the Order has not been ordered, then the Order cannot be completed or picked up";
			if( !$data["Complete"] && $data["PickUp"] )
                $form_errors[] = "To mark a Order as Picked Up, please mark it as completed too";
			if( $data["PickUp"] && empty($data["DateOrdered"]) )
                $form_errors[] = "Marked as Picked Up, but nothing has been paid";
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

    
    function update_database() {
        /*
        Inserts or Updates the database with the current data
        Child Functions could render error messages (Unlikely)
        */
        //updateorder($data); //FIXME
    }

//////////////////////////////////
//Template Zone, try to keep functionality out of here when possible. Limiting to simple loops and if statements
//////////////////////////////////
include("templates/header.php");
if($orderid != NULL):
    if(validate_submit()): //If Valid and Sumbited, Render Success Message; else form...
        update_database();


//Success Message ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Successfully Updated</h3>
    </div>
    <div class="panel-body">
        <p>The Order has been updated.</p>
        <a href="javascript:window.location.href=window.location.href" class="btn btn-default">Continue</a>
    </div>
</div>
<?php //End Success


    else:
        if(isset($_REQUEST['admin'])): //User can only edit this info if they are admin

//Form only rendered if validate ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Edit Order Meta</h3>
    </div>
    <div class="panel-body">
        <form method="POST">

          <input name="orderid" type="hidden" value="<?php echo_data($data,"orderid");?>">

          <div class="form-group">
            <label for="DateOrdered">Date Ordered</label>
            <input name="DateOrdered" type="date" class="form-control" placeholder="" value="<?php echo_data($data,"DateOrdered");?>">
          </div>

          <div class="form-group">
            <label for="QuotedPrice">Quoted Price</label>
            <input name="QuotedPrice" type="number" step="any" class="form-control" placeholder="" value="<?php echo_data($data,"QuotedPrice");?>">
          </div>

          <div class="form-group">
            <label for="Paid">Total Paid</label>
            <input name="Paid" type="number" step="any" class="form-control" placeholder="" value="<?php echo_data($data,"Paid");?>">
          </div>
		  <div class="form-group">
			  <div class="checkbox">
				<label>
				  <input name="Complete" type="checkbox" value=1 <?php echo isset($data['Complete']) && $data['Complete'] ? " checked" : "";?>> Complete
				</label>
			  </div>

			  <div class="checkbox">
				<label>
				  <input name="PickUp" type="checkbox"  value=0 <?php echo isset($data['Complete']) && $data['Complete'] ? " checked" : "";?>> Picked Up
				</label>
			  </div>
		  </div>
          <button type="submit" class="btn btn-default">Update</button>

        </form>
    </div>
</div>
<?php


        endif; //Both the customer and admin can do the rest


?>
<?php 
	endif;
    $containers = array(array("ContainerID" => 1, "Shape" => "12inch", "Color" => "Red", "Desc" => "Much Wow", "Weight" => "12lbs")); //FIX ME
    //$containers = selectcontainersfromorder($orderid);

?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Attached Containers</h3>
		</div>
        <div class="panel-body">
<?php
    if(count($containers)):
?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Shape</th>
                    <th>Color</th>
                    <th>Weight</th>
                    <th>Description</th>
					<th></th>
					<th></th>
                </tr>
            </thead>
            <tbody>
<?php 
        foreach($containers as $row):
?>
                <tr>
                    <td class="text-center"><a href="<?php echo "viewcontainer.php?containerid=".$row['ContainerID']; ?>"><span class="glyphicon glyphicon-search"></span></a></td>
                    <td><?php echo_data($row, 'Shape'); ?></td>
                    <td><?php echo_data($row, 'Color'); ?></td>
                    <td><?php echo_data($row, 'Weight'); ?></td>
                    <td><?php echo_data($row, 'Desc'); ?></td>
					<td class="text-center"><a href="<?php echo "editcontainer.php?containerid=".$row['ContainerID']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
					<td class="text-center"><a href="<?php echo "deletecontainer.php?redirect=editorder.php&containerid=".$row['ContainerID']."&orderid=".$orderid.(isset($_REQUEST['admin']) ? "&admin" : ""); ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
                </tr>
<?php 
        endforeach; 
?>
            <tbody>
            <!--
            <tfoot>
                <tr>
                    <th></th>
                </tr>
            </tfoot>
            -->
        </table>
<?php
    else:
?>
        <p>Sorry There is No Data Yet</p>
<?php
    endif;
?>
		<p class="text-center"><a class="btn btn-info" href="editcontainer.php?orderid=<?php echo $orderid; ?>">Add Container</a></p>
		</div>
	</div>
<?php //End Success
?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Order Actions</h3>
			</div>
			<div class="panel-body text-center">
			<?php if(!isset($data['submitted']) || !$data['submitted']): ?>
				<p class="btn-group"><a class="btn btn-danger" href="deleteorder.php?orderid=<?php echo $orderid; ?>">Delete Order</a><a class="btn btn-success" href="submitorder.php?orderid=<?php echo $orderid; ?>">Submit Order</a></p>
			<?php else: ?>
				<p><a class="btn btn-danger" href="deleteorder.php?orderid=<?php echo $orderid; ?>">Cancel Order</a></p>
			</div>
		</div>
<?php
		endif;
else: ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Error</h3>
		</div>
		<div class="panel-body">
			<p>We are missing some information necessary to display this page. This page requires the orderid before it can be displayed</p>
		</div>
	</div>
<?php
endif;
	include("templates/footer.php");
?>
