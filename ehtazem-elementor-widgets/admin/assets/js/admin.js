/**
 * PUIUX - Ehtazem Elementor Widgets
 * Admin Panel JavaScript
 *
 * Interactive functionality for admin pages
 * Developed by PUIUX for Ehtazem
 */

(function($) {
	'use strict';

	// Admin object
	const EhtazemAdmin = {
		// Initialize
		init: function() {
			this.initCharts();
			this.initColorPickers();
			this.initImageUpload();
			this.initNotifications();
			this.initAOS();
			this.initFormValidation();
		},

		/**
		 * Initialize Charts
		 */
		initCharts: function() {
			if (typeof Chart === 'undefined' || !$('#ehtazem-submissions-chart').length) {
				return;
			}

			const ctx = document.getElementById('ehtazem-submissions-chart').getContext('2d');

			// Get data from PHP
			const chartData = typeof window.chartData !== 'undefined' ? window.chartData : {
				labels: [],
				values: []
			};

			// Create gradient
			const gradient = ctx.createLinearGradient(0, 0, 0, 400);
			gradient.addColorStop(0, 'rgba(30, 64, 175, 0.2)');
			gradient.addColorStop(1, 'rgba(30, 64, 175, 0)');

			new Chart(ctx, {
				type: 'line',
				data: {
					labels: chartData.labels,
					datasets: [{
						label: 'الطلبات',
						data: chartData.values,
						borderColor: '#1E40AF',
						backgroundColor: gradient,
						borderWidth: 3,
						fill: true,
						tension: 0.4,
						pointBackgroundColor: '#1E40AF',
						pointBorderColor: '#fff',
						pointBorderWidth: 2,
						pointRadius: 5,
						pointHoverRadius: 7
					}]
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					plugins: {
						legend: {
							display: true,
							position: 'top',
							align: 'end',
							labels: {
								font: {
									family: 'Cairo',
									size: 14,
									weight: '600'
								},
								padding: 15,
								usePointStyle: true
							}
						},
						tooltip: {
							backgroundColor: 'rgba(0, 0, 0, 0.8)',
							titleFont: {
								family: 'Cairo',
								size: 14
							},
							bodyFont: {
								family: 'Cairo',
								size: 13
							},
							padding: 12,
							borderColor: '#1E40AF',
							borderWidth: 1,
							displayColors: false
						}
					},
					scales: {
						y: {
							beginAtZero: true,
							ticks: {
								font: {
									family: 'Cairo',
									size: 12
								},
								stepSize: 1
							},
							grid: {
								color: 'rgba(0, 0, 0, 0.05)'
							}
						},
						x: {
							ticks: {
								font: {
									family: 'Cairo',
									size: 12
								}
							},
							grid: {
								display: false
							}
						}
					}
				}
			});

			// Chart period selector
			$('#ehtazem-chart-period').on('change', function() {
				// In a real implementation, this would reload the chart data
				EhtazemAdmin.showNotification('جاري تحديث البيانات...', 'info');
			});
		},

		/**
		 * Initialize Color Pickers
		 */
		initColorPickers: function() {
			$('.ehtazem-color-picker').on('change', function() {
				const $picker = $(this);
				const $value = $picker.siblings('.color-value');
				$value.text($picker.val());

				// Update preview swatches
				const id = $picker.attr('id');
				if (id === 'primary_color') {
					$('.preview-swatches .swatch:nth-child(1)').css('background-color', $picker.val());
				} else if (id === 'secondary_color') {
					$('.preview-swatches .swatch:nth-child(2)').css('background-color', $picker.val());
				} else if (id === 'accent_color') {
					$('.preview-swatches .swatch:nth-child(3)').css('background-color', $picker.val());
				}
			});
		},

		/**
		 * Initialize Image Upload
		 */
		initImageUpload: function() {
			const $uploadArea = $('#upload-area');
			const $fileInput = $('#image-file');

			// Drag and drop
			$uploadArea.on('dragover', function(e) {
				e.preventDefault();
				$(this).addClass('drag-over');
			});

			$uploadArea.on('dragleave', function() {
				$(this).removeClass('drag-over');
			});

			$uploadArea.on('drop', function(e) {
				e.preventDefault();
				$(this).removeClass('drag-over');

				const files = e.originalEvent.dataTransfer.files;
				if (files.length > 0) {
					$fileInput[0].files = files;
					EhtazemAdmin.handleImageUpload(files[0]);
				}
			});

			// File input change
			$fileInput.on('change', function() {
				if (this.files.length > 0) {
					EhtazemAdmin.handleImageUpload(this.files[0]);
				}
			});

			// Form submit
			$('#ehtazem-upload-form').on('submit', function(e) {
				e.preventDefault();
				const files = $fileInput[0].files;
				if (files.length > 0) {
					EhtazemAdmin.handleImageUpload(files[0]);
				}
			});
		},

		/**
		 * Handle Image Upload
		 */
		handleImageUpload: function(file) {
			// Validate file type
			const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg+xml', 'image/webp'];
			if (!validTypes.includes(file.type)) {
				this.showNotification('نوع الملف غير مسموح به', 'error');
				return;
			}

			// Validate file size (5MB)
			if (file.size > 5242880) {
				this.showNotification('حجم الملف كبير جداً (الحد الأقصى 5 ميجابايت)', 'error');
				return;
			}

			const formData = new FormData();
			formData.append('action', 'ehtazem_upload_image');
			formData.append('nonce', $('#upload_nonce').val());
			formData.append('image_file', file);
			formData.append('image_category', $('#image-category').val());

			// Show loading
			this.showNotification('جاري رفع الصورة...', 'info');

			$.ajax({
				url: ajaxurl,
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function(response) {
					if (response.success) {
						EhtazemAdmin.showNotification(response.data.message, 'success');
						// Reload page after 1 second
						setTimeout(function() {
							location.reload();
						}, 1000);
					} else {
						EhtazemAdmin.showNotification(response.data.message, 'error');
					}
				},
				error: function() {
					EhtazemAdmin.showNotification('حدث خطأ أثناء رفع الصورة', 'error');
				}
			});
		},

		/**
		 * Initialize Notifications
		 */
		initNotifications: function() {
			// Check for WordPress admin notices and convert them
			$('.notice.notice-success, .notice.notice-error, .notice.notice-warning').each(function() {
				const $notice = $(this);
				const message = $notice.find('p').text();
				const type = $notice.hasClass('notice-success') ? 'success' :
							 $notice.hasClass('notice-error') ? 'error' : 'warning';

				EhtazemAdmin.showNotification(message, type);
				$notice.remove();
			});
		},

		/**
		 * Show Notification
		 */
		showNotification: function(message, type = 'success') {
			const icons = {
				success: 'fa-check-circle',
				error: 'fa-times-circle',
				warning: 'fa-exclamation-triangle',
				info: 'fa-info-circle'
			};

			const $notification = $('<div>', {
				class: `ehtazem-notification ${type}`,
				html: `
					<i class="fas ${icons[type]}"></i>
					<span>${message}</span>
				`
			});

			$('body').append($notification);

			setTimeout(function() {
				$notification.fadeOut(300, function() {
					$(this).remove();
				});
			}, 3000);
		},

		/**
		 * Initialize AOS (Animate On Scroll)
		 */
		initAOS: function() {
			if (typeof AOS !== 'undefined') {
				AOS.init({
					duration: 600,
					easing: 'ease-out-cubic',
					once: true,
					offset: 50
				});
			}
		},

		/**
		 * Initialize Form Validation
		 */
		initFormValidation: function() {
			$('.ehtazem-form').on('submit', function() {
				const $form = $(this);
				const $requiredFields = $form.find('[required]');
				let valid = true;

				$requiredFields.each(function() {
					const $field = $(this);
					if (!$field.val()) {
						$field.addClass('error');
						valid = false;
					} else {
						$field.removeClass('error');
					}
				});

				if (!valid) {
					EhtazemAdmin.showNotification('الرجاء ملء جميع الحقول المطلوبة', 'error');
					return false;
				}
			});

			// Remove error class on input
			$('.ehtazem-form input, .ehtazem-form textarea, .ehtazem-form select').on('input change', function() {
				$(this).removeClass('error');
			});
		}
	};

	/**
	 * Global Functions
	 */

	// Export to CSV
	window.ehtazem_export_csv = function() {
		const nonce = $('#ehtazem_admin_nonce').val();

		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'ehtazem_export_csv',
				nonce: nonce
			},
			success: function(response) {
				if (response.success) {
					// Create download link
					const blob = new Blob([response.data], { type: 'text/csv' });
					const url = window.URL.createObjectURL(blob);
					const a = document.createElement('a');
					a.href = url;
					a.download = `ehtazem-submissions-${new Date().toISOString().split('T')[0]}.csv`;
					document.body.appendChild(a);
					a.click();
					document.body.removeChild(a);
					window.URL.revokeObjectURL(url);

					EhtazemAdmin.showNotification('تم تصدير البيانات بنجاح', 'success');
				} else {
					EhtazemAdmin.showNotification('حدث خطأ أثناء التصدير', 'error');
				}
			},
			error: function() {
				EhtazemAdmin.showNotification('حدث خطأ أثناء التصدير', 'error');
			}
		});
	};

	// Clear Cache
	window.ehtazem_clear_cache = function() {
		if (!confirm('هل أنت متأكد من مسح التخزين المؤقت؟')) {
			return;
		}

		const nonce = $('input[name="_wpnonce"]').val();

		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'ehtazem_clear_cache',
				nonce: nonce
			},
			success: function(response) {
				if (response.success) {
					EhtazemAdmin.showNotification(response.data.message, 'success');
				} else {
					EhtazemAdmin.showNotification('حدث خطأ', 'error');
				}
			}
		});
	};

	// Regenerate CSS
	window.ehtazem_regenerate_css = function() {
		const nonce = $('input[name="_wpnonce"]').val();

		EhtazemAdmin.showNotification('جاري إعادة بناء CSS...', 'info');

		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'ehtazem_regenerate_css',
				nonce: nonce
			},
			success: function(response) {
				if (response.success) {
					EhtazemAdmin.showNotification(response.data.message, 'success');
				} else {
					EhtazemAdmin.showNotification('حدث خطأ', 'error');
				}
			}
		});
	};

	// Reset Settings
	window.ehtazem_reset_settings = function() {
		if (!confirm('هل أنت متأكد من إعادة تعيين جميع الإعدادات؟ هذا الإجراء لا يمكن التراجع عنه!')) {
			return;
		}

		const nonce = $('input[name="_wpnonce"]').val();

		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'ehtazem_reset_settings',
				nonce: nonce
			},
			success: function(response) {
				if (response.success) {
					EhtazemAdmin.showNotification(response.data.message, 'success');
					setTimeout(function() {
						location.reload();
					}, 2000);
				} else {
					EhtazemAdmin.showNotification('حدث خطأ', 'error');
				}
			}
		});
	};

	// Export Debug Log
	window.ehtazem_export_debug_log = function() {
		window.location.href = ajaxurl + '?action=ehtazem_export_debug_log&nonce=' + $('input[name="_wpnonce"]').val();
	};

	// Test Widget Performance
	window.ehtazem_test_widget_performance = function() {
		const nonce = $('input[name="_wpnonce"]').val();

		EhtazemAdmin.showNotification('جاري اختبار أداء الودجات...', 'info');

		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'ehtazem_test_widget_performance',
				nonce: nonce
			},
			success: function(response) {
				if (response.success) {
					EhtazemAdmin.showNotification('تم الاختبار بنجاح', 'success');
					EhtazemAdmin.displayPerformanceResults(response.data.results);
				} else {
					EhtazemAdmin.showNotification('حدث خطأ', 'error');
				}
			}
		});
	};

	// Display Performance Results
	EhtazemAdmin.displayPerformanceResults = function(results) {
		$('#performance-results').show();

		if (typeof Chart === 'undefined') {
			return;
		}

		const ctx = document.getElementById('performance-chart').getContext('2d');
		const labels = results.map(r => r.name);
		const data = results.map(r => r.time);
		const colors = results.map(r => r.status === 'good' ? '#10B981' : '#F59E0B');

		new Chart(ctx, {
			type: 'bar',
			data: {
				labels: labels,
				datasets: [{
					label: 'وقت التحميل (ميلي ثانية)',
					data: data,
					backgroundColor: colors,
					borderWidth: 0
				}]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				plugins: {
					legend: {
						display: false
					}
				},
				scales: {
					y: {
						beginAtZero: true,
						ticks: {
							font: {
								family: 'Cairo'
							}
						}
					},
					x: {
						ticks: {
							font: {
								family: 'Cairo',
								size: 11
							}
						}
					}
				}
			}
		});
	};

	// Reset Colors
	window.ehtazem_reset_colors = function() {
		if (!confirm('هل تريد إعادة تعيين الألوان للقيم الافتراضية؟')) {
			return;
		}

		$('#primary_color').val('#1E40AF').trigger('change');
		$('#secondary_color').val('#F59E0B').trigger('change');
		$('#accent_color').val('#10B981').trigger('change');

		EhtazemAdmin.showNotification('تم إعادة تعيين الألوان', 'success');
	};

	// View Image
	window.ehtazem_view_image = function(url) {
		const $modal = $('#image-preview-modal');
		$modal.find('#preview-image').attr('src', url);
		$modal.fadeIn(300);
	};

	// Close Modal
	window.ehtazem_close_modal = function() {
		$('#image-preview-modal').fadeOut(300);
	};

	// Copy URL
	window.ehtazem_copy_url = function(url) {
		const $temp = $('<input>');
		$('body').append($temp);
		$temp.val(url).select();
		document.execCommand('copy');
		$temp.remove();

		EhtazemAdmin.showNotification('تم نسخ الرابط', 'success');
	};

	// Preview Email
	window.ehtazem_preview_email = function(templateType) {
		// Get template content
		const subject = $('input[name="email_subject"]').val();
		const body = typeof tinyMCE !== 'undefined' && tinyMCE.get('email_body')
			? tinyMCE.get('email_body').getContent()
			: $('textarea[name="email_body"]').val();

		// Create preview window
		const previewWindow = window.open('', 'Email Preview', 'width=800,height=600');
		previewWindow.document.write(`
			<!DOCTYPE html>
			<html dir="rtl">
			<head>
				<meta charset="UTF-8">
				<title>${subject}</title>
				<style>
					body {
						font-family: Arial, sans-serif;
						padding: 20px;
						background: #f5f5f5;
					}
					.preview-header {
						background: #fff;
						padding: 15px;
						border-bottom: 2px solid #1E40AF;
						margin-bottom: 20px;
					}
					.preview-content {
						background: #fff;
						padding: 20px;
					}
				</style>
			</head>
			<body>
				<div class="preview-header">
					<strong>الموضوع:</strong> ${subject}
				</div>
				<div class="preview-content">
					${body}
				</div>
			</body>
			</html>
		`);
		previewWindow.document.close();
	};

	// Send Test Email
	window.ehtazem_send_test_email = function(templateType) {
		const testEmail = prompt('أدخل البريد الإلكتروني لإرسال الاختبار:', '');

		if (!testEmail) {
			return;
		}

		// Validate email
		const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
		if (!emailRegex.test(testEmail)) {
			EhtazemAdmin.showNotification('البريد الإلكتروني غير صحيح', 'error');
			return;
		}

		const nonce = $('input[name="_wpnonce"]').val();

		EhtazemAdmin.showNotification('جاري إرسال البريد التجريبي...', 'info');

		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'ehtazem_send_test_email',
				nonce: nonce,
				template_type: templateType,
				test_email: testEmail
			},
			success: function(response) {
				if (response.success) {
					EhtazemAdmin.showNotification(response.data.message, 'success');
				} else {
					EhtazemAdmin.showNotification(response.data.message, 'error');
				}
			},
			error: function() {
				EhtazemAdmin.showNotification('حدث خطأ أثناء الإرسال', 'error');
			}
		});
	};

	// Close modal on Escape key
	$(document).on('keydown', function(e) {
		if (e.key === 'Escape') {
			ehtazem_close_modal();
		}
	});

	// Initialize on document ready
	$(document).ready(function() {
		EhtazemAdmin.init();
	});

})(jQuery);
