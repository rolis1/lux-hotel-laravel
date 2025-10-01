@extends('layouts.adminlte')
@section('content')

<style>
    /* Custom Room List Styles */
    .room-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .room-card .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-bottom: none;
        padding: 20px 25px;
    }

    .room-card .card-header h3 {
        color: white;
        font-weight: 700;
        margin: 0;
        font-size: 1.5rem;
    }

    .card-tools .badge-primary {
        background: rgba(255,255,255,0.2);
        border: 2px solid rgba(255,255,255,0.3);
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .card-tools .badge-primary:hover {
        background: rgba(255,255,255,0.3);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    .table-container {
        border-radius: 10px;
        overflow: hidden;
    }

    #roomlist {
        margin: 0;
        border: none;
    }

    #roomlist thead th {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 2px solid #667eea;
        color: #2c3e50;
        font-weight: 700;
        padding: 15px 12px;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    #roomlist tbody td {
        padding: 15px 12px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f4;
        transition: background-color 0.3s ease;
    }

    #roomlist tbody tr {
        transition: all 0.3s ease;
    }

    #roomlist tbody tr:hover {
        background-color: #f8f9ff;
        transform: translateX(5px);
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-available {
        background: linear-gradient(135deg, #51cf66 0%, #40c057 100%);
        color: white;
    }

    .status-occupied {
        background: linear-gradient(135deg, #ff6b6b 0%, #fa5252 100%);
        color: white;
    }

    .status-reserved {
        background: linear-gradient(135deg, #ffd43b 0%, #fcc419 100%);
        color: #2c3e50;
    }

    .status-out-of-service {
        background: linear-gradient(135deg, #868e96 0%, #495057 100%);
        color: white;
    }

    .btn-group .btn {
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        padding: 8px 16px;
        margin: 2px;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-warning {
        background: linear-gradient(135deg, #ffd43b 0%, #fcc419 100%);
        color: #2c3e50;
    }

    .btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 212, 59, 0.4);
    }

    .btn-danger {
        background: linear-gradient(135deg, #ff6b6b 0%, #fa5252 100%);
        color: white;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.4);
    }

    .dataTables_wrapper {
        padding: 0 10px;
    }

    .dataTables_length,
    .dataTables_filter {
        margin-bottom: 15px;
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
    }

    .dt-buttons .btn:hover {
        transform: translateY(-2px);
    }

    /* Room number styling */
    .room-number {
        font-family: 'Courier New', monospace;
        font-weight: 700;
        color: #667eea;
        background: #f8f9ff;
        padding: 4px 8px;
        border-radius: 6px;
        border: 1px solid #e3e7ff;
    }

    /* Action buttons container */
    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
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

    .room-info {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        margin: 20px 0;
        border-left: 4px solid #667eea;
    }

    .room-info strong {
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

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .room-card .card-header {
            padding: 15px 20px;
        }
        
        .card-tools .badge-primary {
            padding: 8px 16px;
            font-size: 0.8rem;
        }
        
        #roomlist thead th,
        #roomlist tbody td {
            padding: 10px 8px;
            font-size: 0.8rem;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 4px;
        }
        
        .btn-group .btn {
            padding: 6px 12px;
            font-size: 0.75rem;
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
    }

    /* Loading animation for table rows */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    #roomlist tbody tr {
        animation: fadeIn 0.5s ease forwards;
    }

    #roomlist tbody tr:nth-child(odd) {
        animation-delay: 0.1s;
    }

    #roomlist tbody tr:nth-child(even) {
        animation-delay: 0.2s;
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
            <p class="modal-message">Are you sure you want to delete this room? This action cannot be undone.</p>
            
            <div class="room-info">
                <strong>Room Details:</strong><br>
                <span id="modalRoomNumber"></span><br>
                <span id="modalRoomType"></span><br>
                <span id="modalRoomStatus"></span>
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

<div class="card room-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">
            <i class="fas fa-bed mr-2"></i>
            ROOM LIST
        </h3>
        <div class="card-tools">
            <a href="{{ route('room.create') }}" class="badge badge-primary">
                <i class="fas fa-plus mr-1"></i>
                Add New Room
            </a>
        </div>
    </div>
    
    <div class="card-body p-0">
        <div class="table-container">
            <table id="roomlist" class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Room Type</th>
                        <th width="20%">Number</th>
                        <th width="20%">Status</th>
                        <th width="30%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr>
                            <td>
                                <span class="text-muted">{{$loop->iteration}}</span>
                            </td>
                            <td>
                                <strong>{{ $data->type_id }}</strong>
                            </td>
                            <td>
                                <span class="room-number">{{ $data->number }}</span>
                            </td>
                            <td>
                                @if ($data->status == 'v')
                                    <span class="status-badge status-available">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Available
                                    </span>
                                @elseif ($data->status == 'o')
                                    <span class="status-badge status-occupied">
                                        <i class="fas fa-user mr-1"></i>
                                        Occupied
                                    </span>
                                @elseif ($data->status == 'r')
                                    <span class="status-badge status-reserved">
                                        <i class="fas fa-calendar-check mr-1"></i>
                                        Reserved
                                    </span>
                                @elseif ($data->status == 'os')
                                    <span class="status-badge status-out-of-service">
                                        <i class="fas fa-tools mr-1"></i>
                                        Out of Service
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('room.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit mr-1"></i>
                                        Edit
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm delete-btn" 
                                       data-room-id="{{ $data->id }}"
                                       data-room-number="{{ $data->number }}"
                                       data-room-type="{{ $data->type_id }}"
                                       data-room-status="{{ $data->status }}">
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
</div>

@section('js')
<script>
    $(function () {
        $("#roomlist").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "pageLength": 10,
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search rooms...",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ rooms",
                "infoEmpty": "No rooms available",
                "infoFiltered": "(filtered from _MAX_ total rooms)"
            },
            "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                   '<"row"<"col-sm-12"tr>>' +
                   '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>' +
                   '<"row"<"col-sm-12 col-md-6"B>>',
            "buttons": [
                {
                    extend: 'copy',
                    className: 'btn btn-light',
                    text: '<i class="fas fa-copy mr-1"></i> Copy'
                },
                {
                    extend: 'csv',
                    className: 'btn btn-light',
                    text: '<i class="fas fa-file-csv mr-1"></i> CSV'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-light',
                    text: '<i class="fas fa-file-excel mr-1"></i> Excel'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-light',
                    text: '<i class="fas fa-file-pdf mr-1"></i> PDF'
                },
                {
                    extend: 'print',
                    className: 'btn btn-light',
                    text: '<i class="fas fa-print mr-1"></i> Print'
                }
            ]
        });

        // Add custom styling to DataTable elements
        $('.dataTables_length select').addClass('form-control-sm');
        $('.dataTables_filter input').addClass('form-control-sm');

        // Custom Delete Modal Functionality
        const deleteModal = document.getElementById('deleteModal');
        const cancelBtn = document.getElementById('cancelDelete');
        const confirmBtn = document.getElementById('confirmDelete');
        const modalRoomNumber = document.getElementById('modalRoomNumber');
        const modalRoomType = document.getElementById('modalRoomType');
        const modalRoomStatus = document.getElementById('modalRoomStatus');

        let currentDeleteUrl = '';

        // Add click event to all delete buttons
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                
                const roomId = this.getAttribute('data-room-id');
                const roomNumber = this.getAttribute('data-room-number');
                const roomType = this.getAttribute('data-room-type');
                const roomStatus = this.getAttribute('data-room-status');
                
                // Set modal content
                modalRoomNumber.textContent = `Room Number: ${roomNumber}`;
                modalRoomType.textContent = `Room Type: ${roomType}`;
                
                // Set status text
                let statusText = '';
                switch(roomStatus) {
                    case 'v':
                        statusText = 'Status: Available';
                        break;
                    case 'o':
                        statusText = 'Status: Occupied';
                        break;
                    case 'r':
                        statusText = 'Status: Reserved';
                        break;
                    case 'os':
                        statusText = 'Status: Out of Service';
                        break;
                    default:
                        statusText = 'Status: Unknown';
                }
                modalRoomStatus.textContent = statusText;
                
                // Set delete URL
                currentDeleteUrl = "{{ route('room.delete', ':id') }}".replace(':id', roomId);
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