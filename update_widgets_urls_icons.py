#!/usr/bin/env python3
"""
Script to update URL controls and add Icon Pickers for remaining widgets
"""

import re
import os

def update_footer_widget():
    """Update Footer widget with URL controls and Icon Picker"""
    file_path = '/home/user/ehtazem/ehtazem-elementor-widgets/includes/widgets/class-widget-footer.php'

    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()

    # Update social URL controls to include is_external and nofollow
    patterns = [
        # Instagram URL
        (r"(\$this->add_control\(\s*'instagram_url',\s*\[\s*'label'[^]]+\]\s*=>\s*esc_html__\('Instagram URL',\s*'ehtazem-elementor-widgets'\),\s*'type'\s*=>\s*\\Elementor\\Controls_Manager::URL,)\s*('dynamic' => \['active' => true\],\s*)?'default'\s*=>\s*\[\s*'url'\s*=>\s*'#',\s*\],",
         r"\1\n\t\t\t\t'dynamic' => ['active' => true],\n\t\t\t\t'placeholder' => esc_html__('https://your-link.com', 'ehtazem-elementor-widgets'),\n\t\t\t\t'default' => [\n\t\t\t\t\t'url' => '#',\n\t\t\t\t\t'is_external' => true,\n\t\t\t\t\t'nofollow' => true,\n\t\t\t\t],"),
        # Meta URL
        (r"(\$this->add_control\(\s*'meta_url',\s*\[\s*'label'[^]]+\]\s*=>\s*esc_html__\('Meta URL',\s*'ehtazem-elementor-widgets'\),\s*'type'\s*=>\s*\\Elementor\\Controls_Manager::URL,)\s*('dynamic' => \['active' => true\],\s*)?'default'\s*=>\s*\[\s*'url'\s*=>\s*'#',\s*\],",
         r"\1\n\t\t\t\t'dynamic' => ['active' => true],\n\t\t\t\t'placeholder' => esc_html__('https://your-link.com', 'ehtazem-elementor-widgets'),\n\t\t\t\t'default' => [\n\t\t\t\t\t'url' => '#',\n\t\t\t\t\t'is_external' => true,\n\t\t\t\t\t'nofollow' => true,\n\t\t\t\t],"),
        # LinkedIn URL
        (r"(\$this->add_control\(\s*'linkedin_url',\s*\[\s*'label'[^]]+\]\s*=>\s*esc_html__\('LinkedIn URL',\s*'ehtazem-elementor-widgets'\),\s*'type'\s*=>\s*\\Elementor\\Controls_Manager::URL,)\s*('dynamic' => \['active' => true\],\s*)?'default'\s*=>\s*\[\s*'url'\s*=>\s*'#',\s*\],",
         r"\1\n\t\t\t\t'dynamic' => ['active' => true],\n\t\t\t\t'placeholder' => esc_html__('https://your-link.com', 'ehtazem-elementor-widgets'),\n\t\t\t\t'default' => [\n\t\t\t\t\t'url' => '#',\n\t\t\t\t\t'is_external' => true,\n\t\t\t\t\t'nofollow' => true,\n\t\t\t\t],"),
        # Google URL
        (r"(\$this->add_control\(\s*'google_url',\s*\[\s*'label'[^]]+\]\s*=>\s*esc_html__\('Google URL',\s*'ehtazem-elementor-widgets'\),\s*'type'\s*=>\s*\\Elementor\\Controls_Manager::URL,)\s*('dynamic' => \['active' => true\],\s*)?'default'\s*=>\s*\[\s*'url'\s*=>\s*'#',\s*\],",
         r"\1\n\t\t\t\t'dynamic' => ['active' => true],\n\t\t\t\t'placeholder' => esc_html__('https://your-link.com', 'ehtazem-elementor-widgets'),\n\t\t\t\t'default' => [\n\t\t\t\t\t'url' => '#',\n\t\t\t\t\t'is_external' => true,\n\t\t\t\t\t'nofollow' => true,\n\t\t\t\t],"),
        # Twitter URL
        (r"(\$this->add_control\(\s*'twitter_url',\s*\[\s*'label'[^]]+\]\s*=>\s*esc_html__\('Twitter URL',\s*'ehtazem-elementor-widgets'\),\s*'type'\s*=>\s*\\Elementor\\Controls_Manager::URL,)\s*('dynamic' => \['active' => true\],\s*)?'default'\s*=>\s*\[\s*'url'\s*=>\s*'#',\s*\],",
         r"\1\n\t\t\t\t'dynamic' => ['active' => true],\n\t\t\t\t'placeholder' => esc_html__('https://your-link.com', 'ehtazem-elementor-widgets'),\n\t\t\t\t'default' => [\n\t\t\t\t\t'url' => '#',\n\t\t\t\t\t'is_external' => true,\n\t\t\t\t\t'nofollow' => true,\n\t\t\t\t],"),
    ]

    for pattern, replacement in patterns:
        content = re.sub(pattern, replacement, content, flags=re.DOTALL)

    # Add button arrow icon control after contact_button_link
    if 'button_arrow_icon' not in content:
        pattern = r"(\$this->add_control\(\s*'contact_button_link',\s*\[[^\]]+\][\s\S]*?\);)"
        replacement = r"\1\n\n\t\t$this->add_control(\n\t\t\t'button_arrow_icon',\n\t\t\t[\n\t\t\t\t'label' => esc_html__('Button Arrow Icon', 'ehtazem-elementor-widgets'),\n\t\t\t\t'type' => \\Elementor\\Controls_Manager::ICONS,\n\t\t\t\t'default' => [\n\t\t\t\t\t'value' => 'fas fa-arrow-left',\n\t\t\t\t\t'library' => 'fa-solid',\n\t\t\t\t],\n\t\t\t]\n\t\t);"
        content = re.sub(pattern, replacement, content, flags=re.DOTALL)

    # Update render method to use link attributes
    # Add link attributes setup in render method
    render_setup = '''
\t\t// Setup link attributes
\t\tif ( ! empty( $settings['instagram_url']['url'] ) ) {
\t\t\t$this->add_link_attributes( 'instagram_url_attr', $settings['instagram_url'] );
\t\t}
\t\tif ( ! empty( $settings['meta_url']['url'] ) ) {
\t\t\t$this->add_link_attributes( 'meta_url_attr', $settings['meta_url'] );
\t\t}
\t\tif ( ! empty( $settings['linkedin_url']['url'] ) ) {
\t\t\t$this->add_link_attributes( 'linkedin_url_attr', $settings['linkedin_url'] );
\t\t}
\t\tif ( ! empty( $settings['google_url']['url'] ) ) {
\t\t\t$this->add_link_attributes( 'google_url_attr', $settings['google_url'] );
\t\t}
\t\tif ( ! empty( $settings['twitter_url']['url'] ) ) {
\t\t\t$this->add_link_attributes( 'twitter_url_attr', $settings['twitter_url'] );
\t\t}
\t\tif ( ! empty( $settings['contact_button_link']['url'] ) ) {
\t\t\t$this->add_link_attributes( 'contact_button_link_attr', $settings['contact_button_link'] );
\t\t}
'''

    if 'instagram_url_attr' not in content:
        # Add after inline editing attributes
        pattern = r"(\$this->add_inline_editing_attributes\( 'made_by_text', 'none' \);)\s*\?>"
        replacement = r"\1" + render_setup + "\n\t\t?>"
        content = re.sub(pattern, replacement, content, flags=re.DOTALL)

    # Update social links in render
    patterns_render = [
        (r'<a class="social-icon" href="<\?php echo esc_url\(\$settings\[\'instagram_url\'\]\[\'url\'\]\); \?>" aria-label="Instagram">',
         r'<a class="social-icon" <?php echo $this->get_render_attribute_string( \'instagram_url_attr\' ); ?> aria-label="Instagram">'),
        (r'<a class="social-icon" href="<\?php echo esc_url\(\$settings\[\'meta_url\'\]\[\'url\'\]\); \?>" aria-label="Meta">',
         r'<a class="social-icon" <?php echo $this->get_render_attribute_string( \'meta_url_attr\' ); ?> aria-label="Meta">'),
        (r'<a class="social-icon center" href="<\?php echo esc_url\(\$settings\[\'linkedin_url\'\]\[\'url\'\]\); \?>" aria-label="LinkedIn">',
         r'<a class="social-icon center" <?php echo $this->get_render_attribute_string( \'linkedin_url_attr\' ); ?> aria-label="LinkedIn">'),
        (r'<a class="social-icon google-icon" href="<\?php echo esc_url\(\$settings\[\'google_url\'\]\[\'url\'\]\); \?>" aria-label="Google">',
         r'<a class="social-icon google-icon" <?php echo $this->get_render_attribute_string( \'google_url_attr\' ); ?> aria-label="Google">'),
        (r'<a class="social-icon twitter-icon" href="<\?php echo esc_url\(\$settings\[\'twitter_url\'\]\[\'url\'\]\); \?>" aria-label="Twitter">',
         r'<a class="social-icon twitter-icon" <?php echo $this->get_render_attribute_string( \'twitter_url_attr\' ); ?> aria-label="Twitter">'),
        (r'<a class="footer-contact-btn" href="<\?php echo esc_url\(\$settings\[\'contact_button_link\'\]\[\'url\'\]\); \?>">',
         r'<a class="footer-contact-btn" <?php echo $this->get_render_attribute_string( \'contact_button_link_attr\' ); ?>>'),
        (r'<i class="fa-solid fa-arrow-left arrow-join-head arrow-hero-down"></i>',
         r'<?php \\Elementor\\Icons_Manager::render_icon( $settings[\'button_arrow_icon\'], [ \'aria-hidden\' => \'true\', \'class\' => \'arrow-join-head arrow-hero-down\' ] ); ?>'),
    ]

    for pattern, replacement in patterns_render:
        content = re.sub(pattern, replacement, content)

    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(content)

    print("✅ Updated Footer widget")

def main():
    print("="*60)
    print("Updating URL Controls and Icon Pickers")
    print("="*60)
    print()

    update_footer_widget()

    print()
    print("="*60)
    print("Update completed!")
    print("="*60)

if __name__ == '__main__':
    main()
