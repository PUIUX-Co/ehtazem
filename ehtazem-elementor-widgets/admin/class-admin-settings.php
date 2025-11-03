<?php
/**
 * Admin Settings - Settings Page with Tabs
 *
 * @package Ehtazem_Elementor_Widgets
 * @subpackage Admin
 * @since 1.0.0
 *
 * Developed by PUIUX for Ehtazem (Real Estate Empowerment Unit)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Admin Settings Class
 *
 * Provides tabbed settings interface for plugin configuration
 */
class Ehtazem_Admin_Settings {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_init', [ $this, 'register_settings' ] );
		add_action( 'admin_init', [ $this, 'handle_settings_save' ] );
	}

	/**
	 * Register Settings
	 */
	public function register_settings() {
		// General Settings
		register_setting( 'ehtazem_general_settings', 'ehtazem_company_name' );
		register_setting( 'ehtazem_general_settings', 'ehtazem_company_phone' );
		register_setting( 'ehtazem_general_settings', 'ehtazem_company_email' );
		register_setting( 'ehtazem_general_settings', 'ehtazem_facebook_url' );
		register_setting( 'ehtazem_general_settings', 'ehtazem_twitter_url' );
		register_setting( 'ehtazem_general_settings', 'ehtazem_linkedin_url' );
		register_setting( 'ehtazem_general_settings', 'ehtazem_instagram_url' );
		register_setting( 'ehtazem_general_settings', 'ehtazem_copyright_text' );

		// Form Settings
		register_setting( 'ehtazem_form_settings', 'ehtazem_enable_notifications' );
		register_setting( 'ehtazem_form_settings', 'ehtazem_admin_emails' );
		register_setting( 'ehtazem_form_settings', 'ehtazem_enable_auto_reply' );
		register_setting( 'ehtazem_form_settings', 'ehtazem_success_message' );
		register_setting( 'ehtazem_form_settings', 'ehtazem_error_message' );

		// Color Settings
		register_setting( 'ehtazem_color_settings', 'ehtazem_primary_color' );
		register_setting( 'ehtazem_color_settings', 'ehtazem_secondary_color' );
		register_setting( 'ehtazem_color_settings', 'ehtazem_accent_color' );

		// Performance Settings
		register_setting( 'ehtazem_performance_settings', 'ehtazem_enable_caching' );
		register_setting( 'ehtazem_performance_settings', 'ehtazem_cache_duration' );
	}

	/**
	 * Render Settings Page
	 */
	public function render() {
		// Check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'ليس لديك صلاحية للوصول لهذه الصفحة', 'ehtazem-elementor' ) );
		}

		$active_tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'general';

		?>
		<div class="wrap ehtazem-admin-wrap">
			<div class="ehtazem-admin-header">
				<div class="header-top">
					<img src="https://puiux.com/wp-content/uploads/2021/09/Logo-Black-Copress.svg" alt="PUIUX" class="puiux-logo">
					<div>
						<h1><?php esc_html_e( 'إعدادات - احتزم', 'ehtazem-elementor' ); ?></h1>
						<p class="description"><?php esc_html_e( 'تخصيص إعدادات الإضافة والودجات', 'ehtazem-elementor' ); ?></p>
					</div>
				</div>
			</div>

			<!-- Tabs Navigation -->
			<nav class="ehtazem-tabs" data-aos="fade-up">
				<a href="?page=ehtazem-settings&tab=general" class="tab-link <?php echo $active_tab === 'general' ? 'active' : ''; ?>">
					<i class="fas fa-cog"></i> <?php esc_html_e( 'إعدادات عامة', 'ehtazem-elementor' ); ?>
				</a>
				<a href="?page=ehtazem-settings&tab=forms" class="tab-link <?php echo $active_tab === 'forms' ? 'active' : ''; ?>">
					<i class="fas fa-envelope"></i> <?php esc_html_e( 'إعدادات النماذج', 'ehtazem-elementor' ); ?>
				</a>
				<a href="?page=ehtazem-settings&tab=colors" class="tab-link <?php echo $active_tab === 'colors' ? 'active' : ''; ?>">
					<i class="fas fa-palette"></i> <?php esc_html_e( 'الألوان', 'ehtazem-elementor' ); ?>
				</a>
				<a href="?page=ehtazem-settings&tab=performance" class="tab-link <?php echo $active_tab === 'performance' ? 'active' : ''; ?>">
					<i class="fas fa-bolt"></i> <?php esc_html_e( 'الأداء', 'ehtazem-elementor' ); ?>
				</a>
				<a href="?page=ehtazem-settings&tab=urls" class="tab-link <?php echo $active_tab === 'urls' ? 'active' : ''; ?>">
					<i class="fas fa-link"></i> <?php esc_html_e( 'URLs & الأمان', 'ehtazem-elementor' ); ?>
				</a>
			</nav>

			<!-- Tab Content -->
			<div class="ehtazem-tab-content" data-aos="fade-up" data-aos-delay="200">
				<?php
				switch ( $active_tab ) {
					case 'general':
						$this->render_general_tab();
						break;
					case 'forms':
						$this->render_forms_tab();
						break;
					case 'colors':
						$this->render_colors_tab();
						break;
					case 'performance':
						$this->render_performance_tab();
						break;
					case 'urls':
						$this->render_urls_tab();
						break;
				}
				?>
			</div>

			<!-- PUIUX Footer -->
			<div class="ehtazem-admin-footer">
				<div class="footer-content">
					<div class="footer-left">
						<img src="https://puiux.com/wp-content/uploads/2021/09/Logo-Black-Copress.svg" alt="PUIUX" class="footer-logo">
						<p><?php esc_html_e( 'مطور بواسطة PUIUX', 'ehtazem-elementor' ); ?></p>
					</div>
					<div class="footer-right">
						<p><?php esc_html_e( '© 2025 PUIUX. جميع الحقوق محفوظة', 'ehtazem-elementor' ); ?></p>
						<p>
							<a href="https://puiux.com" target="_blank">puiux.com</a> |
							<a href="mailto:Welcome@puiux.com">Welcome@puiux.com</a> |
							<a href="tel:+966544420258">+966 544420258</a>
						</p>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Render General Settings Tab
	 */
	private function render_general_tab() {
		?>
		<div class="ehtazem-card">
			<div class="card-header">
				<h2><?php esc_html_e( 'معلومات الشركة', 'ehtazem-elementor' ); ?></h2>
			</div>
			<div class="card-body">
				<form method="post" action="" class="ehtazem-form">
					<?php wp_nonce_field( 'ehtazem_save_general_settings', 'ehtazem_general_nonce' ); ?>

					<div class="form-group">
						<label for="company_name"><?php esc_html_e( 'اسم الشركة', 'ehtazem-elementor' ); ?></label>
						<input type="text" id="company_name" name="ehtazem_company_name" class="ehtazem-input" value="<?php echo esc_attr( get_option( 'ehtazem_company_name', 'احتزم - وحدة التمكين العقاري' ) ); ?>">
					</div>

					<div class="form-group">
						<label for="company_phone"><?php esc_html_e( 'رقم الهاتف', 'ehtazem-elementor' ); ?></label>
						<input type="text" id="company_phone" name="ehtazem_company_phone" class="ehtazem-input" value="<?php echo esc_attr( get_option( 'ehtazem_company_phone', '+966 11 234 5678' ) ); ?>">
					</div>

					<div class="form-group">
						<label for="company_email"><?php esc_html_e( 'البريد الإلكتروني', 'ehtazem-elementor' ); ?></label>
						<input type="email" id="company_email" name="ehtazem_company_email" class="ehtazem-input" value="<?php echo esc_attr( get_option( 'ehtazem_company_email', 'info@ehtazem.sa' ) ); ?>">
					</div>

					<div class="form-divider"></div>

					<h3><?php esc_html_e( 'روابط التواصل الاجتماعي', 'ehtazem-elementor' ); ?></h3>

					<div class="form-group">
						<label for="facebook_url">
							<i class="fab fa-facebook"></i> <?php esc_html_e( 'فيسبوك', 'ehtazem-elementor' ); ?>
						</label>
						<input type="url" id="facebook_url" name="ehtazem_facebook_url" class="ehtazem-input" value="<?php echo esc_attr( get_option( 'ehtazem_facebook_url', '' ) ); ?>" placeholder="https://facebook.com/...">
					</div>

					<div class="form-group">
						<label for="twitter_url">
							<i class="fab fa-twitter"></i> <?php esc_html_e( 'تويتر (X)', 'ehtazem-elementor' ); ?>
						</label>
						<input type="url" id="twitter_url" name="ehtazem_twitter_url" class="ehtazem-input" value="<?php echo esc_attr( get_option( 'ehtazem_twitter_url', '' ) ); ?>" placeholder="https://twitter.com/...">
					</div>

					<div class="form-group">
						<label for="linkedin_url">
							<i class="fab fa-linkedin"></i> <?php esc_html_e( 'لينكد إن', 'ehtazem-elementor' ); ?>
						</label>
						<input type="url" id="linkedin_url" name="ehtazem_linkedin_url" class="ehtazem-input" value="<?php echo esc_attr( get_option( 'ehtazem_linkedin_url', '' ) ); ?>" placeholder="https://linkedin.com/...">
					</div>

					<div class="form-group">
						<label for="instagram_url">
							<i class="fab fa-instagram"></i> <?php esc_html_e( 'إنستجرام', 'ehtazem-elementor' ); ?>
						</label>
						<input type="url" id="instagram_url" name="ehtazem_instagram_url" class="ehtazem-input" value="<?php echo esc_attr( get_option( 'ehtazem_instagram_url', '' ) ); ?>" placeholder="https://instagram.com/...">
					</div>

					<div class="form-divider"></div>

					<div class="form-group">
						<label for="copyright_text"><?php esc_html_e( 'نص حقوق الطبع والنشر', 'ehtazem-elementor' ); ?></label>
						<textarea id="copyright_text" name="ehtazem_copyright_text" class="ehtazem-textarea" rows="3"><?php echo esc_textarea( get_option( 'ehtazem_copyright_text', '© 2025 احتزم - وحدة التمكين العقاري. جميع الحقوق محفوظة.' ) ); ?></textarea>
					</div>

					<div class="form-actions">
						<button type="submit" name="save_general_settings" class="ehtazem-btn ehtazem-btn-primary">
							<i class="fas fa-save"></i> <?php esc_html_e( 'حفظ التغييرات', 'ehtazem-elementor' ); ?>
						</button>
					</div>
				</form>
			</div>
		</div>
		<?php
	}

	/**
	 * Render Form Settings Tab
	 */
	private function render_forms_tab() {
		?>
		<div class="ehtazem-card">
			<div class="card-header">
				<h2><?php esc_html_e( 'إعدادات النماذج والإشعارات', 'ehtazem-elementor' ); ?></h2>
			</div>
			<div class="card-body">
				<form method="post" action="" class="ehtazem-form">
					<?php wp_nonce_field( 'ehtazem_save_form_settings', 'ehtazem_form_nonce' ); ?>

					<div class="form-group">
						<label class="switch-label">
							<input type="checkbox" name="ehtazem_enable_notifications" value="1" <?php checked( get_option( 'ehtazem_enable_notifications', '1' ), '1' ); ?>>
							<span class="switch-slider"></span>
							<?php esc_html_e( 'تفعيل إشعارات البريد الإلكتروني', 'ehtazem-elementor' ); ?>
						</label>
					</div>

					<div class="form-group">
						<label for="admin_emails"><?php esc_html_e( 'البريد الإلكتروني للإشعارات (افصل بفاصلة للمتعدد)', 'ehtazem-elementor' ); ?></label>
						<input type="text" id="admin_emails" name="ehtazem_admin_emails" class="ehtazem-input" value="<?php echo esc_attr( get_option( 'ehtazem_admin_emails', get_option( 'admin_email' ) ) ); ?>" placeholder="admin@example.com, sales@example.com">
						<small class="help-text"><?php esc_html_e( 'يمكنك إضافة عدة عناوين بريد إلكتروني مفصولة بفاصلة', 'ehtazem-elementor' ); ?></small>
					</div>

					<div class="form-divider"></div>

					<div class="form-group">
						<label class="switch-label">
							<input type="checkbox" name="ehtazem_enable_auto_reply" value="1" <?php checked( get_option( 'ehtazem_enable_auto_reply', '1' ), '1' ); ?>>
							<span class="switch-slider"></span>
							<?php esc_html_e( 'تفعيل الرد التلقائي للمستخدمين', 'ehtazem-elementor' ); ?>
						</label>
					</div>

					<div class="form-divider"></div>

					<div class="form-group">
						<label for="success_message"><?php esc_html_e( 'رسالة النجاح', 'ehtazem-elementor' ); ?></label>
						<textarea id="success_message" name="ehtazem_success_message" class="ehtazem-textarea" rows="3"><?php echo esc_textarea( get_option( 'ehtazem_success_message', 'شكراً لك! تم إرسال رسالتك بنجاح وسنتواصل معك قريباً.' ) ); ?></textarea>
					</div>

					<div class="form-group">
						<label for="error_message"><?php esc_html_e( 'رسالة الخطأ', 'ehtazem-elementor' ); ?></label>
						<textarea id="error_message" name="ehtazem_error_message" class="ehtazem-textarea" rows="3"><?php echo esc_textarea( get_option( 'ehtazem_error_message', 'عذراً، حدث خطأ أثناء إرسال الرسالة. الرجاء المحاولة مرة أخرى.' ) ); ?></textarea>
					</div>

					<div class="form-actions">
						<button type="submit" name="save_form_settings" class="ehtazem-btn ehtazem-btn-primary">
							<i class="fas fa-save"></i> <?php esc_html_e( 'حفظ التغييرات', 'ehtazem-elementor' ); ?>
						</button>
					</div>
				</form>
			</div>
		</div>
		<?php
	}

	/**
	 * Render Colors Tab
	 */
	private function render_colors_tab() {
		?>
		<div class="ehtazem-card">
			<div class="card-header">
				<h2><?php esc_html_e( 'ألوان الودجات', 'ehtazem-elementor' ); ?></h2>
			</div>
			<div class="card-body">
				<form method="post" action="" class="ehtazem-form">
					<?php wp_nonce_field( 'ehtazem_save_color_settings', 'ehtazem_color_nonce' ); ?>

					<div class="color-picker-group">
						<div class="color-picker-item">
							<label for="primary_color"><?php esc_html_e( 'اللون الأساسي', 'ehtazem-elementor' ); ?></label>
							<input type="color" id="primary_color" name="ehtazem_primary_color" class="ehtazem-color-picker" value="<?php echo esc_attr( get_option( 'ehtazem_primary_color', '#1E40AF' ) ); ?>">
							<span class="color-value"><?php echo esc_html( get_option( 'ehtazem_primary_color', '#1E40AF' ) ); ?></span>
						</div>

						<div class="color-picker-item">
							<label for="secondary_color"><?php esc_html_e( 'اللون الثانوي', 'ehtazem-elementor' ); ?></label>
							<input type="color" id="secondary_color" name="ehtazem_secondary_color" class="ehtazem-color-picker" value="<?php echo esc_attr( get_option( 'ehtazem_secondary_color', '#F59E0B' ) ); ?>">
							<span class="color-value"><?php echo esc_html( get_option( 'ehtazem_secondary_color', '#F59E0B' ) ); ?></span>
						</div>

						<div class="color-picker-item">
							<label for="accent_color"><?php esc_html_e( 'لون التمييز', 'ehtazem-elementor' ); ?></label>
							<input type="color" id="accent_color" name="ehtazem_accent_color" class="ehtazem-color-picker" value="<?php echo esc_attr( get_option( 'ehtazem_accent_color', '#10B981' ) ); ?>">
							<span class="color-value"><?php echo esc_html( get_option( 'ehtazem_accent_color', '#10B981' ) ); ?></span>
						</div>
					</div>

					<div class="form-divider"></div>

					<div class="color-preview">
						<h3><?php esc_html_e( 'معاينة الألوان', 'ehtazem-elementor' ); ?></h3>
						<div class="preview-swatches">
							<div class="swatch" style="background-color: <?php echo esc_attr( get_option( 'ehtazem_primary_color', '#1E40AF' ) ); ?>;">
								<span><?php esc_html_e( 'أساسي', 'ehtazem-elementor' ); ?></span>
							</div>
							<div class="swatch" style="background-color: <?php echo esc_attr( get_option( 'ehtazem_secondary_color', '#F59E0B' ) ); ?>;">
								<span><?php esc_html_e( 'ثانوي', 'ehtazem-elementor' ); ?></span>
							</div>
							<div class="swatch" style="background-color: <?php echo esc_attr( get_option( 'ehtazem_accent_color', '#10B981' ) ); ?>;">
								<span><?php esc_html_e( 'تمييز', 'ehtazem-elementor' ); ?></span>
							</div>
						</div>
					</div>

					<div class="form-actions">
						<button type="submit" name="save_color_settings" class="ehtazem-btn ehtazem-btn-primary">
							<i class="fas fa-save"></i> <?php esc_html_e( 'حفظ التغييرات', 'ehtazem-elementor' ); ?>
						</button>
						<button type="button" class="ehtazem-btn ehtazem-btn-secondary" onclick="ehtazem_reset_colors()">
							<i class="fas fa-undo"></i> <?php esc_html_e( 'إعادة تعيين الألوان الافتراضية', 'ehtazem-elementor' ); ?>
						</button>
					</div>
				</form>
			</div>
		</div>
		<?php
	}

	/**
	 * Render Performance Tab
	 */
	private function render_performance_tab() {
		?>
		<div class="ehtazem-card">
			<div class="card-header">
				<h2><?php esc_html_e( 'إعدادات الأداء والتخزين المؤقت', 'ehtazem-elementor' ); ?></h2>
			</div>
			<div class="card-body">
				<form method="post" action="" class="ehtazem-form">
					<?php wp_nonce_field( 'ehtazem_save_performance_settings', 'ehtazem_performance_nonce' ); ?>

					<div class="form-group">
						<label class="switch-label">
							<input type="checkbox" name="ehtazem_enable_caching" value="1" <?php checked( get_option( 'ehtazem_enable_caching', '0' ), '1' ); ?>>
							<span class="switch-slider"></span>
							<?php esc_html_e( 'تفعيل التخزين المؤقت', 'ehtazem-elementor' ); ?>
						</label>
						<small class="help-text"><?php esc_html_e( 'يساعد التخزين المؤقت على تحسين سرعة تحميل الودجات', 'ehtazem-elementor' ); ?></small>
					</div>

					<div class="form-group">
						<label for="cache_duration"><?php esc_html_e( 'مدة التخزين المؤقت (بالساعات)', 'ehtazem-elementor' ); ?></label>
						<input type="number" id="cache_duration" name="ehtazem_cache_duration" class="ehtazem-input" value="<?php echo esc_attr( get_option( 'ehtazem_cache_duration', '24' ) ); ?>" min="1" max="168">
						<small class="help-text"><?php esc_html_e( 'الحد الأقصى: 168 ساعة (أسبوع واحد)', 'ehtazem-elementor' ); ?></small>
					</div>

					<div class="form-divider"></div>

					<div class="cache-actions">
						<button type="button" class="ehtazem-btn ehtazem-btn-secondary" onclick="ehtazem_clear_cache()">
							<i class="fas fa-trash"></i> <?php esc_html_e( 'مسح التخزين المؤقت', 'ehtazem-elementor' ); ?>
						</button>
						<button type="button" class="ehtazem-btn ehtazem-btn-secondary" onclick="ehtazem_regenerate_css()">
							<i class="fas fa-sync"></i> <?php esc_html_e( 'إعادة بناء CSS', 'ehtazem-elementor' ); ?>
						</button>
					</div>

					<div class="form-actions">
						<button type="submit" name="save_performance_settings" class="ehtazem-btn ehtazem-btn-primary">
							<i class="fas fa-save"></i> <?php esc_html_e( 'حفظ التغييرات', 'ehtazem-elementor' ); ?>
						</button>
					</div>
				</form>
			</div>
		</div>
		<?php
	}

	/**
	 * Render URLs & Security Tab
	 */
	private function render_urls_tab() {
		?>
		<div class="ehtazem-card">
			<div class="card-header">
				<h2><?php esc_html_e( 'عناوين URL والأمان', 'ehtazem-elementor' ); ?></h2>
			</div>
			<div class="card-body">
				<form method="post" action="" class="ehtazem-form">
					<?php wp_nonce_field( 'ehtazem_save_urls_settings', 'ehtazem_urls_nonce' ); ?>

					<div class="form-group">
						<h3><?php esc_html_e( 'تخصيص روابط الإدارة', 'ehtazem-elementor' ); ?></h3>
						<p class="description"><?php esc_html_e( 'تخصيص عناوين URL لصفحات الإدارة والدخول', 'ehtazem-elementor' ); ?></p>
					</div>

					<div class="form-group">
						<label for="dashboard_url"><?php esc_html_e( 'رابط لوحة التحكم', 'ehtazem-elementor' ); ?></label>
						<input type="text" id="dashboard_url" name="ehtazem_dashboard_url" class="ehtazem-input" value="<?php echo esc_attr( get_option( 'ehtazem_dashboard_url', 'ehtazem-dashboard' ) ); ?>">
						<small class="help-text">
							<?php
							echo sprintf(
								esc_html__( 'الرابط الحالي: %s', 'ehtazem-elementor' ),
								'<code>' . admin_url( 'admin.php?page=' . get_option( 'ehtazem_dashboard_url', 'ehtazem-dashboard' ) ) . '</code>'
							);
							?>
						</small>
					</div>

					<div class="form-group">
						<label for="custom_login_url"><?php esc_html_e( 'رابط تسجيل الدخول المخصص', 'ehtazem-elementor' ); ?></label>
						<input type="text" id="custom_login_url" name="ehtazem_custom_login_url" class="ehtazem-input" value="<?php echo esc_attr( get_option( 'ehtazem_custom_login_url', '' ) ); ?>" placeholder="puiux-login">
						<small class="help-text">
							<?php esc_html_e( 'اتركه فارغاً لاستخدام الرابط الافتراضي /wp-admin', 'ehtazem-elementor' ); ?><br>
							<?php
							$custom_login = get_option( 'ehtazem_custom_login_url', '' );
							if ( ! empty( $custom_login ) ) {
								echo sprintf(
									esc_html__( 'الرابط الحالي: %s', 'ehtazem-elementor' ),
									'<code>' . home_url( $custom_login ) . '</code>'
								);
							}
							?>
						</small>
					</div>

					<div class="form-group">
						<label class="switch-label">
							<input type="checkbox" name="ehtazem_hide_wp_admin" value="1" <?php checked( get_option( 'ehtazem_hide_wp_admin' ), '1' ); ?>>
							<span class="switch-slider"></span>
							<?php esc_html_e( 'إخفاء wp-admin للزوار - إعادة توجيه الزوار غير المسجلين من /wp-admin', 'ehtazem-elementor' ); ?>
						</label>
						<small class="help-text"><?php esc_html_e( 'يحمي من محاولات الوصول غير المصرح بها', 'ehtazem-elementor' ); ?></small>
					</div>

					<div class="form-divider"></div>

					<div class="form-group">
						<h3><?php esc_html_e( 'الأمان', 'ehtazem-elementor' ); ?></h3>
					</div>

					<div class="form-group">
						<label for="max_login_attempts"><?php esc_html_e( 'الحد الأقصى لمحاولات الدخول', 'ehtazem-elementor' ); ?></label>
						<input type="number" id="max_login_attempts" name="ehtazem_max_login_attempts" class="ehtazem-input" value="<?php echo esc_attr( get_option( 'ehtazem_max_login_attempts', '5' ) ); ?>" min="3" max="10" style="max-width: 100px;">
						<span><?php esc_html_e( 'محاولات قبل المنع', 'ehtazem-elementor' ); ?></span>
						<small class="help-text"><?php esc_html_e( 'عدد المحاولات الفاشلة المسموح بها قبل حظر IP', 'ehtazem-elementor' ); ?></small>
					</div>

					<div class="form-actions">
						<button type="submit" name="save_urls_settings" class="ehtazem-btn ehtazem-btn-primary">
							<i class="fas fa-save"></i> <?php esc_html_e( 'حفظ التغييرات', 'ehtazem-elementor' ); ?>
						</button>
					</div>
				</form>
			</div>
		</div>
		<?php
	}

	/**
	 * Handle Settings Save
	 */
	public function handle_settings_save() {
		// General Settings
		if ( isset( $_POST['save_general_settings'] ) && check_admin_referer( 'ehtazem_save_general_settings', 'ehtazem_general_nonce' ) ) {
			update_option( 'ehtazem_company_name', sanitize_text_field( $_POST['ehtazem_company_name'] ) );
			update_option( 'ehtazem_company_phone', sanitize_text_field( $_POST['ehtazem_company_phone'] ) );
			update_option( 'ehtazem_company_email', sanitize_email( $_POST['ehtazem_company_email'] ) );
			update_option( 'ehtazem_facebook_url', esc_url_raw( $_POST['ehtazem_facebook_url'] ) );
			update_option( 'ehtazem_twitter_url', esc_url_raw( $_POST['ehtazem_twitter_url'] ) );
			update_option( 'ehtazem_linkedin_url', esc_url_raw( $_POST['ehtazem_linkedin_url'] ) );
			update_option( 'ehtazem_instagram_url', esc_url_raw( $_POST['ehtazem_instagram_url'] ) );
			update_option( 'ehtazem_copyright_text', sanitize_textarea_field( $_POST['ehtazem_copyright_text'] ) );

			add_settings_error( 'ehtazem_settings', 'settings_updated', __( 'تم حفظ الإعدادات بنجاح', 'ehtazem-elementor' ), 'success' );
		}

		// Form Settings
		if ( isset( $_POST['save_form_settings'] ) && check_admin_referer( 'ehtazem_save_form_settings', 'ehtazem_form_nonce' ) ) {
			update_option( 'ehtazem_enable_notifications', isset( $_POST['ehtazem_enable_notifications'] ) ? '1' : '0' );
			update_option( 'ehtazem_admin_emails', sanitize_text_field( $_POST['ehtazem_admin_emails'] ) );
			update_option( 'ehtazem_enable_auto_reply', isset( $_POST['ehtazem_enable_auto_reply'] ) ? '1' : '0' );
			update_option( 'ehtazem_success_message', sanitize_textarea_field( $_POST['ehtazem_success_message'] ) );
			update_option( 'ehtazem_error_message', sanitize_textarea_field( $_POST['ehtazem_error_message'] ) );

			add_settings_error( 'ehtazem_settings', 'settings_updated', __( 'تم حفظ إعدادات النماذج بنجاح', 'ehtazem-elementor' ), 'success' );
		}

		// Color Settings
		if ( isset( $_POST['save_color_settings'] ) && check_admin_referer( 'ehtazem_save_color_settings', 'ehtazem_color_nonce' ) ) {
			update_option( 'ehtazem_primary_color', sanitize_hex_color( $_POST['ehtazem_primary_color'] ) );
			update_option( 'ehtazem_secondary_color', sanitize_hex_color( $_POST['ehtazem_secondary_color'] ) );
			update_option( 'ehtazem_accent_color', sanitize_hex_color( $_POST['ehtazem_accent_color'] ) );

			add_settings_error( 'ehtazem_settings', 'settings_updated', __( 'تم حفظ إعدادات الألوان بنجاح', 'ehtazem-elementor' ), 'success' );
		}

		// Performance Settings
		if ( isset( $_POST['save_performance_settings'] ) && check_admin_referer( 'ehtazem_save_performance_settings', 'ehtazem_performance_nonce' ) ) {
			update_option( 'ehtazem_enable_caching', isset( $_POST['ehtazem_enable_caching'] ) ? '1' : '0' );
			update_option( 'ehtazem_cache_duration', absint( $_POST['ehtazem_cache_duration'] ) );

			add_settings_error( 'ehtazem_settings', 'settings_updated', __( 'تم حفظ إعدادات الأداء بنجاح', 'ehtazem-elementor' ), 'success' );
		}

		// URLs & Security Settings
		if ( isset( $_POST['save_urls_settings'] ) && check_admin_referer( 'ehtazem_save_urls_settings', 'ehtazem_urls_nonce' ) ) {
			if ( isset( $_POST['ehtazem_dashboard_url'] ) ) {
				update_option( 'ehtazem_dashboard_url', sanitize_title( $_POST['ehtazem_dashboard_url'] ) );
			}
			if ( isset( $_POST['ehtazem_custom_login_url'] ) ) {
				update_option( 'ehtazem_custom_login_url', sanitize_title( $_POST['ehtazem_custom_login_url'] ) );
			}
			update_option( 'ehtazem_hide_wp_admin', isset( $_POST['ehtazem_hide_wp_admin'] ) ? '1' : '0' );
			if ( isset( $_POST['ehtazem_max_login_attempts'] ) ) {
				update_option( 'ehtazem_max_login_attempts', absint( $_POST['ehtazem_max_login_attempts'] ) );
			}

			add_settings_error( 'ehtazem_settings', 'settings_updated', __( 'تم حفظ إعدادات URLs والأمان بنجاح', 'ehtazem-elementor' ), 'success' );
		}
	}
}
