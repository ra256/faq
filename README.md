# faq

A Super Admin has all privileges, including giving admin access to all users
An Admin User can lock and delete accounts but can not give admin access to other users.
A standard users cannot view the admin URL as they will get an error message.
All users can create, edit, delete questions and create a profile.

To use the Super Admin, log in with the following credentials:

admin@raheelminiproject3.herokuapp.com
Password is admin

Hit the drop down to access the Admin Panel, and give it a go by giving new registered users admin access or demote their access.

Try logging in as an admin after granting a registered user access, and notice the difference between the Super Admin and Admin options

The Admin cannot create other Admin users, but they can still lock and delete users.


0 normal user
2 admin
1 super admin
___________
0 unlock
1 lock

To run the FAQ project:

1. git clone https://github.com/ra256/faq.git
2. CD into FAQ and run composer install
3. cp .env.example to .env
4. setup database / with sqlite or other (https://laravel.com/docs/5.6/database)

