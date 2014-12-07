<?php
	include("inc/sql_queries.php");

	$page_title = "Container";
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
    if(isset($_REQUEST['ContainerID']) && !empty($_REQUEST['ContainerID'])) {
        $ContainerID = $_REQUEST['ContainerID']; 
    }
    else {
        $ContainerID = NULL;
    }
    if($ContainerID):
?>
<?php 
    $container = get_container($ContainerID);
?>
<div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Container Info</h3>
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
                        <td>Shape</td>
                        <td><?php echo_data($container, 'Shape'); ?></td>
                    </tr>
                    <tr>
                        <td>Color</td>
                        <td><?php echo_data($container, 'Color'); ?></td>
                    </tr>
                    <tr>
                        <td>Weight</td>
                        <td><?php echo_data($container, 'Weight'); ?></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><?php echo_data($container, 'Desc'); ?></td>
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
            <p class="text-center"><a class="btn btn-info" href="editcontainer.php?ContainerID=<?php echo $ContainerID; ?>">Edit Container</a></p>
		</div>
    </div>
<?php 
    $data = select_plants_from_container($ContainerID);
?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Plant List</h3>
		</div>
        <div class="panel-body">
<?php
    if(count($data)):
?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Scientific Name</th>
                    <th>Color</th>
                </tr>
            </thead>
            <tbody>
<?php 
        foreach($data as $row):
            $rowlink = "editplant.php?PlantID=".$row['PlantID'];
?>
                <tr data-href="<?php echo $rowlink; ?>">
                    <td><?php echo_data($row, 'CommonName'); ?></td>
                    <td><?php echo_data($row, 'ScientificName'); ?></td>
                    <td><?php echo_data($row, 'Color'); ?></td>
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
			<p>We are missing some information nessasary to display this page. This page requires the ContainerID before it can be displayed</p>
		</div>
	</div>

<?php
    endif;
?>
<?php 
	include("templates/footer.php");
?>
