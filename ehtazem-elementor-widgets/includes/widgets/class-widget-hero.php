<?php
/**
 * Ehtazem Hero Widget
 *
 * Elementor widget for Ehtazem hero section with background image, title, subtitle, description and action buttons
 *
 * @package Ehtazem_Elementor_Widgets
 * @since 1.0.0
 * @author PUIUX
 * Development, Design & Programming by PUIUX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ehtazem_Hero_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name
	 */
	public function get_name() {
		return 'ehtazem-hero';
	}

	/**
	 * Get widget title
	 */
	public function get_title() {
		return esc_html__( 'قسم البطل - Hero Section', 'ehtazem-elementor' );
	}

	/**
	 * Get widget icon
	 */
	public function get_icon() {
		return 'eicon-slider-full-screen';
	}

	/**
	 * Get widget categories
	 */
	public function get_categories() {
		return [ 'ehtazem-widgets' ];
	}

	/**
	 * Get widget keywords
	 */
	public function get_keywords() {
		return [ 'hero', 'banner', 'header', 'ehtazem', 'احتزم', 'بطل' ];
	}

	/**
	 * Register widget controls
	 */
	protected function register_controls() {

		// Content Section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'المحتوى - Content', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hero_title_part1',
			[
				'label' => esc_html__( 'العنوان - الجزء الأول', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'وحدة التمكين', 'ehtazem-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'hero_title_part2',
			[
				'label' => esc_html__( 'العنوان - الجزء الثاني', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'العقاري', 'ehtazem-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'hero_subtitle',
			[
				'label' => esc_html__( 'العنوان الفرعي', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'لا نَعِد فقط، نحن ننفذ', 'ehtazem-elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'hero_description',
			[
				'label' => esc_html__( 'الوصف', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'إعادة صياغة الوساطة وإدارة الصناديق العقارية باستثمارات مليارية وتراخيص من هيئة سوق المال.', 'ehtazem-elementor' ),
				'rows' => 3,
			]
		);

		$this->end_controls_section();

		// Background Section
		$this->start_controls_section(
			'background_section',
			[
				'label' => esc_html__( 'الخلفية - Background', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'background_image',
			[
				'label' => esc_html__( 'صورة الخلفية', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => plugins_url( 'assets/images/image 1.png', dirname( dirname( __FILE__ ) ) . '/ehtazem-elementor.php' ),
				],
			]
		);

		$this->add_control(
			'show_overlay',
			[
				'label' => esc_html__( 'إظهار طبقة التعتيم', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'نعم', 'ehtazem-elementor' ),
				'label_off' => esc_html__( 'لا', 'ehtazem-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		// Buttons Section
		$this->start_controls_section(
			'buttons_section',
			[
				'label' => esc_html__( 'الأزرار - Buttons', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'primary_button_text',
			[
				'label' => esc_html__( 'نص الزر الأساسي', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'الذهاب إلى احتزم', 'ehtazem-elementor' ),
			]
		);

		$this->add_control(
			'primary_button_link',
			[
				'label' => esc_html__( 'رابط الزر الأساسي', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'show_arrow_button',
			[
				'label' => esc_html__( 'إظهار زر السهم للأسفل', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'نعم', 'ehtazem-elementor' ),
				'label_off' => esc_html__( 'لا', 'ehtazem-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'arrow_button_link',
			[
				'label' => esc_html__( 'رابط زر السهم', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '#aboutUs-section',
				'condition' => [
					'show_arrow_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_play_button',
			[
				'label' => esc_html__( 'إظهار زر التشغيل', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'نعم', 'ehtazem-elementor' ),
				'label_off' => esc_html__( 'لا', 'ehtazem-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'play_button_link',
			[
				'label' => esc_html__( 'رابط زر التشغيل', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [
					'url' => '#',
				],
				'condition' => [
					'show_play_button' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		// Style Section - Title
		$this->start_controls_section(
			'title_style_section',
			[
				'label' => esc_html__( 'تنسيق العنوان - Title Style', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'لون العنوان', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_part1_color',
			[
				'label' => esc_html__( 'لون الجزء الأول', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-title span' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .hero-title',
			]
		);

		$this->end_controls_section();

		// Style Section - Subtitle
		$this->start_controls_section(
			'subtitle_style_section',
			[
				'label' => esc_html__( 'تنسيق العنوان الفرعي - Subtitle Style', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__( 'لون العنوان الفرعي', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .hero-subtitle',
			]
		);

		$this->end_controls_section();

		// Style Section - Description
		$this->start_controls_section(
			'description_style_section',
			[
				'label' => esc_html__( 'تنسيق الوصف - Description Style', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'لون الوصف', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .hero-desc',
			]
		);

		$this->end_controls_section();

		// Style Section - Primary Button
		$this->start_controls_section(
			'primary_button_style_section',
			[
				'label' => esc_html__( 'تنسيق الزر الأساسي - Primary Button Style', 'ehtazem-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'primary_button_background',
			[
				'label' => esc_html__( 'لون الخلفية', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-primary' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'primary_button_text_color',
			[
				'label' => esc_html__( 'لون النص', 'ehtazem-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-primary' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'primary_button_typography',
				'selector' => '{{WRAPPER}} .hero-primary',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$bg_url = $settings['background_image']['url'];
		?>

		<section class="hero" id="hero-section">
			<img class="hero-bg" src="<?php echo esc_url( $bg_url ); ?>" alt="background">
			<?php if ( 'yes' === $settings['show_overlay'] ) : ?>
				<div class="hero-overlay"></div>
			<?php endif; ?>
			<div class="container hero-content">
				<div class="hero-body" data-aos="fade-up" data-aos-duration="1500">
					<h1 class="hero-title"><span><?php echo esc_html( $settings['hero_title_part1'] ); ?></span><br><?php echo esc_html( $settings['hero_title_part2'] ); ?></h1>
					<p class="hero-subtitle"><?php echo esc_html( $settings['hero_subtitle'] ); ?></p>
					<p class="hero-desc"><?php echo esc_html( $settings['hero_description'] ); ?></p>
					<div class="hero-actions">
						<?php if ( ! empty( $settings['primary_button_link']['url'] ) ) :
							$this->add_link_attributes( 'primary_button_link', $settings['primary_button_link'] );
						?>
							<a class="hero-primary" <?php echo $this->get_render_attribute_string( 'primary_button_link' ); ?>>
								<?php echo esc_html( $settings['primary_button_text'] ); ?>
								<i class="fa-solid fa-arrow-left arrow-join-head arrow-hero-down"></i>
							</a>
						<?php else : ?>
							<button class="hero-primary">
								<?php echo esc_html( $settings['primary_button_text'] ); ?>
								<i class="fa-solid fa-arrow-left arrow-join-head arrow-hero-down"></i>
							</button>
						<?php endif; ?>

						<?php if ( 'yes' === $settings['show_arrow_button'] ) : ?>
							<div class="hero-arrow">
								<a class="down-btn hero-btn" href="<?php echo esc_attr( $settings['arrow_button_link'] ); ?>">
									<i class="fa-solid fa-arrow-down arrow-hero-play"></i>
								</a>
							</div>
						<?php endif; ?>

						<?php if ( 'yes' === $settings['show_play_button'] ) :
							$play_link = $settings['play_button_link']['url'];
						?>
							<div class="hero-media">
								<a class="play-btn hero-btn" href="<?php echo esc_url( $play_link ); ?>">
									<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M3.16675 8.00001V5.62668C3.16675 2.68001 5.25341 1.47334 7.80675 2.94668L9.86675 4.13334L11.9267 5.32001C14.4801 6.79334 14.4801 9.20668 11.9267 10.68L9.86675 11.8667L7.80675 13.0533C5.25341 14.5267 3.16675 13.32 3.16675 10.3733V8.00001Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>

		<?php
	}
}
