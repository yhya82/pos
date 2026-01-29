<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Sales History</h2>
    <a href="{{route('sale.pos')}}">Create new Sale</a>
    <table>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Total</th>
            <th>Status</th>
            <th>Payment Method</th>
            <th>Items</th>
            <th>Created at</th>

        </tr>
        @forelse ($sales as $sale)
        <tr>
            <td>{{$sale->id}}</td>
            <td>{{$sale->user->name}}</td>
            <td>{{$sale->total}}</td>
            <td>{{$sale->status}}</td>
            <td>{{$sale->payment_method}}</td>
            <td>
                <ul>
                    @foreach($sale->items as $item)
                    <li>{{$item->product->name ?? 'Deleted Product'}} * {{$item->quantity}} ({{$item->price}})</li>
                    @endforeach
                </ul>
            </td>
            <td>{{$sale->created_at->format('d M Y H:i')}}</td>
        </tr>
            
        @empty
        <tr>
            <td>No Sales Yet</td>
        </tr>
            
        @endforelse

    </table>
</body>
</html>