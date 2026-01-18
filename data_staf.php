<?php
include 'koneksi.php';

// 1. Ambil data staf dari database
$query = "SELECT * FROM users ORDER BY nama ASC";
$result = mysqli_query($conn, $query);

// 2. Cek apakah query berhasil
if (!$result) {
    die("Kesalahan Query: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Staf - PMS UAS</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Styling Dasar */
        .container { padding: 20px; max-width: 1000px; margin: auto; }
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn-back { text-decoration: none; color: #3498db; font-weight: bold; font-size: 14px; }
        
        .table-container {
            width: 100%;
            overflow-x: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .styled-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .styled-table th, .styled-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .btn-delete-php {
            background-color: #e74c3c;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 12px;
            display: inline-block;
        }

        .badge {
            background: #f1f2f6;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            color: #2f3542;
            text-transform: uppercase;
        }

        /* --- RESPONSIVE MODE (UNTUK HP POCO) --- */
        @media screen and (max-width: 600px) {
            .header-flex { flex-direction: column; align-items: flex-start; gap: 10px; }
            
            .styled-table thead { display: none; /* Sembunyikan header tabel di HP */ }

            .styled-table tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 10px;
                background: #fff;
            }

            .styled-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                text-align: right;
                padding: 8px 5px;
                border-bottom: 1px dotted #eee;
            }

            .styled-table td:last-child { border-bottom: none; justify-content: center; padding-top: 15px; }

            /* Menambahkan label di sisi kiri kolom (Mobile) */
            .styled-table td::before {
                content: attr(data-label);
                font-weight: bold;
                color: #7f8c8d;
                font-size: 11px;
                text-transform: uppercase;
                flex: 1;
                text-align: left;
            }
            
            .styled-table td strong { font-size: 14px; }
        }
    </style>
</head>
<body>

<div class="container">
    <header class="header-flex">
        <h1>Manajemen Data Staf</h1>
        <a href="index.php" class="btn-back">🏠 Kembali ke Dashboard</a>
    </header>

    <main>
        <div class="table-container">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Staf</th>
                        <th>Jabatan</th>
                        <th>Role</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td data-label="Staf">
                                <strong><?php echo htmlspecialchars($row['nama']); ?></strong><br>
                                <small style="color: #666;"><?php echo htmlspecialchars($row['email']); ?></small>
                            </td>
                            <td data-label="Jabatan"><?php echo htmlspecialchars($row['jabatan']); ?></td>
                            <td data-label="Role">
                                <span class="badge"><?php echo htmlspecialchars($row['role']); ?></span>
                            </td>
                            <td data-label="Aksi" style="text-align: center;">
                                <a href="konfirmasi_hapus_staf.php?id=<?php echo $row['user_id']; ?>&nama=<?php echo urlencode($row['nama']); ?>" 
                                   class="btn-delete-php">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 40px; color: #999;">
                                Belum ada data staf dalam database.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

</body>
</html>