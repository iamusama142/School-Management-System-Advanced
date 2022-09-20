<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StddataController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\DateSheetController;
use App\Http\Controllers\passoutContoller;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\StudentPromotionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TimeTableController;

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

// Main Index Route
Route::get('/', function () {
    return view('index');
});

Route::get('index', function () {
    return view('index');
});


Route::get('studentdata', function () {
    return view('studentdata');
});

Route::get('auth-login', function () {
    return view('auth-login');
});





Route::post('edit/{eid}',[StddataController::class,'edit']);

Route::get('job',[StddataController::class,'getjob']);


// Student Form Route
Route::get('/student-form', function () {
    return view('student-form');
});

// Route for Update Data
Route::Post('/student/update',[StudentController::class,'student_update']);
// Route for Update Data
Route::get('/student/fetchallStd',[StudentController::class,'fetchallStd']);











// Route to show parents dropdown on Student View
Route::get('/parents-dropdown',[StudentController::class,'parent_dropdown']);
// Route to show program dropdown on Student View
Route::get('/programs-dropdown',[StudentController::class,'program_dropdown']);
// Route to show classes dropdown on Student View
Route::post('/classes-dropdown',[StudentController::class,'classes_dropdown']);
// Route to show section dropdown on Student View
Route::post('/sections-dropdown',[StudentController::class,'sections_dropdown']);
// Route to show roll no dropdown on Student View
Route::post('/rolls-dropdown',[StudentController::class,'roll_dropdown']);
// Route to Insert Data into DataBase
Route::post('student-insert',[StudentController::class,'student_insert']);
// Student DataTable Route with data shows
Route::get('datatables',[StudentController::class,'Fetchall_std']);
// Student datashow on to update in db
Route::get('/students/edit',[StudentController::class,'student_edit']);





//Parents form Route
Route::get('parents-advanced-form', function () {
    return view('parents-advanced-form');
});
// parrents Insert Route
Route::post('parents-insert',[ParentsController::class,'parent_insert']);
// Parent Checking duplication Route WHile insertion
Route::post('parents-insert-duplicate-phone',[ParentsController::class,'duplicate_phone_insertion']);
Route::post('parents-insert-duplicate-email',[ParentsController::class,'duplicate_email_insertion']);
Route::post('parents-insert-duplicate-cnic',[ParentsController::class,'duplicate_cnic_insertion']);
// Parent Checking duplication Route WHile Updation
Route::post('parents-update-duplicate-phone',[ParentsController::class,'duplicate_phone_updation']);
Route::post('parents-update-duplicate-email',[ParentsController::class,'duplicate_email_updation']);
Route::post('parents-update-duplicate-cnic',[ParentsController::class,'duplicate_cnic_updation']);
// populate-parents
Route::get('/fetchall-parents',[ParentsController::class,'fetchall']);
// Parents View populate-months-fee
Route::get('/fetchall-months',[ParentsController::class,'fetchall_months_fee']);
// parrents DataTable Route with data shows
Route::get('parents-datatables',function(){
    return view('parents_datatable');
});
// parrents Route with data shows on update bs4 modal
Route::get('/parent-edit', [ParentsController::class, 'edit']);
// parent  Route to update parents data
Route::post('/parent-update', [ParentsController::class, 'parent_update']);
//parent  Route downlaod  fee voucher to
Route::get('voucher/{id}', [PDFController::class, 'generatePDF']);
// parent  Route to Pay-collect fees
Route::post('/collect-fees', [ParentsController::class, 'collect_fees']);
// parent  Route to Pay-collect fees
Route::get('/collected-fee-voucher/{id}', [ParentsController::class, 'collected_fee_voucnher']);







// Program  view
Route::get('/program', function () {
    return view('program');
});
// Program Insert Route
Route::post('/program-insert',[ProgramController::class,'program_insert']);
// populate-Programs
Route::get('/fetchall-programs',[ProgramController::class,'FetchAll']);
// Program  Route with data shows on update bs4 modal
Route::get('/program-edit', [ProgramController::class, 'edit']);
// Program  Route to update programs
Route::post('/program-update', [ProgramController::class, 'parent_update']);




// Classes  view
Route::get('/class', function () {
    return view('classes');
});
// Class Insert Route
Route::post('/class-insert',[ClassesController::class,'classes_insert']);
// populate-Class
Route::get('/fetchall-class',[ClassesController::class,'FetchAll']);
// class  Route with data shows on update bs4 modal
Route::get('/class-edit', [ClassesController::class, 'edit']);
// class  Route to update classes data
Route::post('/class-update', [ClassesController::class, 'classes_update']);
// populate- program dropdown in Class view
Route::get('/fetch-programs',[ClassesController::class,'fetch_programs']);





//section
// Section  view
Route::get('/section', function () {
    return view('section');
});
// Class Insert Route
Route::post('/section-insert',[SectionController::class,'section_insert']);
// populate-Class
Route::get('/fetchall-section',[SectionController::class,'FetchAll']);
// class  Route with data shows on update bs4 modal
Route::get('/section-edit', [ClassesController::class, 'edit']);
// class  Route to update classes data
Route::post('/sections/update', [SectionController::class, 'sections_update']);
// populate- program dropdown in Class view
Route::get('/fetch_classes',[SectionController::class,'fetch_classes']);
// section record edit show on modal
Route::get('/sections/edit',[SectionController::class,'sections_edit']);








//Subjects
// subjects View
Route::get('/subjects', function () {
    return view('subjects');
});
// subjects Route to show section dropdown
Route::post('/subjects/sections-dropdown',[SubjectController::class,'sections_dropdown']);
// subjects populate- program dropdown
Route::get('/subjects/fetch_classes',[SubjectController::class,'fetch_classes']);
// Subject Insert Route
Route::post('/subject-insert',[SubjectController::class,'subject_insert']);
// subjects populate- program dropdown
Route::get('/subjects/fetchAllsubjects',[SubjectController::class,'fetchAllsubjects']);
//Subjects show the record on modal
Route::get('/subjects/edit',[SubjectController::class,'subject_edit']);
//Subjects update record in database
Route::post('/subjects/update',[SubjectController::class,'subject_update']);







// DateSheet
// DateSheet  view
Route::get('/datesheet-form', function () {
    return view('Datesheet-form');
});
// Datesheet Route to show section dropdown
Route::post('/dateSheet/sections-dropdown',[DateSheetController::class,'sections_dropdown']);
// DateSheet populate- classes dropdown
Route::get('/dateSheet/fetch_classes',[DateSheetController::class,'fetch_classes']);
//DateSheet subjects populate- /subjects-dropdown dropdown
Route::post('/dateSheet/subjects-dropdown',[DateSheetController::class,'fetch_subjects']);
// DateSheet Rows populate on table
Route::get('/dateSheet/rows',[DateSheetController::class,'table_rows_count']);
// DateSheet Insert into DB
Route::post('/datesheet-insert',[DateSheetController::class,'datesheet_insert']);
// DateSheet PDF
Route::get('/dateSheet/PDF/{id}',[PDFController::class,'datesheet']);

// DateSheet datatable
Route::get('/dateSheet-datatable',[DateSheetController::class,'dateSheet_datatable']);
// DateSheet datatable Fetchall
Route::get('/datesheet/fetchAll',[DateSheetController::class,'FecthalldateSheet']);





// Promotion
// Promotion  view
Route::get('/promote-student', function () {
    return view('/promotion-student-form');
});
// Promotion populate- classes dropdown
Route::get('/promote/fetch_classes',[StudentPromotionController::class,'fetch_classes']);
//Promotion insert Promotions
Route::POST('/promote/promote',[StudentPromotionController::class,'promote']);








//Time Table
// timetable  view
Route::get('/timetable', function () {
    return view('/timeTable-form');
});
//timetable  get subjects by class id
Route::post('/timetable/subjects-dropdown',[TimeTableController::class,'fetch_subjects_dropdown']);
// timetable Rows populate on table
Route::get('/timetable/rows',[TimeTableController::class,'table_rows_count']);
// timetable Insert into DB
Route::post('/timetable/insert',[TimeTableController::class,'timetable_insert']);
// timetable PDF
Route::get('/timetable/PDF/{id}',[PDFController::class,'timetable']);
// timetable datatable
Route::get('/timetable-datatable',[TimeTableController::class,'timetable_datatable']);
// timetable datatable Fetchall
Route::get('/timetable/fetchAll',[TimeTableController::class,'Fecthalltimetable']);



//Passout Student
// passoutstudnets  view
Route::get('/passoutstudent', function () {
    return view('passout-students-form');
});
//Passout insert Passing out student
Route::POST('/passoutstudent/pasout',[passoutContoller::class,'passout']);
