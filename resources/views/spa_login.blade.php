<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PixzarLoop</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-hover: #4f46e5;
            --bg-dark: #0f172a;
            --bg-card: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --error: #ef4444;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Ambient Background Effect */
        body::before {
            content: '';
            position: absolute;
            width: 150vw;
            height: 150vw;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, rgba(15, 23, 42, 0) 60%);
            top: -50%;
            left: -50%;
            z-index: 0;
            animation: pulse 10s ease-in-out infinite alternate;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.8; }
            100% { transform: scale(1.1); opacity: 1; }
        }

        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 400px;
            padding: 2rem;
        }

        .card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px -12px rgba(99, 102, 241, 0.25);
            border-color: rgba(99, 102, 241, 0.3);
        }

        .logo-area {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-area h1 {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            letter-spacing: -0.5px;
            margin-bottom: 0.5rem;
        }

        .logo-area p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: var(--text-muted);
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
            margin-left: 0.25rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            width: 100%;
            background: rgba(15, 23, 42, 0.6);
            border: 2px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 0.875rem 1rem;
            color: white;
            font-size: 1rem;
            transition: all 0.2s ease;
            outline: none;
        }

        .input-wrapper input:focus {
            border-color: var(--primary);
            background: rgba(15, 23, 42, 0.8);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .btn-primary {
            width: 100%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-hover) 100%);
            border: none;
            border-radius: 12px;
            padding: 1rem;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 1rem;
            position: relative;
            overflow: hidden;
        }

        .btn-primary::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.4);
        }

        .btn-primary:hover::after {
            left: 100%;
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            padding: 0.75rem;
            border-radius: 8px;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            display: none;
            align-items: center;
            gap: 0.5rem;
        }

        /* Dashboard Styles (Hidden by default) */
        #dashboard-view {
            display: none;
            width: 100%;
            max-width: 800px;
            z-index: 10;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .user-welcome h2 {
            font-size: 2rem;
            margin-bottom: 0.25rem;
        }

        .token-card {
            background: rgba(30, 41, 59, 0.7);
            padding: 1.5rem;
            border-radius: 16px;
            margin-top: 2rem;
            word-break: break-all;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .token-label {
            color: var(--text-muted);
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .token-value {
            font-family: monospace;
            color: var(--primary);
            background: rgba(0,0,0,0.3);
            padding: 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .btn-secondary {
            background: rgba(255,255,255,0.1);
            color: white;
            border: 1px solid rgba(255,255,255,0.2);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .btn-secondary:hover {
            background: rgba(255,255,255,0.2);
        }

        .spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px;
            display: none;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

    </style>
</head>
<body>

    <!-- Login View -->
    <div class="login-container" id="login-view">
        <div class="card">
            <div class="logo-area">
                <h1>PixzarLoop</h1>
                <p>Sign in to access your dashboard</p>
            </div>

            <div id="error-box" class="error-message">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span id="error-text"></span>
            </div>

            <form id="login-form">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" required placeholder="name@example.com" value="test@example.com">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" required placeholder="Enter your password" value="password">
                    </div>
                </div>

                <button type="submit" class="btn-primary" id="submit-btn">
                    <div class="spinner" id="spinner"></div>
                    <span id="btn-text">Sign In</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Dashboard View (SPA Style) -->
    <div id="dashboard-view">
        <div class="dashboard-header">
            <div class="user-welcome">
                <h2>Welcome back, <span id="user-name">User</span>!</h2>
                <p style="color: var(--text-muted)">You are successfully logged in via API.</p>
            </div>
            <button class="btn-secondary" onclick="logout()">Sign Out</button>
        </div>

        <div class="row" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
            <div class="card" style="padding: 2rem;">
                <h3 style="margin-bottom: 1rem; color: var(--primary);">User Profile</h3>
                <p style="margin-bottom: 0.5rem;"><strong style="color: var(--text-muted);">ID:</strong> <span id="profile-id"></span></p>
                <p style="margin-bottom: 0.5rem;"><strong style="color: var(--text-muted);">Email:</strong> <span id="profile-email"></span></p>
                
                <hr style="border-color: rgba(255,255,255,0.1); margin: 1rem 0;">
                
                <p style="margin-bottom: 0.5rem;"><strong style="color: var(--text-muted);">Roles:</strong></p>
                <div id="user-roles" style="margin-bottom: 1rem;">
                    <!-- Roles will be inserted here -->
                </div>

                <p style="margin-bottom: 0.5rem;"><strong style="color: var(--text-muted);">Permissions:</strong></p>
                <div id="user-perms">
                    <!-- Permissions will be inserted here -->
                </div>
            </div>

            <div class="card" style="padding: 2rem;">
                <h3 style="margin-bottom: 1rem; color: #10b981;">API Status</h3>
                <p style="color: var(--text-muted); margin-bottom: 1rem;">Connection established securely via Sanctum Token.</p>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 10px; height: 10px; background: #10b981; border-radius: 50%; box-shadow: 0 0 10px #10b981;"></div>
                    <span>Active Session</span>
                </div>
            </div>
        </div>

        <div class="token-card">
            <label class="token-label">YOUR ACCESS TOKEN (Stored in LocalStorage)</label>
            <div class="token-value" id="access-token-display"></div>
        </div>
    </div>

    <script>
        const loginForm = document.getElementById('login-form');
        const loginView = document.getElementById('login-view');
        const dashboardView = document.getElementById('dashboard-view');
        const errorBox = document.getElementById('error-box');
        const errorText = document.getElementById('error-text');
        const submitBtn = document.getElementById('submit-btn');
        const spinner = document.getElementById('spinner');
        const btnText = document.getElementById('btn-text');

        // Check if already logged in
        const token = localStorage.getItem('api_token');
        if (token) {
            showDashboard(JSON.parse(localStorage.getItem('user_data') || '{}'), JSON.parse(localStorage.getItem('user_roles_data') || '{}'), token);
        }

        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            setLoading(true);
            hideError();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            try {
                const response = await fetch('/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ email, password })
                });

                const data = await response.json();

                if (response.ok) {
                    // Success
                    localStorage.setItem('api_token', data.access_token);
                    localStorage.setItem('user_data', JSON.stringify(data.user));
                    localStorage.setItem('user_roles_data', JSON.stringify({ roles: data.roles, permissions: data.permissions }));
                    showDashboard(data.user, { roles: data.roles, permissions: data.permissions }, data.access_token);
                } else {
                    // Error
                    showError(data.message || 'Login failed. Please check your credentials.');
                }
            } catch (err) {
                showError('Network error. Is the server running?');
                console.error(err);
            } finally {
                setLoading(false);
            }
        });

        function showDashboard(user, roleData, token) {
            loginView.style.display = 'none';
            dashboardView.style.display = 'block';
            
            // Populate Data
            document.getElementById('user-name').textContent = user.name || 'User';
            document.getElementById('profile-id').textContent = user.id || '-';
            document.getElementById('profile-email').textContent = user.email || '-';
            
            // Display Roles
            const rolesHtml = (roleData.roles || []).map(r => 
                `<span style="background: rgba(99, 102, 241, 0.2); color: #818cf8; padding: 2px 8px; border-radius: 4px; font-size: 0.8rem; margin-right: 5px;">${r}</span>`
            ).join('') || '<span style="color: var(--text-muted); font-size: 0.8rem;">No roles assigned</span>';
            document.getElementById('user-roles').innerHTML = rolesHtml;

            // Display Permissions
            const permsHtml = (roleData.permissions || []).map(p => 
                `<span style="background: rgba(16, 185, 129, 0.2); color: #34d399; padding: 2px 8px; border-radius: 4px; font-size: 0.8rem; margin-right: 5px; margin-bottom: 5px; display: inline-block;">${p}</span>`
            ).join('') || '<span style="color: var(--text-muted); font-size: 0.8rem;">No permissions assigned</span>';
            document.getElementById('user-perms').innerHTML = permsHtml;

            document.getElementById('access-token-display').textContent = token;
        }

        function logout() {
            // Optional: Call logout API to revoke token
            const token = localStorage.getItem('api_token');
            if(token) {
                 fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json'
                    }
                });
            }

            localStorage.removeItem('api_token');
            localStorage.removeItem('user_data');
            localStorage.removeItem('user_roles_data');
            
            // Reset View
            dashboardView.style.display = 'none';
            loginView.style.display = 'block';
            document.getElementById('password').value = '';
        }

        function setLoading(isLoading) {
            submitBtn.disabled = isLoading;
            if (isLoading) {
                spinner.style.display = 'inline-block';
                btnText.textContent = 'Authenticating...';
                submitBtn.style.opacity = '0.7';
            } else {
                spinner.style.display = 'none';
                btnText.textContent = 'Sign In';
                submitBtn.style.opacity = '1';
            }
        }

        function showError(msg) {
            errorBox.style.display = 'flex';
            errorText.textContent = msg;
            // Shake animation
            document.querySelector('.card').animate([
                { transform: 'translateX(0)' },
                { transform: 'translateX(-10px)' },
                { transform: 'translateX(10px)' },
                { transform: 'translateX(0)' }
            ], {
                duration: 400,
                easing: 'ease-in-out'
            });
        }

        function hideError() {
            errorBox.style.display = 'none';
        }
    </script>
</body>
</html>
