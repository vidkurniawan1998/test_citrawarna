@extends('layouts.admin')
@section('content')
    <div class="pagetitle">
        <h1>Barang Keluar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Barang Keluar</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="bi bi-file-spreadsheet-fill"></i>
                            Barang Keluar
                            <button class="btn btn-primary btn-sm" style="float: right;" data-toggle="modal"
                                data-target="#modal-create"><i class="bi bi-plus-circle"></i> Barang Keluar</button>
                        </h5>
                        <hr>

                        <!--Search Bar-->
                        <div class="search-bar pb-3" style="float:right;">
                            <form method="post" action="#">
                                <input type="text" class="form-control" id="myInput" name="search"
                                    placeholder="Search" title="Enter search keyword">
                            </form>
                        </div>
                        <!-- End Search Bar -->

                        <!-- Default Table -->
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Harga Barang</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                @if (count($barangKeluar) > 0)
                                    @foreach ($barangKeluar as $index => $li)
                                        <tr>
                                            <td>{{ $barangKeluar->firstItem() + $index }}</td>
                                            <td>{{ $li->nama_barang }}</td>
                                            <td>{{ $li->deskripsi }}</td>
                                            <td><img src=" {{ asset('storage/' . $li->image) }}" width="100px"
                                                    height="100px" alt="image"></td>
                                            <td>{{ $li->qty }}</td>
                                            <td>{{ $li->harga_barang }}</td>
                                            <td><button class="btn btn-primary edit-barangkeluar"
                                                    data-id="{{ $li->id }}" data-toggle="modal"
                                                    data-target="#modal-update"><span class="bi bi-pen"></span>Ubah</button>

                                                <a href="{{ route('barangkeluar.delete', ['id' => $li->id]) }}"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Item Barang Masuk No [$li->id]?')"><span
                                                        class="bi bi-trash"></span>Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" style="text-align:center;"><b>Data Barang Keluar Tidak
                                                Ditemukan</b></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="px-sm-3" style="padding-left:15pt;">Jumlah Data : {{ $barangKeluar->count() }} Dari
                        {{ $barangKeluar->total() }} </div>
                    <div style="padding-left:15pt;">{{ $barangKeluar->links() }}</div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Barang Keluar</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('barangkeluar.create') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nama_barang" class="col-form-label">Nama Barang:</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                    placeholder="Nama Barang">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi" class="col-form-label">Deskripsi:</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-form-label">Image:</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <div class="form-group">
                                <label for="qty" class="col-form-label">Qty :</label>
                                <input type="number" class="form-control" id="qty" name="qty">
                            </div>
                            <div class="form-group">
                                <label for="harga_barang" class="col-form-label">Harga Barang :</label>
                                <input type="number" class="form-control" id="harga_barang" name="harga_barang">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Save</button>
                                <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Barang Keluar</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id" class="id">
                            <div class="form-group">
                                <label for="nama_barang" class="col-form-label">Nama Barang:</label>
                                <input type="text" class="form-control nama_barang" name="nama_barang">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi" class="col-form-label">Deskripsi:</label>
                                <textarea class="form-control deskripsi" name="deskripsi"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="image py-sm-4">
                                </div>
                                <label for="image" class="col-form-label">Image:</label>
                                <input type="file" class="form-control image" name="image">

                            </div>

                            <div class="form-group">
                                <label for="qty" class="col-form-label">Qty :</label>
                                <input type="number" class="form-control qty" name="qty">
                            </div>
                            <div class="form-group">
                                <label for="harga_barang" class="col-form-label">Harga Barang :</label>
                                <input type="number" class="form-control harga_barang" name="harga_barang">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary update-barangkeluar">Save</button>
                                <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Close">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
@push('barangkeluar')
    <script>
        $(function() {
            // Untuk Ubah Gambar Ketika Di Form Edit Klik Save
            var file = '';
            $('.image').on("change", function(e) {
                file = e.target.files[0];
            });

            // Menampilkan Data Di Form Ketika Tombol Edit Di Klik
            $('.edit-barangkeluar').click(function() {
                var id = $(this).data('id');
                var url = '{{ url('barangkeluar/edit') }}' + '/' + id;
                $.ajax({
                    url: url,
                    type: 'get',
                    datatype: 'json',
                    success: function(response) {
                        if (response !== null) {
                            var image = '<img src ="' + response.image +
                                '" class="img-responsive img-fluid">';
                            $('.id').val(response.id);
                            $('.nama_barang').val(response.nama_barang);
                            $('.deskripsi').val(response.deskripsi);
                            $('.image').html(image);
                            $('.qty').val(response.qty);
                            $('.harga_barang').val(response.harga_barang);
                        }
                    }
                })
            })

            //Menyimpan Data Perubahan Ketika Di Klik Tombol Save Di Klik Di Update Data
            $('.update-barangkeluar').click(function() {
                var id = $('.id').val();
                var nama_barang = $('.nama_barang').val();
                var deskripsi = $('.deskripsi').val();
                var qty = $('.qty').val();
                var harga_barang = $('.harga_barang').val();
                var url = '{{ url('barangkeluar/update') }}' + '/' + id;

                let formData = new FormData();
                formData.append("nama_barang", nama_barang);
                formData.append('deskripsi', deskripsi);
                formData.append('image', file);
                formData.append('qty', qty);
                formData.append('harga_barang', harga_barang);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: url,
                    type: 'POST',
                    datatype: 'json',
                    contentType: false,
                    processData: false,
                    cache: false,
                    data: formData,
                    success: function(response) {
                        location.reload();
                    }
                })
            })
        });

        //Menampilkan Hasil Pencarian Dari Data General Settings
        $(document).ready(function() {
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endpush
