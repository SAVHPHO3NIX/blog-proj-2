
## Documentation

## GitHub Repository link
- https://github.com/SAVHPHO3NIX/blog-proj-2


## Setup and Installation
- Clone the repository or download the zip file.
- Open the project folder in your terminal.
- Run `composer install` to install all the dependencies.
- Run `npm install` to install all the dependencies.
- Run `npm run dev` to compile the assets.
- Create database on MySQL to match the.env file. (database name is `blog2db`)
- Run `php artisan migrate` to migrate the tables.
- Run `php artisan serve` to start the server.
- Open your browser and navigate to `http://127.0.0.1:8000` to see the website.
- Create a Mailtrap and update the .env file with the credentials based on your Mailtrap account (This is only needed if you intend on tesing the forgot password functionality).


# Technologies and Frameworks

This section provides an overview of the technologies and frameworks used in this blog project.

## Backend

1. **Laravel Framework 11.9.2**
2. **Laravel Breeze**

## Frontend

1. **Blade Templates**
2. **Tailwind CSS**

## JavaScript

1. **CKEditor**
- A rich text editor used for creating and editing posts.

## Database

1. **MySQL**

## Authentication and Security

1. **Email Verification and Password Reset**
- Laravel Breeze handles email verification and password reset functionalities, ensuring a secure and user-friendly authentication process.

## Miscellaneous

1. **Composer**
2. **NPM**
- A package manager for JavaScript, used to manage frontend dependencies like Tailwind CSS and CKEditor.


# How to Use the Blog Platform

This guide will walk you through the features and functionalities of the blog platform, including user registration, posting, commenting, changing password, forgot password, deleting account, and editing profile.

## Table of Contents

1. [User Registration](#user-registration)
2. [Posting](#posting)
3. [Commenting](#commenting)
4. [Changing Password](#changing-password)
5. [Forgot Password](#forgot-password)
6. [Deleting Account](#deleting-account)
7. [Editing Profile](#editing-profile)

## User Registration

To use the blog platform, you need to create an account.

1. **Go to the registration page:**

2. **Fill in the registration form:**
- Enter your name, email, password, and password confirmation.
- Click on the `Register` button.

## Posting

Once you have registered and logged in, you can create posts.

1. **Create a post:**
- Go to the feed page.
- In the "Create Post" section, enter your post content.
- (Optional) Upload an image.
- Click on the `Post` button.

2. **View all posts:**
- All posts are displayed in the feed.
- You can like or unlike posts, edit your own posts, and delete your own posts. (Deleting is done on the your post and comment pages).

## Commenting

You can comment on posts to engage with posts.

1. **Add a comment:**
- Below each post, there is a comments section.
- Enter your comment in the input box and click on the `Comment` button.

2. **View comments:**
- Comments are displayed below each post.
- You can like or unlike comments and edit or delete your own comments. (To delete your comment you need to navigate to the your comments page).

## Changing Password

To change your password:

1. **Go to the profile settings page:**

2. **Change your password:**
- Enter your current password.
- Enter your new password and confirm it.
- Click on the `Change Password` button.

## Forgot Password

If you forget your password, you can reset it.

1. **Go to the forgot password page:**
- It is found on the login page.

2. **Request a password reset link:**
- Enter your email address and submit the form.
- Check your email for a password reset link.
- Use Mailtrap (Because project is not live).

3. **Reset your password:**
- Click on the reset link in your email.
- Enter a new password and confirm it.

## Deleting Account

If you wish to delete your account:

1. **Go to the profile settings page:**

2. **Delete your account:**
- Click on the `Delete Account` button.
- Confirm the deletion. Note that this action is irreversible.

## Editing Profile

To edit your profile:

1. **Go to the profile settings page:**

2. **Edit your profile:**
- You can change your profile picture by uploading a new image.
- Edit your bio and any other personal information.
- Click on the `Save` button to update your profile.


## Database Schema
- These are all based off my migrations within the project.

### Users Table
- **id**: `unsigned big integer`, primary key, auto-increment
- **name**: `string`
- **email**: `string`, unique
- **email_verified_at**: `timestamp`, nullable
- **password**: `string`
- **remember_token**: `string`, nullable
- **created_at**: `timestamp`
- **updated_at**: `timestamp`

### Password Reset Tokens Table
- **email**: `string`, primary key
- **token**: `string`
- **created_at**: `timestamp`, nullable

### Sessions Table
- **id**: `string`, primary key
- **user_id**: `unsigned big integer`, nullable, foreign key referencing `users` table
- **ip_address**: `string`, nullable
- **user_agent**: `text`, nullable
- **payload**: `long text`
- **last_activity**: `integer`, indexed

### Posts Table
- **id**: `unsigned big integer`, primary key, auto-increment
- **user_id**: `unsigned big integer`, foreign key referencing `users` table, on delete cascade
- **content**: `string`
- **image**: `string`, nullable
- **created_at**: `timestamp`
- **updated_at**: `timestamp`

### Comments Table
- **id**: `unsigned big integer`, primary key, auto-increment
- **user_id**: `unsigned big integer`, foreign key referencing `users` table, on delete cascade
- **post_id**: `unsigned big integer`, foreign key referencing `posts` table, on delete cascade
- **content**: `text`
- **created_at**: `timestamp`
- **updated_at**: `timestamp`

### Likes Table
- **id**: `unsigned big integer`, primary key, auto-increment
- **user_id**: `unsigned big integer`, foreign key referencing `users` table, on delete cascade
- **post_id**: `unsigned big integer`, nullable, foreign key referencing `posts` table, on delete cascade
- **comment_id**: `unsigned big integer`, nullable, foreign key referencing `comments` table, on delete cascade
- **created_at**: `timestamp`
- **updated_at**: `timestamp`
- **Unique Constraints**:
  - (`user_id`, `post_id`)
  - (`user_id`, `comment_id`)

### Followers Table
- **id**: `unsigned big integer`, primary key, auto-increment
- **user_id**: `unsigned big integer`, foreign key referencing `users` table, on delete cascade
- **follower_id**: `unsigned big integer`, foreign key referencing `users` table (specifically `id`), on delete cascade
- **created_at**: `timestamp`
- **updated_at**: `timestamp`
- **Unique Constraint**: (`user_id`, `follower_id`)

### Users Table (Bio Add to Users Table)
- **bio**: `text`, nullable

### Users Table (Profile Photo Path Add to Users Table)
- **profile_photo_path**: `string`, nullable


## Resources used to build this project
- First attempt at the project which was build with the playlist found here: https://www.youtube.com/watch?v=iniIUcAKuLA&list=PLqDySLfPKRn5d7WbN9R0yJA9IRgx-XBlU&pp=iAQB
- Mailtrap set-up: https://youtu.be/gFDTHSQ-Um0?si=OTYK2iuiofRqTK55
- AI for debugging and examples on how to do certain functions and how to build onto the blade layout provided by Laravel.




<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
