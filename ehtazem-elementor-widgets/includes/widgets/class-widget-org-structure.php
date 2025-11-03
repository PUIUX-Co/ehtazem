<?php
/**
 * Organizational Structure Widget
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

class Ehtazem_Org_Structure_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ehtazem_org_structure';
    }

    public function get_title() {
        return esc_html__('Organizational Structure', 'ehtazem-elementor-widgets');
    }

    public function get_icon() {
        return 'eicon-flow';
    }

    public function get_categories() {
        return ['ehtazem-widgets'];
    }

    public function get_keywords() {
        return ['org', 'structure', 'organization', 'ehtazem'];
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
                'default' => 'رحلتنا',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'هيكل تنظيمي متين يضمن تنفيذ<br>المشاريع بكفاءة',
                'rows' => 2,
            ]
        );

        $this->end_controls_section();

        // Circle 1 Section
        $this->start_controls_section(
            'circle_1_section',
            [
                'label' => esc_html__('Circle 1 (Right)', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'circle_1_number',
            [
                'label' => esc_html__('Number', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '1',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'circle_1_title',
            [
                'label' => esc_html__('Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'دائرة الاكتشاف<br>العقاري',
                'rows' => 2,
            ]
        );

        $this->add_control(
            'circle_1_description',
            [
                'label' => esc_html__('Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'لضمان توفير حلول متنوعة<br>للعملاء نبحث حلا منفصلا',
                'rows' => 2,
            ]
        );

        $this->add_control(
            'circle_1_icon',
            [
                'label' => esc_html__('Icon', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        // Circle 2 Section
        $this->start_controls_section(
            'circle_2_section',
            [
                'label' => esc_html__('Circle 2 (Center)', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'circle_2_number',
            [
                'label' => esc_html__('Number', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '2',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'circle_2_title',
            [
                'label' => esc_html__('Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'دائرة التوثيق<br>والتسجيل',
                'rows' => 2,
            ]
        );

        $this->add_control(
            'circle_2_description',
            [
                'label' => esc_html__('Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'تمحيص الوجهة والقيام<br>بالمراسم الملحقية',
                'rows' => 2,
            ]
        );

        $this->add_control(
            'circle_2_icon',
            [
                'label' => esc_html__('Icon', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        // Circle 3 Section
        $this->start_controls_section(
            'circle_3_section',
            [
                'label' => esc_html__('Circle 3 (Left)', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'circle_3_number',
            [
                'label' => esc_html__('Number', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '3',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'circle_3_title',
            [
                'label' => esc_html__('Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'دائرة التمكين<br>والعلاقات',
                'rows' => 2,
            ]
        );

        $this->add_control(
            'circle_3_description',
            [
                'label' => esc_html__('Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'بناء شراكات استراتيجية<br>مدنية ومالية',
                'rows' => 2,
            ]
        );

        $this->add_control(
            'circle_3_icon',
            [
                'label' => esc_html__('Icon', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
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
                    '{{WRAPPER}} .org-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .org-title',
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
                    '{{WRAPPER}} .org-circle' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'circle_title_color',
            [
                'label' => esc_html__('Circle Title Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .org-dept-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'circle_desc_color',
            [
                'label' => esc_html__('Circle Description Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .org-dept-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Add inline editing attributes
        $this->add_inline_editing_attributes( 'badge_text', 'none' );
        $this->add_inline_editing_attributes( 'section_title', 'basic' );
        $this->add_inline_editing_attributes( 'circle_1_number', 'none' );
        $this->add_inline_editing_attributes( 'circle_1_title', 'basic' );
        $this->add_inline_editing_attributes( 'circle_1_description', 'basic' );
        $this->add_inline_editing_attributes( 'circle_2_number', 'none' );
        $this->add_inline_editing_attributes( 'circle_2_title', 'basic' );
        $this->add_inline_editing_attributes( 'circle_2_description', 'basic' );
        $this->add_inline_editing_attributes( 'circle_3_number', 'none' );
        $this->add_inline_editing_attributes( 'circle_3_title', 'basic' );
        $this->add_inline_editing_attributes( 'circle_3_description', 'basic' );
        ?>
        <section class="org-structure-section" id="org-structure-section">
            <div class="ellipse-bg ellipse1"></div>
            <div class="ellipse-bg ellipse2"></div>

            <div class="org-container">
                <div class="org-header">
                    <div class="badge" data-aos="zoom-in" data-aos-duration="1500" <?php echo $this->get_render_attribute_string( 'badge_text' ); ?>>
                        <?php echo esc_html($settings['badge_text']); ?>
                    </div>
                    <h2 class="org-title" data-aos="zoom-in" data-aos-duration="1900" <?php echo $this->get_render_attribute_string( 'section_title' ); ?>>
                        <?php echo wp_kses_post($settings['section_title']); ?>
                    </h2>
                </div>

                <div class="org-wave-wrapper">
                    <!-- Animated curved lines and dots -->
                    <div class="wave-lines-container">
                        <!-- Gradient Line -->
                        <svg class="wave-line-1" width="1201" height="250" viewBox="0 0 1201 250" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1200 154.5C1128 235.5 947.5 338.7 801.5 103.5C619 -190.5 452.5 249.5 326.5 176.5C200.5 103.5 162 0.999207 1.5 154.5"
                                stroke="url(#paint0_linear_150_952)" stroke-width="2" />
                            <defs>
                                <linearGradient id="paint0_linear_150_952" x1="1200" y1="124.728" x2="1.5" y2="124.728"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset="0.00397385" stop-color="#4EA62F" stop-opacity="0" />
                                    <stop offset="0.502741" stop-color="#4EA62F" />
                                    <stop offset="1" stop-color="#4EA62F" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                        </svg>

                        <!-- Solid Gold Line -->
                        <svg class="wave-line-2" width="1201" height="250" viewBox="0 0 1201 250" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1200 154.403C1128 235.403 947.5 338.603 801.5 103.403C619 -190.597 452.5 249.403 326.5 176.403C200.5 103.403 162 0.902527 1.5 154.403"
                                stroke="#D7B261" stroke-width="2" />
                        </svg>

                        <!-- Moving dots -->
                        <div class="moving-dot dot-1"></div>
                        <div class="moving-dot dot-2"></div>
                        <div class="moving-dot dot-3"></div>
                    </div>

                    <div class="org-circles-container">
                        <!-- Circle 1 - Right -->
                        <div class="org-item org-item-1">
                            <div class="org-number" <?php echo $this->get_render_attribute_string( 'circle_1_number' ); ?>><?php echo esc_html($settings['circle_1_number']); ?></div>
                            <div class="org-content">
                                <h3 class="org-dept-title" <?php echo $this->get_render_attribute_string( 'circle_1_title' ); ?>><?php echo wp_kses_post($settings['circle_1_title']); ?></h3>
                                <p class="org-dept-desc" <?php echo $this->get_render_attribute_string( 'circle_1_description' ); ?>><?php echo wp_kses_post($settings['circle_1_description']); ?></p>
                            </div>
                            <div class="org-circle-wrapper">
                                <div class="org-circle">
                                    <img src="<?php echo esc_url($settings['circle_1_icon']['url']); ?>" alt="">
                                </div>
                            </div>
                        </div>

                        <!-- Circle 2 - Center -->
                        <div class="org-item org-item-2">
                            <div class="org-circle-wrapper">
                                <div class="org-circle">
                                    <img src="<?php echo esc_url($settings['circle_2_icon']['url']); ?>" alt="">
                                </div>
                            </div>
                            <div class="org-number" <?php echo $this->get_render_attribute_string( 'circle_2_number' ); ?>><?php echo esc_html($settings['circle_2_number']); ?></div>
                            <div class="org-content">
                                <h3 class="org-dept-title" <?php echo $this->get_render_attribute_string( 'circle_2_title' ); ?>><?php echo wp_kses_post($settings['circle_2_title']); ?></h3>
                                <p class="org-dept-desc" <?php echo $this->get_render_attribute_string( 'circle_2_description' ); ?>><?php echo wp_kses_post($settings['circle_2_description']); ?></p>
                            </div>
                        </div>

                        <!-- Circle 3 - Left -->
                        <div class="org-item org-item-3">
                            <div class="org-number" <?php echo $this->get_render_attribute_string( 'circle_3_number' ); ?>><?php echo esc_html($settings['circle_3_number']); ?></div>
                            <div class="org-content">
                                <h3 class="org-dept-title" <?php echo $this->get_render_attribute_string( 'circle_3_title' ); ?>><?php echo wp_kses_post($settings['circle_3_title']); ?></h3>
                                <p class="org-dept-desc" <?php echo $this->get_render_attribute_string( 'circle_3_description' ); ?>><?php echo wp_kses_post($settings['circle_3_description']); ?></p>
                            </div>
                            <div class="org-circle-wrapper">
                                <div class="org-circle">
                                    <img src="<?php echo esc_url($settings['circle_3_icon']['url']); ?>" alt="cup">
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
        <section class="org-structure-section">
            <div class="ellipse-bg ellipse1"></div>
            <div class="ellipse-bg ellipse2"></div>

            <div class="org-container">
                <div class="org-header">
                    <div class="badge">
                        {{{ settings.badge_text }}}
                    </div>
                    <h2 class="org-title">
                        {{{ settings.section_title }}}
                    </h2>
                </div>

                <div class="org-wave-wrapper">
                    <div class="wave-lines-container">
                        <svg class="wave-line-1" width="1201" height="250" viewBox="0 0 1201 250" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1200 154.5C1128 235.5 947.5 338.7 801.5 103.5C619 -190.5 452.5 249.5 326.5 176.5C200.5 103.5 162 0.999207 1.5 154.5"
                                stroke="url(#paint0_linear_150_952)" stroke-width="2" />
                            <defs>
                                <linearGradient id="paint0_linear_150_952" x1="1200" y1="124.728" x2="1.5" y2="124.728"
                                    gradientUnits="userSpaceOnUse">
                                    <stop offset="0.00397385" stop-color="#4EA62F" stop-opacity="0" />
                                    <stop offset="0.502741" stop-color="#4EA62F" />
                                    <stop offset="1" stop-color="#4EA62F" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                        </svg>

                        <svg class="wave-line-2" width="1201" height="250" viewBox="0 0 1201 250" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1200 154.403C1128 235.403 947.5 338.603 801.5 103.403C619 -190.597 452.5 249.403 326.5 176.403C200.5 103.403 162 0.902527 1.5 154.403"
                                stroke="#D7B261" stroke-width="2" />
                        </svg>

                        <div class="moving-dot dot-1"></div>
                        <div class="moving-dot dot-2"></div>
                        <div class="moving-dot dot-3"></div>
                    </div>

                    <div class="org-circles-container">
                        <!-- Circle 1 -->
                        <div class="org-item org-item-1">
                            <div class="org-number">{{{ settings.circle_1_number }}}</div>
                            <div class="org-content">
                                <h3 class="org-dept-title">{{{ settings.circle_1_title }}}</h3>
                                <p class="org-dept-desc">{{{ settings.circle_1_description }}}</p>
                            </div>
                            <div class="org-circle-wrapper">
                                <div class="org-circle">
                                    <img src="{{ settings.circle_1_icon.url }}" alt="">
                                </div>
                            </div>
                        </div>

                        <!-- Circle 2 -->
                        <div class="org-item org-item-2">
                            <div class="org-circle-wrapper">
                                <div class="org-circle">
                                    <img src="{{ settings.circle_2_icon.url }}" alt="">
                                </div>
                            </div>
                            <div class="org-number">{{{ settings.circle_2_number }}}</div>
                            <div class="org-content">
                                <h3 class="org-dept-title">{{{ settings.circle_2_title }}}</h3>
                                <p class="org-dept-desc">{{{ settings.circle_2_description }}}</p>
                            </div>
                        </div>

                        <!-- Circle 3 -->
                        <div class="org-item org-item-3">
                            <div class="org-number">{{{ settings.circle_3_number }}}</div>
                            <div class="org-content">
                                <h3 class="org-dept-title">{{{ settings.circle_3_title }}}</h3>
                                <p class="org-dept-desc">{{{ settings.circle_3_description }}}</p>
                            </div>
                            <div class="org-circle-wrapper">
                                <div class="org-circle">
                                    <img src="{{ settings.circle_3_icon.url }}" alt="cup">
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
