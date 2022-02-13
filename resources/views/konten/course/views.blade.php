@extends('admin/core/main')
@extends('admin/core/navbar')
@extends('admin/core/footer')

@section('title', 'List Courses - Dashboard MOOC')
@section('page-title', 'List Courses')
@section('page-subtitle', 'Ini adalah List Courses pelatihan MOOC')

@section('css')
<!--===============================================================================================-->
<link rel="stylesheet" href="{{ url('assets/admin/css/app.css') }}">
<link href="{{ asset('/vendors/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<!--===============================================================================================-->
@endsection

@section('konten')

    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <table id='tabel' width='100%' border="1" class='table table-striped' style='border-collapse: collapse;'>
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Subkategori</th>
                    <th scope="col">Peserta</th>
                    <th scope="col">Peserta Views</th>
                    <th scope="col">Tamu Views</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
              </table>
            
        </div>
    </div>
    
@endsection

@section('js_asset')

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
    $(document).ready(function(){
        $('#tabel').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{ url('/course/data/views') }}",
         columns: [
            { data: 'id' },
            { data: 'course' },
            { data: 'kategori' },
            { data: 'subkategori' },
            { data: 'participate_users' },
            { data: 'participate_views' },
            { data: 'guest_views' },
            { data: 'total' },
            { 
                sortable: false,
                render: function ( data, type, full, meta ) {
                    const button_analys = "<a class=\"btn icon btn-primary mx-1 my-1\" data-toggle=\"tooltip\" data-title=\"Analys Course\" title=\"Analys Course\" href=\"javascript:void(0)\" onclick=\"window.location.href='{{ url('/course/') }}/"+full.id+"'\">💹</a>";
                    const button_activity = "<a class=\"btn icon btn-success mx-1 my-1\" data-toggle=\"tooltip\" data-title=\"Log Activity\" title=\"Log Activity\" href=\"javascript:void(0)\" onclick=\"window.location.href='{{ url('/course/logs/') }}/"+full.id+"'\">🧾</a>";
                    const button_progress = "<a class=\"btn icon btn-info mx-1 my-1\" data-toggle=\"tooltip\" data-title=\"Log Progress\" title=\"Log Progress\" href=\"javascript:void(0)\" onclick=\"window.location.href='{{ url('/course/progress/') }}/"+full.id+"'\">📑</a>";
                    return button_analys+button_activity+button_progress;
                 }
            },
         ],
         dom: 'Bfrtip',
         lengthMenu: [
            [ 10, 25, 50, 100 , -1],
            [ '10 rows', '25 rows', '50 rows', '100 rows', 'all']
         ],
         buttons: [
            'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
         ],
      });
    });
    </script>

@endsection

@section('js_script')
@endsection