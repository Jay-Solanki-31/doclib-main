
## Author
    KIPERE EMMANUEL PETER
    emmanuel.kipere@brandtechug.com

## Configuration

- Extract the **doclib.zip** file into your Document Root folder i.e. **C:\xampp\htdocs**. 

- Create a database your are to use for the project e.g **lib_db**

- Create an .env file by copying the .env.example
    > **[HINT]**
        > Using Git Bash or Terminal: cd into directory `C:\xampp\htdocs\doclib` and use the command `cp .env.example .env`

- In the .env modify the following lines

    **APP_NAME='Doc Lib**

    
    **DB_DATABASE=lib_db**

    **DB_USERNAME=root**

    **DB_PASSWORD=**

- Create your application key
    > **[HINT]**
        > Using Git Bash or Terminal: cd into directory `C:\xampp\htdocs\doclib` and use the command `php artisan key:generate`

- Run the migrations and seeds to populate your database using the following commands
    `php artisan migrate`

    `php artisan db:seed`

- After running migrations, 1 user account will be created in your database

    FirstName   | SecondName | email                   | RoleName      | Password   | Email verified

    +-----------+------------+-------------------------+-------------------------------------+

    | Admin     | Sudo       | admin@example.com       | Administrator | admin@123  | YES

- Run the application by entering the command below
    > **[HINT]**
        > Using Git Bash or Terminal: cd into directory `C:\xampp\htdocs\doclib]` and use the command `php artisan serve`

    - Laravel development server started: `<http://127.0.0.1:8000>` will be shown, copy the http link and paste it in your browser.

- Routes
    1. **Admin/Librarian Login http://127.0.0.1:8000/login**
    2. **Teacher Login http://127.0.0.1:8000/login/tacher**
    3. **Student Login http://127.0.0.1:8000/login/student**

- User Login Information

    Email : **admin@example.com**
    
    Password : **admin@123**