<?php
/**
 * Admin Dashboard - Enhanced Dashboard with Lead Scoring
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
 * Admin Dashboard Class
 *
 * Provides enhanced dashboard with statistics, lead scoring, and submission management
 */
class Ehtazem_Admin_Dashboard {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_init', [ $this, 'handle_quick_actions' ] );
		add_action( 'wp_ajax_ehtazem_export_csv', [ $this, 'export_to_csv' ] );
	}

	/**
	 * Render Dashboard Page
	 */
	public function render() {
		// Check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'ليس لديك صلاحية للوصول لهذه الصفحة', 'ehtazem-elementor' ) );
		}

		$stats = $this->get_statistics();
		$recent_submissions = $this->get_recent_submissions( 10 );
		$chart_data = array(
			'submissions' => $this->get_chart_data(),
			'lead_distribution' => $this->get_lead_score_distribution(),
			'type_distribution' => $this->get_submission_type_distribution(),
			'status_distribution' => $this->get_status_distribution(),
		);

		?>
		<div class="wrap ehtazem-admin-wrap">
			<div class="ehtazem-admin-header">
				<div class="header-top">
					<img src="https://puiux.com/wp-content/uploads/2021/09/Logo-Black-Copress.svg" alt="PUIUX" class="puiux-logo">
					<div>
						<h1><?php esc_html_e( 'لوحة التحكم - احتزم', 'ehtazem-elementor' ); ?></h1>
						<p class="description"><?php esc_html_e( 'إدارة طلبات التواصل وتحليل البيانات', 'ehtazem-elementor' ); ?></p>
					</div>
				</div>
			</div>

			<!-- Statistics Cards -->
			<div class="ehtazem-stats-grid">
				<div class="ehtazem-stat-card" data-aos="fade-up" data-aos-delay="0">
					<div class="stat-icon stat-icon-blue">
						<i class="fas fa-inbox"></i>
					</div>
					<div class="stat-content">
						<h3><?php echo esc_html( $stats['total'] ); ?></h3>
						<p><?php esc_html_e( 'إجمالي الطلبات', 'ehtazem-elementor' ); ?></p>
					</div>
				</div>

				<div class="ehtazem-stat-card" data-aos="fade-up" data-aos-delay="100">
					<div class="stat-icon stat-icon-gold">
						<i class="fas fa-star"></i>
					</div>
					<div class="stat-content">
						<h3><?php echo esc_html( $stats['hot_leads'] ); ?></h3>
						<p><?php esc_html_e( 'عملاء محتملين مهمين', 'ehtazem-elementor' ); ?></p>
					</div>
				</div>

				<div class="ehtazem-stat-card" data-aos="fade-up" data-aos-delay="200">
					<div class="stat-icon stat-icon-green">
						<i class="fas fa-check-circle"></i>
					</div>
					<div class="stat-content">
						<h3><?php echo esc_html( $stats['completed'] ); ?></h3>
						<p><?php esc_html_e( 'طلبات مكتملة', 'ehtazem-elementor' ); ?></p>
					</div>
				</div>

				<div class="ehtazem-stat-card" data-aos="fade-up" data-aos-delay="300">
					<div class="stat-icon stat-icon-orange">
						<i class="fas fa-clock"></i>
					</div>
					<div class="stat-content">
						<h3><?php echo esc_html( $stats['pending'] ); ?></h3>
						<p><?php esc_html_e( 'قيد المعالجة', 'ehtazem-elementor' ); ?></p>
					</div>
				</div>
			</div>

			<!-- Charts Section -->
			<div class="ehtazem-charts-section" data-aos="fade-up" data-aos-delay="400">
				<div class="ehtazem-card">
					<div class="card-header">
						<h2><?php esc_html_e( 'إحصائيات الطلبات', 'ehtazem-elementor' ); ?></h2>
						<select id="ehtazem-chart-period" class="ehtazem-select">
							<option value="7"><?php esc_html_e( 'آخر 7 أيام', 'ehtazem-elementor' ); ?></option>
							<option value="30" selected><?php esc_html_e( 'آخر 30 يوم', 'ehtazem-elementor' ); ?></option>
							<option value="90"><?php esc_html_e( 'آخر 3 أشهر', 'ehtazem-elementor' ); ?></option>
						</select>
					</div>
					<div class="card-body">
						<canvas id="ehtazem-submissions-chart"></canvas>
					</div>
				</div>
			</div>

			<!-- Additional Charts Grid -->
			<div class="ehtazem-charts-wrapper">
				<!-- Lead Score Distribution Pie Chart -->
				<div class="ehtazem-chart-container" data-aos="fade-up" data-aos-delay="200">
					<div class="ehtazem-card">
						<div class="card-header">
							<h3><?php esc_html_e( 'توزيع العملاء حسب التصنيف', 'ehtazem-elementor' ); ?></h3>
						</div>
						<div class="card-body">
							<canvas id="leadScorePieChart"></canvas>
						</div>
					</div>
				</div>

				<!-- Submissions by Type Bar Chart -->
				<div class="ehtazem-chart-container" data-aos="fade-up" data-aos-delay="300">
					<div class="ehtazem-card">
						<div class="card-header">
							<h3><?php esc_html_e( 'الطلبات حسب النوع', 'ehtazem-elementor' ); ?></h3>
						</div>
						<div class="card-body">
							<canvas id="submissionTypeChart"></canvas>
						</div>
					</div>
				</div>

				<!-- Status Distribution Doughnut Chart -->
				<div class="ehtazem-chart-container" data-aos="fade-up" data-aos-delay="400">
					<div class="ehtazem-card">
						<div class="card-header">
							<h3><?php esc_html_e( 'حالة الطلبات', 'ehtazem-elementor' ); ?></h3>
						</div>
						<div class="card-body">
							<canvas id="statusDoughnutChart"></canvas>
						</div>
					</div>
				</div>
			</div>

			<!-- Filters -->
			<div class="ehtazem-filters" data-aos="fade-up" data-aos-delay="500">
				<form method="get" action="" class="filter-form">
					<input type="hidden" name="page" value="ehtazem-dashboard">

					<select name="filter_status" class="ehtazem-select">
						<option value=""><?php esc_html_e( 'جميع الحالات', 'ehtazem-elementor' ); ?></option>
						<option value="new" <?php selected( isset( $_GET['filter_status'] ) ? $_GET['filter_status'] : '', 'new' ); ?>><?php esc_html_e( 'جديد', 'ehtazem-elementor' ); ?></option>
						<option value="in_progress" <?php selected( isset( $_GET['filter_status'] ) ? $_GET['filter_status'] : '', 'in_progress' ); ?>><?php esc_html_e( 'قيد المعالجة', 'ehtazem-elementor' ); ?></option>
						<option value="completed" <?php selected( isset( $_GET['filter_status'] ) ? $_GET['filter_status'] : '', 'completed' ); ?>><?php esc_html_e( 'مكتمل', 'ehtazem-elementor' ); ?></option>
					</select>

					<select name="filter_type" class="ehtazem-select">
						<option value=""><?php esc_html_e( 'جميع الأنواع', 'ehtazem-elementor' ); ?></option>
						<option value="intermediaries" <?php selected( isset( $_GET['filter_type'] ) ? $_GET['filter_type'] : '', 'intermediaries' ); ?>><?php esc_html_e( 'نموذج الوسطاء', 'ehtazem-elementor' ); ?></option>
						<option value="contact" <?php selected( isset( $_GET['filter_type'] ) ? $_GET['filter_type'] : '', 'contact' ); ?>><?php esc_html_e( 'نموذج التواصل', 'ehtazem-elementor' ); ?></option>
					</select>

					<input type="date" name="filter_date_from" class="ehtazem-input" placeholder="<?php esc_attr_e( 'من تاريخ', 'ehtazem-elementor' ); ?>" value="<?php echo esc_attr( isset( $_GET['filter_date_from'] ) ? $_GET['filter_date_from'] : '' ); ?>">

					<input type="date" name="filter_date_to" class="ehtazem-input" placeholder="<?php esc_attr_e( 'إلى تاريخ', 'ehtazem-elementor' ); ?>" value="<?php echo esc_attr( isset( $_GET['filter_date_to'] ) ? $_GET['filter_date_to'] : '' ); ?>">

					<button type="submit" class="ehtazem-btn ehtazem-btn-primary">
						<i class="fas fa-filter"></i> <?php esc_html_e( 'تصفية', 'ehtazem-elementor' ); ?>
					</button>

					<button type="button" class="ehtazem-btn ehtazem-btn-secondary" onclick="ehtazem_export_csv()">
						<i class="fas fa-download"></i> <?php esc_html_e( 'تصدير CSV', 'ehtazem-elementor' ); ?>
					</button>
				</form>
			</div>

			<!-- Recent Submissions Table -->
			<div class="ehtazem-submissions-table" data-aos="fade-up" data-aos-delay="600">
				<div class="ehtazem-card">
					<div class="card-header">
						<h2><?php esc_html_e( 'أحدث الطلبات', 'ehtazem-elementor' ); ?></h2>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="ehtazem-table">
								<thead>
									<tr>
										<th><?php esc_html_e( 'التقييم', 'ehtazem-elementor' ); ?></th>
										<th><?php esc_html_e( 'الاسم', 'ehtazem-elementor' ); ?></th>
										<th><?php esc_html_e( 'الهاتف', 'ehtazem-elementor' ); ?></th>
										<th><?php esc_html_e( 'النوع', 'ehtazem-elementor' ); ?></th>
										<th><?php esc_html_e( 'الحالة', 'ehtazem-elementor' ); ?></th>
										<th><?php esc_html_e( 'التاريخ', 'ehtazem-elementor' ); ?></th>
										<th><?php esc_html_e( 'الإجراءات', 'ehtazem-elementor' ); ?></th>
									</tr>
								</thead>
								<tbody>
									<?php if ( ! empty( $recent_submissions ) ) : ?>
										<?php foreach ( $recent_submissions as $submission ) : ?>
											<tr>
												<td>
													<?php
													$score = $this->calculate_lead_score( $submission->ID );
													$score_class = $score >= 70 ? 'hot' : ( $score >= 40 ? 'warm' : 'cold' );
													?>
													<div class="lead-score lead-score-<?php echo esc_attr( $score_class ); ?>">
														<span class="score-value"><?php echo esc_html( $score ); ?></span>
														<div class="score-bar">
															<div class="score-fill" style="width: <?php echo esc_attr( $score ); ?>%;"></div>
														</div>
													</div>
												</td>
												<td>
													<strong><?php echo esc_html( get_post_meta( $submission->ID, '_full_name', true ) ); ?></strong>
												</td>
												<td>
													<a href="tel:<?php echo esc_attr( get_post_meta( $submission->ID, '_phone', true ) ); ?>" class="phone-link">
														<i class="fas fa-phone"></i> <?php echo esc_html( get_post_meta( $submission->ID, '_phone', true ) ); ?>
													</a>
												</td>
												<td>
													<?php
													$form_type = get_post_meta( $submission->ID, '_form_type', true );
													if ( $form_type === 'intermediaries' ) {
														echo '<span class="badge badge-green">' . esc_html__( 'وسطاء', 'ehtazem-elementor' ) . '</span>';
													} else {
														echo '<span class="badge badge-blue">' . esc_html__( 'تواصل', 'ehtazem-elementor' ) . '</span>';
													}
													?>
												</td>
												<td>
													<?php
													$status = get_post_meta( $submission->ID, '_status', true );
													$status = $status ? $status : 'new';
													$status_labels = [
														'new' => __( 'جديد', 'ehtazem-elementor' ),
														'in_progress' => __( 'قيد المعالجة', 'ehtazem-elementor' ),
														'completed' => __( 'مكتمل', 'ehtazem-elementor' ),
													];
													$status_classes = [
														'new' => 'badge-gold',
														'in_progress' => 'badge-orange',
														'completed' => 'badge-green',
													];
													?>
													<span class="badge <?php echo esc_attr( $status_classes[$status] ); ?>">
														<?php echo esc_html( $status_labels[$status] ); ?>
													</span>
												</td>
												<td>
													<?php echo esc_html( get_the_date( 'Y/m/d - H:i', $submission->ID ) ); ?>
												</td>
												<td>
													<div class="action-buttons">
														<a href="<?php echo esc_url( admin_url( 'post.php?post=' . $submission->ID . '&action=edit' ) ); ?>" class="btn-action btn-view" title="<?php esc_attr_e( 'عرض', 'ehtazem-elementor' ); ?>">
															<i class="fas fa-eye"></i>
														</a>
														<a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=ehtazem-dashboard&action=mark_in_progress&id=' . $submission->ID ), 'ehtazem_quick_action' ) ); ?>" class="btn-action btn-progress" title="<?php esc_attr_e( 'قيد المعالجة', 'ehtazem-elementor' ); ?>">
															<i class="fas fa-clock"></i>
														</a>
														<a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=ehtazem-dashboard&action=mark_completed&id=' . $submission->ID ), 'ehtazem_quick_action' ) ); ?>" class="btn-action btn-complete" title="<?php esc_attr_e( 'مكتمل', 'ehtazem-elementor' ); ?>">
															<i class="fas fa-check"></i>
														</a>
													</div>
												</td>
											</tr>
										<?php endforeach; ?>
									<?php else : ?>
										<tr>
											<td colspan="7" class="no-data">
												<i class="fas fa-inbox"></i>
												<p><?php esc_html_e( 'لا توجد طلبات حتى الآن', 'ehtazem-elementor' ); ?></p>
											</td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<!-- PUIUX Footer -->
			<div class="ehtazem-admin-footer">
				<div class="footer-content">
					<div class="footer-left">
						<img src="https://puiux.com/wp-content/uploads/2021/09/Logo-Black-Copress.svg" alt="PUIUX" class="footer-logo">
						<p><?php esc_html_e( 'مطور بواسطة PUIUX', 'ehtazem-elementor' ); ?></p>
					</div>
					<div class="footer-right">
						<p><?php esc_html_e( '© 2025 PUIUX. جميع الحقوق محفوظة', 'ehtazem-elementor' ); ?></p>
						<p>
							<a href="https://puiux.com" target="_blank">puiux.com</a> |
							<a href="mailto:Welcome@puiux.com">Welcome@puiux.com</a> |
							<a href="tel:+966544420258">+966 544420258</a>
						</p>
					</div>
				</div>
			</div>
		</div>

		<script>
			// Chart Data
			var chartData = <?php echo wp_json_encode( $chart_data ); ?>;
		</script>
		<?php
	}

	/**
	 * Get Statistics
	 */
	private function get_statistics() {
		$args = [
			'post_type' => 'ehtazem_submissions',
			'posts_per_page' => -1,
			'post_status' => 'publish',
		];

		$submissions = get_posts( $args );

		$stats = [
			'total' => count( $submissions ),
			'hot_leads' => 0,
			'completed' => 0,
			'pending' => 0,
		];

		foreach ( $submissions as $submission ) {
			$score = $this->calculate_lead_score( $submission->ID );
			if ( $score >= 70 ) {
				$stats['hot_leads']++;
			}

			$status = get_post_meta( $submission->ID, '_status', true );
			if ( $status === 'completed' ) {
				$stats['completed']++;
			} elseif ( $status === 'in_progress' ) {
				$stats['pending']++;
			}
		}

		return $stats;
	}

	/**
	 * Get Recent Submissions
	 */
	private function get_recent_submissions( $limit = 10 ) {
		$args = [
			'post_type' => 'ehtazem_submissions',
			'posts_per_page' => $limit,
			'post_status' => 'publish',
			'orderby' => 'date',
			'order' => 'DESC',
		];

		// Apply filters
		$meta_query = [];

		if ( isset( $_GET['filter_status'] ) && ! empty( $_GET['filter_status'] ) ) {
			$meta_query[] = [
				'key' => '_status',
				'value' => sanitize_text_field( $_GET['filter_status'] ),
				'compare' => '=',
			];
		}

		if ( isset( $_GET['filter_type'] ) && ! empty( $_GET['filter_type'] ) ) {
			$meta_query[] = [
				'key' => '_form_type',
				'value' => sanitize_text_field( $_GET['filter_type'] ),
				'compare' => '=',
			];
		}

		if ( ! empty( $meta_query ) ) {
			$args['meta_query'] = $meta_query;
		}

		// Date filters
		if ( isset( $_GET['filter_date_from'] ) && ! empty( $_GET['filter_date_from'] ) ) {
			$args['date_query'][] = [
				'after' => sanitize_text_field( $_GET['filter_date_from'] ),
				'inclusive' => true,
			];
		}

		if ( isset( $_GET['filter_date_to'] ) && ! empty( $_GET['filter_date_to'] ) ) {
			$args['date_query'][] = [
				'before' => sanitize_text_field( $_GET['filter_date_to'] ),
				'inclusive' => true,
			];
		}

		return get_posts( $args );
	}

	/**
	 * Calculate Lead Score
	 *
	 * Scoring Rules:
	 * - Mentions "investment" or "استثمار": +20
	 * - Mentions amount/budget: +25
	 * - Saudi phone: +15
	 * - Company email (not gmail): +10
	 * - Wants meeting: +20
	 * - From target city: +10
	 */
	public function calculate_lead_score( $post_id ) {
		$score = 0;

		// Get submission data
		$details = get_post_meta( $post_id, '_details', true );
		$question = get_post_meta( $post_id, '_question', true );
		$phone = get_post_meta( $post_id, '_phone', true );
		$company = get_post_meta( $post_id, '_company', true );
		$region = get_post_meta( $post_id, '_region', true );

		$content = $details . ' ' . $question;

		// Check for investment mentions
		if ( preg_match( '/(استثمار|investment|invest)/i', $content ) ) {
			$score += 20;
		}

		// Check for budget/amount mentions
		if ( preg_match( '/(ريال|دولار|مليون|ألف|budget|price|cost|amount|\d{4,})/i', $content ) ) {
			$score += 25;
		}

		// Check Saudi phone
		if ( preg_match( '/^(05|5|\\+9665|009665)/i', $phone ) ) {
			$score += 15;
		}

		// Check company (not personal email)
		if ( ! empty( $company ) ) {
			$score += 10;
		}

		// Check for meeting request
		if ( preg_match( '/(اجتماع|لقاء|موعد|meeting|appointment)/i', $content ) ) {
			$score += 20;
		}

		// Check target cities
		$target_cities = [ 'الرياض', 'riyadh', 'جدة', 'jeddah', 'الدمام', 'dammam' ];
		foreach ( $target_cities as $city ) {
			if ( stripos( $region, $city ) !== false || stripos( $content, $city ) !== false ) {
				$score += 10;
				break;
			}
		}

		// Ensure score is between 0 and 100
		$score = min( 100, max( 0, $score ) );

		return $score;
	}

	/**
	 * Get Chart Data
	 */
	private function get_chart_data() {
		$days = 30;
		$data = [];

		for ( $i = $days - 1; $i >= 0; $i-- ) {
			$date = date( 'Y-m-d', strtotime( "-{$i} days" ) );

			$args = [
				'post_type' => 'ehtazem_submissions',
				'posts_per_page' => -1,
				'post_status' => 'publish',
				'date_query' => [
					[
						'year' => date( 'Y', strtotime( $date ) ),
						'month' => date( 'm', strtotime( $date ) ),
						'day' => date( 'd', strtotime( $date ) ),
					],
				],
			];

			$count = count( get_posts( $args ) );

			$data['labels'][] = date( 'M j', strtotime( $date ) );
			$data['values'][] = $count;
		}

		return $data;
	}

	/**
	 * Handle Quick Actions
	 */
	public function handle_quick_actions() {
		if ( ! isset( $_GET['action'] ) || ! isset( $_GET['id'] ) || ! isset( $_GET['page'] ) || $_GET['page'] !== 'ehtazem-dashboard' ) {
			return;
		}

		// Verify nonce
		if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'ehtazem_quick_action' ) ) {
			wp_die( __( 'خطأ في التحقق من الأمان', 'ehtazem-elementor' ) );
		}

		$action = sanitize_text_field( $_GET['action'] );
		$post_id = intval( $_GET['id'] );

		switch ( $action ) {
			case 'mark_in_progress':
				update_post_meta( $post_id, '_status', 'in_progress' );
				break;
			case 'mark_completed':
				update_post_meta( $post_id, '_status', 'completed' );
				break;
		}

		wp_redirect( admin_url( 'admin.php?page=ehtazem-dashboard' ) );
		exit;
	}

	/**
	 * Export to CSV
	 */
	public function export_to_csv() {
		// Check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'ليس لديك صلاحية لتصدير البيانات', 'ehtazem-elementor' ) );
		}

		// Verify nonce
		check_ajax_referer( 'ehtazem_admin_nonce', 'nonce' );

		$args = [
			'post_type' => 'ehtazem_submissions',
			'posts_per_page' => -1,
			'post_status' => 'publish',
		];

		$submissions = get_posts( $args );

		// Set headers for CSV download
		header( 'Content-Type: text/csv; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=ehtazem-submissions-' . date( 'Y-m-d' ) . '.csv' );
		header( 'Pragma: no-cache' );
		header( 'Expires: 0' );

		// Create output stream
		$output = fopen( 'php://output', 'w' );

		// Add BOM for UTF-8
		fprintf( $output, chr(0xEF).chr(0xBB).chr(0xBF) );

		// CSV headers
		fputcsv( $output, [
			'التقييم',
			'الاسم',
			'الهاتف',
			'الشركة',
			'المنطقة',
			'نوع النموذج',
			'الحالة',
			'التفاصيل',
			'التاريخ',
		] );

		// CSV data
		foreach ( $submissions as $submission ) {
			$score = $this->calculate_lead_score( $submission->ID );
			$status = get_post_meta( $submission->ID, '_status', true );
			$status = $status ? $status : 'new';

			fputcsv( $output, [
				$score,
				get_post_meta( $submission->ID, '_full_name', true ),
				get_post_meta( $submission->ID, '_phone', true ),
				get_post_meta( $submission->ID, '_company', true ),
				get_post_meta( $submission->ID, '_region', true ),
				get_post_meta( $submission->ID, '_form_type', true ),
				$status,
				get_post_meta( $submission->ID, '_details', true ) . ' ' . get_post_meta( $submission->ID, '_question', true ),
				get_the_date( 'Y-m-d H:i:s', $submission->ID ),
			] );
		}

		fclose( $output );
		exit;
	}

	/**
	 * Get Lead Score Distribution
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function get_lead_score_distribution() {
		// Get all submissions
		$args = array(
			'post_type' => 'ehtazem_submissions',
			'posts_per_page' => -1,
			'post_status' => 'publish',
		);

		$submissions = get_posts( $args );

		$hot = 0;
		$warm = 0;
		$cold = 0;

		foreach ( $submissions as $submission ) {
			$score = $this->calculate_lead_score( $submission->ID );
			if ( $score >= 70 ) {
				$hot++;
			} elseif ( $score >= 40 ) {
				$warm++;
			} else {
				$cold++;
			}
		}

		return array(
			'labels' => array( 'عملاء مهمين (70+)', 'عملاء محتملين (40-69)', 'عملاء عاديين (0-39)' ),
			'data' => array( $hot, $warm, $cold ),
			'backgroundColor' => array( '#EF4444', '#F59E0B', '#10B981' )
		);
	}

	/**
	 * Get Submission Type Distribution
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function get_submission_type_distribution() {
		// Get all submissions
		$args = array(
			'post_type' => 'ehtazem_submissions',
			'posts_per_page' => -1,
			'post_status' => 'publish',
		);

		$submissions = get_posts( $args );

		$intermediaries = 0;
		$contact = 0;

		foreach ( $submissions as $submission ) {
			$form_type = get_post_meta( $submission->ID, '_form_type', true );
			if ( $form_type === 'intermediaries' ) {
				$intermediaries++;
			} else {
				$contact++;
			}
		}

		return array(
			'labels' => array( 'نموذج الوسطاء', 'نموذج التواصل' ),
			'data' => array( $intermediaries, $contact ),
			'backgroundColor' => array( '#1E40AF', '#F59E0B' )
		);
	}

	/**
	 * Get Status Distribution
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function get_status_distribution() {
		// Get all submissions
		$args = array(
			'post_type' => 'ehtazem_submissions',
			'posts_per_page' => -1,
			'post_status' => 'publish',
		);

		$submissions = get_posts( $args );

		$new = 0;
		$in_progress = 0;
		$completed = 0;

		foreach ( $submissions as $submission ) {
			$status = get_post_meta( $submission->ID, '_status', true );
			if ( $status == 'completed' ) {
				$completed++;
			} elseif ( $status == 'in_progress' ) {
				$in_progress++;
			} else {
				$new++;
			}
		}

		return array(
			'labels' => array( 'جديد', 'قيد المعالجة', 'مكتمل' ),
			'data' => array( $new, $in_progress, $completed ),
			'backgroundColor' => array( '#3B82F6', '#F59E0B', '#10B981' )
		);
	}
}
