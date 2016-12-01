# HB Create Date Keeps Updating

## Symptoms
When you update a donation to set the `shown_flag` or `read_flag`, the flag, `updated_at` and `hb_created_at` are all updated.

## Solution
There is actually nothing wrong with the code.  It is possible the Extras detail on the `hb_created_at` column is set 
to `on update CURRENT_TIMESTAMP`.  This is wrong and should be set to none.  You can do this through sequel pro or through 
the CLI.

```
alter table donations
 change hb_created_at hb_created_at TIMESTAMP DEFAULT NULL
```
