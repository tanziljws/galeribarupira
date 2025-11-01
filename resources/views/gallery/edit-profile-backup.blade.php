<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar styling - sama seperti galeri */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 80px;
            border-bottom: 1px solid rgba(37, 99, 235, 0.1);
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }

        .navbar .container-fluid {
            max-width: 1400px;
            margin: 0 auto;
            padding-left: 3rem;
            padding-right: 3rem;
        }

        .navbar-brand {
            color: #1E40AF !important;
            font-weight: 700;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-right: 4rem;
        }

        .navbar-brand:hover {
            color: #1e3a8a !important;
            transform: scale(1.05);
        }

        .navbar-brand span {
            color: #1E40AF !important;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .navbar-brand img {
            height: 34px;
            width: 34px;
        }

        .navbar-nav {
            margin-left: auto !important;
            margin-right: 0 !important;
        }

        .navbar-nav .nav-link {
            color: #374151 !important;
            font-weight: 400;
            padding: 0.5rem 0.75rem;
            margin: 0 0.25rem;
            border-radius: 6px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            font-size: 0.95rem;
        }

        .navbar-nav .nav-link:hover {
            color: #1E40AF !important;
            background: transparent;
        }

        .navbar-nav .nav-link.active {
            color: #1E40AF !important;
            background: transparent;
            font-weight: 500;
        }

        .navbar-nav .nav-link i {
            color: #374151 !important;
            font-size: 0.95rem;
            margin-right: 0.4rem;
        }

        .navbar-nav .nav-link:hover i {
            color: #1E40AF !important;
        }

        .navbar-nav .nav-link.active i {
            color: #1E40AF !important;
        }

        .main-content {
            margin-top: 80px;
            padding: 2rem 0;
            min-height: calc(100vh - 80px);
        }

        .edit-profile-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .page-header {
            background: linear-gradient(135deg, #1E40AF 0%, #2563eb 100%);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            color: white;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(30, 64, 175, 0.2);
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            opacity: 0.3;
        }

        .page-header h1 {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .page-header p {
            opacity: 0.9;
            margin: 0;
            font-size: 1.05rem;
            position: relative;
            z-index: 1;
        }

        .edit-form-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
        }

        .profile-photo-section {
            text-align: center;
            margin-bottom: 2.5rem;
            padding-bottom: 2.5rem;
            border-bottom: 2px solid #e5e7eb;
            position: relative;
        }

        .profile-photo-section h5 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 1.5rem;
        }

        .current-photo {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #e5e7eb;
            margin: 0 auto 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: #1E40AF;
            font-weight: 700;
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .current-photo:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
        }

        .photo-upload-btn {
            position: relative;
            display: inline-block;
        }

        .photo-upload-btn input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .photo-upload-btn label {
            background: linear-gradient(135deg, #1E40AF 0%, #2563eb 100%);
            color: white;
            padding: 0.875rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .photo-upload-btn:hover label {
            background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 64, 175, 0.4);
        }

        .photo-preview {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #6b7280;
            font-weight: 500;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .form-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #e5e7eb;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-section-title i {
            color: #1E40AF;
            font-size: 1.2rem;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-control, .form-select {
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 0.875rem 1.25rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #1E40AF;
            box-shadow: 0 0 0 4px rgba(30, 64, 175, 0.1);
            outline: none;
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .btn-save {
            background: linear-gradient(135deg, #1E40AF 0%, #2563eb 100%);
            color: white;
            border: none;
            padding: 1rem 3rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(30, 64, 175, 0.4);
            background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
        }

        .btn-cancel {
            background: white;
            color: #6b7280;
            border: 2px solid #e5e7eb;
            padding: 1rem 3rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-cancel:hover {
            background: #f3f4f6;
            color: #374151;
            border-color: #d1d5db;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2.5rem;
            padding-top: 2.5rem;
            border-top: 2px solid #e5e7eb;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.5rem;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .password-section {
            background: #f9fafb;
            padding: 2rem;
            border-radius: 12px;
            border: 2px dashed #e5e7eb;
        }

        @media (max-width: 768px) {
            .navbar .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .edit-form-card {
                padding: 2rem 1.5rem;
            }

            .page-header {
                padding: 2rem 1.5rem;
            }

            .page-header h1 {
                font-size: 1.75rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-save, .btn-cancel {
                width: 100%;
            }

            .current-photo {
                width: 140px;
                height: 140px;
                font-size: 3.5rem;
            }
        }
    </style>
</head>
<body>
    @include('gallery.partials.navbar')

    <div class="main-content">
        <div class="container">
            <div class="edit-profile-container">
                <div class="page-header">
                    <h1><i class="bi bi-pencil-square me-2"></i>Edit Profile</h1>
                    <p>Update your profile information and photo</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="edit-form-card">
                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" id="editProfileForm">
                        @csrf
                        @method('PUT')

                        <!-- Profile Photo Section -->
                        <div class="profile-photo-section">
                            <h5><i class="bi bi-camera-fill me-2"></i>Profile Photo</h5>
                            @if(isset($user->profile_photo) && !empty($user->profile_photo))
                                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="current-photo" id="photoPreview">
                            @else
                                <div class="current-photo" id="photoPreview">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                            
                            <div class="photo-upload-btn">
                                <input type="file" name="profile_photo" id="profilePhotoInput" accept="image/*">
                                <label for="profilePhotoInput">
                                    <i class="bi bi-upload me-2"></i>Change Photo
                                </label>
                            </div>
                            <div class="photo-preview" id="photoPreviewText"></div>
                        </div>

                        <!-- Basic Information Section -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="bi bi-person-fill"></i>
                                <span>Basic Information</span>
                            </div>
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required placeholder="Enter your full name">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="your.email@example.com">
                            </div>

                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" id="bio" name="bio" rows="4" placeholder="Tell us about yourself...">{{ old('bio', $user->bio ?? '') }}</textarea>
                                <small class="text-muted">Write a short bio to introduce yourself</small>
                            </div>
                        </div>

                        <!-- Password Change Section -->
                        <div class="form-section">
                            <div class="form-section-title">
                                <i class="bi bi-shield-lock-fill"></i>
                                <span>Change Password</span>
                            </div>
                            
                            <div class="password-section">
                                <p class="text-muted mb-3" style="font-size: 0.9rem;">
                                    <i class="bi bi-info-circle me-1"></i>Leave these fields blank if you don't want to change your password
                                </p>
                                
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter your current password">
                                </div>

                                <div class="mb-3">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password">
                                </div>

                                <div class="mb-0">
                                    <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Confirm new password">
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn-save">
                                <i class="bi bi-check-circle me-2"></i>Save Changes
                            </button>
                            <a href="{{ route('user.profile.show', $user->id) }}" class="btn-cancel">
                                <i class="bi bi-x-circle me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview photo before upload
        document.getElementById('profilePhotoInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('photoPreview');
                    preview.innerHTML = '';
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'current-photo';
                    preview.parentNode.replaceChild(img, preview);
                    img.id = 'photoPreview';
                };
                reader.readAsDataURL(file);
                document.getElementById('photoPreviewText').textContent = 'Selected: ' + file.name;
            }
        });
    </script>
</body>
</html>
