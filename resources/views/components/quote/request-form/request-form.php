<?php

use App\Models\QuoteRequest;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('nullable|string|max:50')]
    public string $phone = '';

    #[Validate('nullable|string|max:255')]
    public string $company = '';

    #[Validate('nullable|url|max:255')]
    public string $website_url = '';

    #[Validate('required|array|min:1')]
    public array $services = [];

    #[Validate('nullable|string|max:100')]
    public string $budget_range = '';

    #[Validate('nullable|string|max:2000')]
    public string $message = '';

    public bool $submitted = false;

    public array $serviceOptions = [
        'seo' => 'SEO — Search Engine Optimization',
        'geo' => 'GEO — Generative Engine Optimization',
        'aeo' => 'AEO — Answer Engine Optimization',
    ];

    public array $budgetOptions = [
        'under-1k' => 'Under £1,000 / mo',
        '1k-3k' => '£1,000 – £3,000 / mo',
        '3k-7k' => '£3,000 – £7,000 / mo',
        '7k-plus' => '£7,000+ / mo',
        'not-sure' => 'Not sure yet',
    ];

    public function submit(): void
    {
        $this->validate();

        QuoteRequest::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone ?: null,
            'company' => $this->company ?: null,
            'website_url' => $this->website_url ?: null,
            'services' => $this->services,
            'budget_range' => $this->budget_range ?: null,
            'message' => $this->message ?: null,
        ]);

        $this->reset(['name', 'email', 'phone', 'company', 'website_url', 'services', 'budget_range', 'message']);
        $this->submitted = true;
    }
};
