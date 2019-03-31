# Server Planning

This repository is an example project to demonstrate my code style and approach for the specific logic.

Description of the code:
 - A library that calculates the number of servers (which have the same configuration) needed to host a specified amount of virtual machines/
 
---

# How It Works

There is an executable PHP file under the /bin directory. So, you can basically call the command below:

`./bin/calculate`

It takes the information about server type and virtual machines from `/data` folder.

Returns amount of the needed servers as a result.

---

### Testing

Used phpunit, phpcs and phpstan to test and analyze the code.

Also, created a little script for composer to check everything is ok:

`composer test`