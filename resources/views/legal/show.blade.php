@extends('layouts.frontend')

@section('seoinfo')
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}" />
<meta name="robots" content="index, follow" />
<link rel="canonical" href="{{ $canonical }}" />
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ asset('images/logo/Bansal_Lawyers.png') }}">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
@endsection

@section('head')
<style>
.page-legal{background:#fff;color:#1e293b}
.page-legal .legal-hero{background:#0f172a;color:#fff;padding:48px 0 36px}
.page-legal .legal-hero h1{margin:12px 0 8px;font-size:2.4rem;line-height:1.2;font-weight:700}
.page-legal .legal-updated{margin:0;color:#cbd5e1;font-size:.95rem}
.page-legal .breadcrumb{display:flex;flex-wrap:wrap;gap:0;background:none;margin:0;padding:0;font-size:.95rem;list-style:none}
.page-legal .breadcrumb-item{display:inline}
.page-legal .breadcrumb-item+.breadcrumb-item::before{content:"/";margin:0 8px;color:#94a3b8}
.page-legal .breadcrumb a{color:#93c5fd;text-decoration:none}
.page-legal .breadcrumb-item.active{color:#e2e8f0}
.page-legal .legal-nav a[aria-current="page"]{font-weight:700;text-decoration:none;color:#0f172a}
.page-legal .legal-body{max-width:760px;margin:0 auto;padding:40px 20px 72px}
.page-legal h2{font-size:1.35rem;margin:2rem 0 .75rem;color:#0f172a}
.page-legal p,.page-legal li{font-size:1.05rem;line-height:1.7;color:#334155}
.page-legal ul{padding-left:1.25rem;margin:0 0 1rem}
.page-legal a{color:#1e40af}
.page-legal .legal-nav{display:flex;flex-wrap:wrap;gap:12px 20px;margin-top:2.5rem;padding-top:1.25rem;border-top:1px solid #e2e8f0}
@media (max-width:480px){.page-legal .legal-hero h1{font-size:1.8rem}}
</style>
@endsection

@section('content')
<article class="page-legal">
    <header class="legal-hero">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $heading }}</li>
                </ol>
            </nav>
            <h1>{{ $heading }}</h1>
            <p class="legal-updated">Last updated: 27 September 2026</p>
        </div>
    </header>
    <div class="legal-body">
        @include('legal.'.$document)
        <nav class="legal-nav" aria-label="Related legal pages">
            <a href="{{ url('/privacy-policy') }}" @if(request()->is('privacy-policy')) aria-current="page" @endif>Privacy Policy</a>
            <a href="{{ url('/disclaimer') }}" @if(request()->is('disclaimer')) aria-current="page" @endif>Disclaimer</a>
            <a href="{{ url('/contact') }}">Contact</a>
        </nav>
    </div>
</article>
@endsection
