<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// إن كنت تستخدم spatie/permission فعّل السطر التالي
// use Spatie\Permission\Traits\HasRoles;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable; // , HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        // لو عندك عمود is_admin خلِّيه قابل للتعبئة (لا يضر إن لم يوجد)
        // 'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * السماح/المنع من دخول لوحة Filament.
     * عدّل الشرط كما تريد.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return
            // لو عندك عمود is_admin
            (($this->is_admin ?? 0) == 1)
            // أو اسمح لهذا البريد تحديداً
            || ($this->email === 'admin_syria_cent@gmail.com')
            // أو دور admin لو مركب spatie/permission
            || (method_exists($this, 'hasRole') && $this->hasRole('admin'));
        // إن أردت السماح لأي مستخدم مسجّل: أعد true فقط.
    }
}
