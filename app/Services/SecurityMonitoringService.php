<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class SecurityMonitoringService
{
    public function logCspViolation(array $report, string $ip, string $userAgent): void
    {
        if (!config('security.monitoring.enabled', true)) {
            return;
        }
        
        $violation = [
            'timestamp' => now()->toISOString(),
            'ip' => $ip,
            'user_agent' => $userAgent,
            'document_uri' => $report['document-uri'] ?? 'unknown',
            'violated_directive' => $report['violated-directive'] ?? 'unknown',
            'blocked_uri' => $report['blocked-uri'] ?? 'unknown',
            'source_file' => $report['source-file'] ?? 'unknown',
            'line_number' => $report['line-number'] ?? 'unknown',
            'column_number' => $report['column-number'] ?? 'unknown',
            'status_code' => $report['status-code'] ?? 'unknown',
            'original_policy' => $report['original-policy'] ?? 'unknown'
        ];
        
        // Log the violation
        if (config('security.monitoring.log_violations', true)) {
            Log::warning('CSP Violation Detected', $violation);
        }
        
        // Track violation count for alerting
        $this->trackViolationCount($ip);
    }
    
    public function getViolationStats(): array
    {
        $cacheKey = 'csp_violations_stats';
        $stats = Cache::get($cacheKey, [
            'total_violations' => 0,
            'unique_ips' => 0,
            'top_violations' => [],
            'last_24h' => 0
        ]);
        
        return $stats;
    }
    
    public function getRecentViolations(int $limit = 50): array
    {
        // This would typically query a database table
        // For now, we'll return cached data
        return Cache::get('recent_csp_violations', []);
    }
    
    private function trackViolationCount(string $ip): void
    {
        $cacheKey = 'csp_violations_stats';
        $stats = Cache::get($cacheKey, [
            'total_violations' => 0,
            'unique_ips' => 0,
            'top_violations' => [],
            'last_24h' => 0
        ]);
        
        $stats['total_violations']++;
        
        // Track unique IPs
        $ipKey = 'csp_violation_ips';
        $ips = Cache::get($ipKey, []);
        if (!in_array($ip, $ips)) {
            $ips[] = $ip;
            $stats['unique_ips'] = count($ips);
            Cache::put($ipKey, $ips, now()->addHours(24));
        }
        
        Cache::put($cacheKey, $stats, now()->addHours(24));
    }
    
    public function shouldAlert(): bool
    {
        $stats = $this->getViolationStats();
        $threshold = config('security.monitoring.alert_threshold', 10);
        
        return $stats['total_violations'] > $threshold;
    }
}
