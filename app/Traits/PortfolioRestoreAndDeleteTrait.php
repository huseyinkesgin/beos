<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait PortfolioRestoreAndDeleteTrait
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

        // İlişkili modelleri geri yükle
        if (method_exists($model, 'ads')) {
            $model->ads()->withTrashed()->restore();
        }
        if (method_exists($model, 'galleries')) {
            $model->galleries()->withTrashed()->restore();
        }
        if (method_exists($model, 'media')) {
            $model->media()->withTrashed()->restore();
        }
        if (method_exists($model, 'business')) {
            $model->business()->withTrashed()->restore();
        }
        if (method_exists($model, 'land')) {
            $model->land()->withTrashed()->restore();
        }
        if (method_exists($model, 'home')) {
            $model->home()->withTrashed()->restore();
        }

        // Bildirim gönder
        $this->dispatch('notify', title: 'Başarılı', text: 'Kayıt ve ilişkili veriler başarıyla geri yüklendi!', type: 'success');

        // Tabloyu yenile
        $this->dispatch('city-restored');
    }

    /**
     * Belirtilen modelin kaydını kalıcı olarak siler ve ilişkili dosyaları fiziksel olarak siler.
     *
     * @param int $id
     * @return void
     */
    public function forceDelete($id)
    {
        $model = $this->modelClass::withTrashed()->findOrFail($id);

        // İlişkili modelleri kalıcı olarak silmeden önce fiziksel dosyaları sil
        if (method_exists($model, 'galleries')) {
            $model->galleries()->withTrashed()->get()->each(function ($gallery) {
                if (Storage::disk('public')->exists($gallery->file_path)) {
                    Storage::disk('public')->delete($gallery->file_path); // Dosyayı sil
                }
            });
        }

        if (method_exists($model, 'media')) {
            $model->media()->withTrashed()->get()->each(function ($media) {
                if (Storage::disk('public')->exists($media->file_path)) {
                    Storage::disk('public')->delete($media->file_path); // Dosyayı sil
                }
            });
        }

        // İlişkili modelleri kalıcı olarak sil
        if (method_exists($model, 'ads')) {
            $model->ads()->withTrashed()->forceDelete();
        }
        if (method_exists($model, 'galleries')) {
            $model->galleries()->withTrashed()->forceDelete();
        }
        if (method_exists($model, 'media')) {
            $model->media()->withTrashed()->forceDelete();
        }
        if (method_exists($model, 'business')) {
            $model->business()->withTrashed()->forceDelete();
        }
        if (method_exists($model, 'land')) {
            $model->land()->withTrashed()->forceDelete();
        }
        if (method_exists($model, 'home')) {
            $model->home()->withTrashed()->forceDelete();
        }

        // Ana portföy kaydını kalıcı olarak sil
        $model->forceDelete();

        // Bildirim gönder
        $this->dispatch('notify', title: 'Başarılı', text: 'Kayıt ve ilişkili veriler kalıcı olarak silindi!', type: 'success');

        // Tabloyu yenile
        $this->dispatch('city-deleted');
    }
}
