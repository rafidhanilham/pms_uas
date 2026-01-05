<?php
include 'koneksi.php';

// Menangkap filter jika ada dari URL
$filter_program = isset($_GET['program_id']) ? $_GET['program_id'] : '';
$filter_user = isset($_GET['user_id']) ? $_GET['user_id'] : '';

// Query dasar (Sesuai Fitur Monitoring di Jurnal 1)
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
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>PMS UAS - Teknik Informatika</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <header>
    <h1>Program Management System</h1>
    <p>Project UAS - Kelompok 2</p>
    
    <div class="nav-actions" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
        <a href="tambah_program.php" class="btn-add" style="background-color: #27ae60;">+ Program</a>
        <a href="tambah_tugas.php" class="btn-add">+ Tugas</a>
        <a href="tambah_staff.php" class="btn-add" style="background-color: #8e44ad;">+ Staff</a>
        <a href="data_program.php" style="text-decoration:none; color:#3498db; font-weight:bold; margin-left:10px;">📁 Kelola Program</a>
        
        <form method="GET" action="index.php" style="display: flex; gap: 10px; margin-left: auto;">
            <select name="program_id" onchange="this.form.submit()" style="padding:8px; border-radius:5px;">
                <option value="">-- Semua Program --</option>
                <?php
                $p_list = mysqli_query($conn, "SELECT * FROM programs");
                while($p = mysqli_fetch_array($p_list)) {
                    $selected = ($filter_program == $p['program_id']) ? 'selected' : '';
                    echo "<option value='".$p['program_id']."' $selected>".$p['nama_program']."</option>";
                }
                ?>
            </select>

            <select name="user_id" onchange="this.form.submit()" style="padding:8px; border-radius:5px;">
                <option value="">-- Semua Staff --</option>
                <?php
                $u_list = mysqli_query($conn, "SELECT * FROM users");
                while($u = mysqli_fetch_array($u_list)) {
                    $selected = ($filter_user == $u['user_id']) ? 'selected' : '';
                    echo "<option value='".$u['user_id']."' $selected>".$u['nama']."</option>";
                }
                ?>
            </select>
            
            <a href="index.php" style="text-decoration:none; color:#666; font-size:12px; align-self:center;">Reset</a>
        </form>
    </div>
</header>

    <main>
        <h2>Daftar Tugas Aktif</h2>
        <table class="styled-table">
           <thead class="table-dark">
    <tr>
        <th>Nama Tugas</th>
        <th>Program</th>
        <th>Penanggung Jawab</th>
        <th>Deadline</th>
        <th>Status</th>
        <th>Aksi</th> </tr>
</thead>

<tbody>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?php echo $row['nama_tugas']; ?></td>
        <td><?php echo $row['nama_program']; ?></td>
        <td><?php echo $row['penanggung_jawab']; ?></td>
        <td><?php echo date('d-m-Y', strtotime($row['deadline'])); ?></td>
        <td>
            <span class="status-badge <?php echo strtolower(str_replace(' ', '-', $row['status'])); ?>">
                <?php echo $row['status']; ?>
            </span>
        </td>
        <td>
            <a href="hapus_tugas.php?id=<?php echo $row['task_id']; ?>" 
               class="btn-delete" 
               onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
               Hapus
            </a>
        </td>
    </tr>
    <?php endwhile; ?>
</tbody>
        </table>
    </main>
</div>
<script>
    <?php if (isset($_GET['status'])): ?>
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    if (status === 'staff_success') {
        alert("Berhasil! Staff baru telah didaftarkan.");
    } else if (status === 'success') {
        alert("Berhasil! Data telah tersimpan.");
    } else if (status === 'deleted') {
        alert("Data telah berhasil dihapus.");
    }

    window.history.replaceState({}, document.title, window.location.pathname);
</script>
<?php endif; ?>
</body>
</html>