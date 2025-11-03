<?php
/**
 * Plugin Name: PUIUX - Ehtazem Elementor Widgets
 * Description: مجموعة Widgets Elementor احترافية لموقع احتزم - مشروع من PUIUX لعميلنا احتزم (وحدة التمكين العقاري)
 * Version: 1.0.0
 * Author: PUIUX
 * Author URI: https://puiux.com
 * Text Domain: ehtazem-elementor
 * Domain Path: /languages
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Developed by PUIUX for Ehtazem (Real Estate Empowerment Unit)
 * Development, Design & Programming by PUIUX
 * Copyright (c) 2025 PUIUX. All rights reserved.
 * Contact: Welcome@puiux.com | +966 544420258
 *
 * @package Ehtazem_Elementor_Widgets
 * @category Core
 * @author PUIUX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Ehtazem Elementor Widgets Class
 *
 * The main class that initiates and runs the plugin.
 * Developed by PUIUX
 *
 * @since 1.0.0
 */
final class Ehtazem_Elementor_Widgets {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var Ehtazem_Elementor_Widgets The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return Ehtazem_Elementor_Widgets An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Admin Classes
	 */
	private $admin_dashboard;
	private $admin_settings;
	private $image_library;
	private $email_templates;
	private $system_health;

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
		add_action( 'init', [ $this, 'register_submissions_post_type' ] );
		add_action( 'wp_ajax_ehtazem_submit_form', [ $this, 'handle_form_submission' ] );
		add_action( 'wp_ajax_nopriv_ehtazem_submit_form', [ $this, 'handle_form_submission' ] );

		// Admin functionality
		if ( is_admin() ) {
			add_action( 'admin_menu', [ $this, 'register_admin_menu' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_assets' ] );
			$this->load_admin_classes();
		}
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'ehtazem-elementor', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_widget_styles' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'enqueue_widget_scripts' ] );
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'enqueue_editor_styles' ] );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" يتطلب "%2$s" ليكون مثبت ومفعل.', 'ehtazem-elementor' ),
			'<strong>' . esc_html__( 'PUIUX - Ehtazem Elementor Widgets', 'ehtazem-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'ehtazem-elementor' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" يتطلب "%2$s" نسخة %3$s أو أحدث.', 'ehtazem-elementor' ),
			'<strong>' . esc_html__( 'PUIUX - Ehtazem Elementor Widgets', 'ehtazem-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'ehtazem-elementor' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" يتطلب "%2$s" نسخة %3$s أو أحدث.', 'ehtazem-elementor' ),
			'<strong>' . esc_html__( 'PUIUX - Ehtazem Elementor Widgets', 'ehtazem-elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'ehtazem-elementor' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Add Elementor Widget Categories
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function add_elementor_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'ehtazem-widgets',
			[
				'title' => esc_html__( 'PUIUX - احتزم', 'ehtazem-elementor' ),
				'icon' => 'fa fa-building',
			]
		);
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_widgets( $widgets_manager ) {
		// Include Widget files
		require_once( __DIR__ . '/includes/widgets/class-widget-header.php' );
		require_once( __DIR__ . '/includes/widgets/class-widget-hero.php' );
		require_once( __DIR__ . '/includes/widgets/class-widget-about-carousel.php' );
		require_once( __DIR__ . '/includes/widgets/class-widget-services.php' );
		require_once( __DIR__ . '/includes/widgets/class-widget-coming-soon.php' );
		require_once( __DIR__ . '/includes/widgets/class-widget-org-structure.php' );
		require_once( __DIR__ . '/includes/widgets/class-widget-approach.php' );
		require_once( __DIR__ . '/includes/widgets/class-widget-features.php' );
		require_once( __DIR__ . '/includes/widgets/class-widget-vision.php' );
		require_once( __DIR__ . '/includes/widgets/class-widget-intermediaries-form.php' );
		require_once( __DIR__ . '/includes/widgets/class-widget-partners.php' );
		require_once( __DIR__ . '/includes/widgets/class-widget-faq.php' );
		require_once( __DIR__ . '/includes/widgets/class-widget-contact-form.php' );
		require_once( __DIR__ . '/includes/widgets/class-widget-footer.php' );

		// Register widgets
		$widgets_manager->register( new \Ehtazem_Header_Widget() );
		$widgets_manager->register( new \Ehtazem_Hero_Widget() );
		$widgets_manager->register( new \Ehtazem_About_Carousel_Widget() );
		$widgets_manager->register( new \Ehtazem_Services_Widget() );
		$widgets_manager->register( new \Ehtazem_Coming_Soon_Widget() );
		$widgets_manager->register( new \Ehtazem_Org_Structure_Widget() );
		$widgets_manager->register( new \Ehtazem_Approach_Widget() );
		$widgets_manager->register( new \Ehtazem_Features_Widget() );
		$widgets_manager->register( new \Ehtazem_Vision_Widget() );
		$widgets_manager->register( new \Ehtazem_Intermediaries_Form_Widget() );
		$widgets_manager->register( new \Ehtazem_Partners_Widget() );
		$widgets_manager->register( new \Ehtazem_FAQ_Widget() );
		$widgets_manager->register( new \Ehtazem_Contact_Form_Widget() );
		$widgets_manager->register( new \Ehtazem_Footer_Widget() );
	}

	/**
	 * Enqueue Common Fonts and Icons
	 * Used in both frontend and editor
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function enqueue_fonts_and_icons() {
		// Cairo Font - Google Fonts
		wp_enqueue_style(
			'ehtazem-cairo-font',
			'https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap',
			[],
			null
		);

		// Font Awesome Icons
		wp_enqueue_style(
			'ehtazem-font-awesome',
			'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
			[],
			'6.5.1'
		);

		// Add inline CSS to ensure Cairo font applies to all widgets
		$custom_css = "
			/* PUIUX - Ehtazem: Ensure Cairo font applies everywhere */
			.elementor-widget-ehtazem-header *,
			.elementor-widget-ehtazem-hero *,
			.elementor-widget-ehtazem-about-carousel *,
			.elementor-widget-ehtazem-services *,
			.elementor-widget-ehtazem-coming-soon *,
			.elementor-widget-ehtazem-org-structure *,
			.elementor-widget-ehtazem-approach *,
			.elementor-widget-ehtazem-features *,
			.elementor-widget-ehtazem-vision *,
			.elementor-widget-ehtazem-intermediaries-form *,
			.elementor-widget-ehtazem-partners *,
			.elementor-widget-ehtazem-faq *,
			.elementor-widget-ehtazem-contact-form *,
			.elementor-widget-ehtazem-footer * {
				font-family: 'Cairo', sans-serif !important;
			}

			/* Ensure Font Awesome icons display correctly */
			.fa, .fas, .far, .fal, .fad, .fab {
				font-family: 'Font Awesome 6 Free', 'Font Awesome 6 Pro', 'Font Awesome 6 Brands' !important;
				font-weight: 900;
				-webkit-font-smoothing: antialiased;
				-moz-osx-font-smoothing: grayscale;
			}
		";
		wp_add_inline_style( 'ehtazem-cairo-font', $custom_css );
	}

	/**
	 * Enqueue Widget Styles
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue_widget_styles() {
		// Enqueue main widget styles
		wp_enqueue_style( 'ehtazem-widgets', plugins_url( 'assets/css/widgets.css', __FILE__ ), [], self::VERSION );

		// Enqueue fonts and icons
		$this->enqueue_fonts_and_icons();

		// Enqueue external dependencies
		wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css', [], '5.3.8' );
		wp_enqueue_style( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], '11' );
		wp_enqueue_style( 'aos', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css', [], '2.3.4' );
	}

	/**
	 * Enqueue Widget Scripts
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue_widget_scripts() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js', ['jquery'], '5.3.8', true );
		wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], '11', true );
		wp_enqueue_script( 'aos-js', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js', [], '2.3.4', true );
		wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', [], '3.12.2', true );
		wp_enqueue_script( 'gsap-scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js', ['gsap'], '3.12.2', true );
		wp_enqueue_script( 'ehtazem-widgets', plugins_url( 'assets/js/widgets.js', __FILE__ ), ['jquery', 'swiper-js', 'aos-js'], self::VERSION, true );
	}

	/**
	 * Enqueue Editor Styles
	 * Ensures fonts and icons appear correctly in Elementor Editor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue_editor_styles() {
		// Enqueue main widget styles
		wp_enqueue_style( 'ehtazem-widgets-editor', plugins_url( 'assets/css/widgets.css', __FILE__ ), [], self::VERSION );

		// Enqueue dedicated editor styles
		wp_enqueue_style( 'ehtazem-editor-specific', plugins_url( 'assets/css/editor.css', __FILE__ ), [], self::VERSION );

		// Enqueue fonts and icons (CRITICAL for editor preview)
		$this->enqueue_fonts_and_icons();

		// Enqueue Bootstrap for proper layout in editor
		wp_enqueue_style( 'ehtazem-bootstrap-editor', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css', [], '5.3.8' );
	}

	/**
	 * Register Submissions Custom Post Type
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_submissions_post_type() {
		$labels = array(
			'name'                  => _x( 'طلبات التواصل', 'Post Type General Name', 'ehtazem-elementor' ),
			'singular_name'         => _x( 'طلب تواصل', 'Post Type Singular Name', 'ehtazem-elementor' ),
			'menu_name'             => __( 'طلبات التواصل', 'ehtazem-elementor' ),
			'name_admin_bar'        => __( 'طلب تواصل', 'ehtazem-elementor' ),
			'archives'              => __( 'أرشيف الطلبات', 'ehtazem-elementor' ),
			'attributes'            => __( 'خصائص الطلب', 'ehtazem-elementor' ),
			'parent_item_colon'     => __( 'الطلب الأب:', 'ehtazem-elementor' ),
			'all_items'             => __( 'جميع الطلبات', 'ehtazem-elementor' ),
			'add_new_item'          => __( 'إضافة طلب جديد', 'ehtazem-elementor' ),
			'add_new'               => __( 'إضافة جديد', 'ehtazem-elementor' ),
			'new_item'              => __( 'طلب جديد', 'ehtazem-elementor' ),
			'edit_item'             => __( 'تعديل الطلب', 'ehtazem-elementor' ),
			'update_item'           => __( 'تحديث الطلب', 'ehtazem-elementor' ),
			'view_item'             => __( 'عرض الطلب', 'ehtazem-elementor' ),
			'view_items'            => __( 'عرض الطلبات', 'ehtazem-elementor' ),
			'search_items'          => __( 'بحث في الطلبات', 'ehtazem-elementor' ),
			'not_found'             => __( 'لم يتم العثور على طلبات', 'ehtazem-elementor' ),
			'not_found_in_trash'    => __( 'لم يتم العثور على طلبات في سلة المهملات', 'ehtazem-elementor' ),
			'featured_image'        => __( 'صورة مميزة', 'ehtazem-elementor' ),
			'set_featured_image'    => __( 'تعيين صورة مميزة', 'ehtazem-elementor' ),
			'remove_featured_image' => __( 'إزالة الصورة المميزة', 'ehtazem-elementor' ),
			'use_featured_image'    => __( 'استخدام كصورة مميزة', 'ehtazem-elementor' ),
			'insert_into_item'      => __( 'إدراج في الطلب', 'ehtazem-elementor' ),
			'uploaded_to_this_item' => __( 'تم الرفع لهذا الطلب', 'ehtazem-elementor' ),
			'items_list'            => __( 'قائمة الطلبات', 'ehtazem-elementor' ),
			'items_list_navigation' => __( 'التنقل بين الطلبات', 'ehtazem-elementor' ),
			'filter_items_list'     => __( 'فلترة الطلبات', 'ehtazem-elementor' ),
		);

		$args = array(
			'label'                 => __( 'طلب تواصل', 'ehtazem-elementor' ),
			'description'           => __( 'طلبات التواصل من النماذج', 'ehtazem-elementor' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor' ),
			'hierarchical'          => false,
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 25,
			'menu_icon'             => 'dashicons-email-alt',
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => false,
			'capability_type'       => 'post',
			'show_in_rest'          => false,
		);

		register_post_type( 'ehtazem_submissions', $args );

		// Add custom columns
		add_filter( 'manage_ehtazem_submissions_posts_columns', [ $this, 'set_custom_columns' ] );
		add_action( 'manage_ehtazem_submissions_posts_custom_column', [ $this, 'custom_column_content' ], 10, 2 );
	}

	/**
	 * Set Custom Columns for Submissions
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function set_custom_columns( $columns ) {
		$new_columns = array();
		$new_columns['cb'] = $columns['cb'];
		$new_columns['title'] = __( 'الاسم', 'ehtazem-elementor' );
		$new_columns['form_type'] = __( 'نوع النموذج', 'ehtazem-elementor' );
		$new_columns['phone'] = __( 'رقم الهاتف', 'ehtazem-elementor' );
		$new_columns['company'] = __( 'الشركة', 'ehtazem-elementor' );
		$new_columns['date'] = __( 'التاريخ', 'ehtazem-elementor' );
		return $new_columns;
	}

	/**
	 * Custom Column Content
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function custom_column_content( $column, $post_id ) {
		switch ( $column ) {
			case 'form_type':
				$form_type = get_post_meta( $post_id, '_form_type', true );
				if ( $form_type === 'intermediaries' ) {
					echo '<span style="background: #4CAF50; color: white; padding: 3px 10px; border-radius: 3px;">نموذج الوسطاء</span>';
				} else if ( $form_type === 'contact' ) {
					echo '<span style="background: #2196F3; color: white; padding: 3px 10px; border-radius: 3px;">نموذج التواصل</span>';
				}
				break;
			case 'phone':
				$phone = get_post_meta( $post_id, '_phone', true );
				echo esc_html( $phone );
				break;
			case 'company':
				$company = get_post_meta( $post_id, '_company', true );
				echo esc_html( $company ? $company : '-' );
				break;
		}
	}

	/**
	 * Handle Form Submission via AJAX
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function handle_form_submission() {
		// Verify nonce
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'ehtazem_form_submission' ) ) {
			wp_send_json_error( array(
				'message' => __( 'خطأ في التحقق من الأمان', 'ehtazem-elementor' )
			) );
		}

		// Get form data
		$form_type = isset( $_POST['form_type'] ) ? sanitize_text_field( $_POST['form_type'] ) : '';
		$full_name = isset( $_POST['full_name'] ) ? sanitize_text_field( $_POST['full_name'] ) : '';
		$phone = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';

		// Validate required fields
		if ( empty( $full_name ) || empty( $phone ) ) {
			wp_send_json_error( array(
				'message' => __( 'من فضلك املأ جميع الحقول المطلوبة', 'ehtazem-elementor' )
			) );
		}

		// Validate phone number
		if ( strlen( $phone ) < 10 ) {
			wp_send_json_error( array(
				'message' => __( 'رقم الهاتف غير صحيح', 'ehtazem-elementor' )
			) );
		}

		// Create post title and content
		$post_title = $full_name . ' - ' . $phone;
		$post_content = '';

		// Prepare metadata based on form type
		$metadata = array(
			'_form_type' => $form_type,
			'_full_name' => $full_name,
			'_phone' => $phone,
		);

		if ( $form_type === 'intermediaries' ) {
			$company = isset( $_POST['company'] ) ? sanitize_text_field( $_POST['company'] ) : '';
			$region = isset( $_POST['region'] ) ? sanitize_text_field( $_POST['region'] ) : '';
			$details = isset( $_POST['details'] ) ? sanitize_textarea_field( $_POST['details'] ) : '';

			$metadata['_company'] = $company;
			$metadata['_region'] = $region;
			$metadata['_details'] = $details;

			$post_content = "نموذج الوسطاء\n\n";
			$post_content .= "الاسم: {$full_name}\n";
			$post_content .= "رقم الهاتف: {$phone}\n";
			if ( $company ) $post_content .= "الشركة: {$company}\n";
			if ( $region ) $post_content .= "المنطقة: {$region}\n";
			if ( $details ) $post_content .= "التفاصيل: {$details}\n";

		} else if ( $form_type === 'contact' ) {
			$question = isset( $_POST['question'] ) ? sanitize_textarea_field( $_POST['question'] ) : '';

			if ( empty( $question ) ) {
				wp_send_json_error( array(
					'message' => __( 'من فضلك املأ جميع الحقول المطلوبة', 'ehtazem-elementor' )
				) );
			}

			$metadata['_question'] = $question;

			$post_content = "نموذج التواصل\n\n";
			$post_content .= "الاسم: {$full_name}\n";
			$post_content .= "رقم الهاتف: {$phone}\n";
			$post_content .= "السؤال: {$question}\n";
		}

		// Create post
		$post_data = array(
			'post_title'    => $post_title,
			'post_content'  => $post_content,
			'post_status'   => 'publish',
			'post_type'     => 'ehtazem_submissions',
			'post_author'   => 1,
		);

		$post_id = wp_insert_post( $post_data );

		if ( is_wp_error( $post_id ) ) {
			wp_send_json_error( array(
				'message' => __( 'حدث خطأ أثناء الحفظ', 'ehtazem-elementor' )
			) );
		}

		// Add metadata
		foreach ( $metadata as $key => $value ) {
			update_post_meta( $post_id, $key, $value );
		}

		// Send success response
		wp_send_json_success( array(
			'message' => __( 'تم الإرسال بنجاح', 'ehtazem-elementor' ),
			'post_id' => $post_id
		) );
	}

	/**
	 * Load Admin Classes
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function load_admin_classes() {
		require_once( __DIR__ . '/admin/class-admin-dashboard.php' );
		require_once( __DIR__ . '/admin/class-admin-settings.php' );
		require_once( __DIR__ . '/admin/class-image-library.php' );
		require_once( __DIR__ . '/admin/class-email-templates.php' );
		require_once( __DIR__ . '/admin/class-system-health.php' );

		$this->admin_dashboard = new Ehtazem_Admin_Dashboard();
		$this->admin_settings = new Ehtazem_Admin_Settings();
		$this->image_library = new Ehtazem_Image_Library();
		$this->email_templates = new Ehtazem_Email_Templates();
		$this->system_health = new Ehtazem_System_Health();
	}

	/**
	 * Register Admin Menu
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_admin_menu() {
		// Main menu page
		add_menu_page(
			__( 'PUIUX - Ehtazem', 'ehtazem-elementor' ),
			__( 'PUIUX Ehtazem', 'ehtazem-elementor' ),
			'manage_options',
			'ehtazem-dashboard',
			[ $this->admin_dashboard, 'render' ],
			'dashicons-building',
			30
		);

		// Dashboard submenu (default)
		add_submenu_page(
			'ehtazem-dashboard',
			__( 'لوحة التحكم', 'ehtazem-elementor' ),
			__( 'لوحة التحكم', 'ehtazem-elementor' ),
			'manage_options',
			'ehtazem-dashboard',
			[ $this->admin_dashboard, 'render' ]
		);

		// Settings submenu
		add_submenu_page(
			'ehtazem-dashboard',
			__( 'الإعدادات', 'ehtazem-elementor' ),
			__( 'الإعدادات', 'ehtazem-elementor' ),
			'manage_options',
			'ehtazem-settings',
			[ $this->admin_settings, 'render' ]
		);

		// Image Library submenu
		add_submenu_page(
			'ehtazem-dashboard',
			__( 'مكتبة الصور', 'ehtazem-elementor' ),
			__( 'مكتبة الصور', 'ehtazem-elementor' ),
			'manage_options',
			'ehtazem-image-library',
			[ $this->image_library, 'render' ]
		);

		// Email Templates submenu
		add_submenu_page(
			'ehtazem-dashboard',
			__( 'قوالب البريد الإلكتروني', 'ehtazem-elementor' ),
			__( 'قوالب البريد', 'ehtazem-elementor' ),
			'manage_options',
			'ehtazem-email-templates',
			[ $this->email_templates, 'render' ]
		);

		// System Health submenu
		add_submenu_page(
			'ehtazem-dashboard',
			__( 'فحص صحة النظام', 'ehtazem-elementor' ),
			__( 'فحص النظام', 'ehtazem-elementor' ),
			'manage_options',
			'ehtazem-system-health',
			[ $this->system_health, 'render' ]
		);
	}

	/**
	 * Enqueue Admin Assets
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue_admin_assets( $hook ) {
		// Only load on our admin pages
		if ( strpos( $hook, 'ehtazem' ) === false ) {
			return;
		}

		// AOS Library
		wp_enqueue_style(
			'ehtazem-aos',
			'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css',
			[],
			'2.3.4'
		);

		wp_enqueue_script(
			'ehtazem-aos',
			'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js',
			[],
			'2.3.4',
			true
		);

		// Chart.js
		wp_enqueue_script(
			'ehtazem-chart',
			plugins_url( 'admin/assets/js/chart.min.js', __FILE__ ),
			[],
			'4.4.0',
			true
		);

		// Admin CSS
		wp_enqueue_style(
			'ehtazem-admin',
			plugins_url( 'admin/assets/css/admin.css', __FILE__ ),
			[],
			self::VERSION
		);

		// Admin JS
		wp_enqueue_script(
			'ehtazem-admin',
			plugins_url( 'admin/assets/js/admin.js', __FILE__ ),
			[ 'jquery', 'ehtazem-chart', 'ehtazem-aos' ],
			self::VERSION,
			true
		);

		// Localize script for AJAX
		wp_localize_script(
			'ehtazem-admin',
			'ehtazemAdmin',
			[
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'ehtazem_admin_nonce' ),
			]
		);
	}
}

/**
 * Initialize Ehtazem Elementor Widgets
 * Developed by PUIUX
 */
Ehtazem_Elementor_Widgets::instance();
