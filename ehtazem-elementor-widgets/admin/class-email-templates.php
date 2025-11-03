<?php
/**
 * Email Templates Manager
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
 * Email Templates Class
 *
 * Manages email templates for notifications and auto-replies
 */
class Ehtazem_Email_Templates {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_init', [ $this, 'handle_template_save' ] );
		add_action( 'wp_ajax_ehtazem_send_test_email', [ $this, 'send_test_email' ] );
	}

	/**
	 * Render Email Templates Page
	 */
	public function render() {
		// Check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'ليس لديك صلاحية للوصول لهذه الصفحة', 'ehtazem-elementor' ) );
		}

		$active_template = isset( $_GET['template'] ) ? sanitize_text_field( $_GET['template'] ) : 'admin_notification';

		?>
		<div class="wrap ehtazem-admin-wrap">
			<div class="ehtazem-admin-header">
				<div class="header-top">
					<img src="https://puiux.com/wp-content/uploads/2021/09/Logo-Black-Copress.svg" alt="PUIUX" class="puiux-logo">
					<div>
						<h1><?php esc_html_e( 'قوالب البريد الإلكتروني - احتزم', 'ehtazem-elementor' ); ?></h1>
						<p class="description"><?php esc_html_e( 'تخصيص قوالب البريد الإلكتروني للإشعارات والردود التلقائية', 'ehtazem-elementor' ); ?></p>
					</div>
				</div>
			</div>

			<!-- Templates Navigation -->
			<nav class="ehtazem-tabs" data-aos="fade-up">
				<a href="?page=ehtazem-email-templates&template=admin_notification" class="tab-link <?php echo $active_template === 'admin_notification' ? 'active' : ''; ?>">
					<i class="fas fa-envelope"></i> <?php esc_html_e( 'إشعار الإدارة', 'ehtazem-elementor' ); ?>
				</a>
				<a href="?page=ehtazem-email-templates&template=user_auto_reply" class="tab-link <?php echo $active_template === 'user_auto_reply' ? 'active' : ''; ?>">
					<i class="fas fa-reply"></i> <?php esc_html_e( 'رد تلقائي للمستخدم', 'ehtazem-elementor' ); ?>
				</a>
				<a href="?page=ehtazem-email-templates&template=hot_lead_alert" class="tab-link <?php echo $active_template === 'hot_lead_alert' ? 'active' : ''; ?>">
					<i class="fas fa-fire"></i> <?php esc_html_e( 'تنبيه عميل مهم', 'ehtazem-elementor' ); ?>
				</a>
			</nav>

			<!-- Template Editor -->
			<div class="ehtazem-tab-content" data-aos="fade-up" data-aos-delay="200">
				<?php
				switch ( $active_template ) {
					case 'admin_notification':
						$this->render_admin_notification_template();
						break;
					case 'user_auto_reply':
						$this->render_user_auto_reply_template();
						break;
					case 'hot_lead_alert':
						$this->render_hot_lead_alert_template();
						break;
				}
				?>
			</div>

			<!-- Variables Reference -->
			<div class="ehtazem-card" data-aos="fade-up" data-aos-delay="300">
				<div class="card-header">
					<h2><?php esc_html_e( 'المتغيرات المتاحة', 'ehtazem-elementor' ); ?></h2>
				</div>
				<div class="card-body">
					<div class="variables-grid">
						<div class="variable-item">
							<code>{name}</code>
							<span><?php esc_html_e( 'اسم المستخدم', 'ehtazem-elementor' ); ?></span>
						</div>
						<div class="variable-item">
							<code>{email}</code>
							<span><?php esc_html_e( 'البريد الإلكتروني', 'ehtazem-elementor' ); ?></span>
						</div>
						<div class="variable-item">
							<code>{phone}</code>
							<span><?php esc_html_e( 'رقم الهاتف', 'ehtazem-elementor' ); ?></span>
						</div>
						<div class="variable-item">
							<code>{company}</code>
							<span><?php esc_html_e( 'اسم الشركة', 'ehtazem-elementor' ); ?></span>
						</div>
						<div class="variable-item">
							<code>{region}</code>
							<span><?php esc_html_e( 'المنطقة', 'ehtazem-elementor' ); ?></span>
						</div>
						<div class="variable-item">
							<code>{message}</code>
							<span><?php esc_html_e( 'نص الرسالة', 'ehtazem-elementor' ); ?></span>
						</div>
						<div class="variable-item">
							<code>{date}</code>
							<span><?php esc_html_e( 'التاريخ والوقت', 'ehtazem-elementor' ); ?></span>
						</div>
						<div class="variable-item">
							<code>{score}</code>
							<span><?php esc_html_e( 'تقييم العميل', 'ehtazem-elementor' ); ?></span>
						</div>
						<div class="variable-item">
							<code>{site_name}</code>
							<span><?php esc_html_e( 'اسم الموقع', 'ehtazem-elementor' ); ?></span>
						</div>
						<div class="variable-item">
							<code>{site_url}</code>
							<span><?php esc_html_e( 'رابط الموقع', 'ehtazem-elementor' ); ?></span>
						</div>
					</div>
				</div>
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
	 * Render Admin Notification Template
	 */
	private function render_admin_notification_template() {
		$subject = get_option( 'ehtazem_email_admin_subject', 'طلب تواصل جديد من {name}' );
		$body = get_option( 'ehtazem_email_admin_body', $this->get_default_admin_template() );

		?>
		<div class="ehtazem-card">
			<div class="card-header">
				<h2><?php esc_html_e( 'قالب إشعار الإدارة', 'ehtazem-elementor' ); ?></h2>
			</div>
			<div class="card-body">
				<form method="post" action="" class="ehtazem-form">
					<?php wp_nonce_field( 'ehtazem_save_email_template', 'email_template_nonce' ); ?>
					<input type="hidden" name="template_type" value="admin_notification">

					<div class="form-group">
						<label for="email_subject"><?php esc_html_e( 'موضوع البريد', 'ehtazem-elementor' ); ?></label>
						<input type="text" id="email_subject" name="email_subject" class="ehtazem-input" value="<?php echo esc_attr( $subject ); ?>">
					</div>

					<div class="form-group">
						<label for="email_body"><?php esc_html_e( 'محتوى البريد', 'ehtazem-elementor' ); ?></label>
						<?php
						wp_editor( $body, 'email_body', [
							'textarea_name' => 'email_body',
							'textarea_rows' => 15,
							'media_buttons' => false,
							'teeny' => false,
							'tinymce' => [
								'toolbar1' => 'formatselect,bold,italic,underline,bullist,numlist,link,alignleft,aligncenter,alignright',
							],
						] );
						?>
					</div>

					<div class="form-actions">
						<button type="submit" name="save_email_template" class="ehtazem-btn ehtazem-btn-primary">
							<i class="fas fa-save"></i> <?php esc_html_e( 'حفظ القالب', 'ehtazem-elementor' ); ?>
						</button>
						<button type="button" class="ehtazem-btn ehtazem-btn-secondary" onclick="ehtazem_preview_email('admin_notification')">
							<i class="fas fa-eye"></i> <?php esc_html_e( 'معاينة', 'ehtazem-elementor' ); ?>
						</button>
						<button type="button" class="ehtazem-btn ehtazem-btn-secondary" onclick="ehtazem_send_test_email('admin_notification')">
							<i class="fas fa-paper-plane"></i> <?php esc_html_e( 'إرسال تجريبي', 'ehtazem-elementor' ); ?>
						</button>
					</div>
				</form>
			</div>
		</div>
		<?php
	}

	/**
	 * Render User Auto-Reply Template
	 */
	private function render_user_auto_reply_template() {
		$subject = get_option( 'ehtazem_email_user_subject', 'شكراً لتواصلك مع احتزم' );
		$body = get_option( 'ehtazem_email_user_body', $this->get_default_user_template() );

		?>
		<div class="ehtazem-card">
			<div class="card-header">
				<h2><?php esc_html_e( 'قالب الرد التلقائي للمستخدم', 'ehtazem-elementor' ); ?></h2>
			</div>
			<div class="card-body">
				<form method="post" action="" class="ehtazem-form">
					<?php wp_nonce_field( 'ehtazem_save_email_template', 'email_template_nonce' ); ?>
					<input type="hidden" name="template_type" value="user_auto_reply">

					<div class="form-group">
						<label for="email_subject"><?php esc_html_e( 'موضوع البريد', 'ehtazem-elementor' ); ?></label>
						<input type="text" id="email_subject" name="email_subject" class="ehtazem-input" value="<?php echo esc_attr( $subject ); ?>">
					</div>

					<div class="form-group">
						<label for="email_body"><?php esc_html_e( 'محتوى البريد', 'ehtazem-elementor' ); ?></label>
						<?php
						wp_editor( $body, 'email_body', [
							'textarea_name' => 'email_body',
							'textarea_rows' => 15,
							'media_buttons' => false,
							'teeny' => false,
							'tinymce' => [
								'toolbar1' => 'formatselect,bold,italic,underline,bullist,numlist,link,alignleft,aligncenter,alignright',
							],
						] );
						?>
					</div>

					<div class="form-actions">
						<button type="submit" name="save_email_template" class="ehtazem-btn ehtazem-btn-primary">
							<i class="fas fa-save"></i> <?php esc_html_e( 'حفظ القالب', 'ehtazem-elementor' ); ?>
						</button>
						<button type="button" class="ehtazem-btn ehtazem-btn-secondary" onclick="ehtazem_preview_email('user_auto_reply')">
							<i class="fas fa-eye"></i> <?php esc_html_e( 'معاينة', 'ehtazem-elementor' ); ?>
						</button>
						<button type="button" class="ehtazem-btn ehtazem-btn-secondary" onclick="ehtazem_send_test_email('user_auto_reply')">
							<i class="fas fa-paper-plane"></i> <?php esc_html_e( 'إرسال تجريبي', 'ehtazem-elementor' ); ?>
						</button>
					</div>
				</form>
			</div>
		</div>
		<?php
	}

	/**
	 * Render Hot Lead Alert Template
	 */
	private function render_hot_lead_alert_template() {
		$subject = get_option( 'ehtazem_email_hotlead_subject', '🔥 عميل محتمل مهم: {name}' );
		$body = get_option( 'ehtazem_email_hotlead_body', $this->get_default_hotlead_template() );

		?>
		<div class="ehtazem-card">
			<div class="card-header">
				<h2><?php esc_html_e( 'قالب تنبيه العميل المهم', 'ehtazem-elementor' ); ?></h2>
			</div>
			<div class="card-body">
				<form method="post" action="" class="ehtazem-form">
					<?php wp_nonce_field( 'ehtazem_save_email_template', 'email_template_nonce' ); ?>
					<input type="hidden" name="template_type" value="hot_lead_alert">

					<div class="form-group">
						<label for="email_subject"><?php esc_html_e( 'موضوع البريد', 'ehtazem-elementor' ); ?></label>
						<input type="text" id="email_subject" name="email_subject" class="ehtazem-input" value="<?php echo esc_attr( $subject ); ?>">
					</div>

					<div class="form-group">
						<label for="email_body"><?php esc_html_e( 'محتوى البريد', 'ehtazem-elementor' ); ?></label>
						<?php
						wp_editor( $body, 'email_body', [
							'textarea_name' => 'email_body',
							'textarea_rows' => 15,
							'media_buttons' => false,
							'teeny' => false,
							'tinymce' => [
								'toolbar1' => 'formatselect,bold,italic,underline,bullist,numlist,link,alignleft,aligncenter,alignright',
							],
						] );
						?>
					</div>

					<div class="form-actions">
						<button type="submit" name="save_email_template" class="ehtazem-btn ehtazem-btn-primary">
							<i class="fas fa-save"></i> <?php esc_html_e( 'حفظ القالب', 'ehtazem-elementor' ); ?>
						</button>
						<button type="button" class="ehtazem-btn ehtazem-btn-secondary" onclick="ehtazem_preview_email('hot_lead_alert')">
							<i class="fas fa-eye"></i> <?php esc_html_e( 'معاينة', 'ehtazem-elementor' ); ?>
						</button>
						<button type="button" class="ehtazem-btn ehtazem-btn-secondary" onclick="ehtazem_send_test_email('hot_lead_alert')">
							<i class="fas fa-paper-plane"></i> <?php esc_html_e( 'إرسال تجريبي', 'ehtazem-elementor' ); ?>
						</button>
					</div>
				</form>
			</div>
		</div>
		<?php
	}

	/**
	 * Get Default Admin Template
	 */
	private function get_default_admin_template() {
		return '<div dir="rtl" style="font-family: Cairo, sans-serif; padding: 20px; background-color: #f9fafb;">
	<div style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
		<div style="background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 100%); padding: 30px; text-align: center;">
			<h1 style="color: white; margin: 0; font-size: 24px;">طلب تواصل جديد</h1>
		</div>
		<div style="padding: 30px;">
			<p style="font-size: 16px; line-height: 1.6; color: #1a1a1a;">مرحباً،</p>
			<p style="font-size: 16px; line-height: 1.6; color: #1a1a1a;">تلقيت طلب تواصل جديد من موقع احتزم:</p>

			<div style="background-color: #f9fafb; padding: 20px; border-radius: 8px; margin: 20px 0;">
				<p style="margin: 10px 0;"><strong>الاسم:</strong> {name}</p>
				<p style="margin: 10px 0;"><strong>الهاتف:</strong> {phone}</p>
				<p style="margin: 10px 0;"><strong>الشركة:</strong> {company}</p>
				<p style="margin: 10px 0;"><strong>المنطقة:</strong> {region}</p>
				<p style="margin: 10px 0;"><strong>الرسالة:</strong><br>{message}</p>
				<p style="margin: 10px 0;"><strong>التاريخ:</strong> {date}</p>
			</div>

			<p style="text-align: center; margin: 30px 0;">
				<a href="{site_url}/wp-admin" style="display: inline-block; background-color: #1E40AF; color: white; padding: 12px 30px; border-radius: 5px; text-decoration: none; font-weight: 600;">عرض في لوحة التحكم</a>
			</p>
		</div>
		<div style="background-color: #f9fafb; padding: 20px; text-align: center; color: #666;">
			<p style="margin: 0; font-size: 14px;">{site_name} - Developed by PUIUX</p>
		</div>
	</div>
</div>';
	}

	/**
	 * Get Default User Template
	 */
	private function get_default_user_template() {
		return '<div dir="rtl" style="font-family: Cairo, sans-serif; padding: 20px; background-color: #f9fafb;">
	<div style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
		<div style="background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 100%); padding: 30px; text-align: center;">
			<h1 style="color: white; margin: 0; font-size: 24px;">شكراً لتواصلك معنا</h1>
		</div>
		<div style="padding: 30px;">
			<p style="font-size: 16px; line-height: 1.6; color: #1a1a1a;">عزيزي/عزيزتي {name}،</p>
			<p style="font-size: 16px; line-height: 1.6; color: #1a1a1a;">شكراً لتواصلك مع وحدة التمكين العقاري (احتزم). تلقينا رسالتك وسيتواصل معك فريقنا في أقرب وقت ممكن.</p>

			<div style="background-color: #f0f9ff; border-right: 4px solid #1E40AF; padding: 20px; margin: 20px 0;">
				<p style="margin: 0; color: #1E40AF; font-weight: 600;">نسعى دائماً لخدمتك بأفضل شكل ممكن!</p>
			</div>

			<p style="font-size: 16px; line-height: 1.6; color: #1a1a1a;">إذا كانت لديك أي استفسارات عاجلة، يرجى الاتصال بنا على:</p>
			<p style="text-align: center; font-size: 18px; color: #1E40AF; font-weight: 600;">+966 11 234 5678</p>

			<p style="font-size: 14px; line-height: 1.6; color: #666; margin-top: 30px;">مع أطيب التحيات،<br>فريق احتزم</p>
		</div>
		<div style="background-color: #f9fafb; padding: 20px; text-align: center; color: #666;">
			<p style="margin: 0; font-size: 14px;">{site_name} - Developed by PUIUX</p>
		</div>
	</div>
</div>';
	}

	/**
	 * Get Default Hot Lead Template
	 */
	private function get_default_hotlead_template() {
		return '<div dir="rtl" style="font-family: Cairo, sans-serif; padding: 20px; background-color: #f9fafb;">
	<div style="max-width: 600px; margin: 0 auto; background-color: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
		<div style="background: linear-gradient(135deg, #EF4444 0%, #F59E0B 100%); padding: 30px; text-align: center;">
			<h1 style="color: white; margin: 0; font-size: 24px;">🔥 عميل محتمل مهم</h1>
		</div>
		<div style="padding: 30px;">
			<div style="background-color: #fef2f2; border-right: 4px solid #EF4444; padding: 20px; margin-bottom: 20px;">
				<p style="margin: 0; color: #EF4444; font-weight: 600; font-size: 18px;">تنبيه: عميل ذو أولوية عالية!</p>
				<p style="margin: 10px 0 0 0; color: #666;">التقييم: <strong>{score}</strong> / 100</p>
			</div>

			<p style="font-size: 16px; line-height: 1.6; color: #1a1a1a;">تلقيت طلب تواصل من عميل محتمل مهم يتطلب اهتماماً فورياً:</p>

			<div style="background-color: #f9fafb; padding: 20px; border-radius: 8px; margin: 20px 0;">
				<p style="margin: 10px 0;"><strong>الاسم:</strong> {name}</p>
				<p style="margin: 10px 0;"><strong>الهاتف:</strong> {phone}</p>
				<p style="margin: 10px 0;"><strong>الشركة:</strong> {company}</p>
				<p style="margin: 10px 0;"><strong>المنطقة:</strong> {region}</p>
				<p style="margin: 10px 0;"><strong>الرسالة:</strong><br>{message}</p>
			</div>

			<p style="background-color: #fff7ed; border-right: 4px solid #F59E0B; padding: 15px; color: #92400e;">
				<strong>يُنصح بالتواصل مع هذا العميل في أسرع وقت ممكن!</strong>
			</p>

			<p style="text-align: center; margin: 30px 0;">
				<a href="{site_url}/wp-admin" style="display: inline-block; background-color: #EF4444; color: white; padding: 12px 30px; border-radius: 5px; text-decoration: none; font-weight: 600;">اتخذ إجراء الآن</a>
			</p>
		</div>
		<div style="background-color: #f9fafb; padding: 20px; text-align: center; color: #666;">
			<p style="margin: 0; font-size: 14px;">{site_name} - Developed by PUIUX</p>
		</div>
	</div>
</div>';
	}

	/**
	 * Handle Template Save
	 */
	public function handle_template_save() {
		if ( ! isset( $_POST['save_email_template'] ) || ! check_admin_referer( 'ehtazem_save_email_template', 'email_template_nonce' ) ) {
			return;
		}

		$template_type = sanitize_text_field( $_POST['template_type'] );
		$subject = sanitize_text_field( $_POST['email_subject'] );
		$body = wp_kses_post( $_POST['email_body'] );

		if ( $template_type === 'admin_notification' ) {
			update_option( 'ehtazem_email_admin_subject', $subject );
			update_option( 'ehtazem_email_admin_body', $body );
		} elseif ( $template_type === 'user_auto_reply' ) {
			update_option( 'ehtazem_email_user_subject', $subject );
			update_option( 'ehtazem_email_user_body', $body );
		} elseif ( $template_type === 'hot_lead_alert' ) {
			update_option( 'ehtazem_email_hotlead_subject', $subject );
			update_option( 'ehtazem_email_hotlead_body', $body );
		}

		add_settings_error( 'ehtazem_email_templates', 'template_saved', __( 'تم حفظ القالب بنجاح', 'ehtazem-elementor' ), 'success' );
	}

	/**
	 * Send Test Email
	 */
	public function send_test_email() {
		// Check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( [ 'message' => __( 'ليس لديك صلاحية لإرسال البريد التجريبي', 'ehtazem-elementor' ) ] );
		}

		check_ajax_referer( 'ehtazem_admin_nonce', 'nonce' );

		$template_type = isset( $_POST['template_type'] ) ? sanitize_text_field( $_POST['template_type'] ) : '';
		$test_email = isset( $_POST['test_email'] ) ? sanitize_email( $_POST['test_email'] ) : get_option( 'admin_email' );

		// Get template
		if ( $template_type === 'admin_notification' ) {
			$subject = get_option( 'ehtazem_email_admin_subject' );
			$body = get_option( 'ehtazem_email_admin_body' );
		} elseif ( $template_type === 'user_auto_reply' ) {
			$subject = get_option( 'ehtazem_email_user_subject' );
			$body = get_option( 'ehtazem_email_user_body' );
		} elseif ( $template_type === 'hot_lead_alert' ) {
			$subject = get_option( 'ehtazem_email_hotlead_subject' );
			$body = get_option( 'ehtazem_email_hotlead_body' );
		} else {
			wp_send_json_error( [ 'message' => __( 'نوع القالب غير صحيح', 'ehtazem-elementor' ) ] );
		}

		// Replace variables with test data
		$variables = [
			'{name}' => 'أحمد محمد',
			'{email}' => 'test@example.com',
			'{phone}' => '+966 50 123 4567',
			'{company}' => 'شركة الاختبار للتطوير العقاري',
			'{region}' => 'الرياض',
			'{message}' => 'هذه رسالة تجريبية لاختبار قوالب البريد الإلكتروني.',
			'{date}' => date( 'Y-m-d H:i:s' ),
			'{score}' => '85',
			'{site_name}' => get_bloginfo( 'name' ),
			'{site_url}' => home_url(),
		];

		$subject = str_replace( array_keys( $variables ), array_values( $variables ), $subject );
		$body = str_replace( array_keys( $variables ), array_values( $variables ), $body );

		// Send email
		$headers = [ 'Content-Type: text/html; charset=UTF-8' ];
		$sent = wp_mail( $test_email, $subject, $body, $headers );

		if ( $sent ) {
			wp_send_json_success( [ 'message' => __( 'تم إرسال البريد التجريبي بنجاح', 'ehtazem-elementor' ) ] );
		} else {
			wp_send_json_error( [ 'message' => __( 'فشل في إرسال البريد', 'ehtazem-elementor' ) ] );
		}
	}
}
