@extends('./../layouts.app')
@section('content')
<div>
    @if (session('success'))
    <div class="alert alert-success">
        <h5>{{ session('success') }}</h5>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <a class="dropdown-item" href="{{ route('user.create') }}">
        <button class="btn btn-primary">Thêm người dùng</button>
    </a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $users as $key => $user )
            <tr>
                <th scope="row">{{ $key+1 }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->phone }}</td>
                <td>
                    <a href="{{ route('user.edit', ['id'=>$user->id]) }}"><button type="button"
                            class="btn btn-primary btn-sm">Edit</button></a>
                </td>
                <td>
                    <a href="{{ route('user.delete', ['id'=>$user->id]) }}" onclick="return myFunction();"><button
                            type="button" class="btn btn-primary btn-sm">Delete</button></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection
