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

    <div class="card mb-4 m-2">
        <div class="card-body">
            <div class="card-title">Add Test</div>
            <hr>

            <form action="{{ route('test.insert') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control form-control-square" name="name" required="">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control form-control-square" name="email" required="">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary m-2">Add</button>
                </div>

            </form>
        </div>
    </div>

@endsection
