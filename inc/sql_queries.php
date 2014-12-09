<?php

require_once("global.php");

function openconnection() {
	global $db_host;
	global $db_user;
	global $db_pass;
	global $db_data;
	
    $connection = new mysqli($db_host, $db_user, $db_pass, $db_data);

    if($connection->connect_error) {
        $error = array("Connect Error (" . mysql_connect_errno() . ") " . mysqli_connect_error());
        render_errors($error, "There was a mysterious database error...");
        return false;
    }
    return $connection;
}

/*
 * Function: create_customer()
 * Description: Runs the SQL query to add a new customer to to the database
 * Returns: The user's new created ID
 * Postconditions: A new Customer will exist in the table
 */
function create_customer($data)
{
	if ($con = openconnection())
	{
		//Insert our Customer into the database
		if ($query = $con->prepare("INSERT INTO Customer(Name, Address, Phone, Email) VALUES (?,?,?,?)"))
		{
			$query->bind_param("ssss", $data["Name"], $data["Address"], $data["Phone"], $data["Email"]);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
		//Determine the ID of the customer we just inserted
		if ($query = $con->prepare("SELECT MAX(CustomerID) AS ID FROM Customer"))
		{
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}

		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
			return $result[0]["ID"]; //Only one item in array
		else
			return NULL;
	  
      $con->close();
   }
}

/*
 * Function: update_customer()
 * Description: Replaces a Customer's information based on what they edit
 * Preconditions: $id should not be a new ID, but the one the user is given; All of the attributes passed are either a new 
 * 	value or one entered by the user
 * Postconditions: The information is updated
 */
function update_customer($data)
{
	if ($con = openconnection())
	{
		//Update our Customer in the database
		if ($query = $con->prepare("REPLACE INTO Customer(CustomerID, Name, Address, Phone, Email) VALUES (?,?,?,?,?)"))
		{	
			$query->bind_param("issss", $data["CustomerID"], $data["Name"], $data["Address"], $data["Phone"], $data["Email"]);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
	  
		$con->close();
   }
}

/*
 * Function: create_order()
 * Description: Runs the SQL query to add a new order to to the database
 * Returns: The Order's new created ID
 * Postconditions: A new Order will exist in the table
 */
function create_order($data)
{
	if ($con = openconnection())
	{
		//Insert our Order into the database
		if ($query = $con->prepare("INSERT INTO `Order`(DateOrdered, QuotedPrice, TotalPaid, CustomerID, Complete, PickedUp) VALUES (?,?,?,?,?,?)"))
		{
			$query->bind_param("sddiii", $data["DateOrdered"], $data["QuotedPrice"], $data["TotalPaid"], $data["CustomerID"], $data["Complete"], $data["PickedUp"]);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
      
		//Determine the ID of the Order we just inserted
		if ($query = $con->prepare("SELECT MAX(OrderID) AS ID FROM Order"))
		{
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}

		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
            return $result[0]["OrderID"]; //Only one item in array
		else
			return NULL;
	  
		$con->close();
   }
}

/*
 * Function: create_blank_order()
 * Description: Creates a blank order for a customer
 * Parameters: The Customer's ID
 * Returns: The new Order's ID
 * Postconditions: The new Order will be inserted into the table
 */
function create_blank_order($customer_id)
{
	if ($con = openconnection())
	{
		//Insert our Order into the database
		if ($query = $con->prepare("INSERT INTO `Order`(CustomerID) VALUES (?)"))
		{
			$query->bind_param("i", $customer_id);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
	
		//Determine the ID of the Order we just inserted
		if ($query = $con->prepare("SELECT MAX(OrderID) AS ID FROM `Order`"))
		{
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}

		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
            return $result[0]["ID"]; //Only one item in array
		else
			return NULL;
	  
		$con->close();
	}
}

/*
 * Function: update_order()
 * Description: Replaces an Order's information based on what the user edits
 * Preconditions: $id should not be a new ID, but the one the user is given; All of the attributes passed are either a new 
 * 	value or one entered by the user
 * Postconditions: The information is updated
 */
function update_order($data)
{
	if ($con = openconnection())
	{
		//Update our Order in the database
		if ($query = $con->prepare("REPLACE INTO `Order`(OrderID, DateOrdered, QuotedPrice, TotalPaid, CustomerID, Complete, PickedUp) VALUES (?,?,?,?,?,?,?)"))
		{
			$query->bind_param("isddiii", $data["OrderID"], $data["DateOrdered"], $data["QuotedPrice"], $data["TotalPaid"], $data["CustomerID"], $data["Complete"], $data["PickedUp"]);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($query->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
	  
		$con->close();
   }
}

/*
 * Function: create_container()
 * Description: Runs the SQL query to add a new Container to to the database
 * Returns: The Container's new ID
 * Postconditions: A new Container will exist in the table
 */
function create_container($data)
{
	if ($con = openconnection())
	{
		//Insert our Container into the database
		if ($query = $con->prepare("INSERT INTO Container(Shape, Color, Weight, `Desc`, Price, OrderID, Quantity) VALUES (?,?,?,?,?,?,?)"))
		{
			$query->bind_param("ssdsidi", $data["Shape"], $data["Color"], $data["Weight"], $data["Desc"], $data["Price"], $data["OrderID"], $data["Quantity"]);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
		//Determine the ID of the Container we just inserted
		if ($query = $con->prepare("SELECT MAX(ContainerID) AS ID FROM Container"))
		{
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}

		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
			return $result[0]["ID"]; //Only one item in array
		else
			return NULL;
	  
		$con->close();
	}
}

/*
 * Function: update_container()
 * Description: Replaces a Container's information based on what the user edits
 * Preconditions: $id should not be a new ID, but the one the user is given; All of the attributes passed are either a new 
 * 	value or one entered by the user
 * Postconditions: The information is updated
 */
function update_container($data)
{
	if ($con = openconnection())
	{
		//Update our Container in the database
		if ($query = $con->prepare("REPLACE INTO Container(ContainerID, Shape, Color, Weight, `Desc`, Price, OrderID, Quantity) VALUES (?,?,?,?,?,?,?,?)"))
		{
			$query->bind_param("issdsdii", $data["ContainerID"], $data["Shape"], $data["Color"], $data["Weight"], $data["Desc"], $data["Price"], $data["OrderID"], $data["Quantity"]);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
	  
		$con->close();
	}
}

/*
 * Function: create_container_plant()
 * Description: Runs the SQL query to add a new ContainerPlant to to the database
 * Returns: The Container's new ID
 * Postconditions: A new ContainerPlant will exist in the table
 */
function create_container_plant($data)
{
	if ($con = openconnection())
	{
		//Insert our ContainerPlant into the database
		if ($query = $con->prepare("INSERT INTO ContainerPlant(ContainerID, PlantID, Quantity) VALUES (?,?,?)"))
		{
			$query->bind_param("iii", $data["ContainerID"], $data["PlantID"], $data["Quantity"]);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($query->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
      
		$con->close();
		// Returns the ContainerID
		return $data["ContainerID"];
	}
}

/*
 * Function: update_container_plant()
 * Description: Replaces a ContainerPlant's information based on what the user edits
 * Preconditions: $id should not be a new ID, but the one the user is given; All of the attributes passed are either a new 
 * 	value or one entered by the user
 * Postconditions: The information is updated
 */
function update_container_plant($data)
{
	if ($con = openconnection())
	{
		//Update our ContainerPlant in the database
		if ($query = $con->prepare("REPLACE INTO ContainerPlant(ContainerID, PlantID, Quantity) VALUES (?,?,?)"))
		{
			$query->bind_param("iii", $data["ContainerID"], $data["PlantID"], $data["Quantity"]);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
	  
		$con->close();
	}
}

/*
 * Function: create_plant()
 * Description: Runs the SQL query to add a new Plant to to the database
 * Returns: The Plant's new ID
 * Postconditions: A new Plant will exist in the table
 */
function create_plant($data)
{
	if ($con = openconnection())
	{
		//Insert our ContainerPlant into the database
		if ($query = $con->prepare("INSERT INTO Plant(CommonName, ScientificName, Color, Picture) VALUES (?,?,?,?)"))
		{
			$query->bind_param("ssss", $data["CommonName"], $data["ScientificName"], $data["Color"], $data["Picture"]);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($query->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
	}
   
	//Determine the ID of the Plant we just inserted
	if ($query = $con->prepare("SELECT MAX(PlantID) AS ID FROM Plant"))
	{
		$query->execute();
		if ($query->error)
		{
			//If there are errors, display them
			$error = array($querry->error);
			render_errors($error, "MySQL Reported an Error Executing a Query");
			$con->close();
			return NULL;
		}
	}

		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
				return $result[0]["ID"]; //Only one item in array
		else
			return NULL;
	  
		$con->close();
}
 
/*
 * Function: update_plant()
 * Description: Replaces a Plant's information based on what the user edits
 * Preconditions: $id should not be a new ID, but the one the user is given; All of the attributes passed are either a new 
 * 	value or one entered by the user
 * Postconditions: The information is updated
 */
function update_plant($data)
{
   if ($con = openconnection())
   {
      //Update our Plant in the database
      if ($query = $con->prepare("REPLACE INTO Plant(PlantID, CommonName, ScientificName, Color, Picture) VALUES (?,?,?,?,?)"))
      {
		$query->bind_param("issss", $data["PlantID"], $data["CommonName"], $data["ScientificName"], $data["Color"], $data["Picture"]);
		$query->execute();
		if ($query->error)
		{
			//If there are errors, display them
			$error = array($query->error);
			render_errors($error, "MySQL Reported an Error Executing a Query");
			$con->close();
			return NULL;
		}
      }
	  
      $con->close();
   }
}

/*
 * Function: remove_order()
 * Description: Removes an Order from the table
 * Parameters: The OrderID to be removed
 * Postconditions: The desired Order will be deleted
 */
function remove_order($order_id)
{
	if ($con = openconnection())
	{
		// Removes the Order
		if ($query = $con->prepare("DELETE FROM `Order` WHERE OrderID = ?"))
		{
			$query->bind_param("i", $order_id);
			$query->execute();
			if ($query->error)
			{
				// If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
	
		$con->close();
	}
}

/*
 * Function: remove_container()
 * Description: Removes a Container from the table
 * Parameters: The ContainerID to be removed
 * Postconditions: The desired Container will be deleted
 */
function remove_container($container_id)
{
	if ($con = openconnection())
	{
		// Removes the Container
		if ($query = $con->prepare("DELETE FROM Container WHERE ContainerID = ?"))
		{
			$query->bind_param("i", $container_id);
			$query->execute();
			if ($query->error)
			{
				// If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
		
		$con->close();
	}
}
 
/*
 * Function: remove_plant()
 * Description: Removes a Plant from a Container, by removing the PlantID from the ContainerPlant table
 * Parameters: The PlantID to be removed and the ContainerID to remove it from
 * Postconditions: The desired Plant will be removed from the Container
 */
function remove_plant($container_id, $plant_id)
{
	if ($con = openconnection())
	{
		// Removes the Plant from the ContainerPlant
		if ($query = $con->prepare("DELETE FROM ContainerPlant WHERE ContainerID = ? AND PlantID = ? "))
		{
			$query->bind_param("ii", $container_id, $plant_id);
			$query->execute();
			if ($query->error)
			{
				// If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
		
		$con->close();
	}
}
 
/*
 * Function: select_orders_from_customer()
 * Description: Displays all Orders of a Customer
 * Parameters: The CustomerID
 */
function select_orders_from_customer($customer_id)
{
	if ($con = openconnection())
	{
		// Get the Orders
		if ($query = $con->prepare("SELECT * FROM `Order`, Customer
			WHERE `Order`.CustomerID = Customer.CustomerID AND Customer.CustomerID = ?"))
		{
			$query->bind_param("i", $customer_id);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}

		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
			return $result; // Returning the entire array
		else
			return NULL;
		
		$con->close();
	}
}
 
/*
 * Function: select_containers_from_order()
 * Description: Displays all Containers of an Order
 * Parameters: The OrderID
 */
function select_containers_from_order($order_id)
{
	if ($con = openconnection())
	{
		// Get the Containers
		if ($query = $con->prepare("SELECT * FROM Container, `Order`
			WHERE Container.OrderID = `Order`.OrderID AND `Order`.OrderID = ?"))
		{
			$query->bind_param("i", $order_id);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}

		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
			return $result; // Returning the entire array
		else
			return NULL;
		
		$con->close();
	}
}
 
/*
 * Function: select_plants_from_container()
 * Description: Displays all Plants of a Container
 * Parameters: The ContainerID
 */
function select_plants_from_container($container_id)
{
	if ($con = openconnection())
	{
		// Get the Containers
		if ($query = $con->prepare("SELECT * FROM Container, ContainerPlant, Plant
			WHERE Container.ContainerID = ContainerPlant.ContainerID AND Plant.PlantID = ContainerPlant.PlantID
				AND Container.ContainerID = ?"))
		{
			$query->bind_param("i", $container_id);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}

		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
			return $result; // Returning the entire array
		else
			return NULL;
		
		$con->close();
	}
}

/*
 * Function: get_customer()
 * Description: Gets a single customer from the database
 * Parameters: The CustomerID
 * Returns: The resulting row
 */
function get_customer($customer_id)
{
	if ($con = openconnection())
	{
		// Get the Customer
		if ($query = $con->prepare("SELECT * FROM Customer WHERE CustomerID = ?"))
		{
			$query->bind_param("i", $customer_id);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}

		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
			return $result[0]; // Returning the entire array
		else
			return NULL;
		
		$con->close();
	}
}

/* 
 * Function: get_order()
 * Description: Gets a single Order from the database
 * Parameters: The OrderID
 * Returns: The resulting row
 */
function get_order($order_id)
{
	if ($con = openconnection())
	{
		// Get the Order
		if ($query = $con->prepare("SELECT * FROM `Order`, Customer
			WHERE `Order`.OrderID = ?
				AND Customer.CustomerID = `Order`.CustomerID"))
		{
			$query->bind_param("i", $order_id);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}

		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
			return $result[0]; // Returning the entire array
		else
			return NULL;
		
		$con->close();
	}
}

/*
 * Function: get_container()
 * Description: Gets a single Container from the database
 * Parameters: The ContainerID
 * Returns: The resulting row
 */
function get_container($container_id)
{
	if ($con = openconnection())
	{
		// Get the Container
		if ($query = $con->prepare("SELECT * FROM Container, Customer, `Order`
			WHERE Customer.CustomerID = `Order`.CustomerID
				AND `Order`.OrderID = Container.OrderID
				AND ContainerID = ?"))
		{
			$query->bind_param("i", $container_id);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($query->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}

		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
			return $result[0]; // Returning the entire array
		else
			return NULL;
		
		$con->close();
	}
}

/*
 * Function: get_plant()
 * Description: Gets a single Plant from the database
 * Parameters: The PlantID
 * Returns: The resulting row
 */
function get_plant($plant_id)
{
	if ($con = openconnection())
	{
		// Get the Container
		if ($query = $con->prepare("SELECT * FROM Plant
			WHERE PlantID = ?"))
		{
			$query->bind_param("i", $plant_id);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}

		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
			return $result[0]; // Returning the entire array
		else
			return NULL;
		
		$con->close();
	}
}

/*
 * Function: select_all_customers()
 * Description: Selects all Customers in the database
 */
function select_all_customers()
{
	if ($con = openconnection())
	{
		// Gets the Customers
		if ($query = $con->prepare("SELECT * FROM Customer"))
		{
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}

		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
			return $result; // Returning the entire array
		else
			return NULL;
		
		$con->close();
	}
}

/*
 * Function: select_all_orders()
 * Description: Selects all orders in the database
 */
function select_all_orders()
{
	if ($con = openconnection())
	{
		// Gets the Orders
		if ($query = $con->prepare("SELECT * FROM `Order`, Customer
			WHERE Customer.CustomerID = `Order`.CustomerID
			ORDER BY `Order`.DateOrdered DESC"))
		{
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}

		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
			return $result; // Returning the entire array
		else
			return NULL;
		
		$con->close();
	}
}

/*
 * Function: select_all_orders_notpickedup()
 * Description: Selects all orders in the database
 */
function select_all_orders_notpickedup()
{
	if ($con = openconnection())
	{
		// Gets the Orders
		if ($query = $con->prepare("SELECT * FROM `Order`, Customer
			WHERE Customer.CustomerID = `Order`.CustomerID
				AND `Order`.PickedUp = '0' AND `Order`.Complete = '1'
			ORDER BY `Order`.DateOrdered DESC"))
		{
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}

		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
			return $result; // Returning the entire array
		else
			return NULL;
		
		$con->close();
	}
}

/* 
 * Function: select_all_incomplete_orders()
 * Description: Selects all the orders that have still not been completed
 */
function select_all_incomplete_orders()
{
	if ($con = openconnection())
	{
		// Gets the Orders
		if ($query = $con->prepare("SELECT * FROM `Order`, Customer
			WHERE Customer.CustomerID = `Order`.CustomerID
				AND Complete = '0'
			ORDER BY `Order`.DateOrdered DESC"))
		{
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}

		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
			return $result; // Returning the entire array
		else
			return NULL;
		
		$con->close();
	}
}

/*
 * Function: select_all_plants()
 * Description: Selects all plants in the database
 * Returns: The resulting array
 */
function select_all_plants($ContainerID)
{
	if ($con = openconnection())
	{
		// Gets the Plants
		if ($query = $con->prepare("SELECT * FROM Plant
			WHERE PlantID NOT IN (SELECT PlantID FROM ContainerPlant
				WHERE ContainerID = ?)"))
		{
			$query->bind_param("i", $ContainerID);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
		
		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
			return $result; // Returning the entire array
		else
			return NULL;
		
		$con->close();
	}
}

/*
 * Function: select_all_needed_plants()
 * Description: Selects and shows all of the plants that will be needed for the current year
 * Returns: The resulting array
 */
function select_all_needed_plants()
{
	if ($con = openconnection())
	{
		// Gets the Plants
		if ($query = $con->prepare("
		SELECT `PlantID`, 
			   `CommonName`, 
			   `Color`, 
			   `ScientificName`, 
			   Sum(`Quantity`) AS `Quantity` 
		FROM   (SELECT `Plant`.`PlantID`, 
					   `Plant`.`CommonName`, 
					   `Plant`.`Color`, 
					   `Plant`.`ScientificName`, 
					   `ContainerPlant`.`Quantity` * `Container`.`Quantity` AS 
					   `Quantity` 
				FROM   `Plant`, 
					   `Container`, 
					   `ContainerPlant` 
				WHERE  `Plant`.`PlantID` = `ContainerPlant`.`PlantID` 
					   AND `Container`.`ContainerID` = `ContainerPlant`.`ContainerID`) 
			   AS 
			   `Subtotal` 
		GROUP  BY `PlantID`; 
		"))
		{
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
		
		$response = $query->get_result();
		while($row = $response->fetch_assoc())
			$result[] = $row;
		if(isset($result))
			return $result; // Returning the entire array
		else
			return NULL;
		
		$con->close();
	}
}
 
/*
 * Function: set_complete()
 * Description: Updates an Order in the database to be set to "Complete"
 * Parameters: The Order's ID
 */
function set_complete($order_id)
{
	if ($con = openconnection())
	{
		if ($query = $con->prepare("UPDATE `Order` SET Complete = '1'
			WHERE OrderID=?"))
		{
			$query->bind_param("i", $order_id);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
	}
}

/*
 * Function: set_pickedup()
 * Description: Updates an Order in the database to be set to "PickedUp"
 * Parameters: The Order's ID
 */
function set_pickedup($order_id)
{
	if ($con = openconnection())
	{
		if ($query = $con->prepare("UPDATE `Order` SET PickedUp = '1'
			WHERE OrderID=?"))
		{
			$query->bind_param("i", $order_id);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($querry->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
	}
}

/*
 * Function: update_quantity()
 * Description: Updates the quantity of the plants in a 
 * Parameters: The PlantID and ContainerID to reference a relationship, and the quantity of plants
 * Postconditions: The Quantity will be updated
 */
function update_quantity($PlantID, $ContainerID, $Quantity)
{
	if ($con = openconnection())
	{
		// Alters the Quantity attribute in the ContainerPlant row
		if ($query = $con->prepare("UPDATE ContainerPlant SET Quantity = ?
			WHERE ContainerID = ? AND PlantID = ?"))
		{
			$query->bind_param("iii", $Quantity, $ContainerID, $PlantID);
			$query->execute();
			if ($query->error)
			{
				//If there are errors, display them
				$error = array($query->error);
				render_errors($error, "MySQL Reported an Error Executing a Query");
				$con->close();
				return NULL;
			}
		}
	}
}
?>
