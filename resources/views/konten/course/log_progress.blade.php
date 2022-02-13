@extends('admin/core/main')
@extends('admin/core/navbar')
@extends('admin/core/footer')

@section('title', 'Log Progress Course - Dashboard MOOC')
@section('page-title', 'Log Progress Course')
@section('page-subtitle', $course)

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
                                <th scope="col">Tipe</th>
                                <th scope="col">Nama Materi</th>
                                <th scope="col">Tipe Penyelesaian</th>
                                <th scope="col">Progress</th>
                                <th scope="col">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            @csrf
                        @if (
                            $data->activity_name !== null &&
                            $data->activity_name !== '' &&
                            $data->activity_name !== '.'
                        )
                        <tr>
                            
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->activity_type }}</td>
                            <td>{{ $data->activity_name  }}</td>
                            <td>{{ $data->activity_completion_type }}</td>
                            <td>{{ $data->progress }}</td>
                            <td>{{ $data->when }}</td>
                            
                        </tr>
                        @endif
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