# Ticket booking
## Installation
After cloning the project, install the dependencies by running 
```composer install```

Create a database and update the database records in the .env file.
Run the following commands to finish the database setup
1. ```php artisan migrate```
2. ```php artisan db:seed```

## End points
### 1. Get all tickets
To get all tickets, send a <strong>GET</strong> request to http://path/to/public/folder/api/tickets

### 2. Add ticket
Send a <strong>POST</strong> request to http://path/to/public/folder/api/tickets with the following data
* event: string
*	ticket_type_id: integer
*	price: double
*	total_number_available: integer
*	number_sold: integer
* number_unsold: integer

The values above are the type of data to be sent e.g "event" should be a **string** while price should be of type **double**

### 3. Update ticket type
Send a **PUT|PATCH** request to http://path/to/public/folder/api/tickets/{ticket_id} with the new **ticket_type_id**

*Note:* This endpoint can be used to update all fields for a ticket.

### 4. Create ticket type
Send a **POST** request to  http://path/to/public/folder/api/tickettypes with the following data
* name: string

### 5. Edit ticket 
Send a <strong>PUP|PATCH</strong> request to http://path/to/public/folder/api/tickets/{ticket_id} with the fields that needs
update. Possible fields to be updated include:
* event: string
*	ticket_type_id: integer
*	price: double
*	total_number_available: integer
*	number_sold: integer
* number_unsold: integer





