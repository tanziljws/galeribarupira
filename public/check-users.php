<?php
/**
 * Script untuk mengecek dan membersihkan data users
 * Akses: http://127.0.0.1:8000/check-users.php
 */

// Load Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = \Illuminate\Http\Request::capture()
);

use Illuminate\Support\Facades\DB;

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Users Database</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }
        
        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .section {
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        
        .section h2 {
            color: #667eea;
            font-size: 18px;
            margin-bottom: 15px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        table th {
            background: #667eea;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 600;
        }
        
        table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        
        table tr:hover {
            background: #f0f0f0;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            margin-right: 10px;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .btn:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }
        
        .btn-danger {
            background: #e74c3c;
        }
        
        .btn-danger:hover {
            background: #c0392b;
        }
        
        .btn-warning {
            background: #f39c12;
        }
        
        .btn-warning:hover {
            background: #d68910;
        }
        
        .alert {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        
        .alert-warning {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border: 2px solid #667eea;
            text-align: center;
        }
        
        .stat-card h3 {
            color: #667eea;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        
        .stat-card .number {
            font-size: 32px;
            font-weight: bold;
            color: #333;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 600;
        }
        
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .empty-message {
            text-align: center;
            color: #999;
            padding: 20px;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Check Users Database</h1>
        
        <?php
        try {
            // Get all users
            $users = DB::table('users')->get();
            $userCount = count($users);
            
            // Get all OTPs
            $otps = DB::table('otps')->get();
            $otpCount = count($otps);
            
            // Get pending OTPs (not used)
            $pendingOtps = DB::table('otps')->where('used', false)->get();
            $pendingOtpCount = count($pendingOtps);
        ?>
        
        <div class="stats">
            <div class="stat-card">
                <h3>Total Users</h3>
                <div class="number"><?php echo $userCount; ?></div>
            </div>
            <div class="stat-card">
                <h3>Total OTPs</h3>
                <div class="number"><?php echo $otpCount; ?></div>
            </div>
            <div class="stat-card">
                <h3>Pending OTPs</h3>
                <div class="number"><?php echo $pendingOtpCount; ?></div>
            </div>
        </div>
        
        <!-- Users Section -->
        <div class="section">
            <h2>📋 Registered Users</h2>
            
            <?php if ($userCount > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Verified</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user->id; ?></td>
                            <td><?php echo htmlspecialchars($user->name); ?></td>
                            <td><?php echo htmlspecialchars($user->email); ?></td>
                            <td>
                                <?php 
                                if ($user->email_verified_at) {
                                    echo '<span style="color: green;">✓ Yes</span>';
                                } else {
                                    echo '<span style="color: red;">✗ No</span>';
                                }
                                ?>
                            </td>
                            <td><?php echo $user->created_at; ?></td>
                            <td>
                                <a href="?action=delete&id=<?php echo $user->id; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus user ini?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-message">Tidak ada user terdaftar</div>
            <?php endif; ?>
            
            <button class="btn btn-warning" onclick="if(confirm('Yakin ingin menghapus SEMUA users?')) window.location='?action=truncate_users'">Delete All Users</button>
        </div>
        
        <!-- OTPs Section -->
        <div class="section">
            <h2>🔐 OTP Codes</h2>
            
            <?php if ($otpCount > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Code</th>
                            <th>Used</th>
                            <th>Expires At</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($otps as $otp): ?>
                        <tr>
                            <td><?php echo $otp->id; ?></td>
                            <td><?php echo $otp->user_id; ?></td>
                            <td><code><?php echo htmlspecialchars($otp->code); ?></code></td>
                            <td>
                                <?php 
                                if ($otp->used) {
                                    echo '<span style="color: green;">✓ Yes</span>';
                                } else {
                                    echo '<span style="color: red;">✗ No</span>';
                                }
                                ?>
                            </td>
                            <td><?php echo $otp->expires_at; ?></td>
                            <td><?php echo $otp->created_at; ?></td>
                            <td>
                                <a href="?action=delete_otp&id=<?php echo $otp->id; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus OTP ini?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-message">Tidak ada OTP terdaftar</div>
            <?php endif; ?>
            
            <button class="btn btn-warning" onclick="if(confirm('Yakin ingin menghapus SEMUA OTPs?')) window.location='?action=truncate_otps'">Delete All OTPs</button>
        </div>
        
        <!-- Delete Email Section -->
        <div class="section">
            <h2>🗑️ Delete Specific Email</h2>
            <form method="GET">
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" placeholder="Enter email to delete" required>
                </div>
                <button type="submit" name="action" value="delete_email" class="btn btn-danger">Delete Email</button>
            </form>
        </div>
        
        <?php
        } catch (\Exception $e) {
            echo '<div class="alert alert-warning">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
        
        // Handle actions
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            
            try {
                if ($action === 'delete' && isset($_GET['id'])) {
                    DB::table('users')->where('id', $_GET['id'])->delete();
                    echo '<div class="alert alert-success">✓ User berhasil dihapus. <a href="?">Refresh</a></div>';
                }
                elseif ($action === 'delete_email' && isset($_GET['email'])) {
                    DB::table('users')->where('email', $_GET['email'])->delete();
                    echo '<div class="alert alert-success">✓ Email berhasil dihapus. <a href="?">Refresh</a></div>';
                }
                elseif ($action === 'delete_otp' && isset($_GET['id'])) {
                    DB::table('otps')->where('id', $_GET['id'])->delete();
                    echo '<div class="alert alert-success">✓ OTP berhasil dihapus. <a href="?">Refresh</a></div>';
                }
                elseif ($action === 'truncate_users') {
                    DB::table('users')->truncate();
                    echo '<div class="alert alert-success">✓ Semua users berhasil dihapus. <a href="?">Refresh</a></div>';
                }
                elseif ($action === 'truncate_otps') {
                    DB::table('otps')->truncate();
                    echo '<div class="alert alert-success">✓ Semua OTPs berhasil dihapus. <a href="?">Refresh</a></div>';
                }
            } catch (\Exception $e) {
                echo '<div class="alert alert-warning">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
            }
        }
        ?>
    </div>
</body>
</html>
