<?php
/**
 * Approach Widget
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

class Ehtazem_Approach_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ehtazem_approach';
    }

    public function get_title() {
        return esc_html__('Approach', 'ehtazem-elementor-widgets');
    }

    public function get_icon() {
        return 'eicon-download-circle-o';
    }

    public function get_categories() {
        return ['ehtazem-widgets'];
    }

    public function get_keywords() {
        return ['approach', 'standards', 'ehtazem'];
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
            'content_section',
            [
                'label' => esc_html__('Content', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label' => esc_html__('Badge Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'معاييرنا',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'نهج فريد يجمع بين الشفافية،<br> الجودة',
                'rows' => 2,
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'في احتزم نلزم معايير صارمة تُعيد صياغة السوق العقاري. نُنجز الشفافية بين تقييم الصفقات بدقة وكود أخلاقي صارم، ومعيار IREQI المعتمد لضمان استثمارات مالية ناضجة تدعم رؤية الجيل العقاري القادم.',
                'rows' => 5,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'تواصل معنا',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#contactus-section',
                ],
            ]
        );

        $this->end_controls_section();

        // Circles Section
        $this->start_controls_section(
            'circles_section',
            [
                'label' => esc_html__('Circles', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'circle_top_text',
            [
                'label' => esc_html__('Top Circle Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'عيار IREQI',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'circle_bottom_right_text',
            [
                'label' => esc_html__('Bottom Right Circle Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'كود أخلاقى',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'circle_bottom_left_text',
            [
                'label' => esc_html__('Bottom Left Circle Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'تقييم الصفقات',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Style Section - Badge
        $this->start_controls_section(
            'badge_style_section',
            [
                'label' => esc_html__('Badge Style', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'badge_color',
            [
                'label' => esc_html__('Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label' => esc_html__('Background Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .badge' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .approach-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .approach-title',
            ]
        );

        $this->end_controls_section();

        // Style Section - Description
        $this->start_controls_section(
            'description_style_section',
            [
                'label' => esc_html__('Description Style', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .approach-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .approach-text',
            ]
        );

        $this->end_controls_section();

        // Style Section - Circles
        $this->start_controls_section(
            'circles_style_section',
            [
                'label' => esc_html__('Circles Style', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'circle_bg_color',
            [
                'label' => esc_html__('Circle Background', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .circle' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'circle_text_color',
            [
                'label' => esc_html__('Circle Text Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .circle' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .standard-contact-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__('Background Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .standard-contact-btn' => 'background-color: {{VALUE}};',
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
        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_inline_editing_attributes( 'description', 'advanced' );
        $this->add_inline_editing_attributes( 'button_text', 'none' );
        $this->add_inline_editing_attributes( 'circle_top_text', 'none' );
        $this->add_inline_editing_attributes( 'circle_bottom_right_text', 'none' );
        $this->add_inline_editing_attributes( 'circle_bottom_left_text', 'none' );
        ?>
        <section class="approach-section" id="approach-section">
            <div class="container">
                <div class="approach-container">
                    <div class="approach-right">
                        <div class="badge badge-small" data-aos="fade-left" data-aos-duration="1500" <?php echo $this->get_render_attribute_string( 'badge_text' ); ?>>
                            <?php echo esc_html($settings['badge_text']); ?>
                        </div>
                        <h2 class="approach-title" data-aos="fade-left" data-aos-duration="1800" <?php echo $this->get_render_attribute_string( 'title' ); ?>>
                            <?php echo wp_kses_post($settings['title']); ?>
                        </h2>
                        <p class="approach-text" data-aos="fade-left" data-aos-duration="1900" <?php echo $this->get_render_attribute_string( 'description' ); ?>>
                            <?php echo esc_html($settings['description']); ?>
                        </p>
                        <a class="standard-contact-btn" href="<?php echo esc_url($settings['button_link']['url']); ?>" data-aos="fade-left" data-aos-duration="1900">
                            <span <?php echo $this->get_render_attribute_string( 'button_text' ); ?>>
                                <?php echo esc_html($settings['button_text']); ?>
                            </span>
                            <i class="fa-solid fa-arrow-left arrow-join-head arrow-hero-down"></i>
                        </a>
                    </div>
                    <div class="approach-left" data-aos="fade-right" data-aos-duration="1500">
                        <div class="circle-grid">
                            <div class="circle circle-top" <?php echo $this->get_render_attribute_string( 'circle_top_text' ); ?>><?php echo esc_html($settings['circle_top_text']); ?></div>
                            <div class="circle circle-bottom-right" <?php echo $this->get_render_attribute_string( 'circle_bottom_right_text' ); ?>><?php echo esc_html($settings['circle_bottom_right_text']); ?></div>
                            <div class="circle circle-bottom-left" <?php echo $this->get_render_attribute_string( 'circle_bottom_left_text' ); ?>><?php echo esc_html($settings['circle_bottom_left_text']); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    protected function content_template() {
        ?>
        <section class="approach-section">
            <div class="container">
                <div class="approach-container">
                    <div class="approach-right">
                        <div class="badge badge-small">
                            {{{ settings.badge_text }}}
                        </div>
                        <h2 class="approach-title">
                            {{{ settings.title }}}
                        </h2>
                        <p class="approach-text">
                            {{{ settings.description }}}
                        </p>
                        <a class="standard-contact-btn" href="{{ settings.button_link.url }}">
                            {{{ settings.button_text }}}
                            <i class="fa-solid fa-arrow-left arrow-join-head arrow-hero-down"></i>
                        </a>
                    </div>
                    <div class="approach-left">
                        <div class="circle-grid">
                            <div class="circle circle-top">{{{ settings.circle_top_text }}}</div>
                            <div class="circle circle-bottom-right">{{{ settings.circle_bottom_right_text }}}</div>
                            <div class="circle circle-bottom-left">{{{ settings.circle_bottom_left_text }}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
