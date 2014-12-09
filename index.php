<?php
	$page_title = "Index";
	$page_subtitle = "The Home Page";
	include("templates/header.php"); 
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Creating Orders</h3>
    </div>
    <div class="panel-body">
        <p>How to Create Customers and Orders</p>
        <ol>
            <li>If you are an existing customer, find yourself in the list of <a href="listcustomer.php">All Customers</a></li>
            <li>If you are new, create a <a href="editcustomer.php">New Customer</a></li>
            <li>On the Customer View Page, click the green "Create New Order" button</li>
            <li>Click the blue "Add Container" button to add your first container</li>
            <li>Fill out the Container form and click the "Submit" button</li>
            <li>Click the "Add Plants" button at the bottom of the page to add some plants to your basket</li>
            <li>After you have returned to the Container Edit page update the quantities of flowers</li>
            <li>Click the "Return to Container View" button at the top of the page</li>
            <li>Click the "Magnifying Glass" icon next to Order to return to your order</li>
            <li>Add another container or click the green "Submit Order" button at the bottom of the page</li>
        </ol>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Admin Functions</h3>
    </div>
    <div class="panel-body">
        <p>In the Admin Section of the Navigation menu to the right you will find these pages</p>
        <ol>
            <li><a href="listneeded.php">Needed Plants</a> for this year</li>
            <li><a href="listorders_markcomplete.php">Mark Orders as Complete</a></li>
            <li><a href="listorders_notpickedup.php">Mark Orders as PickedUp</a></li>
        </ol>
    </div>
</div>
<?php 
	include("templates/footer.php");
?>
