<?php
include 'koneksi.php';

// Menangkap filter jika ada dari URL
$filter_program = isset($_GET['program_id']) ? $_GET['program_id'] : '';
$filter_user = isset($_GET['user_id']) ? $_GET['user_id'] : '';

// Query dasar
$sql = "SELECT tasks.*, programs.nama_program, users.nama AS penanggung_jawab 
        FROM tasks 
        JOIN programs ON tasks.program_id = programs.program_id
        JOIN users ON tasks.assigned_to = users.user_id";

// Logika Filter Dinamis
$conditions = [];
if ($filter_program != '') {
    $conditions[] = "tasks.program_id = '$filter_program'";
}
if ($filter_user != '') {
    $conditions[] = "tasks.assigned_to = '$filter_user'";
}

if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(' AND ', $conditions);
}

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Kesalahan Query pada index.php: " . mysqli_error($conn));
}

// Ambil statistik ringkas untuk dashboard
$total_staff = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as jml FROM users"))['jml'];
$total_prog = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as jml FROM programs"))['jml'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PMS UAS - Dashboard Utama</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .php-alert {
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .dashboard-cards {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }
        .card {
            flex: 1;
            padding: 20px;
            border-radius: 8px;
            color: white;
            text-decoration: none;
            transition: transform 0.2s;
        }
        .card:hover { transform: scale(1.02); }
        .bg-blue { background-color: #3498db; }
        .bg-purple { background-color: #8e44ad; }
        .btn-filter {
            background-color: #34495e;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Navigasi Action Bar */
        .nav-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap; /* Tombol akan turun jika tidak muat */
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }

        /* Form Filter */
        .nav-actions form {
            display: flex;
            gap: 10px;
            margin-left: auto;
            width: 100%; /* Default lebar penuh di HP */
        }

        .nav-actions select {
            padding: 8px;
            border-radius: 5px;
            flex: 1; /* Dropdown membagi rata ruang yang ada */
            min-width: 120px;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            margin-top: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .styled-table {
            width: 100%;
            min-width: 450px; /* Menjaga agar kolom tidak terlalu berhimpitan */
            border-collapse: collapse;
            font-size: 13px; /* Ukuran font lebih kecil untuk mobile */
        }

        .styled-table th, .styled-table td {
            padding: 10px 8px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        @media screen and (max-width: 600px) {
        h2 { font-size: 1.2rem; }
        .styled-table td { font-size: 12px; }
        }

        /* Media Query Khusus Layar Kecil (HP Poco) */
        @media screen and (max-width: 600px) {
            .dashboard-cards {
                flex-direction: column; /* Kartu statistik jadi tumpuk atas-bawah */
            }

            .nav-actions {
                flex-direction: column; /* Tombol tambah jadi tumpuk */
                align-items: stretch;
            }

            .nav-actions form {
                flex-direction: column; /* Dropdown "Semua Program" & "Staff" jadi tumpuk */
                margin-left: 0;
            }

            .nav-actions select, .btn-filter {
                width: 100%; /* Lebar penuh di layar kecil */
            }
            .filter-form {
                display: flex; 
                gap: 10px; 
                margin-left: auto;
                width: auto;}

            .filter-buttons {
                display: flex;
                gap: 5px;
            }

            .btn-reset {
                text-decoration:none; 
                color:#666; 
                font-size:12px; 
                align-self:center; 
                margin-left:5px;
            }

        @media screen and (max-width: 600px) {
            .filter-form {
                flex-direction: column;
                width: 100%;
                margin-left: 0;
            }
            .btn-group {
                display: flex;
                flex-direction: column;
                width: 100%;
                gap: 5px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="container">
    <header>
        <h1>Program Management System</h1>
        <p>Project UAS - Teknik Informatika</p>
        
        <?php if (isset($_GET['status'])): ?>
            <div class="php-alert">
                <span>
                    <?php 
                        if($_GET['status'] == 'staff_success') echo "✅ Berhasil! Staff baru telah didaftarkan.";
                        elseif($_GET['status'] == 'success') echo "✅ Berhasil! Data telah tersimpan.";
                        elseif($_GET['status'] == 'deleted') echo "🗑️ Data telah berhasil dihapus.";
                    ?>
                </span>
                <a href="index.php" style="text-decoration:none; color:inherit; font-weight:bold; font-size: 20px;">&times;</a>
            </div>
        <?php endif; ?>

        <div class="dashboard-cards">
            <a href="data_program.php" class="card bg-blue">
                <h3>📂 <?php echo $total_prog; ?> Program</h3>
                <small>Klik untuk kelola program</small>
            </a>
            <a href="data_staf.php" class="card bg-purple">
                <h3>👥 <?php echo $total_staff; ?> Staff</h3>
                <small>Klik untuk kelola & hapus staff</small>
            </a>
        </div>

        <div class="nav-actions">
            <div class="btn-group">
                <a href="tambah_program.php" class="btn-add" style="background-color: #27ae60;">+ Program</a>
                <a href="tambah_tugas.php" class="btn-add">+ Tugas</a>
                <a href="tambah_staff.php" class="btn-add" style="background-color: #d35400;">+ Staff</a>
            </div>
            
            <form method="GET" action="index.php" class="filter-form">
                <select name="program_id">
                    <option value="">-- Semua Program --</option>
                    <?php
                    $p_list = mysqli_query($conn, "SELECT * FROM programs");
                    while($p = mysqli_fetch_array($p_list)) {
                        $selected = ($filter_program == $p['program_id']) ? 'selected' : '';
                        echo "<option value='".$p['program_id']."' $selected>".$p['nama_program']."</option>";
                    }
                    ?>
                </select>

                <select name="user_id">
                    <option value="">-- Semua Staff --</option>
                    <?php
                    $u_list = mysqli_query($conn, "SELECT * FROM users");
                    while($u = mysqli_fetch_array($u_list)) {
                        $selected = ($filter_user == $u['user_id']) ? 'selected' : '';
                        echo "<option value='".$u['user_id']."' $selected>".$u['nama']."</option>";
                    }
                    ?>
                </select>
                
                <div class="filter-buttons">
                    <button type="submit" class="btn-filter">Cari</button>
                    <a href="index.php" class="btn-reset">Reset</a>
                </div>
            </form>
        </div>
    </header>

    <main>
        <main>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
            <h2>Daftar Tugas Aktif</h2>
        </div>
        
        <div class="table-container">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th style="width: 30%;">Tugas</th>
                        <th style="width: 25%;">Program</th>
                        <th style="width: 25%;">PIC</th>
                        <th style="width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>
                                <strong><?php echo htmlspecialchars($row['nama_tugas']); ?></strong><br>
                                <small style="color: #666;"><?php echo date('d/m/y', strtotime($row['deadline'])); ?></small>
                            </td>
                            <td><?php echo htmlspecialchars($row['nama_program']); ?></td>
                            <td><?php echo htmlspecialchars($row['penanggung_jawab']); ?></td>
                            <td>
                                <a href="konfirmasi_hapus_tugas.php?id=<?php echo $row['task_id']; ?>&nama=<?php echo urlencode($row['nama_tugas']); ?>" 
                                   class="btn-delete" style="font-size: 10px; padding: 4px 8px;">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 20px;">Tidak ada tugas ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
    </main>
</div>
</div>

</body>
</html>