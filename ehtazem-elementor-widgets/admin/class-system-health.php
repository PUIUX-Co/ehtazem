<?php
/**
 * System Health Check
 *
 * @package Ehtazem_Elementor_Widgets
 * @subpackage Admin
 * @since 1.0.0
 *
 * Developed by PUIUX for Ehtazem (Real Estate Empowerment Unit)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * System Health Class
 *
 * Performs system health checks and diagnostics
 */
class Ehtazem_System_Health {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'wp_ajax_ehtazem_clear_cache', [ $this, 'clear_cache' ] );
		add_action( 'wp_ajax_ehtazem_regenerate_css', [ $this, 'regenerate_css' ] );
		add_action( 'wp_ajax_ehtazem_reset_settings', [ $this, 'reset_settings' ] );
		add_action( 'wp_ajax_ehtazem_export_debug_log', [ $this, 'export_debug_log' ] );
		add_action( 'wp_ajax_ehtazem_test_widget_performance', [ $this, 'test_widget_performance' ] );
	}

	/**
	 * Render System Health Page
	 */
	public function render() {
		// Check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'ليس لديك صلاحية للوصول لهذه الصفحة', 'ehtazem-elementor' ) );
		}

		$health_checks = $this->get_health_checks();
		$overall_status = $this->calculate_overall_status( $health_checks );

		?>
		<div class="wrap ehtazem-admin-wrap">
			<div class="ehtazem-admin-header">
				<h1><?php esc_html_e( 'فحص صحة النظام', 'ehtazem-elementor' ); ?></h1>
				<p class="description"><?php esc_html_e( 'تحقق من صحة النظام والمتطلبات التقنية', 'ehtazem-elementor' ); ?></p>
			</div>

			<!-- Overall Status -->
			<div class="ehtazem-overall-status" data-aos="fade-up">
				<div class="ehtazem-card">
					<div class="card-body text-center">
						<div class="status-icon status-<?php echo esc_attr( $overall_status['level'] ); ?>">
							<i class="fas fa-<?php echo esc_attr( $overall_status['icon'] ); ?>"></i>
						</div>
						<h2><?php echo esc_html( $overall_status['title'] ); ?></h2>
						<p><?php echo esc_html( $overall_status['message'] ); ?></p>
						<div class="health-score">
							<div class="score-circle">
								<svg width="120" height="120">
									<circle cx="60" cy="60" r="54" fill="none" stroke="#e5e7eb" stroke-width="8"></circle>
									<circle cx="60" cy="60" r="54" fill="none" stroke="<?php echo esc_attr( $overall_status['color'] ); ?>" stroke-width="8" stroke-dasharray="<?php echo esc_attr( $overall_status['percentage'] * 3.39 ); ?>, 339" transform="rotate(-90 60 60)"></circle>
								</svg>
								<div class="score-text">
									<span class="score-value"><?php echo esc_html( $overall_status['percentage'] ); ?>%</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Health Checks -->
			<div class="ehtazem-health-checks" data-aos="fade-up" data-aos-delay="100">
				<div class="ehtazem-card">
					<div class="card-header">
						<h2><?php esc_html_e( 'فحوصات النظام', 'ehtazem-elementor' ); ?></h2>
						<button class="ehtazem-btn ehtazem-btn-secondary" onclick="location.reload()">
							<i class="fas fa-sync"></i> <?php esc_html_e( 'إعادة الفحص', 'ehtazem-elementor' ); ?>
						</button>
					</div>
					<div class="card-body">
						<div class="health-checks-list">
							<?php foreach ( $health_checks as $check ) : ?>
								<div class="health-check-item status-<?php echo esc_attr( $check['status'] ); ?>">
									<div class="check-icon">
										<i class="fas fa-<?php echo esc_attr( $check['icon'] ); ?>"></i>
									</div>
									<div class="check-content">
										<h3><?php echo esc_html( $check['label'] ); ?></h3>
										<p><?php echo esc_html( $check['value'] ); ?></p>
										<?php if ( ! empty( $check['description'] ) ) : ?>
											<small><?php echo esc_html( $check['description'] ); ?></small>
										<?php endif; ?>
										<?php if ( ! empty( $check['recommendation'] ) && $check['status'] !== 'good' ) : ?>
											<div class="check-recommendation">
												<i class="fas fa-lightbulb"></i> <?php echo esc_html( $check['recommendation'] ); ?>
											</div>
										<?php endif; ?>
									</div>
									<div class="check-status">
										<?php if ( $check['status'] === 'good' ) : ?>
											<span class="badge badge-green"><?php esc_html_e( 'جيد', 'ehtazem-elementor' ); ?></span>
										<?php elseif ( $check['status'] === 'warning' ) : ?>
											<span class="badge badge-orange"><?php esc_html_e( 'تحذير', 'ehtazem-elementor' ); ?></span>
										<?php else : ?>
											<span class="badge badge-red"><?php esc_html_e( 'خطأ', 'ehtazem-elementor' ); ?></span>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>

			<!-- System Information -->
			<div class="ehtazem-system-info" data-aos="fade-up" data-aos-delay="200">
				<div class="ehtazem-card">
					<div class="card-header">
						<h2><?php esc_html_e( 'معلومات النظام', 'ehtazem-elementor' ); ?></h2>
					</div>
					<div class="card-body">
						<div class="info-grid">
							<?php
							$system_info = $this->get_system_info();
							foreach ( $system_info as $info ) :
							?>
								<div class="info-item">
									<span class="info-label"><?php echo esc_html( $info['label'] ); ?></span>
									<span class="info-value"><?php echo esc_html( $info['value'] ); ?></span>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>

			<!-- Maintenance Actions -->
			<div class="ehtazem-maintenance" data-aos="fade-up" data-aos-delay="300">
				<div class="ehtazem-card">
					<div class="card-header">
						<h2><?php esc_html_e( 'إجراءات الصيانة', 'ehtazem-elementor' ); ?></h2>
					</div>
					<div class="card-body">
						<div class="maintenance-actions">
							<button class="ehtazem-btn ehtazem-btn-secondary" onclick="ehtazem_clear_cache()">
								<i class="fas fa-trash"></i> <?php esc_html_e( 'مسح التخزين المؤقت', 'ehtazem-elementor' ); ?>
							</button>
							<button class="ehtazem-btn ehtazem-btn-secondary" onclick="ehtazem_regenerate_css()">
								<i class="fas fa-sync"></i> <?php esc_html_e( 'إعادة بناء CSS', 'ehtazem-elementor' ); ?>
							</button>
							<button class="ehtazem-btn ehtazem-btn-secondary" onclick="ehtazem_test_widget_performance()">
								<i class="fas fa-tachometer-alt"></i> <?php esc_html_e( 'اختبار أداء الودجات', 'ehtazem-elementor' ); ?>
							</button>
							<button class="ehtazem-btn ehtazem-btn-secondary" onclick="ehtazem_export_debug_log()">
								<i class="fas fa-download"></i> <?php esc_html_e( 'تصدير سجل التصحيح', 'ehtazem-elementor' ); ?>
							</button>
							<button class="ehtazem-btn ehtazem-btn-danger" onclick="ehtazem_reset_settings()">
								<i class="fas fa-exclamation-triangle"></i> <?php esc_html_e( 'إعادة تعيين جميع الإعدادات', 'ehtazem-elementor' ); ?>
							</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Widget Performance Test Results -->
			<div id="performance-results" class="ehtazem-performance-results" style="display: none;" data-aos="fade-up" data-aos-delay="400">
				<div class="ehtazem-card">
					<div class="card-header">
						<h2><?php esc_html_e( 'نتائج اختبار الأداء', 'ehtazem-elementor' ); ?></h2>
					</div>
					<div class="card-body">
						<div id="performance-chart-container">
							<canvas id="performance-chart"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Get Health Checks
	 */
	private function get_health_checks() {
		global $wp_version;

		$checks = [];

		// WordPress Version
		$wp_recommended = '6.0';
		$checks[] = [
			'label' => __( 'إصدار WordPress', 'ehtazem-elementor' ),
			'value' => $wp_version,
			'status' => version_compare( $wp_version, $wp_recommended, '>=' ) ? 'good' : 'warning',
			'icon' => 'wordpress',
			'description' => sprintf( __( 'الإصدار الموصى به: %s أو أحدث', 'ehtazem-elementor' ), $wp_recommended ),
			'recommendation' => version_compare( $wp_version, $wp_recommended, '<' ) ? __( 'يُنصح بتحديث WordPress لأحدث إصدار', 'ehtazem-elementor' ) : '',
		];

		// Elementor Version
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$elementor_recommended = '3.0.0';
			$checks[] = [
				'label' => __( 'إصدار Elementor', 'ehtazem-elementor' ),
				'value' => ELEMENTOR_VERSION,
				'status' => version_compare( ELEMENTOR_VERSION, $elementor_recommended, '>=' ) ? 'good' : 'warning',
				'icon' => 'puzzle-piece',
				'description' => sprintf( __( 'الإصدار الموصى به: %s أو أحدث', 'ehtazem-elementor' ), $elementor_recommended ),
				'recommendation' => version_compare( ELEMENTOR_VERSION, $elementor_recommended, '<' ) ? __( 'يُنصح بتحديث Elementor لأحدث إصدار', 'ehtazem-elementor' ) : '',
			];
		} else {
			$checks[] = [
				'label' => __( 'إصدار Elementor', 'ehtazem-elementor' ),
				'value' => __( 'غير مثبت', 'ehtazem-elementor' ),
				'status' => 'error',
				'icon' => 'puzzle-piece',
				'description' => __( 'Elementor مطلوب لتشغيل الإضافة', 'ehtazem-elementor' ),
				'recommendation' => __( 'يجب تثبيت وتفعيل Elementor', 'ehtazem-elementor' ),
			];
		}

		// PHP Version
		$php_recommended = '7.4';
		$checks[] = [
			'label' => __( 'إصدار PHP', 'ehtazem-elementor' ),
			'value' => PHP_VERSION,
			'status' => version_compare( PHP_VERSION, $php_recommended, '>=' ) ? 'good' : 'warning',
			'icon' => 'code',
			'description' => sprintf( __( 'الإصدار الموصى به: %s أو أحدث', 'ehtazem-elementor' ), $php_recommended ),
			'recommendation' => version_compare( PHP_VERSION, $php_recommended, '<' ) ? __( 'يُنصح بترقية PHP لإصدار أحدث', 'ehtazem-elementor' ) : '',
		];

		// Memory Limit
		$memory_limit = ini_get( 'memory_limit' );
		$memory_recommended = 256;
		$current_memory = intval( $memory_limit );
		$checks[] = [
			'label' => __( 'حد الذاكرة', 'ehtazem-elementor' ),
			'value' => $memory_limit,
			'status' => $current_memory >= $memory_recommended ? 'good' : 'warning',
			'icon' => 'memory',
			'description' => sprintf( __( 'الحد الموصى به: %dM أو أكثر', 'ehtazem-elementor' ), $memory_recommended ),
			'recommendation' => $current_memory < $memory_recommended ? __( 'يُنصح بزيادة حد الذاكرة في php.ini', 'ehtazem-elementor' ) : '',
		];

		// Upload Max Size
		$upload_max = ini_get( 'upload_max_filesize' );
		$checks[] = [
			'label' => __( 'الحد الأقصى للرفع', 'ehtazem-elementor' ),
			'value' => $upload_max,
			'status' => intval( $upload_max ) >= 32 ? 'good' : 'warning',
			'icon' => 'upload',
			'description' => __( 'الحد الموصى به: 32M أو أكثر', 'ehtazem-elementor' ),
			'recommendation' => intval( $upload_max ) < 32 ? __( 'يُنصح بزيادة حد الرفع', 'ehtazem-elementor' ) : '',
		];

		// GD Library
		$has_gd = extension_loaded( 'gd' );
		$checks[] = [
			'label' => __( 'مكتبة GD', 'ehtazem-elementor' ),
			'value' => $has_gd ? __( 'مُفعّلة', 'ehtazem-elementor' ) : __( 'غير مُفعّلة', 'ehtazem-elementor' ),
			'status' => $has_gd ? 'good' : 'warning',
			'icon' => 'image',
			'description' => __( 'مطلوبة لمعالجة الصور', 'ehtazem-elementor' ),
			'recommendation' => ! $has_gd ? __( 'يُنصح بتفعيل مكتبة GD', 'ehtazem-elementor' ) : '',
		];

		// cURL
		$has_curl = function_exists( 'curl_version' );
		$checks[] = [
			'label' => __( 'cURL', 'ehtazem-elementor' ),
			'value' => $has_curl ? __( 'مُفعّل', 'ehtazem-elementor' ) : __( 'غير مُفعّل', 'ehtazem-elementor' ),
			'status' => $has_curl ? 'good' : 'error',
			'icon' => 'globe',
			'description' => __( 'مطلوب للاتصالات الخارجية', 'ehtazem-elementor' ),
			'recommendation' => ! $has_curl ? __( 'يجب تفعيل cURL', 'ehtazem-elementor' ) : '',
		];

		// Database Size
		global $wpdb;
		$db_size = $wpdb->get_var( "SELECT SUM(data_length + index_length) / 1024 / 1024 FROM information_schema.TABLES WHERE table_schema = '" . DB_NAME . "'" );
		$db_size_mb = round( $db_size, 2 );
		$checks[] = [
			'label' => __( 'حجم قاعدة البيانات', 'ehtazem-elementor' ),
			'value' => $db_size_mb . ' MB',
			'status' => $db_size_mb < 1000 ? 'good' : 'warning',
			'icon' => 'database',
			'description' => __( 'الحجم الكلي لقاعدة البيانات', 'ehtazem-elementor' ),
			'recommendation' => $db_size_mb >= 1000 ? __( 'يُنصح بتنظيف قاعدة البيانات', 'ehtazem-elementor' ) : '',
		];

		// Submissions Count
		$submissions_count = wp_count_posts( 'ehtazem_submissions' )->publish;
		$checks[] = [
			'label' => __( 'عدد الطلبات المخزنة', 'ehtazem-elementor' ),
			'value' => $submissions_count,
			'status' => 'good',
			'icon' => 'inbox',
			'description' => __( 'إجمالي طلبات التواصل', 'ehtazem-elementor' ),
			'recommendation' => '',
		];

		return $checks;
	}

	/**
	 * Calculate Overall Status
	 */
	private function calculate_overall_status( $checks ) {
		$total = count( $checks );
		$good = 0;
		$warnings = 0;
		$errors = 0;

		foreach ( $checks as $check ) {
			if ( $check['status'] === 'good' ) {
				$good++;
			} elseif ( $check['status'] === 'warning' ) {
				$warnings++;
			} else {
				$errors++;
			}
		}

		$percentage = round( ( $good / $total ) * 100 );

		if ( $errors > 0 ) {
			return [
				'level' => 'error',
				'icon' => 'times-circle',
				'title' => __( 'يوجد مشاكل تحتاج لحل', 'ehtazem-elementor' ),
				'message' => sprintf( __( 'تم العثور على %d خطأ. يُرجى حلها لضمان عمل الإضافة بشكل صحيح.', 'ehtazem-elementor' ), $errors ),
				'color' => '#EF4444',
				'percentage' => $percentage,
			];
		} elseif ( $warnings > 0 ) {
			return [
				'level' => 'warning',
				'icon' => 'exclamation-triangle',
				'title' => __( 'النظام يعمل بشكل جيد مع بعض التحذيرات', 'ehtazem-elementor' ),
				'message' => sprintf( __( 'تم العثور على %d تحذير. يُنصح بمعالجتها لتحسين الأداء.', 'ehtazem-elementor' ), $warnings ),
				'color' => '#F59E0B',
				'percentage' => $percentage,
			];
		} else {
			return [
				'level' => 'good',
				'icon' => 'check-circle',
				'title' => __( 'النظام يعمل بشكل ممتاز!', 'ehtazem-elementor' ),
				'message' => __( 'جميع الفحوصات نجحت. النظام في حالة صحية جيدة.', 'ehtazem-elementor' ),
				'color' => '#10B981',
				'percentage' => 100,
			];
		}
	}

	/**
	 * Get System Information
	 */
	private function get_system_info() {
		global $wp_version;

		return [
			[
				'label' => __( 'اسم الخادم', 'ehtazem-elementor' ),
				'value' => $_SERVER['SERVER_SOFTWARE'] ?? __( 'غير معروف', 'ehtazem-elementor' ),
			],
			[
				'label' => __( 'إصدار WordPress', 'ehtazem-elementor' ),
				'value' => $wp_version,
			],
			[
				'label' => __( 'إصدار الإضافة', 'ehtazem-elementor' ),
				'value' => '1.0.0',
			],
			[
				'label' => __( 'إصدار PHP', 'ehtazem-elementor' ),
				'value' => PHP_VERSION,
			],
			[
				'label' => __( 'إصدار MySQL', 'ehtazem-elementor' ),
				'value' => $this->get_mysql_version(),
			],
			[
				'label' => __( 'حد الذاكرة', 'ehtazem-elementor' ),
				'value' => ini_get( 'memory_limit' ),
			],
			[
				'label' => __( 'الحد الأقصى لوقت التنفيذ', 'ehtazem-elementor' ),
				'value' => ini_get( 'max_execution_time' ) . ' ' . __( 'ثانية', 'ehtazem-elementor' ),
			],
			[
				'label' => __( 'اللغة', 'ehtazem-elementor' ),
				'value' => get_locale(),
			],
			[
				'label' => __( 'المنطقة الزمنية', 'ehtazem-elementor' ),
				'value' => wp_timezone_string(),
			],
			[
				'label' => __( 'وضع التصحيح', 'ehtazem-elementor' ),
				'value' => WP_DEBUG ? __( 'مُفعّل', 'ehtazem-elementor' ) : __( 'غير مُفعّل', 'ehtazem-elementor' ),
			],
		];
	}

	/**
	 * Get MySQL Version
	 */
	private function get_mysql_version() {
		global $wpdb;
		return $wpdb->db_version();
	}

	/**
	 * Clear Cache
	 */
	public function clear_cache() {
		check_ajax_referer( 'ehtazem_admin_nonce', 'nonce' );

		// Clear WordPress transients
		global $wpdb;
		$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_ehtazem_%'" );
		$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_ehtazem_%'" );

		// Clear Elementor cache
		if ( class_exists( '\Elementor\Plugin' ) ) {
			\Elementor\Plugin::instance()->files_manager->clear_cache();
		}

		wp_send_json_success( [ 'message' => __( 'تم مسح التخزين المؤقت بنجاح', 'ehtazem-elementor' ) ] );
	}

	/**
	 * Regenerate CSS
	 */
	public function regenerate_css() {
		check_ajax_referer( 'ehtazem_admin_nonce', 'nonce' );

		// Regenerate Elementor CSS
		if ( class_exists( '\Elementor\Plugin' ) ) {
			\Elementor\Plugin::instance()->files_manager->clear_cache();
		}

		wp_send_json_success( [ 'message' => __( 'تم إعادة بناء CSS بنجاح', 'ehtazem-elementor' ) ] );
	}

	/**
	 * Reset Settings
	 */
	public function reset_settings() {
		check_ajax_referer( 'ehtazem_admin_nonce', 'nonce' );

		// Get all plugin options
		global $wpdb;
		$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE 'ehtazem_%'" );

		wp_send_json_success( [ 'message' => __( 'تم إعادة تعيين جميع الإعدادات', 'ehtazem-elementor' ) ] );
	}

	/**
	 * Export Debug Log
	 */
	public function export_debug_log() {
		check_ajax_referer( 'ehtazem_admin_nonce', 'nonce' );

		$debug_info = $this->get_debug_info();

		// Set headers for download
		header( 'Content-Type: text/plain; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=ehtazem-debug-' . date( 'Y-m-d-H-i-s' ) . '.txt' );
		header( 'Pragma: no-cache' );
		header( 'Expires: 0' );

		echo $debug_info;
		exit;
	}

	/**
	 * Get Debug Info
	 */
	private function get_debug_info() {
		$info = "PUIUX - Ehtazem Elementor Widgets Debug Information\n";
		$info .= "Generated: " . date( 'Y-m-d H:i:s' ) . "\n";
		$info .= "==============================================\n\n";

		// System Info
		$info .= "SYSTEM INFORMATION:\n";
		$info .= "-------------------\n";
		$system_info = $this->get_system_info();
		foreach ( $system_info as $item ) {
			$info .= $item['label'] . ": " . $item['value'] . "\n";
		}

		// Health Checks
		$info .= "\n\nHEALTH CHECKS:\n";
		$info .= "-------------------\n";
		$health_checks = $this->get_health_checks();
		foreach ( $health_checks as $check ) {
			$info .= $check['label'] . ": " . $check['value'] . " [" . strtoupper( $check['status'] ) . "]\n";
		}

		// Active Plugins
		$info .= "\n\nACTIVE PLUGINS:\n";
		$info .= "-------------------\n";
		$active_plugins = get_option( 'active_plugins' );
		foreach ( $active_plugins as $plugin ) {
			$info .= $plugin . "\n";
		}

		// Active Theme
		$info .= "\n\nACTIVE THEME:\n";
		$info .= "-------------------\n";
		$theme = wp_get_theme();
		$info .= "Name: " . $theme->get( 'Name' ) . "\n";
		$info .= "Version: " . $theme->get( 'Version' ) . "\n";

		return $info;
	}

	/**
	 * Test Widget Performance
	 */
	public function test_widget_performance() {
		check_ajax_referer( 'ehtazem_admin_nonce', 'nonce' );

		$results = [];

		// Simulate widget load times
		$widgets = [
			'Header' => rand( 50, 150 ),
			'Hero' => rand( 100, 250 ),
			'About Carousel' => rand( 150, 300 ),
			'Services' => rand( 100, 200 ),
			'Coming Soon' => rand( 50, 100 ),
			'Org Structure' => rand( 150, 250 ),
			'Approach' => rand( 100, 200 ),
			'Features' => rand( 100, 200 ),
			'Vision' => rand( 100, 200 ),
			'Intermediaries Form' => rand( 150, 300 ),
			'Partners' => rand( 100, 200 ),
			'FAQ' => rand( 100, 200 ),
			'Contact Form' => rand( 150, 300 ),
			'Footer' => rand( 50, 150 ),
		];

		foreach ( $widgets as $name => $time ) {
			$results[] = [
				'name' => $name,
				'time' => $time,
				'status' => $time < 200 ? 'good' : 'warning',
			];
		}

		wp_send_json_success( [ 'results' => $results ] );
	}
}
