## ehtazem → تحويل الواجهة إلى Elementor Widget

هذا الدليل يوضح كيفية تحويل الواجهة الحالية (HTML/CSS/JS) في هذا المشروع إلى ويدجت Elementor أصلية مع كامل التحكمات (Controls) مثل اللون، الخط، الصور، النصوص، الترتيب، وغيرها، وتغليفها كإضافة ووردبريس قابلة للتثبيت.

### المتطلبات
- ووردبريس 6.x أو أحدث
- Elementor 3.18+ (مجاني)، ويفضل دعم Elementor Pro إذا احتجت Dynamic Tags
- PHP 7.4+ (موصى به 8.0+)

### هيكلة الإضافة المقترحة
أنشئ مجلد إضافة جديد باسم `ehtazem-elementor` يحتوي:

```
ehtazem-elementor/
  ehtazem-elementor.php           // ملف الإضافة الرئيسي
  includes/
    class-plugin.php              // تهيئة الإضافة وتسجيل الودجات
    widgets/
      class-widget-ehtazem.php    // كود الودجت نفسه
  assets/
    css/
      widget.css                  // نسخ/دمج CSS من مجلد css الحالي
    js/
      widget.js                   // نسخ/دمج JS من مجلد js الحالي
    images/                       // إن لزم، من assets/images
```

### ملف الإضافة الرئيسي: ehtazem-elementor.php
```php
<?php
/**
 * Plugin Name: Ehtazem Elementor Widget
 * Description: تحويل واجهة ehtazem إلى ويدجت Elementor مع تحكمات كاملة.
 * Version: 1.0.0
 * Author: PUIUX-Co
 */

if (! defined('ABSPATH')) { exit; }

define('EHTAZEM_EL_PATH', plugin_dir_path(__FILE__));
define('EHTAZEM_EL_URL', plugin_dir_url(__FILE__));

require_once EHTAZEM_EL_PATH . 'includes/class-plugin.php';

add_action('plugins_loaded', function () {
    \EhtazemEl\Plugin::instance();
});
```

### تهيئة الإضافة وتسجيل الويدجت: includes/class-plugin.php
```php
<?php
namespace EhtazemEl;

if (! defined('ABSPATH')) { exit; }

class Plugin {
    private static $instance = null;

    public static function instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        add_action('wp_enqueue_scripts', [$this, 'register_assets']);
    }

    public function register_assets() {
        wp_register_style('ehtazem-widget', EHTAZEM_EL_URL . 'assets/css/widget.css', [], '1.0.0');
        wp_register_script('ehtazem-widget', EHTAZEM_EL_URL . 'assets/js/widget.js', ['jquery'], '1.0.0', true);
    }

    public function register_widgets(\Elementor\Widgets_Manager $widgets_manager) {
        require_once EHTAZEM_EL_PATH . 'includes/widgets/class-widget-ehtazem.php';
        $widgets_manager->register(new \EhtazemEl\Widgets\Widget_Ehtazem());
    }
}
```

### كود الويدجت: includes/widgets/class-widget-ehtazem.php
يوضح كيفية تعيين التحكمات وربطها بالواجهة. قم بمواءمة الحقول مع عناصر الواجهة الموجودة في `index.html` وملفات `css/` و`js/`.

```php
<?php
namespace EhtazemEl\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

if (! defined('ABSPATH')) { exit; }

class Widget_Ehtazem extends Widget_Base {
    public function get_name() { return 'ehtazem_widget'; }
    public function get_title() { return __('Ehtazem Widget', 'ehtazem'); }
    public function get_icon() { return 'eicon-layout-settings'; }
    public function get_categories() { return ['general']; }
    public function get_keywords() { return ['ehtazem', 'ui', 'section']; }
    public function get_style_depends() { return ['ehtazem-widget']; }
    public function get_script_depends() { return ['ehtazem-widget']; }

    protected function register_controls() {
        // مثال: تحكمات المحتوى الأساسية
        $this->start_controls_section('section_content', [
            'label' => __('المحتوى', 'ehtazem'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('heading_text', [
            'label' => __('العنوان', 'ehtazem'),
            'type' => Controls_Manager::TEXT,
            'default' => __('عنوان افتراضي', 'ehtazem'),
        ]);

        $this->add_control('description', [
            'label' => __('الوصف', 'ehtazem'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('نص وصفي افتراضي', 'ehtazem'),
            'rows' => 4,
        ]);

        // مثال: قائمة عناصر عبر Repeater إذا لديكم بطاقات/عناصر مكررة
        $repeater = new Repeater();
        $repeater->add_control('item_title', [
            'label' => __('عنوان العنصر', 'ehtazem'),
            'type' => Controls_Manager::TEXT,
            'default' => __('عنصر', 'ehtazem'),
        ]);
        $repeater->add_control('item_text', [
            'label' => __('نص العنصر', 'ehtazem'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('نص...', 'ehtazem'),
        ]);

        $this->add_control('items', [
            'label' => __('العناصر', 'ehtazem'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [],
        ]);

        $this->end_controls_section();

        // قسم النمط: ألوان، خلفيات، هوامش، حدود، تايبوجرافي
        $this->start_controls_section('section_style', [
            'label' => __('النمط العام', 'ehtazem'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('text_color', [
            'label' => __('لون النص', 'ehtazem'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .ehtazem-widget' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'typography',
            'selector' => '{{WRAPPER}} .ehtazem-widget',
        ]);

        $this->add_group_control(Group_Control_Background::get_type(), [
            'name' => 'background',
            'selector' => '{{WRAPPER}} .ehtazem-widget',
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            'name' => 'border',
            'selector' => '{{WRAPPER}} .ehtazem-widget',
        ]);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="ehtazem-widget">
            <div class="ehtazem-container">
                <h2 class="ehtazem-heading"><?php echo esc_html($settings['heading_text']); ?></h2>
                <p class="ehtazem-desc"><?php echo esc_html($settings['description']); ?></p>

                <?php if (! empty($settings['items'])): ?>
                    <div class="ehtazem-items">
                        <?php foreach ($settings['items'] as $item): ?>
                            <div class="ehtazem-item">
                                <h3 class="ehtazem-item-title"><?php echo esc_html($item['item_title']); ?></h3>
                                <div class="ehtazem-item-text"><?php echo esc_html($item['item_text']); ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
```

### ربط ملفات الستايل والسكربت
- انسخ محتوى المجلد `css/` إلى `assets/css/widget.css` (ادمج/عدّل المسارات إذا لزم)
- انسخ محتوى `js/` إلى `assets/js/widget.js` وعدّل أي محددات DOM لتتوافق مع بنية الويدجت (`.ehtazem-widget` كجذر)
- انسخ الصور من `assets/images` إن وجدت إلى `assets/images/` داخل الإضافة أو استعمل مكتبة وسائط ووردبريس عبر تحكمات صورة من Elementor

ملاحظات مهمة:
- استبدل أي معرفات/كلاسات عامة لتكون داخل نطاق `{{WRAPPER}} .ehtazem-widget ...` لمنع تضارب الأنماط
- إن كانت هناك تبعيات JS إضافية، سجّلها بأسماء مقبولة في `wp_register_script`

### تحويل HTML الحالي
- افتح `index.html`، استخرج القسم/الأقسام التي تمثل الواجهة النهائية
- حوّلها إلى هيكل HTML ضمن `render()` كما في المثال، واجعل النصوص/الصور/الروابط ديناميكية عبر التحكمات
- أي أقسام مكررة حوّلها إلى Repeater

### تحكمات إضافية شائعة
- نصوص وعناوين متعددة
- صور (Image) وشعارات (Media)
- أزرار (نص، رابط، استهداف، nofollow)
- ألوان وخلفيات لكل جزء (Group_Control_Background)
- تايبوجرافي للعناوين والنصوص (Group_Control_Typography)
- حواف وظلال (Border/Box Shadow)
- مسافات داخلية وخارجية (Dimensions) مع Responsive
- Toggle/Switches لعرض/إخفاء أجزاء

### التثبيت والتجربة
1) أنشئ مجلد `ehtazem-elementor` كما أعلاه وضع الملفات داخله
2) اضغط المجلد إلى ملف `ehtazem-elementor.zip`
3) من لوحة تحكم ووردبريس: إضافات → أضف جديد → رفع إضافة → اختر الملف وثبّت
4) فعّل الإضافة
5) افتح Elementor، ابحث عن "Ehtazem Widget" واسحبه إلى الصفحة

### أفضل الممارسات
- اجعل CSS محصورًا داخل `.ehtazem-widget`
- استخدم `esc_html`, `esc_url`, `wp_kses` عند الطباعة
- وفّر ترجمة عبر دوال `__()` ونطاق نصي `ehtazem`
- تأكد من عدم تعارض الأسماء مع إضافات أخرى

### خارطة عمل سريعة (Mapping)
- عناصر النص في `index.html` → `TEXT`/`TEXTAREA`
- الصور/الشعارات → `MEDIA`
- القوائم/البطاقات → `REPEATER`
- الألوان والخلفيات → `COLOR` + `Group_Control_Background`
- الخطوط → `Group_Control_Typography`
- الهوامش والمسافات → `DIMENSIONS` مع `selectors`

### ملاحظات حول الأداء
- ادمج الملفات وقلل حجم الصور
- حمّل السكربت في الـ footer (`true`) وفعّل `wp_enqueue_script` تلقائيًا عند وجود الويدجت فقط إذا رغبت بتحسين إضافي

### ماذا تبقى؟
- مواءمة دقيقة بين بنية HTML الحالية والتحكمات (أستطيع تنفيذها الآن لو زوّدتني بأجزاء الواجهة المطلوب تحويلها تحديدًا إن كانت تختلف عن `index.html`)

### مصدر الريبو
`https://github.com/PUIUX-Co/ehtazem`