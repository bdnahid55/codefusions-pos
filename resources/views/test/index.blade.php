@extends('backend.admin.layout')

@section('content')

    <!-- alert -->
    <div class="card-body m-1">
        <?php if( Session::get('success') != null){ ?>
        <div class="alert alert-success" role="alert">
            <strong><?php echo Session::get('success'); ?> </strong>
        </div>
        <?php Session::put('success',null); } ?>

        <?php if( Session::get('failed') != null){ ?>
        <div class="alert alert-danger" role="alert">
            <strong><?php echo Session::get('failed'); ?> </strong>
        </div>
        <?php Session::put('failed',null); } ?>

        {{-- validation warning --}}
        @if (count($errors) > 0)
            @foreach ($errors->all() as $errors)
                <div class="alert alert-primary" role="alert">
                    <strong>{{ $errors }}!</strong>
                </div>
            @endforeach
        @endif
    </div>
    {{-- End of alert --}}

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            All Data
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>

                    @foreach ($tests as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->email }}</td>
                            <td>
                                <a href="{{ route('test.details',$value->id) }}" class="btn btn-square btn-primary waves-effect waves-light"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('test.edit',$value->id) }}" class="btn btn-square btn-warning waves-effect waves-light"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('test.delete',$value->id) }}" onclick="return confirm('Are you Sure to Delete it ?')" class="btn btn-square btn-danger waves-effect waves-light"><i class="fa fa-close"></i></a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
