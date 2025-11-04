<?php
/**
 * Footer Widget
 *
 * @package Ehtazem_Elementor_Widgets
 * @since 1.0.0
 *
 * Development, Design & Programming by PUIUX
 * Copyright (c) 2025 PUIUX. All rights reserved.
 */

if (!defined('ABSPATH')) {
    exit;
}

class Ehtazem_Footer_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ehtazem_footer';
    }

    public function get_title() {
        return esc_html__('Footer', 'ehtazem-elementor-widgets');
    }

    public function get_icon() {
        return 'eicon-footer';
    }

    public function get_categories() {
        return ['ehtazem-widgets'];
    }

    public function get_keywords() {
        return ['footer', 'ehtazem', 'contact'];
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

    protected function register_controls() {

        // Social Icons Section
        $this->start_controls_section(
            'social_icons_section',
            [
                'label' => esc_html__('Social Icons', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'instagram_url',
            [
                'label' => esc_html__('Instagram URL', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'meta_url',
            [
                'label' => esc_html__('Meta URL', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'linkedin_url',
            [
                'label' => esc_html__('LinkedIn URL', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'google_url',
            [
                'label' => esc_html__('Google URL', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'twitter_url',
            [
                'label' => esc_html__('Twitter URL', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();

        // Contact Information Section
        $this->start_controls_section(
            'contact_info_section',
            [
                'label' => esc_html__('Contact Information', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'phone_number',
            [
                'label' => esc_html__('Phone Number', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => '+966 544420258',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'email',
            [
                'label' => esc_html__('Email', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'welcome@ehtazem.com',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Footer Content Section
        $this->start_controls_section(
            'footer_content_section',
            [
                'label' => esc_html__('Footer Content', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label' => esc_html__('Badge Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'إحتزم...لتتم',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'footer_title',
            [
                'label' => esc_html__('Footer Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'وحدة التمكين العقاري',
                'label_block' => true,
            ]
        );

        $this->add_responsive_control(
            'footer_title_font_size',
            [
                'label' => esc_html__('حجم الخط', 'ehtazem-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => ['min' => 10, 'max' => 120, 'step' => 1],
                    'em' => ['min' => 0.5, 'max' => 10, 'step' => 0.1],
                ],
                'default' => ['unit' => 'px', 'size' => 36],
                'tablet_default' => ['unit' => 'px', 'size' => 28],
                'mobile_default' => ['unit' => 'px', 'size' => 24],
                'selectors' => [
                    '{{WRAPPER}} .footer-title' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'footer_description',
            [
                'label' => esc_html__('Footer Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'نعيد صياغة السوق العقاري السعودي من خلال حلول مبتكرة في الوساطة وإدارة الصناديق العقارية، مدعومين باستثمارات مليارية، تراخيص من هيئة سوق المال، وشراكات عالمية.',
                'rows' => 5,
            ]
        );

        $this->add_control(
            'contact_button_text',
            [
                'label' => esc_html__('Contact Button Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'تواصل معنا',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'contact_button_link',
            [
                'label' => esc_html__('Contact Button Link', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => '#contactus-section',
                ],
            ]
        );

		$this->add_control(
			'button_arrow_icon',
			[
				'label' => esc_html__('Button Arrow Icon', 'ehtazem-elementor-widgets'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-left',
					'library' => 'fa-solid',
				],
			]
		);

        $this->end_controls_section();

        // Footer Bottom Section
        $this->start_controls_section(
            'footer_bottom_section',
            [
                'label' => esc_html__('Footer Bottom', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'brand_logo',
            [
                'label' => esc_html__('Brand Logo', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/ehtazemfooterlogo.svg',
                ],
            ]
        );

        $this->add_control(
            'copyright_text',
            [
                'label' => esc_html__('Copyright Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => '©2025 جميع الحقوق محفوظة لشركة احتزم',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'made_by_text',
            [
                'label' => esc_html__('Made By Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'صنع من قبل',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'made_by_logo',
            [
                'label' => esc_html__('Made By Logo', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/PUIUX.svg',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'footer_bg_color',
            [
                'label' => esc_html__('Background Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .site-footer' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_color',
            [
                'label' => esc_html__('Badge Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .footer-title' => 'color: {{VALUE}};',
                ],
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

	protected function render() {
        $settings = $this->get_settings_for_display();

        // Add inline editing attributes
        $this->add_inline_editing_attributes( 'badge_text', 'none' );
        $this->add_inline_editing_attributes( 'footer_title', 'basic' );
        $this->add_inline_editing_attributes( 'footer_description', 'advanced' );
        $this->add_inline_editing_attributes( 'contact_button_text', 'none' );
        $this->add_inline_editing_attributes( 'phone_number', 'none' );
        $this->add_inline_editing_attributes( 'email', 'none' );
        $this->add_inline_editing_attributes( 'copyright_text', 'none' );
        $this->add_inline_editing_attributes( 'made_by_text', 'none' );
		// Setup link attributes
		if ( ! empty( $settings['instagram_url']['url'] ) ) {
			$this->add_link_attributes( 'instagram_url_attr', $settings['instagram_url'] );
		}
		if ( ! empty( $settings['meta_url']['url'] ) ) {
			$this->add_link_attributes( 'meta_url_attr', $settings['meta_url'] );
		}
		if ( ! empty( $settings['linkedin_url']['url'] ) ) {
			$this->add_link_attributes( 'linkedin_url_attr', $settings['linkedin_url'] );
		}
		if ( ! empty( $settings['google_url']['url'] ) ) {
			$this->add_link_attributes( 'google_url_attr', $settings['google_url'] );
		}
		if ( ! empty( $settings['twitter_url']['url'] ) ) {
			$this->add_link_attributes( 'twitter_url_attr', $settings['twitter_url'] );
		}
		if ( ! empty( $settings['contact_button_link']['url'] ) ) {
			$this->add_link_attributes( 'contact_button_link_attr', $settings['contact_button_link'] );
		}

		?>
        <footer class="site-footer ehtazem-widget-scope" id="footer">
            <div class="container">
                <div class="arc-bg"></div>

                <!-- Social icons -->
                <div class="social-icons d-flex justify-content-center align-items-end">
                    <a class="social-icon" <?php echo $this->get_render_attribute_string( 'instagram_url_attr' ); ?> aria-label="Instagram">
                        <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="instgram-icon">
                            <path
                                d="M16 0.5C20.2113 0.5 20.7368 0.5155 22.3891 0.593C24.0398 0.6705 25.1636 0.92935 26.1525 1.31375C27.1755 1.70745 28.0373 2.24065 28.8991 3.1009C29.6873 3.87574 30.2971 4.81301 30.6862 5.8475C31.0691 6.83485 31.3295 7.96015 31.407 9.6109C31.4799 11.2632 31.5 11.7886 31.5 16C31.5 20.2113 31.4845 20.7368 31.407 22.3891C31.3295 24.0398 31.0691 25.1636 30.6862 26.1525C30.2982 27.1876 29.6882 28.1251 28.8991 28.8991C28.124 29.687 27.1868 30.2968 26.1525 30.6862C25.1651 31.0691 24.0398 31.3295 22.3891 31.407C20.7368 31.4799 20.2113 31.5 16 31.5C11.7886 31.5 11.2632 31.4845 9.6109 31.407C7.96015 31.3295 6.8364 31.0691 5.8475 30.6862C4.8126 30.2979 3.87517 29.688 3.1009 28.8991C2.31258 28.1244 1.70269 27.1871 1.31375 26.1525C0.92935 25.1651 0.6705 24.0398 0.593 22.3891C0.52015 20.7368 0.5 20.2113 0.5 16C0.5 11.7886 0.5155 11.2632 0.593 9.6109C0.6705 7.9586 0.92935 6.8364 1.31375 5.8475C1.70162 4.81238 2.31165 3.87485 3.1009 3.1009C3.87539 2.31231 4.81276 1.70238 5.8475 1.31375C6.8364 0.92935 7.9586 0.6705 9.6109 0.593C11.2632 0.52015 11.7886 0.5 16 0.5ZM16 8.25C13.9446 8.25 11.9733 9.06651 10.5199 10.5199C9.06651 11.9733 8.25 13.9446 8.25 16C8.25 18.0554 9.06651 20.0267 10.5199 21.4801C11.9733 22.9335 13.9446 23.75 16 23.75C18.0554 23.75 20.0267 22.9335 21.4801 21.4801C22.9335 20.0267 23.75 18.0554 23.75 16C23.75 13.9446 22.9335 11.9733 21.4801 10.5199C20.0267 9.06651 18.0554 8.25 16 8.25ZM26.075 7.8625C26.075 7.34864 25.8709 6.85583 25.5075 6.49248C25.1442 6.12913 24.6514 5.925 24.1375 5.925C23.6236 5.925 23.1308 6.12913 22.7675 6.49248C22.4041 6.85583 22.2 7.34864 22.2 7.8625C22.2 8.37636 22.4041 8.86917 22.7675 9.23252C23.1308 9.59587 23.6236 9.8 24.1375 9.8C24.6514 9.8 25.1442 9.59587 25.5075 9.23252C25.8709 8.86917 26.075 8.37636 26.075 7.8625ZM16 11.35C17.2333 11.35 18.416 11.8399 19.288 12.712C20.1601 13.584 20.65 14.7667 20.65 16C20.65 17.2333 20.1601 18.416 19.288 19.288C18.416 20.1601 17.2333 20.65 16 20.65C14.7667 20.65 13.584 20.1601 12.712 19.288C11.8399 18.416 11.35 17.2333 11.35 16C11.35 14.7667 11.8399 13.584 12.712 12.712C13.584 11.8399 14.7667 11.35 16 11.35Z"
                                fill="url(#paint0_linear_150_1317)" />
                            <defs>
                                <linearGradient id="paint0_linear_150_1317" x1="0.496152" y1="0.50323" x2="31.53"
                                    y2="0.50323" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#D8B263" />
                                    <stop offset="1" stop-color="#D7B261" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </a>
                    <a class="social-icon" <?php echo $this->get_render_attribute_string( 'meta_url_attr' ); ?> aria-label="Meta">
                        <i class="fab fa-meta"></i>
                    </a>
                    <a class="social-icon center" <?php echo $this->get_render_attribute_string( 'linkedin_url_attr' ); ?> aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="social-icon google-icon" <?php echo $this->get_render_attribute_string( 'google_url_attr' ); ?> aria-label="Google">
                        <i class="fab fa-google"></i>
                    </a>
                    <a class="social-icon twitter-icon" <?php echo $this->get_render_attribute_string( 'twitter_url_attr' ); ?> aria-label="Twitter">
                        <i class="fab fa-x-twitter"></i>
                    </a>
                </div>

                <!-- Footer Content -->
                <div class="footer-content">
                    <div class="row g-4 align-items-center">
                        <!-- Contact Chips -->
                        <div class="col-12 col-lg-4 order-lg-1">
                            <div class="contact-chips-container">
                                <a href="tel:<?php echo esc_attr(str_replace(' ', '', $settings['phone_number'])); ?>" class="contact-chip contact-chip-right">
                                    <span class="chip-text" <?php echo $this->get_render_attribute_string( 'phone_number' ); ?>><?php echo esc_html($settings['phone_number']); ?></span>
                                </a>
                            </div>
                        </div>

                        <!-- Main Footer Content -->
                        <div class="col-12 col-lg-4 order-lg-2">
                            <div class="footer-head">
                                <div class="badge footer-badge" <?php echo $this->get_render_attribute_string( 'badge_text' ); ?>><?php echo esc_html($settings['badge_text']); ?></div>
                                <h2 class="footer-title" <?php echo $this->get_render_attribute_string( 'footer_title' ); ?>><?php echo esc_html($settings['footer_title']); ?></h2>
                                <p class="footer-intro" <?php echo $this->get_render_attribute_string( 'footer_description' ); ?>><?php echo esc_html($settings['footer_description']); ?></p>
                                <div class="footer-contact-button">
                                    <a class="footer-contact-btn" <?php echo $this->get_render_attribute_string( 'contact_button_link_attr' ); ?>>
                                        <span <?php echo $this->get_render_attribute_string( 'contact_button_text' ); ?>>
                                            <?php echo esc_html($settings['contact_button_text']); ?>
                                        </span>
                                        <?php \Elementor\Icons_Manager::render_icon( $settings['button_arrow_icon'], [ 'aria-hidden' => 'true', 'class' => 'arrow-join-head arrow-hero-down' ] ); ?>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Email Contact -->
                        <div class="col-12 col-lg-4 order-lg-3">
                            <div class="contact-chips-container">
                                <a href="mailto:<?php echo esc_attr($settings['email']); ?>" class="contact-chip contact-chip-left">
                                    <span class="chip-text" <?php echo $this->get_render_attribute_string( 'email' ); ?>><?php echo esc_html($settings['email']); ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Bottom -->
                <div class="row">
                    <div class="footer-bottom">
                        <div class="col-12 col-md-6">
                            <div class="brand-mini">
                                <img src="<?php echo esc_url($settings['brand_logo']['url']); ?>" alt="Ehtazem" class="brand-mini-logo">
                                <p class="copyright" <?php echo $this->get_render_attribute_string( 'copyright_text' ); ?>><?php echo esc_html($settings['copyright_text']); ?></p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="made-by">
                                <span class="madeby-p" <?php echo $this->get_render_attribute_string( 'made_by_text' ); ?>><?php echo esc_html($settings['made_by_text']); ?></span>
                                <img src="<?php echo esc_url($settings['made_by_logo']['url']); ?>" alt="PUIUX" class="made-by-logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <?php
    }

    protected function content_template() {
        ?>
        <footer class="site-footer">
            <div class="container">
                <div class="arc-bg"></div>

                <div class="social-icons d-flex justify-content-center align-items-end">
                    <a class="social-icon" href="{{ settings.instagram_url.url }}" aria-label="Instagram">
                        <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="instgram-icon">
                            <path
                                d="M16 0.5C20.2113 0.5 20.7368 0.5155 22.3891 0.593C24.0398 0.6705 25.1636 0.92935 26.1525 1.31375C27.1755 1.70745 28.0373 2.24065 28.8991 3.1009C29.6873 3.87574 30.2971 4.81301 30.6862 5.8475C31.0691 6.83485 31.3295 7.96015 31.407 9.6109C31.4799 11.2632 31.5 11.7886 31.5 16C31.5 20.2113 31.4845 20.7368 31.407 22.3891C31.3295 24.0398 31.0691 25.1636 30.6862 26.1525C30.2982 27.1876 29.6882 28.1251 28.8991 28.8991C28.124 29.687 27.1868 30.2968 26.1525 30.6862C25.1651 31.0691 24.0398 31.3295 22.3891 31.407C20.7368 31.4799 20.2113 31.5 16 31.5C11.7886 31.5 11.2632 31.4845 9.6109 31.407C7.96015 31.3295 6.8364 31.0691 5.8475 30.6862C4.8126 30.2979 3.87517 29.688 3.1009 28.8991C2.31258 28.1244 1.70269 27.1871 1.31375 26.1525C0.92935 25.1651 0.6705 24.0398 0.593 22.3891C0.52015 20.7368 0.5 20.2113 0.5 16C0.5 11.7886 0.5155 11.2632 0.593 9.6109C0.6705 7.9586 0.92935 6.8364 1.31375 5.8475C1.70162 4.81238 2.31165 3.87485 3.1009 3.1009C3.87539 2.31231 4.81276 1.70238 5.8475 1.31375C6.8364 0.92935 7.9586 0.6705 9.6109 0.593C11.2632 0.52015 11.7886 0.5 16 0.5ZM16 8.25C13.9446 8.25 11.9733 9.06651 10.5199 10.5199C9.06651 11.9733 8.25 13.9446 8.25 16C8.25 18.0554 9.06651 20.0267 10.5199 21.4801C11.9733 22.9335 13.9446 23.75 16 23.75C18.0554 23.75 20.0267 22.9335 21.4801 21.4801C22.9335 20.0267 23.75 18.0554 23.75 16C23.75 13.9446 22.9335 11.9733 21.4801 10.5199C20.0267 9.06651 18.0554 8.25 16 8.25ZM26.075 7.8625C26.075 7.34864 25.8709 6.85583 25.5075 6.49248C25.1442 6.12913 24.6514 5.925 24.1375 5.925C23.6236 5.925 23.1308 6.12913 22.7675 6.49248C22.4041 6.85583 22.2 7.34864 22.2 7.8625C22.2 8.37636 22.4041 8.86917 22.7675 9.23252C23.1308 9.59587 23.6236 9.8 24.1375 9.8C24.6514 9.8 25.1442 9.59587 25.5075 9.23252C25.8709 8.86917 26.075 8.37636 26.075 7.8625ZM16 11.35C17.2333 11.35 18.416 11.8399 19.288 12.712C20.1601 13.584 20.65 14.7667 20.65 16C20.65 17.2333 20.1601 18.416 19.288 19.288C18.416 20.1601 17.2333 20.65 16 20.65C14.7667 20.65 13.584 20.1601 12.712 19.288C11.8399 18.416 11.35 17.2333 11.35 16C11.35 14.7667 11.8399 13.584 12.712 12.712C13.584 11.8399 14.7667 11.35 16 11.35Z"
                                fill="url(#paint0_linear_150_1317)" />
                            <defs>
                                <linearGradient id="paint0_linear_150_1317" x1="0.496152" y1="0.50323" x2="31.53"
                                    y2="0.50323" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#D8B263" />
                                    <stop offset="1" stop-color="#D7B261" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </a>
                    <a class="social-icon" href="{{ settings.meta_url.url }}" aria-label="Meta"><i class="fab fa-meta"></i></a>
                    <a class="social-icon center" href="{{ settings.linkedin_url.url }}" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a class="social-icon google-icon" href="{{ settings.google_url.url }}" aria-label="Google"><i class="fab fa-google"></i></a>
                    <a class="social-icon twitter-icon" href="{{ settings.twitter_url.url }}" aria-label="Twitter"><i class="fab fa-x-twitter"></i></a>
                </div>

                <div class="footer-content">
                    <div class="row g-4 align-items-center">
                        <div class="col-12 col-lg-4 order-lg-1">
                            <div class="contact-chips-container">
                                <a href="tel:{{{ settings.phone_number }}}" class="contact-chip contact-chip-right">
                                    <span class="chip-text">{{{ settings.phone_number }}}</span>
                                </a>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 order-lg-2">
                            <div class="footer-head">
                                <div class="badge footer-badge">{{{ settings.badge_text }}}</div>
                                <h2 class="footer-title">{{{ settings.footer_title }}}</h2>
                                <p class="footer-intro">{{{ settings.footer_description }}}</p>
                                <div class="footer-contact-button">
                                    <a class="footer-contact-btn" href="{{ settings.contact_button_link.url }}">
                                        {{{ settings.contact_button_text }}}
                                        <i class="fas fa-arrow-left arrow-join-head arrow-hero-down" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 order-lg-3">
                            <div class="contact-chips-container">
                                <a href="mailto:{{{ settings.email }}}" class="contact-chip contact-chip-left">
                                    <span class="chip-text">{{{ settings.email }}}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="footer-bottom">
                        <div class="col-12 col-md-6">
                            <div class="brand-mini">
                                <img src="{{ settings.brand_logo.url }}" alt="Ehtazem" class="brand-mini-logo">
                                <p class="copyright">{{{ settings.copyright_text }}}</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="made-by">
                                <span class="madeby-p">{{{ settings.made_by_text }}}</span>
                                <img src="{{ settings.made_by_logo.url }}" alt="PUIUX" class="made-by-logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <?php
    }
}
