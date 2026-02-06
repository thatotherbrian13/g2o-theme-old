/**
 * G2O Navigation Controller
 *
 * Award-level, accessible navigation with full WCAG 2.2 AA compliance
 * Vanilla JavaScript ES modules - no dependencies
 */

// Timing constants (ms) - coordinated with CSS variables
const TIMING = {
  HOVER_OPEN: 160,      // Hover intent delay to prevent flicker
  HOVER_CLOSE: 120,     // Delay before closing to prevent accidental closes
  PREVENT_HOVER: 220,   // Block hover after click to prevent conflicts
  RESIZE_DEBOUNCE: 100, // Debounce window resize handler
  ANNOUNCEMENT: 2000    // Screen reader announcement visibility
};

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
    this.mobileAccordionTriggers = this.nav.querySelectorAll('[data-mobile-accordion="trigger"]');
    this.sentinel = this.header?.querySelector('[data-header="sentinel"]');

    // State
    this.isMobileOpen = false;
    this.activeDropdown = null;
    this.focusableElements = [];
    this.originalFocusedElement = null;
    this.mediaQuery = window.matchMedia('(min-width: 1350px)');
    this.scrollObserver = null;

    // Timers
    this.hoverTimer = null;
    this.resizeTimer = null;
    this.preventHover = false;
    this.preventHoverTimeout = null;

    // Bound event handlers (stored for proper cleanup)
    this._boundToggleMobile = this.toggleMobile.bind(this);
    this._boundCloseMobile = this.closeMobile.bind(this);
    this._boundHandleDropdownClick = this.handleDropdownClick.bind(this);
    this._boundHandleDropdownHover = this.handleDropdownHover.bind(this);
    this._boundHandleDropdownLeave = this.handleDropdownLeave.bind(this);
    this._boundHandleDropdownKeydown = this.handleDropdownKeydown.bind(this);
    this._boundHandleMobileAccordionClick = this.handleMobileAccordionClick.bind(this);
    this._boundHandleGlobalKeydown = this.handleGlobalKeydown.bind(this);
    this._boundHandleOutsideClick = this.handleOutsideClick.bind(this);
    this._boundHandleResize = this.handleResize.bind(this);
    this._boundHandleMediaQueryChange = this.handleMediaQueryChange.bind(this);
    this._boundCleanup = this.cleanup.bind(this);

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
      this.mobileToggle.addEventListener('click', this._boundToggleMobile);
    }

    if (this.mobileClose) {
      this.mobileClose.addEventListener('click', this._boundCloseMobile);
    }

    // Backdrop
    if (this.backdrop) {
      this.backdrop.addEventListener('click', this._boundCloseMobile);
    }

    // Desktop dropdowns
    this.dropdownTriggers.forEach(trigger => {
      trigger.addEventListener('click', this._boundHandleDropdownClick);
      trigger.addEventListener('mouseenter', this._boundHandleDropdownHover);
      trigger.addEventListener('mouseleave', this._boundHandleDropdownLeave);
      trigger.addEventListener('keydown', this._boundHandleDropdownKeydown);
    });

    this.dropdowns.forEach(dropdown => {
      dropdown.addEventListener('mouseenter', this._boundHandleDropdownHover);
      dropdown.addEventListener('mouseleave', this._boundHandleDropdownLeave);
      dropdown.addEventListener('keydown', this._boundHandleDropdownKeydown);
    });

    // Mobile accordion triggers
    this.mobileAccordionTriggers.forEach(trigger => {
      trigger.addEventListener('click', this._boundHandleMobileAccordionClick);
    });

    // Global events
    document.addEventListener('keydown', this._boundHandleGlobalKeydown);
    document.addEventListener('click', this._boundHandleOutsideClick);
    window.addEventListener('resize', this._boundHandleResize);
    this.mediaQuery.addEventListener('change', this._boundHandleMediaQueryChange);

    // Route changes (for SPAs or page navigation)
    window.addEventListener('beforeunload', this._boundCleanup);
  }

  setupIntersectionObserver() {
    if (!this.sentinel || !this.header) return;

    this.scrollObserver = new IntersectionObserver(
      ([entry]) => {
        if (entry.isIntersecting) {
          this.header.removeAttribute('data-scrolled');
        } else {
          this.header.setAttribute('data-scrolled', 'true');
        }
      },
      { threshold: 0 }
    );

    this.scrollObserver.observe(this.sentinel);
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

    // Reset all mobile accordions
    this.closeAllMobileAccordions();
  }

  // =============================================================================
  // Mobile Accordion Submenus
  // =============================================================================

  handleMobileAccordionClick(event) {
    event.preventDefault();
    event.stopPropagation();

    const trigger = event.currentTarget;
    const parentItem = trigger.closest('.nav__item--has-dropdown');
    const dropdown = parentItem?.querySelector('.nav__dropdown');

    if (!parentItem || !dropdown) return;

    const isExpanded = trigger.getAttribute('aria-expanded') === 'true';

    // Close all other open accordions (single-open behavior)
    if (!isExpanded) {
      this.closeAllMobileAccordions();
    }

    // Toggle this accordion
    trigger.setAttribute('aria-expanded', !isExpanded);
    parentItem.setAttribute('data-expanded', !isExpanded);
    dropdown.setAttribute('aria-hidden', isExpanded);
  }

  closeAllMobileAccordions() {
    this.mobileAccordionTriggers.forEach(trigger => {
      const parentItem = trigger.closest('.nav__item--has-dropdown');
      const dropdown = parentItem?.querySelector('.nav__dropdown');

      trigger.setAttribute('aria-expanded', 'false');
      if (parentItem) parentItem.setAttribute('data-expanded', 'false');
      if (dropdown) dropdown.setAttribute('aria-hidden', 'true');
    });
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
    }, TIMING.HOVER_OPEN);
  }

  handleDropdownLeave(event) {
    if (!this.mediaQuery.matches) return; // Only on desktop

    clearTimeout(this.hoverTimer);
    
    // Small delay before closing to prevent accidental closes
    this.hoverTimer = setTimeout(() => {
      this.closeAllDropdowns();
    }, TIMING.HOVER_CLOSE);
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
    }, TIMING.PREVENT_HOVER);

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
    }, TIMING.RESIZE_DEBOUNCE);
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
    
    // Allow time for slower screen readers to finish reading
    setTimeout(() => {
      if (announcement.parentNode) {
        announcement.parentNode.removeChild(announcement);
      }
    }, TIMING.ANNOUNCEMENT);
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

    // Disconnect IntersectionObserver
    if (this.scrollObserver) {
      this.scrollObserver.disconnect();
      this.scrollObserver = null;
    }
  }

  destroy() {
    this.cleanup();

    // Remove event listeners using stored bound references
    this.mobileToggle?.removeEventListener('click', this._boundToggleMobile);
    this.mobileClose?.removeEventListener('click', this._boundCloseMobile);
    this.backdrop?.removeEventListener('click', this._boundCloseMobile);

    // Remove dropdown trigger listeners
    this.dropdownTriggers.forEach(trigger => {
      trigger.removeEventListener('click', this._boundHandleDropdownClick);
      trigger.removeEventListener('mouseenter', this._boundHandleDropdownHover);
      trigger.removeEventListener('mouseleave', this._boundHandleDropdownLeave);
      trigger.removeEventListener('keydown', this._boundHandleDropdownKeydown);
    });

    // Remove dropdown listeners
    this.dropdowns.forEach(dropdown => {
      dropdown.removeEventListener('mouseenter', this._boundHandleDropdownHover);
      dropdown.removeEventListener('mouseleave', this._boundHandleDropdownLeave);
      dropdown.removeEventListener('keydown', this._boundHandleDropdownKeydown);
    });

    // Remove mobile accordion listeners
    this.mobileAccordionTriggers.forEach(trigger => {
      trigger.removeEventListener('click', this._boundHandleMobileAccordionClick);
    });

    // Remove global listeners
    document.removeEventListener('keydown', this._boundHandleGlobalKeydown);
    document.removeEventListener('click', this._boundHandleOutsideClick);
    window.removeEventListener('resize', this._boundHandleResize);
    this.mediaQuery.removeEventListener('change', this._boundHandleMediaQueryChange);
    window.removeEventListener('beforeunload', this._boundCleanup);
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
}

// Export for modules
if (typeof module !== 'undefined' && module.exports) {
  module.exports = NavigationController;
}
