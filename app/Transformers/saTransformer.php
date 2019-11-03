<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Persyaratan_dalam_negeri;

class saTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Persyaratan_dalam_negeri $model_sa)
    {
        return [
            'id' => $model_sa->id,
            'sni' => $model_sa->sni,
            'daftar_isian_kuesioner'=> $model_sa->daftar_isian_kuesioner,
            'surat_permohonan_sertifikat_sni'=> $model_sa->surat_permohonan_sertifikat_sni,
            'copy_iui'=> $model_sa->copy_iui,
            'copy_akte_notaris_perusahaan'=> $model_sa->copy_akte_notaris_perusahaan
        ];
    }
}
