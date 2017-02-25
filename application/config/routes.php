<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

$route['default_controller'] = "welcome";
$route['404_override'] = '';

$route['uploads/(:any)/(:any)'] = "media/resize/";
//$route['uploads/(:any)/(:any)/(:any)'] 	= "image/resize/";
//$route['uploads/(:any)/(:any)/(:any)/(:any)'] 	= "image/resize/";
//======= Front End Page ===============//

$route['en'] = "welcome/change_language/en";
$route['fr'] = "welcome/change_language/fr";
$route['compare'] = "welcome/compare";
$route['subscribe-newsletter'] = 'welcome/subscriber';
$route['registration'] = 'login/registration';
$route['home'] = 'welcome/index';
$route['page/(:any)'] = 'content/index/$1';
$route['select-city'] = 'blog/select_city';
$route['product-types'] = 'welcome/productByTypeId';
$route['login'] = 'account/login/index';
$route['logout'] = 'logout/index';
$route['cart'] = 'cart/index';
$route['add-cart-item'] = 'cart/addCartItem';
$route['add-compare-item'] = 'product/addCompareItem';
$route['update-item-quantity'] = 'cart/updateItemQuantity';
$route['delete-cart-item/(:num)'] = 'cart/deleteCartItem/$1';
$route['empty-cart'] = 'cart/deleteCart';
$route['shipping'] = 'order/index';
//$route['order-review'] = 'order/orderreview';
$route['order-confirmation'] = 'order/finalization';
$route['cancel-order'] = 'order/cancelorder';
$route['thanks-for-order'] = 'order/orderThanks';
$route['blog'] = 'blog/index';
$route['blog-category/(:any)'] = 'blog/blogcategory/$1';
$route['blog/getBlogData'] = 'blog/getBlogData';
//$route['blog-comment'] = 'blog/blogcomment';
$route['blog/(:any)'] = 'blog/blogdetail/$1';
$route['enquiry-form'] = 'enquiry/index';
$route['product/(:any)'] = 'category/productdetail/$1';
$route['product-search'] = 'category/productSearch';
$route['contact'] = 'contact/index';
$route['hotels'] = 'category/index';
$route['category/getProductsData/(:num)'] = 'category/getProductsData/$1';
$route['category/getProductsTypeData/(:num)'] = 'category/getProductsTypeData/$1';
$route['category/(:any)'] = 'category/productsByCategory/$1';
$route['type/(:any)'] = 'category/productsByType/$1';
$route['ajax-province-list'] = 'cart/getProvinceList';
$route['apply-tax-values'] = 'cart/saveTaxInformation';
$route['apply-coupon-code'] = 'cart/applyCoupon';
//$route['ajax-city-list'] = 'admin/city/getCityList';
$route['ajax-room-price'] = 'category/getRoomPrice';
$route['upload-product-images'] = 'admin/product-image/upload_image';

//Urls For Organizers who create Surveys

$route['dashboard'] = 'account/auth_public/index';
$route['account/update-account'] = 'account/auth_public/update_account';
$route['account/change-password'] = 'account/auth_public/change_password';
$route['account/update-email'] = 'account/auth_public/update_email';
$route['account/update-email/(:num)/(:any)'] = 'account/auth_public/update_email/$1/$2';
$route['account/order-history'] = 'account/auth_public/order_history';
$route['account/addresses'] = 'account/auth_public/manage_address_book';
$route['account/create-address'] = 'account/auth_public/insert_address';
$route['account/update-address/(:num)'] = 'account/auth_public/update_address/$1';
$route['account/delete-address/(:num)'] = 'account/auth_public/delete_address/$1';
$route['account/logout'] = 'account/login/logout';
$route['register'] = 'account/login/register_account';

//$route['survey'] = 'survey/survey_step_1/';
$route['survey/(:any)'] = 'survey/survey_collect_response/$1';
$route['ajax-save-question'] = 'survey/ajax_save_question/';
$route['ajax-fetch-survey-feeds'] = 'welcome/fetch_survey_feeds/';
$route['ajax-fetch-survey-questions'] = 'survey/ajax_get_survey_questions/';
$route['ajax-edit-survey-question'] = 'survey/ajax_edit_survey_question/';
$route['ajax-delete-survey-question'] = 'survey/ajax_delete_survey_question/';


//Organization Routes

$route['organization'] = 'organization/index/';
$route['ajax-register-surveyor'] = 'organization/ajax_register_surveyor/';
$route['ajax-change-surveyor-status'] = 'organization/ajax_change_surveyor_status/';
$route['ajax-update-organization-details'] = 'organization/ajax_update_organization_details/';

//Survey Reponse Routes
$route['published-response'] = 'survey/published_response/';
$route['draft-response'] = 'survey/draft_response/';
$route['survey-response-published/(:any)'] = 'survey/survey_response_published/$1';
$route['survey-response-draft/(:any)'] = 'survey/survey_response_draft/$1';
$route['ajax-publish-survey-response'] = 'survey/ajax_publish_survey_response/';
$route['ajax-upload-media'] = 'survey/ajax_upload_media/';



//======= Admin Related Urls===================//


$route['admin/website-links'] = 'admin/website/index';

$route['admin/banner-list'] = 'admin/banner/index';
$route['admin/banner-add'] = 'admin/banner/add';
$route['admin/banner-edit/(:num)'] = 'admin/banner/edit/$1';
$route['admin/banner-delete/(:num)'] = 'admin/banner/delete/$1';
$route['admin/banner-status/(:num)/(:any)'] = 'admin/banner/approve/$1/$2';
$route['admin/banner-grid-data'] = 'admin/banner/ajax_banner_data';

$route['admin/blog-list'] = 'admin/blog/index';
$route['admin/blog-add'] = 'admin/blog/add';
$route['admin/blog-edit/(:num)'] = 'admin/blog/edit/$1';
$route['admin/blog-delete/(:num)'] = 'admin/blog/delete/$1';
$route['admin/blog-status/(:num)/(:any)'] = 'admin/blog/approve/$1/$2';

$route['admin/blog-category-list'] = 'admin/blog_category/index';
$route['admin/blog-category-add'] = 'admin/blog_category/add';
$route['admin/blog-category-edit/(:num)'] = 'admin/blog_category/edit/$1';
$route['admin/blog-category-delete/(:num)'] = 'admin/blog_category/delete/$1';
$route['admin/blog-category-status/(:num)/(:any)'] = 'admin/blog_category/approve/$1/$2';

$route['admin/blog-comment/(:num)'] = 'admin/blogcomment/index/$1';
$route['admin/comment-delete/(:num)'] = 'admin/blogcomment/delete/$1';
$route['admin/comment-status/(:num)/(:any)'] = 'admin/blogcomment/approve/$1/$2';

$route['admin/enquiry-list'] = 'admin/enquiry/index';
$route['admin/enquiry-view/(:num)'] = 'admin/enquiry/view/$1';
$route['admin/enquiry-delete/(:num)'] = 'admin/enquiry/delete/$1';

$route['admin/nav_menu-list'] = 'admin/nav_menu/index';
$route['admin/nav_menu-add'] = 'admin/nav_menu/add';
$route['admin/nav_menu-edit/(:num)'] = 'admin/nav_menu/edit/$1';
$route['admin/nav_menu-delete/(:num)'] = 'admin/nav_menu/delete/$1';
$route['admin/nav_menu-status/(:num)/(:any)'] = 'admin/nav_menu/approve/$1/$2';


$route['admin/metatag-list'] = 'admin/metatag/index';
$route['admin/metatag-add'] = 'admin/metatag/add';
$route['admin/metatag-edit/(:num)'] = 'admin/metatag/edit/$1';
$route['admin/metatag-delete/(:num)'] = 'admin/metatag/delete/$1';
$route['admin/metatag-status/(:num)/(:any)'] = 'admin/metatag/approve/$1/$2';

$route['admin/country-list'] = 'admin/country/index';
$route['admin/country-add'] = 'admin/country/add';
$route['admin/country-edit/(:num)'] = 'admin/country/edit/$1';
$route['admin/country-delete/(:num)'] = 'admin/country/delete/$1';
$route['admin/country-status/(:num)/(:any)'] = 'admin/country/approve/$1/$2';

$route['admin/province-list'] = 'admin/province/index';
$route['admin/province-add'] = 'admin/province/add';
$route['admin/province-edit/(:num)'] = 'admin/province/edit/$1';
$route['admin/province-delete/(:num)'] = 'admin/province/delete/$1';
$route['admin/province-status/(:num)/(:any)'] = 'admin/province/approve/$1/$2';

$route['admin/page-list'] = 'admin/page/index';
$route['admin/page-add'] = 'admin/page/add';
$route['admin/page-edit/(:num)'] = 'admin/page/edit/$1';
$route['admin/page-delete/(:num)'] = 'admin/page/delete/$1';
$route['admin/page-status/(:num)/(:any)'] = 'admin/page/approve/$1/$2';

$route['admin/post-list'] = 'admin/post/index';
$route['admin/post-add'] = 'admin/post/add';
$route['admin/post-edit/(:num)'] = 'admin/post/edit/$1';
$route['admin/post-delete/(:num)'] = 'admin/post/delete/$1';
$route['admin/post-status/(:num)/(:any)'] = 'admin/post/approve/$1/$2';



$route['admin/product-list'] = 'admin/product/index';
$route['admin/product-add'] = 'admin/product/add';
$route['admin/product-edit/(:num)'] = 'admin/product/edit/$1';
$route['admin/product-delete/(:num)'] = 'admin/product/delete/$1';
$route['admin/product-status/(:num)/(:any)'] = 'admin/product/approve/$1/$2';

$route['admin/product_review-list/(:num)'] = 'admin/product_review/index/$1';
$route['admin/product_review-view/(:num)'] = 'admin/product_review/view/$1';
$route['admin/product_review-delete/(:num)'] = 'admin/product_review/delete/$1';
$route['admin/product_review-status/(:num)/(:any)'] = 'admin/product_review/approve/$1/$2';

$route['admin/upload-product-images/(:num)'] = 'admin/product_image/uploadImages/$1';
$route['admin/product_image-list/(:num)'] = 'admin/product_image/productImageSpecification/$1';
$route['admin/product-image-delete/(:num)'] = 'admin/product_image/delete/$1';

$route['admin/product_types-list'] = 'admin/product_types/index';
$route['admin/product_types-add'] = 'admin/product_types/add';
$route['admin/product_types-edit/(:num)'] = 'admin/product_types/edit/$1';
$route['admin/product_types-delete/(:num)'] = 'admin/product_types/delete/$1';
$route['admin/product_types-status/(:num)/(:any)'] = 'admin/product_types/approve/$1/$2';

$route['admin/category-list/(:num)'] = 'admin/category/index/$1';
$route['admin/category-list'] = 'admin/category/index';
$route['admin/category-add/(:num)'] = 'admin/category/add/$1';
$route['admin/category-add'] = 'admin/category/add';
$route['admin/category-edit/(:num)'] = 'admin/category/edit/$1';
$route['admin/category-delete/(:num)'] = 'admin/category/delete/$1';
$route['admin/category-status/(:num)/(:any)'] = 'admin/category/approve/$1/$2';

$route['admin/order-list'] = 'admin/order/index';
$route['admin/order-status/(:num)/(:any)'] = 'admin/order/approve/$1/$2';
$route['admin/order-delete/(:num)'] = 'admin/order/delete/$1';
$route['admin/order-view/(:num)'] = 'admin/order/view/$1';

$route['admin/smtp-list'] = 'admin/smtp/index';
$route['admin/smtp-add'] = 'admin/smtp/add';
$route['admin/smtp-edit/(:num)'] = 'admin/smtp/edit/$1';
$route['admin/smtp-delete/(:num)'] = 'admin/smtp/delete/$1';
$route['admin/smtp-status/(:num)/(:any)'] = 'admin/smtp/approve/$1/$2';

//User manage
//Customer
$route['admin/customer-list'] = 'admin/customer/index';
$route['admin/customer-edit/(:num)'] = 'admin/customer/edit/$1';
$route['admin/customer-status/(:num)/(:num)'] = 'admin/customer/approve/$1/$2';
$route['admin/customer-delete/(:num)'] = 'admin/customer/delete/$1';

//Service Provider
$route['admin/service-provider-list'] = 'admin/service_provider/index';
$route['admin/service-provider-edit/(:num)'] = 'admin/service_provider/edit/$1';
$route['admin/service-provider-status/(:num)/(:num)'] = 'admin/service_provider/approve/$1/$2';
$route['admin/service-provider-delete/(:num)'] = 'admin/service_provider/delete/$1';
$route['admin/service-provider-check-images/(:num)'] = 'admin/service_provider/check_images/$1/$2';

//New Vendor Routs
$route['admin/add-vendor-products-list/(:num)'] = 'admin/vendor_products/add_vendor_product/$1';
$route['admin/add-vendor-product'] = 'admin/vendor_products/addVendorProduct';
$route['admin/manage-vendor-products-list/(:num)'] = 'admin/vendor_products/manage_vendor_product/$1';
$route['admin/edit-vendor-product/(:num)'] = 'admin/vendor_products/edit_vendor_product/$1';
$route['admin/delete-vendor-product/(:num)'] = 'admin/vendor_products/delete_vendor_product/$1';


$route['admin/forgot-password'] = 'admin/login/forgot-Password';
$route['admin/change-password'] = 'admin/login/change_password';

$route['admin/ajax-category-list'] = 'admin/product/getSubCategory';
//======= Account Related Urls===================//

$route['account/login'] = 'account/login/index';
$route['login-ajax'] = 'account/login/login_via_ajax';
//$route['account'] = 'account/login/register_account';
//$route['quick-registration'] = 'account/login/quick_register_account';
$route['registration-customer'] = 'account/login/register_account_customer';
$route['registration-service-provider'] = 'account/login/register_account_service_provider';
$route['quick-registration-ajax'] = 'account/login/quick_register_account_via_ajax';
$route['account-activation/(:num)/(:any)'] = 'account/login/activate_account/$1/$2';
$route['account-activation'] = 'account/login/activate_account';
$route['activation-token-resend'] = 'account/login/resend_activation_token';
$route['forgot-password'] = 'account/login/forgotten_password';
$route['reset-forgot-password/(:num)/(:any)'] = 'account/login/manual_reset_forgotten_password/$1/$2';
$route['auto-reset-forgot-password'] = 'account/login/auto_reset_forgotten_password';



$route['admin'] = 'account/login/secure_login';
$route['admin/login'] = 'account/login/secure_login';
$route['admin/logout'] = 'account/login/secure_logout';
$route['admin/dashboard'] = 'account/auth_admin/index';
$route['secure-panel/user-management'] = 'account/auth_admin/manage_user_accounts';
$route['secure-panel/create-user'] = 'account/auth_admin/register_new_user';
$route['secure-panel/update-user/(:num)'] = 'account/auth_admin/update_user_account/$1';
$route['secure-panel/user-groups-management'] = 'account/auth_admin/manage_user_groups';
$route['secure-panel/create-user-group'] = 'account/auth_admin/insert_user_group';
$route['secure-panel/update-user-group/(:num)'] = 'account/auth_admin/update_user_group/$1';
$route['secure-panel/privileges-management'] = 'account/auth_admin/manage_privileges';
$route['secure-panel/create-privileges'] = 'account/auth_admin/insert_privilege';
$route['secure-panel/update-privileges/(:num)'] = 'account/auth_admin/update_privilege/$1';
$route['secure-panel/update-user-privileges/(:num)'] = 'account/auth_admin/update_user_privileges/$1';
$route['secure-panel/update-group-privileges/(:num)'] = 'account/auth_admin/update_group_privileges/$1';
$route['secure-panel/list-status-of-users'] = 'account/auth_admin/list_user_status';
$route['secure-panel/list-status-of-users/(:any)'] = 'account/auth_admin/list_user_status/$1';
$route['secure-panel/delete-unactivated-users'] = 'account/auth_admin/delete_unactivated_users';
$route['secure-panel/failed-users'] = 'account/auth_admin/failed_login_users';




//$route['(:any)'] = 'content/index/$1';


/* End of file routes.php */
/* Location: ./application/config/routes.php */