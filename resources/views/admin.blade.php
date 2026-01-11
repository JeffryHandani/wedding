<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --border:#e7d7de; --primary:#b03060; }
        * { box-sizing:border-box; }
        body { margin:0; font-family:Poppins, system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; color:#2c1b1f; background:linear-gradient(180deg,#fffafc 0%, #ffeaf1 50%, #fff7fa 100%); }
        .container { max-width:1080px; margin:0 auto; padding:24px; }
        header { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; }
        h1 { margin:0; font-family:Playfair Display, serif; color:var(--primary); }
        .card { background:#fff; border:1px solid var(--border); border-radius:16px; box-shadow:0 10px 24px rgba(0,0,0,0.06); padding:16px; margin-bottom:16px; }
        table { width:100%; border-collapse:separate; border-spacing:0; }
        thead th { text-align:left; padding:10px; background:#fff3f7; }
        tbody td { padding:10px; border-top:1px solid #f0e5ea; }
        tbody tr:nth-child(even) td { background:#fffafc; }
        .btn { display:inline-block; padding:10px 14px; border-radius:10px; border:1px solid var(--border); background:#fff; text-decoration:none; color:#2c1b1f; }
        .btn-primary { background:linear-gradient(180deg, var(--primary) 0%, #9a234e 100%); color:#fff; border-color:transparent; box-shadow:0 10px 24px rgba(176,48,96,0.28); }
        form input { width:100%; padding:12px 14px; margin:8px 0 12px; border:1px solid var(--border); border-radius:12px; }
        .notice { color:var(--primary); margin-top:6px; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Admin Dashboard</h1>
            <div>
                <a class="btn" href="{{ route('invite') }}">Back to Invite</a>
            </div>
        </header>

        @if(!session('admin'))
            <div class="card" style="max-width:420px;">
                <h2>Login</h2>
                <form method="post" action="{{ route('admin.login') }}">
                    @csrf
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit" class="btn btn-primary">Login</button>
                    @if(session('admin_error'))
                        <div class="notice">{{ session('admin_error') }}</div>
                    @endif
                </form>
            </div>
        @else
            <div class="card">
                <form method="post" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn">Logout</button>
                </form>
            </div>
            <div class="card">
                <h2>RSVPs</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Attending</th>
                            <th>Guests</th>
                            <th>Message</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(($rsvps ?? []) as $r)
                            <tr>
                                <td>{{ $r->name }}</td>
                                <td>{{ $r->email }}</td>
                                <td>{{ $r->phone }}</td>
                                <td>{{ $r->attending ? 'Yes' : 'No' }}</td>
                                <td>{{ $r->guests_count }}</td>
                                <td>{{ $r->message }}</td>
                                <td>{{ $r->created_at }}</td>
                            </tr>
                        @endforeach
                        @if(empty($rsvps) || count($rsvps) === 0)
                            <tr><td colspan="7">No data</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="card">
                <h2>Wishes</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Message</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(($wishes ?? []) as $w)
                            <tr>
                                <td>{{ $w->name }}</td>
                                <td>{{ $w->message }}</td>
                                <td>{{ $w->created_at }}</td>
                            </tr>
                        @endforeach
                        @if(empty($wishes) || count($wishes) === 0)
                            <tr><td colspan="3">No data</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>
</html>
