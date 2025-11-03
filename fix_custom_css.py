#!/usr/bin/env python3
"""
Fix Custom CSS section for all widgets
"""

import re
import os

WIDGETS = [
    'class-widget-about-carousel.php',
    'class-widget-approach.php',
    'class-widget-coming-soon.php',
    'class-widget-faq.php',
    'class-widget-features.php',
    'class-widget-footer.php',
    'class-widget-org-structure.php',
    'class-widget-partners.php',
    'class-widget-services.php',
    'class-widget-vision.php',
]

CUSTOM_CSS_SECTION = '''
\t\t// Advanced Section for Custom CSS
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

\t\t$this->end_controls_section();
'''

def add_custom_css_section(file_path):
    """Add Custom CSS section to a widget file"""

    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()

    # Check if already has custom CSS
    if 'custom_css_section' in content:
        print(f"⚠️  {os.path.basename(file_path)} already has Custom CSS section")
        return False

    # Find the closing brace of register_controls() method
    # Look for the pattern: last end_controls_section() before the closing brace and render() method
    pattern = r'(\$this->end_controls_section\(\);)(\s*\})\s*(\/\*\*[^}]*?protected function render\(\))'

    match = re.search(pattern, content, re.DOTALL)

    if match:
        # Insert Custom CSS section before the closing brace
        content = content[:match.end(1)] + CUSTOM_CSS_SECTION + '\n\t' + match.group(2) + '\n\n\t' + match.group(3)

        with open(file_path, 'w', encoding='utf-8') as f:
            f.write(content)

        print(f"✅ Added Custom CSS section to {os.path.basename(file_path)}")
        return True
    else:
        print(f"❌ Could not find insertion point in {os.path.basename(file_path)}")
        return False

def main():
    print("="*60)
    print("Adding Custom CSS Section to Widgets")
    print("="*60)
    print()

    base_path = '/home/user/ehtazem/ehtazem-elementor-widgets/includes/widgets/'
    success_count = 0

    for widget_file in WIDGETS:
        file_path = os.path.join(base_path, widget_file)
        if os.path.exists(file_path):
            if add_custom_css_section(file_path):
                success_count += 1
        else:
            print(f"❌ File not found: {widget_file}")

    print()
    print("="*60)
    print(f"Summary: {success_count}/{len(WIDGETS)} widgets updated")
    print("="*60)

if __name__ == '__main__':
    main()
