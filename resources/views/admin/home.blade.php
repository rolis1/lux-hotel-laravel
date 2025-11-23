@extends('layouts.adminlte')
@section('content')

<style>
    /* Custom Dashboard Styles */
    .dashboard-welcome {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 15px;
        padding: 40px 30px;
        margin-bottom: 30px;
        color: white;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }

    .dashboard-welcome::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        transform: rotate(30deg);
    }

    .welcome-icon {
        font-size: 4rem;
        margin-bottom: 20px;
        display: block;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin: 30px 0;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        border-left: 4px solid;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .stat-card.occupied {
        border-left-color: #ff6b6b;
    }

    .stat-card.available {
        border-left-color: #51cf66;
    }

    .stat-card.checkins {
        border-left-color: #ffd43b;
    }

    .stat-card.pending {
        border-left-color: #cc5de8;
    }

    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
        opacity: 0.8;
    }

    .stat-number {
        font-size: 2.2rem;
        font-weight: 700;
        margin: 10px 0;
        color: #2c3e50;
    }

    .stat-text {
        color: #6c757d;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .activity-timeline {
        position: relative;
        padding-left: 30px;
    }

    .activity-timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, #667eea, #764ba2);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 25px;
        padding: 20px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        border-left: 3px solid;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -33px;
        top: 25px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 0 0 3px;
    }

    .timeline-item.success::before {
        box-shadow: 0 0 0 3px #51cf66;
        background: #51cf66;
    }

    .timeline-item.warning::before {
        box-shadow: 0 0 0 3px #ffd43b;
        background: #ffd43b;
    }

    .timeline-item.booking {
        border-left-color: #339af0;
    }

    .timeline-item.checkout {
        border-left-color: #ff6b6b;
    }

    .timeline-item.maintenance {
        border-left-color: #ffd43b;
    }

    .timeline-item.staff {
        border-left-color: #cc5de8;
    }

    .action-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        padding: 25px 15px;
        color: white;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }

    .action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .action-btn:hover::before {
        left: 100%;
    }

    .action-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
        display: block;
    }

    .alert-custom {
        border-radius: 12px;
        border: none;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        background: linear-gradient(135deg, #51cf66 0%, #40c057 100%);
        color: white;
        border-left: 5px solid #2b8a3e;
    }

    .section-title {
        color: #2c3e50;
        font-weight: 700;
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 10px;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 2px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .dashboard-welcome {
            padding: 30px 20px;
        }

        .welcome-icon {
            font-size: 3rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .action-btn {
            padding: 20px 10px;
        }
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Welcome Section -->
            <div class="dashboard-welcome">
                <i class="fas fa-user-shield welcome-icon"></i>
                <h2 class="mb-3">{{ __('Welcome Back, Administrator!') }}</h2>
                <p class="lead mb-4">{{ __('You are successfully logged in to the Lux Hotel Management System') }}</p>

                @if (session('status'))
                <div class="alert alert-custom alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('status') }}
                    <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">

                <div class="stat-card occupied" style="background: #ffe3e3; padding: 20px; border-radius: 10px; text-align: center;">
                    <i class="fas fa-bed stat-icon" style="color: #ff6b6b; font-size: 24px;"></i>
                    <div class="stat-number" style="font-size: 28px; font-weight: bold;">{{ $occupied }}</div>
                    <div class="stat-text">Occupied Rooms</div>
                </div>

                <div class="stat-card available" style="background: #d3f9d8; padding: 20px; border-radius: 10px; text-align: center;">
                    <i class="fas fa-door-open stat-icon" style="color: #51cf66; font-size: 24px;"></i>
                    <div class="stat-number" style="font-size: 28px; font-weight: bold;">{{ $reserved }}</div>
                    <div class="stat-text">Reserved Rooms</div>
                </div>

                <div class="stat-card checkins" style="background: #fff3bf; padding: 20px; border-radius: 10px; text-align: center;">
                    <i class="fas fa-user-check stat-icon" style="color: #ffd43b; font-size: 24px;"></i>
                    <div class="stat-number" style="font-size: 28px; font-weight: bold;">{{ $os }}</div>
                    <div class="stat-text">Out of Service</div>
                </div>

                <div class="stat-card pending" style="background: #e5dbff; padding: 20px; border-radius: 10px; text-align: center;">
                    <i class="fas fa-user-clock stat-icon" style="color: #cc5de8; font-size: 24px;"></i>
                    <div class="stat-number" style="font-size: 28px; font-weight: bold;">{{ $available }}</div>
                    <div class="stat-text">Available Rooms</div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="row mt-4">
                @foreach ($activities as $activity)
                <div class="timeline-item {{ $activity->type }}">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <i class="fas fa-check-circle text-success mr-2"></i>
                            <strong>{{ $activity->title }}</strong>
                            <p class="mb-0 text-muted">{{ $activity->description }}</p>
                        </div>
                        <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                    </div>

                </div>
                @endforeach

                <!-- Quick Actions -->
                <div class="col-lg-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0">
                            <h4 class="section-title mb-0">Actions</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <button onclick="window.location='{{ route('room.create') }}'" class="btn action-btn w-100 h-100">
                                        <i class="fas fa-plus action-icon"></i>
                                        <br>
                                        <strong>Add New Room</strong>
                                    </button>
                                </div>
                                <div class="col-6 mb-3">
                                    <button onclick="window.location='{{ route('room.index') }}'" class="btn action-btn w-100 h-100">
                                        <i class="fas fa-bed action-icon"></i>
                                        <br>
                                        <strong>Manage Rooms</strong>
                                    </button>
                                </div>
                                <div class="col-6 mb-3">
                                    <a href="{{ route('admin.clearlogs') }}"
                                        class="btn btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus semua riwayat activity?')">
                                        Hapus Semua Riwayat
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Add some interactive animations
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stat cards on scroll
        const statCards = document.querySelectorAll('.stat-card');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        });

        statCards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });

        // Add click effects to action buttons
        const actionButtons = document.querySelectorAll('.action-btn');
        actionButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });
    });
</script>
@endsection