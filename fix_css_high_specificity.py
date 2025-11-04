#!/usr/bin/env python3
"""
Fix CSS Scoping with HIGH SPECIFICITY for Ehtazem Widgets
This script adds STRONG scoping to override Elementor's dynamic CSS
"""

import re

def add_high_specificity_scope(selector, scope='.ehtazem-widget-scope'):
    """
    Add ULTRA HIGH specificity scope to override Elementor's generated CSS

    We repeat the scope class 5 times to increase specificity:
    .ehtazem-widget-scope.ehtazem-widget-scope.ehtazem-widget-scope.ehtazem-widget-scope.ehtazem-widget-scope

    This makes our selectors MUCH stronger than Elementor's:
    .elementor-109 .elementor-element.elementor-element-abc .title (4 classes)
    vs
    .ehtazem-widget-scope x5 .title (6 classes) ✅ STRONGER!
    """
    selector = selector.strip()

    # Skip certain selectors
    if (selector.startswith('@') or
        selector.startswith(':root') or
        not selector or
        selector == '{'):
        return selector

    # Already scoped
    if scope in selector:
        return selector

    # Handle multiple selectors (comma-separated)
    if ',' in selector:
        parts = [add_high_specificity_scope(p.strip(), scope) for p in selector.split(',')]
        return ', '.join(parts)

    # Create 5x repeated scope for ULTRA HIGH specificity
    ultra_scope = scope * 5

    # Handle pseudo-elements and pseudo-classes at root
    if selector.startswith('::') or selector.startswith(':'):
        return f'{ultra_scope} {selector}'

    # Handle element selectors
    if selector in ['html', 'body']:
        return ultra_scope

    if selector == '*':
        return f'{ultra_scope} *'

    # Add 5X REPEATED scope prefix for ULTRA HIGH SPECIFICITY
    # This ensures our styles are MUCH stronger than Elementor's dynamic CSS
    return f'{ultra_scope} {selector}'

def scope_css_file_high_specificity(input_file, output_file, scope_class='.ehtazem-widget-scope'):
    """Process CSS file and add HIGH SPECIFICITY scoping"""

    with open(input_file, 'r', encoding='utf-8') as f:
        css = f.read()

    result = f"""/* ==================================================
   EHTAZEM WIDGETS - ULTRA MEGA HIGH SPECIFICITY STYLES
   Original CSS from: {input_file}
   Scoped to: {scope_class} x5 (repeated 5 times!)

   This ULTRA HIGH SPECIFICITY prevents Elementor's dynamic CSS from overriding our styles!

   Example of Elementor's CSS (4 classes):
   .elementor-109 .elementor-element.elementor-element-cbe4bec .aboutUs-title
   Specificity: 0,0,4,0

   Our CSS (6 classes = MUCH STRONGER):
   {scope_class}{scope_class}{scope_class}{scope_class}{scope_class} .aboutUs-title
   Specificity: 0,0,6,0  ✅ WINS!

   ================================================== */

/* Global CSS Variables - Safe to keep global */
:root {{
    --primary-color: #D7B261;
    --secondary-color: #0B6D55;
    --tertiary-color: #00402E;
    --quaternary-color: #000000;
    --quinary-color: #FFFFFF;
    --gradient-color: linear-gradient(45.53deg, #857540 -37.94%, #D7B261 73.48%);
}}

"""

    # Remove :root block from original
    css = re.sub(r':root\s*\{[^}]+\}', '', css, flags=re.DOTALL)

    # Split into lines and process
    lines = css.split('\n')
    in_rule = False
    in_media_query = False
    media_depth = 0

    for line in lines:
        stripped = line.strip()

        # Track @ rules (media queries, keyframes, etc.)
        if stripped.startswith('@'):
            result += line + '\n'
            if '{' in line:
                in_media_query = True
                media_depth = 1
            continue

        if in_media_query:
            media_depth += line.count('{') - line.count('}')
            if media_depth == 0:
                in_media_query = False

        # Check if this is a selector line (ends with { or contains {)
        if '{' in line and not in_rule:
            # Extract selector
            parts = line.split('{')
            selector = parts[0].strip()

            # Don't scope media queries and keyframes
            if not in_media_query or media_depth > 1:
                # Add HIGH SPECIFICITY scope to selector
                scoped_selector = add_high_specificity_scope(selector, scope_class)
                result += f'{scoped_selector} {{\n'
            else:
                result += line + '\n'

            # Check if rule ends on same line
            if '}' in line:
                in_rule = False
            else:
                in_rule = True
        elif '}' in line:
            result += line + '\n'
            in_rule = False
        else:
            result += line + '\n'

    # Write output
    with open(output_file, 'w', encoding='utf-8') as f:
        f.write(result)

    return len(result)

# Process the CSS with HIGH SPECIFICITY
input_css = '/home/user/ehtazem/css/style.css'
output_css = '/home/user/ehtazem/ehtazem-elementor-widgets/assets/css/widgets.css'

print("🔧 Applying HIGH SPECIFICITY CSS Scoping...")
print("   This will make our styles STRONGER than Elementor's dynamic CSS!")
print()

size = scope_css_file_high_specificity(input_css, output_css)

print(f"✅ HIGH SPECIFICITY CSS Scoping Complete!")
print(f"   Input:  {input_css}")
print(f"   Output: {output_css}")
print(f"   Size:   {size:,} bytes")
print(f"\n🎯 All styles now scoped to .ehtazem-widget-scope x5 (repeated 5 times!)")
print("   This is MUCH STRONGER than Elementor's selectors!")
print()
print("   📊 Specificity Comparison:")
print("   Elementor: .elementor-109 .elementor-element .aboutUs-title")
print("              Specificity: 0,0,4,0  ❌")
print()
print("   Our CSS:   .ehtazem-widget-scope x5 .aboutUs-title")
print("              Specificity: 0,0,6,0  ✅ WINS!")
print()
print("   💪 We are 50% stronger than Elementor's generated CSS!")
