@extends('layouts.app')

@section('content')
    @yield('perusahaan')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Tahap Sertifikasi</div>
                <!-- {{{ $role = \Auth::user()->role()->first()->role }}} -->
                <!-- {{{ $id_produk = !isset($idProduk) ? \Auth::user()->id_produk() : $idProduk }}} -->
                <!-- {{{ $tahap = \AppHelper::instance()->tahap($id_produk) }}} -->
                <div class="card-body">
                    <table>
                    @if($role == 'client' || $role == 'pemasaran' || $role == 'kerjasama')
                        <tr>
                            <td><div class="font-tahap" style="margin-right: 10px;"><span class="badge font-tahap-icon badge-pill badge-{{ !is_null($tahap) && $tahap->apply_sa == 1 ? 'success' : 'secondary' }}">&check;</span></div></td>
                            <td><div class="font-tahap">Apply Sertifikasi Awal</div></td>
                        </tr>
                    @endif
                    @if($role == 'client' || $role == 'pemasaran' || $role == 'kerjasama' || $role == 'kabidpjt' || $role == 'keuangan')
                        <tr>
                            <td><div class="font-tahap" style="margin-right: 10px;"><span class="badge font-tahap-icon badge-pill badge-{{ !is_null($tahap) && $tahap->mou == 1 ? 'success' : 'secondary' }}">&check;</span></div></td>
                            <td><div class="font-tahap" style="margin-right: 10px;">Pembuatan Mou</div></td>
                        </tr>
                        <tr>
                            <td><div class="font-tahap" style="margin-right: 10px;"><span class="badge font-tahap-icon badge-pill badge-{{ !is_null($tahap) && $tahap->sign_mou == 1 ? 'success' : 'secondary' }}">&check;</span></div></td>
                            <td><div class="font-tahap" style="margin-right: 10px;">Sign Mou</div></td>
                        </tr>
                        <tr>
                            <td><div class="font-tahap" style="margin-right: 10px;"><span class="badge font-tahap-icon badge-pill badge-{{ !is_null($tahap) && $tahap->bid_price == 1 ? 'success' : 'secondary' }}">&check;</span></div></td>
                            <td><div class="font-tahap" style="margin-right: 10px;">Form Penawaran Harga</div></td>
                        </tr>
                        <tr>
                            <td><div class="font-tahap" style="margin-right: 10px;"><span class="badge font-tahap-icon badge-pill badge-{{ !is_null($tahap) && $tahap->form_pembayaran == 1 ? 'success' : 'secondary' }}">&check;</span></div></td>
                            <td><div class="font-tahap" style="margin-right: 10px;">Form Waktu Pembayaran</div></td>
                        </tr>
                        <tr>
                            <td><div class="font-tahap" style="margin-right: 10px;"><span class="badge font-tahap-icon badge-pill badge-{{ !is_null($tahap) && $tahap->invoice == 1 ? 'success' : 'secondary' }}">&check;</span></div></td>
                            <td><div class="font-tahap" style="margin-right: 10px;">Pembuatan Invoice</div></td>
                        </tr>
                        <tr>
                            <td><div class="font-tahap" style="margin-right: 10px;"><span class="badge font-tahap-icon badge-pill badge-{{ !is_null($tahap) && $tahap->bukti_bayar == 1 ? 'success' : 'secondary' }}">&check;</span></div></td>
                            <td><div class="font-tahap" style="margin-right: 10px;">Upload Bukti Pembayaran</div></td>
                        </tr>
                    @endif
                    @if($role == 'client' || $role == 'sertifikasi' || $role == 'auditor' || $role == 'kabidpaskal')
                        <tr>
                            <td><div class="font-tahap" style="margin-right: 10px;"><span class="badge font-tahap-icon badge-pill badge-{{ !is_null($tahap) && $tahap->jadwal_audit == 1 ? 'success' : 'secondary' }}">&check;</span></td>
                            <td><div class="font-tahap"> Surat Pemberitahuan Jadwal dan Tim Audit</div></td>
                        </tr>
                        <tr>
                            <td><div class="font-tahap" style="margin-right: 10px;"><span class="badge font-tahap-icon badge-pill badge-{{ !is_null($tahap) && $tahap->dokSert == 1 ? 'success' : 'secondary' }}">&check;</span></td>
                            <td><div class="font-tahap"> Laporan Audit Kecukupan Sertifikasi Produk</div></td>
                        </tr>
                        <tr>
                            <td><div class="font-tahap" style="margin-right: 10px;"><span class="badge font-tahap-icon badge-pill badge-{{ !is_null($tahap) && $tahap->sampling_plan == 1 ? 'success' : 'secondary' }}">&check;</span></td>
                            <td><div class="font-tahap"> Upload Audit Plan dan Sampling Plan</div></td>
                        </tr>
                    @endif
                    @if($role == 'client' || $role == 'sertifikasi' || $role == 'kabidpaskal' || $role == 'tim_teknis' || $role == 'komite_timTeknis' || $role == 'pemasaran' || $role == 'subag_umum')
                        <tr>
                            <td><div class="font-tahap" style="margin-right: 10px;"><span class="badge font-tahap-icon badge-pill badge-{{ !is_null($tahap) && $tahap->lapSert == 1 ? 'success' : 'secondary' }}">&check;</span></td>
                            <td><div class="font-tahap"> Pembuatan Dokumen Laporan Hasil Sertifikasi</div></td>
                        </tr>
                        <tr>
                            <td><div class="font-tahap" style="margin-right: 10px;"><span class="badge font-tahap-icon badge-pill badge-{{ !is_null($tahap) && $tahap->draftSert == 1 ? 'success' : 'secondary' }}">&check;</span></td>
                            <td><div class="font-tahap"> Pembuatan Draft Sertifikat</div></td>
                        </tr>
                        <tr>
                            <td><div class="font-tahap" style="margin-right: 10px;"><span class="badge font-tahap-icon badge-pill badge-{{ !is_null($tahap) && $tahap->cetakSert == 1 ? 'success' : 'secondary' }}">&check;</span></td>
                            <td><div class="font-tahap"> Cetak Draft Sertifikat</div></td>
                        </tr>
                        <tr>
                            <td><div class="font-tahap" style="margin-right: 10px;"><span class="badge font-tahap-icon badge-pill badge-{{ !is_null($tahap) && $tahap->jadwalSert == 1 ? 'success' : 'secondary' }}">&check;</span></td>
                            <td><div class="font-tahap"> Penjadwalan Ambil/Kirim Sertifikat</div></td>
                        </tr>
                    @endif
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@yield('card-header')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @yield('second-content')

                </div>
            </div>
        </div>
    </div>
@endsection
