<?php
namespace App\Services\Payu;

use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentManager
{
    protected Request $request;
    protected UrlGenerator $url;

    public function __construct(Request $request, UrlGenerator $url)
    {
        $this->request = $request;
        $this->url = $url;
    }

    public function make(array $attributes, \Closure $callback): RedirectResponse
    {
        $then = new class($this->url) {
            protected UrlGenerator $url;
            public function __construct(UrlGenerator $url) { $this->url = $url; }
            public function redirectRoute(string $routeName)
            {
                // no-op placeholder; actual redirect happens below
                return $routeName;
            }
        };

        $callback($then);

        // Temporary shim: directly redirect to status route carrying payload
        $query = array_merge($attributes, [
            'status' => 'Success',
        ]);

        return redirect()->route('payment.status', $query);
    }

    public function capture(): object
    {
        $data = $this->request->all();

        return new class($data) {
            public string $status;
            public string $data;
            public ?string $error_Message = null;
            public function __construct(array $payload)
            {
                $this->status = $payload['status'] ?? 'Success';
                $this->data = json_encode($payload);
            }
            public function isCaptured(): bool
            {
                return ($this->status ?? '') === 'Success';
            }
        };
    }
}


