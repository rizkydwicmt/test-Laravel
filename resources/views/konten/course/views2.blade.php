@extends('admin/core/main')
@extends('admin/core/navbar')
@extends('admin/core/footer')

@section('title', 'Viewers Course - Dashboard MOOC')
@section('page-title', 'Viewers Course')
@section('page-subtitle', 'Ini adalah perhitungan jumlah viewers setiap course')

@section('css')
<!--===============================================================================================-->
    <link href="{{ asset('/vendors/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<!--===============================================================================================-->
@endsection

@section('konten')

    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body">
            <p class="text-muted m-b-30" id="onload" >please wait..</p>
            <div class="table-responsive" style="display:none" id="data">
                <table class='table table-striped' id="tabel">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
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
                    <tbody>
                        @foreach ($datas as $data)
                            @csrf
                        <tr>
                            <th scope="row">{{ $data->id }}</th>
                            <td>{{ $data->course }}</td>
                            <td>{{ $data->kategori }}</td>
                            <td>{{ $data->subkategori }}</td>
                            <td>{{ $data->participate_users }}</td>
                            <td>{{ $data->participate_views }}</td>
                            <td>{{ $data->guest_views }}</td>
                            <td>{{ $data->total }}</td>
                            <td>
                                <a class="btn icon btn-primary mx-1 my-1" data-toggle="tooltip" data-title="Analys Course" title="Analys Course" href="javascript:void(0)" onclick="window.location.href='{{ url('/course/'.$data->id) }}'">💹</a> 
                                <a class="btn icon btn-success mx-1 my-1" data-toggle="tooltip" data-title="Log Activity" title="Log Activity" href="javascript:void(0)" onclick="window.location.href='{{ url('/course/logs/'.$data->id) }}'">🧾</a>
                                <a class="btn icon btn-info mx-1 my-1" data-toggle="tooltip" data-title="Log Progress" title="Log Progress" href="javascript:void(0)" onclick="window.location.href='{{ url('/course/progress/'.$data->id) }}'">📑</a>
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
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
    <script>
        $('#tabel').DataTable( {
            dom: 'Bfrtip',
            lengthMenu: [
                [ 10, 25, 50, 100 ],
                [ '10 rows', '25 rows', '50 rows', '100 rows' ]
            ],
            buttons: [
                'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
            ],
        });
    </script>

@endsection

@section('js_script')
<script>
    $(document).ready(function(){
        document.getElementById("data").style.display = "block";
        document.getElementById("onload").style.display = "none";
    });
</script>
@endsection