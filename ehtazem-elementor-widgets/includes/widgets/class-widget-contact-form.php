<?php
/**
 * Ehtazem Contact Form Widget
 *
 * Elementor widget for Contact form section with full submission system
 *
 * @package Ehtazem_Elementor_Widgets
 * @since 1.0.0
 * @author PUIUX
 * Development, Design & Programming by PUIUX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ehtazem_Contact_Form_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'ehtazem-contact-form';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'نموذج التواصل - Contact Form', 'ehtazem-elementor' );
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
		return [ 'form', 'contact', 'تواصل', 'نموذج', 'ehtazem', 'احتزم' ];
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
				'default' => esc_html__( 'تواصل معنا', 'ehtazem-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'العنوان', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'انضم إلى احتزم وكن جزءًا من النجاحات المليارية', 'ehtazem-elementor' ),
				'rows' => 2,
			]
		);

		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'الوصف', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'نضمن لك تجربة استثمارية موثوقة ومبتكرة. تواصل معنا الآن لبدء رحلتك نحو استثمارات مليارية ناجحة!', 'ehtazem-elementor' ),
				'rows' => 3,
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
			'decoration_image_top',
			[
				'label' => esc_html__( 'صورة الديكور العليا', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => plugins_url( 'assets/images/center-img.png', dirname( dirname( __FILE__ ) ) . '/ehtazem-elementor.php' ),
				],
			]
		);

		$this->add_control(
			'decoration_image_bottom',
			[
				'label' => esc_html__( 'صورة الديكور السفلى', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => plugins_url( 'assets/images/center-img.png', dirname( dirname( __FILE__ ) ) . '/ehtazem-elementor.php' ),
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
					'{{WRAPPER}} .contact-badge' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'badge_background',
			[
				'label' => esc_html__( 'لون الخلفية', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-badge' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'badge_typography',
				'selector' => '{{WRAPPER}} .contact-badge',
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
					'{{WRAPPER}} .contact-intro' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .contact-intro',
			]
		);

		$this->end_controls_section();

		// Style Section - Description
		$this->start_controls_section(
			'description_style_section',
			[
				'label' => esc_html__( 'تنسيق الوصف - Description Style', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'لون الوصف', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .contact-desc',
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
					'{{WRAPPER}} .form-card' => 'background-color: {{VALUE}}',
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
					'{{WRAPPER}} .submit-btn' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'لون النص', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .submit-btn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .submit-btn',
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

		// Add inline editing attributes
		$this->add_inline_editing_attributes( 'badge_text', 'none' );
		$this->add_inline_editing_attributes( 'title', 'basic' );
		$this->add_inline_editing_attributes( 'description', 'advanced' );
		$this->add_inline_editing_attributes( 'submit_button_text', 'none' );
		?>

		<section class="contactus-section" id="contactus-section" data-aos-duration="1500">
			<div class="container">
				<div class="contactus-header">
					<div class="badge contact-badge" data-aos="zoom-in" data-aos-duration="1500" <?php echo $this->get_render_attribute_string( 'badge_text' ); ?>>
						<?php echo esc_html( $settings['badge_text'] ); ?>
					</div>
					<h4 class="contact-intro" data-aos="zoom-in" data-aos-duration="1900" <?php echo $this->get_render_attribute_string( 'title' ); ?>>
						<?php echo esc_html( $settings['title'] ); ?>
					</h4>
					<p class="contact-desc" data-aos="zoom-in" data-aos-duration="2200" <?php echo $this->get_render_attribute_string( 'description' ); ?>>
						<?php echo esc_html( $settings['description'] ); ?>
					</p>
				</div>
				<div class="contacuUs-form-container">
					<?php if ( ! empty( $settings['decoration_image_top']['url'] ) ) : ?>
						<div class="conactus-deco-up">
							<img src="<?php echo esc_url( $settings['decoration_image_top']['url'] ); ?>" alt="" class="conactus-deco-up-img">
						</div>
					<?php endif; ?>

					<div class="form-card">
						<form class="ehtazem-contact-form" id="contactForm" data-form-type="contact" data-widget-id="<?php echo esc_attr( $widget_id ); ?>">
							<?php wp_nonce_field( 'ehtazem_form_submission', 'ehtazem_form_nonce' ); ?>

							<div class="form-group">
								<label class="form-label">الإسم بالكامل <span class="required">*</span></label>
								<input type="text" name="full_name" class="form-control" id="fullName" placeholder="اسمك" required>
							</div>

							<div class="form-group">
								<label class="form-label">رقم الهاتف <span class="required">*</span></label>
								<input type="tel" name="phone" class="form-control" id="phone" placeholder="0995" required>
							</div>

							<div class="form-group">
								<label class="form-label">سؤالك <span class="required">*</span></label>
								<textarea name="question" class="form-control" id="question" placeholder="........" required></textarea>
							</div>

							<div class="form-messages" style="display: none;">
								<div class="alert"></div>
							</div>

							<button type="submit" class="submit-btn" <?php echo $this->get_render_attribute_string( 'submit_button_text' ); ?>>
								<?php echo esc_html( $settings['submit_button_text'] ); ?>
							</button>
						</form>
					</div>

					<?php if ( ! empty( $settings['decoration_image_bottom']['url'] ) ) : ?>
						<div class="conactus-deco-bottom">
							<img src="<?php echo esc_url( $settings['decoration_image_bottom']['url'] ); ?>" alt="" class="conactus-deco-bottom-img">
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<script>
		jQuery(document).ready(function($) {
			const widgetId = '<?php echo esc_js( $widget_id ); ?>';
			const form = $('.ehtazem-contact-form[data-widget-id="' + widgetId + '"]');
			const submitBtn = form.find('.submit-btn');
			const messagesContainer = form.find('.form-messages');
			const alertDiv = form.find('.alert');

			// Phone number formatting - only numbers
			form.find('input[name="phone"]').on('input', function() {
				this.value = this.value.replace(/[^0-9]/g, '');
			});

			// Add focus/blur animations
			form.find('.form-control').on('focus', function() {
				$(this).closest('.form-group').css('transform', 'translateX(-3px)');
			}).on('blur', function() {
				$(this).closest('.form-group').css('transform', 'translateX(0)');
			});

			// Form submission
			form.on('submit', function(e) {
				e.preventDefault();

				// Get form data
				const fullName = form.find('input[name="full_name"]').val().trim();
				const phone = form.find('input[name="phone"]').val().trim();
				const question = form.find('textarea[name="question"]').val().trim();
				const nonce = form.find('input[name="ehtazem_form_nonce"]').val();

				// Validation
				if (fullName === '' || phone === '' || question === '') {
					showMessage('<?php echo esc_js( $settings['validation_message_required'] ); ?>', 'error');
					return;
				}

				if (phone.length < 10) {
					showMessage('<?php echo esc_js( $settings['validation_message_phone'] ); ?>', 'error');
					return;
				}

				// Show loading state
				submitBtn.prop('disabled', true);
				submitBtn.css('transform', 'scale(0.95)');
				submitBtn.html('جاري الإرسال...');

				// Submit via AJAX
				$.ajax({
					url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
					type: 'POST',
					data: {
						action: 'ehtazem_submit_form',
						nonce: nonce,
						form_type: 'contact',
						full_name: fullName,
						phone: phone,
						question: question
					},
					success: function(response) {
						if (response.success) {
							submitBtn.css('transform', 'scale(1)');
							submitBtn.html('<?php echo esc_js( $settings['success_message'] ); ?>');
							submitBtn.css('background', '#00402E');
							showMessage('<?php echo esc_js( $settings['success_message'] ); ?>', 'success');
							form[0].reset();

							// Reset button after 2 seconds
							setTimeout(function() {
								submitBtn.prop('disabled', false);
								submitBtn.html('<?php echo esc_js( $settings['submit_button_text'] ); ?>');
								submitBtn.css('background', '');
								messagesContainer.fadeOut();
							}, 2000);
						} else {
							showMessage(response.data.message || '<?php echo esc_js( $settings['error_message'] ); ?>', 'error');
							submitBtn.prop('disabled', false);
							submitBtn.css('transform', 'scale(1)');
							submitBtn.html('<?php echo esc_js( $settings['submit_button_text'] ); ?>');
						}
					},
					error: function() {
						showMessage('<?php echo esc_js( $settings['error_message'] ); ?>', 'error');
						submitBtn.prop('disabled', false);
						submitBtn.css('transform', 'scale(1)');
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
