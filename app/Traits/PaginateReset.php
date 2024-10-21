<?php

namespace App\Traits;

trait PaginateReset
{
    /**
     * Sayfalama yaptığında takılı kalmasın diye resetleme yapar
     */
    public function updatingPagination()
    {
        $this->resetPage();
    }
}
