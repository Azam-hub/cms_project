<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\RosterController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\UserStudentController;
use App\Http\Middleware\CheckForCreditLine;
use App\Http\Middleware\ValidAdmin;
use App\Http\Middleware\ValidUser;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware([ValidUser::class . ":student", CheckForCreditLine::class])->group(function () {

    // Route::get('/', [UserStudentController::class, 'fetch_single_student'])->name('student.home');

    // Route::get('/announcement', [UserStudentController::class, 'announcement'])->name('student.announcement');

    Route::get('/', [UserStudentController::class, 'announcement'])->name('student.home');

    Route::get('/profile', [UserStudentController::class, 'fetch_single_student'])->name('student.profile');

    Route::get('/attendance', [UserStudentController::class, 'attendance'])->name('student.attendance');
    
    Route::get('/fees', [UserStudentController::class, 'fees_record'])->name('student.fees_record');

    Route::get('/assessment', [UserStudentController::class, 'assessment'])->name('student.assessment');
    Route::post('/assessment/questions_fetcher', [UserStudentController::class, 'questions_fetcher'])->name('student.questions_fetcher');
    Route::post('/assessment/answer_checker', [UserStudentController::class, 'answer_checker'])->name('student.answer_checker');

    Route::get('/results', [UserStudentController::class, 'results'])->name("student.results");    

    Route::get('/about_dev', [AboutController::class, 'student_about'])->name('student.about');

    
});


Route::middleware([ValidUser::class . ":admin,super_admin", CheckForCreditLine::class])->prefix('admin')->group(function () {

    Route::get('/about_dev', [AboutController::class, 'admin_about'])->name('admin_panel.about');

    
    Route::middleware([ValidAdmin::class])->group(function () {
        /* Home */
        Route::get('/', [AdminHomeController::class, "index"])->name('admin_panel.home');

        /* Admins */
        Route::get('/admins', [AdminController::class, "index"])->name("admin_panel.admins");
        Route::post('/admins/process_addAdmin', [AdminController::class, "process_addAdmin"])->name("admin_panel.process_addAdmin");
        Route::post('/admins/process_editAdmin', [AdminController::class, "process_editAdmin"])->name("admin_panel.process_editAdmin");
        Route::get('/admins/process_destroyAdmin/{id}', [AdminController::class, "process_destroyAdmin"])->name("admin_panel.process_destroyAdmin");
        
        /* Announcement */
        Route::get('/announcements', [AnnouncementController::class, 'index'])->name('admin_panel.announcements');
        Route::post('/announcements/process_addAnnouncement', [AnnouncementController::class, 'process_addAnnouncement'])->name("admin_panel.process_addAnnouncement");
        Route::post('/announcements/process_editAnnouncement', [AnnouncementController::class, 'process_editAnnouncement'])->name("admin_panel.process_editAnnouncement");
        Route::get('/announcements/process_destroyAnnouncement/{id}', [AnnouncementController::class, 'process_destroyAnnouncement'])->name("admin_panel.process_destroyAnnouncement");

        /* Rosters */
        Route::get('/rosters', [RosterController::class, "rosters"])->name("admin_panel.rosters");
        Route::get('/rosters/{id}', [RosterController::class, "single_admin_roster"])->name("admin_panel.single_admin_roster");
        Route::post('/rosters/process_addRoster', [RosterController::class, 'process_addRoster'])->name("admin_panel.process_addRoster");
        Route::post('/rosters/process_editRoster', [RosterController::class, 'process_editRoster'])->name("admin_panel.process_editRoster");
        Route::get('/rosters/process_destroyRoster/{id}', [RosterController::class, 'process_destroyRoster'])->name("admin_panel.process_destroyRoster");

        /* Rooms */
        Route::get('/rooms', [RoomController::class, 'index'])->name('admin_panel.rooms');
        Route::post('/rooms/process_addRoom', [RoomController::class, 'process_addRoom'])->name("admin_panel.process_addRoom");
        Route::post('/rooms/process_editRoom', [RoomController::class, 'process_editRoom'])->name("admin_panel.process_editRoom");
        Route::get('/rooms/process_destroyRoom/{id}', [RoomController::class, 'process_destroyRoom'])->name("admin_panel.process_destroyRoom");
        
        /* Courses */
        Route::get('/courses', [CourseController::class, 'index'])->name('admin_panel.courses');
        Route::post('/courses/process_addCourse', [CourseController::class, 'process_addCourse'])->name("admin_panel.process_addCourse");
        Route::post('/courses/process_editCourse', [CourseController::class, 'process_editCourse'])->name("admin_panel.process_editCourse");
        Route::get('/courses/process_destroyCourse/{id}', [CourseController::class, 'process_destroyCourse'])->name("admin_panel.process_destroyCourse");
        Route::get('/courses/process_statusChangeCourse/{id}/{action}', [CourseController::class, 'process_statusChangeCourse'])->name("admin_panel.process_statusChangeCourse");
    
        /* Students */
        Route::get('/students', [StudentController::class, 'index'])->name('admin_panel.students');
        Route::post('/students/import_students', [StudentController::class, 'import_students'])->name('admin_panel.import_students');
        Route::post('/students/process_addStudent', [StudentController::class, 'process_addStudent'])->name('admin_panel.process_addStudent');
        Route::post('/students/process_editStudent', [StudentController::class, 'process_editStudent'])->name('admin_panel.process_editStudent');
        Route::get('/students/process_destroyStudent/{id}', [StudentController::class, 'process_destroyStudent'])->name('admin_panel.process_destroyStudent');
        Route::get('/students/process_statusChangeStudent/{id}/{action}', [StudentController::class, 'process_statusChangeStudent'])->name('admin_panel.process_statusChangeStudent');
        
        /* Fees */
        Route::get('/fees', [FeesController::class, 'index'])->name('admin_panel.fees');
        Route::get('/fees/fetch_students/{room}/{timing}', [FeesController::class, 'fetch_students'])->name('admin_panel.fetch_students');
        Route::get('/fees/fetch_student_fee_record/{id}', [FeesController::class, 'fetch_student_fee_record'])->name('admin_panel.fetch_student_fee_record');
        Route::post('/fees/process_addRecord', [FeesController::class, 'process_addRecord'])->name('admin_panel.process_addRecord');
        Route::post('/fees/process_editRecord', [FeesController::class, 'process_editRecord'])->name('admin_panel.process_editRecord');
        Route::get('/fees/process_destroyRecord/{id}', [FeesController::class, 'process_destroyRecord'])->name('admin_panel.process_destroyRecord');
        Route::get('/fees/process_excludeIncludeStudent/{id}/{action}', [FeesController::class, 'process_excludeIncludeStudent'])->name('admin_panel.process_excludeIncludeStudent');

        /* Result */
        Route::get('/results', [ResultController::class, 'index'])->name('admin_panel.results');
        Route::get('/results/process_destroyResult/{id}', [ResultController::class, 'process_destroyResult'])->name('admin_panel.process_destroyResult');

        /* Attendance */
        Route::get('/attendance/past', [AttendanceController::class, 'fetch_room_record'])->name('admin_panel.attendancePast');
        Route::get('/attendance/past/fetch_students/{room}/{timing}/{date}', [AttendanceController::class, 'fetch_students'])->name('admin_panel.fetch_students');

        /* Questions */
        Route::get('/set_questions/{course_id}', [QuestionController::class, 'index'])->name('admin_panel.setQuestions');
        Route::post('/set_questions/process_addQuestion', [QuestionController::class, 'process_addQuestion'])->name('admin_panel.process_addQuestion');
        Route::post('/set_questions/process_editQuestion', [QuestionController::class, 'process_editQuestion'])->name('admin_panel.process_editQuestion');
        Route::get('/set_questions/process_destroyQuestion/{id}', [QuestionController::class, 'process_destroyQuestion'])->name('admin_panel.process_destroyQuestion');
    });


    Route::get('/single_student/{id}', [StudentController::class, 'fetch_single_student'])->name('admin_panel.fetch_single_student');
    Route::get('/module_handler/{userId}/{action}/{moduleId}', [StudentController::class, 'module_handler'])->name('admin_panel.module_handler');
    

    Route::get('/attendance/marking_attendance/{id}/{action}/{date?}', [AttendanceController::class, 'marking_attendance'])->name('admin_panel.marking_attendance');
    
    Route::get('/attendance/today', [AttendanceController::class, 'today_students'])->name('admin_panel.attendanceToday');

    Route::get('/attendance/report', [AttendanceController::class, 'fetch_room_record'])->name('admin_panel.attendanceReport');
    Route::get('/attendance/report/fetch_students/{room}/{timing}/{startDate}/{endDate}', [AttendanceController::class, 'attendance_report']);
    
});


Route::middleware([ValidUser::class . ":not_loggedin", CheckForCreditLine::class])->group(function () {

    Route::get("/login", [AccountController::class, "index"])->name("account.login");
    Route::post("/process_superAdminSignup", [AccountController::class, "process_superAdminSignup"])->name("account.process_superAdminSignup");
});

Route::post("/process_login", [AccountController::class, "process_login"])->name("account.process_login");
Route::get('/logout', [AccountController::class, "logout"])->name('account.logout');



/* 

1. web dev                                  1, 2, 3, 
2. graphics                                 1, 2, 3, 4, 5, 
3. PCIT                                     1, 2, 
4. AI graphics                              1, 2


1. A                                        
9-10||7     ,3-4||5


2. B                                        
4-5||2       ,4-5||5,   ,9-10||4


3. C                                        
3-4||5      ,9-10||4    ,4-5||19      3-4||8,       ,9-10||12   ,3-4||16


4. D    
4-5||3, 






*/