<?php

namespace App\Traits;

trait PortfolioFilterReset
{
    /**
     * Search işlemi gerçekleştiğinde sayfayı sıfırlar.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Silinmiş filtre değiştiğinde sayfayı sıfırlar.
     */
    public function updatingDeletedFilter()
    {
        $this->resetPage();
    }

    /**
     * Aktif/Pasif filtre değiştiğinde sayfayı sıfırlar.
     */
    public function updatingActiveFilter()
    {
        $this->resetPage();
    }

    /**
     * İlan durumu (Ad Status) filtre değiştiğinde sayfayı sıfırlar.
     */
    public function updatingAdStatusFilter()
    {
        $this->resetPage();
    }

    /**
     * Kategori filtre değiştiğinde sayfayı sıfırlar.
     */
    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    /**
     * İl, ilçe ve bölge filtreleri güncellendiğinde sayfayı sıfırlar.
     */
    public function updatingStateFilter()
    {
        $this->resetPage();
    }

    public function updatingCityFilter()
    {
        $this->resetPage();
    }

    public function updatingDistrictFilter()
    {
        $this->resetPage();
    }

    /**
     * Type filtre değiştiğinde sayfayı sıfırlar.
     */
    public function updatingTypeFilter()
    {
        $this->resetPage();
    }
}
