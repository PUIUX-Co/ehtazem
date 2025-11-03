<?php
/**
 * Image Library Manager
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
 * Image Library Class
 *
 * Manages default images used in widgets
 */
class Ehtazem_Image_Library {

	/**
	 * Images directory path
	 */
	private $images_dir;

	/**
	 * Images directory URL
	 */
	private $images_url;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->images_dir = plugin_dir_path( dirname( __FILE__ ) ) . 'assets/images/';
		$this->images_url = plugin_dir_url( dirname( __FILE__ ) ) . 'assets/images/';

		add_action( 'admin_init', [ $this, 'handle_image_actions' ] );
		add_action( 'wp_ajax_ehtazem_upload_image', [ $this, 'handle_image_upload' ] );
	}

	/**
	 * Render Image Library Page
	 */
	public function render() {
		// Check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'ليس لديك صلاحية للوصول لهذه الصفحة', 'ehtazem-elementor' ) );
		}

		$images = $this->get_images();
		$categories = $this->categorize_images( $images );

		?>
		<div class="wrap ehtazem-admin-wrap">
			<div class="ehtazem-admin-header">
				<h1><?php esc_html_e( 'مكتبة الصور الافتراضية', 'ehtazem-elementor' ); ?></h1>
				<p class="description"><?php esc_html_e( 'إدارة الصور الافتراضية المستخدمة في الودجات', 'ehtazem-elementor' ); ?></p>
			</div>

			<!-- Upload Section -->
			<div class="ehtazem-upload-section" data-aos="fade-up">
				<div class="ehtazem-card">
					<div class="card-header">
						<h2><?php esc_html_e( 'رفع صورة جديدة', 'ehtazem-elementor' ); ?></h2>
					</div>
					<div class="card-body">
						<form id="ehtazem-upload-form" enctype="multipart/form-data">
							<?php wp_nonce_field( 'ehtazem_upload_image', 'upload_nonce' ); ?>

							<div class="upload-area" id="upload-area">
								<i class="fas fa-cloud-upload-alt"></i>
								<p><?php esc_html_e( 'اسحب الصورة هنا أو انقر للاختيار', 'ehtazem-elementor' ); ?></p>
								<input type="file" id="image-file" name="image_file" accept="image/*" style="display: none;">
								<button type="button" class="ehtazem-btn ehtazem-btn-primary" onclick="document.getElementById('image-file').click()">
									<i class="fas fa-folder-open"></i> <?php esc_html_e( 'اختر صورة', 'ehtazem-elementor' ); ?>
								</button>
							</div>

							<div class="form-group">
								<label for="image-category"><?php esc_html_e( 'التصنيف', 'ehtazem-elementor' ); ?></label>
								<select id="image-category" name="image_category" class="ehtazem-select">
									<option value="logos"><?php esc_html_e( 'شعارات', 'ehtazem-elementor' ); ?></option>
									<option value="icons"><?php esc_html_e( 'أيقونات', 'ehtazem-elementor' ); ?></option>
									<option value="decorations"><?php esc_html_e( 'زخارف', 'ehtazem-elementor' ); ?></option>
									<option value="backgrounds"><?php esc_html_e( 'خلفيات', 'ehtazem-elementor' ); ?></option>
									<option value="other"><?php esc_html_e( 'أخرى', 'ehtazem-elementor' ); ?></option>
								</select>
							</div>

							<button type="submit" class="ehtazem-btn ehtazem-btn-primary">
								<i class="fas fa-upload"></i> <?php esc_html_e( 'رفع الصورة', 'ehtazem-elementor' ); ?>
							</button>
						</form>
					</div>
				</div>
			</div>

			<!-- Statistics -->
			<div class="ehtazem-stats-grid" data-aos="fade-up" data-aos-delay="100">
				<div class="ehtazem-stat-card">
					<div class="stat-icon stat-icon-blue">
						<i class="fas fa-images"></i>
					</div>
					<div class="stat-content">
						<h3><?php echo esc_html( count( $images ) ); ?></h3>
						<p><?php esc_html_e( 'إجمالي الصور', 'ehtazem-elementor' ); ?></p>
					</div>
				</div>

				<div class="ehtazem-stat-card">
					<div class="stat-icon stat-icon-green">
						<i class="fas fa-file-image"></i>
					</div>
					<div class="stat-content">
						<h3><?php echo esc_html( $this->get_total_images_size( $images ) ); ?></h3>
						<p><?php esc_html_e( 'الحجم الكلي', 'ehtazem-elementor' ); ?></p>
					</div>
				</div>

				<div class="ehtazem-stat-card">
					<div class="stat-icon stat-icon-gold">
						<i class="fas fa-folder"></i>
					</div>
					<div class="stat-content">
						<h3><?php echo esc_html( count( $categories ) ); ?></h3>
						<p><?php esc_html_e( 'التصنيفات', 'ehtazem-elementor' ); ?></p>
					</div>
				</div>
			</div>

			<!-- Images Grid -->
			<?php foreach ( $categories as $category => $category_images ) : ?>
				<div class="ehtazem-image-category" data-aos="fade-up" data-aos-delay="200">
					<div class="ehtazem-card">
						<div class="card-header">
							<h2><?php echo esc_html( $this->get_category_label( $category ) ); ?></h2>
							<span class="badge badge-blue"><?php echo esc_html( count( $category_images ) ); ?> صور</span>
						</div>
						<div class="card-body">
							<div class="images-grid">
								<?php foreach ( $category_images as $image ) : ?>
									<div class="image-item">
										<div class="image-preview">
											<img src="<?php echo esc_url( $this->images_url . $image['name'] ); ?>" alt="<?php echo esc_attr( $image['name'] ); ?>">
											<div class="image-overlay">
												<button class="btn-action btn-view" onclick="ehtazem_view_image('<?php echo esc_url( $this->images_url . $image['name'] ); ?>')" title="<?php esc_attr_e( 'معاينة', 'ehtazem-elementor' ); ?>">
													<i class="fas fa-eye"></i>
												</button>
												<button class="btn-action btn-copy" onclick="ehtazem_copy_url('<?php echo esc_url( $this->images_url . $image['name'] ); ?>')" title="<?php esc_attr_e( 'نسخ الرابط', 'ehtazem-elementor' ); ?>">
													<i class="fas fa-copy"></i>
												</button>
												<a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=ehtazem-image-library&action=delete&image=' . urlencode( $image['name'] ) ), 'ehtazem_image_action' ) ); ?>" class="btn-action btn-delete" onclick="return confirm('هل أنت متأكد من حذف هذه الصورة؟')" title="<?php esc_attr_e( 'حذف', 'ehtazem-elementor' ); ?>">
													<i class="fas fa-trash"></i>
												</a>
											</div>
										</div>
										<div class="image-info">
											<h4><?php echo esc_html( $image['name'] ); ?></h4>
											<div class="image-meta">
												<span><i class="fas fa-ruler-combined"></i> <?php echo esc_html( $image['dimensions'] ); ?></span>
												<span><i class="fas fa-file"></i> <?php echo esc_html( $image['size'] ); ?></span>
											</div>
											<?php if ( ! empty( $image['used_in'] ) ) : ?>
												<div class="image-usage">
													<span class="usage-label"><?php esc_html_e( 'مستخدمة في:', 'ehtazem-elementor' ); ?></span>
													<?php foreach ( $image['used_in'] as $widget ) : ?>
														<span class="badge badge-green"><?php echo esc_html( $widget ); ?></span>
													<?php endforeach; ?>
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<!-- Image Preview Modal -->
		<div id="image-preview-modal" class="ehtazem-modal" style="display: none;">
			<div class="modal-overlay" onclick="ehtazem_close_modal()"></div>
			<div class="modal-content">
				<button class="modal-close" onclick="ehtazem_close_modal()">
					<i class="fas fa-times"></i>
				</button>
				<img id="preview-image" src="" alt="">
			</div>
		</div>
		<?php
	}

	/**
	 * Get Images
	 */
	private function get_images() {
		$images = [];

		if ( ! is_dir( $this->images_dir ) ) {
			return $images;
		}

		$files = scandir( $this->images_dir );

		foreach ( $files as $file ) {
			if ( $file === '.' || $file === '..' ) {
				continue;
			}

			$file_path = $this->images_dir . $file;

			if ( ! is_file( $file_path ) ) {
				continue;
			}

			$extension = strtolower( pathinfo( $file, PATHINFO_EXTENSION ) );
			$allowed_extensions = [ 'jpg', 'jpeg', 'png', 'gif', 'svg', 'webp' ];

			if ( ! in_array( $extension, $allowed_extensions ) ) {
				continue;
			}

			$size = filesize( $file_path );
			$dimensions = '';

			if ( $extension !== 'svg' ) {
				$image_info = @getimagesize( $file_path );
				if ( $image_info ) {
					$dimensions = $image_info[0] . ' × ' . $image_info[1];
				}
			}

			$images[] = [
				'name' => $file,
				'path' => $file_path,
				'url' => $this->images_url . $file,
				'size' => $this->format_size( $size ),
				'dimensions' => $dimensions,
				'extension' => $extension,
				'used_in' => $this->get_widget_usage( $file ),
			];
		}

		return $images;
	}

	/**
	 * Categorize Images
	 */
	private function categorize_images( $images ) {
		$categories = [
			'logos' => [],
			'icons' => [],
			'decorations' => [],
			'backgrounds' => [],
			'other' => [],
		];

		foreach ( $images as $image ) {
			$name = strtolower( $image['name'] );
			$category = 'other';

			if ( strpos( $name, 'logo' ) !== false || strpos( $name, 'ehtazem' ) !== false ) {
				$category = 'logos';
			} elseif ( strpos( $name, 'icon' ) !== false || in_array( $image['extension'], [ 'svg' ] ) ) {
				$category = 'icons';
			} elseif ( strpos( $name, 'ellipse' ) !== false || strpos( $name, 'group' ) !== false || strpos( $name, 'path' ) !== false ) {
				$category = 'decorations';
			} elseif ( strpos( $name, 'background' ) !== false || strpos( $name, 'bg' ) !== false ) {
				$category = 'backgrounds';
			}

			$categories[$category][] = $image;
		}

		// Remove empty categories
		foreach ( $categories as $key => $value ) {
			if ( empty( $value ) ) {
				unset( $categories[$key] );
			}
		}

		return $categories;
	}

	/**
	 * Get Category Label
	 */
	private function get_category_label( $category ) {
		$labels = [
			'logos' => __( 'شعارات', 'ehtazem-elementor' ),
			'icons' => __( 'أيقونات', 'ehtazem-elementor' ),
			'decorations' => __( 'عناصر زخرفية', 'ehtazem-elementor' ),
			'backgrounds' => __( 'خلفيات', 'ehtazem-elementor' ),
			'other' => __( 'أخرى', 'ehtazem-elementor' ),
		];

		return isset( $labels[$category] ) ? $labels[$category] : $category;
	}

	/**
	 * Get Widget Usage
	 */
	private function get_widget_usage( $filename ) {
		// Map images to widgets that use them
		$usage_map = [
			'ehtazemfooterlogo.svg' => [ 'Footer', 'Header' ],
			'image 1.png' => [ 'Hero' ],
			'image 2.png' => [ 'About Carousel' ],
			'cup.png' => [ 'Features' ],
			'ranking.png' => [ 'Features' ],
			'star.png' => [ 'Features' ],
		];

		return isset( $usage_map[$filename] ) ? $usage_map[$filename] : [];
	}

	/**
	 * Format File Size
	 */
	private function format_size( $bytes ) {
		if ( $bytes >= 1048576 ) {
			return number_format( $bytes / 1048576, 2 ) . ' MB';
		} elseif ( $bytes >= 1024 ) {
			return number_format( $bytes / 1024, 2 ) . ' KB';
		} else {
			return $bytes . ' B';
		}
	}

	/**
	 * Get Total Images Size
	 */
	private function get_total_images_size( $images ) {
		$total = 0;

		foreach ( $images as $image ) {
			if ( file_exists( $image['path'] ) ) {
				$total += filesize( $image['path'] );
			}
		}

		return $this->format_size( $total );
	}

	/**
	 * Handle Image Actions
	 */
	public function handle_image_actions() {
		if ( ! isset( $_GET['action'] ) || ! isset( $_GET['page'] ) || $_GET['page'] !== 'ehtazem-image-library' ) {
			return;
		}

		// Verify nonce
		if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'ehtazem_image_action' ) ) {
			wp_die( __( 'خطأ في التحقق من الأمان', 'ehtazem-elementor' ) );
		}

		$action = sanitize_text_field( $_GET['action'] );

		if ( $action === 'delete' && isset( $_GET['image'] ) ) {
			$filename = sanitize_file_name( urldecode( $_GET['image'] ) );
			$file_path = $this->images_dir . $filename;

			if ( file_exists( $file_path ) ) {
				unlink( $file_path );
			}

			wp_redirect( admin_url( 'admin.php?page=ehtazem-image-library' ) );
			exit;
		}
	}

	/**
	 * Handle Image Upload
	 */
	public function handle_image_upload() {
		// Check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( [ 'message' => __( 'ليس لديك صلاحية لرفع الصور', 'ehtazem-elementor' ) ] );
		}

		// Verify nonce
		check_ajax_referer( 'ehtazem_upload_image', 'nonce' );

		if ( ! isset( $_FILES['image_file'] ) ) {
			wp_send_json_error( [ 'message' => __( 'لم يتم اختيار ملف', 'ehtazem-elementor' ) ] );
		}

		$file = $_FILES['image_file'];

		// Check for upload errors
		if ( $file['error'] !== UPLOAD_ERR_OK ) {
			wp_send_json_error( [ 'message' => __( 'حدث خطأ أثناء رفع الملف', 'ehtazem-elementor' ) ] );
		}

		// Validate file type
		$allowed_types = [ 'image/jpeg', 'image/png', 'image/gif', 'image/svg+xml', 'image/webp' ];
		if ( ! in_array( $file['type'], $allowed_types ) ) {
			wp_send_json_error( [ 'message' => __( 'نوع الملف غير مسموح به', 'ehtazem-elementor' ) ] );
		}

		// Validate file size (max 5MB)
		if ( $file['size'] > 5242880 ) {
			wp_send_json_error( [ 'message' => __( 'حجم الملف كبير جداً (الحد الأقصى 5 ميجابايت)', 'ehtazem-elementor' ) ] );
		}

		// Generate unique filename
		$filename = sanitize_file_name( $file['name'] );
		$target_path = $this->images_dir . $filename;

		// Check if file already exists
		if ( file_exists( $target_path ) ) {
			$filename = time() . '-' . $filename;
			$target_path = $this->images_dir . $filename;
		}

		// Move uploaded file
		if ( move_uploaded_file( $file['tmp_name'], $target_path ) ) {
			wp_send_json_success( [
				'message' => __( 'تم رفع الصورة بنجاح', 'ehtazem-elementor' ),
				'filename' => $filename,
				'url' => $this->images_url . $filename,
			] );
		} else {
			wp_send_json_error( [ 'message' => __( 'فشل في حفظ الملف', 'ehtazem-elementor' ) ] );
		}
	}
}
