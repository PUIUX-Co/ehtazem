<?php
/**
 * Ehtazem Intermediaries Form Widget
 *
 * Elementor widget for Intermediaries form section with full submission system
 *
 * @package Ehtazem_Elementor_Widgets
 * @since 1.0.0
 * @author PUIUX
 * Development, Design & Programming by PUIUX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ehtazem_Intermediaries_Form_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'ehtazem-intermediaries-form';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'نموذج الوسطاء - Intermediaries Form', 'ehtazem-elementor' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	/**
	 * Get widget categories
	 */
	public function get_categories() {
		return [ 'ehtazem-widgets' ];
	}

	/**
	 * Get widget keywords
	 */
	public function get_keywords() {
		return [ 'form', 'intermediaries', 'وسطاء', 'نموذج', 'ehtazem', 'احتزم' ];
	}

	/**
	 * Register widget controls
	 */
	protected function register_controls() {

		// Content Section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'المحتوى - Content', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'badge_text',
			[
				'label' => esc_html__( 'نص الشارة', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'بوابة الوسطاء', 'ehtazem-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'العنوان', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'ضع عرضك الآن', 'ehtazem-elementor' ),
				'rows' => 2,
			]
		);

		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'الوصف', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'بعد الموافقة على عرضك من قِبل وحدة التمكين العقاري، نضمن لك الوصول إلى مشترٍ مناسب خلال فترة وجيزة.', 'ehtazem-elementor' ),
				'rows' => 3,
			]
		);

		$this->add_control(
			'investment_title',
			[
				'label' => esc_html__( 'عنوان الاستثمار', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'استثمر مع احتزم', 'ehtazem-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'percentage',
			[
				'label' => esc_html__( 'نسبة الاستثمار', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '50%+', 'ehtazem-elementor' ),
			]
		);

		$this->add_control(
			'submit_button_text',
			[
				'label' => esc_html__( 'نص زر الإرسال', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'إرسال', 'ehtazem-elementor' ),
			]
		);

		$this->end_controls_section();

		// Images Section
		$this->start_controls_section(
			'images_section',
			[
				'label' => esc_html__( 'الصور - Images', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'decoration_image',
			[
				'label' => esc_html__( 'صورة الديكور', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => plugins_url( 'assets/images/Group 594.png', dirname( dirname( __FILE__ ) ) . '/ehtazem-elementor.php' ),
				],
			]
		);

		$this->end_controls_section();

		// Form Messages Section
		$this->start_controls_section(
			'messages_section',
			[
				'label' => esc_html__( 'رسائل النموذج - Form Messages', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'success_message',
			[
				'label' => esc_html__( 'رسالة النجاح', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'تم الإرسال ✓', 'ehtazem-elementor' ),
			]
		);

		$this->add_control(
			'error_message',
			[
				'label' => esc_html__( 'رسالة الخطأ', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'حدث خطأ، يرجى المحاولة مرة أخرى', 'ehtazem-elementor' ),
			]
		);

		$this->add_control(
			'validation_message_required',
			[
				'label' => esc_html__( 'رسالة الحقل المطلوب', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'من فضلك املأ جميع الحقول المطلوبة', 'ehtazem-elementor' ),
			]
		);

		$this->add_control(
			'validation_message_phone',
			[
				'label' => esc_html__( 'رسالة رقم الهاتف غير صحيح', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'رقم الهاتف غير صحيح (يجب أن يكون 10 أرقام على الأقل)', 'ehtazem-elementor' ),
			]
		);

		$this->end_controls_section();

		// Style Section - Badge
		$this->start_controls_section(
			'badge_style_section',
			[
				'label' => esc_html__( 'تنسيق الشارة - Badge Style', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'badge_color',
			[
				'label' => esc_html__( 'لون النص', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .intermediate-badge' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'badge_background',
			[
				'label' => esc_html__( 'لون الخلفية', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .intermediate-badge' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'badge_typography',
				'selector' => '{{WRAPPER}} .intermediate-badge',
			]
		);

		$this->end_controls_section();

		// Style Section - Title
		$this->start_controls_section(
			'title_style_section',
			[
				'label' => esc_html__( 'تنسيق العنوان - Title Style', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'لون العنوان', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .intermediate-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .intermediate-title',
			]
		);

		$this->end_controls_section();

		// Style Section - Form
		$this->start_controls_section(
			'form_style_section',
			[
				'label' => esc_html__( 'تنسيق النموذج - Form Style', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'form_background',
			[
				'label' => esc_html__( 'لون خلفية النموذج', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-container' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'input_background',
			[
				'label' => esc_html__( 'لون خلفية الحقول', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-control' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'input_text_color',
			[
				'label' => esc_html__( 'لون نص الحقول', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-control' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => esc_html__( 'لون التسميات', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .form-label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Style Section - Button
		$this->start_controls_section(
			'button_style_section',
			[
				'label' => esc_html__( 'تنسيق الزر - Button Style', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_background',
			[
				'label' => esc_html__( 'لون الخلفية', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn-submit' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'لون النص', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn-submit' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .btn-submit',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$widget_id = $this->get_id();
		?>

		<section class="intermediaries-section" id="intermediaries-section">

			<?php if ( ! empty( $settings['decoration_image']['url'] ) ) : ?>
				<img src="<?php echo esc_url( $settings['decoration_image']['url'] ); ?>" alt="decoration" class="intermediares-deco-image">
			<?php endif; ?>

			<div class="container-fluid">
				<div class="row">
					<div class="col-md-5">
						<div class="intermediaries-intro">
							<div class="badge intermediate-badge" data-aos="fade-left" data-aos-duration="1500">
								<?php echo esc_html( $settings['badge_text'] ); ?>
							</div>
							<h4 class="intermediate-title" data-aos="fade-left" data-aos-duration="1900">
								<?php echo nl2br( esc_html( $settings['title'] ) ); ?>
							</h4>
							<p class="intermediate-p" data-aos="fade-left" data-aos-duration="2000">
								<?php echo nl2br( esc_html( $settings['description'] ) ); ?>
							</p>
							<div class="intermediares-percent">
								<div class="invest-ehtazem" data-aos="fade-left" data-aos-duration="2200">
									<h5 class="invest-ehtazem-h"><?php echo esc_html( $settings['investment_title'] ); ?></h5>
									<div class="percent"><?php echo esc_html( $settings['percentage'] ); ?></div>
								</div>
								<div class="ehtazem-percent-curve" data-aos="fade-left" data-aos-duration="2300">
									<svg width="184" height="95" viewBox="0 0 184 95" fill="none" xmlns="http://www.w3.org/2000/svg" class="percent-curve">
										<circle class="circle-start" cx="6" cy="6" r="5.333" fill="url(#paint0_linear_150_1142_<?php echo esc_attr( $widget_id ); ?>)"/>
										<path class="curve-path" d="M6 6C6 6 33.5 32 62.7965 61.3823C68.3821 66.9679 77.3423 67.2645 83.285 62.0605C89.2277 56.8565 102.829 44.9466 102.829 44.9466C109.039 39.5082 118.259 39.3174 124.689 44.4942L178.5 89.1006"
											stroke="url(#paint0_linear_150_1142_<?php echo esc_attr( $widget_id ); ?>)"
											stroke-width="1.3"
											fill="none"
											stroke-linecap="round"/>
										<circle class="circle-end" cx="178.5" cy="89.1006" r="5.333" fill="url(#paint0_linear_150_1142_<?php echo esc_attr( $widget_id ); ?>)"/>
										<defs>
											<linearGradient id="paint0_linear_150_1142_<?php echo esc_attr( $widget_id ); ?>" x1="850.636" y1="90.7523" x2="670.749" y2="-275.767" gradientUnits="userSpaceOnUse">
												<stop offset="0.589" stop-color="#857540"/>
												<stop offset="1" stop-color="#D7B261"/>
											</linearGradient>
										</defs>
									</svg>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-7">
						<div class="form-container">
							<form class="ehtazem-intermediaries-form" data-form-type="intermediaries" data-widget-id="<?php echo esc_attr( $widget_id ); ?>">
								<?php wp_nonce_field( 'ehtazem_form_submission', 'ehtazem_form_nonce' ); ?>

								<div class="row">
									<div class="col-md-6 mb-3">
										<label class="form-label">الاسم بالكامل <span class="required">*</span></label>
										<input type="text" name="full_name" class="form-control" placeholder="اسمك" required>
									</div>
									<div class="col-md-6 mb-3">
										<label class="form-label">رقم الهاتف <span class="required">*</span></label>
										<input type="tel" name="phone" class="form-control" placeholder="0995" required>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6 mb-3">
										<label class="form-label">اسم الشركة</label>
										<input type="text" name="company" class="form-control" placeholder="اسم">
									</div>
									<div class="col-md-6 mb-3">
										<label class="form-label">المنطقة</label>
										<input type="text" name="region" class="form-control" placeholder="المنطقة">
									</div>
								</div>

								<div class="row">
									<div class="col-12 mb-3">
										<label class="form-label">تفاصيل العرض العقاري</label>
										<textarea name="details" class="form-control" placeholder="........."></textarea>
									</div>
								</div>

								<div class="form-messages" style="display: none;">
									<div class="alert"></div>
								</div>

								<div class="submit-b">
									<button type="submit" class="btn-submit">
										<?php echo esc_html( $settings['submit_button_text'] ); ?>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		<script>
		jQuery(document).ready(function($) {
			const widgetId = '<?php echo esc_js( $widget_id ); ?>';
			const form = $('.ehtazem-intermediaries-form[data-widget-id="' + widgetId + '"]');
			const submitBtn = form.find('.btn-submit');
			const messagesContainer = form.find('.form-messages');
			const alertDiv = form.find('.alert');

			// Phone number formatting - only numbers
			form.find('input[name="phone"]').on('input', function() {
				this.value = this.value.replace(/[^0-9]/g, '');
			});

			// Form submission
			form.on('submit', function(e) {
				e.preventDefault();

				// Get form data
				const fullName = form.find('input[name="full_name"]').val().trim();
				const phone = form.find('input[name="phone"]').val().trim();
				const company = form.find('input[name="company"]').val().trim();
				const region = form.find('input[name="region"]').val().trim();
				const details = form.find('textarea[name="details"]').val().trim();
				const nonce = form.find('input[name="ehtazem_form_nonce"]').val();

				// Validation
				if (fullName === '' || phone === '') {
					showMessage('<?php echo esc_js( $settings['validation_message_required'] ); ?>', 'error');
					return;
				}

				if (phone.length < 10) {
					showMessage('<?php echo esc_js( $settings['validation_message_phone'] ); ?>', 'error');
					return;
				}

				// Show loading state
				submitBtn.prop('disabled', true);
				submitBtn.html('جاري الإرسال...');

				// Submit via AJAX
				$.ajax({
					url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
					type: 'POST',
					data: {
						action: 'ehtazem_submit_form',
						nonce: nonce,
						form_type: 'intermediaries',
						full_name: fullName,
						phone: phone,
						company: company,
						region: region,
						details: details
					},
					success: function(response) {
						if (response.success) {
							showMessage('<?php echo esc_js( $settings['success_message'] ); ?>', 'success');
							form[0].reset();

							// Reset button after 2 seconds
							setTimeout(function() {
								submitBtn.prop('disabled', false);
								submitBtn.html('<?php echo esc_js( $settings['submit_button_text'] ); ?>');
								messagesContainer.fadeOut();
							}, 2000);
						} else {
							showMessage(response.data.message || '<?php echo esc_js( $settings['error_message'] ); ?>', 'error');
							submitBtn.prop('disabled', false);
							submitBtn.html('<?php echo esc_js( $settings['submit_button_text'] ); ?>');
						}
					},
					error: function() {
						showMessage('<?php echo esc_js( $settings['error_message'] ); ?>', 'error');
						submitBtn.prop('disabled', false);
						submitBtn.html('<?php echo esc_js( $settings['submit_button_text'] ); ?>');
					}
				});
			});

			function showMessage(message, type) {
				alertDiv.removeClass('alert-success alert-danger');
				alertDiv.addClass('alert-' + (type === 'success' ? 'success' : 'danger'));
				alertDiv.html(message);
				messagesContainer.fadeIn();
			}
		});
		</script>

		<?php
	}
}
