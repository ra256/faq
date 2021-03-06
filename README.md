# faq

Epic - Adding Admin Role Functionality

User Story 1) Delete a User

As an Admin - I must be able to log in and access the Admin Control Panel, search for a single user and delete users so that I can manage my system in the event my users no longer work for me. Once a user is deleted, a message will appear saying the User Has Been Deleted.

Acceptance Criteria: Prerequisite - Admin user must be already created. Log in as Admin, go to the Admin Page. Search for a specific user and delete them from this page. Log out and try to login as that deleted user and that user cannot log in successfully, because they are deleted.

User Story 2) Lock a User

As an Admin - I must be able to log in and access the Admin Control Panel, search for a single user and lock users so that I can temporarily or permanently stop a user from accessing the site, unless decided later to unlock the user later on. Once locked, a message will appear saying the User Has Been Locked.

Acceptance Criteria: Prerequisite – Admin user must sign in and any user must currently be unlocked. Log in as Admin, go to the Admin Page and lock any user. Log out and try to log in as that locked user and that user cannot log in successfully because they are currently locked.

User Story 3) Unlock a User

As an Admin - I must be able to log in and access the Admin Control Panel, search for a single user that has been locked, unlock those specific users so that the user can log back in again access the site. Once a user is unlocked, a message will appear saying the User Has Been Unlocked.

Acceptance Criteria: Prerequisite – Admin user must sign in and any user must currently be locked. Log in as Admin, go to the Admin Page. Search for a specific user and lock them from this page. Log out and try to login as that now unlocked user and that user can now again log in successfully because they are currently unlocked.

User Story 4) Promote or Demote a User

As a SUPER Admin Only - I must be able to log in and access the Admin Control Panel, search for a single user and either Promote or Demote them if I wish for them to be able to help manage other users by locking, unlocking, or deleting them. If a user has been promoted or demoted, the user will see a message that the User has been Promoted or Demoted, respectively. If a user has been demoted they will not be able to access the Admin Control Panel.
 
Acceptance Criteria: Prerequisite – Super Admin user must be logged in and go to the Admin Page. Search for a specific user to Promote them if they are not currently an admin or demote them if you wish to revoke Admin privileges. Log out and try to login as that promoted user and test to see if they now have full access to lock, unlock or delete users. Go back one step and repeat the same for a user who is demoted after demoting an admin user, and make they cannot even access the admin panel. If they try to access the ADMIN path http://raheelminiproject3.herokuapp.com/admin they will get redirected and a message will appear saying the user is not an Admin.

To use the Super Admin, log in with the following credentials:

admin@raheelminiproject3.herokuapp.com
Password is adminadmin

Hit the drop down to access the Admin Panel, and give it a go by giving registered users admin access or demote their access. Try logging in as an admin after granting a registered user access, and notice the difference between the Super Admin and Admin options. The Admin cannot create other Admin users, but they can still lock and delete users.

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