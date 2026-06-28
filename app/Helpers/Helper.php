<?php
namespace App\Helpers; // Your helpers namespace 
use Auth;
use Exception;
use Twilio\Rest\Client;

class Helper
{
    public static function sendSms($receiverNumber,$message){
        $receiverNumber = $receiverNumber ?? "+610422905860";
        $message = $message;
    
        try {
            
            $account_sid = config('services.twilio.sid');
            $auth_token = config('services.twilio.token');
            $twilio_number = config('services.twilio.from');
    
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
            $res="SMS sent successfully.";
            return json_encode($res);
    
        } catch (Exception $e) {
            return json_encode($e->getMessage());
            // dd("Error: ". $e->getMessage());
        }
    }

    /**
     * Get Google Analytics configuration
     */
    public static function getAnalyticsConfig()
    {
        return [
            'ga_id' => config('services.google_analytics.id'),
            'gtm_id' => config('services.google_analytics.gtm_id'),
            'is_enabled' => !empty(config('services.google_analytics.id'))
        ];
    }

    /**
     * Check if analytics is enabled
     */
    public static function isAnalyticsEnabled()
    {
        return !empty(config('services.google_analytics.id'));
    }
    public static function changeDateFormate($date,$date_format){
        return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);    
    }
    
    /**
     * Get optimized image URL with WebP support
     * Returns WebP if available, falls back to original
     * 
     * @param string $imagePath Path to image (e.g., 'images/blog/image.jpg')
     * @param bool $checkWebP Whether to check for WebP version
     * @return string URL to image
     */
    public static function optimizedImage($imagePath, $checkWebP = true)
    {
        if (empty($imagePath)) {
            return '';
        }
        
        // Remove leading slash if present
        $imagePath = ltrim($imagePath, '/');
        
        if ($checkWebP) {
            // Check if WebP version exists
            $pathInfo = pathinfo($imagePath);
            $webpPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
            $fullWebpPath = public_path($webpPath);
            
            if (file_exists($fullWebpPath)) {
                return asset($webpPath);
            }
        }
        
        // Fallback to original
        return asset($imagePath);
    }
    
    /**
     * Check if WebP version of image exists
     * 
     * @param string $imagePath Path to original image
     * @return bool
     */
    public static function hasWebP($imagePath)
    {
        if (empty($imagePath)) {
            return false;
        }
        
        $imagePath = ltrim($imagePath, '/');
        $pathInfo = pathinfo($imagePath);
        $webpPath = $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '.webp';
        $fullWebpPath = public_path($webpPath);
        
        return file_exists($fullWebpPath);
    }

    /**
     * Practice-area URL slugs used for nav highlighting (matches HomeController CMS list).
     *
     * @return list<string>
     */
    public static function practiceAreaSlugs(): array
    {
        return [
            'practice-areas',
            'criminal-law', 'family-law', 'personal-law', 'corporate-law',
            'commercial-law', 'property-law', 'migration-law', 'immigration-law',
            'divorce', 'divorce-lawyers-melbourne', 'child-custody', 'family-violence',
            'property-settlement', 'family-violence-orders',
            'juridicational-error-federal-circuit-court-application', 'art-application',
            'visa-refusals-visa-cancellation', 'federal-court-application',
            'intervenition-orders', 'trafic-offences', 'drink-driving-offences', 'assualt-charges',
            'business-law', 'leasing-or-selling-a-business', 'contracts-or-business-agreements',
            'loan-agreement', 'conveyancing', 'building-and-construction-disputes',
            'caveats-disputs-and-removal',
        ];
    }

    /**
     * Whether a main navigation item should render as active on the current page.
     */
    public static function isNavActive(string $section): bool
    {
        $active = self::navActiveSections();

        return $active[$section] ?? false;
    }

    /**
     * @return array<string, bool>
     */
    protected static function navActiveSections(): array
    {
        static $sections = null;

        if ($sections !== null) {
            return $sections;
        }

        $request = request();

        $sections = [
            'about' => $request->is('about'),
            'contact' => $request->is('contact', 'contact/*'),
            'blog' => $request->is('blog', 'blog/*'),
            'case' => self::isCaseNavActive($request),
            'practice' => self::isPracticeNavActive($request),
        ];

        return $sections;
    }

    protected static function isCaseNavActive($request): bool
    {
        if ($request->is('case')) {
            return true;
        }

        if ($request->routeIs('cms.slug')) {
            $slug = $request->route('slug');

            return $slug && \App\Models\RecentCase::where('slug', $slug)->where('status', 1)->exists();
        }

        return false;
    }

    protected static function isPracticeNavActive($request): bool
    {
        if ($request->is(self::practiceAreaSlugs())) {
            return true;
        }

        if ($request->routeIs('cms.slug')) {
            $slug = $request->route('slug');

            return $slug && in_array($slug, self::practiceAreaSlugs(), true);
        }

        return false;
    }
    
}
