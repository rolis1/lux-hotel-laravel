@extends('layouts.adminlte')
@section('content')

<style>
    /* Custom Room Type List Styles */
    .roomtype-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        overflow: hidden;
        background: #fff;
    }

    .roomtype-card .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-bottom: none;
        padding: 25px 30px;
        position: relative;
        overflow: hidden;
    }

    .roomtype-card .card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        transform: rotate(30deg);
    }

    .roomtype-card .card-header h3 {
        color: white;
        font-weight: 700;
        margin: 0;
        font-size: 1.6rem;
        position: relative;
        z-index: 1;
    }

    .roomtype-card .card-header h3 i {
        margin-right: 12px;
        opacity: 0.9;
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

    .table-container {
        border-radius: 10px;
        overflow: hidden;
        margin: 0;
    }

    #facilityList {
        margin: 0;
        border: none;
        width: 100% !important;
    }

    #facilityList thead th {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-bottom: 3px solid #667eea;
        color: #2c3e50;
        font-weight: 700;
        padding: 18px 15px;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    #facilityList tbody td {
        padding: 20px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f4;
        transition: all 0.3s ease;
    }

    #facilityList tbody tr {
        transition: all 0.3s ease;
    }

    #facilityList tbody tr:hover {
        background-color: #f8f9ff;
        transform: translateX(5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .room-image {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .room-image:hover {
        transform: scale(1.8);
        border-color: #667eea;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        z-index: 1000;
        position: relative;
    }

    .room-name {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1rem;
    }

    .room-info {
        color: #6c757d;
        font-size: 0.85rem;
        line-height: 1.4;
        max-width: 200px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .room-price {
        font-weight: 700;
        color: #51cf66;
        font-size: 1.1rem;
    }

    .room-facilities {
        color: #495057;
        font-size: 0.85rem;
        line-height: 1.4;
        max-width: 200px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
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
        margin-bottom: 20px;
    }

    .dataTables_length select,
    .dataTables_filter input {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        padding: 10px 15px;
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

    /* Serial number styling */
    .serial-number {
        font-weight: 600;
        color: #667eea;
        background: #f8f9ff;
        padding: 8px 12px;
        border-radius: 6px;
        text-align: center;
        display: inline-block;
        min-width: 40px;
    }

    /* Action buttons container */
    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        justify-content: center;
    }

    /* Status badges for future use */
    .status-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-active {
        background: linear-gradient(135deg, #51cf66 0%, #40c057 100%);
        color: white;
    }

    .status-inactive {
        background: linear-gradient(135deg, #868e96 0%, #495057 100%);
        color: white;
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
        max-width: 450px;
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

    .roomtype-info {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        margin: 20px 0;
        border-left: 4px solid #667eea;
    }

    .roomtype-info strong {
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
        .roomtype-card .card-header {
            padding: 20px;
        }
        
        .card-tools .badge-primary {
            padding: 10px 20px;
            font-size: 0.8rem;
        }
        
        #facilityList thead th,
        #facilityList tbody td {
            padding: 12px 8px;
            font-size: 0.8rem;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 5px;
        }
        
        .btn-group .btn {
            padding: 8px 12px;
            font-size: 0.75rem;
            min-width: 60px;
        }
        
        .room-image {
            width: 60px;
            height: 45px;
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

    #facilityList tbody tr {
        animation: fadeInUp 0.5s ease forwards;
    }

    #facilityList tbody tr:nth-child(odd) {
        animation-delay: 0.1s;
    }

    #facilityList tbody tr:nth-child(even) {
        animation-delay: 0.2s;
    }

    /* Empty state styling */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 15px;
        color: #dee2e6;
    }

    /* Table header icons */
    .table-header-icon {
        margin-right: 8px;
        opacity: 0.7;
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
            <p class="modal-message">Are you sure you want to delete this room type? This action cannot be undone.</p>
            
            <div class="roomtype-info">
                <strong>Room Type Details:</strong><br>
                <span id="modalRoomTypeName"></span><br>
                <span id="modalRoomTypePrice"></span><br>
                <span id="modalRoomTypeFacilities"></span>
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

<div class="card roomtype-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">
            <i class="fas fa-list-alt"></i>
            ROOM TYPE LIST
        </h3>
        <div class="card-tools">
            <a href="{{ route('roomtype.create') }}" class="badge badge-primary">
                <i class="fas fa-plus mr-1"></i>
                Add New Type
            </a>
        </div>
    </div>
    
    <div class="card-body p-0">
        <div class="table-container">
            <table id="facilityList" class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%">
                            <i class="fas fa-hashtag table-header-icon"></i>
                            No
                        </th>
                        <th width="15%">
                            <i class="fas fa-tag table-header-icon"></i>
                            Name
                        </th>
                        <th width="20%">
                            <i class="fas fa-info-circle table-header-icon"></i>
                            Information
                        </th>
                        <th width="10%">
                            <i class="fas fa-image table-header-icon"></i>
                            Photo
                        </th>
                        <th width="15%">
                            <i class="fas fa-tag table-header-icon"></i>
                            Price
                        </th>
                        <th width="20%">
                            <i class="fas fa-concierge-bell table-header-icon"></i>
                            Facilities
                        </th>
                        <th width="15%">
                            <i class="fas fa-cogs table-header-icon"></i>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datas as $dt)
                        <tr>
                            <td>
                                <span class="serial-number">{{ $loop->iteration }}</span>
                            </td>
                            <td>
                                <div class="room-name">{{ $dt->name }}</div>
                            </td>
                            <td>
                                <div class="room-info">{{ $dt->information }}</div>
                            </td>
                            <td>
                                @if($dt->foto)
                                    <img src="{{ asset('images/tipekamar/'.$dt->foto) }}" class="room-image" alt="{{ $dt->name }}">
                                @else
                                    <div class="text-muted">No Image</div>
                                @endif
                            </td>
                            <td>
                                <div class="room-price">Rp{{ number_format($dt->price, 2) }}</div>
                            </td>
                            <td>
                                <div class="room-facilities">{{ $dt->facilities }}</div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('roomtype.edit', $dt->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit mr-1"></i>
                                        Edit
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm delete-btn" 
                                       data-roomtype-id="{{ $dt->id }}"
                                       data-roomtype-name="{{ $dt->name }}"
                                       data-roomtype-price="{{ $dt->price }}"
                                       data-roomtype-facilities="{{ $dt->facilities }}">
                                        <i class="fas fa-trash mr-1"></i>
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <h4>No Room Types Found</h4>
                                    <p>Get started by adding your first room type.</p>
                                    <a href="{{ route('roomtype.create') }}" class="btn btn-primary mt-2">
                                        <i class="fas fa-plus mr-1"></i>
                                        Add Room Type
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('js')
<script>
    $(function () {
        $("#facilityList").DataTable({
            "responsive": true,
            "paging": false,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search room types...",
                "info": "Showing _TOTAL_ room types",
                "infoEmpty": "No room types available",
                "infoFiltered": "(filtered from _MAX_ total room types)"
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
        const modalRoomTypeName = document.getElementById('modalRoomTypeName');
        const modalRoomTypePrice = document.getElementById('modalRoomTypePrice');
        const modalRoomTypeFacilities = document.getElementById('modalRoomTypeFacilities');

        let currentDeleteUrl = '';

        // Add click event to all delete buttons
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                
                const roomtypeId = this.getAttribute('data-roomtype-id');
                const roomtypeName = this.getAttribute('data-roomtype-name');
                const roomtypePrice = this.getAttribute('data-roomtype-price');
                const roomtypeFacilities = this.getAttribute('data-roomtype-facilities');
                
                // Set modal content
                modalRoomTypeName.textContent = `Name: ${roomtypeName}`;
                modalRoomTypePrice.textContent = `Price: Rp${parseFloat(roomtypePrice).toLocaleString('id-ID', {minimumFractionDigits: 2})}`;
                modalRoomTypeFacilities.textContent = `Facilities: ${roomtypeFacilities.substring(0, 50)}${roomtypeFacilities.length > 50 ? '...' : ''}`;
                
                // Set delete URL
                currentDeleteUrl = "{{ route('roomtype.delete', ':id') }}".replace(':id', roomtypeId);
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