# php-mvc-referral-system
PHP MVC + MySQL exercise 

This is an interview test for a PHP developer role.

> We need a system to capture client referrals, and manage those referrals.  The system is only accessible to admin staff (users).  We do not need an authentication system.  The system must:
Capture information about new clients (manual input)
* Title
* First Name
* Surname
* Date of Birth
* E-mail
* Mobile Phone
* Address (in a format that is useable for future postcode look-ups and mail merges).
Allow users to review new clients, and choose to either accept or reject them.
Let users see 3 lists:
* Referred Clients
* Accepted Clients
* Rejected Clients

> We have an existing system of 50,000 clients which the new system will need to import.

For my implementation I've used MySQL Workbench to design the database (__referral_system.mwb__) and [Propel](http://propelorm.org/) as PHP ORM. I've used the Workbench plugin [PropelExport.grt.lua](https://github.com/mazenovi/PropelExport/blob/master/PropelExport.grt.lua) to export the DB schema from MySQL Workbench to the Propel schema.xml file.

I've used composer to install the dependencies.

### Rebuild
    ./propel sql:build --overwrite
    ./propel sql:insert
    ./propel model:build
    composer install
