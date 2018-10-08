<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


//Notification for Seller
use App\Notifications\UtilisateurResetPasswordNotification;

//Trait for sending notifications in laravel
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    // This trait has notify() method defined
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'utilisateur';
    protected $table = 'utilisateurs';
    protected $fillable = [
        'prenom', 'nom', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    //Send password reset notification
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UtilisateurResetPasswordNotification($token));
    }

}
