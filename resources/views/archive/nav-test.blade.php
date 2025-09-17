<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modern Nav Test</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css'])
    <style>
      .shadow-safe{ box-shadow: 0 1px 2px rgba(0,0,0,.06), 0 1px 3px rgba(0,0,0,.1) }
    </style>
    <script>
      document.addEventListener('DOMContentLoaded',function(){
        var btn=document.getElementById('nav-toggle');
        var menu=document.getElementById('nav-menu');
        if(btn&&menu){
          btn.addEventListener('click',function(){
            var isHidden=menu.getAttribute('aria-hidden')==='true';
            menu.setAttribute('aria-hidden', String(!isHidden));
            menu.classList.toggle('hidden');
            btn.setAttribute('aria-expanded', String(isHidden));
          });
        }
      });
    </script>
  </head>
  <body class="bg-gray-50">
    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur border-b border-gray-200">
      <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
          <a href="/" class="flex items-center gap-3">
            <img src="{{ asset('images/logo/Bansal_Lawyers.png') }}" alt="Bansal Lawyers" class="h-9 w-auto"/>
            <span class="sr-only">Bansal Lawyers</span>
          </a>
          <button id="nav-toggle" type="button" class="inline-flex items-center justify-center rounded-md p-2 text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 sm:hidden" aria-controls="nav-menu" aria-expanded="false" aria-label="Toggle navigation">
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
          </button>
          <div class="hidden sm:flex items-center gap-6">
            <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 transition">Home</a>
            <a href="{{ url('/about') }}" class="text-gray-700 hover:text-blue-600 transition">About</a>
            <a href="{{ url('/practice-areas') }}" class="text-gray-700 hover:text-blue-600 transition">Practice Areas</a>
            <a href="{{ url('/case') }}" class="text-gray-700 hover:text-blue-600 transition">Cases</a>
            <a href="{{ url('/blog') }}" class="text-gray-700 hover:text-blue-600 transition">Blog</a>
            <a href="{{ url('/contact') }}" class="text-gray-700 hover:text-blue-600 transition">Contact</a>
            <a href="{{ url('/book-an-appointment') }}" class="inline-flex items-center rounded-full bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 transition shadow-safe">Book Consultation</a>
          </div>
        </div>
        <div id="nav-menu" class="sm:hidden hidden" aria-hidden="true">
          <div class="space-y-1 pb-4 pt-2">
            <a href="{{ url('/') }}" class="block rounded-md px-3 py-2 text-base text-gray-700 hover:bg-gray-100">Home</a>
            <a href="{{ url('/about') }}" class="block rounded-md px-3 py-2 text-base text-gray-700 hover:bg-gray-100">About</a>
            <a href="{{ url('/practice-areas') }}" class="block rounded-md px-3 py-2 text-base text-gray-700 hover:bg-gray-100">Practice Areas</a>
            <a href="{{ url('/case') }}" class="block rounded-md px-3 py-2 text-base text-gray-700 hover:bg-gray-100">Cases</a>
            <a href="{{ url('/blog') }}" class="block rounded-md px-3 py-2 text-base text-gray-700 hover:bg-gray-100">Blog</a>
            <a href="{{ url('/contact') }}" class="block rounded-md px-3 py-2 text-base text-gray-700 hover:bg-gray-100">Contact</a>
            <a href="{{ url('/book-an-appointment') }}" class="mt-2 block rounded-full bg-blue-600 px-4 py-2 text-center text-white hover:bg-blue-700">Book Consultation</a>
          </div>
        </div>
      </nav>
    </header>

    <main class="max-w-7xl mx-auto p-6">
      <h1 class="text-2xl font-semibold text-gray-900">Modern Navigation Test</h1>
      <p class="mt-2 text-gray-600">Use this page to verify the new navbar behavior, colors, and responsiveness without touching existing templates.</p>
      <div class="mt-8 h-96 rounded-lg bg-white shadow-safe flex items-center justify-center text-gray-500">Content placeholder</div>
    </main>
  </body>
</html>


