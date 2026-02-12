
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('sale.edit',$sale)}}" Method="POST">
        @csrf
        

        <label >Status</label>
        <select name="status" >
            <option value="">Select Status</option>
            <option value="pending" @selected($sale->status == 'completed')>pending</option>
            <option value="completed" @selected($sale->status == 'pending')>completed</option>
        </select>

        <label >Payment Method</label>
        <select name="payment_method" >
            <option value="">Select payment method</option>
            <option value="cash">Cash</option>
            <option value="card">Card</option>
            <option value="transfer">Transfer</option>
        </select><br>

        <button type="submit">Update Sale</button>

    </form>
</body>
</html>