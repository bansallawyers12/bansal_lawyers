<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\SecurityMonitoringService;

class SecurityController extends Controller
{
    protected $monitoringService;
    
    public function __construct(SecurityMonitoringService $monitoringService)
    {
        $this->monitoringService = $monitoringService;
    }
    
    /**
     * Handle CSP violation reports
     */
    public function cspReport(Request $request)
    {
        // Only process if CSP reporting is enabled
        if (!config('security.csp_reporting.enabled', false)) {
            return response('CSP reporting disabled', 204);
        }
        
        // Get the CSP report data
        $report = $request->input('csp-report');
        
        if ($report) {
            // Use monitoring service to log and track violations
            $this->monitoringService->logCspViolation(
                $report,
                $request->ip(),
                $request->userAgent()
            );
        }
        
        return response('CSP report received', 204);
    }
    
    /**
     * Security headers test endpoint (for development)
     */
    public function securityTest(Request $request)
    {
        if (app()->environment('production')) {
            abort(404);
        }
        
        return response()->json([
            'headers' => $request->headers->all(),
            'csp_applied' => $request->headers->has('Content-Security-Policy'),
            'security_headers' => [
                'x_content_type_options' => $request->headers->get('X-Content-Type-Options'),
                'x_frame_options' => $request->headers->get('X-Frame-Options'),
                'x_xss_protection' => $request->headers->get('X-XSS-Protection'),
                'referrer_policy' => $request->headers->get('Referrer-Policy'),
                'permissions_policy' => $request->headers->get('Permissions-Policy'),
                'strict_transport_security' => $request->headers->get('Strict-Transport-Security'),
            ]
        ]);
    }
    
    /**
     * Security monitoring dashboard (admin only)
     */
    public function securityDashboard(Request $request)
    {
        // Only allow admin users
        if (!auth()->guard('admin')->check()) {
            abort(403);
        }
        
        $stats = $this->monitoringService->getViolationStats();
        $recentViolations = $this->monitoringService->getRecentViolations();
        $shouldAlert = $this->monitoringService->shouldAlert();
        
        return response()->json([
            'violation_stats' => $stats,
            'recent_violations' => $recentViolations,
            'alert_status' => $shouldAlert,
            'csp_reporting_enabled' => config('security.csp_reporting.enabled', false),
            'monitoring_enabled' => config('security.monitoring.enabled', true)
        ]);
    }
}
