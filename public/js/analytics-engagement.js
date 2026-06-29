function trackBlogEngagement() {
    let maxScroll = 0;
    window.addEventListener('scroll', function () {
        const scrollPercent = Math.round((window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100);
        if (maxScroll < scrollPercent) {
            maxScroll = scrollPercent;
            if (maxScroll % 25 === 0 && typeof gtag !== 'undefined') {
                gtag('event', 'scroll_depth', {
                    event_category: 'Blog Engagement',
                    event_label: maxScroll + '%',
                    value: maxScroll,
                });
            }
        }
    });

    const startTime = Date.now();
    window.addEventListener('pagehide', function () {
        const readingTime = Math.round((Date.now() - startTime) / 1000);
        if (readingTime > 10 && typeof gtag !== 'undefined') {
            gtag('event', 'reading_time', {
                event_category: 'Blog Engagement',
                event_label: 'Time on Page',
                value: readingTime,
            });
        }
    });

    document.addEventListener('click', function (e) {
        if (e.target.matches('.experimental-share-btn, .share-btn') && typeof gtag !== 'undefined') {
            const platform = e.target.classList.contains('facebook') ? 'Facebook'
                : e.target.classList.contains('twitter') ? 'Twitter'
                : e.target.classList.contains('linkedin') ? 'LinkedIn' : 'Unknown';
            gtag('event', 'social_share', {
                event_category: 'Social Media',
                event_label: platform,
                value: 1,
            });
        }
    });

    document.addEventListener('click', function (e) {
        if (e.target.matches('a[href*="bansallawyers.com.au"]') && typeof gtag !== 'undefined') {
            gtag('event', 'internal_link_click', {
                event_category: 'Navigation',
                event_label: e.target.href,
                value: 1,
            });
        }
    });

    document.addEventListener('submit', function (e) {
        if (e.target.matches('form[action*="contact"], form[id*="contact"], form[class*="contact"]') && typeof gtag !== 'undefined') {
            gtag('event', 'contact_form_submit', {
                event_category: 'Lead Generation',
                event_label: 'Contact Form',
                value: 1,
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const contactForms = document.querySelectorAll('form[action*="contact"], form[id*="contact"], form[class*="contact"]');
        if (contactForms.length > 0 && typeof gtag !== 'undefined') {
            gtag('event', 'contact_form_view', {
                event_category: 'Lead Generation',
                event_label: 'Form Displayed',
            });
        }
    });
}

document.addEventListener('DOMContentLoaded', trackBlogEngagement);

function toggleFAQ(index) {
    const answer = document.getElementById('faq-answer-' + index);
    const icon = document.getElementById('faq-icon-' + index);
    if (!answer || !icon) return;

    if (answer.style.maxHeight === '0px' || answer.style.maxHeight === '') {
        answer.style.maxHeight = answer.scrollHeight + 'px';
        answer.style.padding = '0 20px';
        icon.textContent = '−';
        icon.style.transform = 'rotate(180deg)';
    } else {
        answer.style.maxHeight = '0px';
        answer.style.padding = '0 20px';
        icon.textContent = '+';
        icon.style.transform = 'rotate(0deg)';
    }
}
