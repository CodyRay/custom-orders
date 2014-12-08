<?php
	include("inc/sql_queries.php");
	
	$page_title = "Container";

    //Is the user submiting the form?
    $post = $_SERVER['REQUEST_METHOD'] == "POST"; //Bool

    //Is the entry going to be new or updating?
    $new = !(isset($_REQUEST['ContainerID']) && !empty($_REQUEST['ContainerID'])); //Bool
	$page_subtitle = $new ? "Create" : "Edit";

	if(isset($_REQUEST['ContainerID']) && !empty($_REQUEST['ContainerID'])) {
        $ContainerID = $_REQUEST['ContainerID']; 
    }
    else {
        $ContainerID = NULL;
    }
	
	if(isset($_REQUEST['OrderID']) && !empty($_REQUEST['OrderID'])) {
        $OrderID = $_REQUEST['OrderID']; 
    }
    else {
        $OrderID = NULL;
    }
	
    //We need to handle the case that we are updating the data
    if(!$new && !$post) { //If we use post it could overwrite data
        //Use this line to get data from the database when you are updating the object
        $query = get_container($ContainerID);
        $data = $_REQUEST + $query;
    }
    else {
        $data = $_REQUEST;
    }


    function validate_submit() {
        /*
        This function returns true only if the form has been SUBMITTED with VALID data
        If it has been SUBMITTED but INVALID errors will be rendered and false will be returned
        */
        global $post;
        global $data;
        $form_errors = array();
        $valid = False;
        //If the method is POST
        if($post) {
            //Validation Rules Here
            if(empty($data['Quantity']))
                $form_errors[] = "Required Item: Quantity is Blank";
            if(empty($data['Desc']))
                $form_errors[] = "Please Describe the Container";
            //End Validation Rules
            if(!count($form_errors)) {
                $valid = True; 
            }
            else {
                render_errors($form_errors, "Please Fix the Following Items:");
            }
        }
        return $valid;
    }
    
    
	function echo_data($data, $item) {
        /*
        Echos existing data, makes sure that it exists
        */ 
        if(isset($data[$item])) {
            echo $data[$item];
        }
    }

    
    function update_database() {
		global $data;
		global $ContainerID;
		global $new;
        /*
        Inserts or Updates the database with the current data
        Child Functions could render error messages (Unlikely)
        */
        if($new) {
            //Insert Function Call Here takes $data
			$ContainerID = create_container($data);
        }
        else {
            //Update Function Call Here takes $data
			update_container($data);
        }
    }

//////////////////////////////////
//Template Zone, try to keep functionality out of here when possible. Limiting to simple loops and if statements
//////////////////////////////////

	include("templates/header.php");
if( ( $new && $OrderID != NULL ) || ( !$new && $ContainerID != NULL ) ):
    if(validate_submit()): //If Valid and Submited, Render Success Message; else form...
        update_database();


//Success Message ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo "Successfully " . ($new ? "Created" : "Updated") . "!" ; ?></h3>
    </div>
    <div class="panel-body">
        <p>The Container Has been Successfully Updated</p>
        <a href='editcontainer.php?ContainerID=<?php echo $ContainerID; //FIX ME ?>' class="btn btn-default">Continue</a>
    </div>
</div>
<?php //End Success


    else:


//Form only rendered if validate ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Container</h3>
    </div>
    <div class="panel-body">
        <form method="POST">

          <input name="ContainerID" type="hidden" value="<?php echo_data($data,"ContainerID");?>">
		  <input name="OrderID" type="hidden" value="<?php echo_data($data,"OrderID");?>">
		  
          <div class="form-group">
            <label for="Shape">Container Shape</label>
            <input name="Shape" type="text" class="form-control" placeholder="Basket, Patio Pot, etc." value="<?php echo_data($data,"Shape");?>">
          </div>
		  
		  <div class="form-group">
            <label for="Color">Container Color</label>
		    <select name="Color" class="form-control">
<option value=""></option>
<option style='background-color: #F0F8FF; color: black' value='AliceBlue'<?php echo isset($data['Color']) && $data['Color'] == 'AliceBlue' ? ' selected' : '';?>>AliceBlue</option>
<option style='background-color: #FAEBD7; color: black' value='AntiqueWhite'<?php echo isset($data['Color']) && $data['Color'] == 'AntiqueWhite' ? ' selected' : '';?>>AntiqueWhite</option>
<option style='background-color: #00FFFF; color: black' value='Aqua'<?php echo isset($data['Color']) && $data['Color'] == 'Aqua' ? ' selected' : '';?>>Aqua</option>
<option style='background-color: #7FFFD4; color: black' value='Aquamarine'<?php echo isset($data['Color']) && $data['Color'] == 'Aquamarine' ? ' selected' : '';?>>Aquamarine</option>
<option style='background-color: #F0FFFF; color: black' value='Azure'<?php echo isset($data['Color']) && $data['Color'] == 'Azure' ? ' selected' : '';?>>Azure</option>
<option style='background-color: #F5F5DC; color: black' value='Beige'<?php echo isset($data['Color']) && $data['Color'] == 'Beige' ? ' selected' : '';?>>Beige</option>
<option style='background-color: #FFE4C4; color: black' value='Bisque'<?php echo isset($data['Color']) && $data['Color'] == 'Bisque' ? ' selected' : '';?>>Bisque</option>
<option style='background-color: #000000; color: white' value='Black'<?php echo isset($data['Color']) && $data['Color'] == 'Black' ? ' selected' : '';?>>Black</option>
<option style='background-color: #FFEBCD; color: black' value='BlanchedAlmond'<?php echo isset($data['Color']) && $data['Color'] == 'BlanchedAlmond' ? ' selected' : '';?>>BlanchedAlmond</option>
<option style='background-color: #0000FF; color: white' value='Blue'<?php echo isset($data['Color']) && $data['Color'] == 'Blue' ? ' selected' : '';?>>Blue</option>
<option style='background-color: #8A2BE2; color: white' value='BlueViolet'<?php echo isset($data['Color']) && $data['Color'] == 'BlueViolet' ? ' selected' : '';?>>BlueViolet</option>
<option style='background-color: #A52A2A; color: white' value='Brown'<?php echo isset($data['Color']) && $data['Color'] == 'Brown' ? ' selected' : '';?>>Brown</option>
<option style='background-color: #DEB887; color: black' value='BurlyWood'<?php echo isset($data['Color']) && $data['Color'] == 'BurlyWood' ? ' selected' : '';?>>BurlyWood</option>
<option style='background-color: #5F9EA0; color: black' value='CadetBlue'<?php echo isset($data['Color']) && $data['Color'] == 'CadetBlue' ? ' selected' : '';?>>CadetBlue</option>
<option style='background-color: #7FFF00; color: black' value='Chartreuse'<?php echo isset($data['Color']) && $data['Color'] == 'Chartreuse' ? ' selected' : '';?>>Chartreuse</option>
<option style='background-color: #D2691E; color: black' value='Chocolate'<?php echo isset($data['Color']) && $data['Color'] == 'Chocolate' ? ' selected' : '';?>>Chocolate</option>
<option style='background-color: #FF7F50; color: black' value='Coral'<?php echo isset($data['Color']) && $data['Color'] == 'Coral' ? ' selected' : '';?>>Coral</option>
<option style='background-color: #6495ED; color: black' value='CornflowerBlue'<?php echo isset($data['Color']) && $data['Color'] == 'CornflowerBlue' ? ' selected' : '';?>>CornflowerBlue</option>
<option style='background-color: #FFF8DC; color: black' value='Cornsilk'<?php echo isset($data['Color']) && $data['Color'] == 'Cornsilk' ? ' selected' : '';?>>Cornsilk</option>
<option style='background-color: #DC143C; color: white' value='Crimson'<?php echo isset($data['Color']) && $data['Color'] == 'Crimson' ? ' selected' : '';?>>Crimson</option>
<option style='background-color: #00FFFF; color: black' value='Cyan'<?php echo isset($data['Color']) && $data['Color'] == 'Cyan' ? ' selected' : '';?>>Cyan</option>
<option style='background-color: #00008B; color: white' value='DarkBlue'<?php echo isset($data['Color']) && $data['Color'] == 'DarkBlue' ? ' selected' : '';?>>DarkBlue</option>
<option style='background-color: #008B8B; color: white' value='DarkCyan'<?php echo isset($data['Color']) && $data['Color'] == 'DarkCyan' ? ' selected' : '';?>>DarkCyan</option>
<option style='background-color: #B8860B; color: black' value='DarkGoldenRod'<?php echo isset($data['Color']) && $data['Color'] == 'DarkGoldenRod' ? ' selected' : '';?>>DarkGoldenRod</option>
<option style='background-color: #A9A9A9; color: black' value='DarkGray'<?php echo isset($data['Color']) && $data['Color'] == 'DarkGray' ? ' selected' : '';?>>DarkGray</option>
<option style='background-color: #006400; color: white' value='DarkGreen'<?php echo isset($data['Color']) && $data['Color'] == 'DarkGreen' ? ' selected' : '';?>>DarkGreen</option>
<option style='background-color: #BDB76B; color: black' value='DarkKhaki'<?php echo isset($data['Color']) && $data['Color'] == 'DarkKhaki' ? ' selected' : '';?>>DarkKhaki</option>
<option style='background-color: #8B008B; color: white' value='DarkMagenta'<?php echo isset($data['Color']) && $data['Color'] == 'DarkMagenta' ? ' selected' : '';?>>DarkMagenta</option>
<option style='background-color: #556B2F; color: white' value='DarkOliveGreen'<?php echo isset($data['Color']) && $data['Color'] == 'DarkOliveGreen' ? ' selected' : '';?>>DarkOliveGreen</option>
<option style='background-color: #FF8C00; color: black' value='DarkOrange'<?php echo isset($data['Color']) && $data['Color'] == 'DarkOrange' ? ' selected' : '';?>>DarkOrange</option>
<option style='background-color: #9932CC; color: white' value='DarkOrchid'<?php echo isset($data['Color']) && $data['Color'] == 'DarkOrchid' ? ' selected' : '';?>>DarkOrchid</option>
<option style='background-color: #8B0000; color: white' value='DarkRed'<?php echo isset($data['Color']) && $data['Color'] == 'DarkRed' ? ' selected' : '';?>>DarkRed</option>
<option style='background-color: #E9967A; color: black' value='DarkSalmon'<?php echo isset($data['Color']) && $data['Color'] == 'DarkSalmon' ? ' selected' : '';?>>DarkSalmon</option>
<option style='background-color: #8FBC8F; color: black' value='DarkSeaGreen'<?php echo isset($data['Color']) && $data['Color'] == 'DarkSeaGreen' ? ' selected' : '';?>>DarkSeaGreen</option>
<option style='background-color: #483D8B; color: white' value='DarkSlateBlue'<?php echo isset($data['Color']) && $data['Color'] == 'DarkSlateBlue' ? ' selected' : '';?>>DarkSlateBlue</option>
<option style='background-color: #2F4F4F; color: white' value='DarkSlateGray'<?php echo isset($data['Color']) && $data['Color'] == 'DarkSlateGray' ? ' selected' : '';?>>DarkSlateGray</option>
<option style='background-color: #00CED1; color: black' value='DarkTurquoise'<?php echo isset($data['Color']) && $data['Color'] == 'DarkTurquoise' ? ' selected' : '';?>>DarkTurquoise</option>
<option style='background-color: #9400D3; color: white' value='DarkViolet'<?php echo isset($data['Color']) && $data['Color'] == 'DarkViolet' ? ' selected' : '';?>>DarkViolet</option>
<option style='background-color: #FF1493; color: white' value='DeepPink'<?php echo isset($data['Color']) && $data['Color'] == 'DeepPink' ? ' selected' : '';?>>DeepPink</option>
<option style='background-color: #00BFFF; color: black' value='DeepSkyBlue'<?php echo isset($data['Color']) && $data['Color'] == 'DeepSkyBlue' ? ' selected' : '';?>>DeepSkyBlue</option>
<option style='background-color: #696969; color: white' value='DimGray'<?php echo isset($data['Color']) && $data['Color'] == 'DimGray' ? ' selected' : '';?>>DimGray</option>
<option style='background-color: #1E90FF; color: white' value='DodgerBlue'<?php echo isset($data['Color']) && $data['Color'] == 'DodgerBlue' ? ' selected' : '';?>>DodgerBlue</option>
<option style='background-color: #B22222; color: white' value='FireBrick'<?php echo isset($data['Color']) && $data['Color'] == 'FireBrick' ? ' selected' : '';?>>FireBrick</option>
<option style='background-color: #FFFAF0; color: black' value='FloralWhite'<?php echo isset($data['Color']) && $data['Color'] == 'FloralWhite' ? ' selected' : '';?>>FloralWhite</option>
<option style='background-color: #228B22; color: white' value='ForestGreen'<?php echo isset($data['Color']) && $data['Color'] == 'ForestGreen' ? ' selected' : '';?>>ForestGreen</option>
<option style='background-color: #FF00FF; color: white' value='Fuchsia'<?php echo isset($data['Color']) && $data['Color'] == 'Fuchsia' ? ' selected' : '';?>>Fuchsia</option>
<option style='background-color: #DCDCDC; color: black' value='Gainsboro'<?php echo isset($data['Color']) && $data['Color'] == 'Gainsboro' ? ' selected' : '';?>>Gainsboro</option>
<option style='background-color: #F8F8FF; color: black' value='GhostWhite'<?php echo isset($data['Color']) && $data['Color'] == 'GhostWhite' ? ' selected' : '';?>>GhostWhite</option>
<option style='background-color: #FFD700; color: black' value='Gold'<?php echo isset($data['Color']) && $data['Color'] == 'Gold' ? ' selected' : '';?>>Gold</option>
<option style='background-color: #DAA520; color: black' value='GoldenRod'<?php echo isset($data['Color']) && $data['Color'] == 'GoldenRod' ? ' selected' : '';?>>GoldenRod</option>
<option style='background-color: #808080; color: black' value='Gray'<?php echo isset($data['Color']) && $data['Color'] == 'Gray' ? ' selected' : '';?>>Gray</option>
<option style='background-color: #008000; color: white' value='Green'<?php echo isset($data['Color']) && $data['Color'] == 'Green' ? ' selected' : '';?>>Green</option>
<option style='background-color: #ADFF2F; color: black' value='GreenYellow'<?php echo isset($data['Color']) && $data['Color'] == 'GreenYellow' ? ' selected' : '';?>>GreenYellow</option>
<option style='background-color: #F0FFF0; color: black' value='HoneyDew'<?php echo isset($data['Color']) && $data['Color'] == 'HoneyDew' ? ' selected' : '';?>>HoneyDew</option>
<option style='background-color: #FF69B4; color: black' value='HotPink'<?php echo isset($data['Color']) && $data['Color'] == 'HotPink' ? ' selected' : '';?>>HotPink</option>
<option style='background-color: #CD5C5C; color: white' value='IndianRed'<?php echo isset($data['Color']) && $data['Color'] == 'IndianRed' ? ' selected' : '';?>>IndianRed</option>
<option style='background-color: #4B0082; color: white' value='Indigo'<?php echo isset($data['Color']) && $data['Color'] == 'Indigo' ? ' selected' : '';?>>Indigo</option>
<option style='background-color: #FFFFF0; color: black' value='Ivory'<?php echo isset($data['Color']) && $data['Color'] == 'Ivory' ? ' selected' : '';?>>Ivory</option>
<option style='background-color: #F0E68C; color: black' value='Khaki'<?php echo isset($data['Color']) && $data['Color'] == 'Khaki' ? ' selected' : '';?>>Khaki</option>
<option style='background-color: #E6E6FA; color: black' value='Lavender'<?php echo isset($data['Color']) && $data['Color'] == 'Lavender' ? ' selected' : '';?>>Lavender</option>
<option style='background-color: #FFF0F5; color: black' value='LavenderBlush'<?php echo isset($data['Color']) && $data['Color'] == 'LavenderBlush' ? ' selected' : '';?>>LavenderBlush</option>
<option style='background-color: #7CFC00; color: black' value='LawnGreen'<?php echo isset($data['Color']) && $data['Color'] == 'LawnGreen' ? ' selected' : '';?>>LawnGreen</option>
<option style='background-color: #FFFACD; color: black' value='LemonChiffon'<?php echo isset($data['Color']) && $data['Color'] == 'LemonChiffon' ? ' selected' : '';?>>LemonChiffon</option>
<option style='background-color: #ADD8E6; color: black' value='LightBlue'<?php echo isset($data['Color']) && $data['Color'] == 'LightBlue' ? ' selected' : '';?>>LightBlue</option>
<option style='background-color: #F08080; color: black' value='LightCoral'<?php echo isset($data['Color']) && $data['Color'] == 'LightCoral' ? ' selected' : '';?>>LightCoral</option>
<option style='background-color: #E0FFFF; color: black' value='LightCyan'<?php echo isset($data['Color']) && $data['Color'] == 'LightCyan' ? ' selected' : '';?>>LightCyan</option>
<option style='background-color: #FAFAD2; color: black' value='LightGoldenRodYellow'<?php echo isset($data['Color']) && $data['Color'] == 'LightGoldenRodYellow' ? ' selected' : '';?>>LightGoldenRodYellow</option>
<option style='background-color: #D3D3D3; color: black' value='LightGray'<?php echo isset($data['Color']) && $data['Color'] == 'LightGray' ? ' selected' : '';?>>LightGray</option>
<option style='background-color: #90EE90; color: black' value='LightGreen'<?php echo isset($data['Color']) && $data['Color'] == 'LightGreen' ? ' selected' : '';?>>LightGreen</option>
<option style='background-color: #FFB6C1; color: black' value='LightPink'<?php echo isset($data['Color']) && $data['Color'] == 'LightPink' ? ' selected' : '';?>>LightPink</option>
<option style='background-color: #FFA07A; color: black' value='LightSalmon'<?php echo isset($data['Color']) && $data['Color'] == 'LightSalmon' ? ' selected' : '';?>>LightSalmon</option>
<option style='background-color: #20B2AA; color: black' value='LightSeaGreen'<?php echo isset($data['Color']) && $data['Color'] == 'LightSeaGreen' ? ' selected' : '';?>>LightSeaGreen</option>
<option style='background-color: #87CEFA; color: black' value='LightSkyBlue'<?php echo isset($data['Color']) && $data['Color'] == 'LightSkyBlue' ? ' selected' : '';?>>LightSkyBlue</option>
<option style='background-color: #778899; color: black' value='LightSlateGray'<?php echo isset($data['Color']) && $data['Color'] == 'LightSlateGray' ? ' selected' : '';?>>LightSlateGray</option>
<option style='background-color: #B0C4DE; color: black' value='LightSteelBlue'<?php echo isset($data['Color']) && $data['Color'] == 'LightSteelBlue' ? ' selected' : '';?>>LightSteelBlue</option>
<option style='background-color: #FFFFE0; color: black' value='LightYellow'<?php echo isset($data['Color']) && $data['Color'] == 'LightYellow' ? ' selected' : '';?>>LightYellow</option>
<option style='background-color: #00FF00; color: black' value='Lime'<?php echo isset($data['Color']) && $data['Color'] == 'Lime' ? ' selected' : '';?>>Lime</option>
<option style='background-color: #32CD32; color: black' value='LimeGreen'<?php echo isset($data['Color']) && $data['Color'] == 'LimeGreen' ? ' selected' : '';?>>LimeGreen</option>
<option style='background-color: #FAF0E6; color: black' value='Linen'<?php echo isset($data['Color']) && $data['Color'] == 'Linen' ? ' selected' : '';?>>Linen</option>
<option style='background-color: #FF00FF; color: white' value='Magenta'<?php echo isset($data['Color']) && $data['Color'] == 'Magenta' ? ' selected' : '';?>>Magenta</option>
<option style='background-color: #800000; color: white' value='Maroon'<?php echo isset($data['Color']) && $data['Color'] == 'Maroon' ? ' selected' : '';?>>Maroon</option>
<option style='background-color: #66CDAA; color: black' value='MediumAquaMarine'<?php echo isset($data['Color']) && $data['Color'] == 'MediumAquaMarine' ? ' selected' : '';?>>MediumAquaMarine</option>
<option style='background-color: #0000CD; color: white' value='MediumBlue'<?php echo isset($data['Color']) && $data['Color'] == 'MediumBlue' ? ' selected' : '';?>>MediumBlue</option>
<option style='background-color: #BA55D3; color: black' value='MediumOrchid'<?php echo isset($data['Color']) && $data['Color'] == 'MediumOrchid' ? ' selected' : '';?>>MediumOrchid</option>
<option style='background-color: #9370DB; color: black' value='MediumPurple'<?php echo isset($data['Color']) && $data['Color'] == 'MediumPurple' ? ' selected' : '';?>>MediumPurple</option>
<option style='background-color: #3CB371; color: black' value='MediumSeaGreen'<?php echo isset($data['Color']) && $data['Color'] == 'MediumSeaGreen' ? ' selected' : '';?>>MediumSeaGreen</option>
<option style='background-color: #7B68EE; color: white' value='MediumSlateBlue'<?php echo isset($data['Color']) && $data['Color'] == 'MediumSlateBlue' ? ' selected' : '';?>>MediumSlateBlue</option>
<option style='background-color: #00FA9A; color: black' value='MediumSpringGreen'<?php echo isset($data['Color']) && $data['Color'] == 'MediumSpringGreen' ? ' selected' : '';?>>MediumSpringGreen</option>
<option style='background-color: #48D1CC; color: black' value='MediumTurquoise'<?php echo isset($data['Color']) && $data['Color'] == 'MediumTurquoise' ? ' selected' : '';?>>MediumTurquoise</option>
<option style='background-color: #C71585; color: white' value='MediumVioletRed'<?php echo isset($data['Color']) && $data['Color'] == 'MediumVioletRed' ? ' selected' : '';?>>MediumVioletRed</option>
<option style='background-color: #191970; color: white' value='MidnightBlue'<?php echo isset($data['Color']) && $data['Color'] == 'MidnightBlue' ? ' selected' : '';?>>MidnightBlue</option>
<option style='background-color: #F5FFFA; color: black' value='MintCream'<?php echo isset($data['Color']) && $data['Color'] == 'MintCream' ? ' selected' : '';?>>MintCream</option>
<option style='background-color: #FFE4E1; color: black' value='MistyRose'<?php echo isset($data['Color']) && $data['Color'] == 'MistyRose' ? ' selected' : '';?>>MistyRose</option>
<option style='background-color: #FFE4B5; color: black' value='Moccasin'<?php echo isset($data['Color']) && $data['Color'] == 'Moccasin' ? ' selected' : '';?>>Moccasin</option>
<option style='background-color: #FFDEAD; color: black' value='NavajoWhite'<?php echo isset($data['Color']) && $data['Color'] == 'NavajoWhite' ? ' selected' : '';?>>NavajoWhite</option>
<option style='background-color: #000080; color: white' value='Navy'<?php echo isset($data['Color']) && $data['Color'] == 'Navy' ? ' selected' : '';?>>Navy</option>
<option style='background-color: #FDF5E6; color: black' value='OldLace'<?php echo isset($data['Color']) && $data['Color'] == 'OldLace' ? ' selected' : '';?>>OldLace</option>
<option style='background-color: #808000; color: white' value='Olive'<?php echo isset($data['Color']) && $data['Color'] == 'Olive' ? ' selected' : '';?>>Olive</option>
<option style='background-color: #6B8E23; color: white' value='OliveDrab'<?php echo isset($data['Color']) && $data['Color'] == 'OliveDrab' ? ' selected' : '';?>>OliveDrab</option>
<option style='background-color: #FFA500; color: black' value='Orange'<?php echo isset($data['Color']) && $data['Color'] == 'Orange' ? ' selected' : '';?>>Orange</option>
<option style='background-color: #FF4500; color: white' value='OrangeRed'<?php echo isset($data['Color']) && $data['Color'] == 'OrangeRed' ? ' selected' : '';?>>OrangeRed</option>
<option style='background-color: #DA70D6; color: black' value='Orchid'<?php echo isset($data['Color']) && $data['Color'] == 'Orchid' ? ' selected' : '';?>>Orchid</option>
<option style='background-color: #EEE8AA; color: black' value='PaleGoldenRod'<?php echo isset($data['Color']) && $data['Color'] == 'PaleGoldenRod' ? ' selected' : '';?>>PaleGoldenRod</option>
<option style='background-color: #98FB98; color: black' value='PaleGreen'<?php echo isset($data['Color']) && $data['Color'] == 'PaleGreen' ? ' selected' : '';?>>PaleGreen</option>
<option style='background-color: #AFEEEE; color: black' value='PaleTurquoise'<?php echo isset($data['Color']) && $data['Color'] == 'PaleTurquoise' ? ' selected' : '';?>>PaleTurquoise</option>
<option style='background-color: #DB7093; color: black' value='PaleVioletRed'<?php echo isset($data['Color']) && $data['Color'] == 'PaleVioletRed' ? ' selected' : '';?>>PaleVioletRed</option>
<option style='background-color: #FFEFD5; color: black' value='PapayaWhip'<?php echo isset($data['Color']) && $data['Color'] == 'PapayaWhip' ? ' selected' : '';?>>PapayaWhip</option>
<option style='background-color: #FFDAB9; color: black' value='PeachPuff'<?php echo isset($data['Color']) && $data['Color'] == 'PeachPuff' ? ' selected' : '';?>>PeachPuff</option>
<option style='background-color: #CD853F; color: black' value='Peru'<?php echo isset($data['Color']) && $data['Color'] == 'Peru' ? ' selected' : '';?>>Peru</option>
<option style='background-color: #FFC0CB; color: black' value='Pink'<?php echo isset($data['Color']) && $data['Color'] == 'Pink' ? ' selected' : '';?>>Pink</option>
<option style='background-color: #DDA0DD; color: black' value='Plum'<?php echo isset($data['Color']) && $data['Color'] == 'Plum' ? ' selected' : '';?>>Plum</option>
<option style='background-color: #B0E0E6; color: black' value='PowderBlue'<?php echo isset($data['Color']) && $data['Color'] == 'PowderBlue' ? ' selected' : '';?>>PowderBlue</option>
<option style='background-color: #800080; color: white' value='Purple'<?php echo isset($data['Color']) && $data['Color'] == 'Purple' ? ' selected' : '';?>>Purple</option>
<option style='background-color: #FF0000; color: white' value='Red'<?php echo isset($data['Color']) && $data['Color'] == 'Red' ? ' selected' : '';?>>Red</option>
<option style='background-color: #BC8F8F; color: black' value='RosyBrown'<?php echo isset($data['Color']) && $data['Color'] == 'RosyBrown' ? ' selected' : '';?>>RosyBrown</option>
<option style='background-color: #4169E1; color: white' value='RoyalBlue'<?php echo isset($data['Color']) && $data['Color'] == 'RoyalBlue' ? ' selected' : '';?>>RoyalBlue</option>
<option style='background-color: #8B4513; color: white' value='SaddleBrown'<?php echo isset($data['Color']) && $data['Color'] == 'SaddleBrown' ? ' selected' : '';?>>SaddleBrown</option>
<option style='background-color: #FA8072; color: black' value='Salmon'<?php echo isset($data['Color']) && $data['Color'] == 'Salmon' ? ' selected' : '';?>>Salmon</option>
<option style='background-color: #F4A460; color: black' value='SandyBrown'<?php echo isset($data['Color']) && $data['Color'] == 'SandyBrown' ? ' selected' : '';?>>SandyBrown</option>
<option style='background-color: #2E8B57; color: white' value='SeaGreen'<?php echo isset($data['Color']) && $data['Color'] == 'SeaGreen' ? ' selected' : '';?>>SeaGreen</option>
<option style='background-color: #FFF5EE; color: black' value='SeaShell'<?php echo isset($data['Color']) && $data['Color'] == 'SeaShell' ? ' selected' : '';?>>SeaShell</option>
<option style='background-color: #A0522D; color: white' value='Sienna'<?php echo isset($data['Color']) && $data['Color'] == 'Sienna' ? ' selected' : '';?>>Sienna</option>
<option style='background-color: #C0C0C0; color: black' value='Silver'<?php echo isset($data['Color']) && $data['Color'] == 'Silver' ? ' selected' : '';?>>Silver</option>
<option style='background-color: #87CEEB; color: black' value='SkyBlue'<?php echo isset($data['Color']) && $data['Color'] == 'SkyBlue' ? ' selected' : '';?>>SkyBlue</option>
<option style='background-color: #6A5ACD; color: white' value='SlateBlue'<?php echo isset($data['Color']) && $data['Color'] == 'SlateBlue' ? ' selected' : '';?>>SlateBlue</option>
<option style='background-color: #708090; color: white' value='SlateGray'<?php echo isset($data['Color']) && $data['Color'] == 'SlateGray' ? ' selected' : '';?>>SlateGray</option>
<option style='background-color: #FFFAFA; color: black' value='Snow'<?php echo isset($data['Color']) && $data['Color'] == 'Snow' ? ' selected' : '';?>>Snow</option>
<option style='background-color: #00FF7F; color: black' value='SpringGreen'<?php echo isset($data['Color']) && $data['Color'] == 'SpringGreen' ? ' selected' : '';?>>SpringGreen</option>
<option style='background-color: #4682B4; color: white' value='SteelBlue'<?php echo isset($data['Color']) && $data['Color'] == 'SteelBlue' ? ' selected' : '';?>>SteelBlue</option>
<option style='background-color: #D2B48C; color: black' value='Tan'<?php echo isset($data['Color']) && $data['Color'] == 'Tan' ? ' selected' : '';?>>Tan</option>
<option style='background-color: #008080; color: white' value='Teal'<?php echo isset($data['Color']) && $data['Color'] == 'Teal' ? ' selected' : '';?>>Teal</option>
<option style='background-color: #D8BFD8; color: black' value='Thistle'<?php echo isset($data['Color']) && $data['Color'] == 'Thistle' ? ' selected' : '';?>>Thistle</option>
<option style='background-color: #FF6347; color: black' value='Tomato'<?php echo isset($data['Color']) && $data['Color'] == 'Tomato' ? ' selected' : '';?>>Tomato</option>
<option style='background-color: #40E0D0; color: black' value='Turquoise'<?php echo isset($data['Color']) && $data['Color'] == 'Turquoise' ? ' selected' : '';?>>Turquoise</option>
<option style='background-color: #EE82EE; color: black' value='Violet'<?php echo isset($data['Color']) && $data['Color'] == 'Violet' ? ' selected' : '';?>>Violet</option>
<option style='background-color: #F5DEB3; color: black' value='Wheat'<?php echo isset($data['Color']) && $data['Color'] == 'Wheat' ? ' selected' : '';?>>Wheat</option>
<option style='background-color: #FFFFFF; color: black' value='White'<?php echo isset($data['Color']) && $data['Color'] == 'White' ? ' selected' : '';?>>White</option>
<option style='background-color: #F5F5F5; color: black' value='WhiteSmoke'<?php echo isset($data['Color']) && $data['Color'] == 'WhiteSmoke' ? ' selected' : '';?>>WhiteSmoke</option>
<option style='background-color: #FFFF00; color: black' value='Yellow'<?php echo isset($data['Color']) && $data['Color'] == 'Yellow' ? ' selected' : '';?>>Yellow</option>
<option style='background-color: #9ACD32; color: black' value='YellowGreen'<?php echo isset($data['Color']) && $data['Color'] == 'YellowGreen' ? ' selected' : '';?>>YellowGreen</option>
			  </select>
          </div>

		  <div class="form-group">
            <label for="Weight">Weight</label>
            <input name="Weight" type="text" class="form-control" placeholder="" value="<?php echo_data($data,"Weight");?>">
          </div>

		  <div class="form-group">
            <label for="Price">Container Price</label>
            <input name="Price" type="number" step="any" class="form-control" placeholder="" value="<?php echo_data($data,"Price");?>">
          </div>
		  
		  <div class="form-group">
            <label for="Quantity">Quantity</label>
            <input name="Quantity" type="number" class="form-control" placeholder="" value="<?php echo_data($data,"Quantity");?>">
          </div>

		  <div class="form-group">
            <label for="Desc">Description</label>
            <textarea name="Desc" rows="4" class="form-control"><?php echo_data($data,"Desc");?></textarea>
          </div>

          <button type="submit" class="btn btn-default">Submit</button>

        </form>
    </div>
</div>
<?php //End Success


    endif; //End of Form
	
	
	
	
	
	
	
    $plants = select_plants_from_container($ContainerID);
?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Plant List</h3>
		</div>
        <div class="panel-body">
<?php
    if(count($plants)):
?>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Scientific Name</th>
                    <th>Color</th>
					<th></th>
                </tr>
            </thead>
            <tbody>
<?php 
        foreach($plants as $row):
?>
                <tr>
                    <td class="text-center"><a href="<?php echo "editplant.php?PlantID=".$row['PlantID']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
                    <td><?php echo_data($row, 'CommonName'); ?></td>
                    <td><?php echo_data($row, 'ScientificName'); ?></td>
                    <td><?php echo_data($row, 'Color'); ?></td>
					<td class="text-center"><a href="<?php echo "removeplant.php?ContainerID=".$ContainerID."&PlantID=".$row['PlantID']; ?>"><span class="glyphicon glyphicon-remove"></span></a></td>
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
		<p class="text-center"><span class="btn-group"><a class="btn btn-default" href="editplant.php?containerid=<?php echo $containerid; ?>">Create New Plant</a><a class="btn btn-default" href="editcontainer_addexistingplants.php?containerid=<?php echo $containerid; ?>">Add Plants</a></span></p>
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
			<p>We are missing some information necessary to display this page. This page requires the ContainerID before an existing Container can be edited, OrderID to create a new Conatiner</p>
		</div>
	</div>
<?php 
endif;
	include("templates/footer.php");
?>
