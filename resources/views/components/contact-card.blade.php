@php
    $title = $title ?? 'Get Legal Advice';
    $subtitle = $subtitle ?? null;
    $cta = $cta ?? 'Get Legal Advice';
    $variant = $variant ?? 'compact'; // compact | full
    $accent = $accent ?? '#1B4D89';
    $source = $source ?? (request()->path() ?? 'unknown');
@endphp

<style>
    .cc-card { background:#fff; border-radius:20px; box-shadow:0 10px 30px rgba(0,0,0,.1); border:1px solid #f0f0f0; overflow:hidden; }
    .cc-body { padding: 24px; }
    .cc-header { display:flex; gap:12px; align-items:center; margin-bottom:12px; }
    .cc-header img { width:60px; height:68px; border-radius:4px; object-fit:cover; }
    .cc-title { margin:0; font-weight:700; color:#1B4D89; }
    .cc-sub { color:#666; font-size:.95rem; margin-top:4px; }
    .cc-btn { background: linear-gradient(135deg, {{ $accent }}, #2c5aa0); color:#fff; border:0; border-radius:25px; padding:10px 18px; text-transform:uppercase; font-weight:700; }
    .cc-full .cc-body { padding: 32px; }
    @media (max-width: 480px){ .cc-body { padding: 18px; } }
</style>

<div class="cc-card {{ $variant === 'full' ? 'cc-full' : '' }}">
    <div class="cc-body">
        <div class="cc-header">
            <img src="{{ asset('images/bansal_2.jpg') }}" alt="Ajay Bansal - CEO of Bansal Lawyers" width="60" height="68" loading="lazy">
            <div>
                <h4 class="cc-title">{{ $title }}</h4>
                @if($subtitle)
                    <div class="cc-sub">{{ $subtitle }}</div>
                @else
                    <div class="cc-sub">There's No Legal Puzzle, We Can't Solve.</div>
                @endif
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success" style="margin-bottom:14px;">{{ $message }}</div>
        @endif

        <form action="<?php echo URL::to('/'); ?>/contact_lawyer" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="page_source" value="{{ $source }}">
            <div class="form-group"><input type="text" class="form-control" name="name" placeholder="Your Name" required></div>
            <div class="form-group"><input type="email" class="form-control" name="email" placeholder="Your Email" required></div>
            <div class="form-group"><input type="text" class="form-control" name="subject" placeholder="Subject" required></div>
            <div class="form-group"><textarea name="message" rows="5" class="form-control" placeholder="Message" required></textarea></div>
            <div class="form-group" style="text-align:right"><input type="submit" value="{{ $cta }}" class="cc-btn"></div>
        </form>
    </div>
    
</div>


