<?php
	$page_title = "Needed Plants";
	$page_subtitle = "List";
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
    $data = select_all_needed_plants();
?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Needed Plants</h3>
		</div>
        <div class="panel-body">
<?php
    if(count($data)):
?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
<?php 
        foreach($data as $row):
?>
                <tr>
					<td><?php echo $row["CommonName"].(empty($row["ScientificName"]) ? "" : " (".$row['ScientificName'].")"); ?></td>
					<td><?php echo $row["Color"]; ?></td>
					<td><?php echo $row["Quantity"]; ?></td>
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
