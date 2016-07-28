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
$route['home'] = 'site/home_page';
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
$route['view-invoice/(:num)'] = 'member/download_invoice/$1';
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
$route['member/notifications'] = 'member/notifications';
$route['member/invoices'] = 'member/my_account';
$route['member/events'] = 'member/events/event_list';
$route['member/events/(:num)'] = 'member/events/event_list/$1';
$route['member/events/(:any)'] = 'member/events/event_single/$1';
$route['member/resources'] = 'member/resources';
$route['member/resources/(:num)'] = 'member/resources/$1';
$route['member/resources/(:any)/(:num)'] = 'member/resources/$1/$2';
$route['member/resources/(:any)'] = 'member/resources/$1';
$route['member/offers'] = 'member/offers';
$route['member/profile'] = 'member/profile';

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
$route['users/members'] = 'admin/members/index';
$route['members/validate-import'] = 'admin/members/do_members_import';
$route['import/members-template'] = 'admin/members/import_members_template';
$route['import/individuals-template'] = 'admin/members/import_members_template';
$route['users/import-members'] = 'admin/members/import_members';

//contact 
$route['administration/contacts']='admin/contacts/show_contacts';
$route['admin/company-profile'] = 'admin/contacts/show_contacts';

//about us routes
$route['front-page-about'] = 'admin/blog/front_post/32';

//company services
$route['content/services'] = 'admin/services/index';
$route['administration/all-services'] = 'admin/services/index';
$route['administration/all-services/(:num)'] = 'admin/services/index/$1';//with a page number
$route['administration/add-service'] = 'admin/services/add_service';
$route['administration/edit-service/(:num)/(:num)'] = 'admin/services/edit_service/$1/$2';
$route['administration/activate-service/(:num)/(:num)'] = 'admin/services/activate_service/$1/$2';
$route['administration/deactivate-service/(:num)/(:num)'] = 'admin/services/deactivate_service/$1/$2';
$route['administration/delete-service/(:num)/(:num)'] = 'admin/services/delete_service/$1/$2';

//company routes
$route['content/gallery'] = 'admin/gallery';
$route['administration/all-gallery-images'] = 'admin/gallery/index';
$route['administration/all-gallery-images/(:num)'] = 'admin/gallery/index/$1';//with a page number
$route['administration/add-gallery'] = 'admin/gallery/add_gallery';
$route['administration/edit-gallery/(:num)/(:num)'] = 'admin/gallery/edit_gallery/$1/$2';
$route['administration/activate-gallery/(:num)/(:num)'] = 'admin/gallery/activate_gallery/$1/$2';
$route['administration/deactivate-gallery/(:num)/(:num)'] = 'admin/gallery/deactivate_gallery/$1/$2';
$route['administration/delete-gallery/(:num)/(:num)'] = 'admin/gallery/delete_gallery/$1/$2';

$route['member-account/notifications'] = 'admin/notification/index';
$route['add-notification'] = 'admin/notification/add_notification';
$route['edit-notification/(:num)'] = 'admin/notification/edit_notification/$1';
$route['activate-notification/(:num)'] = 'admin/notification/activate_notification/$1';
$route['deactivate-notification/(:num)'] = 'admin/notification/deactivate_notification/$1';

$route['member-account/offers'] = 'admin/offer/index';
$route['add-offer'] = 'admin/offer/add_offer';
$route['edit-offer/(:num)'] = 'admin/offer/edit_offer/$1';
$route['activate-offer/(:num)'] = 'admin/offer/activate_offer/$1';
$route['deactivate-offer/(:num)'] = 'admin/offer/deactivate_offer/$1';

//blog routes
$route['posts'] = 'admin/blog';
$route['blog/posts'] = 'admin/blog';
$route['blog/posts/(:num)'] = 'admin/blog/$1';
$route['blog/categories'] = 'admin/blog/categories';
$route['add-post'] = 'admin/blog/add_post';
$route['edit-post/(:num)'] = 'admin/blog/edit_post/$1';
$route['delete-post/(:num)'] = 'admin/blog/delete_post/$1';
$route['activate-post/(:num)'] = 'admin/blog/activate_post/$1';
$route['deactivate-post/(:num)'] = 'admin/blog/deactivate_post/$1';
$route['post-comments/(:num)'] = 'admin/blog/post_comments/$1';
$route['blog/comments/(:num)'] = 'admin/blog/comments/$1';
$route['blog/comments'] = 'admin/blog/comments';
$route['add-comment/(:num)'] = 'admin/blog/add_comment/$1';
$route['delete-comment/(:num)/(:num)'] = 'admin/blog/delete_comment/$1/$2';
$route['activate-comment/(:num)/(:num)'] = 'admin/blog/activate_comment/$1/$2';
$route['deactivate-comment/(:num)/(:num)'] = 'admin/blog/deactivate_comment/$1/$2';
$route['add-blog-category'] = 'admin/blog/add_blog_category';
$route['edit-blog-category/(:num)'] = 'admin/blog/edit_blog_category/$1';
$route['delete-blog-category/(:num)'] = 'admin/blog/delete_blog_category/$1';
$route['activate-blog-category/(:num)'] = 'admin/blog/activate_blog_category/$1';
$route['deactivate-blog-category/(:num)'] = 'admin/blog/deactivate_blog_category/$1';
$route['delete-comment/(:num)'] = 'admin/blog/delete_comment/$1';
$route['activate-comment/(:num)'] = 'admin/blog/activate_comment/$1';
$route['deactivate-comment/(:num)'] = 'admin/blog/deactivate_comment/$1';

//projects
$route['projects'] = 'site/projects';

/*
*	Users Routes
*/
$route['users/administrators'] = 'admin/users';
$route['users/administrators/(:any)/(:any)/(:num)'] = 'admin/users/index/$1/$2/$3';
$route['add-user'] = 'admin/users/add_user';
$route['edit-user/(:num)'] = 'admin/users/edit_user/$1';
$route['delete-user/(:num)'] = 'admin/users/delete_user/$1';
$route['activate-user/(:num)'] = 'admin/users/activate_user/$1';
$route['deactivate-user/(:num)'] = 'admin/users/deactivate_user/$1';
$route['reset-user-password/(:num)'] = 'admin/users/reset_password/$1';
$route['admin-profile/(:num)'] = 'admin/users/admin_profile/$1';

/* End of file routes.php */
/* Location: ./system/application/config/routes.php */


//trainings
$route['content/trainings'] = 'admin/trainings/index';
$route['trainings/(:num)'] = 'admin/trainings/index/$1';//with a page number
$route['administration/add-training'] = 'admin/trainings/add_training';
$route['administration/edit-training/(:num)/(:num)'] = 'admin/trainings/edit_training/$1/$2';
$route['administration/activate-training/(:num)/(:num)'] = 'admin/trainings/activate_training/$1/$2';
$route['administration/deactivate-training/(:num)/(:num)'] = 'admin/trainings/deactivate_training/$1/$2';
$route['administration/delete-training/(:num)/(:num)'] = 'admin/trainings/delete_training/$1/$2';

$route['content/slideshow'] = 'admin/slideshow/index';
$route['slideshow/(:num)'] = 'admin/slideshow/index/$1';
$route['administration/all-slides/(:num)'] = 'admin/slideshow/index/$1';//with a page number
$route['administration/add-slide'] = 'admin/slideshow/add_slide';
$route['administration/edit-slide/(:num)/(:num)'] = 'admin/slideshow/edit_slide/$1/$2';
$route['administration/activate-slide/(:num)/(:num)'] = 'admin/slideshow/activate_slide/$1/$2';
$route['administration/deactivate-slide/(:num)/(:num)'] = 'admin/slideshow/deactivate_slide/$1/$2';
$route['administration/delete-slide/(:num)/(:num)'] = 'admin/slideshow/delete_slide/$1/$2';

//trainings
$route['content/events'] = 'admin/events/index';
$route['content/events/(:num)'] = 'admin/events/index/$1';//with a page number
$route['administration/add-event'] = 'admin/events/add_event';
$route['administration/edit-event/(:num)/(:num)'] = 'admin/events/edit_event/$1/$2';
$route['administration/activate-event/(:num)/(:num)'] = 'admin/events/activate_event/$1/$2';
$route['administration/deactivate-event/(:num)/(:num)'] = 'admin/events/deactivate_event/$1/$2';
$route['administration/delete-event/(:num)/(:num)'] = 'admin/events/delete_event/$1/$2';

/*
*	Blog Routes
*/
$route['blog'] = 'site/blog';
$route['blog/(:num)'] = 'site/blog/index/__/__/$1';//going to different page without any filters
$route['blog/category/(:any)'] = 'site/blog/index/$1';//category present
$route['blog/category/(:any)/(:num)'] = 'site/blog/index/$1/$2';//category present going to next page
$route['blog/search/(:any)'] = 'site/blog/index/__/$1';//search present
$route['blog/search/(:any)/(:num)'] = 'site/blog/index/__/$1/$2';//search present going to next page
$route['blog/(:any)'] = 'site/blog/view_single_post/$1';//going to single post page

/*
*	Site contacts Routes
*/
$route['contact'] = 'site/contact';
$route['gallery'] = 'site/gallery';
$route['calendar'] = 'site/calendar';
$route['calendar/{:num}'] = 'site/calendar/$1';
$route['event/facilitators'] = 'site/facilitators';
$route['about/Affiliations-&-Partners'] = 'site/partners';
$route['about'] = 'site/about';
$route['about/board'] = 'site/board';
$route['about/board/(:any)'] = 'site/member_details/$1';
$route['about/(:any)'] = 'site/about_us/$1';
$route['director-development'] = 'site/services';
$route['director-development/facilitators'] = 'site/facilitators';
$route['director-development/training-partners'] = 'site/training_partners';
$route['director-development/(:any)'] = 'site/service_item/$1';
$route['membership'] = 'site/membership';
$route['membership/(:any)'] = 'site/membership_item/$1';
$route['resources'] = 'site/resource';

$route['content/partners'] = 'admin/partners/index';
$route['content/partners/(:num)'] = 'admin/partners/index/$1';
$route['partners'] = 'admin/partners/index';
$route['partners/(:num)'] = 'admin/partners/index/$1';
$route['partners/(:num)/(:num)'] = 'admin/partners/index/$1/$2';
$route['administration/all-partners/(:num)'] = 'admin/partners/index/$1';//with a page number
$route['administration/add-partner'] = 'admin/partners/add_partner';
$route['administration/edit-partner/(:num)/(:num)'] = 'admin/partners/edit_partner/$1/$2';
$route['administration/activate-partner/(:num)/(:num)'] = 'admin/partners/activate_partner/$1/$2';
$route['administration/deactivate-partner/(:num)/(:num)'] = 'admin/partners/deactivate_partner/$1/$2';
$route['administration/delete-partner/(:num)/(:num)'] = 'admin/partners/delete_partner/$1/$2';

$route['content/corporates'] = 'admin/corporates/index';
$route['content/corporates/(:num)'] = 'admin/corporates/index/$1';
$route['corporates'] = 'admin/corporates/index';
$route['corporates/(:num)'] = 'admin/corporates/index/$1';
$route['corporates/(:num)/(:num)'] = 'admin/corporates/index/$1/$2';
$route['administration/all-corporates/(:num)'] = 'admin/corporates/index/$1';//with a page number
$route['administration/add-corporate'] = 'admin/corporates/add_corporate';
$route['administration/edit-corporate/(:num)/(:num)'] = 'admin/corporates/edit_corporate/$1/$2';
$route['administration/activate-corporate/(:num)/(:num)'] = 'admin/corporates/activate_corporate/$1/$2';
$route['administration/deactivate-corporate/(:num)/(:num)'] = 'admin/corporates/deactivate_corporate/$1/$2';
$route['administration/delete-corporate/(:num)/(:num)'] = 'admin/corporates/delete_corporate/$1/$2';

$route['member-account/resources'] = 'admin/resource/index';
$route['resource'] = 'admin/resource/index';
$route['resource/(:num)'] = 'admin/resource/index/$1';
$route['administration/all-resources/(:num)'] = 'admin/resource/index/$1';//with a page number
$route['administration/add-resource'] = 'admin/resource/add_resource';
$route['administration/edit-resource/(:num)/(:num)'] = 'admin/resource/edit_resource/$1/$2';
$route['administration/activate-resource/(:num)/(:num)'] = 'admin/resource/activate_resource/$1/$2';
$route['administration/deactivate-resource/(:num)/(:num)'] = 'admin/resource/deactivate_resource/$1/$2';
$route['administration/delete-resource/(:num)/(:num)'] = 'admin/resource/delete_resource/$1/$2';

//pesa pal payments
$route['member/invoices/payment/(:num)/(:any)/(:num)/(:num)'] = 'member/payment/$1/$2/$3/$4';
$route['member/payment-success/(:num)/(:any)'] = 'member/payment_success/$1/$2';


//member _account routes
$route['update_profile/(:num)'] = 'member/update_profile/$1';

$route['view-single-resource/(:any)'] = 'site/single_resource/$1';
$route['resource/(:any)'] = 'site/single_resource/$1';
$route['calendar/Training/(:any)'] = 'site/view_event_details/$1';
$route['calendar/Seminar/(:any)'] = 'site/view_event_details/$1';
$route['calendar/Event/(:any)'] = 'site/view_event_details/$1';
$route['calendar/Conference/(:any)'] = 'site/view_event_details/$1';
$route['calendar/(:any)'] = 'site/single_calendar/$1';

$route['directors'] = 'admin/directors/index';
$route['content/directors'] = 'admin/directors/index';
$route['directors/(:num)'] = 'admin/directors/index/$1';
$route['content/directors/(:num)'] = 'admin/directors/index/$1';
$route['administration/all-directors/(:num)'] = 'admin/directors/index/$1';//with a page number
$route['administration/add-director'] = 'admin/directors/add_director';
$route['administration/edit-director/(:num)/(:num)'] = 'admin/directors/edit_director/$1/$2';
$route['administration/activate-director/(:num)/(:num)'] = 'admin/directors/activate_director/$1/$2';
$route['administration/deactivate-director/(:num)/(:num)'] = 'admin/directors/deactivate_director/$1/$2';
$route['administration/delete-director/(:num)/(:num)'] = 'admin/directors/delete_partner/$1/$2';

$route['facilitators'] = 'admin/facilitators/index';
$route['content/facilitators'] = 'admin/facilitators/index';
$route['facilitators/(:num)'] = 'admin/facilitators/index/$1';
$route['content/facilitators/(:num)'] = 'admin/facilitators/index/$1';
$route['administration/all-facilitators/(:num)'] = 'admin/facilitators/index/$1';//with a page number
$route['administration/add-facilitator'] = 'admin/facilitators/add_facilitator';
$route['administration/edit-facilitator/(:num)/(:num)'] = 'admin/facilitators/edit_facilitator/$1/$2';
$route['administration/activate-facilitator/(:num)/(:num)'] = 'admin/facilitators/activate_facilitator/$1/$2';
$route['administration/deactivate-facilitator/(:num)/(:num)'] = 'admin/facilitators/deactivate_facilitator/$1/$2';
$route['administration/delete-facilitator/(:num)/(:num)'] = 'admin/facilitators/delete_partner/$1/$2';

/*
*	Messaging Routes
*/

$route['messaging/dashboard'] = 'messaging/dashboard';
$route['messages'] = 'messaging/unsent_messages';
$route['messaging/unsent-messages'] = 'messaging/unsent_messages';
$route['messaging/unsent-messages/(:num)'] = 'messaging/unsent_messages/$1';
$route['messaging/sent-messages'] = 'messaging/sent_messages';
$route['messaging/sent-messages/(:num)'] = 'messaging/sent_messages/$1';
$route['messaging/spoilt-messages'] = 'messaging/spoilt_messages';
$route['messaging/spoilt-messages/(:num)'] = 'messaging/spoilt_messages/$1';
// import functions of messages
$route['messaging/validate-import/(:num)'] = 'messaging/do_messages_import/$1';
$route['messaging/import-template'] = 'messaging/import_template';
$route['messaging/import-messages'] = 'messaging/import_messages';
$route['messaging/send-messages'] = 'messaging/send_messages';

$route['add-contact'] = 'administration/contacts/add_contact';
$route['edit-contact/(:num)'] = 'administration/contacts/edit_contact/$1';
$route['contacts'] = 'administration/contacts/index';
$route['contacts/(:num)'] = 'administration/contacts/index/$1';
$route['delete-contact/(:num)'] = 'administration/contacts/delete_contact/$1';
$route['contacts/validate-import/(:num)'] = 'administration/contacts/do_messages_import/$1';
$route['contacts/import-template'] = 'administration/contacts/import_template';
$route['contacts/import-messages'] = 'administration/contacts/import_messages';

$route['messaging/message-templates'] = 'messaging/message_templates';
$route['messaging/add-template'] = 'messaging/add_message_template';
$route['messaging/edit-message-template/(:num)'] = 'messaging/edit_message_template/$1';
$route['messaging/activate-message-template/(:num)'] = 'messaging/activate_message_template/$1';
$route['messaging/deactivate-message-template/(:num)'] = 'messaging/deactivate_message_template/$1';
$route['template-detail/(:num)'] = 'messaging/template_detail/$1';
$route['set-search-parameters/(:num)'] = 'messaging/set_search_parameters/$1';
$route['create-batch-items/(:num)'] = 'messaging/create_batch_items/$1';

$route['send-messages/(:num)/(:num)'] = 'messaging/send_batch_messages/$1/$2';
$route['view-senders/(:num)/(:num)'] = 'messaging/view_persons_for_batch/$1/$2';
$route['view-schedules/(:num)/(:num)'] = 'messaging/view_schedules/$1/$2';
$route['messaging/dashboard'] = 'messaging/dashboard';
$route['delete-message-contact/(:num)/(:num)/(:num)'] = 'messaging/delete_contact/$1/$2/$3';
$route['create-new-schedule/(:num)/(:num)'] = 'messaging/create_new_schedule/$1/$2';

$route['bulk-delete-contacts/(:num)'] = 'administration/contacts/bulk_delete_contacts/$1';

$route['activate-schedule/(:num)/(:num)/(:num)'] = 'messaging/activate_schedule/$1/$2/$3';
$route['deactivate-schedule/(:num)/(:num)/(:num)'] = 'messaging/deactivate_schedule/$1/$2/$3';
$route['delete-schedule/(:num)/(:num)/(:num)'] = 'messaging/delete_schedule/$1/$2/$3';