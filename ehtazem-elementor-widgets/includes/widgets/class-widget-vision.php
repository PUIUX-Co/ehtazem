<?php
/**
 * Vision Widget
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

class Ehtazem_Vision_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ehtazem_vision';
    }

    public function get_title() {
        return esc_html__('Vision', 'ehtazem-elementor-widgets');
    }

    public function get_icon() {
        return 'eicon-lightbox-expand';
    }

    public function get_categories() {
        return ['ehtazem-widgets'];
    }

    public function get_keywords() {
        return ['vision', 'ehtazem'];
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

        // Intro Section
        $this->start_controls_section(
            'intro_section',
            [
                'label' => esc_html__('Introduction', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'badge_text',
            [
                'label' => esc_html__('Badge Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'رؤية متكاملة',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'intro_title',
            [
                'label' => esc_html__('Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'قوتنا على مستويين متكاملين',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'intro_description',
            [
                'label' => esc_html__('Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'نتميز بقوة مزدوجة تجمع بين شبكة تحالفات عالمية تفتح لنا أسواقًا جديدة بخبرات راسخة، وفريق نخبة من الخبراء يحول الرؤية إلى إنجازات واقعية.',
                'rows' => 3,
            ]
        );

        $this->end_controls_section();

        // Vision 1 Section
        $this->start_controls_section(
            'vision_1_section',
            [
                'label' => esc_html__('Vision 1', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'vision_1_number',
            [
                'label' => esc_html__('Number', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '001',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'vision_1_title',
            [
                'label' => esc_html__('Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'شبكة التحالفات العالمية',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'vision_1_description',
            [
                'label' => esc_html__('Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'انطلاقًا من جذورنا المحلية الراسخة التي امتدت لشراكات استراتيجية مع كيانات عالمية واستثمارات دولية مرموقة، فتحنا أبوابًا لأسواق جديدة. هذه الشراكات لم تقتصر على الاسم، بل نقلت خبرات حقيقية إلى مشاريعنا. نضمن لكل مشروع ميزة تنافسية وبصمة مبتكرة تضمن له الاستدامة والجاذبية السوقية.',
                'rows' => 5,
            ]
        );

        $this->end_controls_section();

        // Vision 2 Section
        $this->start_controls_section(
            'vision_2_section',
            [
                'label' => esc_html__('Vision 2', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'vision_2_number',
            [
                'label' => esc_html__('Number', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '002',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'vision_2_title',
            [
                'label' => esc_html__('Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'فريق من نخبة الخبراء',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'vision_2_description',
            [
                'label' => esc_html__('Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'اخترنا بعناية فريقًا متكاملًا يضم خبراء في العقار، الاستثمار، الهندسة، وإدارة الصفقات. كل عضو يشغل موقعه لأنه يمتلك خبرة عميقة وقدرة حقيقية على تحويل الرؤية إلى إنجاز. هذا الفريق هو الذراع التنفيذي الذي يحول الفرص إلى مشاريع متكاملة، والمشاريع إلى قصص نجاح ترفع سقف التوقعات وتلزم السوق كله بالارتقاء.',
                'rows' => 5,
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
                    '{{WRAPPER}} .vision-intro-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_title_color',
            [
                'label' => esc_html__('Description Title Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .desc-title' => 'color: {{VALUE}};',
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
        $this->add_inline_editing_attributes( 'intro_title', 'basic' );
        $this->add_inline_editing_attributes( 'intro_description', 'advanced' );
        $this->add_inline_editing_attributes( 'vision_1_number', 'none' );
        $this->add_inline_editing_attributes( 'vision_1_title', 'basic' );
        $this->add_inline_editing_attributes( 'vision_1_description', 'advanced' );
        $this->add_inline_editing_attributes( 'vision_2_number', 'none' );
        $this->add_inline_editing_attributes( 'vision_2_title', 'basic' );
        $this->add_inline_editing_attributes( 'vision_2_description', 'advanced' );
        ?>
        <section class="vision-section" id="vision-section">
            <div class="container">
                <div class="vision-intro">
                    <div class="badge" data-aos="zoom-in" data-aos-duration="1500" <?php echo $this->get_render_attribute_string( 'badge_text' ); ?>>
                        <?php echo esc_html($settings['badge_text']); ?>
                    </div>
                    <h4 class="vision-intro-title" data-aos="zoom-in" data-aos-duration="1900" <?php echo $this->get_render_attribute_string( 'intro_title' ); ?>>
                        <?php echo esc_html($settings['intro_title']); ?>
                    </h4>
                    <p class="vision-intro-p" data-aos="zoom-in" data-aos-duration="2200" <?php echo $this->get_render_attribute_string( 'intro_description' ); ?>>
                        <?php echo esc_html($settings['intro_description']); ?>
                    </p>
                </div>
                <div class="vision-descreption">
                    <div class="vision-desc">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="desc1-intro" data-aos="zoom-in-left" data-aos-duration="1500">
                                    <p class="desc-num" <?php echo $this->get_render_attribute_string( 'vision_1_number' ); ?>><?php echo esc_html($settings['vision_1_number']); ?></p>
                                    <h2 class="desc-title" <?php echo $this->get_render_attribute_string( 'vision_1_title' ); ?>><?php echo esc_html($settings['vision_1_title']); ?></h2>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <p class="vision-desc-p" data-aos="zoom-in-right" data-aos-duration="1500" <?php echo $this->get_render_attribute_string( 'vision_1_description' ); ?>>
                                    <?php echo esc_html($settings['vision_1_description']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="vision-desc">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="desc2-intro" data-aos="zoom-in-left" data-aos-duration="1500">
                                    <p class="desc-num" <?php echo $this->get_render_attribute_string( 'vision_2_number' ); ?>><?php echo esc_html($settings['vision_2_number']); ?></p>
                                    <h2 class="desc-title" <?php echo $this->get_render_attribute_string( 'vision_2_title' ); ?>><?php echo esc_html($settings['vision_2_title']); ?></h2>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <p class="vision-desc-p" data-aos="zoom-in-right" data-aos-duration="1500" <?php echo $this->get_render_attribute_string( 'vision_2_description' ); ?>>
                                    <?php echo esc_html($settings['vision_2_description']); ?>
                                </p>
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
        <section class="vision-section">
            <div class="container">
                <div class="vision-intro">
                    <div class="badge">{{{ settings.badge_text }}}</div>
                    <h4 class="vision-intro-title">{{{ settings.intro_title }}}</h4>
                    <p class="vision-intro-p">{{{ settings.intro_description }}}</p>
                </div>
                <div class="vision-descreption">
                    <div class="vision-desc">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="desc1-intro">
                                    <p class="desc-num">{{{ settings.vision_1_number }}}</p>
                                    <h2 class="desc-title">{{{ settings.vision_1_title }}}</h2>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <p class="vision-desc-p">{{{ settings.vision_1_description }}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="vision-desc">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="desc2-intro">
                                    <p class="desc-num">{{{ settings.vision_2_number }}}</p>
                                    <h2 class="desc-title">{{{ settings.vision_2_title }}}</h2>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <p class="vision-desc-p">{{{ settings.vision_2_description }}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
