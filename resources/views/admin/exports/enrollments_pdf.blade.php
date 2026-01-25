<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            bg-color: #f2f2f2;
            font-weight: bold;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            color: white;
            background: #555;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>SAPAI - Manajemen Materi & Pendaftaran</h2>
        <h3>{{ $title }}</h3>
        <p>Dicetak pada: {{ $date }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Daftar</th>
                <th>Nama Siswa</th>
                <th>Email</th>
                <th>Program</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enrollments as $key => $e)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($e->tgl_daftar)->format('d/m/Y') }}</td>
                <td>{{ $e->user->nama_lengkap }}</td>
                <td>{{ $e->user->email }}</td>
                <td>{{ $e->program->nama_program }}</td>
                <td>Rp {{ number_format($e->program->harga, 0, ',', '.') }}</td>
                <td>{{ strtoupper($e->status_bayar) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>