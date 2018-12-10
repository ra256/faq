# faq

1) A Super Admin has all privileges, including giving admin access to all users.
2) An Admin User can lock and unlock accounts but can not give admin access to other users.
3) A standard users cannot view the admin URL as they will get an error message.
4) Admins can delete a user.

To use the Super Admin, log in with the following credentials:

admin@raheelminiproject3.herokuapp.com
Password is admin

Hit the drop down to access the Admin Panel, and give it a go by giving new registered users admin access or demote their access.
Try logging in as an admin after granting a registered user access, and notice the difference between the Super Admin and Admin options
The Admin cannot create other Admin users, but they can still lock and delete users.
There are flags in the database for the types of users, as below and you can see that in the testing as well.

0 normal user
2 admin
1 super admin
___________
0 unlock
1 lock

Testing instructions:

To run tests: run two terminal windows - 1 to run the local site, php artisan serve and 2 to run php artisan dusk command to run the tests

I have 1 test to check the super admin access to admin area
testSuperAdminLogin

I have 1 test to check the admin access to admin area
testAdminLogin

I have 1 test to check the delete user functionality.
testUserDeleteFunctionality

I have 1 test to check the lock user functionality.
testUserLockFunctionality

I have 1 test to check the unlock user functionality.
testUserUnlockFunctionality

I have 1 test to check the promote user functionality.
testUserPromoteFunctionality

I have 1 test to check the demote user functionality.
testUserDemoteFunctionality

I have 5 tests to make sure normal user doesn't have access to admin routes
testNormalUserDeletePageAccess
testNormalUserUnlockPageAccess
testNormalUserLockPageAccess
testNormalUserPromotePageAccess
testNormalUserDemotePageAccess

I have 2 tests to make sure admin doesn't have access to super-admin routes
testAdminPromotePageAccess
testAdminDemotePageAccess

To run the FAQ project:

1. git clone https://github.com/ra256/faq.git
2. CD into FAQ and run composer install
3. cp .env.example to .env
4. setup database / with sqlite or other (https://laravel.com/docs/5.6/database)

