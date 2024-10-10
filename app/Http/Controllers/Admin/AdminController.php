<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    // Dashboard
    public function dashboard_1()
    {
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        $logo = "images/logo.png";
        $logoText = "images/logo-text.png";
        $action = __FUNCTION__;

        return view('admin.dashboard.index', compact('page_title', 'page_description', 'action', 'logo', 'logoText'));
    }

    // Doctor Detail
    public function doctor_detail()
    {
        $page_title = 'Doctor Detail';
        $page_description = 'Some description for the page';
        $logo = "images/logo.png";
        $logoText = "images/logo-text.png";

        $action = __FUNCTION__;

        return view('admin.dashboard.doctor_detail', compact('page_title', 'page_description', 'action', 'logo', 'logoText'));
    }

    // Doctor List
    public function doctor_list()
    {
        $page_title = 'Doctor List';
        $page_description = 'Some description for the page';
        $logo = "images/logo.png";
        $logoText = "images/logo-text.png";

        $action = __FUNCTION__;

        return view('admin.dashboard.doctor_list', compact('page_title', 'page_description', 'action', 'logo', 'logoText'));
    }

    // Review
    public function review()
    {

        $page_title = 'Review';
        $page_description = 'Some description for the page';
        $logo = "images/logo.png";
        $logoText = "images/logo-text.png";

        $action = __FUNCTION__;

        return view('admin.dashboard.review', compact('page_title', 'page_description', 'action', 'logo', 'logoText'));
    }

    // Patient Details
    public function patient_details()
    {
        $page_title = 'Patient Details';
        $page_description = 'Some description for the page';
        $logo = "images/logo.png";
        $logoText = "images/logo-text.png";

        $action = __FUNCTION__;

        return view('admin.dashboard.patient_details', compact('page_title', 'page_description', 'action', 'logo', 'logoText'));
    }
    // Patient List
    public function patient_list()
    {
        $page_title = 'Patient List';
        $page_description = 'Some description for the page';
        $logo = "images/logo.png";
        $logoText = "images/logo-text.png";

        $action = __FUNCTION__;

        return view('admin.dashboard.patient_list', compact('page_title', 'page_description', 'action', 'logo', 'logoText'));
    }
    // Calender
    public function app_calender()
    {
        $page_title = 'App Calender';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.app.calender', compact('page_title', 'page_description', 'action'));
    }

    // Profile
    public function app_profile()
    {
        $page_title = 'Profile';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.app.profile', compact('page_title', 'page_description', 'action'));
    }

    // Chart Chartist
    public function chart_chartist()
    {
        $page_title = 'Chart Chartist';
        $page_description = 'Some description for the page';
        $action = __FUNCTION__;

        return view('admin.chart.chartist', compact('page_title', 'page_description', 'action'));
    }

    // Chart Chartjs
    public function chart_chartjs()
    {
        $page_title = 'Chart Chartjs';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.chart.chartjs', compact('page_title', 'page_description', 'action'));
    }

    // Chart Flot
    public function chart_flot()
    {
        $page_title = 'Chart Flot';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.chart.flot', compact('page_title', 'page_description', 'action'));
    }

    // Chart Morris
    public function chart_morris()
    {
        $page_title = 'Chart Morris';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.chart.morris', compact('page_title', 'page_description', 'action'));
    }

    // Chart Peity
    public function chart_peity()
    {
        $page_title = 'Chart Peity';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.chart.peity', compact('page_title', 'page_description', 'action'));
    }

    // Chart Sparkline
    public function chart_sparkline()
    {
        $page_title = 'Chart Sparkline';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.chart.sparkline', compact('page_title', 'page_description', 'action'));
    }

    // Ecommerce Checkout
    public function ecom_checkout()
    {
        $page_title = 'Ecom Checkout';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ecom.checkout', compact('page_title', 'page_description', 'action'));
    }

    // Ecommerce Customers
    public function ecom_customers()
    {
        $page_title = 'Ecom Customers';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ecom.customers', compact('page_title', 'page_description', 'action'));
    }

    // Ecommerce Invoice
    public function ecom_invoice()
    {
        $page_title = 'Ecom Invoice';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ecom.invoice', compact('page_title', 'page_description', 'action'));
    }

    // Ecommerce Product Detail
    public function ecom_product_detail()
    {
        $page_title = 'Ecom Product Detail';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ecom.productdetail', compact('page_title', 'page_description', 'action'));
    }

    // Ecommerce Product Grid
    public function ecom_product_grid()
    {
        $page_title = 'Ecom Product Grid';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ecom.productgrid', compact('page_title', 'page_description', 'action'));
    }

    // Ecommerce Product List
    public function ecom_product_list()
    {
        $page_title = 'Ecom Product List';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ecom.productlist', compact('page_title', 'page_description', 'action'));
    }

    // Ecommerce Product Order
    public function ecom_product_order()
    {
        $page_title = 'Ecom Product Order';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ecom.productorder', compact('page_title', 'page_description', 'action'));
    }

    // Email Compose
    public function email_compose()
    {
        $page_title = 'Email Compose';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.message.compose', compact('page_title', 'page_description', 'action'));
    }

    // Email Inbox
    public function email_inbox()
    {
        $page_title = 'Email Inbox';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.message.inbox', compact('page_title', 'page_description', 'action'));
    }

    // Email Read
    public function email_read()
    {
        $page_title = 'Email read';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.message.read', compact('page_title', 'page_description', 'action'));
    }

    // Form Editor Summernote
    public function form_editor_summernote()
    {
        $page_title = 'Form Editor';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.form.editorsummernote', compact('page_title', 'page_description', 'action'));
    }

    // Form Element
    public function form_element()
    {
        $page_title = 'Form Element';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.form.element', compact('page_title', 'page_description', 'action'));
    }

    // Form Pickers
    public function form_pickers()
    {
        $page_title = 'Form Pickers';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.form.pickers', compact('page_title', 'page_description', 'action'));
    }

    // Form Validation Jquery
    public function form_validation_jquery()
    {
        $page_title = 'Form Validation Jquery';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.form.validationjquery', compact('page_title', 'page_description', 'action'));
    }

    // Form Wizard
    public function form_wizard()
    {
        $page_title = 'Form Wizard';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.form.wizard', compact('page_title', 'page_description', 'action'));
    }


    // Map Jqvmap
    public function map_jqvmap()
    {
        $page_title = 'Map Jqvmap';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.map.jqvmap', compact('page_title', 'page_description', 'action'));
    }



    // Layout Blank
    /* public function layout_blank()
    {
        $page_title = 'Layout Blank';
        $page_description = 'Some description for the page';
		
		$action = __FUNCTION__;

        return view('admin.metrolayout.blank', compact('page_title', 'page_description','action'));
    }
	
	    // Layout Compact Nav
    public function layout_compact_nav()
    {
        $page_title = 'Layout Compact Nav';
        $page_description = 'Some description for the page';
		
		$action = __FUNCTION__;

        return view('admin.metrolayout.compactnav', compact('page_title', 'page_description','action'));
    }
	
	    // Layout Dark
    public function layout_dark()
    {
        $page_title = 'Layout Dark';
        $page_description = 'Some description for the page';
		
		$action = __FUNCTION__;

        return view('admin.metrolayout.dark', compact('page_title', 'page_description','action'));
    }
	
	    // Layout Fixed Header
    public function layout_fixed_header()
    {
        $page_title = 'Layout Fixed Header';
        $page_description = 'Some description for the page';
		
		$action = __FUNCTION__;

        return view('admin.metrolayout.fixedheader', compact('page_title', 'page_description','action'));
    }
	
	    // Layout Fixed Nav
    public function layout_fixed_nav()
    {
        $page_title = 'Layout Fixed Nav';
        $page_description = 'Some description for the page';
		
		$action = __FUNCTION__;

        return view('admin.metrolayout.fixednav', compact('page_title', 'page_description','action'));
    }
	
	    // Layout Full Nav
    public function layout_full_nav()
    {
        $page_title = 'Layout Full Nav';
        $page_description = 'Some description for the page';
		
		$action = __FUNCTION__;

        return view('admin.metrolayout.fullnav', compact('page_title', 'page_description','action'));
    }
	
	    // Layout Light
    public function layout_light()
    {
        $page_title = 'Layout Light';
        $page_description = 'Some description for the page';
		
		$action = __FUNCTION__;

        return view('admin.metrolayout.light', compact('page_title', 'page_description','action'));
    }
	
	    // Layout Mini Nav
    public function layout_mini_nav()
    {
        $page_title = 'Layout Mini Nav';
        $page_description = 'Some description for the page';
		
		$action = __FUNCTION__;

        return view('admin.metrolayout.mininav', compact('page_title', 'page_description','action'));
    }
	
	    // Layout RTL
    public function layout_rtl()
    {
        $page_title = 'Layout RTL';
        $page_description = 'Some description for the page';
		
		$action = __FUNCTION__;

        return view('admin.metrolayout.rtl', compact('page_title', 'page_description','action'));
    } */


    // Page Error 400
    public function page_error_400()
    {
        $page_title = 'Page Error 400';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.page.error400', compact('page_title', 'page_description', 'action'));
    }

    // Page Error 403
    public function page_error_403()
    {
        $page_title = 'Page Error 403';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.page.error403', compact('page_title', 'page_description', 'action'));
    }

    // Page Error 404
    public function page_error_404()
    {
        $page_title = 'Page Error 404';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.page.error404', compact('page_title', 'page_description', 'action'));
    }

    // Page Error 500
    public function page_error_500()
    {
        $page_title = 'Page Error 500';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.page.error500', compact('page_title', 'page_description', 'action'));
    }

    // Page Error 503
    public function page_error_503()
    {
        $page_title = 'Page Error 503';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.page.error503', compact('page_title', 'page_description', 'action'));
    }

    // Page Forgot Password
    public function page_forgot_password()
    {
        $page_title = 'Page Forgot Password';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.page.forgot_password', compact('page_title', 'page_description', 'action'));
    }

    // Page Lock Screen
    public function page_lock_screen()
    {
        $page_title = 'Page Lock Screen';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.page.lockscreen', compact('page_title', 'page_description', 'action'));
    }

    // Page Login
    public function page_login()
    {
        $page_title = 'Page Login';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('auth.login', compact('page_title', 'page_description', 'action'));
    }

    // Page Register
    public function page_register()
    {
        $page_title = 'Page Register';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.page.register', compact('page_title', 'page_description', 'action'));
    }

    // Table Bootstrap Basic
    public function table_bootstrap_basic()
    {
        $page_title = 'Table Bootstrap Basic';
        $page_description = 'Some description for the page';
        $action = __FUNCTION__;
        return view('admin.table.bootstrapbasic', compact('page_title', 'page_description', 'action'));
    }

    // Table Datatable Basic
    public function table_datatable_basic()
    {
        $page_title = 'Table Datatable Basic';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.table.datatablebasic', compact('page_title', 'page_description', 'action'));
    }

    // UC Lightgallery.
    public function uc_lightgallery()
    {
        $page_title = 'Uc lightgallery';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.uc.lightgallery', compact('page_title', 'page_description', 'action'));
    }

    // UC Nestable.
    public function uc_nestable()
    {
        $page_title = 'Uc Nestable';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.uc.nestable', compact('page_title', 'page_description', 'action'));
    }

    // UC NoUi Slider
    public function uc_noui_slider()
    {
        $page_title = 'Uc NoUi Slider';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.uc.nouislider', compact('page_title', 'page_description', 'action'));
    }

    // UC Select2
    public function uc_select2()
    {
        $page_title = 'Uc Select2';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.uc.select2', compact('page_title', 'page_description', 'action'));
    }

    // UC Sweetalert
    public function uc_sweetalert()
    {
        $page_title = 'UC Sweetalert';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.uc.sweetalert', compact('page_title', 'page_description', 'action'));
    }

    // UC Toastr
    public function uc_toastr()
    {
        $page_title = 'Uc toastr';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.uc.toastr', compact('page_title', 'page_description', 'action'));
    }

    // Ui Accordion
    public function ui_accordion()
    {
        $page_title = 'Ui Accordion';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ui.accordion', compact('page_title', 'page_description', 'action'));
    }

    // Ui Alert
    public function ui_alert()
    {
        $page_title = 'Ui Alert';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ui.alert', compact('page_title', 'page_description', 'action'));
    }

    // Ui Badge
    public function ui_badge()
    {
        $page_title = 'Ui Badge';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ui.badge', compact('page_title', 'page_description', 'action'));
    }

    // Ui Button
    public function ui_button()
    {
        $page_title = 'Ui Button';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ui.button', compact('page_title', 'page_description', 'action'));
    }

    // Ui Button Group
    public function ui_button_group()
    {
        $page_title = 'Ui Button Group';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ui.buttongroup', compact('page_title', 'page_description', 'action'));
    }

    // Ui Card
    public function ui_card()
    {
        $page_title = 'Ui Card';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ui.card', compact('page_title', 'page_description', 'action'));
    }

    // Ui Carousel
    public function ui_carousel()
    {
        $page_title = 'Ui Carousel';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ui.carousel', compact('page_title', 'page_description', 'action'));
    }

    // Ui Dropdown
    public function ui_dropdown()
    {
        $page_title = 'Ui Dropdown';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ui.dropdown', compact('page_title', 'page_description', 'action'));
    }

    // Ui Grid
    public function ui_grid()
    {
        $page_title = 'Ui Grid';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ui.grid', compact('page_title', 'page_description', 'action'));
    }

    // Ui List Group
    public function ui_list_group()
    {
        $page_title = 'Ui List Group';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ui.listgroup', compact('page_title', 'page_description', 'action'));
    }

    // Ui Media Object
    public function ui_media_object()
    {
        $page_title = 'Ui Media Object';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ui.mediaobject', compact('page_title', 'page_description', 'action'));
    }

    // Ui Modal
    public function ui_modal()
    {
        $page_title = 'Ui Modal';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ui.modal', compact('page_title', 'page_description', 'action'));
    }

    // Ui Pagination
    public function ui_pagination()
    {
        $page_title = 'Ui Pagination';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ui.pagination', compact('page_title', 'page_description', 'action'));
    }

    // Ui Popover
    public function ui_popover()
    {
        $page_title = 'Ui Popover';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ui.popover', compact('page_title', 'page_description', 'action'));
    }

    // Ui Progressbar
    public function ui_progressbar()
    {
        $page_title = 'Ui Progressbar';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ui.progressbar', compact('page_title', 'page_description', 'action'));
    }

    // Ui Tab
    public function ui_tab()
    {
        $page_title = 'Ui Tab';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ui.tab', compact('page_title', 'page_description', 'action'));
    }


    // Ui Typography
    public function ui_typography()
    {
        $page_title = 'Ui Typography';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.ui.typography', compact('page_title', 'page_description', 'action'));
    }

    // Widget Basic
    public function widget_basic()
    {
        $page_title = 'Widget Basic';
        $page_description = 'Some description for the page';

        $action = __FUNCTION__;

        return view('admin.widget.widget_basic', compact('page_title', 'page_description', 'action'));
    }
}
