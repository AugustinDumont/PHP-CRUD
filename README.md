# PHP-CRUD

- Create POST Form with Name and Location input fields and Save button

-  Add div's and Bootstrap classes to the form to make it look good, center the form

- Create process.php, add it to Form action and include it form index.php

- Create the MySQL database "crud" and table "data" with id, name and location fields

- Connect to the database and insert the Name and Location recors into the "data" table if the Save Button has been pressed

- Connect to the database, select the existing records and create the loop to display them above the Form in an HTML table. Add Bootstrap 4 classes to style ad center the table

- Add Edit and Delete link buttons, pass the id of the records as GET variable in the RL in both links

- If the Delete button has been clicked, delete the record from the "data" using passed id from the *_GET['delete'] variable value

- Create session messages and message types for Save and Delete buttons, redirect the user back ton index.php for both

- Display Save and Delete messages with $_SESSION at the top of the page using Bootstrap 4 classes appropriate for each message type 

- If the Edit button has been clicked, select the existing record from the database, set $name and $location variables and display then in the Form input fields. Set the $name and $location to empty strings out the is statement. 

- Set the $update variable to true inside the Edit button if statement. Set the $update variable to false out the is statement. 

- Add hidden input field with the value of the record id to access it from POST

- If the Update button has been clicked, update the record with new $name and $location using


https://www.youtube.com/watch?v=3xRMUDC74Cw&t=476s
https://www.patreon.com/clevertechie