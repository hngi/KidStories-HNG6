@extends('admin.layouts.app', ['title' => __('Manage Feedbacks')])

@section('custom_css')
<style type="text/css">
    .truncate {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
</style>
@endsection

@section('content')

@include('admin.categories.partials.cards')

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Feedbacks') }}</h3>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                </div>


                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Email') }}</th>
                                <th scope="col">{{ __('Message') }}</th>
                                <th scope="col">{{ __('Posted On') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($feedbacks as $feedback)
                            <tr>
                                <th scope="row" title="{{ $feedback->title }}">
                                    <div class="truncate" style="max-width:260px;margin-bottom:5px;">{{ $feedback->name }}</div>

                                </th>

                                <td>{{ $feedback->name}}</td>
                                <td>{{ $feedback->name}}</td>
                                <td>
                                    <abbr title="{{ $feedback->created_at->format('d-M-Y') . ' @ ' . $feedback->created_at->format('H:ia') }}">
                                        {{ $feedback->created_at->diffForHumans() }}
                                    </abbr>
                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                        {{ $feedbacks->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footers.auth')
</div>
@endsection