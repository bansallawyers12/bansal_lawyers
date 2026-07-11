/**
 * Slim legacy theme JS (Phase 1).
 * Keep: #ftco-loader dismiss, Stellar init (2 pages), ftco-animate waypoints.
 * Removed: scrollax, animateNumber, dead nav/logo scroll, carousels, txt-rotate,
 * video modal, case-study helpers, OnePageNav, fullHeight.
 */

window.addEventListener('error', function (e) {
	if (e.message && (
		e.message.includes('particles is undefined') ||
		(e.message.includes("can't access property") && e.message.includes('particles')) ||
		(e.filename && e.filename.includes('stellar'))
	)) {
		e.preventDefault();
		return true;
	}
}, true);

(function ($) {
	'use strict';

	if (!$ || !$.fn) {
		console.warn('main.js: jQuery not available; skipping legacy theme init');
		return;
	}

	var stellarInitialized = false;

	function patchStellarInstance(stellarInstance) {
		if (!stellarInstance) return;
		var originalParticles = stellarInstance.particles;
		try {
			delete stellarInstance.particles;
			Object.defineProperty(stellarInstance, 'particles', {
				get: function () {
					if (this._stellarParticles === undefined || !Array.isArray(this._stellarParticles)) {
						this._stellarParticles = (originalParticles && Array.isArray(originalParticles))
							? originalParticles
							: [];
					}
					return this._stellarParticles;
				},
				set: function (value) {
					this._stellarParticles = (value && Array.isArray(value)) ? value : [];
				},
				enumerable: true,
				configurable: true
			});
			stellarInstance.particles = originalParticles || [];
		} catch (e) {
			if (!stellarInstance.particles || !Array.isArray(stellarInstance.particles)) {
				stellarInstance.particles = [];
			}
		}
	}

	function initStellar() {
		if (stellarInitialized || typeof $.fn.stellar === 'undefined') {
			return;
		}

		var existingInstance = $(window).data('plugin_stellar');
		if (existingInstance) {
			patchStellarInstance(existingInstance);
			stellarInitialized = true;
			return;
		}

		if ($('[data-stellar-background-ratio], [data-stellar-ratio]').length === 0) {
			return;
		}

		try {
			$(window).stellar({
				responsive: true,
				parallaxBackgrounds: true,
				parallaxElements: true,
				horizontalScrolling: false,
				hideDistantElements: false,
				scrollProperty: 'scroll'
			});
			var stellarInstance = $(window).data('plugin_stellar');
			if (stellarInstance) {
				if (!stellarInstance.particles) {
					stellarInstance.particles = [];
				}
				patchStellarInstance(stellarInstance);
			}
			stellarInitialized = true;
		} catch (initError) {
			stellarInitialized = true;
		}
	}

	function initStellarWithRetry(retries) {
		retries = retries || 0;
		if (retries > 10) return;

		if (typeof window.jQuery === 'undefined' || typeof $.fn.stellar === 'undefined') {
			setTimeout(function () {
				initStellarWithRetry(retries + 1);
			}, 100);
			return;
		}

		if ($('[data-stellar-background-ratio], [data-stellar-ratio]').length === 0) {
			return;
		}

		initStellar();
	}

	function dismissLoader() {
		setTimeout(function () {
			if ($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	}

	function contentWayPoint() {
		if ($('.ftco-animate').length === 0) {
			return true;
		}
		if (typeof $.fn.waypoint === 'undefined') {
			return false;
		}

		var i = 0;
		$('.ftco-animate').waypoint(function (direction) {
			if (direction === 'down' && !$(this.element).hasClass('ftco-animated')) {
				i++;
				$(this.element).addClass('item-animate');
				setTimeout(function () {
					$('body .ftco-animate.item-animate').each(function (k) {
						var el = $(this);
						setTimeout(function () {
							var effect = el.data('animate-effect');
							if (effect === 'fadeIn') {
								el.addClass('fadeIn ftco-animated');
							} else if (effect === 'fadeInLeft') {
								el.addClass('fadeInLeft ftco-animated');
							} else if (effect === 'fadeInRight') {
								el.addClass('fadeInRight ftco-animated');
							} else {
								el.addClass('fadeInUp ftco-animated');
							}
							el.removeClass('item-animate');
						}, k * 50);
					});
				}, 100);
			}
		}, { offset: '95%' });
		return true;
	}

	function contentWayPointWithRetry(retries) {
		retries = retries || 0;
		if (contentWayPoint() || retries >= 20) {
			return;
		}
		setTimeout(function () {
			contentWayPointWithRetry(retries + 1);
		}, 100);
	}

	dismissLoader();
	contentWayPointWithRetry(0);
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', function () {
			setTimeout(function () {
				initStellarWithRetry(0);
			}, 500);
		});
	} else {
		setTimeout(function () {
			initStellarWithRetry(0);
		}, 500);
	}
})(window.jQuery);
