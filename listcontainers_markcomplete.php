<?php
	$page_title = "Containers";
	$page_subtitle = "Incomplete";
    include("templates/header.php");
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
    $data = array(); //FIX ME
    //$data = selecttable('customer');
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
					<th>Actual Price</th>
					<th>Balance Due</th>
					<th></th>
					<th>Customer Name</th>
					<th>Picked Up</th>
                </tr>
            </thead>
            <tbody>
<?php 
        foreach($data as $row):
            $rowlink = "viewcontainer.php?ContainerID=".$row['ContainerID'];
?>
                <tr data-href="<?php echo $rowlink; ?>">
					<td class="text-center" style="width: 50px;"><?php //Checkbox ?>
					  	    <input name="<?php echo $plant["PlantID"]; ?>" type="checkbox" value='<?php echo $plant["PlantID"]; ?>'>
					</td>
                    <td class="text-center"><a href="<?php echo $rowlink; ?>"><span class="glyphicon glyphicon-search"></span></a></td>
                    <td><?php echo_data($row, 'QuotedPrice'); ?></td>
                    <td><?php echo_data($row, 'ActualPrice'); ?></td>
                    <td><?php echo_data($row, 'BalanceDue'); ?></td>
                    <<td class="text-center"><a href="<?php echo $rowlink; ?>"><span class="glyphicon glyphicon-search"></span></a></td>
                    <td><?php echo_data($row, 'CustomerName'); ?></td>
                    <td><?php echo_data($row, 'PickedUp'); ?></td>
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
