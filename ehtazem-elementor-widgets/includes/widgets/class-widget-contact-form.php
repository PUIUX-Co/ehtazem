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
	 * Get custom help URL
	 */
	public function get_custom_help_url() {
		return 'https://puiux.com/docs/ehtazem-widgets/' . $this->get_name();
	}

	/**
	 * Get script dependencies
	 */
	public function get_script_depends() {
		return ['ehtazem-widgets'];
	}

	/**
	 * Get style dependencies
	 */
	public function get_style_depends() {
		return ['ehtazem-widgets'];
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
				'dynamic' => ['active' => true],
				'default' => esc_html__( 'تواصل معنا', 'ehtazem-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'العنوان', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'dynamic' => ['active' => true],
				'default' => esc_html__( 'انضم إلى احتزم وكن جزءًا من النجاحات المليارية', 'ehtazem-elementor' ),
				'rows' => 2,
			]
		);

		$this->add_responsive_control(
			'title_font_size',
			[
				'label' => esc_html__('حجم الخط', 'ehtazem-elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => ['min' => 10, 'max' => 120, 'step' => 1],
					'em' => ['min' => 0.5, 'max' => 10, 'step' => 0.1],
				],
				'default' => ['unit' => 'px', 'size' => 48],
				'tablet_default' => ['unit' => 'px', 'size' => 36],
				'mobile_default' => ['unit' => 'px', 'size' => 28],
				'selectors' => [
					'{{WRAPPER}} .contact-intro' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'description',
			[
				'label' => esc_html__( 'الوصف', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'dynamic' => ['active' => true],
				'default' => esc_html__( 'نضمن لك تجربة استثمارية موثوقة ومبتكرة. تواصل معنا الآن لبدء رحلتك نحو استثمارات مليارية ناجحة!', 'ehtazem-elementor' ),
				'rows' => 3,
			]
		);

		$this->add_control(
			'submit_button_text',
			[
				'label' => esc_html__( 'نص زر الإرسال', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => ['active' => true],
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
				'dynamic' => ['active' => true],
				'default' => [
					'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/center-img.png',
				],
			]
		);

		$this->add_control(
			'decoration_image_bottom',
			[
				'label' => esc_html__( 'صورة الديكور السفلى', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => ['active' => true],
				'default' => [
					'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/center-img.png',
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
				'dynamic' => ['active' => true],
				'default' => esc_html__( 'تم الإرسال ✓', 'ehtazem-elementor' ),
			]
		);

		$this->add_control(
			'error_message',
			[
				'label' => esc_html__( 'رسالة الخطأ', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => ['active' => true],
				'default' => esc_html__( 'حدث خطأ، يرجى المحاولة مرة أخرى', 'ehtazem-elementor' ),
			]
		);

		$this->add_control(
			'validation_message_required',
			[
				'label' => esc_html__( 'رسالة الحقل المطلوب', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => ['active' => true],
				'default' => esc_html__( 'من فضلك املأ جميع الحقول المطلوبة', 'ehtazem-elementor' ),
			]
		);

		$this->add_control(
			'validation_message_phone',
			[
				'label' => esc_html__( 'رسالة رقم الهاتف غير صحيح', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => ['active' => true],
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
		// Advanced Section for Custom CSS
		$this->start_controls_section(
			'custom_css_section',
			[
				'label' => esc_html__( 'Custom CSS', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$this->add_control(
			'custom_css',
			[
				'label' => esc_html__( 'Custom CSS', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::CODE,
				'language' => 'css',
				'rows' => 20,
				'description' => esc_html__( 'Add your custom CSS here. Use "selector" to target this widget.', 'ehtazem-elementor' ),
				'selectors' => [
					'{{WRAPPER}}' => '{{VALUE}}',
				],
			]
		);

		$this->add_control(
			'custom_css_description',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => '<div style="background: #f8f9fa; padding: 10px; border-radius: 5px; margin-top: 10px;">
					<strong>💡 Tip:</strong> Use <code>selector</code> to target this widget:<br>
					<code>selector { color: red; }</code><br>
					<code>selector .title { font-size: 24px; }</code>
				</div>',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="contactus-section" id="contactus-section"  data-aos-duration="1500">
			<div class="container">
				<div class="contactus-header" >
					<div class="badge contact-badge" data-aos="zoom-in"  data-aos-duration="1500"><?php echo esc_html($settings['badge_text']); ?></div>
					<h4 class="contact-intro" data-aos="zoom-in"  data-aos-duration="1900"><?php echo esc_html($settings['title']); ?></h4>
					<p class="contact-desc" data-aos="zoom-in"  data-aos-duration="2200"><?php echo esc_html($settings['description']); ?></p>
				</div>
				<div class="contacuUs-form-container">
					<div class="conactus-deco-up">
						<img src="<?php echo esc_url($settings['decoration_image_top']['url']); ?>" alt="" class="conactus-deco-up-img">
					</div>
					<div class="form-card">
						<form id="contactForm" class="ehtazem-contact-form">
							<input type="hidden" name="form_type" value="contact">
							<input type="hidden" name="nonce" value="<?php echo wp_create_nonce('ehtazem_form_submission'); ?>">

							<div class="form-group">
								<label class="form-label">الإسم بالكامل</label>
								<input type="text" class="form-control" id="full_name" name="full_name" placeholder="اسمك" required>
							</div>

							<div class="form-group">
								<label class="form-label">رقم الهاتف</label>
								<input type="tel" class="form-control" id="phone" name="phone" placeholder="0995" required>
							</div>

							<div class="form-group">
								<label class="form-label">سؤالك</label>
								<textarea class="form-control" id="question" name="question" placeholder="........" required></textarea>
							</div>

							<button type="submit" class="submit-btn"><?php echo esc_html($settings['submit_button_text']); ?></button>
						</form>
					</div>
					<div class="conactus-deco-bottom">
						<img src="<?php echo esc_url($settings['decoration_image_bottom']['url']); ?>" alt="" class="conactus-deco-bottom-img">
					</div>
				</div>

			</div>
		</section>

		<style>
		<?php if (!empty($settings['custom_css'])): ?>
			<?php echo $settings['custom_css']; ?>
		<?php endif; ?>
		</style>
		<?php
	}
}
