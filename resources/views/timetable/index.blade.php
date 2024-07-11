<!DOCTYPE html>
<html>
<head>
    <title>Timetable</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .break {
            background-color: #f9f9f9;
            font-style: italic;
        }
        .no-teacher {
            background-color: #ffdddd;
        }
        .highlight {
            background-color: #d4edda;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mt-5">Generated Timetable</h1>

    <!-- Teacher Filter Dropdown -->
    <div class="form-group mt-3">
        <label for="teacherFilter">Filter by Teacher:</label>
        <select class="form-control" id="teacherFilter">
            <option value="">-- Select Teacher --</option>
            @foreach($teachers as $teacher)
                <option value="{{ $teacher->name }}">{{ $teacher->name }}</option>
            @endforeach
        </select>
    </div>

    @foreach ($timetable as $classSection => $days)
        <h2 class="mt-4">{{ $classSection }}</h2>
        <table class="table table-bordered">
            <thead class="thead-light">
            <tr>
                <th>Time Slot</th>
                <th>Sunday</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
            </tr>
            </thead>
            <tbody>
            @foreach (['08:00-08:30', '08:30-09:00', '09:00-09:30', '09:30-10:00', '10:00-10:15', '10:15-10:45', '10:45-11:15', '11:15-11:45', '11:45-12:15'] as $timeSlot)
                <tr>
                    <td>{{ $timeSlot }}</td>
                    @foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'] as $day)
                        <td class="{{ $timeSlot === '10:00-10:15' ? 'break' : (isset($days[$day][$timeSlot]) && $days[$day][$timeSlot] === 'No teachers found' ? 'no-teacher' : '') }}" data-teacher="{{ isset($days[$day][$timeSlot]) ? explode(' by ', $days[$day][$timeSlot])[1] ?? '' : '' }}">
                            {{ $days[$day][$timeSlot] ?? '' }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    @endforeach
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.getElementById('teacherFilter').addEventListener('change', function() {
        var selectedTeacher = this.value;
        var cells = document.querySelectorAll('td[data-teacher]');

        cells.forEach(function(cell) {
            if (selectedTeacher === '' || cell.getAttribute('data-teacher') === selectedTeacher) {
                cell.classList.remove('d-none');
                if (cell.getAttribute('data-teacher') === selectedTeacher) {
                    cell.classList.add('highlight');
                } else {
                    cell.classList.remove('highlight');
                }
            } else {
                cell.classList.add('d-none');
            }
        });
    });
</script>
</body>
</html>
