# giftano-product

### Installation
1. Set up your web & database server.
3. Clone this repo to your server / local machine.
```
git clone https://github.com/ahrezaldy/giftano-product.git
```
3. Execute
```
Composer install
```
4. Rename file `.env.example` to `.env` and edit based on your server setting.
```
. . .
APP_URL=http://localhost:8000
. . .
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=giftano
DB_USERNAME=giftano
DB_PASSWORD=giftano
. . .
```
6. Execute
```
php artisan migrate:refresh --seed
```
7. (Optional) Execute
```
php artisan serve
```
if no web server provided. If this step is done, base URL will be `http://localhost:8000`

### User & Auth
I provide default user:
```
email: admin@email.com
name: admin
password: password
```
The API require `Basic Auth` method. To access available API, use provided `email` & `password` above.

### Endpoint
1. GET /api/categories
- Endpoint to get all categories.
- Categories have order, thus this endpoint by default return categories sorted by order.
- Support sort by id / name / order (?sort_by=...).
2. GET /api/categories/{id}
- Endpoint to get one category detail.
3. POST /api/categories
- Endpoint to create one new category. Required fields: `name`, `order`.
4. PUT /api/categories/{id} or PATCH /categories/{id}
- Endpoint to update some/all field(s) of one category. Available fields: `name`, `order`.
5. DELETE /api/categories/{id}
- Endpoint to delete one room.
6. GET /api/categories/{catId}/products
- Endpoint to get all products in category with id = {catId}.
7. GET /api/categories/{catId}/products/{id}
- Endpoint to get one product detail.
- Make sure that the product listed in category with id = {catId}.
8. POST /api/categories/{catId}/products
- Endpoint to create one new product in category with id = {catId}. Required fields: `name`.
9. PUT /api/categories/{catId}/products/{id} or PATCH /categories/{catId}/products
- Endpoint to update `name` field of one product.
- Make sure that the product listed in category with id = {catId}.
10. DELETE /api/categories/{catId}/products
- Endpoint to delete one product.
- Make sure that the product listed in category with id = {catId}.

### Functional Test
1. Execute
```
phpunit
```

### Time to Finish: ~5 hours
