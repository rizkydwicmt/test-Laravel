@extends('core/main')
@extends('core/navbar')
@extends('core/footer')

@section('title', 'List Courses - Dashboard Pintaro')
@section('page-title', 'List Courses')
@section('page-subtitle', 'Ini adalah List Courses pelatihan Pintaro')

@section('css')
    <!--===============================================================================================-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ url('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap-multiselect.css') }}">
    <link href="{{ asset('/vendors/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/vendors/quill/quill.bubble.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendors/quill/quill.snow.css') }}">
    <!--===============================================================================================-->
@endsection

@section('konten')

    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <table id='tabel_course' width='100%' border="1" class='table table-striped' style='border-collapse: collapse;'>
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Foto</th>
                        <th scope="col">max peserta</th>
                        <th scope="col">peserta</th>
                        <th scope="col">tanggal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>

    {{-- Modal button Add --}}

    <div class="modal fade text-left" id="add_data_course" tabindex="-1" role="dialog" aria-labelledby="modal_add"
        aria-hidden="true">
        <div class="modal-dialog modal-create modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_add">Tambah Course</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="reset_form()">
                        <i data-feather="x"></i>
                    </button>
                </div>

                {{-- form --}}
                <form>
                    <div class="modal-body">
                        <label>nama: (required)</label>
                        <div class="form-group">
                            <input type="text" placeholder="Nama course" class="form-control" name="add_nama" required>
                        </div>

                        <label>kategori: (required)</label>
                        <div class="form-group">
                            <select class="form-control" id="add_kategori" name="add_kategori" required>
                                <option value="">Pilih</option>
                            </select>
                        </div>

                        <label>foto: (required)</label>
                        <div class="form-group">
                            <input type="file" placeholder="foto" class="form-control" name="add_foto" id="add_foto"
                                onchange="AlertFilesize(this.id, {{ $filesize }}, 'add_foto' )" required>
                        </div>

                        <label>video: </label>
                        <div class="form-group">
                            <input type="text" placeholder="video youtube embed link" class="form-control"
                                name="add_video">
                        </div>

                        <label>Deskripsi: </label>
                        <div class="card-body">
                            <div id="full">
                                <p>Hello World!</p>
                                <p>Some initial <strong>bold</strong> text</p>
                                <p><br></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <label>Tanggal Mulai: (required)</label>
                                <div class="form-group">
                                    <input type="date" placeholder="Tanggal mulai course" class="form-control"
                                        name="add_min_tgl" required>
                                </div>

                            </div>
                            <div class="col-md-6 col-12">
                                <label>Tanggal Selesai:</label>
                                <div class="form-group">
                                    <input type="date" placeholder="Tanggal selesai course" class="form-control"
                                        name="add_max_tgl">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <label>Mulai: </label>
                                <div class="form-group">
                                    <input type="time" placeholder="Tanggal mulai course" class="form-control"
                                        name="add_min_pukul">
                                </div>

                            </div>
                            <div class="col-md-6 col-12">
                                <label>Selesai: </label>
                                <div class="form-group">
                                    <input type="time" placeholder="Tanggal selesai course" class="form-control"
                                        name="add_max_pukul">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <label>Minimal Peserta: </label>
                                <div class="form-group">
                                    <input type="number" placeholder="Jumlah minimal peserta" class="form-control"
                                        name="add_min_user">
                                </div>

                            </div>
                            <div class="col-md-6 col-12">
                                <label>Maksimal Peserta: </label>
                                <div class="form-group">
                                    <input type="number" placeholder="Jumlah maksimal peserta" class="form-control"
                                        name="add_max_user">
                                </div>
                            </div>
                        </div>

                        <label>Harga:</label>
                        <div class="form-group">
                            <input type="number" placeholder="Jika kosong maka harga free" class="form-control"
                                name="add_harga">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-dismiss="modal" onClick="reset_form()">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                    </div>
                </form>
                {{-- form End --}}

            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="add_data_peserta" tabindex="-1" role="dialog" aria-labelledby="modal_add"
        aria-hidden="true">
        <div class="modal-dialog modal-peserta modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_add">Tambah Peserta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="reset_form()">
                        <i data-feather="x"></i>
                    </button>
                </div>

                {{-- form --}}
                <form>
                    <div class="modal-body">
                        <label>Nama Course: </label>
                        <div class="form-group">
                            <input type="hidden" name="add_peserta_idc" readonly>
                            <input type="text" placeholder="nama course" class="form-control" name="add_peserta_namac"
                                readonly>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group py-3">
                                    <label>Tambah Guru</label><br>
                                    <select class="form-control" id="add_peserta_pengajar" name="add_peserta_pengajar[]"
                                        multiple>
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group py-3">
                                    <label>Tambah Murid</label><br>
                                    <select class="form-control" id="add_peserta_pelajar" name="add_peserta_pelajar[]"
                                        multiple>
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-dismiss="modal" onClick="reset_form()">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                    </div>
                </form>
                {{-- form End --}}

            </div>
        </div>
    </div>

    {{-- End Modal button Add --}}

    {{-- Modal button Edit --}}

    <div class="modal fade text-left" id="edit_data_course" tabindex="-1" role="dialog" aria-labelledby="modal_add"
        aria-hidden="true">
        <div class="modal-dialog modal-create modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_add">Edit Course</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                        onClick="reset_form()">
                        <i data-feather="x"></i>
                    </button>
                </div>

                {{-- form --}}
                <form>
                    <div class="modal-body">
                        <label>nama:</label>
                        <div class="form-group">
                            <input type="hidden" name="edit_courseid" readonly>
                            <input type="text" placeholder="Nama course" class="form-control" name="edit_nama" required>
                        </div>

                        <label>kategori:</label>
                        <div class="form-group">
                            <select class="form-control" id="edit_kategori" name="edit_kategori" required>
                                <option value="">Pilih</option>
                            </select>
                        </div>

                        <label>foto:</label>
                        <div class="form-group">
                            <input type="hidden" name="edit_old_foto" readonly>
                            <input type="file" placeholder="foto" class="form-control" name="edit_foto" id="edit_foto"
                                onchange="AlertFilesize(this.id, {{ $filesize }}, 'edit_foto' )">
                        </div>

                        <label>video: </label>
                        <div class="form-group">
                            <input type="text" placeholder="video youtube embed link" class="form-control"
                                name="edit_video">
                        </div>

                        <label>Deskripsi: </label>
                        <div class="card-body">
                            <div id="full1">
                                <p>Hello World!</p>
                                <p>Some initial <strong>bold</strong> text</p>
                                <p><br></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <label>Tanggal Mulai:</label>
                                <div class="form-group">
                                    <input type="date" placeholder="Tanggal mulai course" class="form-control"
                                        name="edit_min_tgl" required>
                                </div>

                            </div>
                            <div class="col-md-6 col-12">
                                <label>Tanggal Selesai:</label>
                                <div class="form-group">
                                    <input type="date" placeholder="Tanggal selesai course" class="form-control"
                                        name="edit_max_tgl">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <label>Mulai: </label>
                                <div class="form-group">
                                    <input type="time" placeholder="Tanggal mulai course" class="form-control"
                                        name="edit_min_pukul">
                                </div>

                            </div>
                            <div class="col-md-6 col-12">
                                <label>Selesai: </label>
                                <div class="form-group">
                                    <input type="time" placeholder="Tanggal selesai course" class="form-control"
                                        name="edit_max_pukul">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <label>Minimal Peserta: </label>
                                <div class="form-group">
                                    <input type="number" placeholder="Jumlah minimal peserta" class="form-control"
                                        name="edit_min_user">
                                </div>

                            </div>
                            <div class="col-md-6 col-12">
                                <label>Maksimal Peserta: </label>
                                <div class="form-group">
                                    <input type="number" placeholder="Jumlah maksimal peserta" class="form-control"
                                        name="edit_max_user">
                                </div>
                            </div>
                        </div>

                        <label>Harga:</label>
                        <div class="form-group">
                            <input type="number" placeholder="Jika kosong maka harga free" class="form-control"
                                name="edit_harga">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-dismiss="modal" onClick="reset_form()">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                    </div>
                </form>
                {{-- form End --}}

            </div>
        </div>
    </div>

    {{-- End Modal button Edit --}}

@endsection

@section('js_asset')
    <!-- MultiSelect -->
    <script src="{{ asset('assets/js/bootstrap-multiselect.js') }}"></script>

    <!-- Editor -->
    <script src="{{ asset('vendors/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-editor.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ asset('/vendors/datatables/jquery.dataTables.min.js') }}"></script>

    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tabel_course').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('/api/v1/course/list') }}",
                columns: [{
                        data: 'nama'
                    },
                    {
                        data: 'foto'
                    },
                    {
                        data: 'max_user'
                    },
                    {
                        sortable: false,
                        data: 'jumlah_murid'
                    },
                    {
                        data: 'min_tgl'
                    },
                    {
                        sortable: false,
                        render: function(data, type, full, meta) {
                            const button_tambah_peserta =
                                "<a class=\"btn icon btn-success mx-1 my-1\" data-toggle=\"tooltip\" data-title=\"Tambah Peserta\" title=\"Tambah Peserta\" href=\"javascript:void(0)\" onclick=\"tambah_peserta('" +
                                full.id + "', '" + full.nama + "')\">➕</a>";
                            const button_edit =
                                "<a class=\"btn icon btn-primary mx-1 my-1\" data-toggle=\"tooltip\" data-title=\"Edit\" title=\"Edit\" href=\"javascript:void(0)\" onclick=\"edit_course('" +
                                full.id + "')\">⚙</a>";
                            const button_delete =
                                "<a class=\"btn icon btn-danger mx-1 my-1\" data-toggle=\"tooltip\" data-title=\"Delete\" title=\"Delete\" href=\"javascript:void(0)\" onclick=\"remove_course('" +
                                full.id + "')\">🚮</a>";
                            return button_tambah_peserta + button_edit + button_delete;
                        }
                    },
                ],
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    ['10 rows', '25 rows', '50 rows', '100 rows', 'all']
                ],
                buttons: [{
                        text: 'Tambah Course',
                        action: function(e, dt, node, config) {
                            add_kategori_option();
                            $('#add_data_course').modal('show');
                        }
                    },
                    'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'
                ],
            });
        });
    </script>

@endsection

@section('js_script')
    <script>
        /* Send Form */
        $("form").on("submit", function(e) {
            e.preventDefault();
            var valid = true;
            var token = $('meta[name="csrf-token"]').attr('content');
            //generalisasi form agar data file bisa masuk
            var form = $(this)[0];

            //mengambil semua data di dalam form
            var formData = new FormData(form);
            console.log($('#add_peserta_pelajar').val());
            console.log($('input[name="edit_nama"]').val());

            if (
                typeof $('input[name="add_nama"]').val() !== 'undefined' &&
                $('input[name="add_nama"]').val() !== null &&
                $('input[name="add_nama"]').val() !== ''
            ) {
                var url = "{{ url('/api/v1/course/add') }}";
                var status = 'Penambahan';
                formData.append('add_deskripsi', $('#full .ql-editor').html());
            } else if (
                typeof $('#add_peserta_pelajar').val() !== 'undefined' &&
                $('#add_peserta_pelajar').val() !== null &&
                $('#add_peserta_pelajar').val() !== '' &&
                $('#add_peserta_pelajar').val().length !== 0
            ) {
                var url = "{{ url('/api/v1/course/add/peserta') }}";
            } else if (
                typeof $('input[name="edit_nama"]').val() !== 'undefined' &&
                $('input[name="edit_nama"]').val() !== null &&
                $('input[name="edit_nama"]').val() !== ''
            ) {
                var url = "{{ url('/api/v1/course/edit') }}";
                formData.append('edit_deskripsi', $('#full1 .ql-editor').html());
            }

            //fitur swal
            $(this).find('.textbox').each(function() {
                if (!$(this).val()) {
                    get_error_text(this);
                    valid = false;
                    $('html,body').animate({
                        scrollTop: 0
                    }, "slow");
                }
                if ($(this).hasClass('no-valid')) {
                    valid = false;
                    $('html,body').animate({
                        scrollTop: 0
                    }, "slow");
                }
            });
            if (valid) {
                Swal.fire({
                    title: 'Konfirmasi simpan data',
                    text: "Data akan di simpan ke database",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#1da1f2",
                    confirmButtonText: "Yakin, dong!",
                    cancelButtonColor: '#d33',
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': token
                            },
                            url: url,
                            type: "POST",
                            data: formData,
                            dataType: "html",
                            contentType: false,
                            processData: false,
                            //jika ajax sukses
                            success: function(data) {
                                swal.fire({
                                    title: status + " data berhasil",
                                    icon: "success"
                                }).then((result) => {
                                    if (result.value) {
                                        reset_form();
                                    }
                                });
                            },
                            //jika ajax gagal
                            error: function(xhr, ajaxOptions, thrownError) {
                                const respon = JSON.parse(xhr.responseText);
                                if (respon.message) {
                                    setTimeout(function() {
                                        swal.fire("Error", respon.message, "error");
                                    }, 2000);
                                } else {
                                    setTimeout(function() {
                                        swal.fire("Error", "Periksa koneksi anda",
                                            "error");
                                    }, 2000);
                                }
                            }
                        });
                    }
                })
            }
        });
        /* Send Form End */

        function remove_course(id) {
            var valid = true;
            var token = $('meta[name="csrf-token"]').attr('content');

            //fitur swal
            $(this).find('.textbox').each(function() {
                if (!$(this).val()) {
                    get_error_text(this);
                    valid = false;
                    $('html,body').animate({
                        scrollTop: 0
                    }, "slow");
                }
                if ($(this).hasClass('no-valid')) {
                    valid = false;
                    $('html,body').animate({
                        scrollTop: 0
                    }, "slow");
                }
            });
            if (valid) {
                Swal.fire({
                    title: 'Konfirmasi delete data',
                    text: "Data tidak akan dimunculkan lagi",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: "#1da1f2",
                    confirmButtonText: "Yakin, dong!",
                    cancelButtonColor: '#d33',
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': token
                            },
                            url: "{{ url('/api/v1/course/delete') . '/' }}" + id,
                            type: "POST",
                            //jika ajax sukses
                            success: function(data) {
                                swal.fire({
                                    title: "penghapusan data berhasil",
                                    icon: "success"
                                }).then((result) => {
                                    if (result.value) {
                                        reset_form();
                                    }
                                })
                            },
                            //jika ajax gagal
                            error: function(xhr, ajaxOptions, thrownError) {
                                setTimeout(function() {
                                    swal.fire("Error", "Periksa koneksi anda", "error");
                                }, 2000);
                            }
                        });
                    }
                })
            }
        }

        /* validasi file size dan extension */
        function AlertFilesize(cid, sz, id) {
            var controllerID = cid;
            var fileSize = sz * 1048576; //MB to Bytes
            var extation = 'MB';
            if (window.ActiveXObject) {
                var fso = new ActiveXObject("Scripting.FileSystemObject");
                var filepath = document.getElementById(id).value;
                var thefile = fso.getFile(filepath);
                var sizeinbytes = thefile.size;
            } else {
                var sizeinbytes = document.getElementById(id).files[0].size;
            }

            var fup = document.getElementById(id);
            var fileName = fup.value;
            var ext = fileName.substring(fileName.lastIndexOf('.') + 1).toLowerCase();
            if (ext == "png" || ext == "jpg") {
                if (sizeinbytes < fileSize) {
                    return true;
                } else {
                    alert("silahkan masukkan file kurang dari " + fileSize + extation);
                    document.getElementById(id).value = '';
                    return false;
                }
            } else {
                alert("silahkan masukkan file png atau jpg");
                document.getElementById(id).value = '';
                return false;
            }
        }

        function add_kategori_option() {
            var token = $('meta[name="csrf-token"]').attr('content');
            $('#add_kategori')
                .find('option')
                .remove()
                .end()
                .append('<option value="">pilih</option>');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: "{{ url('/api/v1/kategori/course/list') }}",
                type: "GET",
                async: false,
                dataType: 'json',
                //jika ajax sukses
                success: function(data) {
                    const st = document.getElementById("add_kategori");
                    for (var key in data.data) {
                        var opt = document.createElement('option');
                        opt.value = data.data[key].id;
                        opt.innerHTML = data.data[key].nama;
                        st.appendChild(opt);
                    }
                }
            });
        }

        function add_pengajar_option(id_course) {
            var token = $('meta[name="csrf-token"]').attr('content');
            $('#add_peserta_pengajar')
                .find('option')
                .remove()
                .end()

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: "{{ url('/api/v1/user/pengajar/list/') . '/' }}" + id_course,
                type: "GET",
                async: false,
                dataType: 'json',
                //jika ajax sukses
                success: function(data) {
                    console.log(data);
                    const st = document.getElementById("add_peserta_pengajar");
                    for (var key in data.data) {
                        var opt = document.createElement('option');
                        opt.value = data.data[key].id;
                        opt.innerHTML = data.data[key].nama;
                        st.appendChild(opt);
                    }
                }
            });
        }

        function add_pelajar_option(id_course) {
            var token = $('meta[name="csrf-token"]').attr('content');
            $('#add_peserta_pelajar')
                .find('option')
                .remove()
                .end()

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: "{{ url('/api/v1/user/pelajar/list/') . '/' }}" + id_course,
                type: "GET",
                async: false,
                dataType: 'json',
                //jika ajax sukses
                success: function(data) {
                    console.log(data);
                    const st = document.getElementById("add_peserta_pelajar");
                    for (var key in data.data) {
                        var opt = document.createElement('option');
                        opt.value = data.data[key].id;
                        opt.innerHTML = data.data[key].nama;
                        st.appendChild(opt);
                    }
                }
            });
        }

        function edit_kategori_option(id) {
            var token = $('meta[name="csrf-token"]').attr('content');
            $('#edit_kategori')
                .find('option')
                .remove()
                .end();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: "{{ url('/api/v1/kategori/course/list') }}",
                type: "GET",
                async: false,
                dataType: 'json',
                //jika ajax sukses
                success: function(data) {
                    const st = document.getElementById("edit_kategori");
                    for (var key in data.data) {
                        var opt = document.createElement('option');
                        opt.value = data.data[key].id;
                        opt.innerHTML = data.data[key].nama;
                        if (data.data[key].id == id) {
                            opt.selected = true;
                        }
                        st.appendChild(opt);
                    }
                }
            });
        }

        function tambah_peserta(id, nama) {
            $('#add_peserta_pengajar').multiselect('destroy');
            $('#add_peserta_pelajar').multiselect('destroy');
            add_pengajar_option(id);
            add_pelajar_option(id);
            $('#add_peserta_pengajar').multiselect({
                enableFiltering: true,
                includeFilterClearBtn: true
            });
            $('#add_peserta_pelajar').multiselect({
                enableFiltering: true,
                includeFilterClearBtn: true
            });
            $('input[name="add_peserta_idc"]').val(id);
            $('input[name="add_peserta_namac"]').val(nama);
            $('#add_data_peserta').modal('show');
        }

        function edit_course(id) {
            var token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: "{{ url('/api/v1/course/list/') . '/' }}" + id,
                type: "GET",
                async: false,
                dataType: 'json',
                //jika ajax sukses
                success: function(data) {
                    console.log(data);
                    edit_kategori_option(data.id_kategori);
                    $('input[name="edit_courseid"]').val(data.id);
                    $('input[name="edit_nama"]').val(data.nama);
                    $('input[name="edit_video"]').val(data.video);
                    $('input[name="edit_old_foto"]').val(data.foto);
                    $('#full1 .ql-editor').html(data.deskripsi);
                    $('input[name="edit_min_tgl"]').val(data.min_tgl);
                    $('input[name="edit_max_tgl"]').val(data.max_tgl);
                    $('input[name="edit_min_pukul"]').val(data.min_pukul);
                    $('input[name="edit_max_pukul"]').val(data.max_pukul);
                    $('input[name="edit_min_user"]').val(data.min_user);
                    $('input[name="edit_max_user"]').val(data.max_user);
                    $('input[name="edit_harga"]').val(data.harga);
                    $('#edit_data_course').modal('show');
                }
            });
        }

        function reset_form() {
            $('form').trigger("reset");
            $('#add_peserta_pengajar').multiselect('destroy');
            $('#add_peserta_pelajar').multiselect('destroy');
            $('#tabel_course').DataTable().ajax.reload();
            $('#add_data_course').modal('hide');
            $('#add_data_peserta').modal('hide');
            $('#edit_data_course').modal('hide');
        }
    </script>

@endsection
