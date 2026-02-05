/**
 * Change Makers Modal Disclaimer
 *
 * Displays a content acknowledgement modal on page load
 * Stores acceptance in sessionStorage (shows once per session)
 *
 * @package g2o
 */

class ChangeMakersModal {
	constructor() {
		this.modal = document.getElementById('cmDisclaimerModal');
		if (!this.modal) return;

		this.checkbox = document.getElementById('cmModalCheckbox');
		this.button = document.getElementById('cmModalButton');
		this.storageKey = 'cm_disclaimer_accepted';
		this.focusableElements = null;
		this.firstFocusableElement = null;
		this.lastFocusableElement = null;

		this.init();
	}

	init() {
		// Check if user has already accepted this session
		if (sessionStorage.getItem(this.storageKey) === 'true') {
			return; // Don't show modal
		}

		// Show modal on page load
		this.showModal();

		// Set up event listeners
		if (this.checkbox) {
			this.checkbox.addEventListener('change', () => this.handleCheckboxChange());
		}

		this.button.addEventListener('click', () => this.handleAccept());

		// Keyboard navigation
		document.addEventListener('keydown', (e) => this.handleKeyPress(e));

		// Set up focus trap
		this.setupFocusTrap();
	}

	showModal() {
		this.modal.setAttribute('aria-hidden', 'false');
		document.body.style.overflow = 'hidden'; // Prevent scrolling

		// Focus on first element when modal opens
		setTimeout(() => {
			if (this.firstFocusableElement) {
				this.firstFocusableElement.focus();
			}
		}, 100);
	}

	hideModal() {
		this.modal.setAttribute('aria-hidden', 'true');
		document.body.style.overflow = ''; // Restore scrolling
	}

	handleCheckboxChange() {
		if (this.checkbox.checked) {
			this.button.disabled = false;
			this.button.setAttribute('aria-disabled', 'false');
		} else {
			this.button.disabled = true;
			this.button.setAttribute('aria-disabled', 'true');
		}
	}

	handleAccept() {
		// Validate checkbox if required
		if (this.checkbox && !this.checkbox.checked) {
			return; // Button should be disabled, but double-check
		}

		// Store acceptance in sessionStorage
		sessionStorage.setItem(this.storageKey, 'true');

		// Hide modal
		this.hideModal();
	}

	handleKeyPress(e) {
		// Only handle keys when modal is visible
		if (this.modal.getAttribute('aria-hidden') === 'true') {
			return;
		}

		// Escape key - only allow if accepted (not forced to agree)
		if (e.key === 'Escape') {
			if (!this.checkbox || this.checkbox.checked) {
				this.handleAccept();
			}
		}

		// Tab key - trap focus within modal
		if (e.key === 'Tab') {
			this.handleTabKey(e);
		}
	}

	setupFocusTrap() {
		// Get all focusable elements in the modal
		const focusableSelectors = [
			'button:not([disabled])',
			'input:not([disabled])',
			'[tabindex]:not([tabindex="-1"])'
		].join(',');

		this.focusableElements = this.modal.querySelectorAll(focusableSelectors);

		if (this.focusableElements.length > 0) {
			this.firstFocusableElement = this.focusableElements[0];
			this.lastFocusableElement = this.focusableElements[this.focusableElements.length - 1];
		}
	}

	handleTabKey(e) {
		if (!this.focusableElements || this.focusableElements.length === 0) {
			return;
		}

		// Shift + Tab (backward)
		if (e.shiftKey) {
			if (document.activeElement === this.firstFocusableElement) {
				e.preventDefault();
				this.lastFocusableElement.focus();
			}
		}
		// Tab (forward)
		else {
			if (document.activeElement === this.lastFocusableElement) {
				e.preventDefault();
				this.firstFocusableElement.focus();
			}
		}
	}
}

// Initialize modal when DOM is ready
if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', () => {
		new ChangeMakersModal();
	});
} else {
	new ChangeMakersModal();
}
