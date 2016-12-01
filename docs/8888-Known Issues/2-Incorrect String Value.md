# Incorrect String Value

## Symptoms
When running `php artisan jj:donations` you may get an error that ends with `SQLSTATE[22007]: Invalid datetime format: 1366 Incorrect string value: '\xF0\x9F\x98\x9C' for column 'comment' at row 366`.  

## Solution
This is caused by people putting emoji in their `name` or `comment`.  To correct this you need to change the encoding and 
collation the column uses to handle 4byte characters.

```
ALTER TABLE donations
    convert to CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
```
