<?php
/**
 * About Carousel Widget
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

class Ehtazem_About_Carousel_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'ehtazem_about_carousel';
    }

    public function get_title() {
        return esc_html__('About Carousel', 'ehtazem-elementor-widgets');
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return ['ehtazem-widgets'];
    }

    public function get_keywords() {
        return ['about', 'carousel', 'slider', 'ehtazem'];
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

    public function get_script_depends() {
        return ['swiper'];
    }

    public function get_style_depends() {
        return ['swiper'];
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
            'title',
            [
                'label' => esc_html__('Title', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'نبذة عن احتزم',
                'placeholder' => esc_html__('Enter title', 'ehtazem-elementor-widgets'),
                'label_block' => true,
            ]
        );

		$this->add_responsive_control(
			'title_font_size',
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
					'{{WRAPPER}} .aboutUs-title' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'نلتزم ببناء الثقة من خلال تنفيذ مشاريع عقارية بأعلى معايير الاحترافية. مع تاريخ من الإنجازات الملموسة، نضمن لمستثمرينا تنفيذًا دقيقًا وشفافًا، مدعومين بخبراتنا الواسعة في السوق السعودي.',
                'placeholder' => esc_html__('Enter description', 'ehtazem-elementor-widgets'),
                'rows' => 5,
            ]
        );

		$this->add_responsive_control(
			'description_font_size',
			[
				'label' => esc_html__('حجم خط الوصف', 'ehtazem-elementor-widgets'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'rem'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 60,
						'step' => 1,
					],
					'em' => [
						'min' => 0.5,
						'max' => 5,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 18,
				],
				'tablet_default' => [
					'unit' => 'px',
					'size' => 16,
				],
				'mobile_default' => [
					'unit' => 'px',
					'size' => 14,
				],
				'selectors' => [
					'{{WRAPPER}} .aboutUs-desc' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        // Images Section
        $this->start_controls_section(
            'images_section',
            [
                'label' => esc_html__('Carousel Images', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugin_dir_url(dirname(__FILE__, 2)) . 'assets/images/image 1.png',
                ],
            ]
        );

        $repeater->add_control(
            'image_alt',
            [
                'label' => esc_html__('Image Alt Text', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'aboutUs-image',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'carousel_images',
            [
                'label' => esc_html__('Images', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['image' => ['url' => \Elementor\Utils::get_placeholder_image_src()], 'image_alt' => 'aboutUs-image'],
                    ['image' => ['url' => \Elementor\Utils::get_placeholder_image_src()], 'image_alt' => 'aboutUs-image'],
                    ['image' => ['url' => \Elementor\Utils::get_placeholder_image_src()], 'image_alt' => 'aboutUs-image'],
                    ['image' => ['url' => \Elementor\Utils::get_placeholder_image_src()], 'image_alt' => 'aboutUs-image'],
                ],
                'title_field' => '{{{ image_alt }}}',
            ]
        );

        $this->end_controls_section();

        // Swiper Settings Section
        $this->start_controls_section(
            'swiper_settings_section',
            [
                'label' => esc_html__('Carousel Settings', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'slides_per_view',
            [
                'label' => esc_html__('Slides Per View', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'dynamic' => ['active' => true],
                'default' => 3,
                'min' => 1,
                'max' => 10,
            ]
        );

        $this->add_control(
            'space_between',
            [
                'label' => esc_html__('Space Between Slides', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'dynamic' => ['active' => true],
                'default' => 30,
                'min' => 0,
                'max' => 100,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => esc_html__('Loop', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'ehtazem-elementor-widgets'),
                'label_off' => esc_html__('No', 'ehtazem-elementor-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'ehtazem-elementor-widgets'),
                'label_off' => esc_html__('No', 'ehtazem-elementor-widgets'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_delay',
            [
                'label' => esc_html__('Autoplay Delay (ms)', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'dynamic' => ['active' => true],
                'default' => 3000,
                'min' => 1000,
                'max' => 10000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__('Speed (ms)', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'dynamic' => ['active' => true],
                'default' => 500,
                'min' => 100,
                'max' => 3000,
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
                    '{{WRAPPER}} .aboutUs-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .aboutUs-title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .aboutUs-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                    '{{WRAPPER}} .aboutUs-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .aboutUs-desc',
            ]
        );

        $this->add_responsive_control(
            'description_margin',
            [
                'label' => esc_html__('Margin', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .aboutUs-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section - Controls
        $this->start_controls_section(
            'controls_style_section',
            [
                'label' => esc_html__('Navigation Controls Style', 'ehtazem-elementor-widgets'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'controls_color',
            [
                'label' => esc_html__('Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .aboutUs-controls button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'controls_bg_color',
            [
                'label' => esc_html__('Background Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .aboutUs-controls button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'controls_hover_color',
            [
                'label' => esc_html__('Hover Color', 'ehtazem-elementor-widgets'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .aboutUs-controls button:hover' => 'color: {{VALUE}};',
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

        // Add inline editing attributes
        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_inline_editing_attributes( 'description', 'advanced' );
        ?>
        <section class="aboutUs-section" id="aboutUs-section">
            <div class="container">
                <div class="aboutUs-content">
                    <div class="aboutUs-intro">
                        <div class="aboutUs-title" data-aos="zoom-in" data-aos-duration="1500" <?php echo $this->get_render_attribute_string( 'title' ); ?>>
                            <?php echo esc_html($settings['title']); ?>
                        </div>
                        <p class="aboutUs-desc" data-aos="zoom-in" data-aos-duration="1900" <?php echo $this->get_render_attribute_string( 'description' ); ?>>
                            <?php echo esc_html($settings['description']); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="aboutUs-images swiper swiper-<?php echo esc_attr($widget_id); ?>">
                <div class="swiper-wrapper">
                    <?php foreach ($settings['carousel_images'] as $image) : ?>
                        <div class="swiper-slide">
                            <div class="img-card-about">
                                <img src="<?php echo esc_url($image['image']['url']); ?>"
                                     alt="<?php echo esc_attr($image['image_alt']); ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="aboutUs-controls">
                <button class="aboutUs-prev aboutUs-prev-<?php echo esc_attr($widget_id); ?>" aria-label="previous">
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
                <button class="aboutUs-next aboutUs-next-<?php echo esc_attr($widget_id); ?>" aria-label="next">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
            </div>
        </section>

        <script>
        jQuery(document).ready(function($) {
            var swiper<?php echo $widget_id; ?> = new Swiper('.swiper-<?php echo esc_js($widget_id); ?>', {
                slidesPerView: <?php echo esc_js($settings['slides_per_view']); ?>,
                spaceBetween: <?php echo esc_js($settings['space_between']); ?>,
                loop: <?php echo ($settings['loop'] === 'yes') ? 'true' : 'false'; ?>,
                speed: <?php echo esc_js($settings['speed']); ?>,
                <?php if ($settings['autoplay'] === 'yes') : ?>
                autoplay: {
                    delay: <?php echo esc_js($settings['autoplay_delay']); ?>,
                    disableOnInteraction: false,
                },
                <?php endif; ?>
                navigation: {
                    nextEl: '.aboutUs-next-<?php echo esc_js($widget_id); ?>',
                    prevEl: '.aboutUs-prev-<?php echo esc_js($widget_id); ?>',
                },
                breakpoints: {
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 15
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    1024: {
                        slidesPerView: <?php echo esc_js($settings['slides_per_view']); ?>,
                        spaceBetween: <?php echo esc_js($settings['space_between']); ?>
                    }
                }
            });
        });
        </script>
        <?php
    }

    protected function content_template() {
        ?>
        <#
        var widgetId = '<?php echo $this->get_id(); ?>';
        #>
        <section class="aboutUs-section">
            <div class="container">
                <div class="aboutUs-content">
                    <div class="aboutUs-intro">
                        <div class="aboutUs-title">
                            {{{ settings.title }}}
                        </div>
                        <p class="aboutUs-desc">
                            {{{ settings.description }}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="aboutUs-images swiper">
                <div class="swiper-wrapper">
                    <# _.each( settings.carousel_images, function( image ) { #>
                        <div class="swiper-slide">
                            <div class="img-card-about">
                                <img src="{{ image.image.url }}" alt="{{ image.image_alt }}">
                            </div>
                        </div>
                    <# }); #>
                </div>
            </div>
            <div class="aboutUs-controls">
                <button class="aboutUs-prev" aria-label="previous">
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
                <button class="aboutUs-next" aria-label="next">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
            </div>
        </section>
        <?php
    }
}
