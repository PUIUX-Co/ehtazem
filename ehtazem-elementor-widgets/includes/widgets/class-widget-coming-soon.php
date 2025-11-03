<?php
/**
 * Coming Soon Widget
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

class Ehtazem_Coming_Soon_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ehtazem_coming_soon';
    }

    public function get_title() {
        return esc_html__('Coming Soon', 'ehtazem-elementor-widgets');
    }

    public function get_icon() {
        return 'eicon-time-line';
    }

    public function get_categories() {
        return ['ehtazem-widgets'];
    }

    public function get_keywords() {
        return ['coming soon', 'soon', 'ehtazem'];
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

        // Content Section - Left Side
        $this->start_controls_section(
            'left_content_section',
            [
                'label' => esc_html__('Left Content', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'قريبا',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'الجيل العقاري <br/>القادم',
                'rows' => 2,
            ]
        );

        $this->add_control(
            'intro_text',
            [
                'label' => esc_html__('Intro Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'قريبًا: مشروع ثوري يعيد تشكيل السوق العقاري!',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Features Section
        $this->start_controls_section(
            'features_section',
            [
                'label' => esc_html__('Features List', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'feature_text',
            [
                'label' => esc_html__('Feature Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'احترافية عالية بمعايير داخلية صارمة',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'features_list',
            [
                'label' => esc_html__('Features', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['feature_text' => 'احترافية عالية بمعايير داخلية صارمة'],
                    ['feature_text' => 'تنظيم ذكي لحلول تشغيلية مبتكرة'],
                    ['feature_text' => 'مرخص من هيئة سوق المال'],
                ],
                'title_field' => '{{{ feature_text }}}',
            ]
        );

        $this->end_controls_section();

        // Button Section
        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__('Button', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'ترقبو الكشف عن التفاصيل',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Right Side Section
        $this->start_controls_section(
            'right_side_section',
            [
                'label' => esc_html__('Right Side Content', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'side_image',
            [
                'label' => esc_html__('Side Image', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'side_text_1',
            [
                'label' => esc_html__('Side Text 1', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'احتزم ..',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'side_text_2',
            [
                'label' => esc_html__('Side Text 2', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '..لتتم',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'side_decoration',
            [
                'label' => esc_html__('Decoration Image', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        // Decoration Section
        $this->start_controls_section(
            'decoration_section',
            [
                'label' => esc_html__('Decoration', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'top_decoration',
            [
                'label' => esc_html__('Top Decoration Image', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
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
                    '{{WRAPPER}} .soon-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .soon-title',
            ]
        );

        $this->end_controls_section();

        // Style Section - Subtitle
        $this->start_controls_section(
            'subtitle_style_section',
            [
                'label' => esc_html__('Subtitle Style', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__('Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .soon-descrep-intro' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .soon-descrep-intro',
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
                    '{{WRAPPER}} .soon-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__('Background Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .soon-btn' => 'background-color: {{VALUE}};',
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
        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_inline_editing_attributes( 'subtitle', 'basic' );
        $this->add_inline_editing_attributes( 'intro_text', 'basic' );
        $this->add_inline_editing_attributes( 'button_text', 'none' );
        $this->add_inline_editing_attributes( 'side_text_1', 'basic' );
        $this->add_inline_editing_attributes( 'side_text_2', 'basic' );
        ?>
        <section class="soon" id="soon-section">
            <div class="soon-deco">
                <img src="<?php echo esc_url($settings['top_decoration']['url']); ?>" alt="decoration" class="soon-deco-image">
            </div>
            <div class="container">
                <div class="soon-sec">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="side-1-soon">
                                <div class="soon-intro">
                                    <h2 class="soon-title" data-aos="fade-left" data-aos-duration="1500" <?php echo $this->get_render_attribute_string( 'title' ); ?>>
                                        <?php echo esc_html($settings['title']); ?>
                                    </h2>
                                    <p class="soon-descrep-intro" data-aos="fade-left" data-aos-duration="1900" <?php echo $this->get_render_attribute_string( 'subtitle' ); ?>>
                                        <?php echo wp_kses_post($settings['subtitle']); ?>
                                    </p>
                                </div>
                                <div class="soon-features">
                                    <p class="soon-features-descrep" data-aos="fade-left" data-aos-duration="2000" <?php echo $this->get_render_attribute_string( 'intro_text' ); ?>>
                                        <?php echo esc_html($settings['intro_text']); ?>
                                    </p>
                                    <ul class="soon-uln">
                                        <?php
                                        $delay = 2500;
                                        foreach ($settings['features_list'] as $index => $feature) :
                                            $feature_key = 'features_list.' . $index . '.feature_text';
                                            $this->add_inline_editing_attributes( $feature_key, 'none' );
                                        ?>
                                            <li data-aos="fade-left" data-aos-duration="<?php echo esc_attr($delay); ?>" <?php echo $this->get_render_attribute_string( $feature_key ); ?>>
                                                <?php echo esc_html($feature['feature_text']); ?>
                                            </li>
                                        <?php
                                            $delay += 200;
                                        endforeach;
                                        ?>
                                    </ul>
                                </div>
                                <button class="soon-btn" data-aos="fade-left" data-aos-duration="3000" <?php echo $this->get_render_attribute_string( 'button_text' ); ?>>
                                    <?php echo esc_html($settings['button_text']); ?>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="side-2-soon" data-aos="fade-right" data-aos-duration="1500">
                                <div class="soon-img">
                                    <img src="<?php echo esc_url($settings['side_image']['url']); ?>" alt="image" class="side2-soon-image">
                                </div>
                                <div class="soon-side2-desc">
                                    <p class="side-2soon-p1" <?php echo $this->get_render_attribute_string( 'side_text_1' ); ?>><?php echo esc_html($settings['side_text_1']); ?></p>
                                    <p class="side-2soon-p2" <?php echo $this->get_render_attribute_string( 'side_text_2' ); ?>><?php echo esc_html($settings['side_text_2']); ?></p>
                                    <div class="soon-side2-deco">
                                        <img src="<?php echo esc_url($settings['side_decoration']['url']); ?>" alt="image" class="soon-side2-deco-img">
                                    </div>
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
        <section class="soon">
            <div class="soon-deco">
                <img src="{{ settings.top_decoration.url }}" alt="decoration" class="soon-deco-image">
            </div>
            <div class="container">
                <div class="soon-sec">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="side-1-soon">
                                <div class="soon-intro">
                                    <h2 class="soon-title">
                                        {{{ settings.title }}}
                                    </h2>
                                    <p class="soon-descrep-intro">
                                        {{{ settings.subtitle }}}
                                    </p>
                                </div>
                                <div class="soon-features">
                                    <p class="soon-features-descrep">
                                        {{{ settings.intro_text }}}
                                    </p>
                                    <ul class="soon-uln">
                                        <# _.each( settings.features_list, function( feature ) { #>
                                            <li>{{{ feature.feature_text }}}</li>
                                        <# }); #>
                                    </ul>
                                </div>
                                <button class="soon-btn">
                                    {{{ settings.button_text }}}
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="side-2-soon">
                                <div class="soon-img">
                                    <img src="{{ settings.side_image.url }}" alt="image" class="side2-soon-image">
                                </div>
                                <div class="soon-side2-desc">
                                    <p class="side-2soon-p1">{{{ settings.side_text_1 }}}</p>
                                    <p class="side-2soon-p2">{{{ settings.side_text_2 }}}</p>
                                    <div class="soon-side2-deco">
                                        <img src="{{ settings.side_decoration.url }}" alt="image" class="soon-side2-deco-img">
                                    </div>
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
