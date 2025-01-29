<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminPanelSettingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\FinanceCalendersController;
use App\Http\Controllers\Admin\BranchesController;
use App\Http\Controllers\Admin\DailyReportController;
use App\Http\Controllers\Admin\DailyReporyController;
use App\Http\Controllers\Admin\ShiftsTypesController;
use App\Http\Controllers\Admin\DepartementsController;
use App\Http\Controllers\Admin\JobsCategoriesController;;
 
use App\Http\Controllers\Admin\QualificationsController;
use App\Http\Controllers\Admin\OccasionsController;
use App\Http\Controllers\Admin\ResignationsController;
use App\Http\Controllers\Admin\NationalitiesController;
use App\Http\Controllers\Admin\ReligionController;
use App\Http\Controllers\Admin\EmployeesController;
use App\Http\Controllers\Admin\financialController;
use App\Http\Controllers\Admin\GovernmentProcessController;
use App\Http\Controllers\Admin\HousingController;
use App\Http\Controllers\Admin\HumanResourceController;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\Admin\MarketingController;
use App\Http\Controllers\Admin\OperationController;
use App\Http\Controllers\Admin\PermissionMainMenuesController;
use App\Http\Controllers\Admin\PermissionRolesController;
use App\Http\Controllers\Admin\PermissionSubMenuesController;
use App\Http\Controllers\Admin\QualityController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\SecurityGuardController;
use App\Http\Controllers\Admin\SubjectsController;
use App\Http\Controllers\Admin\TheLegalController;
use App\Http\Controllers\Admin\TrainingController;
use App\Http\Controllers\Admin\UniformController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Middleware\languageConverter;

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




//define('PC', 11);

if (!defined('PC')) define('PC', '11');

Route::group(['prefix' => '{locale?}/admin','where'=>['locale'=>'[a-zA-Z]{2}'], 'middleware' => ['auth:admin','SetLocale']], function () {
    

    // Route::get('languageConverter/{locale}',function($locale){
    //   // if(in_array($locale,['ar','en'])){
    //         session()->put('locale',$locale);
    //  //   }
    //    return redirect()->route('admin.login');
    // })->name('admin.languageConverter');


    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    /*  بداية الضبط العام */
    Route::get('/generalSettings', [AdminPanelSettingController::class, 'index'])->name('admin_panel_settings.index');
    Route::get('/generalSettingsEdit', [AdminPanelSettingController::class, 'edit'])->name('admin_panel_settings.edit');
    Route::get('/generalSettingsupdate', [AdminPanelSettingController::class, 'update'])->name('admin_panel_settings.update');
    /*  بداية  تكويد السنوات المالية */
    Route::get('/finance_calender/delete/{id}', [FinanceCalendersController::class, 'destroy'])->name('finance_calender.delete');
    Route::post('/finance_calender/show_year_monthes', [FinanceCalendersController::class, 'show_year_monthes'])->name('finance_calender.show_year_monthes');
    Route::get('/finance_calender/do_open/{id}', [FinanceCalendersController::class, 'do_open'])->name('finance_calender.do_open');
    Route::resource('/finance_calender', FinanceCalendersController::class);
    /* بداية الفروع */
    Route::get("/branches", [BranchesController::class, 'index'])->name('branches.index');
    Route::get("/branchesCreate", [BranchesController::class, 'create'])->name('branches.create');
    Route::post("/branchesStore", [BranchesController::class, 'store'])->name('branches.store');
    Route::get("/branchesEdit/{id}", [BranchesController::class, 'edit'])->name('branches.edit');
    Route::post("/branchesUpdate/{id}", [BranchesController::class, 'update'])->name('branches.update');
    Route::get("/branchesDelete/{id}", [BranchesController::class, 'destroy'])->name('branches.destroy');
    /*  بداية المواد الدراسية*/
    Route::get('/subjects', [SubjectsController::class, 'index'])->name('subjects.index');
    Route::get('/subjectsCreate', [SubjectsController::class, 'create'])->name('subjects.create');
    Route::post('/subjectsStore', [SubjectsController::class, 'store'])->name('subjects.store');
    Route::get('/subjectsEdit/{id}', [SubjectsController::class, 'edit'])->name('subjects.edit');
    Route::post('/subjectsUpdate/{id}', [SubjectsController::class, 'update'])->name('subjects.update');
    Route::get('/subjectsDestroy/{id}', [SubjectsController::class, 'destroy'])->name('subjects.destroy');
    /* بداية انواع شفتات الموظفين */
    Route::get("/ShiftsTypes", [ShiftsTypesController::class, 'index'])->name('ShiftsTypes.index');
    Route::get("/ShiftsTypesCreate", [ShiftsTypesController::class, 'create'])->name('ShiftsTypes.create');
    Route::post("/ShiftsTypesStore", [ShiftsTypesController::class, 'store'])->name('ShiftsTypes.store');
    Route::get("/ShiftsTypesEdit/{id}", [ShiftsTypesController::class, 'edit'])->name('ShiftsTypes.edit');
    Route::post("/ShiftsTypesUpdate/{id}", [ShiftsTypesController::class, 'update'])->name('ShiftsTypes.update');
    Route::get("/ShiftsTypesDestroy/{id}", [ShiftsTypesController::class, 'destroy'])->name('ShiftsTypes.destroy');
    Route::post("/ShiftsTypesajax_search", [ShiftsTypesController::class, 'ajax_search'])->name('ShiftsTypes.ajax_search');
    /*  بداية الادارات*/
    Route::get('/departements', [DepartementsController::class, 'index'])->name('departements.index');
    Route::get('/departementsCreate', [DepartementsController::class, 'create'])->name('departements.create');
    Route::post('/departementsStore', [DepartementsController::class, 'store'])->name('departements.store');
    Route::get('/departementsEdit/{id}', [DepartementsController::class, 'edit'])->name('departements.edit');
    Route::post('/departementsUpdate/{id}', [DepartementsController::class, 'update'])->name('departements.update');
    Route::get('/departementsDestroy/{id}', [DepartementsController::class, 'destroy'])->name('departements.destroy');
    /*  بداية فئات الوظائف*/
    Route::get('/jobs_categories', [JobsCategoriesController::class, 'index'])->name('jobs_categories.index');
    Route::get('/jobs_categoriesCreate', [JobsCategoriesController::class, 'create'])->name('jobs_categories.create');
    Route::post('/jobs_categoriesStore', [JobsCategoriesController::class, 'store'])->name('jobs_categories.store');
    Route::get('/jobs_categoriesEdit/{id}', [JobsCategoriesController::class, 'edit'])->name('jobs_categories.edit');
    Route::post('/jobs_categoriesUpdate/{id}', [JobsCategoriesController::class, 'update'])->name('jobs_categories.update');
    Route::get('/jobs_categoriesDestroy/{id}', [JobsCategoriesController::class, 'destroy'])->name('jobs_categories.destroy');
    /*  بداية مؤهلات الموظفين*/
    Route::get('/Qualifications', [QualificationsController::class, 'index'])->name('Qualifications.index');
    Route::get('/QualificationsCreate', [QualificationsController::class, 'create'])->name('Qualifications.create');
    Route::post('/QualificationsStore', [QualificationsController::class, 'store'])->name('Qualifications.store');
    Route::get('/QualificationsEdit/{id}', [QualificationsController::class, 'edit'])->name('Qualifications.edit');
    Route::post('/QualificationsUpdate/{id}', [QualificationsController::class, 'update'])->name('Qualifications.update');
    Route::get('/QualificationsDestroy/{id}', [QualificationsController::class, 'destroy'])->name('Qualifications.destroy');
    /*  بداية  المناسبات الرسمية*/
    Route::get('/occasions', [OccasionsController::class, 'index'])->name('occasions.index');
    Route::get('/occasionsCreate', [OccasionsController::class, 'create'])->name('occasions.create');
    Route::post('/occasionsStore', [OccasionsController::class, 'store'])->name('occasions.store');
    Route::get('/occasionsEdit/{id}', [OccasionsController::class, 'edit'])->name('occasions.edit');
    Route::post('/occasionsUpdate/{id}', [OccasionsController::class, 'update'])->name('occasions.update');
    Route::get('/occasionsDestroy/{id}', [OccasionsController::class, 'destroy'])->name('occasions.destroy');


    /*  بداية  انواع ترك العمل */
    Route::get('/Resignations', [ResignationsController::class, 'index'])->name('Resignations.index');
    Route::get('/ResignationsCreate', [ResignationsController::class, 'create'])->name('Resignations.create');
    Route::post('/ResignationsStore', [ResignationsController::class, 'store'])->name('Resignations.store');
    Route::get('/ResignationsEdit/{id}', [ResignationsController::class, 'edit'])->name('Resignations.edit');
    Route::post('/ResignationsUpdate/{id}', [ResignationsController::class, 'update'])->name('Resignations.update');
    Route::get('/ResignationsDestroy/{id}', [ResignationsController::class, 'destroy'])->name('Resignations.destroy');

    /*  بداية  انواع  الجنسيات */
    Route::get('/Nationalities', [NationalitiesController::class, 'index'])->name('Nationalities.index');
    Route::get('/NationalitiesCreate', [NationalitiesController::class, 'create'])->name('Nationalities.create');
    Route::post('/NationalitiesStore', [NationalitiesController::class, 'store'])->name('Nationalities.store');
    Route::get('/NationalitiesEdit/{id}', [NationalitiesController::class, 'edit'])->name('Nationalities.edit');
    Route::post('/NationalitiesUpdate/{id}', [NationalitiesController::class, 'update'])->name('Nationalities.update');
    Route::get('/NationalitiesDestroy/{id}', [NationalitiesController::class, 'destroy'])->name('Nationalities.destroy');

    /*  بداية  انواع  الديانات */
    Route::get('/Religions/index', [ReligionController::class, 'index'])->name('Religions.index');
    Route::get('/Religions/create', [ReligionController::class, 'create'])->name('Religions.create');
    Route::post('/Religions/store', [ReligionController::class, 'store'])->name('Religions.store');
    Route::get('/Religions/edit/{id}', [ReligionController::class, 'edit'])->name('Religions.edit');
    Route::post('/Religions/update/{id}', [ReligionController::class, 'update'])->name('Religions.update');
    Route::get('/Religions/destroy/{id}', [ReligionController::class, 'destroy'])->name('Religions.destroy');




     /*  بداية  نوع  المركبة */
     Route::get('/VehicleType/index', [VehicleController::class, 'vehicle_type_index'])->name('VehicleType.index');
     Route::get('/VehicleType/create', [VehicleController::class, 'vehicle_type_create'])->name('VehicleType.create');
     Route::post('/VehicleType/store', [VehicleController::class, 'vehicle_type_store'])->name('VehicleType.store');
     Route::get('/VehicleType/edit/{id}', [VehicleController::class, 'vehicle_type_edit'])->name('VehicleType.edit');
     Route::post('/VehicleType/update/{id}', [VehicleController::class, 'vehicle_type_update'])->name('VehicleType.update');
     Route::get('/VehicleType/destroy/{id}', [VehicleController::class, 'vehicle_type_destroy'])->name('VehicleType.destroy');


    /*  بداية  طراز  المركبة */
    Route::get('/VehicleModel/index', [VehicleController::class, 'vehicle_model_index'])->name('VehicleModel.index');
    Route::get('/VehicleModel/create', [VehicleController::class, 'vehicle_model_create'])->name('VehicleModel.create');
    Route::post('/VehicleModel/store', [VehicleController::class, 'vehicle_model_store'])->name('VehicleModel.store');
    Route::get('/VehicleModel/edit/{id}', [VehicleController::class, 'vehicle_model_edit'])->name('VehicleModel.edit');
    Route::post('/VehicleModel/update/{id}', [VehicleController::class, 'vehicle_model_update'])->name('VehicleModel.update');
    Route::get('/VehicleModel/destroy/{id}', [VehicleController::class, 'vehicle_model_destroy'])->name('VehicleModel.destroy');

    
    /*  بداية  الموظفين   */
    Route::get('/Employees/index', [EmployeesController::class, 'index'])->name('Employees.index');
    Route::get('/Employees/create', [EmployeesController::class, 'create'])->name('Employees.create');
    Route::post('/Employees/store', [EmployeesController::class, 'store'])->name('Employees.store');
    Route::get('/Employees/edit/{id}', [EmployeesController::class, 'edit'])->name('Employees.edit');
    Route::post('/Employees/update/{id}', [EmployeesController::class, 'update'])->name('Employees.update');
    Route::get('/Employees/destroy/{id}', [EmployeesController::class, 'destroy'])->name('Employees.destroy');
    Route::post("/Employees/get_governorates", [EmployeesController::class, 'get_governorates'])->name('Employees.get_governorates');
    Route::post("/Employees/get_centers", [EmployeesController::class, 'get_centers'])->name('Employees.get_centers');


     /*  بداية  الموارد البشرية   */
     Route::get('/HumanResource/index', [HumanResourceController::class, 'index'])->name('HumanResource.index');
     Route::get('/HumanResource/create', [HumanResourceController::class, 'create'])->name('HumanResource.create');
     Route::post('/HumanResource/store', [HumanResourceController::class, 'store'])->name('HumanResource.store');
     Route::get('/HumanResource/edit/{id}', [HumanResourceController::class, 'edit'])->name('HumanResource.edit');
     Route::post('/HumanResource/update/{id}', [HumanResourceController::class, 'update'])->name('HumanResource.update');
     Route::get('/HumanResource/destroy/{id}', [HumanResourceController::class, 'destroy'])->name('HumanResource.destroy');
     Route::post("/HumanResource/get_governorates", [HumanResourceController::class, 'get_governorates'])->name('HumanResource.get_governorates');
     Route::post("/HumanResource/get_centers", [HumanResourceController::class, 'get_centers'])->name('HumanResource.get_centers');
     Route::post('/HumanResource/employees', [HumanResourceController::class, 'employees'])->name('HumanResource.employees');
     Route::get('/GovernmentProcess/index', [HumanResourceController::class, 'GovernmentProcess'])->name('HumanResource.GovernmentProcess');
     Route::post("/GovernmentProcess/ajax_search/", [HumanResourceController::class, 'ajax_search'])->name('HumanResource.ajax_search');
     Route::post("/GovernmentProcess/ajax_search_GovernmentProcess/", [HumanResourceController::class, 'ajax_search_GovernmentProcess'])->name('HumanResource.ajax_search_GovernmentProcess');
     Route::post("/GovernmentProcess/ajax_update_driver_residency_process_status", [HumanResourceController::class, 'ajax_update_driver_residency_process_status'])->name('GovernmentProcess.ajax_update_driver_residency_process_status');
     Route::post("/GovernmentProcess/ajax_update_driver_bank_process", [HumanResourceController::class, 'ajax_update_driver_bank_process'])->name('GovernmentProcess.ajax_update_driver_bank_process');
     Route::post("/GovernmentProcess/ajax_update_Functional_status", [HumanResourceController::class, 'ajax_update_Functional_status'])->name('GovernmentProcess.ajax_update_Functional_status');
     Route::post("/GovernmentProcess/print_GovernmentProcess_search", [HumanResourceController::class, 'print_GovernmentProcess_search'])->name('GovernmentProcess.print_GovernmentProcess_search');


        /*  بداية  التشغيل    */
        Route::get('/Operation/index', [OperationController::class, 'index'])->name('Operation.index');
        Route::get('/Operation/create', [OperationController::class, 'create'])->name('Operation.create');
        Route::post('/Operation/store', [OperationController::class, 'store'])->name('Operation.store');
        Route::get('/Operation/edit/{id}', [OperationController::class, 'edit'])->name('Operation.edit');
        Route::post('/Operation/update/{id}', [OperationController::class, 'update'])->name('Operation.update');
        Route::get('/Operation/destroy/{id}', [OperationController::class, 'destroy'])->name('Operation.destroy');
        Route::post("/Operation/get_governorates", [OperationController::class, 'get_governorates'])->name('Operation.get_governorates');
        Route::post("/Operation/get_centers", [OperationController::class, 'get_centers'])->name('Operation.get_centers');
        Route::post('/Operation/employees', [OperationController::class, 'employees'])->name('Operation.employees');
        Route::post("/Operation/ajax_update_operating_contract_type/", [OperationController::class, 'ajax_update_operating_contract_type'])->name('Operation.ajax_update_operating_contract_type');
        Route::post("/Operation/ajax_update_operating_company/", [OperationController::class, 'ajax_update_operating_company'])->name('Operation.ajax_update_operating_company');
        Route::post("/Operation/print_operation_index/", [OperationController::class, 'print_operation_index'])->name('Operation.print_operation_index');



        Route::get('/ReportDailyOperation/talabat', [OperationController::class, 'dailyReport_talabat'])->name('Operation.dailyReport_talabat');
        Route::get('ReportDailyOperation/importDailyTalabatReportIndex',[OperationController::class,'importDailyTalabatReportIndex'])->name('Operation.importDailyTalabatReportIndex');
        Route::post('ReportDailyOperation/importDailyTalabatReportStore', [OperationController::class, 'importDailyTalabatReportStore'])->name('Operation.importDailyTalabatReportStore');
        Route::post("/ReportDailyOperation/daily_report_ajax_search/", [OperationController::class, 'daily_report_ajax_search'])->name('Operation.daily_report_ajax_search');
        Route::post("/ReportDailyOperation/print_daily_report/", [OperationController::class, 'print_daily_report'])->name('Operation.print_daily_report');

        


        Route::get('/ReportMonthlyOperation/talabat', [OperationController::class, 'monthlyReport_talabat'])->name('Operation.monthlyReport_talabat');
        Route::get('ReportMonthlyOperation/importMonthlyTalabatReportIndex',[OperationController::class,'importMonthlyTalabatReportIndex'])->name('Operation.importMonthlyTalabatReportIndex');
        Route::post('ReportMonthlyOperation/importMonthlyTalabatReportStore', [OperationController::class, 'importMonthlyTalabatReportStore'])->name('Operation.importMonthlyTalabatReportStore');
        Route::post("/ReportMonthlyOperation/monthly_report_ajax_search/", [OperationController::class, 'monthly_report_ajax_search'])->name('Operation.monthly_report_ajax_search');
        Route::post("/ReportMonthlyOperation/print_monthly_report/", [OperationController::class, 'print_monthly_report'])->name('Operation.print_monthly_report');



        Route::get('/operationGovernmentProcess/index', [OperationController::class, 'GovernmentProcess'])->name('Operation.GovernmentProcess');
        Route::post("/operationGovernmentProcess/ajax_search/", [OperationController::class, 'ajax_search'])->name('Operation.ajax_search');
        Route::post("/operationGovernmentProcess/ajax_search_GovernmentProcess/", [OperationController::class, 'ajax_search_GovernmentProcess'])->name('Operation.ajax_search_GovernmentProcess');
        Route::post("/operationGovernmentProcess/ajax_update_driver_residency_process_status", [OperationController::class, 'ajax_update_driver_residency_process_status'])->name('OperationGovernmentProcess.ajax_update_driver_residency_process_status');
        Route::post("/operationGovernmentProcess/ajax_update_driver_bank_process", [OperationController::class, 'ajax_update_driver_bank_process'])->name('OperationGovernmentProcess.ajax_update_driver_bank_process');
        Route::post("/operationGovernmentProcess/ajax_update_Functional_status", [OperationController::class, 'ajax_update_Functional_status'])->name('OperationGovernmentProcess.ajax_update_Functional_status');
        Route::post("/operationGovernmentProcess/print_GovernmentProcess_search", [OperationController::class, 'print_GovernmentProcess_search'])->name('OperationGovernmentProcess.print_GovernmentProcess_search');
   
   





      /*  بداية  الإدارة القانونية    */
      Route::get('/TheLegal/index', [TheLegalController::class, 'index'])->name('TheLegal.index');
      Route::get('/TheLegal/create', [TheLegalController::class, 'create'])->name('TheLegal.create');
      Route::post('/TheLegal/store', [TheLegalController::class, 'store'])->name('TheLegal.store');
      Route::get('/TheLegal/edit/{id}', [TheLegalController::class, 'edit'])->name('TheLegal.edit');
      Route::post('/TheLegal/update/{id}', [TheLegalController::class, 'update'])->name('TheLegal.update');
      Route::get('/TheLegal/destroy/{id}', [TheLegalController::class, 'destroy'])->name('TheLegal.destroy');
      Route::post("/TheLegal/get_governorates", [TheLegalController::class, 'get_governorates'])->name('TheLegal.get_governorates');
      Route::post("/TheLegal/get_centers", [TheLegalController::class, 'get_centers'])->name('TheLegal.get_centers');
      Route::post('/TheLegal/employees', [TheLegalController::class, 'employees'])->name('TheLegal.employees');
      Route::post("/TheLegal/ajax_search/", [TheLegalController::class, 'ajax_search'])->name('TheLegal.ajax_search');
      Route::post("/TheLegal/ajax_update_isSigningInitialContract/", [TheLegalController::class, 'ajax_update_isSigningInitialContract'])->name('TheLegal.ajax_update_isSigningInitialContract');
      Route::post("/TheLegal/ajax_update_isGivePassPort/", [TheLegalController::class, 'ajax_update_isGivePassPort'])->name('TheLegal.ajax_update_isGivePassPort');
      Route::post("/TheLegal/ajax_update_isSigningMainContract/", [TheLegalController::class, 'ajax_update_isSigningMainContract'])->name('TheLegal.ajax_update_isSigningMainContract');
      Route::post("/TheLegal/ajax_update_isSigningFullFinancialDebt/", [TheLegalController::class, 'ajax_update_isSigningFullFinancialDebt'])->name('TheLegal.ajax_update_isSigningFullFinancialDebt');
      Route::post("/TheLegal/ajax_update_isSigningPenaltyClause/", [TheLegalController::class, 'ajax_update_isSigningPenaltyClause'])->name('TheLegal.ajax_update_isSigningPenaltyClause');



       /*  بداية  حارس الأمن     */
       Route::get('/SecurityGuard_Receive/index', [SecurityGuardController::class, 'index'])->name('SecurityGuard_Receive.index');
       Route::get('/SecurityGuard_Return/index', [SecurityGuardController::class, 'index'])->name('SecurityGuard_Return.index');
       Route::get('/SecurityGuard_violations/index', [SecurityGuardController::class, 'index'])->name('SecurityGuard_violations.index');
       Route::get('/SecurityGuard/create', [SecurityGuardController::class, 'create'])->name('SecurityGuard.create');
       Route::get('/SecurityGuard_Receive/edit/{id}', [SecurityGuardController::class, 'edit'])->name('SecurityGuard.edit');
       Route::post('/SecurityGuard_Receive/store', [SecurityGuardController::class, 'storeDeposit'])->name('SecurityGuard.store');
       Route::get('/SecurityGuard_Return/show_drivers_deposit', [SecurityGuardController::class, 'show_drivers_deposit'])->name('SecurityGuard.show_drivers_deposit');
       Route::post("/SecurityGuard_Return/ajax_update_report_status", [SecurityGuardController::class, 'ajax_update_report_status'])->name('SecurityGuard.ajax_update_report_status');
       Route::post("/SecurityGuard_Return/ajax_daily_report_search/", [SecurityGuardController::class, 'ajax_daily_report_search'])->name('SecurityGuard.ajax_daily_report_search');
       Route::post('/SecurityGuard/update/{id}', [SecurityGuardController::class, 'update'])->name('SecurityGuard.update');
       Route::get('/SecurityGuard/destroy/{id}', [SecurityGuardController::class, 'destroy'])->name('SecurityGuard.destroy');
       Route::post("/SecurityGuard/get_governorates", [SecurityGuardController::class, 'get_governorates'])->name('SecurityGuard.get_governorates');
       Route::post("/SecurityGuard/get_centers", [SecurityGuardController::class, 'get_centers'])->name('SecurityGuard.get_centers');
       Route::post('/SecurityGuard/employees', [SecurityGuardController::class, 'employees'])->name('SecurityGuard.employees');
       Route::post("/SecurityGuard/ajax_search/", [SecurityGuardController::class, 'ajax_search'])->name('SecurityGuard.ajax_search');
       Route::post("/SecurityGuard/ajax_show_drivers_deposit_search/", [SecurityGuardController::class, 'ajax_show_drivers_deposit_search'])->name('SecurityGuard.ajax_show_drivers_deposit_search');
       Route::post("/SecurityGuard/ajax_update_isSigningInitialContract/", [SecurityGuardController::class, 'ajax_update_isSigningInitialContract'])->name('SecurityGuard.ajax_update_isSigningInitialContract');
       Route::post("/SecurityGuard/ajax_update_isGivePassPort/", [SecurityGuardController::class, 'ajax_update_isGivePassPort'])->name('SecurityGuard.ajax_update_isGivePassPort');
       Route::post("/SecurityGuard/ajax_update_isSigningMainContract/", [SecurityGuardController::class, 'ajax_update_isSigningMainContract'])->name('SecurityGuard.ajax_update_isSigningMainContract');
       Route::post("/SecurityGuard/ajax_update_isSigningFullFinancialDebt/", [SecurityGuardController::class, 'ajax_update_isSigningFullFinancialDebt'])->name('SecurityGuard.ajax_update_isSigningFullFinancialDebt');
       Route::post("/SecurityGuard/ajax_update_isSigningPenaltyClause/", [SecurityGuardController::class, 'ajax_update_isSigningPenaltyClause'])->name('SecurityGuard.ajax_update_isSigningPenaltyClause');
 
 
        /*  بداية  الزي الرسمي ()      */
        Route::get('/uniform_Receive/index', [UniformController::class, 'index'])->name('uniform_Receive.index');
        Route::get('/uniform_Return/index', [UniformController::class, 'index'])->name('uniform_Return.index');
        Route::get('/uniform_violations/index', [UniformController::class, 'index'])->name('uniform_violations.index');
        Route::get('/uniform/create', [UniformController::class, 'create'])->name('uniform.create');
        Route::get('/uniform_Receive/edit/{id}', [UniformController::class, 'edit'])->name('uniform.edit');
        Route::post('/uniform_Receive/store', [UniformController::class, 'storeUniform'])->name('uniform.store');
        Route::get('/uniform_Return/show_drivers_deposit', [UniformController::class, 'show_drivers_deposit'])->name('uniform.show_drivers_deposit'); 
        Route::post("/uniform_Return/ajax_update_report_status", [UniformController::class, 'ajax_update_report_status'])->name('uniform.ajax_update_report_status');
        Route::post('/uniform/update/{id}', [UniformController::class, 'update'])->name('uniform.update');
        Route::get('/uniform/destroy/{id}', [UniformController::class, 'destroy'])->name('uniform.destroy');
        Route::post("/uniform/get_governorates", [UniformController::class, 'get_governorates'])->name('uniform.get_governorates');
        Route::post("/uniform/get_centers", [UniformController::class, 'get_centers'])->name('uniform.get_centers');
        Route::post('/uniform/employees', [UniformController::class, 'employees'])->name('uniform.employees');
        Route::post("/uniform/ajax_search/", [UniformController::class, 'ajax_search'])->name('uniform.ajax_search');
        Route::post("/uniform_Return/ajax_daily_report_search/", [UniformController::class, 'ajax_show_drivers_uniform_search'])->name('uniform.ajax_daily_report_search');
        Route::post("/uniform/ajax_update_isSigningInitialContract/", [UniformController::class, 'ajax_update_isSigningInitialContract'])->name('uniform.ajax_update_isSigningInitialContract');
        Route::post("/uniform/ajax_update_isGivePassPort/", [UniformController::class, 'ajax_update_isGivePassPort'])->name('uniform.ajax_update_isGivePassPort');
        Route::post("/uniform/ajax_update_isSigningMainContract/", [UniformController::class, 'ajax_update_isSigningMainContract'])->name('uniform.ajax_update_isSigningMainContract');
        Route::post("/uniform/ajax_update_isSigningFullFinancialDebt/", [UniformController::class, 'ajax_update_isSigningFullFinancialDebt'])->name('uniform.ajax_update_isSigningFullFinancialDebt');
        Route::post("/uniform/ajax_update_isSigningPenaltyClause/", [UniformController::class, 'ajax_update_isSigningPenaltyClause'])->name('uniform.ajax_update_isSigningPenaltyClause');
  
  




       /*  بداية  الإدارة المالية    */
       Route::get('/financial/index', [financialController::class, 'index'])->name('financial.index');
       Route::get('/financial/create', [financialController::class, 'create'])->name('financial.create');
       Route::post('/financial/store', [financialController::class, 'store'])->name('financial.store');
       Route::get('/financial/edit/{id}', [financialController::class, 'edit'])->name('financial.edit');
       Route::post('/financial/update/{id}', [financialController::class, 'update'])->name('financial.update');
       Route::get('/financial/destroy/{id}', [financialController::class, 'destroy'])->name('financial.destroy');
       Route::post("/financial/get_governorates", [financialController::class, 'get_governorates'])->name('financial.get_governorates');
       Route::post("/financial/get_centers", [financialController::class, 'get_centers'])->name('financial.get_centers');
       Route::get('/FinancialEmployees', [financialController::class, 'employees'])->name('financial.employees');
       Route::get('/FinancialGeneralLoans_index', [financialController::class, 'generalLoans_index'])->name('financial.generalLoans_index');
       Route::get('/FinancialGeneralLoans_edit/{id}', [financialController::class, 'generalLoans_edit'])->name('financial.generalLoans_edit');
       Route::post('/FinancialGeneralLoans_update/{id}', [financialController::class, 'generalLoans_update'])->name('financial.generalLoans_update');
       Route::get('/FinancialSpecialLoans_index', [financialController::class, 'specialLoans_index'])->name('financial.specialLoans_index');
       Route::get('/FinancialSpecialLoans_create', [financialController::class, 'specialLoans_create'])->name('financial.specialLoans_create');
       Route::post('/FinancialSpecialLoans_store', [financialController::class, 'specialLoans_store'])->name('financial.specialLoans_store');
       Route::get('/FinancialSpecialLoans_edit/{id}', [financialController::class, 'specialLoans_edit'])->name('financial.specialLoans_edit');
       Route::post('/FinancialSpecialLoans_update/{id}', [financialController::class, 'specialLoans_update'])->name('financial.specialLoans_update');


       

        /*  بداية  قسم التدريب    */
        Route::get('/Training/index', [TrainingController::class, 'index'])->name('Training.index');
        Route::get('/Training/create', [TrainingController::class, 'create'])->name('Training.create');
        Route::post('/Training/store', [TrainingController::class, 'store'])->name('Training.store');
        Route::get('/Training/edit/{id}', [TrainingController::class, 'edit'])->name('Training.edit');
        Route::post('/Training/update/{id}', [TrainingController::class, 'update'])->name('Training.update');
        Route::get('/Training/destroy/{id}', [TrainingController::class, 'destroy'])->name('Training.destroy');
        Route::post("/Training/get_governorates", [TrainingController::class, 'get_governorates'])->name('Training.get_governorates');
        Route::post("/Training/get_centers", [TrainingController::class, 'get_centers'])->name('Training.get_centers');
        Route::get('/trainingLeactures', [TrainingController::class, 'leactures'])->name('Training.leactures');
        Route::post("/Training/ajax_search/", [TrainingController::class, 'ajax_search'])->name('Training.ajax_search');
        Route::post("/Training/ajax_update_english_group", [TrainingController::class, 'ajax_update_english_group'])->name('Training.ajax_update_english_group');
        Route::post("/Training/ajax_update_english_lectures_atendence_range", [TrainingController::class, 'ajax_update_english_lectures_atendence_range'])->name('Training.ajax_update_english_lectures_atendence_range');
        Route::post("/Training/ajax_update_english_lectures_understand_range", [TrainingController::class, 'ajax_update_english_lectures_understand_range'])->name('Training.ajax_update_english_lectures_understand_range');
        Route::post("/Training/ajax_update_talabat_lectures_atendence_range", [TrainingController::class, 'ajax_update_talabat_lectures_atendence_range'])->name('Training.ajax_update_talabat_lectures_atendence_range');
        Route::post("/Training/ajax_update_talabat_lectures_understand_range", [TrainingController::class, 'ajax_update_talabat_lectures_understand_range'])->name('Training.ajax_update_talabat_lectures_understand_range');
        Route::post("/Training/ajax_update_atucate_lectures_atendence_range", [TrainingController::class, 'ajax_update_atucate_lectures_atendence_range'])->name('Training.ajax_update_atucate_lectures_atendence_range');
        Route::post("/Training/ajax_atucate_lectures_understand_range", [TrainingController::class, 'ajax_atucate_lectures_understand_range'])->name('Training.ajax_atucate_lectures_understand_range');



          /*  بداية  قسم الصيانة    */
        //   Route::get('/Maintenance/index', [MaintenanceController::class, 'index'])->name('Maintenance.index');
        //   Route::get('/Maintenance/create', [MaintenanceController::class, 'create'])->name('Maintenance.create');
        //   Route::post('/Maintenance/store', [MaintenanceController::class, 'store'])->name('Maintenance.store');
        //   Route::get('/Maintenance/edit/{id}', [MaintenanceController::class, 'edit'])->name('Maintenance.edit');
        //   Route::post('/Maintenance/update/{id}', [MaintenanceController::class, 'update'])->name('Maintenance.update');
        //   Route::get('/Maintenance/destroy/{id}', [MaintenanceController::class, 'destroy'])->name('Maintenance.destroy');
        //   Route::post("/Maintenance/get_governorates", [MaintenanceController::class, 'get_governorates'])->name('Maintenance.get_governorates');
        //   Route::post("/Maintenance/get_centers", [MaintenanceController::class, 'get_centers'])->name('Maintenance.get_centers');
        //   Route::get("/maintenanceBike", [MaintenanceController::class, 'bike'])->name('Maintenance.bike');
        //   Route::get("/maintenancePils", [MaintenanceController::class, 'pils'])->name('Maintenance.pils');
      
  

          /*  بداية  قسم الصيانة    */
    Route::get('/Maintenance/index', [MaintenanceController::class, 'index'])->name('Maintenance.index');
    Route::get('/Maintenance/create', [MaintenanceController::class, 'create'])->name('Maintenance.create');
    Route::post('/Maintenance/store', [MaintenanceController::class, 'store'])->name('Maintenance.store');
    Route::get('/Maintenance/edit/{id}', [MaintenanceController::class, 'edit'])->name('Maintenance.edit');
    Route::post('/Maintenance/update/{id}', [MaintenanceController::class, 'update'])->name('Maintenance.update');
    Route::get('/Maintenance/destroy/{id}', [MaintenanceController::class, 'destroy'])->name('Maintenance.destroy');
    Route::post("/Maintenance/ajax_search/", [MaintenanceController::class, 'ajax_search'])->name('Maintenance.ajax_search');
    Route::post("/Maintenance/ajax_do_add_permission/", [MaintenanceController::class, 'ajax_do_add_permission'])->name('Maintenance.ajax_do_add_permission');
    Route::post("/Maintenance/ajax_load_edit_permission/", [MaintenanceController::class, 'ajax_load_edit_permission'])->name('Maintenance.ajax_load_edit_permission');
    Route::post("/Maintenance/ajax_do_edit_permission/", [MaintenanceController::class, 'ajax_do_edit_permission'])->name('Maintenance.ajax_do_edit_permission');
    Route::post("/Maintenance/ajax_do_delete_permission/", [MaintenanceController::class, 'ajax_do_delete_permission'])->name('Maintenance.ajax_do_delete_permission');

    Route::get('/maintenanceBike/index_bike', [MaintenanceController::class, 'index_bike'])->name('Maintenance.index_bike');
    Route::get('/maintenanceBike/create_bike', [MaintenanceController::class, 'create_bike'])->name('Maintenance.create_bike');
    Route::post('/maintenanceBike/store_bike', [MaintenanceController::class, 'store_bike'])->name('Maintenance.store_bike');
    Route::get('/maintenanceBike/edit_bike/{id}', [MaintenanceController::class, 'edit_bike'])->name('Maintenance.edit_bike');
    Route::post('/maintenanceBike/update_bike/{id}', [MaintenanceController::class, 'update_bike'])->name('Maintenance.update_bike');
    Route::post("/maintenanceBike/ajax_search_bike/", [MaintenanceController::class, 'ajax_search_bike'])->name('Maintenance.ajax_search_bike');

    
    Route::post('/Maintenance/load_add_maintenance_to_vehicle', [MaintenanceController::class, 'load_add_maintenance_to_vehicle'])->name('Maintenance.load_add_maintenance_to_vehicle');
    Route::post('/Maintenance/add_maintenance_to_vehicle/{id}', [MaintenanceController::class, 'add_maintenance_to_vehicle'])->name('Maintenance.add_maintenance_to_vehicle');
    Route::get('/Maintenance/delete_maintenance_to_vehicle/{id}', [MaintenanceController::class, 'delete_maintenance_to_vehicle'])->name('Maintenance.delete_maintenance_to_vehicle');


    Route::post('/Maintenance/load_add_vechile_spare_part', [MaintenanceController::class, 'load_add_vechile_spare_part'])->name('Maintenance.load_add_vechile_spare_part');
    Route::post('/Maintenance/add_vechile_spare_part/{id}', [MaintenanceController::class, 'add_vechile_spare_part'])->name('Maintenance.add_vechile_spare_part');
    Route::get('/Maintenance/delete_vechile_spare_part/{id}', [MaintenanceController::class, 'delete_vechile_spare_part'])->name('Maintenance.delete_vechile_spare_part');



    Route::get('/maintenanceTrafficViolations/index_traffic_violations', [MaintenanceController::class, 'index_traffic_violations'])->name('Maintenance.index_traffic_violations');
    Route::post('/maintenanceTrafficViolations/load_add_traffic_violation', [MaintenanceController::class, 'load_add_traffic_violation'])->name('Maintenance.load_add_traffic_violation');
    Route::post('/maintenanceTrafficViolations/add_traffic_violation/{id}', [MaintenanceController::class, 'add_traffic_violation'])->name('Maintenance.add_traffic_violation');
    Route::post("/maintenanceTrafficViolations/ajax_search_traffic_violations/", [MaintenanceController::class, 'ajax_search_traffic_violations'])->name('Maintenance.ajax_search_traffic_violations');
    Route::post("/maintenanceTrafficViolations/ajax_update_traffic_violation_payment_status", [MaintenanceController::class, 'ajax_update_traffic_violation_payment_status'])->name('Maintenance.ajax_update_traffic_violation_payment_status');
    Route::get('/maintenanceTrafficViolations/delete_traffic_violations/{id}', [MaintenanceController::class, 'delete_traffic_violations'])->name('Maintenance.delete_traffic_violations');


   /*  بداية  قسم الصيانة    */
   Route::get('/maintenanceTrafficAccidents/index_traffic_accidents', [MaintenanceController::class, 'index_traffic_accidents'])->name('Maintenance.index_traffic_accidents');
   Route::get('/maintenanceTrafficAccidents/create_traffic_accidents', [MaintenanceController::class, 'create_traffic_accidents'])->name('Maintenance.create_traffic_accidents');
   Route::post('/maintenanceTrafficAccidents/store_traffic_accidents', [MaintenanceController::class, 'store_traffic_accidents'])->name('Maintenance.store_traffic_accidents');
   Route::get('/maintenanceTrafficAccidents/edit_traffic_accidents/{id}', [MaintenanceController::class, 'edit_traffic_accidents'])->name('Maintenance.edit_traffic_accidents');
   Route::post('/maintenanceTrafficAccidents/update_traffic_accidents/{id}', [MaintenanceController::class, 'update_traffic_accidents'])->name('Maintenance.update_traffic_accidents');
   Route::get('/maintenanceTrafficAccidents/destroy_traffic_accidents/{id}', [MaintenanceController::class, 'destroy_traffic_accidents'])->name('Maintenance.destroy_traffic_accidents');
   Route::post("/maintenanceTrafficAccidents/ajax_search_traffic_accidents/", [MaintenanceController::class, 'ajax_search_traffic_accidents'])->name('Maintenance.ajax_search_traffic_accidents');
   Route::post("/maintenanceTrafficAccidents/ajax_do_add_permission_traffic_accidents/", [MaintenanceController::class, 'ajax_do_add_permission_traffic_accidents'])->name('Maintenance.ajax_do_add_permission_traffic_accidents');
   Route::post("/maintenanceTrafficAccidents/ajax_load_add_traffic_accidents/", [MaintenanceController::class, 'ajax_load_add_traffic_accidents'])->name('Maintenance.ajax_load_add_traffic_accidents');
   Route::post('/maintenanceTrafficAccidents/add_traffic_accident/{id}', [MaintenanceController::class, 'add_traffic_accident'])->name('Maintenance.add_traffic_accident');
   Route::get('/maintenanceTrafficAccidents/delete_traffic_accident/{id}', [MaintenanceController::class, 'delete_traffic_accident'])->name('Maintenance.delete_traffic_accident');

   Route::post('/maintenanceTrafficAccidents/load_add_traffic_accident_parts', [MaintenanceController::class, 'load_add_traffic_accident_parts'])->name('Maintenance.load_add_traffic_accident_parts');
   Route::post('/maintenanceTrafficAccidents/add_traffic_accident_parts/{id}', [MaintenanceController::class, 'add_traffic_accident_parts'])->name('Maintenance.add_traffic_accident_parts');
   Route::get('/maintenanceTrafficAccidents/delete_traffic_accident_part/{id}', [MaintenanceController::class, 'delete_traffic_accident_part'])->name('Maintenance.delete_traffic_accident_part');



   Route::get('/maintenanceCarDrivers/index_car_drivers', [MaintenanceController::class, 'index_car_drivers'])->name('Maintenance.index_car_drivers');


   

   Route::post("/maintenanceTrafficAccidents/ajax_do_edit_permission_traffic_accidents/", [MaintenanceController::class, 'ajax_do_edit_permission_traffic_accidents'])->name('Maintenance.ajax_do_edit_permission_traffic_accidents');
   Route::post("/maintenanceTrafficAccidents/ajax_do_delete_permission_traffic_accidents/", [MaintenanceController::class, 'ajax_do_delete_permission_traffic_accidents'])->name('Maintenance.ajax_do_delete_permission_traffic_accidents');

  




            /*  بداية  قسم السكن    */
            Route::get('/Housing/index', [HousingController::class, 'index'])->name('Housing.index');
            Route::get('/Housing/create', [HousingController::class, 'create'])->name('Housing.create');
            Route::post('/Housing/store', [HousingController::class, 'store'])->name('Housing.store');
            Route::get('/Housing/edit/{id}', [HousingController::class, 'edit'])->name('Housing.edit');
            Route::post('/Housing/update/{id}', [HousingController::class, 'update'])->name('Housing.update');
            Route::get('/Housing/destroy/{id}', [HousingController::class, 'destroy'])->name('Housing.destroy');
            Route::post("/Housing/get_flats", [HousingController::class, 'get_flats'])->name('Housing.get_flats');
            Route::post("/Housing/get_centers", [HousingController::class, 'get_centers'])->name('Housing.get_centers');
            Route::get("/housingEmployess", [HousingController::class, 'employess'])->name('Housing.employess');
            Route::get("/housingFlats", [HousingController::class, 'flats'])->name('Housing.flats');
            Route::get('/flatscreate', [HousingController::class, 'flatscreate'])->name('Housing.flatscreate');
            Route::get('/flatsedit/{id}', [HousingController::class, 'flatsedit'])->name('Housing.flatsedit');
            Route::get('/flatsdestroy/{id}', [HousingController::class, 'flatsdestroy'])->name('Housing.flatsdestroy');
            Route::post('/flatstore', [HousingController::class, 'flatstore'])->name('Housing.flatstore');
            Route::post('/flatsupdate/{id}', [HousingController::class, 'flatsupdate'])->name('Housing.flatsupdate');
            Route::post("/Housing/ajax_search/", [HousingController::class, 'ajax_search'])->name('Housing.ajax_search');
            Route::post("/Housing/ajax_update_flats/", [HousingController::class, 'ajax_update_flats'])->name('Housing.ajax_update_flats');
            Route::post("/Housing/ajax_update_uniform_status/", [HousingController::class, 'ajax_update_uniform_status'])->name('Housing.ajax_update_uniform_status');

            
            

               /*  بداية  قسم المدرسة    */
               Route::get('/School/index', [SchoolController::class, 'index'])->name('School.index');
               Route::get('/School/create', [SchoolController::class, 'create'])->name('School.create');
               Route::post('/School/store', [SchoolController::class, 'store'])->name('School.store');
               Route::get('/School/edit/{id}', [SchoolController::class, 'edit'])->name('School.edit');
               Route::post('/School/update/{id}', [SchoolController::class, 'update'])->name('School.update');
               Route::get('/School/destroy/{id}', [SchoolController::class, 'destroy'])->name('School.destroy');
               Route::post("/School/ajax_update_driving_school_status", [SchoolController::class, 'ajax_update_driving_school_status'])->name('School.ajax_update_driving_school_status');
               Route::post("/School/ajax_update_driving_traning_range", [SchoolController::class, 'ajax_update_driving_traning_range'])->name('School.ajax_update_driving_traning_range');
               Route::post("/School/ajax_update_driver_school_notes", [SchoolController::class, 'ajax_update_driver_school_notes'])->name('School.ajax_update_driver_school_notes');
               Route::post("/School/ajax_search/", [SchoolController::class, 'ajax_search'])->name('School.ajax_search');
               Route::post("/School/print_School_search/", [SchoolController::class, 'print_School_search'])->name('School.print_School_search');





              /*  بداية   التقرير اليومي    */
              Route::get('/DailyReport/index', [DailyReportController::class, 'index'])->name('DailyReport.index');
              Route::get('/ShowDailyReport/show_daily_report', [DailyReportController::class, 'show_daily_report'])->name('DailyReport.show_daily_report');
              Route::get('/ShowDailyDrivingReport/show_daily_driving_report', [DailyReportController::class, 'show_daily_driving_report'])->name('DailyReport.show_daily_driving_report');
              Route::get('/DailyDrivingReport/index_driving_report', [DailyReportController::class, 'index_driving_report'])->name('DailyReport.index_driving_report');
              Route::get('/DailyReport/create', [DailyReportController::class, 'create'])->name('DailyReport.create');
              Route::post('/DailyReport/store', [DailyReportController::class, 'store'])->name('DailyReport.store');
              Route::post('/DailyDrivingReport/store_driving_report', [DailyReportController::class, 'store_driving_report'])->name('DailyReport.store_driving_report');
              Route::get('/DailyReport/edit/{id}', [DailyReportController::class, 'edit'])->name('DailyReport.edit');
              Route::post('/DailyReport/update/{id}', [DailyReportController::class, 'update'])->name('DailyReport.update');
              Route::get('/DailyReport/destroy/{id}', [DailyReportController::class, 'destroy'])->name('DailyReport.destroy');
              Route::post("/DailyReport/ajax_update_driving_school_status", [DailyReportController::class, 'ajax_update_driving_school_status'])->name('DailyReport.ajax_update_driving_school_status');
              Route::post("/DailyReport/ajax_update_driving_traning_range", [DailyReportController::class, 'ajax_update_driving_traning_range'])->name('DailyReport.ajax_update_driving_traning_range');
              Route::post("/DailyReport/ajax_search/", [DailyReportController::class, 'ajax_search'])->name('DailyReport.ajax_search');
              Route::post("/DailyReport/ajax_update_driving_report_status", [DailyReportController::class, 'ajax_update_driving_report_status'])->name('DailyReport.ajax_update_driving_report_status');
              Route::post("/DailyReport/ajax_update_report_status", [DailyReportController::class, 'ajax_update_report_status'])->name('DailyReport.ajax_update_report_status');
              Route::post("/ShowDailyReport/ajax_daily_report_search/", [DailyReportController::class, 'ajax_daily_report_search'])->name('DailyReport.ajax_daily_report_search');
              Route::post("/ShowDailyDrivingReport/ajax_daily_driving_report_search/", [DailyReportController::class, 'ajax_daily_driving_report_search'])->name('DailyReport.ajax_daily_driving_report_search');

              Route::post("/ShowDailyReport/ajax_do_add_report_note/", [DailyReportController::class, 'ajax_do_add_report_note'])->name('DailyReport.ajax_do_add_report_note');
              Route::post("/ShowDailyDrivingReport/ajax_do_add_driving_report_note/", [DailyReportController::class, 'ajax_do_add_driving_report_note'])->name('DailyReport.ajax_do_add_driving_report_note');

              



              
               /*  بداية  قسم التسويق    */
               Route::get('/Marketing/index', [MarketingController::class, 'index'])->name('Marketing.index');
               Route::get('/Marketing/create', [MarketingController::class, 'create'])->name('Marketing.create');
               Route::post('/Marketing/store', [MarketingController::class, 'store'])->name('Marketing.store');
               Route::get('/Marketing/edit/{id}', [MarketingController::class, 'edit'])->name('Marketing.edit');
               Route::post('/Marketing/update/{id}', [MarketingController::class, 'update'])->name('Marketing.update');
               Route::get('/Marketing/destroy/{id}', [MarketingController::class, 'destroy'])->name('Marketing.destroy');
               Route::post("/Marketing/ajax_update_driving_school_status", [MarketingController::class, 'ajax_update_driving_school_status'])->name('Marketing.ajax_update_driving_school_status');
               Route::post("/Marketing/ajax_search/", [MarketingController::class, 'ajax_search'])->name('Marketing.ajax_search');

                 

               /*  بداية  قسم الجودة    */
               Route::get('/Quality/index', [QualityController::class, 'index'])->name('Quality.index');
               Route::get('/Quality/create', [QualityController::class, 'create'])->name('Quality.create');
               Route::post('/Quality/store', [QualityController::class, 'store'])->name('Quality.store');
               Route::get('/Quality/edit/{id}', [QualityController::class, 'edit'])->name('Quality.edit');
               Route::post('/Quality/update/{id}', [QualityController::class, 'update'])->name('Quality.update');
               Route::get('/Quality/destroy/{id}', [QualityController::class, 'destroy'])->name('Quality.destroy');
               Route::get('QualityimportAttendenceIndex',[QualityController::class,'importAttendenceIndex'])->name('Quality.importAttendenceIndex');
               Route::post('/QualityimportAttendenceStore', [QualityController::class, 'importAttendenceStore'])->name('Quality.importAttendenceStore');
               Route::get('QualityMyCalendarIndex',[QualityController::class,'MyCalendarIndex'])->name('Quality.MyCalendarIndex');
               Route::get('/AdministrativeQuality/Index', [QualityController::class, 'administrativeIndex'])->name('Quality.administrativeIndex');
               Route::post("/Quality/driver_ajax_search/", [QualityController::class, 'driver_ajax_search'])->name('Quality.driver_ajax_search');
               Route::post("/Quality/Administrative_ajax_search/", [QualityController::class, 'Administrative_ajax_search'])->name('Quality.Administrative_ajax_search');
               Route::get('/AdministrativeComplaints/Index', [QualityController::class, 'administrativeComplaints'])->name('Quality.administrativeComplaints');
               Route::get('/AdministrativeSendComplaints/create', [QualityController::class, 'administrativeSendComplaintsCreate'])->name('Quality.administrativeSendComplaintsCreate');
               Route::post('/AdministrativeSendComplaints/store', [QualityController::class, 'administrativeSendComplaintsStore'])->name('Quality.administrativeSendComplaintsStore');
               Route::post("/Quality/complaints_ajax_search/", [QualityController::class, 'complaints_ajax_search'])->name('Quality.complaints_ajax_search');
               Route::post("/Quality/ajax_update_complaint_status/", [QualityController::class, 'ajax_update_complaint_status'])->name('Quality.ajax_update_complaint_status');
               Route::post("/Quality/print_driver_search/", [QualityController::class, 'print_driver_search'])->name('Quality.print_driver_search');
               Route::post("/Quality/print_administrative_search/", [QualityController::class, 'print_administrative_search'])->name('Quality.print_administrative_search');

            
            
    
  



    /*  بداية  الأدوار   */
    Route::get('/permission_roles/index', [PermissionRolesController::class, 'index'])->name('permission_roles.index');
    Route::get('/Permission_roles/create', [PermissionRolesController::class, 'create'])->name('permission_roles.create');
    Route::post('/Permission_roles/store', [PermissionRolesController::class, 'store'])->name('permission_roles.store');
    Route::get('/Permission_roles/edit/{id}', [PermissionRolesController::class, 'edit'])->name('permission_roles.edit');
    Route::post('/Permission_roles/update/{id}', [PermissionRolesController::class, 'update'])->name('permission_roles.update');
    Route::get('/Permission_roles/destroy/{id}', [PermissionRolesController::class, 'destroy'])->name('permission_roles.destroy');
    Route::get('/Permission_roles/details/{id}', [PermissionRolesController::class, 'details'])->name('permission_roles.details');
    Route::post('/Permission_roles/Add_permission_main_menues/{id}', [PermissionRolesController::class, 'Add_permission_main_menues'])->name('permission_roles.Add_permission_main_menues');
    Route::get('/Permission_roles/delete_permission_main_menues/{id}', [PermissionRolesController::class, 'delete_permission_main_menues'])->name('permission_roles.delete_permission_main_menues');
    Route::post('/Permission_roles/load_add_permission_roles_sub_menu', [PermissionRolesController::class, 'load_add_permission_roles_sub_menu'])->name('permission_roles.load_add_permission_roles_sub_menu');
    Route::post('/Permission_roles/add_permission_roles_sub_menu/{id}', [PermissionRolesController::class, 'add_permission_roles_sub_menu'])->name('permission_roles.add_permission_roles_sub_menu');
    Route::get('/Permission_roles/delete_permission_sub_menues/{id}', [PermissionRolesController::class, 'delete_permission_sub_menues'])->name('permission_roles.delete_permission_sub_menues');
    Route::post('/Permission_roles/load_add_permission_roles_sub_menues_action', [PermissionRolesController::class, 'load_add_permission_roles_sub_menues_action'])->name('permission_roles.load_add_permission_roles_sub_menues_action');
    Route::post('/Permission_roles/add_permission_roles_sub_menues_action/{id}', [PermissionRolesController::class, 'add_permission_roles_sub_menues_action'])->name('permission_roles.add_permission_roles_sub_menues_action');
    Route::get('/Permission_roles/delete_permission_sub_menues_actions/{id}', [PermissionRolesController::class, 'delete_permission_sub_menues_actions'])->name('permission_roles.delete_permission_sub_menues_actions');

    
    

     /*    بداية  صلاحيات القائمة الرئيسية   */
     Route::get('/permission_main_menues/index', [PermissionMainMenuesController::class, 'index'])->name('permission_main_menues.index');
     Route::get('/permission_main_menues/create', [PermissionMainMenuesController::class, 'create'])->name('permission_main_menues.create');
     Route::post('/permission_main_menues/store', [PermissionMainMenuesController::class, 'store'])->name('permission_main_menues.store');
     Route::get('/permission_main_menues/edit/{id}', [PermissionMainMenuesController::class, 'edit'])->name('permission_main_menues.edit');
     Route::post('/permission_main_menues/update/{id}', [PermissionMainMenuesController::class, 'update'])->name('permission_main_menues.update');
     Route::get('/permission_main_menues/destroy/{id}', [PermissionMainMenuesController::class, 'destroy'])->name('permission_main_menues.destroy');

        
    /*    بداية  صلاحيات القائمة الفرعية   */
    Route::get('/permission_sub_menues/index', [PermissionSubMenuesController::class, 'index'])->name('permission_sub_menues.index');
    Route::get('/permission_sub_menues/create', [PermissionSubMenuesController::class, 'create'])->name('permission_sub_menues.create');
    Route::post('/permission_sub_menues/store', [PermissionSubMenuesController::class, 'store'])->name('permission_sub_menues.store');
    Route::get('/permission_sub_menues/edit/{id}', [PermissionSubMenuesController::class, 'edit'])->name('permission_sub_menues.edit');
    Route::post('/permission_sub_menues/update/{id}', [PermissionSubMenuesController::class, 'update'])->name('permission_sub_menues.update');
    Route::get('/permission_sub_menues/destroy/{id}', [PermissionSubMenuesController::class, 'destroy'])->name('permission_sub_menues.destroy');
    Route::post("/permission_sub_menues/ajax_search/", [PermissionSubMenuesController::class, 'ajax_search'])->name('permission_sub_menues.ajax_search');
    Route::post("/permission_sub_menues/ajax_do_add_permission/", [PermissionSubMenuesController::class, 'ajax_do_add_permission'])->name('permission_sub_menues.ajax_do_add_permission');
    Route::post("/permission_sub_menues/ajax_load_edit_permission/", [PermissionSubMenuesController::class, 'ajax_load_edit_permission'])->name('permission_sub_menues.ajax_load_edit_permission');
    Route::post("/permission_sub_menues/ajax_do_edit_permission/", [PermissionSubMenuesController::class, 'ajax_do_edit_permission'])->name('permission_sub_menues.ajax_do_edit_permission');
    Route::post("/permission_sub_menues/ajax_do_delete_permission/", [PermissionSubMenuesController::class, 'ajax_do_delete_permission'])->name('permission_sub_menues.ajax_do_delete_permission');



/*    ═══════ ೋღ start admins ღೋ ═══════                    */
Route::get('/admins_accounts/index', [AdminController::class, 'index'])->name('admins_accounts.index');
Route::get('/admins_accounts/create', [AdminController::class, 'create'])->name('admins_accounts.create');
Route::post('/admins_accounts/store', [AdminController::class, 'store'])->name('admins_accounts.store');
Route::get('/admins_accounts/edit/{id}', [AdminController::class, 'edit'])->name('admins_accounts.edit');
Route::post('/admins_accounts/update/{id}', [AdminController::class, 'update'])->name('admins_accounts.update');
Route::post('/admins_accounts/ajax_search', [AdminController::class, 'ajax_search'])->name('admins_accounts.ajax_search');
Route::get('/admins_accounts/details/{id}', [AdminController::class, 'details'])->name('admins_accounts.details');
Route::get('/admins_accounts/destroy/{id}', [AdminController::class, 'destroy'])->name('admins_accounts.destroy');
Route::post('/admins_accounts/add_employees/{id}', [AdminController::class, 'add_employees'])->name('admins_accounts.add_employees');
Route::get('/admins_accounts/destroy_admin_permission_to_employees/{id}', [AdminController::class, 'destroy_admin_permission_to_employees'])->name('admins_accounts.destroy_admin_permission_to_employees');
Route::post('/admins_accounts/add_jobs_categories/{id}', [AdminController::class, 'add_jobs_categories'])->name('admins_accounts.add_jobs_categories');
Route::get('/admins_accounts/destroy_admin_permission_to_jobs_categories/{id}', [AdminController::class, 'destroy_admin_permission_to_jobs_categories'])->name('admins_accounts.destroy_admin_permission_to_jobs_categories');



/*     ═══════ ೋღ end admins  ღೋ ═══════                     */

 /*    ═══════ ೋღ start user profile ღೋ ═══════                    */
Route::get('/userProfile/index', [UserProfileController::class, 'index'])->name('userProfile.index');
Route::get('/userProfile/edit', [UserProfileController::class, 'edit'])->name('userProfile.edit');
Route::post('/userProfile/update', [UserProfileController::class, 'update'])->name('userProfile.update');

/*     ═══════ ೋღ end  user profile  ღೋ ═══════                     */




});





Route::group(['namespace' => 'Admin', 'prefix' => '/{locale?}/admin', 'middleware' => ['SetLocale','guest:admin']], function () {
    Route::get('login', [LoginController::class, 'show_login_view'])->name('admin.showlogin');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');
});




Route::fallback(function () {
    return redirect()->route('admin.dashboard',['locale'=>app()->getLocale()]);
});
