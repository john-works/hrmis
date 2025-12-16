# Quick Reference: Custom Styles

## Color Palette
```scss
// Primary Colors
$psc-blue:       #0a4a7a;      // Main brand color
$psc-dark:       #1a3d54;      // Dark variant
$psc-light-blue: #d1ecf1;      // Light variant
$psc-accent:     #ff6b35;      // Orange accent

// Status Colors
$success-color: #0a4a7a;       // Green (blue in this app)
$warning-color: #ffc107;       // Yellow
$danger-color:  #dc3545;       // Red
$dark-color:    #343a40;       // Dark gray
$light-color:   #f8fafc;       // Light gray
```

## Common CSS Classes

### Layout
- `.sidebar` - Left sidebar navigation
- `.main-content` - Main content area
- `.auth-container` - Authentication form wrapper
- `.psc-header` - Header section

### Components
- `.card` - Card container with shadow
- `.alert-custom` - Custom alert box
- `.notification-banner` - Yellow notification bar
- `.important-dates` - Dates section with styling

### Forms
- `.form-control-custom` - Styled input/textarea
- `.btn-psc` - Primary button (full width)
- `.btn-psc-secondary` - Secondary button
- `.btn-primary` - Regular primary button
- `.btn-success` - Success button (mapped to blue)

### Tables
- `.data-table` - Standard data table
- `#jobTable` - Job listing table with gradients
- `.table-hover` - Hover effects on rows

### OTP/Verification
- `.otp-container` - Container for OTP inputs
- `.otp-input` - Individual OTP input field
- `.steps-container` - Multi-step wizard
- `.step` - Individual step indicator

### Utility Classes
- `.d-mobile-none` - Hide on mobile
- `.d-mobile-block` - Show on mobile only
- `.d-tablet-none` - Hide on tablet
- `.d-desktop-block` - Show on desktop only
- `.text-mobile-center` - Center text on mobile

## Color Usage in HTML

### Using SCSS Variables (in .scss files)
```scss
.my-component {
  background: $psc-blue;
  border: 1px solid $psc-light-blue;
}
```

### Using CSS Variables (in HTML/CSS)
```html
<div style="color: var(--psc-blue);">Text</div>
```

## Responsive Design

### Breakpoints
```
Mobile:  ≤ 767px
Tablet:  768px - 991px
Desktop: ≥ 992px
```

### Example Responsive Code
```scss
// Mobile first
.my-element {
  padding: 10px;
  font-size: 14px;
}

// Tablet
@media (min-width: 768px) {
  .my-element {
    padding: 15px;
    font-size: 15px;
  }
}

// Desktop
@media (min-width: 992px) {
  .my-element {
    padding: 20px;
    font-size: 16px;
  }
}
```

## Development Commands

```bash
# Start development server with HMR
npm run dev

# Build for production
npm run build

# Preview production build
npm run preview
```

## Common Customizations

### Change Theme Color
Edit `resources/sass/_variables.scss`:
```scss
$psc-blue: #YOUR_COLOR;  // Changes all primary colors
```

### Add New Component Style
Add to `resources/sass/custom.scss`:
```scss
.my-new-component {
  background: $psc-blue;
  padding: 20px;
  border-radius: 12px;  // Standard radius
  box-shadow: var(--box-shadow);
  transition: var(--transition);

  &:hover {
    transform: translateY(-2px);
  }
}
```

### Override Bootstrap
Add to `resources/sass/custom.scss` after Bootstrap import:
```scss
.btn-primary {
  background: $psc-blue;
  // Your custom styles
}
```

## Files to Know

| File | Purpose |
|------|---------|
| `resources/sass/_variables.scss` | Color & size variables |
| `resources/sass/custom.scss` | All custom component styles |
| `resources/sass/app.scss` | Main SCSS entry point |
| `resources/views/layouts/app.blade.php` | Main layout template |
| `public/css/styles.css` | Original CSS (can be removed) |

## Best Practices

✅ **Do**:
- Use SCSS variables for colors: `background: $psc-blue;`
- Use consistent border-radius: `border-radius: 12px;`
- Use transition variables: `transition: var(--transition);`
- Nest related styles
- Use mobile-first responsive design

❌ **Don't**:
- Hardcode colors - use variables instead
- Add !important unless absolutely necessary
- Use inline styles in HTML
- Ignore responsive breakpoints
- Duplicate style rules

## CSS Custom Properties (Available in all CSS)

```css
/* Colors */
--primary-color: #0a4a7a;
--secondary-color: #0a4a7a;
--accent-color: #ff6b35;
--psc-blue: #0a4a7a;
--psc-dark: #1a3d54;

/* Sizing */
--border-radius: 12px;
--box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);

/* Animation */
--transition: all 0.3s ease;

/* Glass morphism (for future use) */
--glass-bg: rgba(255, 255, 255, 0.95);
--glass-border: rgba(255, 255, 255, 0.2);
```

## Animation Utilities

All components use smooth transitions:
```scss
transition: var(--transition);  // all 0.3s ease
```

Hover animations:
```scss
&:hover {
  transform: translateY(-2px);      // Lift up
  box-shadow: 0 6px 20px rgba(...); // Enhance shadow
}
```

---

**Need to make changes to styles?**
1. Open `resources/sass/custom.scss`
2. Make your changes
3. Dev server auto-compiles (watch for terminal)
4. Browser auto-refreshes (HMR)
