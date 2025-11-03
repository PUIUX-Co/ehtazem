<?php
/**
 * Login Page Customizer
 *
 * @package Ehtazem_Elementor_Widgets
 * @subpackage Admin
 */

if (!defined('ABSPATH')) {
    exit;
}

class Ehtazem_Login_Customizer {

    public function __construct() {
        add_action('login_enqueue_scripts', [$this, 'custom_login_styles']);
        add_filter('login_headerurl', [$this, 'custom_login_url']);
        add_filter('login_headertext', [$this, 'custom_login_title']);
        add_action('login_footer', [$this, 'custom_login_footer']);
    }

    public function custom_login_styles() {
        ?>
        <style>
        /* Import Cairo font */
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');

        body.login {
            background: linear-gradient(135deg, #1E40AF 0%, #0F172A 100%);
            font-family: 'Cairo', sans-serif !important;
            direction: rtl;
        }

        /* Login Form Container */
        #login {
            padding: 5% 0 0;
        }

        body.login div#login h1 a {
            background-image: url('https://puiux.com/wp-content/uploads/2021/09/Logo-Black-Copress.svg');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            width: 200px;
            height: 80px;
            padding: 0;
            margin: 0 auto 25px;
            display: block;
        }

        /* Form Styling */
        #loginform,
        #registerform,
        #lostpasswordform {
            background: #FFFFFF;
            border: none;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px;
            font-family: 'Cairo', sans-serif !important;
        }

        /* Input Fields */
        #loginform input[type="text"],
        #loginform input[type="password"],
        #loginform input[type="email"],
        #registerform input[type="text"],
        #registerform input[type="email"] {
            background: #F9FAFB;
            border: 2px solid #E5E7EB;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 16px;
            font-family: 'Cairo', sans-serif !important;
            transition: all 0.3s ease;
            direction: rtl;
        }

        #loginform input[type="text"]:focus,
        #loginform input[type="password"]:focus,
        #loginform input[type="email"]:focus {
            background: #FFFFFF;
            border-color: #1E40AF;
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
            outline: none;
        }

        /* Labels */
        #loginform label,
        #registerform label {
            color: #1F2937;
            font-weight: 600;
            font-size: 14px;
            font-family: 'Cairo', sans-serif !important;
            text-align: right;
            display: block;
            margin-bottom: 8px;
        }

        /* Submit Button */
        .wp-core-ui .button-primary {
            background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 100%);
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
            text-shadow: none;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            font-family: 'Cairo', sans-serif !important;
            height: auto;
            transition: all 0.3s ease;
            width: 100%;
        }

        .wp-core-ui .button-primary:hover,
        .wp-core-ui .button-primary:focus {
            background: linear-gradient(135deg, #1E3A8A 0%, #2563EB 100%);
            box-shadow: 0 6px 20px rgba(30, 64, 175, 0.4);
            transform: translateY(-2px);
        }

        /* Remember Me */
        .login #login_error,
        .login .message,
        .login .success {
            border-right: 4px solid #1E40AF;
            border-left: none;
            background: #FFFFFF;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 15px 20px;
            font-family: 'Cairo', sans-serif !important;
            text-align: right;
        }

        .login #login_error {
            border-right-color: #EF4444;
        }

        /* Links */
        #login a {
            color: #1E40AF;
            font-weight: 600;
            text-decoration: none;
            font-family: 'Cairo', sans-serif !important;
            transition: color 0.3s ease;
        }

        #login a:hover,
        #login a:focus {
            color: #3B82F6;
        }

        /* Footer Branding */
        #login-footer-branding {
            text-align: center;
            padding: 30px 0;
            color: #FFFFFF;
            font-family: 'Cairo', sans-serif !important;
        }

        #login-footer-branding img {
            height: 40px;
            margin-bottom: 15px;
            filter: brightness(0) invert(1);
        }

        #login-footer-branding p {
            font-size: 14px;
            margin: 5px 0;
            opacity: 0.9;
        }

        #login-footer-branding a {
            color: #FFFFFF;
            text-decoration: none;
            font-weight: 600;
            transition: opacity 0.3s ease;
        }

        #login-footer-branding a:hover {
            opacity: 0.8;
        }

        /* Responsive */
        @media (max-width: 480px) {
            #loginform,
            #registerform,
            #lostpasswordform {
                padding: 25px 20px;
            }

            body.login div#login h1 a {
                width: 150px;
                height: 60px;
            }
        }
        </style>
        <?php
    }

    public function custom_login_url() {
        return home_url();
    }

    public function custom_login_title() {
        return get_bloginfo('name') . ' - Powered by PUIUX';
    }

    public function custom_login_footer() {
        ?>
        <div id="login-footer-branding">
            <img src="https://puiux.com/wp-content/uploads/2021/09/Logo-Black-Copress.svg" alt="PUIUX">
            <p><strong>مطور بواسطة PUIUX</strong></p>
            <p>© <?php echo date('Y'); ?> PUIUX. جميع الحقوق محفوظة</p>
            <p>
                <a href="https://puiux.com" target="_blank">puiux.com</a> |
                <a href="mailto:Welcome@puiux.com">Welcome@puiux.com</a>
            </p>
        </div>
        <?php
    }
}
