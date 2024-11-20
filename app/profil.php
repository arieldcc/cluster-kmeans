<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pembuat Aplikasi</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        .profile-container {
            background-color: #ffffff;
            padding: 20px;
            max-width: 600px;
            width: 90%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 1.8em;
            margin-bottom: 20px;
        }

        .profile-table {
            width: 100%;
            border-collapse: collapse;
        }

        .profile-table tr {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .profile-table tr:last-child {
            border-bottom: none;
        }

        .profile-table td {
            color: #666;
            padding: 8px 0;
        }

        .profile-table td.label {
            font-weight: bold;
            color: #333;
            width: 40%;
            min-width: 120px;
        }

        .profile-table td.value {
            width: 55%;
            text-align: left;
        }

        .profile-table td.center-text {
            text-align: center;
            color: #666;
            font-size: 0.9em;
            padding: 15px 0;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .back-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        /* Responsive Styles */
        @media (max-width: 500px) {
            .profile-container {
                padding: 15px;
            }

            h1 {
                font-size: 1.5em;
            }

            .profile-table td.label,
            .profile-table td.value {
                width: 100%;
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Profil Pembuat Aplikasi</h1>
        <table class="profile-table">
            <tr>
                <td class="label">Nama</td>
                <td class="value"><?php echo nama_mhs(); ?></td>
            </tr>
            <tr>
                <td class="label">Judul Penelitian</td>
                <td class="value"><?php echo judul(); ?></td>
            </tr>
            <tr>
                <td class="label">Objek Penelitian</td>
                <td class="value"><?php echo objek(); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="center-text">
                    Penelitian ini dibuat sebagai syarat untuk memperoleh gelar Sarjana (S.Kom) pada Universitas Ichsan Gorontalo Fakultas Ilmu Komputer Program Studi Teknik Informatika.
                </td>
            </tr>
        </table>
        <div class="button-container">
            <a href="." class="back-button"><< Kembali</a>
        </div>
    </div>
</body>
</html>
