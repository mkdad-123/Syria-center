<?php

namespace App\Models;

use App\Models\Compliants;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CustomUser extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;
    use MustVerifyEmailTrait; // يتيح إرسال رابط التفعيل ووضع email_verified_at

    protected $table = 'customusers';

    // ملاحظة: خاصية $guard هنا اختيارية ولا تؤثر على الموديل بحد ذاته،
    // تعيين الحارس يتم أساساً في config/auth.php وفي استدعاءات Auth::guard('custom')
    protected $guard = 'custom';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'deleted_at'        => 'datetime',
    ];

    public function compliants()
    {
        return $this->hasMany(Compliants::class);
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new \App\Notifications\VerifyEmailCustom());
    }
}
