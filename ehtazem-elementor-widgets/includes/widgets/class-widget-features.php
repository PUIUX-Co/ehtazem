<?php
/**
 * Features Widget
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

class Ehtazem_Features_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ehtazem_features';
    }

    public function get_title() {
        return esc_html__('Features', 'ehtazem-elementor-widgets');
    }

    public function get_icon() {
        return 'eicon-apps';
    }

    public function get_categories() {
        return ['ehtazem-widgets'];
    }

    public function get_keywords() {
        return ['features', 'grid', 'ehtazem'];
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

        // Header Section
        $this->start_controls_section(
            'header_section',
            [
                'label' => esc_html__('Header', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label' => esc_html__('Badge Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'مزايا احتزم',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'main_title',
            [
                'label' => esc_html__('Main Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'لماذا تختار احتزم؟',
                'label_block' => true,
            ]
        );

        $this->add_responsive_control(
            'main_title_font_size',
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
                    '{{WRAPPER}} .main-title' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'خبراتنا المتراكمة في استخدام، تطوير التطبيقات البرمجية، خطوط الإنتاج، الاستشارات التقنية المهنية المتنوعة، التسويق الصناعي توفر لك 6 من 10',
                'rows' => 3,
            ]
        );

        $this->end_controls_section();

        // Center Circle Section
        $this->start_controls_section(
            'center_section',
            [
                'label' => esc_html__('Center Circle', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'center_text',
            [
                'label' => esc_html__('Center Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'احتزم',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'under_center_text',
            [
                'label' => esc_html__('Under Center Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'احتزم .. لتتم',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'center_image',
            [
                'label' => esc_html__('Center Background Image', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/image 1.png',
                ],
            ]
        );

        $this->end_controls_section();

        // Feature Card 1 (Top Right)
        $this->start_controls_section(
            'feature_1_section',
            [
                'label' => esc_html__('Feature 1 (Top Right)', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'feature_1_icon',
            [
                'label' => esc_html__('Icon', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/ranking.png',
                ],
            ]
        );

        $this->add_control(
            'feature_1_title',
            [
                'label' => esc_html__('Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'استشارات متخصصة في الصناعة',
                'label_block' => true,
            ]
        );

        $this->add_responsive_control(
            'feature_1_title_font_size',
            [
                'label' => esc_html__('حجم الخط', 'ehtazem-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => ['min' => 10, 'max' => 60, 'step' => 1],
                    'em' => ['min' => 0.5, 'max' => 5, 'step' => 0.1],
                ],
                'default' => ['unit' => 'px', 'size' => 24],
                'tablet_default' => ['unit' => 'px', 'size' => 20],
                'mobile_default' => ['unit' => 'px', 'size' => 18],
                'selectors' => [
                    '{{WRAPPER}} .feature-card.top-right .feature-title' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'feature_1_description',
            [
                'label' => esc_html__('Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'استراتيجيات مخصصة مبنية على أساس المجال الصناعي والاحتياجات الفريدة للأعمال والتطوير الرقمي الشامل',
                'rows' => 3,
            ]
        );

        $this->end_controls_section();

        // Feature Card 2 (Top Left)
        $this->start_controls_section(
            'feature_2_section',
            [
                'label' => esc_html__('Feature 2 (Top Left)', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'feature_2_icon',
            [
                'label' => esc_html__('Icon', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/ranking.png',
                ],
            ]
        );

        $this->add_control(
            'feature_2_title',
            [
                'label' => esc_html__('Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'تطبيقات متكاملة',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'feature_2_description',
            [
                'label' => esc_html__('Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'حلول برمجية شاملة تغطي كافة جوانب عملك من إدارة الموارد إلى التسويق والمبيعات وخدمة العملاء',
                'rows' => 3,
            ]
        );

        $this->end_controls_section();

        // Feature Card 3 (Bottom Right)
        $this->start_controls_section(
            'feature_3_section',
            [
                'label' => esc_html__('Feature 3 (Bottom Right)', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'feature_3_icon',
            [
                'label' => esc_html__('Icon', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/ranking.png',
                ],
            ]
        );

        $this->add_control(
            'feature_3_title',
            [
                'label' => esc_html__('Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'موثوقية وأمان الأنظمة',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'feature_3_description',
            [
                'label' => esc_html__('Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'حلول رائدة متقدمة لمواكبة التطورات وضمان استمرارية FMECA وأدوات TRIZ أمان البيانات في مرافق الإنتاج',
                'rows' => 3,
            ]
        );

        $this->end_controls_section();

        // Feature Card 4 (Bottom Left)
        $this->start_controls_section(
            'feature_4_section',
            [
                'label' => esc_html__('Feature 4 (Bottom Left)', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'feature_4_icon',
            [
                'label' => esc_html__('Icon', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/ranking.png',
                ],
            ]
        );

        $this->add_control(
            'feature_4_title',
            [
                'label' => esc_html__('Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'تحليل احصائي متقدم',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'feature_4_description',
            [
                'label' => esc_html__('Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'إمكانيات تحليلية لا مثيل لها لإيجاد رؤى تحليلية وإحصائية قابلة للتنفيذ والتطوير واتخاذ قرارات فعالة',
                'rows' => 3,
            ]
        );

        $this->end_controls_section();

        // Decoration Images Section
        $this->start_controls_section(
            'decoration_section',
            [
                'label' => esc_html__('Decoration Images', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'star_image',
            [
                'label' => esc_html__('Star Image', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/image 1.png',
                ],
            ]
        );

        $this->add_control(
            'line_image',
            [
                'label' => esc_html__('Line Image', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/image 1.png',
                ],
            ]
        );

        $this->add_control(
            'path_image_1',
            [
                'label' => esc_html__('Path Image 1', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/image 1.png',
                ],
            ]
        );

        $this->add_control(
            'path_image_2',
            [
                'label' => esc_html__('Path Image 2', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/image 1.png',
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
            'badge_color',
            [
                'label' => esc_html__('Badge Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'feature_title_color',
            [
                'label' => esc_html__('Feature Title Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .feature-title' => 'color: {{VALUE}};',
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
        $this->add_inline_editing_attributes( 'main_title', 'basic' );
        $this->add_inline_editing_attributes( 'subtitle', 'advanced' );
        $this->add_inline_editing_attributes( 'center_text', 'none' );
        $this->add_inline_editing_attributes( 'under_center_text', 'none' );
        $this->add_inline_editing_attributes( 'feature_1_title', 'basic' );
        $this->add_inline_editing_attributes( 'feature_1_description', 'advanced' );
        $this->add_inline_editing_attributes( 'feature_2_title', 'basic' );
        $this->add_inline_editing_attributes( 'feature_2_description', 'advanced' );
        $this->add_inline_editing_attributes( 'feature_3_title', 'basic' );
        $this->add_inline_editing_attributes( 'feature_3_description', 'advanced' );
        $this->add_inline_editing_attributes( 'feature_4_title', 'basic' );
        $this->add_inline_editing_attributes( 'feature_4_description', 'advanced' );
        ?>
        <div class="section-features ehtazem-widget-scope" id="section-features">
            <div class="bg-decoration bg-decoration-1"></div>
            <div class="bg-decoration bg-decoration-2"></div>

            <div class="header-features">
                <div class="badge" data-aos="zoom-in" data-aos-duration="1500" <?php echo $this->get_render_attribute_string( 'badge_text' ); ?>>
                    <?php echo esc_html($settings['badge_text']); ?>
                </div>
                <h1 class="main-title" data-aos="zoom-in" data-aos-duration="1900" <?php echo $this->get_render_attribute_string( 'main_title' ); ?>>
                    <?php echo esc_html($settings['main_title']); ?>
                </h1>
                <p class="subtitle" data-aos="zoom-in" data-aos-duration="2200" <?php echo $this->get_render_attribute_string( 'subtitle' ); ?>>
                    <?php echo esc_html($settings['subtitle']); ?>
                </p>
            </div>

            <div class="grid-container-features">
                <div class="empty-div-1"></div>

                <!-- Top Right -->
                <div class="feature-card top-right">
                    <img alt="احتزم" src="<?php echo esc_url($settings['center_image']['url']); ?>" class="cir-img" />
                    <div class="linse_star-right">
                        <img alt="احتزم" src="<?php echo esc_url($settings['star_image']['url']); ?>" class="star-img" />
                        <img alt="احتزم" src="<?php echo esc_url($settings['line_image']['url']); ?>" class="line-img" />
                    </div>
                    <div class="linse_star-left">
                        <img alt="احتزم" src="<?php echo esc_url($settings['star_image']['url']); ?>" class="star-img" />
                        <img alt="احتزم" src="<?php echo esc_url($settings['line_image']['url']); ?>" class="line-img" />
                    </div>
                    <div class="icon-circle">
                        <div class="icon-circle-img">
                            <img alt="<?php echo esc_attr($settings['feature_1_title']); ?>" src="<?php echo esc_url($settings['feature_1_icon']['url']); ?>" />
                        </div>
                    </div>
                    <h3 class="feature-title" <?php echo $this->get_render_attribute_string( 'feature_1_title' ); ?>><?php echo esc_html($settings['feature_1_title']); ?></h3>
                    <p class="feature-description" <?php echo $this->get_render_attribute_string( 'feature_1_description' ); ?>>
                        <?php echo esc_html($settings['feature_1_description']); ?>
                    </p>
                </div>

                <div class="empty-div-2"></div>

                <!-- Top Left -->
                <div class="feature-card top-left">
                    <img alt="احتزم" src="<?php echo esc_url($settings['center_image']['url']); ?>" class="cir-img" />
                    <div class="linse_star-right">
                        <img alt="احتزم" src="<?php echo esc_url($settings['star_image']['url']); ?>" class="star-img" />
                        <img alt="احتزم" src="<?php echo esc_url($settings['line_image']['url']); ?>" class="line-img" />
                    </div>
                    <div class="linse_star-left">
                        <img alt="احتزم" src="<?php echo esc_url($settings['star_image']['url']); ?>" class="star-img" />
                        <img alt="احتزم" src="<?php echo esc_url($settings['line_image']['url']); ?>" class="line-img" />
                    </div>
                    <div class="icon-circle">
                        <div class="icon-circle-img">
                            <img alt="<?php echo esc_attr($settings['feature_2_title']); ?>" src="<?php echo esc_url($settings['feature_2_icon']['url']); ?>" />
                        </div>
                    </div>
                    <h3 class="feature-title" <?php echo $this->get_render_attribute_string( 'feature_2_title' ); ?>><?php echo esc_html($settings['feature_2_title']); ?></h3>
                    <p class="feature-description" <?php echo $this->get_render_attribute_string( 'feature_2_description' ); ?>>
                        <?php echo esc_html($settings['feature_2_description']); ?>
                    </p>
                </div>

                <!-- Center Circle -->
                <div class="center-element">
                    <div class="center-circle">
                        <div class="center-circle-texts">
                            <div class="center-text" <?php echo $this->get_render_attribute_string( 'center_text' ); ?>><?php echo esc_html($settings['center_text']); ?></div>
                            <p class="under-center" <?php echo $this->get_render_attribute_string( 'under_center_text' ); ?>><?php echo esc_html($settings['under_center_text']); ?></p>
                        </div>

                        <img alt="احتزم" src="<?php echo esc_url($settings['center_image']['url']); ?>" class="center-img" />

                        <!-- Fan Container for rotation -->
                        <div class="fan-container">
                            <img alt="احتزم" src="<?php echo esc_url($settings['path_image_2']['url']); ?>" class="curve curve-1 path2" />
                            <img alt="احتزم" src="<?php echo esc_url($settings['path_image_2']['url']); ?>" class="curve curve-2 path2" />
                            <img alt="احتزم" src="<?php echo esc_url($settings['path_image_1']['url']); ?>" class="curve curve-3 path1" />
                            <img alt="احتزم" src="<?php echo esc_url($settings['path_image_1']['url']); ?>" class="curve curve-4 path1" />
                        </div>
                    </div>
                </div>

                <!-- Bottom Right -->
                <div class="feature-card bottom-right">
                    <img alt="احتزم" src="<?php echo esc_url($settings['center_image']['url']); ?>" class="cir-img" />
                    <div class="linse_star-right">
                        <img alt="احتزم" src="<?php echo esc_url($settings['star_image']['url']); ?>" class="star-img" />
                        <img alt="احتزم" src="<?php echo esc_url($settings['line_image']['url']); ?>" class="line-img" />
                    </div>
                    <div class="linse_star-left">
                        <img alt="احتزم" src="<?php echo esc_url($settings['star_image']['url']); ?>" class="star-img" />
                        <img alt="احتزم" src="<?php echo esc_url($settings['line_image']['url']); ?>" class="line-img" />
                    </div>
                    <div class="icon-circle">
                        <div class="icon-circle-img">
                            <img alt="<?php echo esc_attr($settings['feature_3_title']); ?>" src="<?php echo esc_url($settings['feature_3_icon']['url']); ?>" />
                        </div>
                    </div>
                    <h3 class="feature-title" <?php echo $this->get_render_attribute_string( 'feature_3_title' ); ?>><?php echo esc_html($settings['feature_3_title']); ?></h3>
                    <p class="feature-description" <?php echo $this->get_render_attribute_string( 'feature_3_description' ); ?>>
                        <?php echo esc_html($settings['feature_3_description']); ?>
                    </p>
                </div>

                <div class="empty-div-3"></div>

                <!-- Bottom Left -->
                <div class="feature-card bottom-left">
                    <img alt="احتزم" src="<?php echo esc_url($settings['center_image']['url']); ?>" class="cir-img" />
                    <div class="linse_star-right">
                        <img alt="احتزم" src="<?php echo esc_url($settings['star_image']['url']); ?>" class="star-img" />
                        <img alt="احتزم" src="<?php echo esc_url($settings['line_image']['url']); ?>" class="line-img" />
                    </div>
                    <div class="linse_star-left">
                        <img alt="احتزم" src="<?php echo esc_url($settings['star_image']['url']); ?>" class="star-img" />
                        <img alt="احتزم" src="<?php echo esc_url($settings['line_image']['url']); ?>" class="line-img" />
                    </div>
                    <div class="icon-circle">
                        <div class="icon-circle-img">
                            <img alt="<?php echo esc_attr($settings['feature_4_title']); ?>" src="<?php echo esc_url($settings['feature_4_icon']['url']); ?>" />
                        </div>
                    </div>
                    <h3 class="feature-title" <?php echo $this->get_render_attribute_string( 'feature_4_title' ); ?>><?php echo esc_html($settings['feature_4_title']); ?></h3>
                    <p class="feature-description" <?php echo $this->get_render_attribute_string( 'feature_4_description' ); ?>>
                        <?php echo esc_html($settings['feature_4_description']); ?>
                    </p>
                </div>

                <div class="empty-div-4"></div>
            </div>
        </div>
        <?php
    }

    protected function content_template() {
        ?>
        <div class="section-features">
            <div class="bg-decoration bg-decoration-1"></div>
            <div class="bg-decoration bg-decoration-2"></div>

            <div class="header-features">
                <div class="badge">{{{ settings.badge_text }}}</div>
                <h1 class="main-title">{{{ settings.main_title }}}</h1>
                <p class="subtitle">{{{ settings.subtitle }}}</p>
            </div>

            <div class="grid-container-features">
                <div class="empty-div-1"></div>

                <div class="feature-card top-right">
                    <img src="{{ settings.center_image.url }}" class="cir-img" />
                    <div class="icon-circle">
                        <div class="icon-circle-img">
                            <img src="{{ settings.feature_1_icon.url }}" />
                        </div>
                    </div>
                    <h3 class="feature-title">{{{ settings.feature_1_title }}}</h3>
                    <p class="feature-description">{{{ settings.feature_1_description }}}</p>
                </div>

                <div class="empty-div-2"></div>

                <div class="feature-card top-left">
                    <img src="{{ settings.center_image.url }}" class="cir-img" />
                    <div class="icon-circle">
                        <div class="icon-circle-img">
                            <img src="{{ settings.feature_2_icon.url }}" />
                        </div>
                    </div>
                    <h3 class="feature-title">{{{ settings.feature_2_title }}}</h3>
                    <p class="feature-description">{{{ settings.feature_2_description }}}</p>
                </div>

                <div class="center-element">
                    <div class="center-circle">
                        <div class="center-circle-texts">
                            <div class="center-text">{{{ settings.center_text }}}</div>
                            <p class="under-center">{{{ settings.under_center_text }}}</p>
                        </div>
                        <img src="{{ settings.center_image.url }}" class="center-img" />
                    </div>
                </div>

                <div class="feature-card bottom-right">
                    <img src="{{ settings.center_image.url }}" class="cir-img" />
                    <div class="icon-circle">
                        <div class="icon-circle-img">
                            <img src="{{ settings.feature_3_icon.url }}" />
                        </div>
                    </div>
                    <h3 class="feature-title">{{{ settings.feature_3_title }}}</h3>
                    <p class="feature-description">{{{ settings.feature_3_description }}}</p>
                </div>

                <div class="empty-div-3"></div>

                <div class="feature-card bottom-left">
                    <img src="{{ settings.center_image.url }}" class="cir-img" />
                    <div class="icon-circle">
                        <div class="icon-circle-img">
                            <img src="{{ settings.feature_4_icon.url }}" />
                        </div>
                    </div>
                    <h3 class="feature-title">{{{ settings.feature_4_title }}}</h3>
                    <p class="feature-description">{{{ settings.feature_4_description }}}</p>
                </div>

                <div class="empty-div-4"></div>
            </div>
        </div>
        <?php
    }
}
