<?php

namespace App\Models;

use App\Models\Portfolio;

class Customer extends BaseModel
{
    protected $fillable = [
        'customer_type', // varsayılan olarak Bireysel
        'category',      // mal sahibi, emlakçı, komisyoncu, referans, alıcı
        'name',
        'company_name',
        'tax_office',
        'tax_no',
        'phone',
        'email',
        'company',
        'address',
        'isActive',      // BaseModel'den gelen aktiflik alanı
        'note',
    ];

    public function ownedPortfolios()
    {
        return $this->hasMany(Portfolio::class, 'owner_customer_id');
    }

    public function partneredPortfolios()
    {
        return $this->hasMany(Portfolio::class, 'partner_customer_id');
    }

    public function scopeFilter($query, $search = null, $activeFilter = 'all', $deletedFilter = 'without', $customerType = '', $category = '')
    {
        $query->when($search, function ($query) use ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('phone', 'like', '%'.$search.'%')
                    ->orWhere('company_name', 'like', '%'.$search.'%')
                    ->orWhere('tax_no', 'like', '%'.$search.'%')
                    ->orWhere('tax_office', 'like', '%'.$search.'%');
            });
        });

        // Active/Inactive filtering
        if ($activeFilter !== 'all') {
            $isActive = $activeFilter == 'active';
            $query->where('isActive', $isActive);
        }

        // Soft delete filtering
        if ($deletedFilter == 'with') {
            $query->withTrashed();
        } elseif ($deletedFilter == 'only') {
            $query->onlyTrashed();
        }

        // Customer Type filtering - boş veya null olduğunda filtreyi geçerli kılmıyoruz
        if (! is_null($customerType) && $customerType !== '') {
            $query->where('customer_type', $customerType);
        }

        // Category filtering - boş veya null olduğunda filtreyi geçerli kılmıyoruz
        if (! is_null($category) && $category !== '') {
            $query->where('category', $category);
        }

        return $query;
    }

    public function scopeSortable($query, $field, $direction)
    {
        return $query->orderBy($field, $direction);
    }
}
