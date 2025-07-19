@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid px-4">
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="hero-card position-relative overflow-hidden rounded-4 shadow-lg">
                <div class="hero-bg"></div>
                <div class="hero-content position-relative z-2 p-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="welcome-text">
                                <h1 class="display-4 fw-bold text-white mb-3 animate-slide-up">
                                    Selamat Datang, Admin!
                                </h1>
                                <p class="lead text-white-50 mb-4 animate-slide-up" style="animation-delay: 0.2s;">
                                    Halo <strong class="text-warning">{{ auth()->user()->name }}</strong>, 
                                    mari kelola platform AksiHost dengan mudah dan efisien.
                                </p>
                                <div class="d-flex gap-3 animate-slide-up" style="animation-delay: 0.4s;">
                                    <span class="badge bg-success bg-opacity-20 text-success px-3 py-2 rounded-pill">
                                        <i class="fas fa-circle me-2" style="font-size: 8px;"></i>
                                        Sistem Online
                                    </span>
                                    <span class="badge bg-info bg-opacity-20 text-info px-3 py-2 rounded-pill">
                                        <i class="fas fa-clock me-2"></i>
                                        {{ date('d M Y, H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-end">
                            <div class="admin-avatar animate-float">
                                <div class="avatar-container">
                                    <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=4f46e5&color=fff&size=120&rounded=true" 
                                         alt="Admin Avatar" 
                                         class="rounded-circle shadow-lg">
                                    <div class="avatar-status"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hero-particles"></div>
            </div>
        </div>
    </div>

<style>

.hero-card {
    background: linear-gradient(135deg, #000000 0%, #00a6ff 100%);
    min-height: 300px;
    border: none;
}

.hero-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
    opacity: 0.3;
}

.hero-particles {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
    animation: particles 20s ease-in-out infinite;
}

@keyframes particles {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}


.admin-avatar {
    position: relative;
}

.avatar-container {
    position: relative;
    display: inline-block;
}

.avatar-status {
    position: absolute;
    bottom: 8px;
    right: 8px;
    width: 24px;
    height: 24px;
    background: #10b981;
    border: 3px solid white;
    border-radius: 50%;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

/* Animations */
.animate-slide-up {
    opacity: 0;
    transform: translateY(30px);
    animation: slideUp 0.8s ease-out forwards;
}

@keyframes slideUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Stat Cards */
.stat-card {
    position: relative;
    padding: 2rem;
    border-radius: 1rem;
    color: white;
    overflow: hidden;
    transition: all 0.3s ease;
    cursor: pointer;
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, transparent 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.stat-card:hover::before {
    opacity: 1;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.bg-gradient-primary {
    background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-success {
    background: linear-gradient(45deg, #10b981 0%, #059669 100%);
}

.bg-gradient-warning {
    background: linear-gradient(45deg, #f59e0b 0%, #d97706 100%);
}

.bg-gradient-info {
    background: linear-gradient(45deg, #3b82f6 0%, #1d4ed8 100%);
}

.stat-icon {
    position: absolute;
    top: 1rem;
    right: 1rem;
    font-size: 2rem;
    opacity: 0.3;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
    margin-bottom: 0.5rem;
}

.stat-trend {
    font-size: 0.8rem;
    opacity: 0.9;
}

/* Quick Actions */
.quick-action-btn {
    display: flex;
    align-items: center;
    padding: 1.5rem;
    background: white;
    border-radius: 0.75rem;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
}

.quick-action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    border-color: #e5e7eb;
    color: inherit;
    text-decoration: none;
}

.quick-action-icon {
    width: 50px;
    height: 50px;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    color: white;
    font-size: 1.25rem;
}

.quick-action-text h6 {
    margin: 0;
    font-weight: 600;
    color: #1f2937;
}

.quick-action-text small {
    color: #6b7280;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-content {
        padding: 2rem 1rem !important;
    }
    
    .display-4 {
        font-size: 2rem !important;
    }
    
    .stat-card {
        padding: 1.5rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
}
</style>
@endsection