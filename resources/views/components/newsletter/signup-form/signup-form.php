<?php

use App\Models\NewsletterSubscriber;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    #[Validate('required|email|max:255')]
    public string $email = '';

    public bool $subscribed = false;

    public function subscribe(): void
    {
        $this->validate();

        NewsletterSubscriber::updateOrCreate(
            ['email' => $this->email],
            ['subscribed_at' => now(), 'unsubscribed_at' => null],
        );

        $this->reset('email');
        $this->subscribed = true;
    }
};
