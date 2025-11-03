# Form Widgets - دليل الاستخدام

## نظرة عامة
تم إنشاء نظام Form Widgets متكامل مع نظام submissions كامل لمشروع احتزم.

**Development, Design & Programming by PUIUX**
© 2025 PUIUX. All rights reserved.

---

## الملفات المنشأة

### 1. Intermediaries Form Widget
📁 **الموقع:** `/home/user/ehtazem/ehtazem-elementor-widgets/includes/widgets/class-widget-intermediaries-form.php`

**الحقول:**
- ✅ الاسم بالكامل (text, required)
- ✅ رقم الهاتف (tel, required, min 10 digits)
- ⚪ اسم الشركة (text, optional)
- ⚪ المنطقة (text, optional)
- ⚪ تفاصيل العرض العقاري (textarea, optional)

**المميزات:**
- عنوان القسم: "بوابة الوسطاء" + "ضع عرضك الآن"
- نسبة الاستثمار: "استثمر مع احتزم" + "50%+"
- SVG curve مع gradient
- صورة decoration
- Client-side validation
- AJAX submission
- رسائل نجاح/خطأ بالعربية
- تحكم Elementor كامل بجميع النصوص والألوان

---

### 2. Contact Form Widget
📁 **الموقع:** `/home/user/ehtazem/ehtazem-elementor-widgets/includes/widgets/class-widget-contact-form.php`

**الحقول:**
- ✅ الإسم بالكامل (text, ID: fullName, required)
- ✅ رقم الهاتف (tel, ID: phone, required, min 10 digits)
- ✅ السؤال (textarea, ID: question, required)

**المميزات:**
- Badge: "تواصل معنا"
- عنوان: "انضم إلى احتزم وكن جزءًا من النجاحات المليارية"
- وصف
- صور decoration (علوية وسفلية)
- Client-side validation
- AJAX submission
- Focus/blur effects
- تحكم Elementor كامل

---

## نظام Submissions

### Custom Post Type
📊 **اسم Post Type:** `ehtazem_submissions`

**الـ Metadata المحفوظة:**
- `_form_type` → نوع النموذج (intermediaries / contact)
- `_full_name` → الاسم الكامل
- `_phone` → رقم الهاتف
- `_company` → اسم الشركة (للوسطاء فقط)
- `_region` → المنطقة (للوسطاء فقط)
- `_details` → تفاصيل العرض (للوسطاء فقط)
- `_question` → السؤال (للتواصل فقط)

### Admin Columns
تم إضافة أعمدة مخصصة في لوحة التحكم:
- ✅ الاسم
- ✅ نوع النموذج (badge ملون)
- ✅ رقم الهاتف
- ✅ الشركة
- ✅ التاريخ

---

## AJAX Handler

### Function: `handle_form_submission()`
📁 **الموقع:** `/home/user/ehtazem/ehtazem-elementor-widgets/ehtazem-elementor.php` (السطر 436)

**الوظائف:**
- ✅ Nonce verification للأمان
- ✅ Sanitization لكل البيانات
- ✅ Validation للحقول المطلوبة
- ✅ Phone number validation (10 digits minimum)
- ✅ إنشاء post جديد من نوع ehtazem_submissions
- ✅ حفظ metadata لكل الحقول
- ✅ رسائل JSON success/error

**AJAX Actions:**
- `wp_ajax_ehtazem_submit_form` → للمستخدمين المسجلين
- `wp_ajax_nopriv_ehtazem_submit_form` → للزوار

---

## Form Validation

### Client-side Validation (JavaScript)
```javascript
// التحقق من الحقول المطلوبة
if (fullName === '' || phone === '') {
    showMessage('من فضلك املأ جميع الحقول المطلوبة', 'error');
    return;
}

// التحقق من رقم الهاتف (10 أرقام على الأقل)
if (phone.length < 10) {
    showMessage('رقم الهاتف غير صحيح', 'error');
    return;
}
```

### Phone Number Formatting
```javascript
// السماح بالأرقام فقط
input.on('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
});
```

---

## CSS Styles

### Form Messages
تم إضافة styles للرسائل في `/home/user/ehtazem/ehtazem-elementor-widgets/assets/css/widgets.css`:

```css
.form-messages .alert-success → رسالة النجاح (خضراء)
.form-messages .alert-danger → رسالة الخطأ (حمراء)
```

### Required Indicator
```css
.form-label .required → علامة * حمراء للحقول المطلوبة
```

### Animations
- ✅ slideDown animation للرسائل
- ✅ Focus/blur effects للحقول
- ✅ Loading state للأزرار
- ✅ Transform animations

---

## Elementor Controls

### Content Controls
كل widget يحتوي على تحكمات محتوى كاملة:
- نص الشارة (Badge Text)
- العنوان (Title)
- الوصف (Description)
- نص زر الإرسال (Submit Button Text)
- الصور (Images)
- رسائل النموذج (Form Messages)

### Style Controls
تحكمات التنسيق الكاملة:
- ✅ Badge Style (لون النص، الخلفية، Typography)
- ✅ Title Style (لون، Typography)
- ✅ Description Style (لون، Typography)
- ✅ Form Style (خلفية النموذج، الحقول، التسميات)
- ✅ Button Style (خلفية، لون النص، Typography)

---

## كيفية الاستخدام

### 1. في Elementor Editor
1. افتح صفحة في Elementor
2. ابحث عن "احتزم - Ehtazem" في قائمة الـ widgets
3. اسحب "نموذج الوسطاء" أو "نموذج التواصل"
4. خصص المحتوى والألوان من لوحة التحكم

### 2. عرض الـ Submissions
1. اذهب إلى لوحة تحكم WordPress
2. ستجد قائمة جديدة "طلبات التواصل" (dashicons-email-alt)
3. شاهد جميع الطلبات مع الفلترة حسب النوع

### 3. البيانات المحفوظة
كل submission يتم حفظه كـ post جديد مع:
- Title: الاسم + رقم الهاتف
- Content: كل البيانات منسقة
- Metadata: كل الحقول محفوظة بشكل منفصل

---

## Security Features

### 1. Nonce Verification
```php
wp_verify_nonce( $_POST['nonce'], 'ehtazem_form_submission' )
```

### 2. Data Sanitization
- `sanitize_text_field()` للنصوص القصيرة
- `sanitize_textarea_field()` للنصوص الطويلة
- `esc_html()` للعرض
- `esc_url()` للروابط

### 3. Validation
- التحقق من الحقول المطلوبة
- التحقق من طول رقم الهاتف
- التحقق من نوع البيانات

---

## Performance Optimization

### 1. AJAX Submission
- لا يوجد page reload
- Fast submission
- Loading states

### 2. Conditional Loading
- الـ scripts تحمل فقط عند الحاجة
- No conflicts مع plugins أخرى

### 3. Database Optimization
- استخدام metadata بدلاً من serialized data
- Indexed fields للبحث السريع

---

## Testing Checklist

### Form Functionality
- [ ] تحميل النموذج بشكل صحيح
- [ ] Validation يعمل للحقول المطلوبة
- [ ] Phone validation (10 digits)
- [ ] AJAX submission بدون page reload
- [ ] رسائل النجاح تظهر بشكل صحيح
- [ ] رسائل الخطأ تظهر عند الفشل
- [ ] إعادة تعيين النموذج بعد الإرسال

### Admin Panel
- [ ] Post Type يظهر في القائمة
- [ ] Custom columns تعمل
- [ ] Badges ملونة للأنواع
- [ ] البيانات محفوظة بشكل صحيح
- [ ] البحث والفلترة يعملان

### Elementor Integration
- [ ] Widgets تظهر في فئة "احتزم"
- [ ] Controls تعمل بشكل صحيح
- [ ] Live preview يعمل
- [ ] التغييرات تحفظ بشكل صحيح

---

## Troubleshooting

### المشكلة: النموذج لا يرسل
**الحل:**
1. تحقق من تفعيل jQuery
2. تحقق من الـ nonce
3. افتح Console وتحقق من الأخطاء

### المشكلة: البيانات لا تحفظ
**الحل:**
1. تحقق من صلاحيات Database
2. تحقق من الـ AJAX URL
3. تحقق من الـ post type registration

### المشكلة: Validation لا يعمل
**الحل:**
1. تحقق من تحميل JavaScript
2. تحقق من الـ selectors
3. افتح Console وتحقق من الأخطاء

---

## Updates Log

### Version 1.0.0 - 2025-11-03
✅ إنشاء Intermediaries Form Widget
✅ إنشاء Contact Form Widget
✅ إضافة Custom Post Type للـ submissions
✅ إضافة AJAX handlers
✅ إضافة Client-side validation
✅ إضافة Admin columns
✅ إضافة CSS styles
✅ إضافة Security features

---

## Credits

**Development, Design & Programming by PUIUX**

© 2025 PUIUX. All rights reserved.

جميع الحقوق محفوظة لـ PUIUX
https://puiux.com

---

## Support

للدعم الفني أو الاستفسارات:
- 📧 Email: Welcome@puiux.com
- 🌐 Website: https://puiux.com
- 📱 Phone: +966 544420258
- 💬 WhatsApp: +966 544420258

---

**النظام جاهز للاستخدام بشكل كامل! 🎉**
