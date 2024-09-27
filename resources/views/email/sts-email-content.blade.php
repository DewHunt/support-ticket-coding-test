<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        th {
            vertical-align: top;
        }

        .text-end {
            text-align: right;
        }
    </style>
</head>

<body>
    @if ($ticket->status == 'open')
        <h1>{{ $customer->name }} Opened A Ticket.</h1>
    @else
        <h1>This Ticket is Closed Now.</h1>
    @endif
    <table>
        <tbody>
            <tr>
                <th width="150px" class="text-end">Name</th>
                <th width="20px">:</th>
                <td>{{ $customer->name }}</td>
            </tr>
            <tr>
                <th width="150px" class="text-end">Email</th>
                <th width="20px">:</th>
                <td>{{ $customer->email }}</td>
            </tr>
            <tr>
                <th width="150px" class="text-end">Title</th>
                <th width="20px">:</th>
                <td>{{ $ticket->title }}</td>
            </tr>
            <tr>
                <th width="150px" class="text-end">Description</th>
                <th width="20px">:</th>
                <td>{{ $ticket->description }}</td>
            </tr>
            @if ($ticket->status == 'closed')
                <tr>
                    <th width="150px" class="text-end">Response</th>
                    <th width="20px">:</th>
                    <td>{{ $ticket->response }}</td>
                </tr>
            @endif
            <tr>
                <th width="150px" class="text-end">Status</th>
                <th width="20px">:</th>
                <td>{{ ucfirst($ticket->status) }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
