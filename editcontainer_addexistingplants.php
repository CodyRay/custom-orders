<?php
////get
//Receive a list of all plants not already in the container from the database
//Render a List of Plants
//List is a Form, checkboxes next to each plant
////post
//For each plant in the form
//Add relationship
//redirect to editcontainer
?>
<?php
	$page_title = "Container";
	$page_subtitle = "Add Plants";

    //Is the user submiting the form?
    $post = $_SERVER['REQUEST_METHOD'] == "POST"; //Bool

    function validate_submit() {
		global $post;
        $valid = False;
        //If the method is POST
        if($post) {
            $valid = True; 
        }
        return $valid;
    }
	
	if(isset($_REQUEST['ContainerID']) && !empty($_REQUEST['ContainerID'])) {
        $ContainerID = $_REQUEST['ContainerID']; 
    }
    else {
        $ContainerID = NULL;
    }
    
	function echo_data($data, $item) {
        /*
        Echos existing data, makes sure that it exists
        */ 
        if(isset($data[$item])) {
            echo $data[$item];
        }
    }
    
    function add_plant($plant, $ContainerID) {
		//echo "$plant, $ContainerID <br>	"; //FIX ME
        /*
        Inserts or Updates the database with the current data
        Child Functions could render error messages (Unlikely)
		*/
    }

//////////////////////////////////
//Template Zone, try to keep functionality out of here when possible. Limiting to simple loops and if statements
//////////////////////////////////
if($ContainerID != NULL):
	$plants = array(array("CommonName" => "Petunia", "PlantID" => 3, "Color" => "Gold"), array("CommonName" => "Petunia", "PlantID" => 2, "Color" => "Purple", "ScientificName" => "Platis Domesticus"));
    if(validate_submit()): //If Valid and Sumbited
        foreach($plants as $plant) {
			if(in_array($plant["PlantID"], $_REQUEST)) {
				add_plant($plant["PlantID"], $ContainerID);
			}
		}
		//Instead of displaying a success message we will just redirect them back to the container page
		header("Location: editcontainer.php?ContainerID=".$ContainerID);
		exit(0);
    else:
	include("templates/header.php"); //It is ok to move this down here because there is no form validation to worry about

//Form only rendered if validate ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Available Plants</h3>
    </div>
    <div class="panel-body">
        <form method="POST">
		  <table class="table table-bordered table-hover">
		    <thead>
				<tr>
					<th class="text-center"	>Add</th>
					<th>Plant Name</th>
					<th>Color</th>
				</tr>
			</thead>
			<tbody>
<?php foreach($plants as $plant): ?>
				<tr>
					<td class="text-center" style="width: 50px;"><?php //Checkbox ?>
					  	    <input name="<?php echo $plant["PlantID"]; ?>" type="checkbox" value='<?php echo $plant["PlantID"]; ?>'>
					</td>
					<td><?php echo $plant["CommonName"].(empty($plant["ScientificName"]) ? "" : " (".$plant['ScientificName'].")"); ?></td>
					<td><?php echo $plant["Color"]; ?></td>
				</tr>
<?php endforeach; ?>
			</tbody>
		  </table>
          <input name="ContainerID" type="hidden" value="<?php echo_data($_REQUEST, "ContainerID");?>">

          <button type="submit" class="btn btn-default">Add Selected Plants</button>

        </form>
    </div>
</div>

<?php //End Success
	include("templates/footer.php");
	endif;
else:
?>

<?php


endif;
?>
