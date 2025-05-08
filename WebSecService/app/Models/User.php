<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'credit',
        'facebook_id',
        'facebook_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function boughtProducts()
    {
        return $this->belongsToMany(Product::class, 'user_bought_products')
                    ->withPivot('bought_at')
                    ->orderByDesc('user_bought_products.bought_at');
    }

    // app/Models/User.php
    public function getBoughtProducts()
    {
        return $this->boughtProducts()
            ->withPivot(['bought_at', 'price_at_purchase', 'status'])
            ->orderByDesc('user_bought_products.bought_at')
            ->get();
    }

    public function hasFacebook()
    {
        return !is_null($this->facebook_id);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function approvedComments()
    {
        return $this->hasMany(Comment::class, 'approved_by');
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new class extends VerifyEmail {
            public function toMail($notifiable)
            {
                $verificationUrl = $this->verificationUrl($notifiable);
                // Force the URL to use the current request's host
                if (request()) {
                    $parsed = parse_url($verificationUrl);
                    $host = request()->getSchemeAndHttpHost();
                    $verificationUrl = $host . $parsed['path'] . (isset($parsed['query']) ? '?' . $parsed['query'] : '');
                }
                return (new MailMessage)
                    ->subject('Verify Email Address')
                    ->line('Click the button below to verify your email address.')
                    ->action('Verify Email Address', $verificationUrl)
                    ->line('If you did not create an account, no further action is required.');
            }
        });
    }
}
