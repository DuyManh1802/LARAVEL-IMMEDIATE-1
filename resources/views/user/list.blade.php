@extends('./../layouts.default')
@section('content')

@if (session('success'))
<div class="alert alert-success">
    <h5>{{ session('success') }}</h5>
</div>
@endif
@if (session('error'))
<div class="alert alert-danger text-center">{{ session('error') }}</div>
@endif

<div>
    <h5>Số người dùng: {{ $users->count() }}</h5>
</div>
<div class="d-flex">
    <a class="btn" href="{{ route('user.create') }}">
        <button class="btn btn-primary">Thêm người dùng</button>
    </a>
    <form action="{{ route('user.list') }}" method="GET">
        @csrf
        <ul class="nav flex-column mb-sm-auto mb-0 align-items-start" id="menu">
            <li class="dropdown">
                <a href="#" class="nav-link dropdown-toggle  text-truncate" id="dropdown" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fs-5 bi-bootstrap"></i><span class="ms-1 d-none d-sm-inline"> Search User</span>
                </a>
                <ul class="dropdown-menu text-small" style="width: 500px;" aria-labelledby="dropdown">
                    <li class="input-group d-flex mt-3 mb-3 dropdown-item">
                        <input type="text" class="form-control mr-2" name="email" placeholder="Mail address">
                    </li>
                    <li class="input-group d-flex mt-3 mb-3 dropdown-item">
                        <input type="text" class="form-control mr-2" name="name" placeholder="Name">
                    </li>
                    <li class="input-group d-flex mt-3 mb-3 dropdown-item">
                        <input type="text" class="form-control mr-2" name="address" placeholder="Address">
                    </li>
                    <li class="input-group d-flex mt-3 mb-3 dropdown-item">
                        <input type="text" class="form-control mr-2" name="phone" placeholder="Phone">
                    </li>

                    <button type="submit" class="btn btn-primary" name="search">Tìm kiếm</button>
                </ul>
            </li>
        </ul>
    </form>
</div>

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
            <td>{{ UpperText::upperText($user->name) }}</td>
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
