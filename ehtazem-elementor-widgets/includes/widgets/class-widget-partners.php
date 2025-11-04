<?php
/**
 * Partners Widget
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

class Ehtazem_Partners_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ehtazem_partners';
    }

    public function get_title() {
        return esc_html__('Partners', 'ehtazem-elementor-widgets');
    }

    public function get_icon() {
        return 'eicon-person';
    }

    public function get_categories() {
        return ['ehtazem-widgets'];
    }

    public function get_keywords() {
        return ['partners', 'team', 'ehtazem'];
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
                'default' => 'شركاؤنا',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'قادة يصنعون المستقبل',
                'label_block' => true,
            ]
        );

        $this->add_responsive_control(
            'section_title_font_size',
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
                    '{{WRAPPER}} .Ourpartners-title' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label' => esc_html__('Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'احتزم، يقود فريقنا من الشركاء ذوي الرؤية الثاقبة والخبرة العميقة وحدة التمكين العقاري نحو إعادة صياغة السوق. كل شريك يترك بصمة مميزة تجمع بين الابتكار،',
                'rows' => 3,
            ]
        );

        $this->end_controls_section();

        // Partners Section
        $this->start_controls_section(
            'partners_section',
            [
                'label' => esc_html__('Partners', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'partner_name',
            [
                'label' => esc_html__('Partner Name', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'م. مشاري مطر العتيبي',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'partner_position',
            [
                'label' => esc_html__('Position', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'مؤسس شركة احتزم',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'partner_description',
            [
                'label' => esc_html__('Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'صياغة معايير جديدة للسوق والبداية من المشاريع العملاقة',
                'rows' => 3,
            ]
        );

        $this->add_control(
            'partners_list',
            [
                'label' => esc_html__('Partners', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'partner_name' => 'م. مشاري مطر العتيبي',
                        'partner_position' => 'مؤسس شركة احتزم',
                        'partner_description' => 'صياغة معايير جديدة للسوق والبداية من المشاريع العملاقة',
                    ],
                    [
                        'partner_name' => 'أ. رائد مطر العتيبي',
                        'partner_position' => 'مالك لعدد من المؤسسات الرائدة في القطاع الصناعي',
                        'partner_description' => 'اصتياد الفرص الخفية وتحويلها إلى استثمارات فعلية',
                    ],
                    [
                        'partner_name' => 'م. محمد عبدالله العتيبي',
                        'partner_position' => 'مهندس مدني خبير',
                        'partner_description' => 'ضمان الالتزام بالمعايير الهندسية المتفوقة مع الحفاظ على جاذبية العقار الاستثمارية.',
                    ],
                    [
                        'partner_name' => 'م. محمد سعد القرني',
                        'partner_position' => 'مهندس مدني خبير (كفاءة فريدة)',
                        'partner_description' => 'مبتكر للحلول التشغيلية والاستثمارية لزيادة المردود المالي والكفاءة في كل مشروع.',
                    ],
                ],
                'title_field' => '{{{ partner_name }}}',
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
                    '{{WRAPPER}} .Ourpartners-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label' => esc_html__('Background Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .Ourpartners-badge' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .Ourpartners-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .Ourpartners-title',
            ]
        );

        $this->end_controls_section();

        // Style Section - Cards
        $this->start_controls_section(
            'cards_style_section',
            [
                'label' => esc_html__('Cards Style', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_bg_color',
            [
                'label' => esc_html__('Card Background', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .partener-card' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_name_color',
            [
                'label' => esc_html__('Name Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .partener-card-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_position_color',
            [
                'label' => esc_html__('Position Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .partener-card-position' => 'color: {{VALUE}};',
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
        $this->add_inline_editing_attributes( 'section_title', 'basic' );
        $this->add_inline_editing_attributes( 'section_description', 'advanced' );
        ?>
        <section class="Ourpartners-section ehtazem-widget-scope" id="Ourpartners-section">
            <div class="container">
                <div class="Ourpartners-intro">
                    <div class="badge Ourpartners-badge" data-aos="zoom-in" data-aos-duration="1500" <?php echo $this->get_render_attribute_string( 'badge_text' ); ?>>
                        <?php echo esc_html($settings['badge_text']); ?>
                    </div>
                    <h4 class="Ourpartners-title" data-aos="zoom-in" data-aos-duration="1900" <?php echo $this->get_render_attribute_string( 'section_title' ); ?>>
                        <?php echo esc_html($settings['section_title']); ?>
                    </h4>
                    <p class="Ourpartners-para" data-aos="zoom-in" data-aos-duration="2200" <?php echo $this->get_render_attribute_string( 'section_description' ); ?>>
                        <?php echo esc_html($settings['section_description']); ?>
                    </p>
                </div>
                <div class="parteners-cards">
                    <div class="row g-4">
                        <?php foreach ($settings['partners_list'] as $index => $partner) :
                            $name_key = 'partners_list.' . $index . '.partner_name';
                            $position_key = 'partners_list.' . $index . '.partner_position';
                            $desc_key = 'partners_list.' . $index . '.partner_description';
                            $this->add_inline_editing_attributes( $name_key, 'basic' );
                            $this->add_inline_editing_attributes( $position_key, 'basic' );
                            $this->add_inline_editing_attributes( $desc_key, 'advanced' );
                        ?>
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="partener-card">
                                    <h2 class="partener-card-name" <?php echo $this->get_render_attribute_string( $name_key ); ?>><?php echo esc_html($partner['partner_name']); ?></h2>
                                    <h4 class="partener-card-position" <?php echo $this->get_render_attribute_string( $position_key ); ?>><?php echo esc_html($partner['partner_position']); ?></h4>
                                    <p class="partener-card-desc" <?php echo $this->get_render_attribute_string( $desc_key ); ?>><?php echo esc_html($partner['partner_description']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    protected function content_template() {
        ?>
        <section class="Ourpartners-section">
            <div class="container">
                <div class="Ourpartners-intro">
                    <div class="badge Ourpartners-badge">
                        {{{ settings.badge_text }}}
                    </div>
                    <h4 class="Ourpartners-title">
                        {{{ settings.section_title }}}
                    </h4>
                    <p class="Ourpartners-para">
                        {{{ settings.section_description }}}
                    </p>
                </div>
                <div class="parteners-cards">
                    <div class="row g-4">
                        <# _.each( settings.partners_list, function( partner ) { #>
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="partener-card">
                                    <h2 class="partener-card-name">{{{ partner.partner_name }}}</h2>
                                    <h4 class="partener-card-position">{{{ partner.partner_position }}}</h4>
                                    <p class="partener-card-desc">{{{ partner.partner_description }}}</p>
                                </div>
                            </div>
                        <# }); #>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
