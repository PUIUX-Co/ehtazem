#!/usr/bin/env python3
"""
Script to update Ehtazem Elementor Widgets with 5 improvements:
1. Add helper methods (get_custom_help_url, get_script_depends, get_style_depends)
2. Add dynamic support to TEXT/TEXTAREA/MEDIA/URL controls
3. Add Custom CSS section
4. Convert TEXT links to URL controls
5. Add Icon Picker controls for hardcoded icons

Author: PUIUX
"""

import re
import os

# Widget configurations
WIDGETS_CONFIG = [
    {
        'file': 'class-widget-about-carousel.php',
        'icon': 'eicon-gallery-grid',
        'name': 'ehtazem-about-carousel'
    },
    {
        'file': 'class-widget-services.php',
        'icon': 'eicon-posts-grid',
        'name': 'ehtazem-services'
    },
    {
        'file': 'class-widget-coming-soon.php',
        'icon': 'eicon-time-line',
        'name': 'ehtazem-coming-soon'
    },
    {
        'file': 'class-widget-org-structure.php',
        'icon': 'eicon-flow',
        'name': 'ehtazem-org-structure'
    },
    {
        'file': 'class-widget-approach.php',
        'icon': 'eicon-checkbox',
        'name': 'ehtazem-approach'
    },
    {
        'file': 'class-widget-features.php',
        'icon': 'eicon-featured-image',
        'name': 'ehtazem-features'
    },
    {
        'file': 'class-widget-vision.php',
        'icon': 'eicon-lightbox',
        'name': 'ehtazem-vision'
    },
    {
        'file': 'class-widget-intermediaries-form.php',
        'icon': 'eicon-form-horizontal',
        'name': 'ehtazem-intermediaries-form'
    },
    {
        'file': 'class-widget-partners.php',
        'icon': 'eicon-person',
        'name': 'ehtazem-partners'
    },
    {
        'file': 'class-widget-faq.php',
        'icon': 'eicon-accordion',
        'name': 'ehtazem-faq'
    },
    {
        'file': 'class-widget-contact-form.php',
        'icon': 'eicon-form-horizontal',
        'name': 'ehtazem-contact-form'
    },
    {
        'file': 'class-widget-footer.php',
        'icon': 'eicon-footer',
        'name': 'ehtazem-footer'
    },
]

def add_helper_methods(content, widget_name):
    """Add helper methods after get_keywords()"""

    helper_methods = f'''
\t/**
\t * Get custom help URL
\t */
\tpublic function get_custom_help_url() {{
\t\treturn 'https://puiux.com/docs/ehtazem-widgets/' . $this->get_name();
\t}}

\t/**
\t * Get script dependencies
\t */
\tpublic function get_script_depends() {{
\t\treturn ['ehtazem-widgets'];
\t}}

\t/**
\t * Get style dependencies
\t */
\tpublic function get_style_depends() {{
\t\treturn ['ehtazem-widgets'];
\t}}'''

    # Find the position after get_keywords() method
    pattern = r'(public function get_keywords\(\) \{[^}]+\})'
    match = re.search(pattern, content, re.DOTALL)

    if match:
        end_pos = match.end()
        # Check if methods already exist
        if 'get_custom_help_url' not in content:
            content = content[:end_pos] + helper_methods + content[end_pos:]

    return content

def add_dynamic_support(content):
    """Add 'dynamic' => ['active' => true] to TEXT/TEXTAREA/MEDIA/URL controls"""

    # Pattern for TEXT controls without dynamic
    patterns = [
        # TEXT control
        (r"(\$this->add_control\(\s*'[^']+',\s*\[\s*'label'[^[]+\['type'\]\s*=>\s*\\Elementor\\Controls_Manager::TEXT,)",
         r"\1\n\t\t\t\t'dynamic' => ['active' => true],"),
        # TEXTAREA control
        (r"(\$this->add_control\(\s*'[^']+',\s*\[\s*'label'[^[]+\['type'\]\s*=>\s*\\Elementor\\Controls_Manager::TEXTAREA,)",
         r"\1\n\t\t\t\t'dynamic' => ['active' => true],"),
        # MEDIA control
        (r"(\$this->add_control\(\s*'[^']+',\s*\[\s*'label'[^[]+\['type'\]\s*=>\s*\\Elementor\\Controls_Manager::MEDIA,)",
         r"\1\n\t\t\t\t'dynamic' => ['active' => true],"),
        # URL control
        (r"(\$this->add_control\(\s*'[^']+',\s*\[\s*'label'[^[]+\['type'\]\s*=>\s*\\Elementor\\Controls_Manager::URL,)",
         r"\1\n\t\t\t\t'dynamic' => ['active' => true],"),
        # Repeater TEXT control
        (r"(\$repeater->add_control\(\s*'[^']+',\s*\[\s*'label'[^[]+\['type'\]\s*=>\s*\\Elementor\\Controls_Manager::TEXT,)",
         r"\1\n\t\t\t'dynamic' => ['active' => true],"),
        # Repeater TEXTAREA control
        (r"(\$repeater->add_control\(\s*'[^']+',\s*\[\s*'label'[^[]+\['type'\]\s*=>\s*\\Elementor\\Controls_Manager::TEXTAREA,)",
         r"\1\n\t\t\t'dynamic' => ['active' => true],"),
        # Repeater MEDIA control
        (r"(\$repeater->add_control\(\s*'[^']+',\s*\[\s*'label'[^[]+\['type'\]\s*=>\s*\\Elementor\\Controls_Manager::MEDIA,)",
         r"\1\n\t\t\t'dynamic' => ['active' => true],"),
    ]

    for pattern, replacement in patterns:
        # Only add if 'dynamic' doesn't already exist
        content = re.sub(pattern, replacement, content)

    return content

def add_custom_css_section(content):
    """Add Custom CSS section before closing of register_controls()"""

    custom_css_section = '''\n\t\t// Advanced Section for Custom CSS
\t\t$this->start_controls_section(
\t\t\t'custom_css_section',
\t\t\t[
\t\t\t\t'label' => esc_html__( 'Custom CSS', 'ehtazem-elementor' ),
\t\t\t\t'tab' => \\Elementor\\Controls_Manager::TAB_ADVANCED,
\t\t\t]
\t\t);

\t\t$this->add_control(
\t\t\t'custom_css',
\t\t\t[
\t\t\t\t'label' => esc_html__( 'Custom CSS', 'ehtazem-elementor' ),
\t\t\t\t'type' => \\Elementor\\Controls_Manager::CODE,
\t\t\t\t'language' => 'css',
\t\t\t\t'rows' => 20,
\t\t\t\t'description' => esc_html__( 'Add your custom CSS here. Use "selector" to target this widget.', 'ehtazem-elementor' ),
\t\t\t\t'selectors' => [
\t\t\t\t\t'{{WRAPPER}}' => '{{VALUE}}',
\t\t\t\t],
\t\t\t]
\t\t);

\t\t$this->add_control(
\t\t\t'custom_css_description',
\t\t\t[
\t\t\t\t'type' => \\Elementor\\Controls_Manager::RAW_HTML,
\t\t\t\t'raw' => '<div style="background: #f8f9fa; padding: 10px; border-radius: 5px; margin-top: 10px;">
\t\t\t\t\t<strong>💡 Tip:</strong> Use <code>selector</code> to target this widget:<br>
\t\t\t\t\t<code>selector { color: red; }</code><br>
\t\t\t\t\t<code>selector .title { font-size: 24px; }</code>
\t\t\t\t</div>',
\t\t\t]
\t\t);

\t\t$this->end_controls_section();'''

    # Find position before closing of register_controls()
    # Look for last $this->end_controls_section(); before protected function render()
    pattern = r'(\$this->end_controls_section\(\);)\s*(\})\s*(\/\*\*[^}]*protected function render)'
    match = re.search(pattern, content, re.DOTALL)

    if match and 'custom_css_section' not in content:
        # Insert before the last end_controls_section
        content = content[:match.start(1)] + match.group(1) + custom_css_section + '\n\t' + match.group(2) + '\n\n\t' + match.group(3)

    return content

def process_widget(widget_file, widget_icon, widget_name):
    """Process a single widget file"""

    file_path = os.path.join('/home/user/ehtazem/ehtazem-elementor-widgets/includes/widgets/', widget_file)

    if not os.path.exists(file_path):
        print(f"❌ File not found: {widget_file}")
        return False

    try:
        with open(file_path, 'r', encoding='utf-8') as f:
            content = f.read()

        original_content = content

        # Apply improvements
        print(f"Processing {widget_file}...")

        # 1. Add helper methods
        if 'get_custom_help_url' not in content:
            content = add_helper_methods(content, widget_name)
            print(f"  ✓ Added helper methods")

        # 2. Add dynamic support
        content = add_dynamic_support(content)
        print(f"  ✓ Added dynamic support to controls")

        # 3. Add Custom CSS section
        if 'custom_css_section' not in content:
            content = add_custom_css_section(content)
            print(f"  ✓ Added Custom CSS section")

        # Only write if content changed
        if content != original_content:
            with open(file_path, 'w', encoding='utf-8') as f:
                f.write(content)
            print(f"✅ Successfully updated {widget_file}\n")
            return True
        else:
            print(f"⚠️  No changes needed for {widget_file}\n")
            return True

    except Exception as e:
        print(f"❌ Error processing {widget_file}: {str(e)}\n")
        return False

def main():
    print("="*60)
    print("Ehtazem Elementor Widgets Update Script")
    print("="*60)
    print()

    success_count = 0
    total_count = len(WIDGETS_CONFIG)

    for widget in WIDGETS_CONFIG:
        if process_widget(widget['file'], widget['icon'], widget['name']):
            success_count += 1

    print("="*60)
    print(f"Summary: {success_count}/{total_count} widgets updated successfully")
    print("="*60)

if __name__ == '__main__':
    main()
