@extends('core/main')
@extends('core/navbar')
@extends('core/footer')

@section('title', 'List Blog - Dashboard Pintaro')
@section('page-title', 'List Blog')
@section('page-subtitle', 'Ini adalah List Blog pelatihan Pintaro')

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
            <table id='tabel_blog' width='100%' border="1" class='table table-striped' style='border-collapse: collapse;'>
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">View</th>
                        <th scope="col">Like</th>
                        <th scope="col">tanggal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>

    {{-- Modal button Add --}}

    <div class="modal fade text-left" id="add_data_blog" tabindex="-1" role="dialog" aria-labelledby="modal_add"
        aria-hidden="true">
        <div class="modal-dialog modal-create3 modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_add">Tambah Blog</h4>
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
                            <input type="text" placeholder="Nama blog" class="form-control" name="add_nama" required>
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

                        <label>Deskripsi: </label>
                        <div class="card-body">
                            <div id="full">
                                <p>Hello World!</p>
                                <p>Some initial <strong>bold</strong> text</p>
                                <p><br></p>
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
                        <label>Nama Blog: </label>
                        <div class="form-group">
                            <input type="hidden" name="add_peserta_idc" readonly>
                            <input type="text" placeholder="nama blog" class="form-control" name="add_peserta_namac"
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

    <div class="modal fade text-left" id="edit_data_blog" tabindex="-1" role="dialog" aria-labelledby="modal_add"
        aria-hidden="true">
        <div class="modal-dialog modal-create3 modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_add">Edit Blog</h4>
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
                            <input type="hidden" name="edit_blogid" readonly>
                            <input type="text" placeholder="Nama blog" class="form-control" name="edit_nama" required>
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

                        <label>Deskripsi: </label>
                        <div class="card-body">
                            <div id="full1">
                                <p>Hello World!</p>
                                <p>Some initial <strong>bold</strong> text</p>
                                <p><br></p>
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
            $('#tabel_blog').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('/api/v1/blog/list') }}",
                columns: [{
                        data: 'nama'
                    },
                    {
                        data: 'foto'
                    },
                    {
                        data: 'view'
                    },
                    {
                        data: 'like'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        sortable: false,
                        render: function(data, type, full, meta) {
                            const button_edit =
                                "<a class=\"btn icon btn-primary mx-1 my-1\" data-toggle=\"tooltip\" data-title=\"Edit\" title=\"Edit\" href=\"javascript:void(0)\" onclick=\"edit_blog('" +
                                full.id + "')\">⚙</a>";
                            const button_delete =
                                "<a class=\"btn icon btn-danger mx-1 my-1\" data-toggle=\"tooltip\" data-title=\"Delete\" title=\"Delete\" href=\"javascript:void(0)\" onclick=\"remove_blog('" +
                                full.id + "')\">🚮</a>";
                            return button_edit + button_delete;
                        }
                    },
                ],
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    ['10 rows', '25 rows', '50 rows', '100 rows', 'all']
                ],
                buttons: [{
                        text: 'Tambah Blog',
                        action: function(e, dt, node, config) {
                            add_kategori_option();
                            $('#add_data_blog').modal('show');
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
                var url = "{{ url('/api/v1/blog/add') }}";
                var status = 'Penambahan';
                formData.append('add_deskripsi', $('#full .ql-editor').html());
            } else if (
                typeof $('#add_peserta_pelajar').val() !== 'undefined' &&
                $('#add_peserta_pelajar').val() !== null &&
                $('#add_peserta_pelajar').val() !== '' &&
                $('#add_peserta_pelajar').val().length !== 0
            ) {
                var url = "{{ url('/api/v1/blog/add/peserta') }}";
            } else if (
                typeof $('input[name="edit_nama"]').val() !== 'undefined' &&
                $('input[name="edit_nama"]').val() !== null &&
                $('input[name="edit_nama"]').val() !== ''
            ) {
                var url = "{{ url('/api/v1/blog/edit') }}";
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

        function remove_blog(id) {
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
                            url: "{{ url('/api/v1/blog/delete') . '/' }}" + id,
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
                url: "{{ url('/api/v1/kategori/blog/list') }}",
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

        function add_pengajar_option(id_blog) {
            var token = $('meta[name="csrf-token"]').attr('content');
            $('#add_peserta_pengajar')
                .find('option')
                .remove()
                .end()

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: "{{ url('/api/v1/user/pengajar/list/') . '/' }}" + id_blog,
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

        function add_pelajar_option(id_blog) {
            var token = $('meta[name="csrf-token"]').attr('content');
            $('#add_peserta_pelajar')
                .find('option')
                .remove()
                .end()

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: "{{ url('/api/v1/user/pelajar/list/') . '/' }}" + id_blog,
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
                url: "{{ url('/api/v1/kategori/blog/list') }}",
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

        function edit_blog(id) {
            var token = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: "{{ url('/api/v1/blog/list/') . '/' }}" + id,
                type: "GET",
                async: false,
                dataType: 'json',
                //jika ajax sukses
                success: function(data) {
                    console.log(data);
                    edit_kategori_option(data.id_kategori);
                    $('input[name="edit_blogid"]').val(data.id);
                    $('input[name="edit_nama"]').val(data.nama);
                    $('input[name="edit_old_foto"]').val(data.foto);
                    $('#full1 .ql-editor').html(data.deskripsi);
                    $('#edit_data_blog').modal('show');
                }
            });
        }

        function reset_form() {
            $('form').trigger("reset");
            $('#add_peserta_pengajar').multiselect('destroy');
            $('#add_peserta_pelajar').multiselect('destroy');
            $('#tabel_blog').DataTable().ajax.reload();
            $('#add_data_blog').modal('hide');
            $('#add_data_peserta').modal('hide');
            $('#edit_data_blog').modal('hide');
        }
    </script>

@endsection
