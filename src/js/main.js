/**
 * Main Frontend JavaScript - Gravisain Theme
 * Vanilla JS ES Modules for Off-Canvas Navigation and Interactive Components.
 */

document.addEventListener('DOMContentLoaded', () => {
	initThemeSwitcher();
	initOffCanvasDrawer();
	initStickyHeader();
	initAccessibleDropdownNavigation();
	initSkipLinkFocus();
	initScrollToTop();
	initReadingProgressBar();
	initSmoothScroll();
});

/**
 * Initialize Sticky Header Behavior
 */
function initStickyHeader() {
	if (!document.body.classList.contains('has-sticky-header')) return;

	const header = document.querySelector('.site-header');
	if (!header) return;

	let lastScrollTop = window.pageYOffset || document.documentElement.scrollTop;
	let isSticky = false;
	let ticking = false;

	// Create spacer element to prevent layout jump when header switches to fixed
	let spacer = document.querySelector('.gravisain-sticky-spacer');
	if (!spacer && !document.body.classList.contains('has-transparent-header')) {
		spacer = document.createElement('div');
		spacer.className = 'gravisain-sticky-spacer';
		header.parentNode.insertBefore(spacer, header);
	}

	function onScroll() {
		const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		const headerHeight = header.offsetHeight || 100;
		const triggerPoint = headerHeight + 20;

		if (scrollTop > triggerPoint) {
			if (scrollTop > lastScrollTop) {
				document.body.classList.add('is-scrolling-down');
				document.body.classList.remove('is-scrolling-up');
			} else if (scrollTop < lastScrollTop) {
				document.body.classList.remove('is-scrolling-down');
				document.body.classList.add('is-scrolling-up');
			}

			if (!isSticky) {
				isSticky = true;
				if (spacer) {
					spacer.style.height = headerHeight + 'px';
					spacer.classList.add('is-active');
				}
				header.classList.add('is-sticky');
			}
		} else if (scrollTop <= headerHeight) {
			if (isSticky) {
				isSticky = false;
				header.classList.remove('is-sticky');
				document.body.classList.remove('is-scrolling-down', 'is-scrolling-up');
				if (spacer) {
					spacer.classList.remove('is-active');
				}
			}
		}

		lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
		ticking = false;
	}

	window.addEventListener('scroll', () => {
		if (!ticking) {
			window.requestAnimationFrame(onScroll);
			ticking = true;
		}
	}, { passive: true });
}

/**
 * Initialize Off-Canvas Drawer
 */
function initOffCanvasDrawer() {
	const offCanvas = document.getElementById('gravisain-off-canvas');
	if (!offCanvas) return;

	// Move to body to prevent stacking context issues with body transforms
	if (offCanvas.parentNode !== document.body) {
		document.body.appendChild(offCanvas);
	}

	const container = offCanvas.querySelector('.off-canvas-container');
	let activeTrigger = null;

	// Determine direction from offCanvas classes
	let directionClass = '';
	const classList = Array.from(offCanvas.classList);
	const slideClass = classList.find(cls => cls.startsWith('slide-from-'));
	if (slideClass) {
		directionClass = slideClass.replace('slide-from-', '');
	}

	// Open drawer
	const openDrawer = (triggerBtn) => {
		activeTrigger = triggerBtn;
		offCanvas.classList.add('is-open');
		offCanvas.setAttribute('aria-hidden', 'false');
		document.body.classList.add('off-canvas-opened');
		if (directionClass) {
			document.body.classList.add(`off-canvas-opened-${directionClass}`);
		}
		document.body.style.overflow = 'hidden';

		if (triggerBtn && typeof triggerBtn.setAttribute === 'function') {
			triggerBtn.setAttribute('aria-expanded', 'true');
		}

		// Focus on close button or container after transition
		setTimeout(() => {
			const firstFocusable = offCanvas.querySelector('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
			if (firstFocusable) {
				firstFocusable.focus();
			} else if (container) {
				container.focus();
			}
		}, 100);
	};

	// Close drawer
	const closeDrawer = () => {
		if (!offCanvas.classList.contains('is-open')) return;

		offCanvas.classList.remove('is-open');
		offCanvas.setAttribute('aria-hidden', 'true');
		document.body.classList.remove('off-canvas-opened');
		if (directionClass) {
			document.body.classList.remove(`off-canvas-opened-${directionClass}`);
		}
		document.body.style.overflow = '';

		if (activeTrigger && typeof activeTrigger.setAttribute === 'function') {
			activeTrigger.setAttribute('aria-expanded', 'false');
			if (typeof activeTrigger.focus === 'function') {
				// preventScroll stops the browser from scrolling the page up to the
				// header trigger when closing the drawer after the user has scrolled
				// down the page (previously caused a "jump to top").
				activeTrigger.focus({ preventScroll: true });
			}
		}
	};

	// Delegated click listener so triggers work even after Customizer Selective Refresh DOM replacement
	document.addEventListener('click', (e) => {
		const triggerBtn = e.target.closest('[data-toggle="off-canvas"]');
		if (triggerBtn) {
			e.preventDefault();
			openDrawer(triggerBtn);
			return;
		}

		const closeBtn = e.target.closest('[data-close="off-canvas"]');
		if (closeBtn && offCanvas.contains(closeBtn)) {
			e.preventDefault();
			closeDrawer();
			return;
		}

		const backdrop = e.target.closest('.off-canvas-backdrop');
		if (backdrop && offCanvas.contains(backdrop)) {
			e.preventDefault();
			closeDrawer();
			return;
		}
	});

	// Close on ESC key press
	document.addEventListener('keydown', (e) => {
		if (e.key === 'Escape' && offCanvas.classList.contains('is-open')) {
			closeDrawer();
		}
	});

	// Basic Focus Trap inside Drawer when open
	offCanvas.addEventListener('keydown', (e) => {
		if (e.key !== 'Tab' || !offCanvas.classList.contains('is-open')) return;

		const focusables = offCanvas.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
		if (focusables.length === 0) return;

		const firstElement = focusables[0];
		const lastElement = focusables[focusables.length - 1];

		if (e.shiftKey && document.activeElement === firstElement) {
			lastElement.focus();
			e.preventDefault();
		} else if (!e.shiftKey && document.activeElement === lastElement) {
			firstElement.focus();
			e.preventDefault();
		}
	});
}

/**
 * Initialize WCAG 2.1 AA Accessible Dropdown Navigation (Keyboard & Touch ARIA)
 */
function initAccessibleDropdownNavigation() {
	const navMenus = document.querySelectorAll('.main-navigation, .secondary-navigation');
	if (!navMenus.length) return;

	navMenus.forEach(nav => {
		const parentItems = nav.querySelectorAll('.menu-item-has-children');

		parentItems.forEach(item => {
			const link = item.querySelector('a');
			const subMenu = item.querySelector('.sub-menu');
			if (!link || !subMenu) return;

			// Ensure ARIA attributes are set
			link.setAttribute('aria-haspopup', 'true');
			link.setAttribute('aria-expanded', 'false');

			// Keyboard Arrow Navigation & ESC to close
			item.addEventListener('keydown', (e) => {
				if (e.key === 'Escape') {
					item.classList.remove('focus');
					link.setAttribute('aria-expanded', 'false');
					link.focus();
					e.stopPropagation();
				} else if (e.key === 'ArrowDown' && document.activeElement === link) {
					e.preventDefault();
					item.classList.add('focus');
					link.setAttribute('aria-expanded', 'true');
					const firstSubLink = subMenu.querySelector('a');
					if (firstSubLink) firstSubLink.focus();
				}
			});

			// Close submenu when focus leaves the parent item
			item.addEventListener('focusout', (e) => {
				setTimeout(() => {
					if (!item.contains(document.activeElement)) {
						item.classList.remove('focus');
						link.setAttribute('aria-expanded', 'false');
					}
				}, 50);
			});
		});
	});
}

/**
 * Initialize Skip Link Focus Fix
 * Ensures keyboard screen reader users jump directly into #primary main content area
 */
function initSkipLinkFocus() {
	const skipLink = document.querySelector('.skip-link');
	if (!skipLink) return;

	skipLink.addEventListener('click', (e) => {
		const targetId = skipLink.getAttribute('href');
		if (!targetId || !targetId.startsWith('#')) return;

		const targetElement = document.querySelector(targetId);
		if (targetElement) {
			if (!targetElement.getAttribute('tabindex')) {
				targetElement.setAttribute('tabindex', '-1');
			}
			targetElement.focus();
		}
	});
}

/**
 * Initialize Floating Scroll-to-Top Button with SVG Progress Ring
 */
function initScrollToTop() {
	const btn = document.getElementById('gravisain-scroll-top');
	if (!btn) return;

	const circle = btn.querySelector('.progress-ring-circle');
	const radius = circle ? circle.r.baseVal.value : 18;
	const circumference = 2 * Math.PI * radius;

	if (circle) {
		circle.style.strokeDasharray = `${circumference} ${circumference}`;
		circle.style.strokeDashoffset = circumference;
	}

	let ticking = false;

	function updateScrollProgress() {
		const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;

		// Toggle button visibility
		if (scrollTop > 400) {
			btn.classList.add('is-visible');
		} else {
			btn.classList.remove('is-visible');
		}

		// Update progress circle
		if (circle && docHeight > 0) {
			const scrollPercent = Math.min(1, Math.max(0, scrollTop / docHeight));
			const offset = circumference - scrollPercent * circumference;
			circle.style.strokeDashoffset = offset;
		}

		ticking = false;
	}

	window.addEventListener('scroll', () => {
		if (!ticking) {
			window.requestAnimationFrame(updateScrollProgress);
			ticking = true;
		}
	}, { passive: true });

	btn.addEventListener('click', () => {
		window.scrollTo({
			top: 0,
			behavior: 'smooth'
		});
	});
}

/**
 * Initialize Reading Progress Bar on Single Posts
 */
function initReadingProgressBar() {
	const bar = document.getElementById('gravisain-reading-progress');
	if (!bar) return;

	let ticking = false;

	function updateBar() {
		const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;

		if (docHeight > 0) {
			const percent = Math.min(100, Math.max(0, (scrollTop / docHeight) * 100));
			bar.style.width = `${percent}%`;
		}

		ticking = false;
	}

	window.addEventListener('scroll', () => {
		if (!ticking) {
			window.requestAnimationFrame(updateBar);
			ticking = true;
		}
	}, { passive: true });
}

/**
 * Initialize Theme Switcher (Light / Dark / System)
 */
function initThemeSwitcher() {
	const THEME_KEY = 'gravisain_theme';
	const switchers = document.querySelectorAll('.ghb-theme-switcher');

	function getStoredTheme() {
		try {
			return localStorage.getItem(THEME_KEY) || 'system';
		} catch (e) {
			return 'system';
		}
	}

	function applyTheme(themeMode) {
		const isSystemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
		const shouldBeDark = themeMode === 'dark' || (themeMode === 'system' && isSystemDark);

		if (shouldBeDark) {
			document.documentElement.classList.add('dark');
			document.documentElement.setAttribute('data-theme', 'dark');
		} else {
			document.documentElement.classList.remove('dark');
			document.documentElement.setAttribute('data-theme', 'light');
		}

		// Update all switcher instances in DOM
		document.querySelectorAll('.ghb-theme-switcher').forEach((switcher) => {
			switcher.setAttribute('data-active-theme', themeMode);
			const btn = switcher.querySelector('.ghb-theme-btn');
			if (btn) {
				const capitalized = themeMode.charAt(0).toUpperCase() + themeMode.slice(1);
				btn.setAttribute('title', `Theme: ${capitalized}`);
				btn.setAttribute('aria-label', `Theme: ${capitalized}`);
			}

			const slider = switcher.querySelector('.ghb-theme-switch-slider');
			if (slider) {
				slider.setAttribute('aria-checked', shouldBeDark ? 'true' : 'false');
				slider.setAttribute('title', `Theme: ${shouldBeDark ? 'Dark' : 'Light'} (Click to toggle)`);
			}

			// Dropdown active states
			switcher.querySelectorAll('.ghb-theme-item').forEach((item) => {
				const itemMode = item.getAttribute('data-mode');
				if (itemMode === themeMode) {
					item.classList.add('is-active');
					item.setAttribute('aria-selected', 'true');
				} else {
					item.classList.remove('is-active');
					item.removeAttribute('aria-selected');
				}
			});
		});
	}

	function setTheme(themeMode) {
		if (!['light', 'dark', 'system'].includes(themeMode)) {
			themeMode = 'system';
		}
		try {
			localStorage.setItem(THEME_KEY, themeMode);
		} catch (e) {}

		applyTheme(themeMode);
	}

	// Initial apply
	const currentTheme = getStoredTheme();
	applyTheme(currentTheme);

	// Setup event listeners for each switcher instance
	switchers.forEach((switcher) => {
		const btn = switcher.querySelector('.ghb-theme-btn');
		const dropdown = switcher.querySelector('.ghb-theme-dropdown');
		const slider = switcher.querySelector('.ghb-theme-switch-slider');
		const isToggleStyle = switcher.classList.contains('ghb-theme-switcher-toggle');

		if (slider) {
			slider.addEventListener('click', (e) => {
				e.stopPropagation();
				const current = getStoredTheme();
				const isSystemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
				const effectiveDark = current === 'dark' || (current === 'system' && isSystemDark);
				setTheme(effectiveDark ? 'light' : 'dark');
			});
		}

		if (!btn) return;

		btn.addEventListener('click', (e) => {
			e.stopPropagation();

			if (isToggleStyle) {
				// Simple direct toggle between light and dark
				const current = getStoredTheme();
				const isSystemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
				const effectiveDark = current === 'dark' || (current === 'system' && isSystemDark);
				setTheme(effectiveDark ? 'light' : 'dark');
				return;
			}

			// Dropdown toggle
			if (dropdown) {
				const isOpen = dropdown.classList.contains('is-open');
				// Close all other open dropdowns first
				document.querySelectorAll('.ghb-theme-dropdown.is-open').forEach((d) => {
					d.classList.remove('is-open');
					const toggle = d.closest('.ghb-theme-switcher')?.querySelector('.ghb-theme-btn');
					if (toggle) toggle.setAttribute('aria-expanded', 'false');
				});

				if (!isOpen) {
					dropdown.classList.add('is-open');
					btn.setAttribute('aria-expanded', 'true');
				} else {
					dropdown.classList.remove('is-open');
					btn.setAttribute('aria-expanded', 'false');
				}
			}
		});

		if (dropdown) {
			dropdown.querySelectorAll('.ghb-theme-item').forEach((item) => {
				item.addEventListener('click', (e) => {
					e.stopPropagation();
					const mode = item.getAttribute('data-mode');
					if (mode) {
						setTheme(mode);
						dropdown.classList.remove('is-open');
						btn.setAttribute('aria-expanded', 'false');
					}
				});
			});
		}
	});

	// Global click outside listener to close dropdowns
	document.addEventListener('click', (e) => {
		if (!e.target.closest('.ghb-theme-switcher')) {
			document.querySelectorAll('.ghb-theme-dropdown.is-open').forEach((d) => {
				d.classList.remove('is-open');
				const toggleBtn = d.closest('.ghb-theme-switcher')?.querySelector('.ghb-theme-btn');
				if (toggleBtn) {
					toggleBtn.setAttribute('aria-expanded', 'false');
				}
			});
		}
	});

	// Escape key to close
	document.addEventListener('keydown', (e) => {
		if (e.key === 'Escape') {
			document.querySelectorAll('.ghb-theme-dropdown.is-open').forEach((d) => {
				d.classList.remove('is-open');
				const toggleBtn = d.closest('.ghb-theme-switcher')?.querySelector('.ghb-theme-btn');
				if (toggleBtn) {
					toggleBtn.setAttribute('aria-expanded', 'false');
					toggleBtn.focus();
				}
			});
		}
	});

	// Listen to OS system color changes
	try {
		window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
			if (getStoredTheme() === 'system') {
				applyTheme('system');
			}
		});
	} catch (e) {}

	// Cross-tab sync
	window.addEventListener('storage', (e) => {
		if (e.key === THEME_KEY) {
			applyTheme(e.newValue || 'system');
		}
	});
}

/**
 * Initialize Smooth Scrolling for in-page Anchor Links
 */
function initSmoothScroll() {
	document.addEventListener('click', (e) => {
		const link = e.target.closest('a[href*="#"]');
		if (!link) return;

		const href = link.getAttribute('href');
		if (!href || href === '#' || href === '#!') return;

		if (e.defaultPrevented) return;

		try {
			const targetUrl = new URL(link.href, window.location.href);
			if (targetUrl.pathname !== window.location.pathname || targetUrl.hostname !== window.location.hostname) {
				return;
			}

			const hash = targetUrl.hash;
			if (!hash || hash === '#') return;

			const targetId = decodeURIComponent(hash.substring(1));
			const targetElement = document.getElementById(targetId) || document.querySelector(`[name="${targetId}"]`);

			if (targetElement) {
				const computedBehavior = getComputedStyle(document.documentElement).scrollBehavior;
				if (computedBehavior === 'smooth' || document.documentElement.classList.contains('has-smooth-scroll')) {
					e.preventDefault();

					// Close off-canvas drawer if opened
					if (document.body.classList.contains('off-canvas-opened')) {
						const closeBtn = document.querySelector('[data-close="off-canvas"]') || document.querySelector('.off-canvas-backdrop');
						if (closeBtn) closeBtn.click();
					}

					const adminBar = document.getElementById('wpadminbar');
					const adminBarHeight = adminBar ? adminBar.offsetHeight : 0;

					const customOffsetStr = getComputedStyle(document.documentElement).getPropertyValue('--gravisain-scroll-offset');
					const customOffset = parseInt(customOffsetStr, 10) || 80;

					const totalOffset = adminBarHeight + customOffset;
					const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - totalOffset;

					window.scrollTo({
						top: Math.max(0, targetPosition),
						behavior: 'smooth'
					});

					if (history.pushState) {
						history.pushState(null, '', hash);
					} else {
						window.location.hash = hash;
					}
				}
			}
		} catch (err) {}
	});
}


