<nav class="mnav mnav-sticky" aria-label="Primary">
    <div class="mnav-container">
        <a class="mnav-brand" href="<?php echo URL::to('/'); ?>" aria-label="Bansal Lawyers">
            <img src="<?php echo e(asset('images/logo/Bansal_Lawyers.png')); ?>" alt="Bansal Lawyers" class="mnav-logo">
        </a>

        <button id="mnav-toggle" class="mnav-toggle" type="button" aria-label="Toggle navigation" aria-controls="mnav-menu" aria-expanded="false">
            <svg class="mnav-toggle-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <line x1="3" y1="6" x2="21" y2="6" />
                <line x1="3" y1="12" x2="21" y2="12" />
                <line x1="3" y1="18" x2="21" y2="18" />
            </svg>
        </button>

        <div id="mnav-menu" class="mnav-menu" aria-hidden="true">
            <ul class="mnav-links">
                <li><a href="<?php echo URL::to('/'); ?>" class="mnav-link">Home</a></li>
                <li><a href="<?php echo URL::to('/'); ?>/about" class="mnav-link">About</a></li>
                <li><a href="<?php echo URL::to('/'); ?>/practice-areas" class="mnav-link">Practice Areas</a></li>
                <li><a href="<?php echo URL::to('/'); ?>/case" class="mnav-link">Cases</a></li>
                <li><a href="<?php echo URL::to('/'); ?>/blog" class="mnav-link">Blog</a></li>
                <li><a href="<?php echo URL::to('/'); ?>/contact" class="mnav-link">Contact</a></li>
                <li><a href="<?php echo URL::to('/'); ?>/book-an-appointment" class="mnav-cta">Book Consultation</a></li>
            </ul>
        </div>
    </div>
</nav>


<?php /**PATH C:\xampp\htdocs\bansal_lawyers\resources\views/Elements/Frontend/header_modern.blade.php ENDPATH**/ ?>