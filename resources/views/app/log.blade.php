@php
   if(Auth::user()->role === 'admin') {
      $layoutDirectory = 'layouts.adminlte';
   } elseif (Auth::user()->role === 'resepsionis') {
      $layoutDirectory = 'layouts.app';
   }
@endphp

@extends($layoutDirectory)
@section('content')

<style>
    /* Custom Log Activities Styles */
    .container {
        padding: 20px;
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        overflow: hidden;
        background: #fff;
        margin-bottom: 30px;
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-bottom: none;
        padding: 25px 30px;
        position: relative;
        overflow: hidden;
    }

    .card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        transform: rotate(30deg);
    }

    .card-header h2 {
        color: white;
        font-weight: 700;
        margin: 0;
        font-size: 1.8rem;
        position: relative;
        z-index: 1;
    }

    .card-body {
        padding: 30px;
        background: #fafbfc;
    }

    .table {
        margin: 0;
        border: none;
        width: 100% !important;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .table thead th {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 3px solid #667eea;
        color: #2c3e50;
        font-weight: 700;
        padding: 18px 15px;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border: none;
        text-align: center;
    }

    .table tbody td {
        padding: 16px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f4;
        transition: all 0.3s ease;
        border: none;
        text-align: center;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #f8f9ff;
        transform: translateX(5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .table-bordered {
        border: none !important;
    }

    /* Serial number styling */
    tbody td:first-child {
        font-weight: 600;
        color: #667eea;
        background: #f8f9ff;
        padding: 12px;
        text-align: center;
        border-radius: 8px;
        margin: 5px;
    }

    /* Log message styling */
    tbody td:nth-child(2) {
        text-align: left;
        font-weight: 500;
        color: #2c3e50;
        max-width: 300px;
        word-wrap: break-word;
    }

    /* ID columns styling */
    tbody td:nth-child(3),
    tbody td:nth-child(4) {
        font-family: 'Courier New', monospace;
        font-weight: 600;
        color: #495057;
        background: #f8f9fa;
        border-radius: 6px;
        padding: 12px;
    }

    /* Date time styling */
    tbody td:last-child {
        font-family: 'Courier New', monospace;
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* DataTable Customization */
    .dataTables_wrapper {
        padding: 0;
    }

    .dataTables_length,
    .dataTables_filter {
        margin-bottom: 20px;
        padding: 0 10px;
    }

    .dataTables_length select,
    .dataTables_filter input {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        padding: 8px 12px;
        transition: all 0.3s ease;
    }

    .dataTables_length select:focus,
    .dataTables_filter input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .dt-buttons .btn {
        border-radius: 8px;
        margin: 2px;
        font-weight: 600;
        transition: all 0.3s ease;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        color: #495057;
    }

    .dt-buttons .btn:hover {
        transform: translateY(-2px);
        background: #667eea;
        color: white;
        border-color: #667eea;
    }

    /* Table header icons */
    .table thead th:first-child::before {
        content: '🔢';
        margin-right: 8px;
        opacity: 0.7;
    }

    .table thead th:nth-child(2)::before {
        content: '📝';
        margin-right: 8px;
        opacity: 0.7;
    }

    .table thead th:nth-child(3)::before {
        content: '🆔';
        margin-right: 8px;
        opacity: 0.7;
    }

    .table thead th:nth-child(4)::before {
        content: '👤';
        margin-right: 8px;
        opacity: 0.7;
    }

    .table thead th:last-child::before {
        content: '🕒';
        margin-right: 8px;
        opacity: 0.7;
    }

    /* Striped table enhancement */
    .table tbody tr:nth-of-type(odd) {
        background-color: rgba(102, 126, 234, 0.02);
    }

    .table tbody tr:nth-of-type(odd):hover {
        background-color: #f8f9ff;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }
        
        .card-header {
            padding: 20px;
        }
        
        .card-header h2 {
            font-size: 1.5rem;
        }
        
        .card-body {
            padding: 20px 15px;
        }
        
        .table thead th,
        .table tbody td {
            padding: 12px 8px;
            font-size: 0.8rem;
        }
        
        tbody td:nth-child(2) {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    }

    /* Loading animation for table rows */
    @keyframes fadeInUp {
        from { 
            opacity: 0; 
            transform: translateY(20px); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0); 
        }
    }

    .table tbody tr {
        animation: fadeInUp 0.5s ease forwards;
    }

    .table tbody tr:nth-child(odd) {
        animation-delay: 0.1s;
    }

    .table tbody tr:nth-child(even) {
        animation-delay: 0.2s;
    }

    /* Custom scrollbar for table */
    .dataTables_scrollBody {
        scrollbar-width: thin;
        scrollbar-color: #667eea #f1f3f4;
    }

    .dataTables_scrollBody::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .dataTables_scrollBody::-webkit-scrollbar-track {
        background: #f1f3f4;
        border-radius: 4px;
    }

    .dataTables_scrollBody::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 4px;
    }

    .dataTables_scrollBody::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #5a6fd8 0%, #6a42a8 100%);
    }

    /* Log type indicators */
    .log-info {
        border-left: 4px solid #339af0;
    }

    .log-warning {
        border-left: 4px solid #f59f00;
    }

    .log-success {
        border-left: 4px solid #51cf66;
    }

    .log-error {
        border-left: 4px solid #ff6b6b;
    }

    /* Center alignment for the header */
    .text-center {
        text-align: center !important;
    }

    /* DataTable button container */
    .dt-buttons {
        margin-bottom: 15px;
        padding: 0 10px;
    }

    /* Empty state styling */
    .dataTables_empty {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }

    .dataTables_empty::before {
        content: '📊';
        font-size: 3rem;
        display: block;
        margin-bottom: 15px;
        opacity: 0.5;
    }
</style>

<div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>
                    <center>
                        Log Activities
                    </center>
                </h2>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                            @if (Auth::user()->role == 'admin')

                                <table id="log" class="table table-bordered" style="width:100%">
                            @else

                                <table id="log" class="display" style="width:100%">
                            @endif
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Log</th>
                                        <th>Transaction ID</th>
                                        <th>Executor ID</th>
                                        <th>Date Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($datas as $item)

                                            <tr class="text-center">

                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->log }}</td>
                                                <td>{{ $item->transaction_id }}</td>
                                                <td>{{ $item->executor_id }}</td>
                                                <td>{{ $item->created_at }}</td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')

<script>
    $(function() {
        $("#log").DataTable({
            "responsive": true,
            "paging" : false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#facilityList_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
@section('script')
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/jszip.min.js') }}"></script>
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/buttons.print.min.js') }}"></script>
<script>
    $(function() {
        $("#log").DataTable({
            "responsive": true,
            "paging" : false,
            "dom": 'Bfrtip',
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        });
    });
</script>
@endsection
@endsection