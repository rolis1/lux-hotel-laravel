@extends('layouts.adminlte')
@section('content')

<style>
    /* Custom Facility Room List Styles */
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

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(102, 126, 234, 0.02);
    }

    .table-striped tbody tr:nth-of-type(odd):hover {
        background-color: #f8f9ff;
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

    /* Table cell enhancements */
    tbody td:first-child {
        font-weight: 600;
        color: #667eea;
        background: #f8f9ff;
        padding: 15px;
        text-align: center;
        border-radius: 8px;
        margin: 5px;
    }

    tbody td:nth-child(2) {
        font-weight: 500;
        color: #2c3e50;
        font-size: 0.95rem;
    }

    /* Custom Modal Styles */
    .custom-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(5px);
        z-index: 9999;
        animation: fadeIn 0.3s ease;
    }

    .modal-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        border-radius: 15px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        width: 90%;
        max-width: 400px;
        overflow: hidden;
        animation: slideUp 0.4s ease;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translate(-50%, -40%);
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%);
        }
    }

    .modal-header {
        background: linear-gradient(135deg, #ff6b6b 0%, #fa5252 100%);
        padding: 25px 30px;
        text-align: center;
        border-bottom: none;
    }

    .modal-icon {
        font-size: 3rem;
        margin-bottom: 15px;
        display: block;
    }

    .modal-title {
        color: white;
        font-weight: 700;
        font-size: 1.4rem;
        margin: 0;
    }

    .modal-body {
        padding: 30px;
        text-align: center;
    }

    .modal-message {
        color: #2c3e50;
        font-size: 1.1rem;
        font-weight: 500;
        margin-bottom: 25px;
        line-height: 1.5;
    }

    .facility-info {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        margin: 20px 0;
        border-left: 4px solid #667eea;
    }

    .facility-info strong {
        color: #2c3e50;
        font-size: 1rem;
    }

    .modal-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 25px;
    }

    .btn-cancel {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 25px;
        font-weight: 600;
        color: #6c757d;
        transition: all 0.3s ease;
        text-decoration: none;
        min-width: 100px;
    }

    .btn-cancel:hover {
        background: #e9ecef;
        color: #495057;
        transform: translateY(-2px);
    }

    .btn-confirm-delete {
        background: linear-gradient(135deg, #ff6b6b 0%, #fa5252 100%);
        border: none;
        border-radius: 10px;
        padding: 12px 25px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        min-width: 100px;
    }

    .btn-confirm-delete:hover {
        background: linear-gradient(135deg, #fa5252 0%, #e03131 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
    }

    /* Action buttons container */
    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        justify-content: center;
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

        .modal-content {
            width: 95%;
            max-width: 350px;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-buttons {
            flex-direction: column;
            gap: 10px;
        }

        .btn-cancel,
        .btn-confirm-delete {
            width: 100%;
        }

        .action-buttons {
            flex-direction: column;
            gap: 5px;
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
</style>

<!-- Custom Delete Confirmation Modal -->
<div class="custom-modal" id="deleteModal">
    <div class="modal-content">
        <div class="modal-header">
            <i class="fas fa-exclamation-triangle modal-icon"></i>
            <h4 class="modal-title">Confirm Deletion</h4>
        </div>
        <div class="modal-body">
            <p class="modal-message">Are you sure you want to delete this facility? This action cannot be undone.</p>
            
            <div class="facility-info">
                <strong>Facility Details:</strong><br>
                <span id="modalFacilityName"></span>
            </div>

            <div class="modal-buttons">
                <button type="button" class="btn-cancel" id="cancelDelete">
                    <i class="fas fa-times mr-2"></i>Cancel
                </button>
                <a href="#" class="btn-confirm-delete" id="confirmDelete">
                    <i class="fas fa-trash mr-2"></i>Delete
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
      <h3 class="card-title">FACILITY ROOM LIST</h3>
      <div class="card-tools">
          <a href="{{ route('roomfacility.create') }}" class="badge badge-primary mr-2">add</a>
        </div>
    </div>
    <div class="card-body">
        <table id="facilityRoomlist" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Facility Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $dt)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dt->facility_name }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('roomfacility.edit', $dt->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </a>
                                <a href="#" class="btn btn-danger btn-sm delete-btn" 
                                   data-facility-id="{{ $dt->id }}"
                                   data-facility-name="{{ $dt->facility_name }}">
                                    <i class="fas fa-trash mr-1"></i>
                                    Delete
                                </a>
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
    $(function () {
        $("#facilityRoomlist").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#facilityRoomlist_wrapper .col-md-6:eq(0)');

        // Add custom styling to DataTable elements
        $('.dataTables_length select').addClass('form-control-sm');
        $('.dataTables_filter input').addClass('form-control-sm');

        // Custom Delete Modal Functionality
        const deleteModal = document.getElementById('deleteModal');
        const cancelBtn = document.getElementById('cancelDelete');
        const confirmBtn = document.getElementById('confirmDelete');
        const modalFacilityName = document.getElementById('modalFacilityName');

        let currentDeleteUrl = '';

        // Add click event to all delete buttons
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                
                const facilityId = this.getAttribute('data-facility-id');
                const facilityName = this.getAttribute('data-facility-name');
                
                // Set modal content
                modalFacilityName.textContent = `Facility: ${facilityName}`;
                
                // Set delete URL
                currentDeleteUrl = "{{ route('roomfacility.delete', ':id') }}".replace(':id', facilityId);
                confirmBtn.href = currentDeleteUrl;
                
                // Show modal
                deleteModal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            });
        });

        // Close modal when cancel button is clicked
        cancelBtn.addEventListener('click', function() {
            deleteModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });

        // Close modal when clicking outside
        deleteModal.addEventListener('click', function(e) {
            if (e.target === deleteModal) {
                deleteModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && deleteModal.style.display === 'block') {
                deleteModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    });
</script>
@endsection
@endsection