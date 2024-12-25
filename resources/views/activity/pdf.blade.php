<!DOCTYPE html>
<html>
<head>
    <title>Activity Log</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Log Aktivitas User</h1>
    
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>User</th>
                <th>Aksi</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
                <tr>
                    <td>{{ $activity->created_at->format('d M Y H:i') }}</td>
                    <td>{{ $activity->user->name }}</td>
                    <td>{{ $activity->aksi }}</td>
                    <td>{{ $activity->deskripsi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html> 