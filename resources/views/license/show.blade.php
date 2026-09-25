<x-bootstrap-theme>
    <div class="container">
        <div class="row">
            

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">License {{ $license->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('/license') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/license/' . $license->id . '/edit') }}" title="Edit License"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('license' . '/' . $license->id) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete License" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $license->id }}</td>
                                    </tr>
                                    <tr><th> No </th><td> {{ $license->no }} </td></tr><tr><th> Type </th><td> {{ $license->type }} </td></tr><tr><th> Issue Date </th><td> {{ $license->issue_date }} </td></tr><tr><th> Expire Date </th><td> {{ $license->expire_date }} </td></tr><tr><th> Name </th><td> {{ $license->name }} </td></tr><tr><th> Birth Date </th><td> {{ $license->birth_date }} </td></tr><tr><th> Id No </th><td> {{ $license->id_no }} </td></tr><tr><th> User Id </th><td> {{ $license->user_id }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-bootstrap-theme>
