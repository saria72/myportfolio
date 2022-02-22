@extends('layouts.master')

@section('tittle', 'All Banner|')

@section('main_body')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12  ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>All Banners <a href="{{ route('backend.bannner.create') }}" class="btn btn-sm btn-primary">Add Banner</a></h2>
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
                                                <td>{{ $data->description }}</td>
                                                <td>{{ $data->status }}</td>
                                                <td class="last">
                                                    <a href="#">View</a>
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
        <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
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
        </div>
    @endif

@endsection

@section('backend_js')
    <script>
        $('.toast').toast('show')
    </script>
@endsection
