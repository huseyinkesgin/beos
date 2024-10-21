<?php

namespace App\Traits;

trait SearchReset
{
    /**
     * Arama yapıldığında sayfayı sıfırlar.
     *
     * @return void
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }
}
