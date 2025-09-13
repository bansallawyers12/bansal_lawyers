// AOS initialization with proper guards
document.addEventListener("DOMContentLoaded", function() {
	// Check if AOS is available and DOM elements exist
	if (typeof AOS !== 'undefined') {
		// Check if there are any AOS elements on the page
		var aosElements = document.querySelectorAll('[data-aos]');
		if (aosElements.length > 0) {
			AOS.init({
				duration: 800,
				easing: 'slide'
			});
		}
	}
});

(function ($) {

	"use strict";

	var isMobile = {
		Android: function () {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function () {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function () {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function () {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function () {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function () {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};


	$(window).stellar({
		responsive: true,
		parallaxBackgrounds: true,
		parallaxElements: true,
		horizontalScrolling: false,
		hideDistantElements: false,
		scrollProperty: 'scroll'
	});


	var fullHeight = function () {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function () {
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	// loader
	var loader = function () {
		setTimeout(function () {
			if ($('#ftco-loader').length > 0) {
				$('#ftco-loader').removeClass('show');
			}
		}, 1);
	};
	loader();

	// Scrollax
	$.Scrollax();

	var carousel = function () {
		$('.carousel-testimony').owlCarousel({
			center: true,
			loop: true,
			items: 7,
			margin: 30,
			stagePadding: 0,
			nav: false,   // Show next/prev buttons
			autoplay: true, // Auto carousel enabled
			autoplayTimeout: 2000, // Change slides every 2s
			autoplayHoverPause: true, // Pause on hover
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive: {
				0: {
					items: 1  // Mobile
				},
				600: {
					items: 2  // Tablets
				},
				1000: {
					items: 3  // Desktop
				}
			}
		});

		$('.carousel-case').owlCarousel({
			center: true,
			loop: true,
			items: 6,
			margin: 30,
			stagePadding: 0,
			nav: true, // Show next/prev buttons
			autoplay: true, // Auto carousel enabled
			autoplayTimeout: 2000, // Change slides every 2s
			autoplayHoverPause: true, // Pause on hover
			navText: ['<span class="ion-ios-arrow-back">', '<span class="ion-ios-arrow-forward">'],
			responsive: {
				0: {
					items: 1, // Mobile View
					margin: 10,
					center: false
				},
				600: {
					items: 2, // Tablet View
					margin: 20
				},
				1000: {
					items: 3  // Desktop
				}
			}
		});

	};
	carousel();

	$('nav .dropdown').hover(function () {
		var $this = $(this);
		// 	 timer;
		// clearTimeout(timer);
		$this.addClass('show');
		$this.find('> a').attr('aria-expanded', true);
		// $this.find('.dropdown-menu').addClass('animated-fast fadeInUp show');
		$this.find('.dropdown-menu').addClass('show');
	}, function () {
		var $this = $(this);
		// timer;
		// timer = setTimeout(function(){
		$this.removeClass('show');
		$this.find('> a').attr('aria-expanded', false);
		// $this.find('.dropdown-menu').removeClass('animated-fast fadeInUp show');
		$this.find('.dropdown-menu').removeClass('show');
		// }, 100);
	});


	$('#dropdown04').on('show.bs.dropdown', function () {
		console.log('show');
	});

	// scroll
	var scrollWindow = function () {
		$(window).scroll(function () {
			var $w = $(this),
				st = $w.scrollTop(),
				navbar = $('.ftco_navbar'),
				sd = $('.js-scroll-wrap');
            
			if (st > 150) {
				if (!navbar.hasClass('scrolled')) {
					navbar.addClass('scrolled');
				}  
			}
			if (st < 150) {
				if (navbar.hasClass('scrolled')) {
					navbar.removeClass('scrolled sleep');
				}
			}
			if (st > 350) {
				if (!navbar.hasClass('awake')) {
					navbar.addClass('awake');
				}

				if (sd.length > 0) {
					sd.addClass('sleep');
				}
			}
			if (st < 350) {
				if (navbar.hasClass('awake')) {
					navbar.removeClass('awake');
					navbar.addClass('sleep');
				}
				if (sd.length > 0) {
					sd.removeClass('sleep');
				}
			}
			
            if (navbar.hasClass('scrolled')) {
				$("#image_logo").attr("src", "https://www.bansallawyers.com.au/public/images/logo/Bansal_Lawyers_scroll.png?timestamp=" + new Date().getTime());
			} else {
                $("#image_logo").attr("src", "https://www.bansallawyers.com.au/public/images/logo/Bansal_Lawyers.png?timestamp=" + new Date().getTime());
            }
			
		});
	};
	scrollWindow();

	var isMobile = {
		Android: function () {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function () {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function () {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function () {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function () {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function () {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	var counter = function () {

		$('#section-counter, .hero-wrap, .ftco-counter').waypoint(function (direction) {

			if (direction === 'down' && !$(this.element).hasClass('ftco-animated')) {

				var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',')
				$('.number').each(function () {
					var $this = $(this),
						num = $this.data('number');
					console.log(num);
					$this.animateNumber(
						{
							number: num,
							numberStep: comma_separator_number_step
						}, 7000
					);
				});

			}

		}, { offset: '95%' });

	}
	counter();


	var contentWayPoint = function () {
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
						}, k * 50, 'easeInOutExpo');
					});

				}, 100);

			}

		}, { offset: '95%' });
	};
	contentWayPoint();


	// navigation
	var OnePageNav = function () {
		$(".smoothscroll[href^='#'], #ftco-nav ul li a[href^='#']").on('click', function (e) {
			e.preventDefault();

			var hash = this.hash,
				navToggler = $('.navbar-toggler');
			$('html, body').animate({
				scrollTop: $(hash).offset().top
			}, 700, 'easeInOutExpo', function () {
				window.location.hash = hash;
			});


			if (navToggler.is(':visible')) {
				navToggler.click();
			}
		});
		$('body').on('activate.bs.scrollspy', function () {
			console.log('nice');
		})
	};
	OnePageNav();


	// magnific popup
	$('.image-popup').magnificPopup({
		type: 'image',
		closeOnContentClick: true,
		closeBtnInside: false,
		fixedContentPos: true,
		mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			verticalFit: true
		},
		zoom: {
			enabled: true,
			duration: 300 // don't foget to change the duration also in CSS
		}
	});

	$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
		disableOn: 700,
		type: 'iframe',
		mainClass: 'mfp-fade',
		removalDelay: 160,
		preloader: false,

		fixedContentPos: false
	});


	var TxtRotate = function (el, toRotate, period) {
		this.toRotate = toRotate;
		this.el = el;
		this.loopNum = 0;
		this.period = parseInt(period, 10) || 2000;
		this.txt = '';
		this.tick();
		this.isDeleting = false;
	};

	TxtRotate.prototype.tick = function () {
		var i = this.loopNum % this.toRotate.length;
		var fullTxt = this.toRotate[i];

		if (this.isDeleting) {
			this.txt = fullTxt.substring(0, this.txt.length - 1);
		} else {
			this.txt = fullTxt.substring(0, this.txt.length + 1);
		}

		this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';

		var that = this;
		var delta = 300 - Math.random() * 100;

		if (this.isDeleting) { delta /= 2; }

		if (!this.isDeleting && this.txt === fullTxt) {
			delta = this.period;
			this.isDeleting = true;
		} else if (this.isDeleting && this.txt === '') {
			this.isDeleting = false;
			this.loopNum++;
			delta = 500;
		}

		setTimeout(function () {
			that.tick();
		}, delta);
	};

	window.onload = function () {
		var elements = document.getElementsByClassName('txt-rotate');
		for (var i = 0; i < elements.length; i++) {
			var toRotate = elements[i].getAttribute('data-rotate');
			var period = elements[i].getAttribute('data-period');
			if (toRotate) {
				new TxtRotate(elements[i], JSON.parse(toRotate), period);
			}
		}
	};

})(jQuery);

document.addEventListener("DOMContentLoaded", function () {
	const text = "There’s No Legal Puzzle That We Can’t Solve";
	const element = document.getElementById("welcome-text");

	// Guard against pages where the element is not present
	if (element) {
		// Set the full text and allow CSS animation to handle it
		element.textContent = text;
		// Add a class to trigger the animation (if needed dynamically)
		element.classList.add('animated-typing');
	}
});

                                        

document.addEventListener("DOMContentLoaded", function () { 
	var videoSection = document.querySelector(".img-video"); // Select video section
    var modalOpened = false; // Prevent multiple triggers

	function checkIfInView() {
		// Fix: Add null check to prevent getBoundingClientRect errors
		if (!videoSection) {
			console.warn('Video section element not found, skipping scroll check');
			return;
		}
		var rect = videoSection.getBoundingClientRect();
		var windowHeight = window.innerHeight || document.documentElement.clientHeight;
		var sectionCenter = rect.top + rect.height / 2; // Get the center position of the section
		var viewportCenter = windowHeight / 2; // Get the center of the viewport

		// Check if the section's center is near the viewport's center
		if (Math.abs(sectionCenter - viewportCenter) < 30 && !modalOpened) { 
			openVideoModal();
			modalOpened = true; // Prevent reopening
		}
	}

    function openVideoModal() {
        var modal = document.getElementById("videoModal");
        var iframe = document.getElementById("videoIframe");
		if (modal && iframe) {
            //iframe.src = "https://www.youtube.com/embed/3GZvPE99x6Y?autoplay=1";
			iframe.src = "https://www.youtube.com/embed/3GZvPE99x6Y?autoplay=1&mute=1&rel=0&playsinline=1";
            modal.style.display = "block";
        }
    }

    function closeVideoModal() {
        var modal = document.getElementById("videoModal");
        var iframe = document.getElementById("videoIframe");

        if (modal && iframe) {
            iframe.src = "";
            modal.style.display = "none";
        }
    }

    // Listen for scroll event
    window.addEventListener("scroll", checkIfInView);
});                                            
                                            

function openVideoModal() {
	var modal = document.getElementById("videoModal");
	var iframe = document.getElementById("videoIframe");

	if (modal && iframe) {
		// Updated YouTube embed URL with autoplay enabled
		iframe.src = "https://www.youtube.com/embed/3GZvPE99x6Y?autoplay=1";

		// Display the modal
		modal.style.display = "block";
	}
}

function closeVideoModal() {
	var modal = document.getElementById("videoModal");
	var iframe = document.getElementById("videoIframe");

	if (modal && iframe) {
		// Reset the iframe src to stop the video
		iframe.src = "";

		// Hide the modal
		modal.style.display = "none";
	}
}




// case study script //

const caseData = {
	1: {
		title: "Corporate Legal Separation",
		content: `
	  <h2 style="color: yellow;">Corporate Legal Separation</h2>
	  <p style="color: white;">We helped a multinational company navigate a challenging corporate separation. Our expertise in corporate law ensured a smooth transition, protecting the interests of both parties and avoiding legal pitfalls. This case highlights our ability to deliver innovative solutions to complex legal challenges.</p>
	`
	},
	2: {
		title: "Intellectual Property Protection",
		content: `
	  <h2 style="color: yellow;">Intellectual Property Protection</h2>
	  <p style="color: white;">Bansal Lawyers secured crucial trademarks and patents for a technology startup, protecting their innovations and market position. We provided end-to-end support, from filing applications to defending intellectual property in court, ensuring the client’s competitive advantage.</p>
	`
	},
	3: {
		title: "Employment Law Dispute",
		content: `
	  <h2 style="color: yellow;">Employment Law Dispute</h2>
	  <p style="color: white;">Our team successfully resolved a labor dispute between a company and its former employee, avoiding lengthy litigation. By prioritizing mediation and negotiation, we achieved a fair settlement that upheld workplace policies and maintained harmony within the organization.</p>
	`
	},
	4: {
		title: "Real Estate Transaction",
		content: `
	  <h2 style="color: yellow;">Real Estate Transaction</h2>
	  <p style="color: white;">We facilitated a large-scale real estate acquisition for a developer, ensuring compliance with regulatory requirements. Our detailed legal review and proactive advice minimized risks and secured favorable terms for the client, exemplifying our dedication to excellence in real estate law.</p>
	`
	},
	5: {
		title: "Criminal Defense Victory",
		content: `
	  <h2 style="color: yellow;">Criminal Defense Victory</h2>
	  <p style="color: white;">Bansal Lawyers provided exceptional representation in a high-profile criminal case, achieving an acquittal for our client. Our strategic defense, thorough investigation, and in-depth knowledge of criminal law led to this landmark victory.</p>
	`
	},
	6: {
		title: "Family Law Resolution",
		content: `
	  <h2 style="color: yellow;">Family Law Resolution</h2>
	  <p style="color: white;">In a sensitive family law case, we helped our client achieve a fair resolution in child custody and asset division. Our compassionate approach and legal expertise ensured the best outcome, maintaining our client’s dignity and protecting their future.</p>
	`
	}
};

function showCaseDetails(caseId) {
	const descriptionSection = document.getElementById("case-description");
	const detailsContainer = document.getElementById("case-details");

	// Inject the content for the selected case
	detailsContainer.innerHTML = caseData[caseId].content;

	// Display the description section
	descriptionSection.style.display = "block";

	// Scroll to the description section
	descriptionSection.scrollIntoView({ behavior: "smooth" });
}


