Custom Orders Database Project
==============================
##High level Description in English 
We propose to design and create a database for a managing custom hanging baskets and pot orders for a Nursery. Customers request Baskets (on an order) that contain various plants. Baskets are priced by the entire basket instead of the total price of each plant. Orders are all taken in the start of spring and fulfilled by the end of spring. When the baskets are done, the customers can pick up the baskets and pay for them. Customers may buy the same baskets every year, but the price of the Baskets may go up. The general functionality of the project is to make a more efficient means of organizing the baskets at the nursery, tracking costs, provide easy access to the customer's orders, and store helpful information about various baskets. 
 
##Our database is based on these rules: 
Many different BASKETS contain many different PLANTS.

A CUSTOMER makes a purchase on any number of ORDERS. 

An ORDER contains information on many CONTAINER ordered, with at least one of many ORDER ITEMS, an association between ORDER and CONTAINER, containing the price and quantity of a CONTAINER. 
 
##List of Requirements for operation/functionality. What will the user be able to do? 
 - User can create Orders 
 - User is able to create new containers and add plants 
 - User is able to attach the containers to the orders 
 - User can create Customers  
 - Orders keep track of if the order has been completed and/or picked up 
 - User doesn't need to delete any data 
 - Generate a 1 page document that contains most of the information for an order 
 - Search through past baskets, preferable by year 

##Questions to be Answered 
 - Calculate price of the baskets and Compare it to Quoted Price and determine the price of the Order (The Price the Customer  - Pays will be equal to Quoted Price or Basket Price, whichever is lower) 
 - Generate a list of Orders showing the balances, customer names 
 - List Quantities of All Plants that will be needed for each Order for a certain year 
 - List all Baskets and their owner's names that have not been picked up. 
