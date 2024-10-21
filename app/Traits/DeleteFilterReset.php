<?php

namespace App\Traits;

trait DeleteFilterReset
{
    /**
     * Silinmişleri gösteren filtrenin resetlenmesini sağlar
     */

    public function updatingDeletedFilter()
    {
        $this->resetPage();
    }

}
