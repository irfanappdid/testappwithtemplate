<!DOCTYPE html>
<html>
<head>
    <title>Projects PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Project List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Project Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Timeline</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->name }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->start_date }}</td>
                    <td>{{ $project->end_date }}</td>
                    <td>{{ $project->project_timeline }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
