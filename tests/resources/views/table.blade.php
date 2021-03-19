<table>
    <thead>
        <tr>
            @foreach(array_keys($data[0]) as $column)
                <th>{{ strtoupper($column) }}</th>
            @endforeach
            <th>P</th>
            <th>P/PG</th>
        </tr>
    </thead>

    <tbody>
            @foreach($data as $row)
                <tr>
                    <td>{{ $row['player'] }}</td>
                    <td>{{ $row['team'] }}</td>
                    <td>{{ $row['gp'] }}</td>
                    <td>{{ $row['g'] }}</td>
                    <td>{{ $row['a'] }}</td>
                    <td>{{ $row['g'] + $row['a'] }}</td>
                    <td>{{ round(($row['g'] + $row['a']) / $row['g'], 2) }}</td>
                </tr>
            @endforeach
    </tbody>
</table>
