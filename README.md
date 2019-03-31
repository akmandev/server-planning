# Server Planning

There is an executable PHP file under the /bin directory. So, you can basically call the command below:

`./bin/calculate`

It takes the information about server type and virtual machines from `/data` folder.

---

### Testing

Used phpunit, phpcs and phpstan to test and analyze the code.

Also, created a little script for composer to check everything is ok:

`composer test`