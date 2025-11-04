<?php
/**
 * Services Widget
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

class Ehtazem_Services_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ehtazem_services';
    }

    public function get_title() {
        return esc_html__('Services', 'ehtazem-elementor-widgets');
    }

    public function get_icon() {
        return 'eicon-featured-image';
    }

    public function get_categories() {
        return ['ehtazem-widgets'];
    }

    public function get_keywords() {
        return ['services', 'ehtazem', 'features'];
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

        // Content Section
        $this->start_controls_section(
            'intro_section',
            [
                'label' => esc_html__('Introduction', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Section Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'خدماتنا الاستثنائية',
                'label_block' => true,
            ]
        );

		$this->add_responsive_control(
			'section_title_font_size',
			[
				'label' => esc_html__('حجم الخط', 'ehtazem-elementor-widgets'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 120,
						'step' => 1,
					],
					'em' => [
						'min' => 0.5,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 48,
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 36,
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => 28,
				],
				'selectors' => [
					'{{WRAPPER}} .our-services-title' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'section_description',
            [
                'label' => esc_html__('Section Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'dynamic' => ['active' => true],
                'default' => 'نقدم حلولاً <strong>عقارية</strong> مبتكرة تضمن الثقة والنجاح <strong>الاستثماري</strong>',
            ]
        );

        $this->end_controls_section();

        // Service 1 Section
        $this->start_controls_section(
            'service_1_section',
            [
                'label' => esc_html__('Service 1', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'service_1_image',
            [
                'label' => esc_html__('Service 1 Icon', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/cup.png',
                ],
            ]
        );

        $this->add_control(
            'service_1_title',
            [
                'label' => esc_html__('Service 1 Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'إدارة الصناديق العقارية',
                'label_block' => true,
            ]
        );

		$this->add_responsive_control(
			'service_1_title_font_size',
			[
				'label' => esc_html__('حجم خط العنوان', 'ehtazem-elementor-widgets'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
						'step' => 1,
					],
					'em' => [
						'min' => 0.5,
						'max' => 6,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors' => [
					'{{WRAPPER}} .serv-1-title' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'service_1_description',
            [
                'label' => esc_html__('Service 1 Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'إنشاء، بيع، وإدارة صناديق مرخصة بعوائد مضمونة في بيئة موثوقة، مدعومة باستثمارات مليارية.',
                'rows' => 3,
            ]
        );

        $this->end_controls_section();

        // Service 2 Section
        $this->start_controls_section(
            'service_2_section',
            [
                'label' => esc_html__('Service 2', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'service_2_image',
            [
                'label' => esc_html__('Service 2 Icon', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/cup.png',
                ],
            ]
        );

        $this->add_control(
            'service_2_title',
            [
                'label' => esc_html__('Service 2 Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'الوساطة العقارية مع احتزم',
                'label_block' => true,
            ]
        );

		$this->add_responsive_control(
			'service_2_title_font_size',
			[
				'label' => esc_html__('حجم خط العنوان', 'ehtazem-elementor-widgets'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 80,
						'step' => 1,
					],
					'em' => [
						'min' => 0.5,
						'max' => 6,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => 18,
				],
				'selectors' => [
					'{{WRAPPER}} .serv-2-title' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'service_2_description',
            [
                'label' => esc_html__('Service 2 Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'نهج جديد بمعايير أخلاقية صارمة وفرق متخصصة تضمن تنفيذ صفقات استثمارية بنجاح.',
                'rows' => 3,
            ]
        );

        $this->end_controls_section();

        // Contact Button Section
        $this->start_controls_section(
            'contact_section',
            [
                'label' => esc_html__('Contact Button', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'contact_text',
            [
                'label' => esc_html__('Button Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'تواصل معنا',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'contact_link',
            [
                'label' => esc_html__('Button Link', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => '#contactus-section',
                ],
            ]
        );

        $this->end_controls_section();

        // Side 2 Section
        $this->start_controls_section(
            'side_2_section',
            [
                'label' => esc_html__('Side Image Section', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'side_image',
            [
                'label' => esc_html__('Side Image', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/image 1.png',
                ],
            ]
        );

        $this->add_control(
            'side_text_1',
            [
                'label' => esc_html__('Side Text 1', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'احتزم ..',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'side_text_2',
            [
                'label' => esc_html__('Side Text 2', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => '..لتتم',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'side_decoration',
            [
                'label' => esc_html__('Decoration Image', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/image 1.png',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Title
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__('Title Style', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .our-services-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .our-services-title',
            ]
        );

        $this->end_controls_section();

        // Style Section - Service Cards
        $this->start_controls_section(
            'service_card_style_section',
            [
                'label' => esc_html__('Service Card Style', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'service_title_color',
            [
                'label' => esc_html__('Service Title Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .serv-1-title, {{WRAPPER}} .serv-2-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'service_desc_color',
            [
                'label' => esc_html__('Service Description Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .serv-1-descrep, {{WRAPPER}} .serv-2-descrep' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Button
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => esc_html__('Button Style', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .serveces-contact' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__('Background Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .serveces-contact' => 'background-color: {{VALUE}};',
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
        $this->add_inline_editing_attributes( 'section_title', 'basic' );
        $this->add_inline_editing_attributes( 'section_description', 'advanced' );
        $this->add_inline_editing_attributes( 'service_1_title', 'basic' );
        $this->add_inline_editing_attributes( 'service_1_description', 'advanced' );
        $this->add_inline_editing_attributes( 'service_2_title', 'basic' );
        $this->add_inline_editing_attributes( 'service_2_description', 'advanced' );
        $this->add_inline_editing_attributes( 'contact_text', 'none' );
        $this->add_inline_editing_attributes( 'side_text_1', 'basic' );
        $this->add_inline_editing_attributes( 'side_text_2', 'basic' );
        ?>
        <section class="ourServices-section ehtazem-widget-scope" id="ourServices-section">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-5">
                        <div class="side-1-serv">
                            <div class="ourServices-intro">
                                <h2 class="our-services-title" data-aos="fade-left" data-aos-duration="1500" <?php echo $this->get_render_attribute_string( 'section_title' ); ?>>
                                    <?php echo esc_html($settings['section_title']); ?>
                                </h2>
                                <p class="our-services-introdescrep" data-aos="fade-left" data-aos-duration="1900" <?php echo $this->get_render_attribute_string( 'section_description' ); ?>>
                                    <?php echo wp_kses_post($settings['section_description']); ?>
                                </p>
                            </div>
                            <div class="serv-1">
                                <div class="serv-1-intro" data-aos="fade-left" data-aos-duration="2000">
                                    <img class="serv-1-image" src="<?php echo esc_url($settings['service_1_image']['url']); ?>" />
                                    <h2 class="serv-1-title" <?php echo $this->get_render_attribute_string( 'service_1_title' ); ?>><?php echo esc_html($settings['service_1_title']); ?></h2>
                                </div>
                                <p class="serv-1-descrep" data-aos="fade-left" data-aos-duration="2200" <?php echo $this->get_render_attribute_string( 'service_1_description' ); ?>>
                                    <?php echo esc_html($settings['service_1_description']); ?>
                                </p>
                            </div>
                            <div class="serv-2">
                                <div class="serv-2-intro" data-aos="fade-left" data-aos-duration="2500">
                                    <img class="serv-2-image" src="<?php echo esc_url($settings['service_2_image']['url']); ?>" />
                                    <h2 class="serv-2-title" <?php echo $this->get_render_attribute_string( 'service_2_title' ); ?>><?php echo esc_html($settings['service_2_title']); ?></h2>
                                </div>
                                <p class="serv-2-descrep" data-aos="fade-left" data-aos-duration="2900" <?php echo $this->get_render_attribute_string( 'service_2_description' ); ?>>
                                    <?php echo esc_html($settings['service_2_description']); ?>
                                </p>
                            </div>
                            <a class="serveces-contact" href="<?php echo esc_url($settings['contact_link']['url']); ?>">
                                <span <?php echo $this->get_render_attribute_string( 'contact_text' ); ?>>
                                    <?php echo esc_html($settings['contact_text']); ?>
                                </span>
                                <i class="fa-solid fa-arrow-left arrow-join-head arrow-hero-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="serv-side-2" data-aos="fade-right" data-aos-duration="1500">
                            <div class="servs-image">
                                <img src="<?php echo esc_url($settings['side_image']['url']); ?>" alt="picture" class="services-images">
                            </div>
                            <div class="serv-side-2-desc">
                                <p class="side-2-p1" <?php echo $this->get_render_attribute_string( 'side_text_1' ); ?>><?php echo esc_html($settings['side_text_1']); ?></p>
                                <p class="side-2-p2" <?php echo $this->get_render_attribute_string( 'side_text_2' ); ?>><?php echo esc_html($settings['side_text_2']); ?></p>
                                <div class="serv-deco">
                                    <img src="<?php echo esc_url($settings['side_decoration']['url']); ?>" alt="image" class="serv-deco-img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    protected function content_template() {
        ?>
        <section class="ourServices-section">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-5">
                        <div class="side-1-serv">
                            <div class="ourServices-intro">
                                <h2 class="our-services-title">
                                    {{{ settings.section_title }}}
                                </h2>
                                <p class="our-services-introdescrep">
                                    {{{ settings.section_description }}}
                                </p>
                            </div>
                            <div class="serv-1">
                                <div class="serv-1-intro">
                                    <img class="serv-1-image" src="{{ settings.service_1_image.url }}" />
                                    <h2 class="serv-1-title">{{{ settings.service_1_title }}}</h2>
                                </div>
                                <p class="serv-1-descrep">
                                    {{{ settings.service_1_description }}}
                                </p>
                            </div>
                            <div class="serv-2">
                                <div class="serv-2-intro">
                                    <img class="serv-2-image" src="{{ settings.service_2_image.url }}" />
                                    <h2 class="serv-2-title">{{{ settings.service_2_title }}}</h2>
                                </div>
                                <p class="serv-2-descrep">
                                    {{{ settings.service_2_description }}}
                                </p>
                            </div>
                            <a class="serveces-contact" href="{{ settings.contact_link.url }}">
                                {{{ settings.contact_text }}}
                                <i class="fa-solid fa-arrow-left arrow-join-head arrow-hero-down"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="serv-side-2">
                            <div class="servs-image">
                                <img src="{{ settings.side_image.url }}" alt="picture" class="services-images">
                            </div>
                            <div class="serv-side-2-desc">
                                <p class="side-2-p1">{{{ settings.side_text_1 }}}</p>
                                <p class="side-2-p2">{{{ settings.side_text_2 }}}</p>
                                <div class="serv-deco">
                                    <img src="{{ settings.side_decoration.url }}" alt="image" class="serv-deco-img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
