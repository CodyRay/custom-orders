<?php
	$page_title = "Customer";
	$page_subtitle = "List";
    //include("inc/database.php"); 
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
    $data = array(array("CustomerID" => 1, "name" => "Cody Hoeft", "address" => "654 Washington Ave", "phone" => "541-867-5309", "email" => "hoeftc@onid.oregonstate.edu")); //FIX ME
    //$data = selecttable('customer');
?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Customer List</h3>
		</div>
        <div class="panel-body">
<?php
    if(count($data)):
?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
<?php 
        foreach($data as $row):
            $rowlink = "viewcustomer.php?customerid=".$row['CustomerID'];
?>
                <tr data-href="<?php echo $rowlink; ?>">
                    <td class="text-center"><a href="<?php echo $rowlink; ?>"><span class="glyphicon glyphicon-search"></span></a></td>
                    <td><?php echo_data($row, 'name'); ?></td>
                    <td><?php echo_data($row, 'address'); ?></td>
                    <td><?php echo_data($row, 'phone'); ?></td>
                    <td><?php echo_data($row, 'email'); ?></td>
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
