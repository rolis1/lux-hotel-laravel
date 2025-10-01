@extends('layouts.adminlte')
@section('content')

<style>
    /* Custom Hotel Facility List Styles */
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        overflow: hidden;
        background: #fff;
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

    .card-title {
        color: white;
        font-weight: 700;
        margin: 0;
        font-size: 1.6rem;
        position: relative;
        z-index: 1;
    }

    .card-tools .badge-primary {
        background: rgba(255,255,255,0.2);
        border: 2px solid rgba(255,255,255,0.3);
        padding: 12px 25px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        color: white;
    }

    .card-tools .badge-primary:hover {
        background: rgba(255,255,255,0.3);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        color: white;
        text-decoration: none;
    }

    .card-body {
        padding: 0;
    }

    .table {
        margin: 0;
        border: none;
        width: 100% !important;
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
    }

    .table tbody td {
        padding: 20px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f4;
        transition: all 0.3s ease;
        border: none;
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
        padding: 15px;
        text-align: center;
        border-radius: 8px;
        margin: 5px;
    }

    /* Facility name styling */
    tbody td:nth-child(2) {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.95rem;
    }

    /* Description styling */
    tbody td:nth-child(3) {
        color: #6c757d;
        font-size: 0.9rem;
        line-height: 1.4;
        max-width: 300px;
    }

    .btn-group .btn {
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 10px 16px;
        margin: 2px;
        transition: all 0.3s ease;
        border: none;
        min-width: 70px;
    }

    .btn-warning {
        background: linear-gradient(135deg, #ffd43b 0%, #fcc419 100%);
        color: #2c3e50;
        border: none;
    }

    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 212, 59, 0.4);
        background: linear-gradient(135deg, #fcc419 0%, #fab005 100%);
    }

    .btn-danger {
        background: linear-gradient(135deg, #ff6b6b 0%, #fa5252 100%);
        color: white;
        border: none;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
        background: linear-gradient(135deg, #fa5252 0%, #e03131 100%);
    }

    .btn-sm {
        padding: 8px 16px;
        font-size: 0.8rem;
    }

    /* DataTable Customization */
    .dataTables_wrapper {
        padding: 20px;
    }

    .dataTables_length,
    .dataTables_filter {
        margin-bottom: 20px;
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

    /* Action buttons container */
    .btn-group {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    /* Empty state styling */
    .dataTables_empty {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }

    .dataTables_empty::before {
        content: '🏨';
        font-size: 3rem;
        display: block;
        margin-bottom: 15px;
        opacity: 0.5;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .card-header {
            padding: 20px;
        }
        
        .card-title {
            font-size: 1.4rem;
        }
        
        .card-tools .badge-primary {
            padding: 10px 20px;
            font-size: 0.8rem;
        }
        
        .table thead th,
        .table tbody td {
            padding: 15px 10px;
            font-size: 0.8rem;
        }
        
        .btn-group .btn {
            padding: 6px 12px;
            font-size: 0.75rem;
            min-width: 60px;
        }
        
        tbody td:nth-child(3) {
            max-width: 200px;
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

    /* Table header icons */
    .table thead th:first-child::before {
        content: '🔢';
        margin-right: 8px;
        opacity: 0.7;
    }

    .table thead th:nth-child(2)::before {
        content: '🏷️';
        margin-right: 8px;
        opacity: 0.7;
    }

    .table thead th:nth-child(3)::before {
        content: '📝';
        margin-right: 8px;
        opacity: 0.7;
    }

    .table thead th:last-child::before {
        content: '⚡';
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

    /* Description text truncation for better layout */
    .description-cell {
        max-width: 300px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    @media (min-width: 1200px) {
        .description-cell {
            max-width: 400px;
            white-space: normal;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    }
</style>

<div class="card">
    <div class="card-header">
      <h3 class="card-title">HOTEL FACILITY LIST</h3>
      <div class="card-tools">
          <a href="{{ route('hotelfacility.create') }}" class="badge badge-primary mr-2">add</a>
        </div>
    </div>
    <div class="card-body">
        <table id="facilityList" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Facility Name</th>
                    <th>Facility Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $dt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dt->facility_name }}</td>
                        <td class="description-cell">{{ $dt->detail }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('hotelfacility.edit', $dt->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="{{ route('hotelfacility.delete', $dt->id) }}" onclick="return confirm('Yakin?')" class="btn btn-sm btn-danger">Delete</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

  </div>

  @section('js')
    <script>
        $(function() {
            $("#facilityList").DataTable({
                "responsive": true,
                "paging" : false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#facilityList_wrapper .col-md-6:eq(0)');
        });
    </script>
  @endsection
@endsection