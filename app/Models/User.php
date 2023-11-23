<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{

    use HasApiTokens,
        HasFactory,
        Notifiable,
        HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'email', 'profile', 'password', 'phone', 'birthday', 'anniversary', 'account_no', 'bank_name', 'account_name', 'ifsc', 'upi', 'photo', 'pan_card', 'aadhar_card', 'gst', 'advance_payout','tds_percentage','gender','city','state','address','github_url','linkdin_url','ziprecuriter_url','current_salary','expected_salary','work_knowledge','country','notice_period'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:M d, Y h:i:s',
        'updated_at' => 'datetime:M d, Y h:i:s',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d, Y h:i:s', strtotime($value));
    }
    public function contacts()
    {
        return $this->hasMany(ChatContact::class, 'contact_id', 'id');
    }

    public function messagesSent()
    {
        return $this->hasMany(Message::class, 'from_user', 'id');
    }


    public function messagesReceived()
    {
        return $this->hasMany(Message::class, 'user_id', 'id');
    }
    public function whatsappContacts()
    {
        return $this->hasMany(WhatsappChatContact::class, 'contact_id', 'id');
    }

    public function whatsappMessagesSent()
    {
        return $this->hasMany(WhatsappMessage::class, 'from_user', 'id');
    }
    public function whatsappMessagesReceived()
    {
        return $this->hasMany(Message::class, 'user_id', 'id');
    }
    public function policy()
    {
        return $this->hasOne(Policy::class, 'user_id', 'id');
    }
    public function policies()
    {
        return $this->hasMany(Policy::class, 'user_id', 'id');
    }
    public function invoicePolicy()
    {
        return $this->hasMany(Policy::class, 'user_id', 'id')->whereNull('invoice_id')->where('is_mis', 1);
    }

    public function messages()
    {
        return $this->messagesSent()->union($this->messagesReceived()->toBase());
    }
    public function whatsappMessages()
    {
        return $this->whatsappMessagesSent()->union($this->whatsappMessagesReceived()->toBase());
    }

    public function shortPremium()
    {
        return $this->policies->sum('mis_short_premium');
    }
    public function resumeDetails()
    {
        return $this->hasOne(Resume::class, 'user_id', 'id');
    }
}
