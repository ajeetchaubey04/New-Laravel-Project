<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\UserManagement\Role\RoleController;
use App\Http\Controllers\Admin\UserManagement\User\UserController;
use App\Http\Controllers\Admin\UserManagement\Permission\PermissionController;
use App\Http\Controllers\Admin\OurAchievement\OurAchievementController;
use App\Http\Controllers\Admin\OurAssignmentController;
use App\Http\Controllers\Admin\OurAssignmentQuery\OurAssignmentQueryController;
use App\Http\Controllers\Admin\Grades\GradesController;
use App\Http\Controllers\Admin\BannerController\BannerController;
use App\Http\Controllers\Admin\Reviews\ReviewsController;
use App\Http\Controllers\Admin\OurExpert\OurExpertController;
use App\Http\Controllers\Admin\website\Courses\CoursesController;
use App\Http\Controllers\Admin\Service\ServiceController;
use App\Http\Controllers\Admin\website\AssignmentHelp\AssignmentHelpController;
use App\Http\Controllers\Admin\DiscountOffer\DiscountOfferController;
use App\Http\Controllers\Admin\Sample\SampleController;
use App\Http\Controllers\Admin\Header\HeaderNoteController;
use App\Http\Controllers\Admin\Banner2\Banner2Controller;
// use App\Http\Controllers\Admin\CustomData\CustomDataController;
use App\Http\Controllers\Admin\CountrySection\CountrySectionController;
use App\Http\Controllers\Admin\BestDeal\BestDealController;
use App\Http\Controllers\Admin\Section3\Article\ArticleController;
use App\Http\Controllers\Admin\Faq\FaqController;
use App\Http\Controllers\Admin\Blog\BlogController;
use App\Http\Controllers\Admin\HomeContent\HomeContentController;
use App\Http\Controllers\Admin\OurProvider\OurProviderController;
use App\Http\Controllers\Admin\CustomerContent\CustomerContentController;
use App\Http\Controllers\Admin\Course\CourseController;
use App\Http\Controllers\Admin\Course\SubCourseController;
use App\Http\Controllers\Admin\Country\CountryController;
use App\Http\Controllers\Admin\CountryList\CountryListController;
use App\Http\Controllers\Admin\CountryState\CountryStateController;
use App\Http\Controllers\Admin\CourseData\CourseDataController;
use App\Http\Controllers\Admin\SubjectCode\SubjectCodeController;
use App\Http\Controllers\Admin\Writer\WriterController;
use App\Http\Controllers\Admin\Result\ResultController;
use App\Http\Controllers\Admin\AboutUs\AboutUsController;
use App\Http\Controllers\Admin\OurProcess\OurProcessController;
use App\Http\Controllers\Admin\Job\JobController;
use App\Http\Controllers\Admin\ChooseUs\ChooseusController;
use App\Http\Controllers\Admin\Membership\MembershipController;
use App\Http\Controllers\Admin\TermCondition\TermConditionController;
use App\Http\Controllers\Admin\Refund\RefundController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Product\ProductController;


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

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    dd('Cache Cleared');
});

Route::get('/',              [Controller::class, 'home'])->name('home');
Route::get('/aboutus',       [Controller::class, 'aboutUs'])->name('aboutUs');
Route::get('/blogs/{slug}',  [Controller::class, 'blogs'])->name('blogs');
Route::get('/contact',       [Controller::class, 'contact'])->name('contact');
Route::get('/services',      [Controller::class, 'services'])->name('services');

/*
|--------------------------------------------------------------------------
| Start Admin Area
|--------------------------------------------------------------------------
*/


Route::get('admin/login',                   [AuthController::class, 'index'])->name('admin.login');
Route::post('admin/login',                  [AuthController::class, 'login'])->name('admin.post-login');
Route::post('admin/note-change',            [AuthController::class, 'noteChange'])->name('admin.note-change');
Route::any('admin/forgot-password',         [AuthController::class, 'forgotPassword'])->name('admin.forgot-password');
Route::get('admin/reset-password/{token}',  [AuthController::class, 'showResetPassword'])->name('admin.reset-password.get');
Route::post('admin/reset-password',         [AuthController::class, 'submitResetPassword'])->name('admin.reset-password.post');
Route::get('admin/account-restricted',      [AuthController::class, 'accountRestricted'])->name('admin.account-restricted');


Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('logout',            [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard',        [AuthController::class, 'dashboard'])->name('dashboard');
    Route::any('change-password',   [AuthController::class, 'changePassword'])->name('change-password');

        /*
        |--------------------------------------------------------------------------
        | Start Our Achievements Area
        |--------------------------------------------------------------------------
        */


        Route::prefix('product')->name('products.')->group(function () {
            Route::get('show/{id}',             [ProductController::class, 'show'])->name('show');
            Route::post('store',                [ProductController::class, 'store'])->name('store');
            Route::put('update',                [ProductController::class, 'update'])->name('update');
            Route::get('status/{id}',           [ProductController::class, 'status'])->name('status');
            Route::get('edit/{id}',             [ProductController::class, 'edit'])->name('edit');
            Route::get('delete/{id}',           [ProductController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [ProductController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [ProductController::class, 'restore'])->name('restore');
            Route::get('/{items?}',             [ProductController::class, 'index'])->name('index');
        });


         /*
        |--------------------------------------------------------------------------
        | Start Header Note Area
        |--------------------------------------------------------------------------
        */
        Route::prefix('headernote')->name('headernote.')->group(function () {
        Route::get('/{items?}',             [HeaderNoteController::class, 'index'])->name('index');
        Route::get('edit/{id}',              [HeaderNoteController::class,'edit'])->name('edit');
        Route::post('store',                 [HeaderNoteController::class, 'store'])->name('store');
        Route::get('show/{id}',              [HeaderNoteController::class, 'show'])->name('show');
        Route::get('status/{id}',            [HeaderNoteController::class, 'status'])->name('status');
        Route::put('update',            [HeaderNoteController::class, 'update'])->name('update');
        Route::get('delete/{id}',            [HeaderNoteController::class, 'destroy'])->name('delete');
        Route::get('permanent-delete/{id}',  [SampleController::class, 'permanentDelete'])->name('permanent-delete');
        Route::get('restore/{id}',           [SampleController::class, 'restore'])->name('restore');

        });


         /*
        |--------------------------------------------------------------------------
        | Start Home Content Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('homecontent')->name('homecontent.')->group(function () {
            Route::get('/{items?}',              [HomeContentController::class, 'index'])->name('index');
            Route::get('edit/{id}',              [HomeContentController::class,'edit'])->name('edit');
            Route::post('store',                 [HomeContentController::class, 'store'])->name('store');
            Route::get('show/{id}',              [HomeContentController::class, 'show'])->name('show');
            Route::get('status/{id}',            [HomeContentController::class, 'status'])->name('status');
            Route::put('update',                 [HomeContentController::class, 'update'])->name('update');
            Route::get('delete/{id}',            [HomeContentController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}',  [HomeContentController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',           [HomeContentController::class, 'restore'])->name('restore');

        });

        /*
        |--------------------------------------------------------------------------
        | Start Our Achievement Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('ourachievement')->name('ourachievement.')->group(function () {
            Route::get('/{items?}',              [OurAchievementController::class, 'index'])->name('index');
            Route::get('edit/{id}',              [OurAchievementController::class,'edit'])->name('edit');
            Route::post('store',                 [OurAchievementController::class, 'store'])->name('store');
            Route::get('show/{id}',              [OurAchievementController::class, 'show'])->name('show');
            Route::get('status/{id}',            [OurAchievementController::class, 'status'])->name('status');
            Route::put('update',                 [OurAchievementController::class, 'update'])->name('update');
            Route::get('delete/{id}',            [OurAchievementController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}',  [OurAchievementController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',           [OurAchievementController::class, 'restore'])->name('restore');

        });

        /*
        |--------------------------------------------------------------------------
        | Start Our Expert Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('ourexpert')->name('ourexpert.')->group(function () {
            Route::get('/{items?}',              [OurExpertController::class, 'index'])->name('index');
            Route::get('edit/{id}',              [OurExpertController::class,'edit'])->name('edit');
            Route::post('store',                 [OurExpertController::class, 'store'])->name('store');
            Route::get('show/{id}',              [OurExpertController::class, 'show'])->name('show');
            Route::get('status/{id}',            [OurExpertController::class, 'status'])->name('status');
            Route::put('update',                 [OurExpertController::class, 'update'])->name('update');
            Route::get('delete/{id}',            [OurExpertController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}',  [OurExpertController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',           [OurExpertController::class, 'restore'])->name('restore');

        });

        /*
        |--------------------------------------------------------------------------
        | Start Grades Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('grades')->name('grades.')->group(function () {
            Route::get('/{items?}',              [GradesController::class, 'index'])->name('index');
            Route::get('edit/{id}',              [GradesController::class,'edit'])->name('edit');
            Route::post('store',                 [GradesController::class, 'store'])->name('store');
            Route::get('show/{id}',              [GradesController::class, 'show'])->name('show');
            Route::get('status/{id}',            [GradesController::class, 'status'])->name('status');
            Route::put('update',                 [GradesController::class, 'update'])->name('update');
            Route::get('delete/{id}',            [GradesController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}',  [GradesController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',           [GradesController::class, 'restore'])->name('restore');

        });


        /*
        |--------------------------------------------------------------------------
        | Start Review Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('review')->name('reviews.')->group(function(){
            Route::get('/{items?}',              [ReviewsController::class,'index'])->name('index');
            Route::get('edit/{id}',              [ReviewsController::class,'edit'])->name('edit');
            Route::post('store',                 [ReviewsController::class, 'store'])->name('store');
            Route::get('status/{id}',            [ReviewsController::class, 'status'])->name('status');
            Route::get('delete/{id}',            [ReviewsController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}',  [ReviewsController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',           [ReviewsController::class, 'restore'])->name('restore');
            Route::put('update',                 [ReviewsController::class, 'update'])->name('update');
            Route::get('show/{id}',              [ReviewsController::class, 'show'])->name('show');
        });


        /*
        |--------------------------------------------------------------------------
        | What We Provide Section Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('ourprovider')->name('ourproviders.')->group(function(){
            Route::get('/{items?}',             [OurProviderController::class,'index'])->name('index');
            Route::get('edit/{id}',             [OurProviderController::class,'edit'])->name('edit');
            Route::post('store',                [OurProviderController::class, 'store'])->name('store');
            Route::get('status/{id}',           [OurProviderController::class, 'status'])->name('status');
            Route::get('edit/{id}',             [OurProviderController::class, 'edit'])->name('edit');
            Route::get('delete/{id}',           [OurProviderController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [OurProviderController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [OurProviderController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [OurProviderController::class, 'show'])->name('show');
            Route::put('update',                [OurProviderController::class, 'update'])->name('update');

        });


        /*
        |--------------------------------------------------------------------------
        | What Customer Content Section Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('customercontent')->name('customercontent.')->group(function(){
            Route::get('/{items?}',             [CustomerContentController::class,'index'])->name('index');
            Route::get('edit/{id}',             [CustomerContentController::class,'edit'])->name('edit');
            Route::post('store',                [CustomerContentController::class, 'store'])->name('store');
            Route::get('status/{id}',           [CustomerContentController::class, 'status'])->name('status');
            Route::get('edit/{id}',             [CustomerContentController::class, 'edit'])->name('edit');
            Route::get('delete/{id}',           [CustomerContentController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [CustomerContentController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [CustomerContentController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [CustomerContentController::class, 'show'])->name('show');
            Route::put('update',                [CustomerContentController::class, 'update'])->name('update');

        });



        /*
        |--------------------------------------------------------------------------
        | Blog Section Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('blog')->name('blog.')->group(function(){
            Route::get('/{items?}',             [BlogController::class,'index'])->name('index');
            Route::get('edit/{id}',             [BlogController::class,'edit'])->name('edit');
            Route::post('store',                [BlogController::class, 'store'])->name('store');
            Route::get('status/{id}',           [BlogController::class, 'status'])->name('status');
            Route::get('edit/{id}',             [BlogController::class, 'edit'])->name('edit');
            Route::get('delete/{id}',           [BlogController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [BlogController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [BlogController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [BlogController::class, 'show'])->name('show');
            Route::put('update',                [BlogController::class, 'update'])->name('update');

        });



        /*
        |-------------------------------------------------------------------------
        | Courses Section Area
        |-------------------------------------------------------------------------
        */

        Route::prefix('course')->name('course.')->group(function(){
            Route::get('/{items?}',             [CourseController::class,'index'])->name('index');
            Route::get('edit/{id}',             [CourseController::class,'edit'])->name('edit');
            Route::post('store',                [CourseController::class, 'store'])->name('store');
            Route::get('status/{id}',           [CourseController::class, 'status'])->name('status');
            Route::get('edit/{id}',             [CourseController::class, 'edit'])->name('edit');
            Route::get('delete/{id}',           [CourseController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [CourseController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [CourseController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [CourseController::class, 'show'])->name('show');
            Route::put('update',                [CourseController::class, 'update'])->name('update');

        });



        /*
        |--------------------------------------------------------------------------
        | Sub-Courses Section Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('sub-course')->name('sub-course.')->group(function(){
            Route::get('/{items?}',             [SubCourseController::class,'index'])->name('index');
            Route::get('edit/{id}',             [SubCourseController::class,'edit'])->name('edit');
            Route::post('store',                [SubCourseController::class, 'store'])->name('store');
            Route::get('status/{id}',           [SubCourseController::class, 'status'])->name('status');
            Route::get('edit/{id}',             [SubCourseController::class, 'edit'])->name('edit');
            Route::get('delete/{id}',           [SubCourseController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [SubCourseController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [SubCourseController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [SubCourseController::class, 'show'])->name('show');
            Route::put('update',                [SubCourseController::class, 'update'])->name('update');
            Route::get('get-course-pages', [SubCourseController::class, 'getCoursePages'])->name('getCoursePages');

        });

         /*
        |--------------------------------------------------------------------------
        | Courses-Data Section Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('coursedata')->name('coursedata.')->group(function(){
            Route::get('/{items?}',             [CourseDataController::class,'index'])->name('index');
            Route::get('edit/{id}',             [CourseDataController::class,'edit'])->name('edit');
            Route::post('store',                [CourseDataController::class, 'store'])->name('store');
            Route::get('status/{id}',           [CourseDataController::class, 'status'])->name('status');
            Route::get('edit/{id}',             [CourseDataController::class, 'edit'])->name('edit');
            Route::get('delete/{id}',           [CourseDataController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [CourseDataController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [CourseDataController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [CourseDataController::class, 'show'])->name('show');
            Route::put('update',                [CourseDataController::class, 'update'])->name('update');
            // Route::get('get-course-pages',      [CourseDataController::class, 'getCoursePages'])->name('getCoursePages');
            Route::get('/fetch-sub-courses/{courseId}', [CourseDataController::class, 'fetchSubCourses'])->name('fetchSubCourses');

        });



         /*
        |--------------------------------------------------------------------------
        | Home Country Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('country')->name('country.')->group(function(){
            Route::get('/{items?}',             [CountryController::class, 'index'])->name('index');
            Route::get('edit/{id}',             [CountryController::class, 'edit'])->name('edit');
            Route::post('store',                [CountryController::class, 'store'])->name('store');
            Route::get('status/{id}',           [CountryController::class, 'status'])->name('status');
            Route::get('delete/{id}',           [CountryController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [CountryController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [CountryController::class, 'restore'])->name('restore');
            Route::put('update/{id}',           [CountryController::class, 'update'])->name('update');
            Route::get('show/{id}',             [CountryController::class, 'show'])->name('show');

        });


        /*
        |--------------------------------------------------------------------------
        | Country List Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('countrylist')->name('countrylist.')->group(function(){
            Route::get('/{items?}',             [CountryListController::class, 'index'])->name('index');
            Route::get('edit/{id}',             [CountryListController::class, 'edit'])->name('edit');
            Route::post('store',                [CountryListController::class, 'store'])->name('store');
            Route::get('status/{id}',           [CountryListController::class, 'status'])->name('status');
            Route::get('delete/{id}',           [CountryListController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [CountryListController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [CountryListController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [CountryListController::class, 'show'])->name('show');
            Route::put('update',                [CountryListController::class, 'update'])->name('update');

        });


        /*
        |--------------------------------------------------------------------------
        | Inner Country Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('countrysection')->name('countrysection.')->group(function(){

            Route::get('/{items?}',             [CountrySectionController::class, 'index'])->name('index');
            Route::get('edit/{id}',             [CountrySectionController::class, 'edit'])->name('edit');
            Route::post('store',                [CountrySectionController::class, 'store'])->name('store');
            Route::get('status/{id}',           [CountrySectionController::class, 'status'])->name('status');
            Route::get('delete/{id}',           [CountrySectionController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [CountrySectionController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [CountrySectionController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [CountrySectionController::class, 'show'])->name('show');
            Route::put('update',                [CountrySectionController::class, 'update'])->name('update');

        });



        /*
        |--------------------------------------------------------------------------
        | Country State Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('countrystate')->name('countrystate.')->group(function(){

            Route::get('/{items?}',             [CountryStateController::class, 'index'])->name('index');
            Route::get('edit/{id}',             [CountryStateController::class, 'edit'])->name('edit');
            Route::post('store',                [CountryStateController::class, 'store'])->name('store');
            Route::get('status/{id}',           [CountryStateController::class, 'status'])->name('status');
            Route::get('delete/{id}',           [CountryStateController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [CountryStateController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [CountryStateController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [CountryStateController::class, 'show'])->name('show');
            Route::put('update',                [CountryStateController::class, 'update'])->name('update');

        });


        /*
        |--------------------------------------------------------------------------
        | Services Area Section
        |--------------------------------------------------------------------------
        */

        Route::prefix('services')->name('services.')->group(function(){

            Route::get('/{items?}',             [ServiceController::class, 'index'])->name('index');
            Route::get('edit/{id}',             [ServiceController::class, 'edit'])->name('edit');
            Route::post('store',                [ServiceController::class, 'store'])->name('store');
            Route::get('status/{id}',           [ServiceController::class, 'status'])->name('status');
            Route::get('delete/{id}',           [ServiceController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [ServiceController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [ServiceController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [ServiceController::class, 'show'])->name('show');
            Route::put('update',                [ServiceController::class, 'update'])->name('update');

        });


        /*
        |--------------------------------------------------------------------------
        | Sample Section
        |--------------------------------------------------------------------------
        */

        Route::prefix('samples')->name('samples.')->group(function(){

            Route::get('/{items?}',             [SampleController::class, 'index'])->name('index');
            Route::get('edit/{id}',             [SampleController::class, 'edit'])->name('edit');
            Route::post('store',                [SampleController::class, 'store'])->name('store');
            Route::get('status/{id}',           [SampleController::class, 'status'])->name('status');
            Route::get('delete/{id}',           [SampleController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [SampleController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [SampleController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [SampleController::class, 'show'])->name('show');
            Route::put('update',                [SampleController::class, 'update'])->name('update');

        });

         /*
        |--------------------------------------------------------------------------
        | Faq Section
        |--------------------------------------------------------------------------
        */

        Route::prefix('faqsection')->name('faqsection.')->group(function(){

            Route::get('/{items?}',             [FaqController::class, 'index'])->name('index');
            Route::get('edit/{id}',             [FaqController::class, 'edit'])->name('edit');
            Route::post('store',                [FaqController::class, 'store'])->name('store');
            Route::get('status/{id}',           [FaqController::class, 'status'])->name('status');
            Route::get('delete/{id}',           [FaqController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [FaqController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [FaqController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [FaqController::class, 'show'])->name('show');
            Route::put('update',                [FaqController::class, 'update'])->name('update');

        });


        /*
        |--------------------------------------------------------------------------
        | Subject Code Section
        |--------------------------------------------------------------------------
        */

        Route::prefix('subjectcode')->name('subjectcode.')->group(function(){

            Route::get('/{items?}',             [SubjectCodeController::class, 'index'])->name('index');
            Route::get('edit/{id}',             [SubjectCodeController::class, 'edit'])->name('edit');
            Route::post('store',                [SubjectCodeController::class, 'store'])->name('store');
            Route::get('status/{id}',           [SubjectCodeController::class, 'status'])->name('status');
            Route::get('delete/{id}',           [SubjectCodeController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [SubjectCodeController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [SubjectCodeController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [SubjectCodeController::class, 'show'])->name('show');
            Route::put('update',                [SubjectCodeController::class, 'update'])->name('update');

        });


        /*
        |--------------------------------------------------------------------------
        | Writer Code Section
        |--------------------------------------------------------------------------
        */

        Route::prefix('writer')->name('writers.')->group(function(){

            Route::get('/{items?}',             [WriterController::class, 'index'])->name('index');
            Route::get('edit/{id}',             [WriterController::class, 'edit'])->name('edit');
            Route::post('store',                [WriterController::class, 'store'])->name('store');
            Route::get('status/{id}',           [WriterController::class, 'status'])->name('status');
            Route::get('delete/{id}',           [WriterController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [WriterController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [WriterController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [WriterController::class, 'show'])->name('show');
            Route::put('update',                [WriterController::class, 'update'])->name('update');

        });


        /*
        |--------------------------------------------------------------------------
        | Results Section
        |--------------------------------------------------------------------------
        */

        Route::prefix('result')->name('results.')->group(function(){

            Route::get('/{items?}',             [ResultController::class, 'index'])->name('index');
            Route::get('edit/{id}',             [ResultController::class, 'edit'])->name('edit');
            Route::post('store',                [ResultController::class, 'store'])->name('store');
            Route::get('status/{id}',           [ResultController::class, 'status'])->name('status');
            Route::get('delete/{id}',           [ResultController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [ResultController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [ResultController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [ResultController::class, 'show'])->name('show');
            Route::put('update',                [ResultController::class, 'update'])->name('update');

        });

        /*
        |--------------------------------------------------------------------------
        | About Us Section
        |--------------------------------------------------------------------------
        */

        Route::prefix('aboutus')->name('aboutus.')->group(function(){

            Route::get('/{items?}',             [AboutUsController::class, 'index'])->name('index');
            Route::get('edit/{id}',             [AboutUsController::class, 'edit'])->name('edit');
            Route::post('store',                [AboutUsController::class, 'store'])->name('store');
            Route::get('status/{id}',           [AboutUsController::class, 'status'])->name('status');
            Route::get('delete/{id}',           [AboutUsController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [AboutUsController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [AboutUsController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [AboutUsController::class, 'show'])->name('show');
            Route::put('update',                [AboutUsController::class, 'update'])->name('update');

        });

        /*
        |--------------------------------------------------------------------------
        | Our Process Section
        |--------------------------------------------------------------------------
        */

        Route::prefix('ourprocess')->name('ourprocess.')->group(function(){

            Route::get('/{items?}',             [OurProcessController::class, 'index'])->name('index');
            Route::get('edit/{id}',             [OurProcessController::class, 'edit'])->name('edit');
            Route::post('store',                [OurProcessController::class, 'store'])->name('store');
            Route::get('status/{id}',           [OurProcessController::class, 'status'])->name('status');
            Route::get('delete/{id}',           [OurProcessController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [OurProcessController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [OurProcessController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [OurProcessController::class, 'show'])->name('show');
            Route::put('update',                [OurProcessController::class, 'update'])->name('update');

        });



        /*
        |--------------------------------------------------------------------------
        | Our Jobs Section
        |--------------------------------------------------------------------------
        */

        Route::prefix('jobs')->name('jobs.')->group(function(){

            Route::get('/{items?}',             [JobController::class, 'index'])->name('index');
            Route::get('edit/{id}',             [JobController::class, 'edit'])->name('edit');
            Route::post('store',                [JobController::class, 'store'])->name('store');
            Route::get('status/{id}',           [JobController::class, 'status'])->name('status');
            Route::get('delete/{id}',           [JobController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [JobController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [JobController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [JobController::class, 'show'])->name('show');
            Route::put('update',                [JobController::class, 'update'])->name('update');

        });

        /*
        |--------------------------------------------------------------------------
        | Why Choose Us Section
        |--------------------------------------------------------------------------
        */

        Route::prefix('chooseus')->name('chooseus.')->group(function(){

            Route::get('/{items?}',             [ChooseUsController::class, 'index'])->name('index');
            Route::get('edit/{id}',             [ChooseUsController::class, 'edit'])->name('edit');
            Route::post('store',                [ChooseUsController::class, 'store'])->name('store');
            Route::get('status/{id}',           [ChooseUsController::class, 'status'])->name('status');
            Route::get('delete/{id}',           [ChooseUsController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [ChooseUsController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [ChooseUsController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [ChooseUsController::class, 'show'])->name('show');
            Route::put('update',                [ChooseUsController::class, 'update'])->name('update');

        });

        /*
        |--------------------------------------------------------------------------
        | Membership Section
        |--------------------------------------------------------------------------
        */

        Route::prefix('membership')->name('membership.')->group(function(){

            Route::get('/{items?}',             [MembershipController::class, 'index'])->name('index');
            Route::get('edit/{id}',             [MembershipController::class, 'edit'])->name('edit');
            Route::post('store',                [MembershipController::class, 'store'])->name('store');
            Route::get('status/{id}',           [MembershipController::class, 'status'])->name('status');
            Route::get('delete/{id}',           [MembershipController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [MembershipController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [MembershipController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [MembershipController::class, 'show'])->name('show');
            Route::put('update',                [MembershipController::class, 'update'])->name('update');

        });

        /*
        |--------------------------------------------------------------------------
        | Term & Condition Section
        |--------------------------------------------------------------------------
        */

        Route::prefix('termcondition')->name('termcondition.')->group(function(){

            Route::get('/{items?}',             [TermConditionController::class, 'index'])->name('index');
            Route::get('edit/{id}',             [TermConditionController::class, 'edit'])->name('edit');
            Route::post('store',                [TermConditionController::class, 'store'])->name('store');
            Route::get('status/{id}',           [TermConditionController::class, 'status'])->name('status');
            Route::get('delete/{id}',           [TermConditionController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [TermConditionController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [TermConditionController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [TermConditionController::class, 'show'])->name('show');
            Route::put('update',                [TermConditionController::class, 'update'])->name('update');

        });

        /*
        |--------------------------------------------------------------------------
        | Refund Policy Section
        |--------------------------------------------------------------------------
        */

        Route::prefix('refunds')->name('refunds.')->group(function(){

            Route::get('/{items?}',             [RefundController::class, 'index'])->name('index');
            Route::get('edit/{id}',             [RefundController::class, 'edit'])->name('edit');
            Route::post('store',                [RefundController::class, 'store'])->name('store');
            Route::get('status/{id}',           [RefundController::class, 'status'])->name('status');
            Route::get('delete/{id}',           [RefundController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [RefundController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [RefundController::class, 'restore'])->name('restore');
            Route::get('show/{id}',             [RefundController::class, 'show'])->name('show');
            Route::put('update',                [RefundController::class, 'update'])->name('update');

        });


        /*
        |--------------------------------------------------------------------------
        | Start Banner Section Area
        |--------------------------------------------------------------------------
        */
            Route::prefix('banners')->name('banner.')->group(function () {
            Route::get('show/{id}',             [BannerController::class, 'show'])->name('show');
            Route::post('store',                [BannerController::class, 'store'])->name('store');
            Route::put('update',                [BannerController::class, 'update'])->name('update');
            Route::get('status/{id}',           [BannerController::class, 'status'])->name('status');
            Route::get('edit/{id}',             [BannerController::class, 'edit'])->name('edit');
            Route::get('delete/{id}',           [BannerController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [BannerController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [BannerController::class, 'restore'])->name('restore');
            Route::get('/{items?}',             [BannerController::class, 'index'])->name('index');
        });

        /*
        |--------------------------------------------------------------------------
        | Start Best Deal Section Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('bestdeal')->name('bestdeal.')->group(function () {
            Route::get('show/{id}',             [BestDealController::class, 'show'])->name('show');
            Route::post('store',                [BestDealController::class, 'store'])->name('store');
            Route::put('update',                [BestDealController::class, 'update'])->name('update');
            Route::get('status/{id}',           [BestDealController::class, 'status'])->name('status');
            Route::get('edit/{id}',             [BestDealController::class, 'edit'])->name('edit');
            Route::get('delete/{id}',           [BestDealController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [BestDealController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [BestDealController::class, 'restore'])->name('restore');
            Route::get('/{items?}',             [BestDealController::class, 'index'])->name('index');
        });


        /*
        |--------------------------------------------------------------------------
        | Start Order Section Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('show/{id}',             [OrderController::class, 'show'])->name('show');
            Route::post('store',                [OrderController::class, 'store'])->name('store');
            Route::put('update',                [OrderController::class, 'update'])->name('update');
            Route::get('status/{id}',           [OrderController::class, 'status'])->name('status');
            Route::get('edit/{id}',             [OrderController::class, 'edit'])->name('edit');
            Route::get('delete/{id}',           [OrderController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [OrderController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [OrderController::class, 'restore'])->name('restore');
            Route::get('/{items?}',             [OrderController::class, 'index'])->name('index');
        });

    /*
    |--------------------------------------------------------------------------
    | Start Faqs Area
    |--------------------------------------------------------------------------
    */

    Route::prefix('faq')->name('faq.')->group(function () {
        Route::get('show/{id}',             [FaqController::class, 'show'])->name('show');
        Route::post('store',                [FaqController::class, 'store'])->name('store');
        Route::put('update',                [FaqController::class, 'update'])->name('update');
        Route::get('status/{id}',           [FaqController::class, 'status'])->name('status');
        Route::get('edit/{id}',             [FaqController::class, 'edit'])->name('edit');
        Route::get('delete/{id}',           [FaqController::class, 'destroy'])->name('delete');
        Route::get('permanent-delete/{id}', [FaqController::class, 'permanentDelete'])->name('permanent-delete');
        Route::get('restore/{id}',          [FaqController::class, 'restore'])->name('restore');
        Route::get('meta/{id}',             [FaqController::class, 'meta'])->name('meta');
        Route::put('meta',                  [FaqController::class, 'metaStore'])->name('meta-store');
        Route::get('/{items?}',             [FaqController::class, 'index'])->name('index');
    });

    /*
    |--------------------------------------------------------------------------
    | Start Blogs Area
    |--------------------------------------------------------------------------
    */

    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('show/{id}',             [BlogController::class, 'show'])->name('show');
        Route::post('store',                [BlogController::class, 'store'])->name('store');
        Route::put('update',                [BlogController::class, 'update'])->name('update');
        Route::get('status/{id}',           [BlogController::class, 'status'])->name('status');
        Route::get('edit/{id}',             [BlogController::class, 'edit'])->name('edit');
        Route::get('delete/{id}',           [BlogController::class, 'destroy'])->name('delete');
        Route::get('permanent-delete/{id}', [BlogController::class, 'permanentDelete'])->name('permanent-delete');
        Route::get('restore/{id}',          [BlogController::class, 'restore'])->name('restore');
        Route::get('meta/{id}',             [BlogController::class, 'meta'])->name('meta');
        Route::put('meta',                  [BlogController::class, 'metaStore'])->name('meta-store');
        Route::get('/{items?}',             [BlogController::class, 'index'])->name('index');
    });


     /*
    |--------------------------------------------------------------------------
    | Start User Management Area
    |--------------------------------------------------------------------------
    */

    Route::prefix('user-management')->name('user-management.')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Start User Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('user')->name('user.')->group(function () {
            // Route::get('/search/{items?}', [PermissionController::class, 'search'])->name('search');
            Route::post('store',                [UserController::class, 'store'])->name('store');
            Route::put('update',                [UserController::class, 'update'])->name('update');
            Route::get('status/{id}',           [UserController::class, 'status'])->name('status');
            Route::get('edit/{id}',             [UserController::class, 'edit'])->name('edit');
            Route::get('delete/{id}',           [UserController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [UserController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [UserController::class, 'restore'])->name('restore');
            Route::get('{items?}',              [UserController::class, 'index'])->name('index');
        });

        /*
        |--------------------------------------------------------------------------
        | Start Role Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('role')->name('role.')->group(function () {
            // Route::get('/search/{items?}', [PermissionController::class, 'search'])->name('search');
            Route::post('store',                [RoleController::class, 'store'])->name('store');
            Route::put('update',                [RoleController::class, 'update'])->name('update');
            Route::get('status/{id}',           [RoleController::class, 'status'])->name('status');
            Route::get('edit/{id}',             [RoleController::class, 'edit'])->name('edit');
            Route::get('delete/{id}',           [RoleController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [RoleController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [RoleController::class, 'restore'])->name('restore');
            Route::get('{items?}',              [RoleController::class, 'index'])->name('index');
        });

        /*
        |--------------------------------------------------------------------------
        | Start Permission Area
        |--------------------------------------------------------------------------
        */

        Route::prefix('permission')->name('permission.')->group(function () {
            // Route::get('/search/{items?}', [PermissionController::class, 'search'])->name('search');
            Route::post('store',                [PermissionController::class, 'store'])->name('store');
            Route::put('update',                [PermissionController::class, 'update'])->name('update');
            Route::get('status/{id}',           [PermissionController::class, 'status'])->name('status');
            Route::get('edit/{id}',             [PermissionController::class, 'edit'])->name('edit');
            Route::get('delete/{id}',           [PermissionController::class, 'destroy'])->name('delete');
            Route::get('permanent-delete/{id}', [PermissionController::class, 'permanentDelete'])->name('permanent-delete');
            Route::get('restore/{id}',          [PermissionController::class, 'restore'])->name('restore');
            Route::get('/{items?}',             [PermissionController::class, 'index'])->name('index');
        });


    });
});
