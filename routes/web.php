<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\Employee\EmployeeRegController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\DesignationController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Student\ExamfeeController;
use App\Http\Controllers\Backend\Student\Monthlyfeecontroller;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use App\Http\Controllers\Backend\Student\StudentRegController;
use App\Http\Controllers\Backend\Student\StudentRollGenerateController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend;
use App\Models\Designation;
use App\Models\EmployeeLeave;
use App\Models\FeeCategoryAmount;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'logout')->name('admin.logout');
});



Route::group(['middleware' => 'auth'], function () {

    //User
    Route::prefix('users')->group(function () {
        Route::get('/view', [UserController::class, 'userview'])->name('user.view');
        Route::get('/add/user', [UserController::class, 'adduser'])->name('add.user');
        Route::post('/store/user', [UserController::class, 'storeuser'])->name('store.user');
        Route::get('/edit/{id}', [UserController::class, 'edituser'])->name('edit.user');
        Route::post('/update/{id}', [UserController::class, 'updateuser'])->name('update.user');
        Route::get('/delete/{id}', [UserController::class, 'deleteuser'])->name('delete.user');
    });

    //User Profile
    Route::prefix('profile')->group(function () {
        Route::get('/view', [ProfileController::class, 'profileview'])->name('profile.view');
        Route::get('/edit', [ProfileController::class, 'profileedit'])->name('edit.profile');
        Route::post('/store', [ProfileController::class, 'profilestore'])->name('profile.store');
        Route::get('/profile/password/change', [ProfileController::class, 'passwordchange'])->name('profile.password.change');
        Route::post('/update/password', [ProfileController::class, 'updatepassword'])->name('update.password');
    });

    //Setup Management
    Route::prefix('setups')->group(function () {
        //Student Class
        Route::get('/student/class/view', [StudentClassController::class, 'studentclassview'])->name('student.class.view');
        Route::get('/student/class/add', [StudentClassController::class, 'studentclassadd'])->name('student.class.add');
        Route::post('/student/class/store', [StudentClassController::class, 'studentclassstore'])->name('student.class.store');
        Route::get('/student/class/edit/{id}', [StudentClassController::class, 'studentclassedit'])->name('student.class.edit');
        Route::post('/student/class/update/{id}', [StudentClassController::class, 'studentclassupdate'])->name('student.class.update');
        Route::get('/student/class/delete/{id}', [StudentClassController::class, 'studentclassdelete'])->name('student.class.delete');

        //Student Year
        Route::get('/student/year/view', [StudentYearController::class, 'studentyearview'])->name('student.year.view');
        Route::get('/student/year/add', [StudentYearController::class, 'studentyearadd'])->name('student.year.add');
        Route::post('/student/year/store', [StudentYearController::class, 'studentyearstore'])->name('student.year.store');
        Route::get('/student/year/edit/{id}', [StudentYearController::class, 'studentyearedit'])->name('student.year.edit');
        Route::post('/student/year/update/{id}', [StudentYearController::class, 'studentyearupdate'])->name('student.year.update');
        Route::get('/student/year/delete/{id}', [StudentYearController::class, 'studentyeardelete'])->name('student.year.delete');

        //Student Group
        Route::get('/student/group/show', [StudentGroupController::class, 'studentgroupshow'])->name('student.group.show');
        Route::get('/student/group/add', [StudentGroupController::class, 'studentgroupadd'])->name('student.group.add');
        Route::post('/student/group/store', [StudentGroupController::class, 'studentgroupstore'])->name('student.group.store');
        Route::get('/student/group/edit/{id}', [StudentGroupController::class, 'studentgroupedit'])->name('student.group.edit');
        Route::post('/student/group/update/{id}', [StudentGroupController::class, 'studentgroupupdate'])->name('student.group.update');
        Route::get('/student/group/delete/{id}', [StudentGroupController::class, 'studentgroupdelete'])->name('student.group.delete');

        //Student Shift
        Route::get('student/shift/show', [StudentShiftController::class, 'studentshiftshow'])->name('student.shift.show');
        Route::get('/student/shift/add', [StudentShiftController::class, 'studentshiftadd'])->name('student.shift.add');
        Route::post('student/shift/store', [StudentShiftController::class, 'studentshiftstore'])->name('student.shift.store');
        Route::get('/student/shift/wdit/{id}', [StudentShiftController::class, 'studentshiftedit'])->name('student.shift.edit');
        Route::post('/student/shift/update/{id}', [StudentShiftController::class, 'studentshiftupdate'])->name('student.shift.update');
        Route::get('/student/shift/delete/{id}', [StudentShiftController::class, 'studentshiftdelete'])->name('student.shift.delete');

        //Fee Category
        Route::get('/fee/category/show', [FeeCategoryController::class, 'feecategoryshow'])->name('fee.category.show');
        Route::get('/fee/category/add', [FeeCategoryController::class, 'feecategoryadd'])->name('fee.category.add');
        Route::post('/fee/category/store', [FeeCategoryController::class, 'feecategorystore'])->name('fee.category.store');
        Route::get('/fee/category/edit/{id}', [FeeCategoryController::class, 'feecategoryedit'])->name('fee.category.edit');
        Route::post('/fee/category/update/{id}', [FeeCategoryController::class, 'feecategoryupdate'])->name('fee.category.update');
        Route::get('/fee/category/delete/{id}', [FeeCategoryController::class, 'feecategorydelete'])->name('fee.category.delete');

        //Fee Amount
        Route::get('/fee/amount/show', [FeeAmountController::class, 'feeamountshow'])->name('fee.amount.show');
        Route::get('/fee/amount/add', [FeeAmountController::class, 'feeamountadd'])->name('fee.amount.add');
        Route::post('/fee/amount/store', [FeeAmountController::class, 'feeamountstore'])->name('fee.amount.store');
        Route::get('/fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'feeamountedit'])->name('fee.amount.edit');
        Route::post('/fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'feeamountupdate'])->name('fee.amount.update');
        Route::get('/fee/amount/details/{fee_category_id}', [FeeAmountController::class, 'feeamountdetails'])->name('fee.amount.details');

        //Exam Type
        Route::get('/exam/type/show', [ExamTypeController::class, 'examtypeshow'])->name('exam.type.show');
        Route::get('/exam/type/add', [ExamTypeController::class, 'examtypeadd'])->name('exam.type.add');
        Route::post('/exam/type/store', [ExamTypeController::class, 'examtypestore'])->name('exam.type.store');
        Route::get('/exam/type/edit/{id}', [ExamTypeController::class, 'examtypeedit'])->name('exam.type.edit');
        Route::post('/exam/type/update/{id}', [ExamTypeController::class, 'examtypeupdate'])->name('exam.type.update');
        Route::get('/exam/type/delete/{id}', [ExamTypeController::class, 'examtypedelete'])->name('exam.type.delete');

        //School Subject
        Route::get('/school/subject/show', [SchoolSubjectController::class, 'schoolsubjectshow'])->name('school.subject.show');
        Route::get('/school/subject/add', [SchoolSubjectController::class, 'schoolsubjectadd'])->name('school.subject.add');
        Route::post('/school/subject/store', [SchoolSubjectController::class, 'schoolsubjectstore'])->name('school.subject.store');
        Route::get('/school/subject/edit/{id}', [SchoolSubjectController::class, 'schoolsubjectedit'])->name('school.subject.edit');
        Route::post('/school/subject/update/{id}', [SchoolSubjectController::class, 'schoolsubjectupdate'])->name('school.subject.update');
        Route::get('/school/subject/delete/{id}', [SchoolSubjectController::class, 'schoolsubjectdelete'])->name('school.subject.delete');

        //Assign subject
        Route::get('/assign/subject/show', [AssignSubjectController::class, 'assignsubjectshow'])->name('assign.subject.show');
        Route::get('/assign/subject/add', [AssignSubjectController::class, 'assignsubjectadd'])->name('assign.subject.add');
        Route::post('/assign/subject/store', [AssignSubjectController::class, 'assignsubjectstore'])->name('assign.subject.store');
        Route::get('/assign/subject/edit/{class_id}', [AssignSubjectController::class, 'assignsubjectedit'])->name('assign.subject.edit');
        Route::post('/assign/subject/update/{class_id}', [AssignSubjectController::class, 'assignsubjectupdate'])->name('assign.subject.update');
        Route::get('/assign/subject/detail/{class_id}', [AssignSubjectController::class, 'assignsubjectdetail'])->name('assign.subject.detail');

        //Designation
        Route::get('/designation/show', [DesignationController::class, 'designationshow'])->name('designation.show');
        Route::get('/designation/add', [DesignationController::class, 'designationadd'])->name('designation.add');
        Route::post('/designation/store', [DesignationController::class, 'designationstore'])->name('designation.store');
        Route::get('/designation/edit/{id}', [DesignationController::class, 'designationedit'])->name('designation.edit');
        Route::post('/designation/update/{id}', [DesignationController::class, 'designationupdate'])->name('designation.update');
        Route::get('/designation/delete/{id}', [DesignationController::class, 'designationdelete'])->name('designation.delete');
    });

    //Student Management
    Route::prefix('students')->group(function () {
        Route::get('/registration/view', [StudentRegController::class, 'studentregistrationview'])->name('student.registration.view');
        Route::get('/registration/add', [StudentRegController::class, 'studentregistrationadd'])->name('student.registration.add');
        Route::post('/store/registration', [StudentRegController::class, 'storestudentregistration'])->name('store.student.registration');
        Route::get('/register/year/class', [StudentRegController::class, 'studentyearclass'])->name('student.year.class');
        Route::get('/registration/edit/{student_id}', [StudentRegController::class, 'studentregistrationedit'])->name('student.registration.edit');
        Route::post('/registration/update/{student_id}', [StudentRegController::class, 'studentregistrationupdate'])->name('student.registration.update');
        Route::get('/registration/promotion/{student_id}', [StudentRegController::class, 'studentregistrationpromotion'])->name('student.registration.promotion');
        Route::post('/promotion/update/{student_id}', [StudentRegController::class, 'studentpromotionupdate'])->name('student.promotion.update');
        Route::get('/registration/pdf/{student_id}', [StudentRegController::class, 'studentregistrationpdf'])->name('student.registration.pdf');

        //Student Roll Generate Route
        Route::get('/roll/generate/view', [StudentRollGenerateController::class, 'studentrollgenerateview'])->name('student.roll.generate.view');
        Route::get('/registration/getstudents', [StudentRollGenerateController::class, 'getstudents'])->name('student.registration.getstudents');
        Route::post('/roll/store', [StudentRollGenerateController::class, 'rollstore'])->name('student.roll.store');


        //Student Registration Fee
        Route::get('/reg/fee/view', [RegistrationFeeController::class, 'regfeeview'])->name('student.reg.fee.view');
        Route::get('/registration/fee/classwise', [RegistrationFeeController::class, 'regfeeclasswise'])->name('student.registration.fee.classwise.get');
        Route::get('/registration/fee/payslip', [RegistrationFeeController::class, 'payslip'])->name('student.registration.fee.payslip');

        //Student Monthly Fee
        Route::get('/monthly/fee/view', [Monthlyfeecontroller::class, 'monthlyfeeview'])->name('student.monthly.fee.view');
        Route::get('/monthly/fee/classwise', [Monthlyfeecontroller::class, 'monthlyfeeclasswise'])->name('student.monthly.fee.classwise.get');
        Route::get('/monthly/fee/payslip', [Monthlyfeecontroller::class, 'monthlyfeepayslip'])->name('student.monthly.fee.payslip');

        //Student Exam Fee
        Route::get('/exam/fee/view', [ExamfeeController::class, 'examfeeview'])->name('student.exam.fee.view');
        Route::get('/exam/fee/classwise', [ExamfeeController::class, 'examfeeclasswise'])->name('student.exam.fee.classwise.get');
        Route::get('/exam/fee/payslip', [ExamfeeController::class, 'examfeepayslip'])->name('student.exam.fee.payslip');
    });

    //Employee Management
    Route::prefix('employees')->group(function () {
        //Employee Registration
        Route::get('/registration/view', [EmployeeRegController::class, 'employeeview'])->name('employee.registration.view');
        Route::get('/registration/add', [EmployeeRegController::class, 'employeeregistrationadd'])->name('employee.registration.add');
        Route::post('/registration/store', [EmployeeRegController::class, 'employeeregistrationstore'])->name('employee.registration.store');
        Route::get('/registration/edit/{id}', [EmployeeRegController::class, 'employeeregistrationedit'])->name('employee.registration.edit');
        Route::post('/registration/update/{id}', [EmployeeRegController::class, 'employeeregistrationupdate'])->name('employee.registration.update');
        Route::get('/registration/details/{id}', [EmployeeRegController::class, 'employeeregistrationdetails'])->name('employee.registration.details');

        //Employee Salary
        Route::get('/salary/view', [EmployeeSalaryController::class, 'employeesalaryview'])->name('employee.salary.view');
        Route::get('/salary/increment/{id}', [EmployeeSalaryController::class, 'employeesalaryincrement'])->name('employee.salary.increment');
        Route::post('/salary/increment/update/{id}', [EmployeeSalaryController::class, 'employeesalaryincrementupdate'])->name('employee.salary.increment.update');
        Route::get('/salary/details/{id}', [EmployeeSalaryController::class, 'employeesalarydetails'])->name('employee.salary.details');

        //Employee Leave
        Route::get('/leave/view', [EmployeeLeaveController::class, 'employeeleaveview'])->name('employee.leave.view');
        Route::get('/add/leave', [EmployeeLeaveController::class, 'addemployeeleave'])->name('add.employee.leave');
        Route::post('/leave/store', [EmployeeLeaveController::class, 'employeeleavestore'])->name('employee.leave.store');
        Route::get('/leave/edit/{id}', [EmployeeLeaveController::class, 'employeeleaveedit'])->name('employee.leave.edit');
        Route::post('/leave/update/{id}', [EmployeeLeaveController::class, 'employeeleaveupdate'])->name('employee.leave.update');
        Route::get('/leave/delete/{id}', [EmployeeLeaveController::class, 'employeeleavedelete'])->name('employee.leave.delete');
    });
});
