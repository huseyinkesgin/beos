<?php

namespace App\Traits;

trait ActiveFilterReset
{
    /**
     * Aktif/Pasif filtresi Seçildiğinde resetleme işlemi yapar.
     *
     * @return void
     */
    public function updatingActiveFilter()
    {
        $this->resetPage();
    }
}
