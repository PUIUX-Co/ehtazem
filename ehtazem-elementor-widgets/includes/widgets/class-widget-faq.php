<?php
/**
 * FAQ Widget
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

class Ehtazem_FAQ_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ehtazem_faq';
    }

    public function get_title() {
        return esc_html__('FAQ', 'ehtazem-elementor-widgets');
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return ['ehtazem-widgets'];
    }

    public function get_keywords() {
        return ['faq', 'accordion', 'questions', 'ehtazem'];
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
                'default' => 'سؤال وجواب',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'section_title',
            [
                'label' => esc_html__('Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'الأسئلة الشائعة',
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
                    '{{WRAPPER}} .faq-title' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'section_description',
            [
                'label' => esc_html__('Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'نهجنا المتكامل يجمع بين تقييم الصفقات بدقة، كود أخلاقي صلب، ومعيار REQI المبتكر، لضمان استثمارات مليارية ناجحة تدعم رؤية الجيل العقاري القادم.',
                'rows' => 3,
            ]
        );

        $this->add_control(
            'center_image',
            [
                'label' => esc_html__('Center Decoration Image', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/center-img.png',
                ],
            ]
        );

        $this->end_controls_section();

        // FAQ Items Section
        $this->start_controls_section(
            'faq_items_section',
            [
                'label' => esc_html__('FAQ Items', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'question',
            [
                'label' => esc_html__('Question', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'ما الذي يميز احتزم في إدارة الصناديق العقارية؟',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'answer',
            [
                'label' => esc_html__('Answer', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'نقدّم صناديق مرخصة من هيئة سوق المال، مدعومة باستثمارات مليارية وتشديد دقيق لضمان عوائد مستدامة.',
                'rows' => 3,
            ]
        );

        $this->add_control(
            'faq_items',
            [
                'label' => esc_html__('FAQ Items', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'question' => 'ما الذي يميز احتزم في إدارة الصناديق العقارية؟',
                        'answer' => 'نقدّم صناديق مرخصة من هيئة سوق المال، مدعومة باستثمارات مليارية وتشديد دقيق لضمان عوائد مستدامة.',
                    ],
                    [
                        'question' => 'كيف تضمن احتزم الشفافية في الوساطة العقارية؟',
                        'answer' => 'نلتزم بأعلى معايير الشفافية والمصداقية في جميع معاملاتنا العقارية، مع توفير تقارير دورية وتحديثات مستمرة للعملاء.',
                    ],
                    [
                        'question' => 'ما هي طبيعة الجيل العقاري القادم؟',
                        'answer' => 'نركز على الاستثمارات العقارية المبتكرة والمستدامة التي تواكب التطورات الحديثة وتلبي احتياجات المستقبل بكفاءة عالية.',
                    ],
                    [
                        'question' => 'كيف يمكنني الاطمئنان إلى استثماراتي مع احترم؟',
                        'answer' => 'نوفر نظام متابعة شامل ومعايير صارمة في اختيار الفرص الاستثمارية، بالإضافة إلى فريق خبراء متخصص يعمل على حماية استثماراتك وتنميتها.',
                    ],
                ],
                'title_field' => '{{{ question }}}',
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
                    '{{WRAPPER}} .faq-badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'badge_bg_color',
            [
                'label' => esc_html__('Background Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-badge' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .faq-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .faq-title',
            ]
        );

        $this->end_controls_section();

        // Style Section - Accordion
        $this->start_controls_section(
            'accordion_style_section',
            [
                'label' => esc_html__('Accordion Style', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'accordion_button_color',
            [
                'label' => esc_html__('Button Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'accordion_body_color',
            [
                'label' => esc_html__('Body Text Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .accordion-body' => 'color: {{VALUE}};',
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
        $widget_id = $this->get_id();
        ?>
        <section class="questions-section ehtazem-widget-scope" id="questions-section">
            <div class="container">
                <div class="faq">
                    <div class="faq-header" >
                        <div class="faq-badge badge" data-aos="zoom-in" data-aos-duration="1500">
                            <?php echo esc_html($settings['badge_text']); ?>
                        </div>
                        <h1 class="faq-title" data-aos="zoom-in" data-aos-duration="1900">
                            <?php echo esc_html($settings['section_title']); ?>
                        </h1>
                        <p class="faq-description" data-aos="zoom-in" data-aos-duration="2200">
                            <?php echo esc_html($settings['section_description']); ?>
                        </p>
                    </div>
                    <img src="<?php echo esc_url($settings['center_image']['url']); ?>" alt="" class="ques-center-img">
                    <div class="accordion" id="faqAccordion">
                        <?php foreach ($settings['faq_items'] as $index => $item) :
                            $item_id = 'faq' . $index;
                        ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#<?php echo esc_attr($item_id); ?>">
                                        <?php echo esc_html($item['question']); ?>
                                    </button>
                                </h2>
                                <div id="<?php echo esc_attr($item_id); ?>" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <?php echo esc_html($item['answer']); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

		<style>
		<?php if (!empty($settings['custom_css'])): ?>
			<?php echo $settings['custom_css']; ?>
		<?php endif; ?>
		</style>
        <?php
    }

    protected function content_template() {
        ?>
        <#
        var widgetId = '<?php echo $this->get_id(); ?>';
        #>
        <section class="questions-section">
            <div class="container">
                <div class="faq">
                    <div class="faq-header">
                        <div class="faq-badge badge">
                            {{{ settings.badge_text }}}
                        </div>
                        <h1 class="faq-title">
                            {{{ settings.section_title }}}
                        </h1>
                        <p class="faq-description">
                            {{{ settings.section_description }}}
                        </p>
                    </div>
                    <img src="{{ settings.center_image.url }}" alt="" class="ques-center-img">
                    <div class="accordion" id="faqAccordion{{ widgetId }}">
                        <# _.each( settings.faq_items, function( item, index ) {
                            var itemId = 'faq' + widgetId + index;
                        #>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#{{ itemId }}">
                                        {{{ item.question }}}
                                    </button>
                                </h2>
                                <div id="{{ itemId }}" class="accordion-collapse collapse" data-bs-parent="#faqAccordion{{ widgetId }}">
                                    <div class="accordion-body">
                                        {{{ item.answer }}}
                                    </div>
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
