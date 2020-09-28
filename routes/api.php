<?php

Route::post('notifications/{id}','NotificationController@index');
Route::post('markAsRead/{id}','NotificationController@markAsRead');
Route::get('/role','ApiRoleController@index')->name('role');
Route::get('/information/{id}','ApiUserController@index');
Route::get('/request_user','ApiUserController@request_user');
Route::get('/auth_class/{id}','ApiUserController@authenticateUserClassSubject');
Route::post('/student/assign_c_s/{id}','ApiUserController@assign_student');
Route::post('/unassaign_student/{user_id}/{class_id}','ApiUserController@remove_student');
Route::post('/teacher/assign_c_s/{id}','ApiUserController@assign_teacher');
Route::post('/all/students/assign','ApiUserController@assign_allStudent');
Route::patch('/user/accept_user/{id}','ApiUserController@accept_user');
Route::delete('/user/delete_user/{id}','ApiUserController@delete_user');
Route::get('/user/student_user','ApiUserController@student_user');
Route::get('/user/teacher_user','ApiUserController@teacher_user');
Route::get('/user/admin_user','ApiUserController@admin_user');
Route::put('/information/{id}','ApiUserController@update');
Route::post('/create/student','ApiUserController@CreateStudent');
Route::post('/create/teacher','ApiUserController@CreateTeacher');
Route::post('/create/admin','ApiUserController@CreateAdmin');
Route::post('/class/routine/{id}','classRoutineController@CreateEvent');
Route::get('/class/routine/getroutine/{id}','classRoutineController@getEvent');

Route::delete('/class/routine/delete/{id}','classRoutineController@DeleteEvent');
Route::Resource('announcement', 'AnnouncementController');
Route::Resource('class/assignment','AssaignmentController');
Route::Resource('class','LmsclassController');
Route::get('class/user/{id}','LmsclassController@user');
Route::get('class/all/all','LmsclassController@allClass');
Route::Resource('material','MaterialController');
Route::get('material/single/{id}','MaterialController@material');
Route::get('class/about/{name}','LmsclassController@information');
Route::Resource('/class/exam/exam','ExamController');
Route::patch('/class/exam/{exam}','ExamController@StartExam');
Route::patch('/class/exam/stop/{exam}','ExamController@StopExam');
Route::Post('/class/exam/exam_done/{exam}','ExamController@user_examDone');
Route::patch('/class/exam/updating_Examuser/{exam}','ExamController@updating_Examuser');
Route::patch('/class/end_exam/{exam}','ExamController@EndExam');
Route::Post('/class/exam/question/{class}','ExamController@QuestionCreate');
Route::Post('/class/exam/answer/{class}','ExamController@AnswerCreate');
Route::patch('/class/exam/marks/{mark}','ExamController@Marks_update');
Route::Resource('allevent','AlleventController');
Route::Resource('class/event','LmsClassEventController');
Route::Resource('class-head','ClassHeadController');
Route::post('/user/class-head/{id}','ClassHeadController@detachingUser');
Route::get('/getting/all/subject/{name}','LmsclassController@gettingSubject');
Route::post('reset-password', 'AuthmailController@sendPasswordResetLink');
Route::post('reset/password', 'AuthController@callResetPassword');




Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('signup', 'AuthController@signup');

});

