/**
 * G2O Navigation Controller
 * 
 * Award-level, accessible navigation with full WCAG 2.2 AA compliance
 * Vanilla JavaScript ES modules - no dependencies
 */

class NavigationController {
  constructor() {
    this.nav = document.querySelector('[data-nav="container"]');
    if (!this.nav) return;

    // DOM elements
    this.header = document.getElementById('site-header');
    this.mobileToggle = this.nav.querySelector('[data-nav="toggle"]');
    this.mobilePanel = this.nav.querySelector('[data-nav="mobile"]');
    this.mobileClose = this.nav.querySelector('[data-nav="close"]');
    this.backdrop = this.nav.querySelector('[data-nav="backdrop"]');
    this.dropdownTriggers = this.nav.querySelectorAll('[data-nav-trigger="dropdown"]');
    this.dropdowns = this.nav.querySelectorAll('[data-nav="dropdown"]');
    this.sentinel = this.header?.querySelector('[data-header="sentinel"]');

    // State
    this.isMobileOpen = false;
    this.activeDropdown = null;
    this.focusableElements = [];
    this.originalFocusedElement = null;
    this.mediaQuery = window.matchMedia('(min-width: 1024px)');

    // Timers
    this.hoverTimer = null;
    this.resizeTimer = null;
    this.preventHover = false;
    this.preventHoverTimeout = null;

    this.init();
  }

  init() {
    this.bindEvents();
    this.setupIntersectionObserver();
    this.setupKeyboardNavigation();
    this.handleMediaQueryChange();

    // Handle reduced motion preference
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
      this.nav.setAttribute('data-reduced-motion', 'true');
    }
  }

  bindEvents() {
    // Mobile toggle
    if (this.mobileToggle) {
      this.mobileToggle.addEventListener('click', this.toggleMobile.bind(this));
    }

    if (this.mobileClose) {
      this.mobileClose.addEventListener('click', this.closeMobile.bind(this));
    }

    // Backdrop
    if (this.backdrop) {
      this.backdrop.addEventListener('click', this.closeMobile.bind(this));
    }

    // Desktop dropdowns
    this.dropdownTriggers.forEach(trigger => {
      trigger.addEventListener('click', this.handleDropdownClick.bind(this));
      trigger.addEventListener('mouseenter', this.handleDropdownHover.bind(this));
      trigger.addEventListener('mouseleave', this.handleDropdownLeave.bind(this));
      trigger.addEventListener('keydown', this.handleDropdownKeydown.bind(this));
    });

    this.dropdowns.forEach(dropdown => {
      dropdown.addEventListener('mouseenter', this.handleDropdownHover.bind(this));
      dropdown.addEventListener('mouseleave', this.handleDropdownLeave.bind(this));
      dropdown.addEventListener('keydown', this.handleDropdownKeydown.bind(this));
    });

    // Global events
    document.addEventListener('keydown', this.handleGlobalKeydown.bind(this));
    document.addEventListener('click', this.handleOutsideClick.bind(this));
    window.addEventListener('resize', this.handleResize.bind(this));
    this.mediaQuery.addEventListener('change', this.handleMediaQueryChange.bind(this));

    // Route changes (for SPAs or page navigation)
    window.addEventListener('beforeunload', this.cleanup.bind(this));
  }

  setupIntersectionObserver() {
    if (!this.sentinel || !this.header) return;

    const observer = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          this.header.removeAttribute('data-scrolled');
        } else {
          this.header.setAttribute('data-scrolled', 'true');
        }
      },
      { threshold: 0 }
    );

    observer.observe(this.sentinel);
  }

  setupKeyboardNavigation() {
    // Create roving tabindex for menu items
    const menuItems = this.nav.querySelectorAll('[role="menuitem"], [role="menubar"] > li > a, [role="menubar"] > li > button');
    
    menuItems.forEach((item, index) => {
      item.setAttribute('tabindex', index === 0 ? '0' : '-1');
    });
  }

  // =============================================================================
  // Mobile Navigation
  // =============================================================================

  toggleMobile() {
    if (this.isMobileOpen) {
      this.closeMobile();
    } else {
      this.openMobile();
    }
  }

  openMobile() {
    if (this.isMobileOpen) return;

    this.isMobileOpen = true;
    this.originalFocusedElement = document.activeElement;

    // Update ARIA states
    this.mobileToggle.setAttribute('aria-expanded', 'true');
    this.mobileToggle.setAttribute('aria-label', 'Close navigation menu');
    this.mobilePanel.setAttribute('aria-hidden', 'false');
    this.backdrop.setAttribute('aria-hidden', 'false');

    // Update toggle text
    const openText = this.mobileToggle.querySelector('[data-nav="toggle-text-open"]');
    const closeText = this.mobileToggle.querySelector('[data-nav="toggle-text-close"]');
    if (openText && closeText) {
      openText.hidden = true;
      closeText.hidden = false;
    }

    // Prevent body scroll and make main content inert
    document.body.setAttribute('data-nav-open', 'true');
    this.trapFocus();

    // Focus the close button
    requestAnimationFrame(() => {
      this.mobileClose?.focus();
    });

    // Update focusable elements
    this.updateFocusableElements();
  }

  closeMobile() {
    if (!this.isMobileOpen) return;

    this.isMobileOpen = false;

    // Update ARIA states
    this.mobileToggle.setAttribute('aria-expanded', 'false');
    this.mobileToggle.setAttribute('aria-label', 'Open navigation menu');
    this.mobilePanel.setAttribute('aria-hidden', 'true');
    this.backdrop.setAttribute('aria-hidden', 'true');

    // Update toggle text
    const openText = this.mobileToggle.querySelector('[data-nav="toggle-text-open"]');
    const closeText = this.mobileToggle.querySelector('[data-nav="toggle-text-close"]');
    if (openText && closeText) {
      openText.hidden = false;
      closeText.hidden = true;
    }

    // Re-enable body scroll and remove inert
    document.body.removeAttribute('data-nav-open');
    this.removeFocusTrap();

    // Return focus to original element
    if (this.originalFocusedElement) {
      this.originalFocusedElement.focus();
      this.originalFocusedElement = null;
    }
  }

  // =============================================================================
  // Desktop Dropdowns
  // =============================================================================

  handleDropdownHover(event) {
    if (!this.mediaQuery.matches) return; // Only on desktop
    if (this.preventHover) return; // Skip hover interactions right after a click

    clearTimeout(this.hoverTimer);
    
    const trigger = event.currentTarget;
    const dropdown = trigger.parentElement.querySelector('[data-nav="dropdown"]');
    
    if (!dropdown) return;

    // Hover intent - small delay before opening
    this.hoverTimer = setTimeout(() => {
      this.closeAllDropdowns();
      this.openDropdown(dropdown, trigger);
    }, 160);
  }

  handleDropdownLeave(event) {
    if (!this.mediaQuery.matches) return; // Only on desktop

    clearTimeout(this.hoverTimer);
    
    // Small delay before closing to prevent accidental closes
    this.hoverTimer = setTimeout(() => {
      this.closeAllDropdowns();
    }, 120);
  }

  handleDropdownKeydown(event) {
    const { key } = event;
    
    if (key === 'Escape') {
      this.closeAllDropdowns();
      event.stopPropagation();
      return;
    }

    // Arrow key navigation
    if (['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight', 'Home', 'End'].includes(key)) {
      this.handleArrowKeyNavigation(event);
    }
  }

  handleDropdownClick(event) {
    if (!this.mediaQuery.matches) {
      return;
    }

    event.preventDefault();
    event.stopPropagation();

    const trigger = event.currentTarget;
    const dropdown = trigger.parentElement?.querySelector('[data-nav="dropdown"]');

    if (!dropdown) {
      return;
    }

    const isExpanded = trigger.getAttribute('aria-expanded') === 'true';

    clearTimeout(this.preventHoverTimeout);
    this.preventHover = true;
    this.preventHoverTimeout = setTimeout(() => {
      this.preventHover = false;
      this.preventHoverTimeout = null;
    }, 220);

    if (isExpanded) {
      this.closeDropdown(dropdown);
      if (event.detail !== 0) {
        trigger.blur();
      }
      return;
    }

    this.closeAllDropdowns();
    this.openDropdown(dropdown, trigger);

    if (event.detail !== 0) {
      trigger.blur();
    }
  }

  openDropdown(dropdown, trigger) {
    if (!dropdown || !trigger) return;

    this.activeDropdown = dropdown;
    
    // Update ARIA states
    trigger.setAttribute('aria-expanded', 'true');
    dropdown.setAttribute('aria-hidden', 'false');
    
    // Position dropdown within viewport
    this.positionDropdown(dropdown);
    
    // Announce to screen readers
    const announcement = `${trigger.textContent} submenu opened`;
    this.announceToScreenReader(announcement);
  }

  closeDropdown(dropdown) {
    if (!dropdown) return;

    const trigger = dropdown.parentElement.querySelector('[data-nav-trigger="dropdown"]');
    
    if (trigger) {
      trigger.setAttribute('aria-expanded', 'false');
    }
    
    dropdown.setAttribute('aria-hidden', 'true');
    
    if (this.activeDropdown === dropdown) {
      this.activeDropdown = null;
    }
  }

  closeAllDropdowns() {
    this.dropdowns.forEach(dropdown => {
      this.closeDropdown(dropdown);
    });
    clearTimeout(this.hoverTimer);
  }

  positionDropdown(dropdown) {
    if (!dropdown) return;

    const rect = dropdown.getBoundingClientRect();
    const viewportWidth = window.innerWidth;
    const dropdownWidth = rect.width;
    
    // Reset positioning
    dropdown.style.left = '';
    dropdown.style.right = '';
    dropdown.style.transform = '';
    
    // Check if dropdown extends beyond right edge
    if (rect.right > viewportWidth - 16) {
      dropdown.style.left = 'auto';
      dropdown.style.right = '0';
      dropdown.style.transform = 'translateY(8px)';
    }
    
    // Check if dropdown extends beyond left edge
    if (rect.left < 16) {
      dropdown.style.left = '0';
      dropdown.style.right = 'auto';
      dropdown.style.transform = 'translateY(8px)';
    }
  }

  // =============================================================================
  // Keyboard Navigation
  // =============================================================================

  handleArrowKeyNavigation(event) {
    const { key, target } = event;
    const isInDropdown = target.closest('[data-nav="dropdown"]');
    const isInMobile = target.closest('[data-nav="mobile"]');
    
    if (isInDropdown || isInMobile) {
      this.handleDropdownArrowKeys(event);
    } else {
      this.handleMenuBarArrowKeys(event);
    }
  }

  handleMenuBarArrowKeys(event) {
    const { key, target } = event;
    const menuItems = Array.from(this.nav.querySelectorAll('[role="menubar"] > li > a, [role="menubar"] > li > button'));
    const currentIndex = menuItems.indexOf(target);
    
    if (currentIndex === -1) return;
    
    let nextIndex;
    
    switch (key) {
      case 'ArrowLeft':
        nextIndex = currentIndex > 0 ? currentIndex - 1 : menuItems.length - 1;
        break;
      case 'ArrowRight':
        nextIndex = currentIndex < menuItems.length - 1 ? currentIndex + 1 : 0;
        break;
      case 'ArrowDown':
        // Open dropdown if available
        const dropdown = target.parentElement.querySelector('[data-nav="dropdown"]');
        if (dropdown) {
          event.preventDefault();
          this.openDropdown(dropdown, target);
          const firstMenuItem = dropdown.querySelector('[role="menuitem"]');
          firstMenuItem?.focus();
        }
        return;
      case 'Home':
        nextIndex = 0;
        break;
      case 'End':
        nextIndex = menuItems.length - 1;
        break;
      default:
        return;
    }
    
    event.preventDefault();
    menuItems[currentIndex].setAttribute('tabindex', '-1');
    menuItems[nextIndex].setAttribute('tabindex', '0');
    menuItems[nextIndex].focus();
  }

  handleDropdownArrowKeys(event) {
    const { key, target } = event;
    const dropdown = target.closest('[data-nav="dropdown"]');
    if (!dropdown) return;
    
    const menuItems = Array.from(dropdown.querySelectorAll('[role="menuitem"]'));
    const currentIndex = menuItems.indexOf(target);
    
    if (currentIndex === -1) return;
    
    let nextIndex;
    
    switch (key) {
      case 'ArrowUp':
        nextIndex = currentIndex > 0 ? currentIndex - 1 : menuItems.length - 1;
        break;
      case 'ArrowDown':
        nextIndex = currentIndex < menuItems.length - 1 ? currentIndex + 1 : 0;
        break;
      case 'Home':
        nextIndex = 0;
        break;
      case 'End':
        nextIndex = menuItems.length - 1;
        break;
      default:
        return;
    }
    
    event.preventDefault();
    menuItems[nextIndex].focus();
  }

  handleGlobalKeydown(event) {
    const { key } = event;
    
    // Escape key handling
    if (key === 'Escape') {
      if (this.isMobileOpen) {
        this.closeMobile();
      } else if (this.activeDropdown) {
        this.closeAllDropdowns();
      }
    }
    
    // Tab key handling for focus trap
    if (key === 'Tab' && this.isMobileOpen) {
      this.handleTabKeyInMobile(event);
    }
  }

  handleTabKeyInMobile(event) {
    if (this.focusableElements.length === 0) return;
    
    const firstFocusable = this.focusableElements[0];
    const lastFocusable = this.focusableElements[this.focusableElements.length - 1];
    
    if (event.shiftKey) {
      // Shift + Tab
      if (document.activeElement === firstFocusable) {
        event.preventDefault();
        lastFocusable.focus();
      }
    } else {
      // Tab
      if (document.activeElement === lastFocusable) {
        event.preventDefault();
        firstFocusable.focus();
      }
    }
  }

  handleOutsideClick(event) {
    if (!this.activeDropdown) return;
    
    const isClickInsideNav = this.nav.contains(event.target);
    if (!isClickInsideNav) {
      this.closeAllDropdowns();
    }
  }

  // =============================================================================
  // Focus Management
  // =============================================================================

  trapFocus() {
    this.updateFocusableElements();
    
    // Make main content inert (non-interactive)
    const mainContent = document.querySelectorAll('main, article, section, aside, footer');
    mainContent.forEach(element => {
      if (!this.nav.contains(element)) {
        element.setAttribute('inert', 'true');
        element.setAttribute('aria-hidden', 'true');
      }
    });
  }

  removeFocusTrap() {
    // Remove inert from main content
    const mainContent = document.querySelectorAll('[inert="true"]');
    mainContent.forEach(element => {
      element.removeAttribute('inert');
      element.removeAttribute('aria-hidden');
    });
  }

  updateFocusableElements() {
    if (!this.mobilePanel) return;
    
    const focusableSelectors = [
      'a[href]:not([disabled])',
      'button:not([disabled])',
      'textarea:not([disabled])',
      'input[type="text"]:not([disabled])',
      'input[type="radio"]:not([disabled])',
      'input[type="checkbox"]:not([disabled])',
      'select:not([disabled])',
      '[tabindex]:not([tabindex="-1"]):not([disabled])'
    ];
    
    this.focusableElements = Array.from(
      this.mobilePanel.querySelectorAll(focusableSelectors.join(', '))
    );
  }

  // =============================================================================
  // Responsive Behavior
  // =============================================================================

  handleResize() {
    clearTimeout(this.resizeTimer);
    
    this.resizeTimer = setTimeout(() => {
      // Close mobile nav if switching to desktop
      if (this.mediaQuery.matches && this.isMobileOpen) {
        this.closeMobile();
      }
      
      // Reposition dropdowns
      if (this.activeDropdown) {
        this.positionDropdown(this.activeDropdown);
      }
    }, 100);
  }

  handleMediaQueryChange() {
    if (this.mediaQuery.matches) {
      // Desktop mode
      if (this.isMobileOpen) {
        this.closeMobile();
      }
    } else {
      // Mobile mode
      this.closeAllDropdowns();
    }
  }

  // =============================================================================
  // Accessibility Utilities
  // =============================================================================

  announceToScreenReader(message) {
    const announcement = document.createElement('div');
    announcement.setAttribute('aria-live', 'polite');
    announcement.setAttribute('aria-atomic', 'true');
    announcement.className = 'sr-only';
    announcement.textContent = message;
    
    document.body.appendChild(announcement);
    
    setTimeout(() => {
      document.body.removeChild(announcement);
    }, 1000);
  }

  // =============================================================================
  // Cleanup
  // =============================================================================

  cleanup() {
    this.closeMobile();
    this.closeAllDropdowns();
    clearTimeout(this.hoverTimer);
    clearTimeout(this.resizeTimer);
    clearTimeout(this.preventHoverTimeout);
    this.preventHoverTimeout = null;
    this.preventHover = false;
  }

  destroy() {
    this.cleanup();
    
    // Remove event listeners
    this.mobileToggle?.removeEventListener('click', this.toggleMobile);
    this.mobileClose?.removeEventListener('click', this.closeMobile);
    this.backdrop?.removeEventListener('click', this.closeMobile);
    
    document.removeEventListener('keydown', this.handleGlobalKeydown);
    document.removeEventListener('click', this.handleOutsideClick);
    window.removeEventListener('resize', this.handleResize);
    this.mediaQuery.removeEventListener('change', this.handleMediaQueryChange);
  }
}

// =============================================================================
// Initialize Navigation
// =============================================================================

// Wait for DOM to be ready
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initNavigation);
} else {
  initNavigation();
}

function initNavigation() {
  // Initialize navigation controller
  window.g2oNavigation = new NavigationController();
  
  // Make available globally for debugging
  if (window.location.hostname === 'localhost' || window.location.hostname.includes('local')) {
    console.log('G2O Navigation initialized', window.g2oNavigation);
  }
}

// Export for modules
if (typeof module !== 'undefined' && module.exports) {
  module.exports = NavigationController;
}
