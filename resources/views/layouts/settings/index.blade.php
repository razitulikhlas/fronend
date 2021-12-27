@extends('layouts.main')
@section('container')
<h1>SAW DRIVER</h1>

<div class="card">
    <div class="card-body">
        <form id="formManagement" method="POST" class="row g-4 needs-validation" novalidate>
            @csrf
            <input type="text" hidden="true" class="form-control" name="type"  value="sawdriver" required>
            <label class="form-label">Distance</label>
            <div class="col-md-3 mt-lg-0">
              <label for="validationDistance01" class="form-label">Kriteria 1</label>
              <input type="number"  class="form-control" name="distance1" id="validationDistance01" value={{ $distance[0] }} required>
              <div class="valid-feedback">
                Data wajib di isi
              </div>
            </div>
            <div class="col-md-3 mt-lg-0">
              <label for="validationDistance02" class="form-label">Kriteria 2</label>
              <input type="number" class="form-control"  name="distance2" id="validationDistance02" value={{ $distance[1] }} required>
              <div class="valid-feedback">
                Data wajib di isi
              </div>
            </div>
            <div class="col-md-3 mt-lg-0">
                <label for="validationDistance03" class="form-label">Kriteria 3</label>
                <input type="number" class="form-control"  name="distance3" id="validationDistance03" value={{ $distance[2] }} required>
                <div class="valid-feedback">
                  Data wajib di isi
                </div>
            </div>
            <div class="col-md-3 mt-lg-0">
                <label for="validationDistance04" class="form-label">Kriteria 4</label>
                <input type="number" class="form-control"  name="distance4" id="validationDistance04" value={{ $distance[3] }} required>
                <div class="valid-feedback">
                  Data wajib di isi
                </div>
            </div>

            {{-- TOTAL ORDER --}}
            <label class="form-label">Total Order</label>
            <div class="col-md-3 mt-lg-0">
              <label for="validationTotalOrder01" class="form-label">Kriteria 1</label>
              <input type="number" class="form-control"  name="total_order1" id="validationTotalOrder01" value={{ $total_order[0] }} required>
              <div class="valid-feedback">
                Data wajib di isi
              </div>
            </div>
            <div class="col-md-3 mt-lg-0">
              <label for="validationTotalOrder02" class="form-label">Kriteria 2</label>
              <input type="number" class="form-control"  name="total_order2" id="validationTotalOrder02" value={{ $total_order[1] }} required>
              <div class="valid-feedback">
                Data wajib di isi
              </div>
            </div>
            <div class="col-md-3 mt-lg-0">
                <label for="validationTotalOrder03" class="form-label">Kriteria 3</label>
                <input type="number" class="form-control"  name="total_order3" id="validationTotalOrder03" value={{ $total_order[2] }} required>
                <div class="valid-feedback">
                  Data wajib di isi
                </div>
            </div>
            <div class="col-md-3 mt-lg-0">
                <label for="validationTotalOrder04" class="form-label">Kriteria 4</label>
                <input type="number" class="form-control"  name="total_order4" id="validationTotalOrder04" value={{ $total_order[3] }} required>
                <div class="valid-feedback">
                  Data wajib di isi
                </div>
            </div>


            {{-- RATING --}}
            <label class="form-label">Rating</label>
            <div class="col-md-3 mt-lg-0">
              <label for="validationRating01" class="form-label">Kriteria 1</label>
              <input type="text" class="form-control"  name="rating1" id="validationRating01" value={{ $rating[0] }} required>
              <div class="valid-feedback">
                Data wajib di isi
              </div>
            </div>
            <div class="col-md-3 mt-lg-0">
              <label for="validationRating02" class="form-label">Kriteria 2</label>
              <input type="text" class="form-control"  name="rating2" id="validationRating02" value={{ $rating[1] }} required>
              <div class="valid-feedback">
                Data wajib di isi
              </div>
            </div>
            <div class="col-md-3 mt-lg-0">
                <label for="validationRating03" class="form-label">Kriteria 3</label>
                <input type="text" class="form-control"   name="rating3" id="validationRating03" value={{ $rating[2] }} required>
                <div class="valid-feedback">
                  Data wajib di isi
                </div>
            </div>
            <div class="col-md-3 mt-lg-0">
                <label for="validationRating04" class="form-label">Kriteria 4</label>
                <input type="text" class="form-control"  name="rating4" id="validationRating04" value={{ $rating[3] }} required>
                <div class="valid-feedback">
                  Data wajib di isi
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit"  class="btn btn-success col-md-2" data-toggle="modal" data-target="#insert">
                    <i class="fa fa-save"></i> Simpan
                   </button>
            </div>

          </form>
    </div>
  </div>

  <h1>SAW PROMO</h1>

<div class="card">
    <div class="card-body">
        <form id="formManagement" method="POST" class="row g-4 needs-validation" novalidate>
            @csrf
            <input type="number" hidden="true" class="form-control" name="type"  value="sawpromo" required>
            <label class="form-label">Jumlah Transaksi</label>
            <div class="col-md-3 mt-lg-0">
              <label for="validationJumlahTransaksi01" class="form-label">Kriteria 1</label>
              <input type="text" class="form-control" name="jumlahTransaksi1" id="validationJumlahTransaksi01" value={{ $jumlah_transaksi[0] }} required>
              <div class="valid-feedback">
                Data wajib di isi
              </div>
            </div>
            <div class="col-md-3 mt-lg-0">
              <label for="validationJumlahTransaksi02" class="form-label">Kriteria 2</label>
              <input type="text" class="form-control" name="jumlahTransaksi2" id="validationJumlahTransaksi02" value={{ $jumlah_transaksi[1] }} required>
              <div class="valid-feedback">
                Data wajib di isi
              </div>
            </div>
            <div class="col-md-3 mt-lg-0">
                <label for="validationJumlahTransaksi03" class="form-label">Kriteria 3</label>
                <input type="text" class="form-control" name="jumlahTransaksi3" id="validationJumlahTransaksi03" value={{ $jumlah_transaksi[2] }} required>
                <div class="valid-feedback">
                  Data wajib di isi
                </div>
            </div>
            <div class="col-md-3 mt-lg-0">
                <label for="validationJumlahTransaksi04" class="form-label">Kriteria 4</label>
                <input type="text" class="form-control" name="jumlahTransaksi4" id="validationJumlahTransaksi04" value={{ $jumlah_transaksi[3] }} required>
                <div class="valid-feedback">
                  Data wajib di isi
                </div>
            </div>

            {{-- TOTAL ORDER --}}
            <label class="form-label">Level Pelanggan</label>
            <div class="col-md-3 mt-lg-0">
              <label for="validationLevelPelanggan01" class="form-label">Kriteria 1</label>
              <input type="text" class="form-control" name="level1" id="validationLevelPelanggan01" value={{ $level[0] }} required>
              <div class="valid-feedback">
                Data wajib di isi
              </div>
            </div>
            <div class="col-md-3 mt-lg-0">
              <label for="validationLevelPelanggan02" class="form-label">Kriteria 2</label>
              <input type="text" class="form-control" name="level2" id="validationLevelPelanggan02" value={{ $level[1] }} required>
              <div class="valid-feedback">
                Data wajib di isi
              </div>
            </div>
            <div class="col-md-3 mt-lg-0">
                <label for="validationLevelPelanggan03" class="form-label">Kriteria 3</label>
                <input type="text" class="form-control" name="level3" id="validationLevelPelanggan03" value={{ $level[2] }} required>
                <div class="valid-feedback">
                  Data wajib di isi
                </div>
            </div>


            {{-- RATING --}}
            <label class="form-label">Total Transaksi</label>
            <div class="col-md-3 mt-lg-0">
              <label for="validationTotalTransaksi01" class="form-label">Kriteria 1</label>
              <input type="text" class="form-control" name="totalTransaksi1" id="validationTotalTransaksi01" value={{ $total_transaksi[0] }} required>
              <div class="valid-feedback">
                Data wajib di isi
              </div>
            </div>
            <div class="col-md-3 mt-lg-0">
              <label for="validationTotalTransaksi02" class="form-label">Kriteria 2</label>
              <input type="text" class="form-control" name="totalTransaksi2" id="validationTotalTransaksi02" value={{ $total_transaksi[1] }} required>
              <div class="valid-feedback">
                Data wajib di isi
              </div>
            </div>
            <div class="col-md-3 mt-lg-0">
                <label for="validationTotalTransaksi03" class="form-label">Kriteria 3</label>
                <input type="text" class="form-control" name="totalTransaksi3" id="validationTotalTransaksi03" value={{ $total_transaksi[2] }} required>
                <div class="valid-feedback">
                  Data wajib di isi
                </div>
            </div>
            <div class="col-md-3 mt-lg-0">
                <label for="validationTotalTransaksi04" class="form-label">Kriteria 4</label>
                <input type="text" class="form-control" name="totalTransaksi4" id="validationTotalTransaksi04" value={{ $total_transaksi[3] }} required>
                <div class="valid-feedback">
                  Data wajib di isi
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit"  class="btn btn-success col-md-2" data-toggle="modal" data-target="#insert">
                    <i class="fa fa-save"></i> Simpan
                   </button>
            </div>
          </form>
    </div>
  </div>

  <script>
    (function () {
'use strict'

// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.querySelectorAll('.needs-validation')

// Loop over them and prevent submission
Array.prototype.slice.call(forms)
  .forEach(function (form) {
    form.addEventListener('submit', function (event) {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }

      form.classList.add('was-validated')
    }, false)
  })
})()
</script>
@endsection
