#!/usr/bin/env python3
"""
Fix CSS Scoping for Ehtazem Widgets
This script adds proper scoping to prevent conflicts with themes/Elementor
"""

import re

def add_scope_to_selector(selector, scope='.ehtazem-widget-scope'):
    """Add scope prefix to a CSS selector"""
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
        parts = [add_scope_to_selector(p.strip(), scope) for p in selector.split(',')]
        return ', '.join(parts)

    # Handle pseudo-elements and pseudo-classes at root
    if selector.startswith('::') or selector.startswith(':'):
        return f'{scope} {selector}'

    # Handle element selectors
    if selector in ['html', 'body']:
        return scope

    if selector == '*':
        return f'{scope} *'

    # Add scope prefix
    return f'{scope} {selector}'

def scope_css_file(input_file, output_file, scope_class='.ehtazem-widget-scope'):
    """Process CSS file and add scoping"""

    with open(input_file, 'r', encoding='utf-8') as f:
        css = f.read()

    result = f"""/* ==================================================
   EHTAZEM WIDGETS - FULLY ISOLATED STYLES
   Original CSS from: {input_file}
   Scoped to: {scope_class}
   This prevents ALL conflicts with WordPress themes and Elementor
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
                # Add scope to selector
                scoped_selector = add_scope_to_selector(selector, scope_class)
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

# Process the CSS
input_css = '/home/user/ehtazem/css/style.css'
output_css = '/home/user/ehtazem/ehtazem-elementor-widgets/assets/css/widgets-final.css'

size = scope_css_file(input_css, output_css)

print(f"✅ CSS Scoping Complete!")
print(f"   Input:  {input_css}")
print(f"   Output: {output_css}")
print(f"   Size:   {size:,} bytes")
print(f"\nAll styles now scoped to .ehtazem-widget-scope")
print("This prevents conflicts with themes and Elementor!")
