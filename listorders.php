<?php
	$page_title = "Orders";
	$page_subtitle = "List";
    include("templates/header.php");
	include("inc/sql_queries.php");
    function echo_data($data, $item) {
        /*
        Echos existing data, makes sure that it exists
        */ 
        if(isset($data[$item])) {
            echo $data[$item];
        }
    }
?>
<?php 
    $data = select_all_orders();
	$submitted = array();
	$notsubmitted = array();
	$needquote = array();
	foreach($data as $item) {
		if($item['DateOrdered']=="0000-00-00") {
			$notsubmitted[] = $item;
		}
		else {
			$submitted[] = $item;
		}
		if($item['QuotedPrice']=="0" && !$item["Complete"]) {
			$needquote[] = $item;
		}
	}
?>
<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Submitted Orders</h3>
		</div>
        <div class="panel-body">
<?php
    if(count($submitted)):
?>	
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Date Ordered</th>
                    <th>Quoted Price</th>
                    <th>Total Paid</th>
                    <th>Completed</th>
                    <th>Picked Up</th>
                    <th>Customer Name</th>
                </tr>
            </thead>
            <tbody>
<?php 
        foreach($submitted as $row):
            $rowlink = "editorder.php?admin&OrderID=".$row['OrderID'];
?>
                <tr data-href="<?php echo $rowlink; ?>">
                    <td class="text-center"><a href="<?php echo $rowlink; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                    <td><?php echo_data($row, 'DateOrdered'); ?></td>
                    <td><?php echo_data($row, 'QuotedPrice'); ?></td>
                    <td><?php echo_data($row, 'TotalPaid'); ?></td>
					<td class="text-center"><span class="glyphicon <?php echo $row['Complete'] ? "glyphicon-ok" : "glyphicon-remove"; ?>"></span></td>
                    <td class="text-center"><span class="glyphicon <?php echo $row['PickedUp'] ? "glyphicon-ok" : "glyphicon-remove"; ?>"></span></td>
                    <td><?php echo_data($row, 'Name'); ?></td>
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
        <p>There are no Submitted Orders Yet</p>
<?php
    endif;
?>
		</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Orders Not Submitted</h3>
		</div>
        <div class="panel-body">
<?php
    if(count($notsubmitted)):
?>	
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Date Ordered</th>
                    <th>Quoted Price</th>
                    <th>Total Paid</th>
                    <th>Completed</th>
                    <th>Picked Up</th>
                    <th>Customer Name</th>
                </tr>
            </thead>
            <tbody>
<?php 
        foreach($notsubmitted as $row):
            $rowlink = "editorder.php?admin&OrderID=".$row['OrderID'];
?>
                <tr data-href="<?php echo $rowlink; ?>">
                    <td class="text-center"><a href="<?php echo $rowlink; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                    <td><?php echo_data($row, 'DateOrdered'); ?></td>
                    <td><?php echo_data($row, 'QuotedPrice'); ?></td>
                    <td><?php echo_data($row, 'TotalPaid'); ?></td>
					<td class="text-center"><span class="glyphicon <?php echo $row['Complete'] ? "glyphicon-ok" : "glyphicon-remove"; ?>"></span></td>
                    <td class="text-center"><span class="glyphicon <?php echo $row['PickedUp'] ? "glyphicon-ok" : "glyphicon-remove"; ?>"></span></td>
                    <td><?php echo_data($row, 'Name'); ?></td>
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
        <p>There are no orders that haven't been submitted</p>
<?php
    endif;
?>
		</div>
	</div>
</div>
<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Orders Needing Quoted Price</h3>
		</div>
        <div class="panel-body">
<?php
    if(count($needquote)):
?>	
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Date Ordered</th>
                    <th>Quoted Price</th>
                    <th>Total Paid</th>
                    <th>Completed</th>
                    <th>Picked Up</th>
                    <th>Customer Name</th>
                </tr>
            </thead>
            <tbody>
<?php 
        foreach($needquote as $row):
            $rowlink = "editorder.php?admin&OrderID=".$row['OrderID'];
?>
                <tr data-href="<?php echo $rowlink; ?>">
                    <td class="text-center"><a href="<?php echo $rowlink; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                    <td><?php echo_data($row, 'DateOrdered'); ?></td>
                    <td><?php echo_data($row, 'QuotedPrice'); ?></td>
                    <td><?php echo_data($row, 'TotalPaid'); ?></td>
					<td class="text-center"><span class="glyphicon <?php echo $row['Complete'] ? "glyphicon-ok" : "glyphicon-remove"; ?>"></span></td>
                    <td class="text-center"><span class="glyphicon <?php echo $row['PickedUp'] ? "glyphicon-ok" : "glyphicon-remove"; ?>"></span></td>
                    <td><?php echo_data($row, 'Name'); ?></td>
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
        <p>All Orders have Quoted Prices</p>
<?php
    endif;
?>
		</div>
	</div>
</div>
<?php 
	include("templates/footer.php");
?>
