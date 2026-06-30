<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\CmsPage;
use App\Models\Appointment;
use App\Models\Contact;
use App\Models\RecentCase;

$admin = Admin::firstOrCreate(
    ['email' => 'sonu@gmail.com'],
    [
        'password' => bcrypt('password'),
        'first_name' => 'Test',
        'last_name' => 'Admin',
        'status' => 1,
    ]
);

Auth::guard('admin')->login($admin);

$staticGetRoutes = collect(Route::getRoutes())->filter(function ($route) {
    return str_starts_with($route->uri(), 'admin/')
        && in_array('GET', $route->methods())
        && ! preg_match('/\{/', $route->uri());
})->map(fn ($r) => '/' . $r->uri())->unique()->values()->all();

$paramRoutes = [
    '/admin/blog/edit/' . base64_encode(convert_uuencode(Blog::query()->value('id') ?? 1)),
    '/admin/blogcategories/edit/' . base64_encode(convert_uuencode(BlogCategory::query()->value('id') ?? 1)),
    '/admin/cms_pages/edit/' . base64_encode(convert_uuencode(CmsPage::query()->value('id') ?? 1)),
    '/admin/recent_case/edit/' . base64_encode(convert_uuencode(RecentCase::query()->value('id') ?? 1)),
    '/admin/admin-users/edit/' . (Admin::query()->value('id') ?? 1),
    '/admin/booking-blocks/edit/1',
    '/admin/contacts/' . (Contact::query()->value('id') ?? 1),
    '/admin/appointments/' . (Appointment::query()->value('id') ?? 1),
    '/admin/appointments/' . (Appointment::query()->value('id') ?? 1) . '/edit',
];

$allRoutes = array_merge($staticGetRoutes, $paramRoutes);

$failures = [];
$passed = 0;

foreach ($allRoutes as $uri) {
    try {
        $request = Illuminate\Http\Request::create($uri, 'GET');
        $request->setLaravelSession($app['session.store']);
        $response = $app->handle($request);
        $status = $response->getStatusCode();

        if ($status >= 500) {
            $content = $response->getContent();
            $snippet = '';
            if (preg_match('/<title>(.*?)<\/title>/s', $content, $m)) {
                $snippet = $m[1];
            } elseif (preg_match('/"message":"([^"]+)"/', $content, $m)) {
                $snippet = $m[1];
            } else {
                $snippet = substr(strip_tags($content), 0, 150);
            }
            $failures[] = [$uri, (string) $status, $snippet];
        } elseif ($status === 404 && preg_match('#/(edit/|contacts/|appointments/\d+)#', $uri)) {
            // Missing record is acceptable for detail/edit routes with fallback id
            $passed++;
        } elseif ($status >= 400) {
            $failures[] = [$uri, (string) $status, 'client error'];
        } else {
            $passed++;
        }
    } catch (Throwable $e) {
        $failures[] = [$uri, 'EXCEPTION', $e->getMessage() . ' @ ' . $e->getFile() . ':' . $e->getLine()];
    }
}

echo "Tested " . count($allRoutes) . " routes; passed: {$passed}\n";

if (empty($failures)) {
    echo "All routes OK\n";
    exit(0);
}

echo "Failures:\n";
foreach ($failures as $f) {
    echo implode(' | ', $f) . "\n";
}
exit(1);
