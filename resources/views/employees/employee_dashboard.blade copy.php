<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand">Employee Dashboard</span>
            <div class="d-flex">
                <a class="btn btn-outline-light" href="{{ route('employee.logout-employee') }}">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Assigned Projects</h4>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Employee Name</th>
                            <th>Project Titles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assign_projects as $assign_project)
                            <tr>
                                <td>{{ $assign_project->employee->name }}</td>
                                <td>{{ $assign_project->project->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>
