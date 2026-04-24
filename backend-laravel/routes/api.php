<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Authenticated Routes */
Route::group(['middleware' => ['auth:sanctum']], static function () {
    /*User Module*/ 
    Route::post('reset-password', [ApiController::class, 'resetPassword']);
    Route::post('update-profile', [ApiController::class, 'updateProfile']);
    Route::delete('delete-user', [ApiController::class, 'deleteUser']);
    Route::get('get-user-info', [ApiController::class, 'getUser']);
    Route::post('logout', [ApiController::class, 'logout']);

    /*Item Module*/
    Route::get('my-items', [ApiController::class, 'getItem']);
    Route::post('add-item', [ApiController::class, 'addItem']);
    Route::post('update-item', [ApiController::class, 'updateItem']);
    Route::post('delete-item', [ApiController::class, 'deleteItem']);
    Route::post('update-item-status', [ApiController::class, 'updateItemStatus']);
    Route::get('item-buyer-list', [ApiController::class, 'getItemBuyerList']);
    Route::post('renew-item', [ApiController::class, 'renewItem']);
    Route::post('make-item-featured', [ApiController::class, 'makeFeaturedItem']);
    Route::post('manage-favourite', [ApiController::class, 'manageFavourite']);
    Route::get('get-favourite-item', [ApiController::class, 'getFavouriteItem']);
    Route::get('get-limits', [ApiController::class, 'getLimits']);

    /*Ads Review Module*/ 
    Route::post('add-item-review', [ApiController::class, 'addItemReview']);
    Route::get('my-review', [ApiController::class, 'getMyReview']);
    Route::post('add-review-report', [ApiController::class, 'addReviewReport']);

    /*Package Module */
    Route::post('assign-free-package', [ApiController::class, 'assignFreePackage']);
    Route::get('get-package', [ApiController::class, 'getPackage']);


    /* Payment Module */
    Route::get('get-payment-settings', [ApiController::class, 'getPaymentSettings']);
    Route::post('payment-intent', [ApiController::class, 'getPaymentIntent']);
    Route::get('payment-transactions', [ApiController::class, 'getPaymentTransactions']);
    Route::post('in-app-purchase', [ApiController::class, 'inAppPurchase']);
   

    /* Chat Module */
    Route::post('item-offer', [ApiController::class, 'createItemOffer']);
    Route::get('item-offer-list', [ApiController::class, 'getItemOfferList']);
    Route::get('chat-list', [ApiController::class, 'getChatList']);
    Route::post('send-message', [ApiController::class, 'sendMessage']);
    Route::get('chat-messages', [ApiController::class, 'getChatMessages']);
    Route::post('delete-chat', [ApiController::class, 'deleteChat']);
    Route::post('delete-chat-messages', [ApiController::class, 'deleteChatMessages']);

    
    /* Block-Unblock User Module */
    Route::post('block-user', [ApiController::class, 'blockUser']);
    Route::post('unblock-user', [ApiController::class, 'unblockUser']);
    Route::get('blocked-users', [ApiController::class, 'getBlockedUsers']);

    /* Follow-Unfollow User Module */
    Route::post('follow-user', [ApiController::class, 'followUser']);
    Route::post('unfollow-user', [ApiController::class, 'unfollowUser']);

    /* Seller Verification Module */
    Route::get('verification-fields', [ApiController::class, 'getVerificationFields']);
    Route::post('send-verification-request', [ApiController::class, 'sendVerificationRequest']);
    Route::get('verification-request', [ApiController::class, 'getVerificationRequest']);
    Route::post('bank-transfer-update', [ApiController::class, 'bankTransferUpdate']);

    /* Job Application Module */
    Route::post('job-apply', [ApiController::class, 'applyJob']);
    Route::get('get-job-applications', [ApiController::class, 'recruiterApplications']);
    Route::get('my-job-applications', [ApiController::class, 'myJobApplications']);
    Route::post('update-job-applications-status', [ApiController::class, 'updateJobStatus']);

    Route::post('add-reports', [ApiController::class, 'addReports']);
    Route::get('get-notification-list', [ApiController::class, 'getNotificationList']);
});

/* Non Authenticated Routes */
Route::get('user-exists', [ApiController::class, 'userExists']);
Route::get('get-currencies', [ApiController::class, 'getCurrencies']);
Route::get('get-otp', [ApiController::class, 'getOtp']); 
Route::get('countries', [ApiController::class, 'getCountries']);
Route::get('states', [ApiController::class, 'getStates']);
Route::get('cities', [ApiController::class, 'getCities']);
Route::get('areas', [ApiController::class, 'getAreas']);
Route::post('contact-us', [ApiController::class, 'storeContactUs']);
Route::get('seo-settings', [ApiController::class, 'seoSettings']);
Route::get('get-seller', [ApiController::class, 'getSeller']);
Route::get('get-categories-demo', [ApiController::class, 'getCategories']); 
Route::get('get-blogs-slug', [ApiController::class, 'getBlogsSlug']);
Route::get('get-featured-section-slug', [ApiController::class, 'getFeatureSectionSlug']);
Route::get('get-seller-slug', [ApiController::class, 'getSellerSlug']);
Route::get('get-featured-categories', [ApiController::class, 'getFeaturedCategories']);
Route::get('followers', [ApiController::class, 'getFollowers']);
Route::get('following', [ApiController::class, 'getFollowing']);
