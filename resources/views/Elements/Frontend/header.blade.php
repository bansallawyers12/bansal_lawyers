<nav class="navbar px-md-0 navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="<?php echo URL::to('/'); ?>" style="/*background: #fff; padding: 3px 5px; border-radius: 5px; */ margin-left: -10px;">
            <img id="image_logo" src="{{asset('images/logo/Bansal_Lawyers.png')}}" alt="Bansal Lawyers – Best Law Firm in Australia" style="height: 50px; max-width: 100%; object-fit: contain; width: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="<?php echo URL::to('/'); ?>" class="nav-link" style="color: white;"
                        onmouseover="this.style.color='red'; this.style.fontWeight='bold'"
                        onmouseout="this.style.color='white'; this.style.fontWeight='normal'">Home</a></li>
                <li class="nav-item"><a href="<?php echo URL::to('/'); ?>/about" class="nav-link" style="color: white;"
                        onmouseover="this.style.color='red'; this.style.fontWeight='bold'"
                        onmouseout="this.style.color='white'; this.style.fontWeight='normal'">About</a></li>

                <li class="nav-item"><a href="<?php echo URL::to('/'); ?>/practice-areas" class="nav-link" style="color: white;"
                        onmouseover="this.style.color='red'; this.style.fontWeight='bold'"
                        onmouseout="this.style.color='white'; this.style.fontWeight='normal'">Practice Areas</a>
                </li>
                <li class="nav-item"><a href="<?php echo URL::to('/'); ?>/case" class="nav-link" style="color: white;"
                        onmouseover="this.style.color='red'; this.style.fontWeight='bold'"
                        onmouseout="this.style.color='white'; this.style.fontWeight='normal'">Recent Court cases</a></li>
                <li class="nav-item"><a href="<?php echo URL::to('/'); ?>/blog" class="nav-link" style="color: white;"
                        onmouseover="this.style.color='red'; this.style.fontWeight='bold'"
                        onmouseout="this.style.color='white'; this.style.fontWeight='normal'">Blog</a></li>
                <li class="nav-item"><a href="<?php echo URL::to('/'); ?>/contact" class="nav-link" style="color: white;"
                        onmouseover="this.style.color='red'; this.style.fontWeight='bold'"
                        onmouseout="this.style.color='white'; this.style.fontWeight='normal'">Contact</a></li>

                <li class="nav-item cta"><a href="<?php echo URL::to('/'); ?>/book-an-appointment" class="nav-link"
                        style="color: white; font-weight: normal;"
                        onmouseover="this.style.fontWeight='normal'; this.style.color='white'"
                        onmouseout="this.style.fontWeight='normal'; this.style.color='white'">Schedule Your Consultation</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
