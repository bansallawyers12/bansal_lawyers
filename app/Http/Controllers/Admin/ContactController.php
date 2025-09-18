<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommonMail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContactController extends Controller
{
    /**
     * Display a listing of the contacts.
     */
    public function index(Request $request)
    {
        $query = Contact::query()->orderBy('created_at', 'desc');
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('contact_email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }
        
        // Date filter
        if ($request->filled('date_from')) {
            $query->where('created_at', '>=', $request->date_from . ' 00:00:00');
        }
        
        if ($request->filled('date_to')) {
            $query->where('created_at', '<=', $request->date_to . ' 23:59:59');
        }
        
        // Status filter (we'll add a status field if needed)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $contacts = $query->paginate(20)->appends($request->all());
        
        // Get statistics
        $stats = [
            'total' => Contact::count(),
            'today' => Contact::whereDate('created_at', today())->count(),
            'this_week' => Contact::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'this_month' => Contact::whereMonth('created_at', now()->month)->count(),
        ];
        
        return view('Admin.contacts.index', compact('contacts', 'stats'));
    }
    
    /**
     * Display the specified contact.
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        
        // Mark as read if there's a status field
        if ($contact->status === null || $contact->status === 'unread') {
            $contact->status = 'read';
            $contact->save();
        }
        
        return view('Admin.contacts.show', compact('contact'));
    }
    
    /**
     * Send contact details to info@bansallawyers.com.au for further processing.
     */
    public function sendToBansalEmail(Request $request, $id)
    {
        try {
            \Log::info('SendToBansalEmail called for contact ID: ' . $id);
            $contact = Contact::findOrFail($id);
            \Log::info('Contact found: ' . $contact->name);
            
            // Check if already forwarded
            if ($contact->status === 'forwarded' && $contact->forwarded_at) {
                return response()->json([
                    'success' => false,
                    'message' => 'This contact has already been forwarded on ' . $contact->forwarded_at->format('d/m/Y H:i:s')
                ], 400, [], JSON_UNESCAPED_UNICODE);
            }
            
            $emailBody = $this->formatContactEmailBody($contact, 'This contact query has been forwarded for further processing.');
            $emailSubject = '🔔 New Contact Query: ' . $contact->subject . ' - ' . $contact->name;
            $senderEmail = 'Info@bansallawyers.com.au';
            $senderName = 'Bansal Lawyers';
            $attachments = [];
            
            Mail::to('info@bansallawyers.com.au')->send(new CommonMail($emailBody, $emailSubject, $senderEmail, $senderName, $attachments));
            
            // Update contact status
            $contact->status = 'forwarded';
            $contact->forwarded_at = now();
            $contact->forwarded_to = 'info@bansallawyers.com.au';
            $contact->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Contact query sent to info@bansallawyers.com.au successfully'
            ], 200, [], JSON_UNESCAPED_UNICODE);
            
        } catch (\Exception $e) {
            \Log::error('Failed to send contact to Bansal email: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to send email: ' . $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    
    /**
     * Mark contact as resolved/unresolved.
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $contact = Contact::findOrFail($id);
            
            $request->validate([
                'status' => 'required|in:unread,read,resolved,archived'
            ]);
            
            $contact->status = $request->status;
            $contact->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Contact status updated successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Delete the specified contact.
     */
    public function destroy($id)
    {
        try {
            $contact = Contact::findOrFail($id);
            $contact->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Contact deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete contact: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Bulk send contacts to Bansal email.
     */
    public function bulkSendToBansalEmail(Request $request)
    {
        try {
            $request->validate([
                'contact_ids' => 'required|array',
                'contact_ids.*' => 'exists:contacts,id'
            ]);
            
            $contacts = Contact::whereIn('id', $request->contact_ids)->get();
            $sentCount = 0;
            
            foreach ($contacts as $contact) {
                try {
                    // Check if already forwarded
                    if ($contact->status === 'forwarded' && $contact->forwarded_at) {
                        \Log::info('Skipping contact ' . $contact->id . ' - already forwarded on ' . $contact->forwarded_at->format('d/m/Y H:i:s'));
                        continue;
                    }
                    
                    $emailBody = $this->formatContactEmailBody($contact, 'This contact query has been forwarded for further processing.');
                    $emailSubject = '🔔 New Contact Query: ' . $contact->subject . ' - ' . $contact->name;
                    $senderEmail = 'Info@bansallawyers.com.au';
                    $senderName = 'Bansal Lawyers';
                    $attachments = [];
                    
                    Mail::to('info@bansallawyers.com.au')->send(new CommonMail($emailBody, $emailSubject, $senderEmail, $senderName, $attachments));
                    
                    // Update contact status
                    $contact->status = 'forwarded';
                    $contact->forwarded_at = now();
                    $contact->forwarded_to = 'info@bansallawyers.com.au';
                    $contact->save();
                    
                    $sentCount++;
                } catch (\Exception $e) {
                    // Log error but continue with other contacts
                    \Log::error('Failed to send contact ' . $contact->id . ' to Bansal email: ' . $e->getMessage());
                }
            }
            
            return response()->json([
                'success' => true,
                'message' => $sentCount . ' contact(s) sent to info@bansallawyers.com.au successfully',
                'count' => $sentCount
            ], 200, [], JSON_UNESCAPED_UNICODE);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send contacts: ' . $e->getMessage()
            ], 500, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Bulk delete contacts.
     */
    public function bulkDelete(Request $request)
    {
        try {
            $request->validate([
                'contact_ids' => 'required|array',
                'contact_ids.*' => 'exists:contacts,id'
            ]);
            
            Contact::whereIn('id', $request->contact_ids)->delete();
            
            return response()->json([
                'success' => true,
                'message' => count($request->contact_ids) . ' contacts deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete contacts: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Export contacts to CSV.
     */
    public function export(Request $request)
    {
        $query = Contact::query()->orderBy('created_at', 'desc');
        
        // Apply same filters as index
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('contact_email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('date_from')) {
            $query->where('created_at', '>=', $request->date_from . ' 00:00:00');
        }
        
        if ($request->filled('date_to')) {
            $query->where('created_at', '<=', $request->date_to . ' 23:59:59');
        }
        
        $contacts = $query->get();
        
        $filename = 'contacts_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($contacts) {
            $file = fopen('php://output', 'w');
            
            // Add CSV headers
            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Subject',
                'Message',
                'Status',
                'Submitted At',
                'Forwarded To',
                'Forwarded At'
            ]);
            
            // Add data rows
            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->id,
                    $contact->name,
                    $contact->contact_email,
                    $contact->subject,
                    $contact->message,
                    $contact->status ?? 'unread',
                    $contact->created_at->format('Y-m-d H:i:s'),
                    $contact->forwarded_to ?? '',
                    $contact->forwarded_at ? $contact->forwarded_at->format('Y-m-d H:i:s') : ''
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    /**
     * Format contact details for email body.
     */
    private function formatContactEmailBody($contact, $additionalMessage = null)
    {
        $body = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Contact Query Forwarded - Bansal Lawyers</title>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                body { 
                    font-family: "Poppins", Arial, sans-serif; 
                    line-height: 1.6; 
                    color: #2c3e50; 
                    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                    margin: 0; 
                    padding: 20px; 
                }
                .email-container { 
                    max-width: 650px; 
                    margin: 0 auto; 
                    background: #ffffff; 
                    border-radius: 12px; 
                    overflow: hidden;
                    box-shadow: 0 20px 40px rgba(27, 77, 137, 0.1);
                }
                .header { 
                    background: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%);
                    color: white; 
                    padding: 40px 30px; 
                    text-align: center;
                    position: relative;
                }
                .header::before {
                    content: "";
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: url("data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.05"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
                }
                .header-content {
                    position: relative;
                    z-index: 2;
                }
                .logo {
                    width: 60px;
                    height: 60px;
                    background: #ffffff;
                    border-radius: 50%;
                    margin: 0 auto 20px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 24px;
                    font-weight: 700;
                    color: #1B4D89;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                }
                .header h1 { 
                    margin: 0 0 10px 0; 
                    font-size: 28px; 
                    font-weight: 600;
                    letter-spacing: -0.5px;
                }
                .header p { 
                    margin: 0; 
                    font-size: 16px; 
                    opacity: 0.9;
                    font-weight: 300;
                }
                .content { padding: 40px 30px; }
                .contact-details { 
                    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
                    padding: 30px; 
                    border-radius: 12px; 
                    margin: 30px 0; 
                    border: 1px solid #e9ecef;
                    position: relative;
                }
                .contact-details::before {
                    content: "";
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    height: 4px;
                    background: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%);
                    border-radius: 12px 12px 0 0;
                }
                .section-title {
                    font-size: 20px;
                    font-weight: 600;
                    color: #1B4D89;
                    margin: 0 0 25px 0;
                    display: flex;
                    align-items: center;
                }
                .section-title::before {
                    content: "👤";
                    margin-right: 10px;
                    font-size: 18px;
                }
                .field { 
                    margin-bottom: 20px; 
                    display: flex;
                    align-items: flex-start;
                }
                .field-label { 
                    font-weight: 600; 
                    color: #1B4D89; 
                    min-width: 100px;
                    font-size: 14px;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                }
                .field-value { 
                    color: #2c3e50; 
                    flex: 1;
                    font-size: 15px;
                }
                .field-value a {
                    color: #1B4D89;
                    text-decoration: none;
                    font-weight: 500;
                }
                .field-value a:hover {
                    text-decoration: underline;
                }
                .message-box { 
                    background: linear-gradient(135deg, #e8f4f8 0%, #f0f8ff 100%);
                    padding: 30px; 
                    border-left: 4px solid #1B4D89; 
                    margin: 30px 0; 
                    border-radius: 0 12px 12px 0;
                    position: relative;
                }
                .message-box::before {
                    content: "💬";
                    position: absolute;
                    top: 20px;
                    right: 20px;
                    font-size: 20px;
                }
                .message-title {
                    font-size: 18px;
                    font-weight: 600;
                    color: #1B4D89;
                    margin: 0 0 15px 0;
                }
                .message-content {
                    white-space: pre-wrap; 
                    margin: 0; 
                    line-height: 1.7;
                    color: #2c3e50;
                }
                .status-badge { 
                    display: inline-block; 
                    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
                    color: white; 
                    padding: 6px 16px; 
                    border-radius: 20px; 
                    font-size: 12px; 
                    font-weight: 600;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                }
                .additional-notes {
                    background: linear-gradient(135deg, #fff3cd 0%, #fef3c7 100%);
                    padding: 25px; 
                    border-left: 4px solid #F59E0B; 
                    margin: 30px 0; 
                    border-radius: 0 12px 12px 0;
                    position: relative;
                }
                .additional-notes::before {
                    content: "📝";
                    position: absolute;
                    top: 20px;
                    right: 20px;
                    font-size: 18px;
                }
                .additional-notes h4 {
                    margin: 0 0 10px 0; 
                    color: #92400e;
                    font-size: 16px;
                    font-weight: 600;
                }
                .additional-notes p {
                    margin: 0; 
                    color: #92400e;
                    font-size: 14px;
                }
                .footer { 
                    background: linear-gradient(135deg, #1B4D89 0%, #2c5aa0 100%);
                    color: white;
                    padding: 30px; 
                    text-align: center;
                    position: relative;
                }
                .footer::before {
                    content: "";
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: url("data:image/svg+xml,%3Csvg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.03"%3E%3Cpath d="M20 20c0-11.046-8.954-20-20-20v20h20z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
                }
                .footer-content {
                    position: relative;
                    z-index: 2;
                }
                .footer h3 {
                    margin: 0 0 15px 0;
                    font-size: 18px;
                    font-weight: 600;
                }
                .footer p {
                    margin: 8px 0;
                    font-size: 14px;
                    opacity: 0.9;
                    line-height: 1.5;
                }
                .footer-logo {
                    width: 40px;
                    height: 40px;
                    background: #ffffff;
                    border-radius: 50%;
                    margin: 0 auto 15px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 16px;
                    font-weight: 700;
                    color: #1B4D89;
                }
                @media (max-width: 600px) {
                    .email-container { margin: 10px; }
                    .header, .content, .footer { padding: 20px; }
                    .field { flex-direction: column; }
                    .field-label { min-width: auto; margin-bottom: 5px; }
                }
            </style>
        </head>
        <body>
            <div class="email-container">
                <div class="header">
                    <div class="header-content">
                        <div class="logo">BL</div>
                        <h1>New Contact Query</h1>
                        <p>Inquiry received from Bansal Lawyers website</p>
                    </div>
                </div>
                
                <div class="content">
                    <div class="contact-details">
                        <h3 class="section-title">Contact Information</h3>
                        <div class="field">
                            <span class="field-label">Name:</span>
                            <span class="field-value">' . htmlspecialchars($contact->name) . '</span>
                        </div>
                        <div class="field">
                            <span class="field-label">Email:</span>
                            <span class="field-value"><a href="mailto:' . htmlspecialchars($contact->contact_email) . '">' . htmlspecialchars($contact->contact_email) . '</a></span>
                        </div>';
        
        if ($contact->contact_phone) {
            $body .= '
                        <div class="field">
                            <span class="field-label">Phone:</span>
                            <span class="field-value">' . htmlspecialchars($contact->contact_phone) . '</span>
                        </div>';
        }
        
        $body .= '
                        <div class="field">
                            <span class="field-label">Subject:</span>
                            <span class="field-value">' . htmlspecialchars($contact->subject) . '</span>
                        </div>
                        <div class="field">
                            <span class="field-label">Submitted:</span>
                            <span class="field-value">' . $contact->created_at->format('d/m/Y H:i:s') . '</span>
                        </div>
                        <div class="field">
                            <span class="field-label">Status:</span>
                            <span class="status-badge">' . ucfirst($contact->status) . '</span>
                        </div>
                    </div>
                    
                    <div class="message-box">
                        <h3 class="message-title">Client Message</h3>
                        <p class="message-content">' . htmlspecialchars($contact->message) . '</p>
                    </div>';
        
        if ($additionalMessage) {
            $body .= '
                    <div class="additional-notes">
                        <h4>Additional Notes</h4>
                        <p>' . htmlspecialchars($additionalMessage) . '</p>
                    </div>';
        }
        
        $body .= '
                </div>
                
                <div class="footer">
                    <div class="footer-content">
                        <div class="footer-logo">BL</div>
                        <h3>Bansal Lawyers</h3>
                        <p><strong>Contact Management System</strong></p>
                        <p>This email was automatically generated and forwarded for your review.</p>
                        <p>Please respond to the client directly using the provided contact information.</p>
                        <p style="margin-top: 20px; font-size: 12px; opacity: 0.7;">
                            Best Immigration Lawyer in Melbourne Australia | Bansal Lawyers
                        </p>
                    </div>
                </div>
            </div>
        </body>
        </html>';
        
        return $body;
    }
}
