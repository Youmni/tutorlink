<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'user_id';
    
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'address_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function newsItems()
    {
        return $this->hasMany(NewsItem::class, 'user_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Chatmessage::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Chatmessage::class, 'receiver_id');
    }

    public function blacklists()
    {
        return $this->hasMany(Blacklist::class, 'user_id');
    }

    public function availabilities()
    {
        return $this->hasMany(Availability::class, 'user_id');
    }

    public function reservationsAsTutor()
    {
        return $this->hasMany(Reservation::class, 'tutor_id');
    }

    public function reservationsAsClient()
    {
        return $this->hasMany(Reservation::class, 'client_id');
    }

    public function tutorCourses()
    {
        return $this->belongsToMany(Course::class, 'tutor_course', 'user_id', 'course_id');
    }
}
