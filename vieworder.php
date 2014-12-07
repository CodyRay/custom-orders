<?php
	include("inc/sql_queries.php");
	
	$page_title = "Order";
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
    if(isset($_REQUEST['OrderID']) && !empty($_REQUEST['OrderID'])) {
        $OrderID = $_REQUEST['OrderID']; 
    }
    else {
        $OrderID = NULL;
    }
    if($OrderID):
?>
<?php 
    $order = array("OrderID" => 10, "DateOrdered" => "2014-01-01", "QuotedPrice" => 100.00, "Paid" => 0.00, "CustomerID" => 1, "Complete" => True, "PickUp" => False, "CustomerName" => "Cody Ray Hoeft"); //FIX ME
    //$order = getorder($OrderID);
    $customerlink = "viewcustomer.php?customerid=".$order['CustomerID'];
?>
<div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Order Info</h3>
		</div>
        <div class="panel-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th colspan="2">Attribute</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">Date Ordered</td>
                        <td><?php echo_data($order, 'DateOrdered'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Quoted Price</td>
                        <td><?php echo_data($order, 'QuotedPrice'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Price Paid</td>
                        <td><?php echo_data($order, 'Paid'); ?></td>
                    </tr>
                    <tr data-href="<?php echo $customerlink; ?>">
                        <td>Customer Name</td>
                        <td class="text-center"><a href="<?php echo $customerlink; ?>"><span class="glyphicon glyphicon-search"></span></a></td>
                        <td><?php echo_data($order, 'CustomerName'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Complete?</td>
                        <td><span class="glyphicon <?php echo $row['Complete'] ? "glyphicon-ok": "glyphicon-remove"; ?>"></span></td>
                    </tr>
                    <tr>
                        <td colspan="2">Picked Up?</td>
                        <td><span class="glyphicon <?php echo $row['PickUp'] ? "glyphicon-ok": "glyphicon-remove"; ?>"></span></td>
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
            <p class="text-center"><a class="btn btn-info" href="editorder.php?OrderID=<?php echo $OrderID; ?>">Edit Order</a></p>
		</div>
    </div>
<?php 
    $data = array(array("ContainerID" => 1, "Shape" => "12inch", "Color" => "Red", "Desc" => "Much Wow", "Weight" => "12lbs")); //FIX ME
    //$data = selectcontainersfromorder($OrderID);
?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Container List</h3>
		</div>
        <div class="panel-body">
<?php
    if(count($data)):
?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Shape</th>
                    <th>Color</th>
                    <th>Weight</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
<?php 
        foreach($data as $row):
            $rowlink = "viewcontainer.php?containerid=".$row['ContainerID'];
?>
                <tr data-href="<?php echo $rowlink; ?>">
                    <td class="text-center"><a href="<?php echo $rowlink; ?>"><span class="glyphicon glyphicon-search"></span></a></td>
                    <td><?php echo_data($row, 'Shape'); ?></td>
                    <td><?php echo_data($row, 'Color'); ?></td>
                    <td><?php echo_data($row, 'Weight'); ?></td>
                    <td><?php echo_data($row, 'Desc'); ?></td>
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
			<p>We are missing some information nessasary to display this page. This page requires the OrderID before it can be displayed</p>
		</div>
	</div>

<?php
    endif;
?>
<?php 
	include("templates/footer.php");
?>
