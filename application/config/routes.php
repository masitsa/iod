<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| 	example.com/class/method/id/
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
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

$route['default_controller'] = "site";
$route['404_override'] = '';

/*
*	Site Routes
*/
$route['login'] = 'member/auth/login_member';
$route['logout'] = 'member/auth/logout_member';

/*
*	Login Routes
*/
$route['login-admin'] = 'admin/auth/login_admin';
$route['logout-admin'] = 'admin/auth/logout_admin';

/*
*	Settings Routes
*/
$route['settings'] = 'admin/settings';
$route['dashboard'] = 'admin/dashboard';

/*
*	Users Routes
*/
$route['admin/administrators'] = 'admin/users';
$route['admin/administrators/(:any)/(:any)/(:num)'] = 'admin/users/index/$1/$2/$3';
$route['add-user'] = 'admin/users/add_user';
$route['edit-user/(:num)'] = 'admin/users/edit_user/$1';
$route['delete-user/(:num)'] = 'admin/users/delete_user/$1';
$route['activate-user/(:num)'] = 'admin/users/activate_user/$1';
$route['deactivate-user/(:num)'] = 'admin/users/deactivate_user/$1';
$route['reset-user-password/(:num)'] = 'admin/users/reset_password/$1';
$route['admin-profile/(:num)'] = 'admin/users/admin_profile/$1';

/*
*	Customers Routes
*/
$route['view-invoice/(:num)'] = 'admin/customers/view_invoice/$1';
$route['all-members'] = 'admin/members';
$route['all-members/(:num)'] = 'admin/members/index/$1';
$route['delete-member/(:num)'] = 'admin/members/delete_member/$1';
$route['activate-member/(:num)'] = 'admin/members/activate_member/$1';
$route['deactivate-member/(:num)'] = 'admin/members/deactivate_member/$1';

/*
*	Member Routes
*/

$route['register'] = 'member/auth/register_member';
$route['login'] = 'member/auth/login_member';
$route['logout'] = 'member/sign_out';
$route['account'] = 'member/my_account';
$route['uploads'] = 'member/uploads';

/*
*	Accounts Routes
*/
$route['admin/accounts-receivable'] = 'admin/accounts/accounts_receivable';
$route['admin/accounts-receivable/(:num)'] = 'admin/accounts/accounts_receivable/$1';
$route['admin/accounts-receivable/(:any)/(:any)/(:num)'] = 'admin/accounts/accounts_receivable/$1/$2/$3';
$route['admin/accounts-payable'] = 'admin/accounts/accounts_payable';
$route['admin/accounts-payable/(:num)'] = 'admin/accounts/accounts_payable/$1';
$route['admin/accounts-payable/(:any)/(:any)/(:num)'] = 'admin/accounts/accounts_payable/$1/$2/$3';
$route['admin/confirm-payment/(:num)/(:any)/(:any)/(:any)/(:any)'] = 'admin/accounts/confirm_payment/$1/$2/$3/$4/$5';
$route['admin/unconfirm-payment/(:num)/(:any)/(:any)/(:any)/(:any)'] = 'admin/accounts/unconfirm_payment/$1/$2/$3/$4/$5';
$route['admin/receipt-payment/(:num)/(:any)/(:any)/(:any)/(:any)'] = 'admin/accounts/receipt_payment/$1/$2/$3/$4/$5';
$route['admin/search-accounts-receivable'] = 'admin/accounts/search_accounts_receivable';
$route['admin/close-receivable-search'] = 'admin/accounts/close_accounts_receivable_search';
$route['admin/search-accounts-payable'] = 'admin/accounts/search_accounts_payable';
$route['admin/close-payable-search'] = 'admin/accounts/close_accounts_payable_search';
$route['admin/receipts'] = 'admin/accounts/receipts';
$route['admin/receipts/(:num)'] = 'admin/accounts/receipts/$1';
$route['admin/receipts/(:any)/(:any)/(:num)'] = 'admin/accounts/receipts/$1/$2/$3';
$route['admin/search-receipts'] = 'admin/accounts/search_receipts';
$route['admin/close-payable-search'] = 'admin/accounts/close_receipts_search';


//sections
$route['administration/sections'] = 'admin/sections/index';
$route['administration/sections/(:any)/(:any)/(:num)'] = 'admin/sections/index/$1/$2/$3';
$route['administration/add-section'] = 'admin/sections/add_section';
$route['administration/edit-section/(:num)'] = 'admin/sections/edit_section/$1';

$route['administration/edit-section/(:num)/(:num)'] = 'admin/sections/edit_section/$1/$2';
$route['administration/delete-section/(:num)'] = 'admin/sections/delete_section/$1';
$route['administration/delete-section/(:num)/(:num)'] = 'admin/sections/delete_section/$1/$2';
$route['administration/activate-section/(:num)'] = 'admin/sections/activate_section/$1';
$route['administration/activate-section/(:num)/(:num)'] = 'admin/sections/activate_section/$1/$2';
$route['administration/deactivate-section/(:num)'] = 'admin/sections/deactivate_section/$1';
$route['administration/deactivate-section/(:num)/(:num)'] = 'admin/sections/deactivate_section/$1/$2';

//add members
$route['members/add-member'] = 'admin/members/add_member';
//imort of members
$route['members'] = 'admin/members/index';
$route['members/validate-import'] = 'admin/members/do_members_import';
$route['import/members-template'] = 'admin/members/import_members_template';
$route['members/import-members'] = 'admin/members/import_members';

//contact 
$route['administration/contacts']='admin/contacts/show_contacts';
$route['admin/company-profile'] = 'admin/contacts/show_contacts';
/* End of file routes.php */
/* Location: ./system/application/config/routes.php */