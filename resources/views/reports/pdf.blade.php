<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #1e293b; }
        h1 { font-size: 18px; margin: 0; }
        .muted { color: #64748b; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th { background: #4f46e5; color: #fff; text-align: left; padding: 6px 8px; font-size: 10px; }
        td { padding: 5px 8px; border-bottom: 1px solid #e2e8f0; }
        .summary { margin-top: 10px; }
        .summary span { display: inline-block; margin-right: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>{{ setting('shop_name', 'Houseware Shop') }}</h1>
    <p class="muted">{{ $title }} · {{ $from->format('M d, Y') }} — {{ $to->format('M d, Y') }} · Generated {{ now()->format('M d, Y H:i') }}</p>

    @if (!empty($report['summary']))
        <div class="summary">
            @foreach ($report['summary'] as $label => $value)<span>{{ $label }}: {{ $value }}</span>@endforeach
        </div>
    @endif

    <table>
        <thead><tr>@foreach ($report['headers'] as $h)<th>{{ $h }}</th>@endforeach</tr></thead>
        <tbody>
            @forelse ($report['rows'] as $row)
                <tr>@foreach ($row as $cell)<td>{{ $cell }}</td>@endforeach</tr>
            @empty
                <tr><td colspan="{{ count($report['headers']) }}">No data.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
