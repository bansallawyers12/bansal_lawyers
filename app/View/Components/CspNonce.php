<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CspNonce extends Component
{
    public $nonce;
    
    public function __construct()
    {
        // Use current request nonce instead of session
        $this->nonce = view()->shared('csp_nonce') ?? request()->attributes->get('csp_nonce') ?? '';
    }
    
    public function render()
    {
        return view('components.csp-nonce');
    }
}
