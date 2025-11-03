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
	protected function render