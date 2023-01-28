# Selling API Documentation

Response Schema:
JSON OBJECT {"success" : Boolean,"message_code": String, "body": Array}

GET /sales/get/

- Fetches all the transactions that has been made by the current logged in user today.
- Request arguments: none
- 404 - No transaction were found!

POST /sales/post/

- Create new transaction
- Request Arguments: {"quantity: number, item_id: number, selling_price: number, total_sales: number"}
- 422 - if quantity, item_id, selling_price and total_sales was not provided

PUT /sales/put/

- Edit the quantity, item_id, selling_price and total_sales.
- Request Arguments: {"id: number, quantity: number, item_id: number, selling_price: number, total_sales: number"}
- 422 - if id, item_id, quantity, selling_price and total_sales not provided

DELETE /sales/delete/

- delete the transaction
- Request Arguments: {"id: number, quantity: number, item_id: number"}
- 422 - if id,quantity and item_id not provided
