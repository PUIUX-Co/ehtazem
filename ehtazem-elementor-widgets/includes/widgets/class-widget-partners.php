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
                'default' => 'شركاؤنا',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'قادة يصنعون المستقبل',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label' => esc_html__('Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
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
                'default' => 'م. مشاري مطر العتيبي',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'partner_position',
            [
                'label' => esc_html__('Position', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'مؤسس شركة احتزم',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'partner_description',
            [
                'label' => esc_html__('Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
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
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="Ourpartners-section" id="Ourpartners-section">
            <div class="container">
                <div class="Ourpartners-intro">
                    <div class="badge Ourpartners-badge" data-aos="zoom-in" data-aos-duration="1500">
                        <?php echo esc_html($settings['badge_text']); ?>
                    </div>
                    <h4 class="Ourpartners-title" data-aos="zoom-in" data-aos-duration="1900">
                        <?php echo esc_html($settings['section_title']); ?>
                    </h4>
                    <p class="Ourpartners-para" data-aos="zoom-in" data-aos-duration="2200">
                        <?php echo esc_html($settings['section_description']); ?>
                    </p>
                </div>
                <div class="parteners-cards">
                    <div class="row g-4">
                        <?php foreach ($settings['partners_list'] as $partner) : ?>
                            <div class="col-12 col-sm-6 col-lg-3">
                                <div class="partener-card">
                                    <h2 class="partener-card-name"><?php echo esc_html($partner['partner_name']); ?></h2>
                                    <h4 class="partener-card-position"><?php echo esc_html($partner['partner_position']); ?></h4>
                                    <p class="partener-card-desc"><?php echo esc_html($partner['partner_description']); ?></p>
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
