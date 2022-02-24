@extends('layouts.master')

@section('tittle', 'All Banner|')

@section('main_body')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>All Banners <a href="{{ route('backend.banner.create') }}"
                                    class="btn btn-sm btn-primary">Add Banner</a></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title">Id </th>
                                            <th class="column-title">Image </th>
                                            <th class="column-title">Title </th>
                                            <th class="column-title">Description </th>
                                            <th class="column-title">Status </th>
                                            <th class="column-title">Action </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($datas as $data)
                                            <tr class="even pointer">
                                                <td>{{ $data->id }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/banner/' . $data->photo) }}" width="100"
                                                        alt="">
                                                </td>
                                                <td>{{ $data->title }}</td>
                                                <td>{{ Str::limit($data->description, 20, '...') }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-{{ $data->status == 1 ? 'success' : 'warning' }}">{{ $data->status == 1 ? 'Active' : 'Deactive' }}</a>
                                                </td>
                                                <td class="last">
                                                    <a href="{{ route('backend.banner.status', $data->id) }}"
                                                        class="btn btn-sm btn-{{ $data->status == 1 ? 'warning' : 'success' }}">
                                                        {{ $data->status == 1 ? 'Deactive' : 'Active' }}
                                                    </a>
                                                    <a href="{{ route('backend.banner.edit', $data->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    <form class="d-inline"
                                                        action="{{ route('backend.banner.destroy', $data->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 col-sm-12 mt-5  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Deleted Data </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <div class="x_content">
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <th class="column-title">Id </th>
                                            <th class="column-title">Image </th>
                                            <th class="column-title">Title </th>
                                            <th class="column-title">Description </th>
                                            <th class="column-title">Status </th>
                                            <th class="column-title">Action </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($TrashDatas as $data)
                                            <tr class="even pointer">
                                                <td>{{ $data->id }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/banner/' . $data->photo) }}" width="100"
                                                        alt="">
                                                </td>
                                                <td>{{ $data->title }}</td>
                                                <td>{{ Str::limit($data->description, 20, '...') }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-{{ $data->status == 1 ? 'success' : 'warning' }}">{{ $data->status == 1 ? 'Active' : 'Deactive' }}</a>
                                                </td>
                                                <td class="last">
                                                    <a href="{{ route('backend.banner.restore', $data->id) }}" class="btn btn-sm btn-primary">Restore</a>

                                                    <button value="{{ route('backend.banner.deleteforever', $data->id) }}" href="#" id="delete" class="btn btn-sm btn-danger">Delete Forever</button>

                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (session('success'))
        <div class="toast " style="position: absolute; top: 0; right: 0;" data-delay="10000">
            <div class="toast-header">
                <strong class="mr-auto">{{ config('app.name') }}</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    @endif

@endsection

@section('backend_css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.4/sweetalert2.min.css">
@endsection

@section('backend_js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.4/sweetalert2.all.min.js"></script>
    <script>
        $('.toast').toast('show')

        //danger point
        let url = $('#delete').val();

        $('#delete').on('click', function(){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
         }).then((result) => {
            if (result.isConfirmed) {
            window.location.href = url;
            }
           })
        })

    </script>
@endsection
