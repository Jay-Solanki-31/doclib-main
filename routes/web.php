<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/login/teacher', 'Auth\LoginController@showTeacherLoginForm')->name('login.teacher');
Route::get('/login/student', 'Auth\LoginController@showStudentLoginForm')->name('login.student');
Route::get('/login/librarian', 'Auth\RegisterController@showLibrarianLoginForm')->name('login.librarian');


Route::post('/login/teacher', 'Auth\LoginController@teacherLogin');
Route::post('/login/student', 'Auth\LoginController@studentLogin');
Route::post('/login/librarian', 'Auth\LoginController@librarianLogin');

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/home', 'HomeController@home')->name('test');

// Post
Route::post('/staff/change-password', 'UsersController@postChangePassword')->name('user.postchangePassword');

// Get
Route::get('/staff/change-password', 'UsersController@getChangePassword')->name('user.changePassword');

// Route::group(['middleware' => 'auth'], function(){
//         //Administrator MiddleWare
//         Route::group(['middleware' => 'admin'], function(){
            // POST
            Route::post('/staff/{staff}/restore', 'UsersController@restore')->name('restore_user');
            // GET

            // PATCH / PUT,
            Route::put('/staff/block/{obfuscator}/asuser/{firstname}-{lastname}', 'UsersController@block_user')->name('block_user');
            Route::patch('/staff/unblock/{obfuscator}/foruser/{firstname}-{lastname}', 'UsersController@unblock_user')->name('unblock_user');

            // DELETE
            Route::delete('/staff/{staff}/remove_user_account', 'UsersController@permanentely_delete')->name('remove_user');

            // Reosurce
            Route::resource('titles', 'TitlesController');
            Route::resource('user-roles', 'UserRolesController');
            Route::resource('staff', 'UsersController');
            Route::resource('schools', 'SchoolsController');
            Route::resource('books', 'BooksController');
            Route::resource('teachers', 'TeachersController');
            Route::resource('students', 'StudentsController');
            Route::resource('book-types', 'BookTypesController');
            Route::resource('classes', 'ClassesController');
            Route::resource('departments', 'DepartmentsController');
            Route::resource('library', 'LibDirectoriesController');
            Route::resource('files', 'LibFilesController');
            Route::resource('tenders_docs', 'TendersFilesController');
            Route::resource('lib_files', 'LibFilesController');
            Route::resource('dirs', 'LibSubDirectoriesController');
            Route::resource('dir_files', 'LibSubDirFilesController');
        // });

        // //librarian MiddleWare
        // Route::group(['middleware' => 'librarian'], function(){
            
            // Post

            // Route::resource('staff', 'UsersController');

            // Route::resource('classes', 'ClassesController')->except(['delete']);
            // Route::resource('schools', 'SchoolsController')->only(['index', 'show']);
            // Route::resource('books', 'BooksController');
            // Route::resource('teachers', 'TeachersController')->only(['index', 'show']);
            // Route::resource('students', 'StudentsController');
            // Route::resource('book-types', 'BookTypesController');
            // Route::resource('library', 'LibDirectoriesController');
            // Route::resource('files', 'LibFilesController');
            // Route::resource('lib_files', 'LibFilesController');
            // Route::resource('dirs', 'LibSubDirectoriesController');
            // Route::resource('dir_files', 'LibSubDirFilesController');
        // });


// });

Route::get('/starter', 'SeshTeachersController@startup_page')->middleware(['teacher']);
Route::get('/student-homepage', 'SeshStudentsController@startup_page')->middleware(['student']);
Route::get('/books-page', 'HomeController@books_page')->name('start.books');
Route::get('books-list-type/{typeID}', 'SeshStudentsController@get_book_type')->name('get.books-type');

Route::group(['middleware' => 'student'], function (){
    // Get
    Route::get('books-list', 'SeshStudentsController@list_books')->name('student.books');
});

Route::group(['middleware' => 'teacher'], function(){
    // Get
    Route::get('insert-book', 'SeshTeachersController@insert_books')->name('teacher.insert_book');

    // Post
    Route::post('insert-book', 'SeshTeachersController@post_insert_books')->name('teacher.insert_book');

    Route::get('book-list', 'SeshTeachersController@list_books')->name('teacher.books');
});