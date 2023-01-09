# Sellign API Documentation

Response Schema:
JSON OBJECT {"success" : Boolean,"message_code": String, "body": Array}

GET /sellapi/get

- Fetches all the transactions that has been made by the current logged in user today.
- Request arguments: none
- 404 - No transaction were found!

POST /sellapi/post

- Create new transaction
- Request Arguments: {"quantity: Integer, item_id: Integer, selling_price: Integer, total_sales: Integer"}
- 422 - if quantity, item_id, selling_price and total_sales was not provided

PUT /sellapi/put

- Edit the quantity, item_id, selling_price and total_sales.
- Request Arguments: {"id: Integer, quantity: Integer, item_id: Integer, selling_price: Integer, total_sales: Integer"}
- 421 - if id, item_id, quantity, selling_price and total_sales not provided

DELETE /sellapi/delete

- delete the transaction
- Request Arguments: {"id: Integer, quantity: Integer, item_id: Integer"}
- 421 - if id,quantity and item_id not provided
