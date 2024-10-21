<?php

namespace App\Traits;

trait RestoreAndDeleteTrait
{
    /**
     * Belirtilen modelin soft-deleted halini geri yükler.
     *
     * @param int $id
     * @return void
     */
    public function restore($id)
    {
        $model = $this->modelClass::withTrashed()->findOrFail($id);
        $model->restore();

        // Bildirim gönder
        $this->dispatch('notify', title: 'Başarılı', text: 'Kayıt başarıyla geri yüklendi!', type: 'success');

        // Tabloyu yenile
        $this->dispatch('city-restored');
    }

    /**
     * Belirtilen modelin kaydını kalıcı olarak siler.
     *
     * @param int $id
     * @return void
     */
    public function forceDelete($id)
    {
        $model = $this->modelClass::withTrashed()->findOrFail($id);
        $model->forceDelete();

        // Bildirim gönder
        $this->dispatch('notify', title: 'Başarılı', text: 'Kayıt kalıcı olarak silindi!', type: 'success');

        // Tabloyu yenile
        $this->dispatch('city-deleted');
    }
}
