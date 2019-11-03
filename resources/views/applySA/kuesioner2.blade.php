    <tr>
        <td class="pb-4" colspan="5"><center><b><i>B.4 - Pengendalian Mutu Pengujian</i></b></center></td>
    </tr>
    <tr>
        <td><b>4.1.</b></td>
        <td><b>Sistem</b></td>
    </tr>
    <tr>
        <td class="pb-2"></td>
        <td class="pb-2" colspan="4">Berikan rincian sistem pengendalian mutu, termasuk sistem pengalihan contoh yang diikuti dengan acuan tertentu sesuai degan standar yang relevan. Penggunaanjadwal pengendalian mutu atau suplemen acuan sialng terhadap diagram yang disebutkan di 3.1 akan lebih menguntungkan. Lampirkan panduan atau instruksi pengendalian mutu yang diterbitkan untuk personel.</td>
    </tr>
    <tr>
        <td class="pb-3"></td>
        <td class="pb-3" colspan="3">
            <i>Lampiran</i><br>
            <input class="mb-2" type="file" name="panduanM"><br>
            <textarea name="panduanMutu" style="width: 100%;"></textarea>
        </td>
    </tr>
    <tr>
        <td><b>4.2.</b></td>
        <td colspan="4"><b>Peralatan/Instrumen pengujian, gauge, atau perkakas.</b></td>
    </tr>
    <tr>
        <td class="pb-2"></td>
        <td class="pb-2" colspan="4">Berikan rincian peralatan yang digunakan, nama pembuat dan acuan atau dan tunjukkan sistem dan frekuensi pemeriksaan dan sertifikat, jika ada. (dapat menggunakan lampiran)</td>
    </tr>
    <tr>
        <td class="pb-3"></td>
        <td class="pb-3" colspan="4">
            <button id="toggleLampiran11" type="button" class="btn btn-outline-secondary mb-2">Lampiran/Pengisian Manual</button><br>
            <div id="lampiran11">
                <i>Gunakan lampiran</i><br>
                <input class="pb-3" type="file" name="rincianPeralatan" disabled=""><br>
            </div>
            <div id="manual11">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg1">Pengisian Manual</button>

                <div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel">Spesifikasi pembelian/jaminan mutu bahan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="body">
                            <div class="container-fluid p-3">
                                <button type="button" class="btn btn-primary mb-2" id="tambahBahan11">+ Tambah baris</button>
                                <table border="0">
                                    <thead>
                                        <tr>
                                            <th width="1">Nama Alat</th>
                                            <th width="1">Nama Pembuat</th>
                                            <th width="1">Acuan</th>
                                            <th width="1">Sistem dan Frekuensi pemeriksaan</th>
                                            <th width="1">Sertifikat</th>
                                            <th width="1">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody11">
                                        <tr class="bodyContent11">
                                            <td><input class="namaAlat" type="text" name="namaAlat"></td>
                                            <td><input class="namaPembuat" type="text" name="namaPembuat"></td>
                                            <td><input class="acuan" type="text" name="acuan"></td>
                                            <td><input class="sistemP" type="text" name="sistemP"></td>
                                            <td><input class="sert" type="text" name="sert"></td>
                                            <td><button type="button" class="btn btn-secondary hapusContent11">Hapus</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </td>
    </tr>
    <tr>
        <td class="pb-4" colspan="5"><center><b><i>B.5 - Rekaman dan dokumentasi</i></b></center></td>
    </tr>
    <tr>
        <td class="pb-3"><b>5.1.</b></td>
        <td class="pb-3"><b>Umum</b></td>
    </tr>
    <tr>
        <td class="pb-2">5.1.1.</td>
        <td colspan="4">Tunjukkan betuk spesifikasi utama, seperti gambar teknik produk/bagian-bagian jadwal, contoh acuan, dsb. Tunjukkan juga rekaman umum ang tersedia. (dapat menggunakan lampiran)</td>
    </tr>
    <tr>
        <td class="pb-3"></td>
        <td class="pb-3" colspan="3">
            <button type="button" class="btn btn-outline-secondary mb-2" onclick="inputToggle('#lampiran4', '#manual4', 'spekU', 'spekUtama');">Lampiran/Pengisian Manual</button><br>
            <div id="lampiran4">
                <i>Gunakan lampiran</i><br>
                <input class="pb-3" type="file" name="spekU" disabled=""><br>
            </div>
            <div id="manual4">
                <textarea name="spekUtama" style="width: 100%"></textarea>
            </div>
        </td>
    </tr>
    <tr>
        <td class="pb-2">5.1.2.</td>
        <td colspan="4">Tunjukkan sistem yang digunakan untuk memebuat desain/speksifikasi. (dapat menggunakan lampiran)</td>
    </tr>
    <tr>
        <td class="pb-3"></td>
        <td class="pb-3" colspan="3">
            <button type="button" class="btn btn-outline-secondary mb-2" onclick="inputToggle('#lampiran5', '#manual5', 'jenisS', 'jenisSistem');">Lampiran/Pengisian Manual</button><br>
            <div id="lampiran5">
                <i>Gunakan lampiran</i><br>
                <input class="pb-3" type="file" name="jenisS" disabled=""><br>
            </div>
            <div id="manual5">
                <textarea name="jenisSistem" style="width: 100%"></textarea>
            </div>
        </td>
    </tr>
    <tr>
        <td class="pb-2"><b>5.2.</b></td>
        <td class="pb-2"><b>Kesesuaian spesifikasi</b></td>
    </tr>
    <tr>
        <td class="pb-2">5.2.1.</td>
        <td class="pb-2" colspan="4">Tunjukkan tingkat cacat dari temuan ketidaksesuaian dalam 6 bulan terakhir. (dapat menggunakan lampiran)</td>
    </tr>
    <tr>
        <td class="pb-3"></td>
        <td class="pb-3" colspan="3">
            <button type="button" class="btn btn-outline-secondary mb-2" onclick="inputToggle('#lampiran6', '#manual6', 'tingkatC', 'tingkatCacat');">Lampiran/Pengisian Manual</button><br>
            <div id="lampiran6">
                <i>Gunakan lampiran</i><br>
                <input class="pb-3" type="file" name="tingkatC" disabled=""><br>
            </div>
            <div id="manual6">
                <textarea name="tingkatCacat" style="width: 100%"></textarea>
            </div>
        </td>
    </tr>
    <tr>
        <td class="pb-2">5.2.2.</td>
        <td class="pb-2" colspan="4">Jika pengujian dilakukan sesuai dengan standar yang relevan telah dilaksanakan, lampirkan hasil uji jika ada.</td>
    </tr>
    <tr>
        <td class="pb-3"></td>
        <td class="pb-3" colspan="3">
            <i>Lampiran</i><br>
            <input class="pb-3" type="file" name="lampiranPengujian"><br>
            <textarea name="pengujian" style="width: 100%"></textarea>
        </td>
    </tr>
    <tr>
        <td class="pb-2">5.2.3.</td>
        <td class="pb-2" colspan="4">Tunjukkan tingkat keluhan yang diterima selama masa jaminan dan berikan presentasi dari jumlah keluaran. (dapat menggunakan lampiran)</td>
    </tr>
    <tr>
        <td class="pb-3"></td>
        <td class="pb-3" colspan="3">
            <button type="button" class="btn btn-outline-secondary mb-2" onclick="inputToggle('#lampiran7', '#manual7', 'tingkatK', 'tingkatKeluhan');">Lampiran/Pengisian Manual</button><br>
            <div id="lampiran7">
                <i>Gunakan lampiran</i><br>
                <input class="pb-3" type="file" name="tingkatK" disabled=""><br>
            </div>
            <div id="manual7">
                <textarea name="tingkatKeluhan" style="width: 100%"></textarea>
            </div>
        </td>
    </tr>
    <tr>
        <td>5.2.4.</td>
        <td>Apakah telah dilakukan pengujian independen pada produk sesuai standar?</td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2"><input type="radio" name="pengujianI">Ya</td>
        <td colspan="2"><input type="radio" name="pengujianI">Tidak</td>
    </tr>
    <tr>
        <td></td>
        <td>Jika <b>Ya</b>, oleh siapa? Lampirkan salinan jika ada</td>
    </tr>
    <tr>
        <td class="pb-3"></td>
        <td class="pb-3" colspan="3">
            <i>Lampiran</i><br>
            <input class="pb-3" type="file" name="pengujiI"><br>
            <textarea name="pengujiIndependen" style="width: 100%"></textarea>
        </td>
    </tr>
</table>