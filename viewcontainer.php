<?php
	$page_title = "Container";
	$page_subtitle = "View";
	include("templates/header.php"); 
    include("inc/database.php"); 
    function echo_data($data, $item) {
        /*
        Echos existing data, makes sure that it exists
        */ 
        if(isset($data[$item])) {
            echo $data[$item];
        }
    }
    if(isset($_REQUEST['containerid']) && !empty($_REQUEST['containerid'])) {
        $containerid = $_REQUEST['containerid']; 
    }
    else {
        $containerid = NULL;
    }
    if($containerid):
?>
<?php 
    $container = array("ContainerID" => 1, "Shape" => "12inch", "Color" => "Red", "Desc" => "Much Wow", "Weight" => "12lbs"); //FIX ME
    //$container = getcontainer($containerid);
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
            <p class="text-center"><a class="btn btn-info" href="editcontainer.php?containerid=<?php echo $containerid; ?>">Edit Container</a></p>
		</div>
    </div>
<?php 
    $data = array(array("PlantID" => 1, "Name" => "Black Hole", "ScientificName" => "Plantis Domesticus", "Color" => "Black")); //FIX ME
    //$data = selectplantsfromcontainer($containerid);
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
                    <th></th>
                    <th>Name</th>
                    <th>Scientific Name</th>
                    <th>Color</th>
                </tr>
            </thead>
            <tbody>
<?php 
        foreach($data as $row):
            $rowlink = "editplant.php?plantid=".$row['PlantID'];
?>
                <tr data-href="<?php echo $rowlink; ?>">
                    <td class="text-center"><a href="<?php echo $rowlink; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                    <td><?php echo_data($row, 'Name'); ?></td>
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
			<p>We are missing some information nessasary to display this page. This page requires the containerid before it can be displayed</p>
		</div>
	</div>

<?php
    endif;
?>
<?php 
	include("templates/footer.php");
?>
