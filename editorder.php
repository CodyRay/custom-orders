<?php
	$page_title = "Order";
	$page_subtitle = "Edit";
	
	include("inc/sql_queries.php");
    //Is the user submiting the form?
    $post = $_SERVER['REQUEST_METHOD'] == "POST"; //Bool

    //Is the entry going to be new or updating?
    $new = !(isset($_REQUEST['OrderID']) && !empty($_REQUEST['OrderID'])); //Bool
	
    if(isset($_REQUEST['OrderID']) && !empty($_REQUEST['OrderID'])) {
        $OrderID = $_REQUEST['OrderID']; 
    }
    else {
        $OrderID = NULL;
    }
	
    if(isset($_REQUEST['CustomerID']) && !empty($_REQUEST['CustomerID'])) {
        $CustomerID = $_REQUEST['CustomerID']; 
    }
    else {
        $CustomerID = NULL;
    }
	
	//There is the special case here that there is a new basket being created, this is done automatically in the background
	if($new && $CustomerID != NULL) {
		$OrderID = create_blank_order($CustomerID);
		header("Location: editorder.php?OrderID=".$OrderID);
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
        $query = get_order($OrderID);
        $data = $_REQUEST + $query;
    }
    else {
        $data = $_REQUEST;
		if(!isset($data["Complete"])) {
			$data["Complete"] = 0;
		}
		if(!isset($data["PickedUp"])) {
			$data["PickedUp"] = 0;
		}
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
            if( empty($data['DateOrdered']) && ( $data["Complete"] || $data["PickedUp"] ) )
                $form_errors[] = "If the Order has not been ordered, then the Order cannot be completed or picked up";
			if( !$data["Complete"] && $data["PickedUp"] )
                $form_errors[] = "To mark a Order as Picked Up, please mark it as completed too";
			if( $data["PickedUp"] && empty($data["DateOrdered"]) )
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
		global $data;
        /*
        Inserts or Updates the database with the current data
        Child Functions could render error messages (Unlikely)
        */
        update_order($data);
    }

//////////////////////////////////
//Template Zone, try to keep functionality out of here when possible. Limiting to simple loops and if statements
//////////////////////////////////
include("templates/header.php");
if($OrderID != NULL):

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo "Navigation"; ?></h3>
    </div>
    <div class="panel-body text-center">
        <a href='vieworder.php?OrderID=<?php echo $OrderID; ?>' class="btn btn-default">Return to Container View</a>
    </div>
</div>
<?php

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

          <input name="OrderID" type="hidden" value="<?php echo_data($data,"OrderID");?>">
		  <input name="CustomerID" type="hidden" value="<?php echo_data($data,"CustomerID");?>">


          <div class="form-group">
            <label for="DateOrdered">Date Ordered</label>
            <input name="DateOrdered" type="date" class="form-control" placeholder="" value="<?php echo_data($data,"DateOrdered");?>">
          </div>

          <div class="form-group">
            <label for="QuotedPrice">Quoted Price</label>
            <input name="QuotedPrice" type="number" step="any" class="form-control" placeholder="" value="<?php echo_data($data,"QuotedPrice");?>">
          </div>

          <div class="form-group">
            <label for="TotalPaid">Total Paid</label>
            <input name="TotalPaid" type="number" step="any" class="form-control" placeholder="" value="<?php echo_data($data,"TotalPaid");?>">
          </div>
		  <div class="form-group">
			  <div class="checkbox">
				<label>
				  <input name="Complete" type="checkbox" value=1 <?php echo isset($data['Complete']) && $data['Complete'] ? " checked" : "";?>> Complete
				</label>
			  </div>

			  <div class="checkbox">
				<label>
				  <input name="PickedUp" type="checkbox"  value=1 <?php echo isset($data['PickedUp']) && $data['PickedUp'] ? " checked" : "";?>> Picked Up
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
    $containers = select_containers_from_order($OrderID);

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
					<th>Quantity</th>
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
                    <td class="text-center"><a href="<?php echo "viewcontainer.php?ContainerID=".$row['ContainerID']; ?>"><span class="glyphicon glyphicon-search"></span></a></td>
					<td><?php echo_data($row, 'Quantity'); ?></td>
                    <td><?php echo_data($row, 'Shape'); ?></td>
                    <td><?php echo_data($row, 'Color'); ?></td>
                    <td><?php echo_data($row, 'Weight'); ?></td>
                    <td><?php echo_data($row, 'Desc'); ?></td>
					<td class="text-center"><a href="<?php echo "editcontainer.php?ContainerID=".$row['ContainerID']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
					<td class="text-center"><a href="<?php echo "deletecontainer.php?redirect=editorder.php&ContainerID=".$row['ContainerID']."&OrderID=".$OrderID.(isset($_REQUEST['admin']) ? "&admin" : ""); ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
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
		<p class="text-center"><a class="btn btn-info" href="editcontainer.php?OrderID=<?php echo $OrderID; ?>">Add Container</a></p>
		</div>
	</div>
<?php //End Success
?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Order Actions</h3>
			</div>
			<div class="panel-body text-center">
			<?php if(($data['DateOrdered']=="0000-00-00")): ?>
				<p class="btn-group"><a class="btn btn-danger" href="deleteorder.php?OrderID=<?php echo $OrderID; ?>">Delete Order</a><a class="btn btn-success" href="submitorder.php?OrderID=<?php echo $OrderID; ?>">Submit Order</a></p>
			<?php else: ?>
				<p><a class="btn btn-danger" href="deleteorder.php?OrderID=<?php echo $OrderID; ?>">Cancel Order</a></p>
			<?php endif; ?>
			</div>
		</div>
<?php
else: ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Error</h3>
		</div>
		<div class="panel-body">
			<p>We are missing some information necessary to display this page. This page requires the OrderID before it can be displayed</p>
		</div>
	</div>
<?php
endif;
	include("templates/footer.php");
?>
