<?php
	include("inc/sql_queries.php");

	$page_title = "Customer";
	$page_subtitle = "View";
	include("templates/header.php"); 
    function echo_data($data, $item) {
        /*
        Echos existing data, makes sure that it exists
        */ 
        if(isset($data[$item])) {
            echo $data[$item];
        }
    }
    if(isset($_REQUEST['CustomerID']) && !empty($_REQUEST['CustomerID'])) {
        $CustomerID = $_REQUEST['CustomerID']; 
    }
    else {
        $CustomerID = NULL;
    }
    if($CustomerID):
?>
<?php 
    $customer = get_customer($CustomerID);
?>
<div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Customer Info</h3>
		</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Attribute</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Name</td>
                        <td><?php echo_data($customer, 'Name'); ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo_data($customer, 'Address'); ?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td><?php echo_data($customer, 'Phone'); ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo_data($customer, 'Email'); ?></td>
                    </tr>
                <tbody>
                <!--
                <tfoot>
                    <tr>
                        <th></th>
                    </tr>
                </tfoot>
                -->
            </table>
            <p class="text-center"><a class="btn btn-info" href="editcustomer.php?CustomerID=<?php echo $CustomerID; ?>">Edit Customer</a></p>
		</div>
    </div>
<?php
	$data = select_orders_from_customer($CustomerID);
?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Order List</h3>
		</div>
        <div class="panel-body">
<?php
    if(count($data)):
?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Date Ordered</th>
                    <th>Price Quoted</th>
                    <th>Price Paid</th>
                    <th>Complete</th>
                    <th>Picked Up</th>
                </tr>
            </thead>
            <tbody>
<?php 
        foreach($data as $row):
            $rowlink = "vieworder.php?OrderID=".$row['OrderID'];
?>
                <tr data-href="<?php echo $rowlink; ?>">
                    <td class="text-center"><a href="<?php echo $rowlink; ?>"><span class="glyphicon glyphicon-search"></span></a></td>
                    <td><?php echo_data($row, 'DateOrdered'); ?></td>
                    <td><?php echo_data($row, 'QuotedPrice'); ?></td>
                    <td><?php echo_data($row, 'TotalPaid'); ?></td>
                    <td class="text-center"><span class="glyphicon <?php echo $row['Complete'] ? "glyphicon-ok": "glyphicon-remove"; ?>"></span></td>
                    <td class="text-center"><span class="glyphicon <?php echo $row['PickedUp'] ? "glyphicon-ok": "glyphicon-remove"; ?>"></span></td>
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
		<p class="text-center"><a class="btn btn-success" href="editorder.php?CustomerID=<?php echo $CustomerID; ?>">Create New Order</a></p>

		</div>
	</div>
</div>
<?php 
    else: 
?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Error</h3>
		</div>
		<div class="panel-body">
			<p>We are missing some information necessary to display this page. This page requires the CustomerID before it can be displayed</p>
		</div>
	</div>

<?php
    endif;
?>
<?php 
	include("templates/footer.php");
?>
