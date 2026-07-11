/**
 * Slim marketing theme JS (Phase 4).
 * Vanilla only — no jQuery / Stellar / Waypoints.
 * Keep: #ftco-loader dismiss.
 */

(function () {
	'use strict';

	function dismissLoader() {
		var loader = document.getElementById('ftco-loader');
		if (!loader) {
			return;
		}
		window.setTimeout(function () {
			loader.classList.remove('show');
		}, 1);
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', dismissLoader);
	} else {
		dismissLoader();
	}
})();
