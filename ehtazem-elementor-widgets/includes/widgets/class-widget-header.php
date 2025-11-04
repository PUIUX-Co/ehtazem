<?php
/**
 * Ehtazem Header Widget
 *
 * Elementor widget for Ehtazem header with logo, menu, and contact button
 *
 * @package Ehtazem_Elementor_Widgets
 * @since 1.0.0
 * @author PUIUX
 * Development, Design & Programming by PUIUX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ehtazem_Header_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'ehtazem-header';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'رأس الصفحة - Header', 'ehtazem-elementor' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-header';
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
		return [ 'header', 'menu', 'navigation', 'logo', 'ehtazem', 'احتزم', 'هيدر', 'قائمة' ];
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

		// Logo Section
		$this->start_controls_section(
			'logo_section',
			[
				'label' => esc_html__( 'الشعار - Logo', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'logo_image',
			[
				'label' => esc_html__( 'صورة الشعار', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'dynamic' => ['active' => true],
				'default' => [
					'url' => plugins_url( 'assets/images/EhtazemLogo.svg', dirname( dirname( __FILE__ ) ) . '/ehtazem-elementor.php' ),
				],
			]
		);

		$this->add_control(
			'logo_link',
			[
				'label' => esc_html__( 'رابط الشعار', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'dynamic' => ['active' => true],
				'placeholder' => esc_html__( 'https://your-link.com', 'ehtazem-elementor' ),
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);

		$this->end_controls_section();

		// Menu Section
		$this->start_controls_section(
			'menu_section',
			[
				'label' => esc_html__( 'القائمة - Menu', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'menu_button_text',
			[
				'label' => esc_html__( 'نص زر القائمة', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => ['active' => true],
				'default' => esc_html__( 'القائمة', 'ehtazem-elementor' ),
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'menu_item_text',
			[
				'label' => esc_html__( 'النص', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => ['active' => true],
				'default' => esc_html__( 'عنصر القائمة', 'ehtazem-elementor' ),
			]
		);

		$repeater->add_control(
			'menu_item_link',
			[
				'label' => esc_html__( 'الرابط', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'dynamic' => ['active' => true],
				'placeholder' => esc_html__( 'https://your-link.com', 'ehtazem-elementor' ),
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);

		$this->add_control(
			'menu_items',
			[
				'label' => esc_html__( 'عناصر القائمة', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'menu_item_text' => esc_html__( 'نبذة عنا', 'ehtazem-elementor' ),
						'menu_item_link' => ['url' => '#aboutUs-section', 'is_external' => false, 'nofollow' => false],
					],
					[
						'menu_item_text' => esc_html__( 'خدماتنا', 'ehtazem-elementor' ),
						'menu_item_link' => ['url' => '#ourServices-section', 'is_external' => false, 'nofollow' => false],
					],
					[
						'menu_item_text' => esc_html__( 'رحلتنا', 'ehtazem-elementor' ),
						'menu_item_link' => ['url' => '#org-structure-section', 'is_external' => false, 'nofollow' => false],
					],
					[
						'menu_item_text' => esc_html__( 'معايرنا', 'ehtazem-elementor' ),
						'menu_item_link' => ['url' => '#approach-section', 'is_external' => false, 'nofollow' => false],
					],
					[
						'menu_item_text' => esc_html__( 'المزايا', 'ehtazem-elementor' ),
						'menu_item_link' => ['url' => '#section-features', 'is_external' => false, 'nofollow' => false],
					],
					[
						'menu_item_text' => esc_html__( 'شركاؤنا', 'ehtazem-elementor' ),
						'menu_item_link' => ['url' => '#Ourpartners-section', 'is_external' => false, 'nofollow' => false],
					],
					[
						'menu_item_text' => esc_html__( 'الأسئلة الشائعة', 'ehtazem-elementor' ),
						'menu_item_link' => ['url' => '#questions-section', 'is_external' => false, 'nofollow' => false],
					],
					[
						'menu_item_text' => esc_html__( 'تواصل معنا', 'ehtazem-elementor' ),
						'menu_item_link' => ['url' => '#contactus-section', 'is_external' => false, 'nofollow' => false],
					],
				],
				'title_field' => '{{{ menu_item_text }}}',
			]
		);

		$this->end_controls_section();

		// Contact Button Section
		$this->start_controls_section(
			'contact_button_section',
			[
				'label' => esc_html__( 'زر التواصل - Contact Button', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'contact_button_text',
			[
				'label' => esc_html__( 'نص الزر', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'dynamic' => ['active' => true],
				'default' => esc_html__( 'تواصل معنا', 'ehtazem-elementor' ),
			]
		);

		$this->add_control(
			'contact_button_link',
			[
				'label' => esc_html__( 'رابط الزر', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'dynamic' => ['active' => true],
				'placeholder' => esc_html__( 'https://your-link.com', 'ehtazem-elementor' ),
				'default' => [
					'url' => '#contactus-section',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);

		$this->add_control(
			'show_arrow_icon',
			[
				'label' => esc_html__( 'إظهار أيقونة السهم', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'نعم', 'ehtazem-elementor' ),
				'label_off' => esc_html__( 'لا', 'ehtazem-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'arrow_icon',
			[
				'label' => esc_html__( 'أيقونة السهم', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-up',
					'library' => 'fa-solid',
				],
				'condition' => [
					'show_arrow_icon' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Style Section - Header
		$this->start_controls_section(
			'header_style_section',
			[
				'label' => esc_html__( 'تنسيق الرأس - Header Style', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'header_background_color',
			[
				'label' => esc_html__( 'لون الخلفية', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#FFFFFF',
				'selectors' => [
					'{{WRAPPER}} .header' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'header_padding',
			[
				'label' => esc_html__( 'الحشو الداخلي - Padding', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Section - Logo
		$this->start_controls_section(
			'logo_style_section',
			[
				'label' => esc_html__( 'تنسيق الشعار - Logo Style', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'logo_width',
			[
				'label' => esc_html__( 'عرض الشعار', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .logo-img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Section - Menu Button
		$this->start_controls_section(
			'menu_button_style_section',
			[
				'label' => esc_html__( 'تنسيق زر القائمة - Menu Button Style', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'menu_button_background_color',
			[
				'label' => esc_html__( 'لون الخلفية', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-btn' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'menu_button_text_color',
			[
				'label' => esc_html__( 'لون النص', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .menu-btn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'menu_button_typography',
				'selector' => '{{WRAPPER}} .menu-btn',
			]
		);

		$this->end_controls_section();

		// Style Section - Contact Button
		$this->start_controls_section(
			'contact_button_style_section',
			[
				'label' => esc_html__( 'تنسيق زر التواصل - Contact Button Style', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'contact_button_background_color',
			[
				'label' => esc_html__( 'لون الخلفية', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contactUs-btn-header' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'contact_button_text_color',
			[
				'label' => esc_html__( 'لون النص', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contactUs-btn-header' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'contact_button_typography',
				'selector' => '{{WRAPPER}} .contactUs-btn-header',
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
		$logo_url = $settings['logo_image']['url'];

		// Handle logo link
		if ( ! empty( $settings['logo_link']['url'] ) ) {
			$this->add_link_attributes( 'logo_link', $settings['logo_link'] );
		}
		$logo_link = $settings['logo_link']['url'];

		// Add inline editing attributes
		$this->add_inline_editing_attributes( 'menu_button_text', 'none' );
		$this->add_inline_editing_attributes( 'contact_button_text', 'none' );
		?>

		<header class="header ehtazem-widget-scope" id="header">
			<div class="container">
				<div class="header-content">
					<div class="logo">
						<a href="<?php echo esc_url( $logo_link ); ?>" class="logo-link">
							<img src="<?php echo esc_url( $logo_url ); ?>" alt="Ehtazem" class="logo-img">
						</a>
					</div>
					<div class="menu">
						<div class="dropdown">
							<button class="btn menu-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" <?php echo $this->get_render_attribute_string( 'menu_button_text' ); ?>>
								<?php echo esc_html( $settings['menu_button_text'] ); ?>
							</button>
							<ul class="dropdown-menu">
								<!-- Menu Header with Logo and Close Button -->
								<li>
									<a href="<?php echo esc_url( $logo_link ); ?>" class="logo-link">
										<img src="<?php echo esc_url( $logo_url ); ?>" alt="Ehtazem" class="logo-img">
									</a>
									<button class="close-btn" type="button" data-bs-toggle="dropdown" aria-expanded="true">
										<i class="fas fa-times"></i>
									</button>
								</li>

								<!-- Menu Items -->
								<li class="menu-items-wrapper">
									<?php foreach ( $settings['menu_items'] as $index => $item ) :
										$menu_item_key = 'menu_items.' . $index . '.menu_item_text';
										$menu_link_key = 'menu_items.' . $index . '.menu_item_link';
										$this->add_inline_editing_attributes( $menu_item_key, 'none' );
										if ( ! empty( $item['menu_item_link']['url'] ) ) {
											$this->add_link_attributes( $menu_link_key, $item['menu_item_link'] );
										}
									?>
										<a class="dropdown-item" <?php echo $this->get_render_attribute_string( $menu_link_key ); ?> <?php echo $this->get_render_attribute_string( $menu_item_key ); ?>>
											<?php echo esc_html( $item['menu_item_text'] ); ?>
										</a>
									<?php endforeach; ?>
								</li>

								<!-- Menu Footer with Contact Button -->
								<li>
									<?php
									if ( ! empty( $settings['contact_button_link']['url'] ) ) {
										$this->add_link_attributes( 'menu_contact_button_link', $settings['contact_button_link'] );
									}
									?>
									<a <?php echo $this->get_render_attribute_string( 'menu_contact_button_link' ); ?> class="contactUs-btn-header" data-bs-toggle="dropdown">
										<span <?php echo $this->get_render_attribute_string( 'contact_button_text' ); ?>>
											<?php echo esc_html( $settings['contact_button_text'] ); ?>
										</span>
										<?php if ( 'yes' === $settings['show_arrow_icon'] ) : ?>
											<?php \Elementor\Icons_Manager::render_icon( $settings['arrow_icon'], [ 'aria-hidden' => 'true', 'class' => 'arrow-contus-head' ] ); ?>
										<?php endif; ?>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="contactUs-header">
						<?php
						if ( ! empty( $settings['contact_button_link']['url'] ) ) {
							$this->add_link_attributes( 'main_contact_button_link', $settings['contact_button_link'] );
						}
						?>
						<a <?php echo $this->get_render_attribute_string( 'main_contact_button_link' ); ?> class="contactUs-btn-header">
							<span <?php echo $this->get_render_attribute_string( 'contact_button_text' ); ?>>
								<?php echo esc_html( $settings['contact_button_text'] ); ?>
							</span>
							<?php if ( 'yes' === $settings['show_arrow_icon'] ) : ?>
								<?php \Elementor\Icons_Manager::render_icon( $settings['arrow_icon'], [ 'aria-hidden' => 'true', 'class' => 'arrow-contus-head' ] ); ?>
							<?php endif; ?>
						</a>
					</div>
				</div>
			</div>
		</header>

		<?php
	}
}
