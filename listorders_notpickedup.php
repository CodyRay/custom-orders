<?php
	$page_title = "Orders";
	$page_subtitle = "Completed, but Not Picked Up";
    include("templates/header.php");
	include("inc/sql_queries.php");
    function echo_data($data, $item) {
        /*
        Echos existing data, makes sure that it exists
        */ 
        if(isset($data[$item]) && !empty($data[$item])) {
            echo $data[$item];
        }
    }
?>
<div class="col-lg-12">
<?php 
    $data = select_all_orders_notpickedup();
?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Data</h3>
		</div>
        <div class="panel-body">
<?php
    if(count($data)):
?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
					<th></th>
                    <th></th>
                    <th>Quoted Price</th>
					<th>Total Paid</th>
					<th></th>
					<th>Customer Name</th>
                </tr>
            </thead>
            <tbody>
<?php 
        foreach($data as $row):
            $rowlink = "vieworder.php?OrderID=".$row['OrderID'];
?>
                <tr data-href="<?php echo $rowlink; ?>">
					<td class="text-center" style="width: 50px;"><?php //Checkbox ?>
					  	    <input name="<?php echo $plant["PlantID"]; ?>" type="checkbox" value='<?php echo $plant["PlantID"]; ?>'>
					</td>
                    <td class="text-center"><a href="<?php echo $rowlink; ?>"><span class="glyphicon glyphicon-search"></span></a></td>
                    <td><?php echo_data($row, 'QuotedPrice'); ?></td>
                    <td><?php echo_data($row, 'TotalPaid'); ?></td>
                    <<td class="text-center"><a href="<?php echo $rowlink; ?>"><span class="glyphicon glyphicon-search"></span></a></td>
                    <td><?php echo_data($row, 'CustomerName'); ?></td>
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
	include("templates/footer.php");
?>
