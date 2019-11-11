@extends('admin.layouts.app', ['title' => __('Manage Stories')])

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

@include('admin.stories.partials.cards')

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Stories') }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('admin.stories.create') }}" class="btn btn-sm btn-primary">{{ __('Add story') }}</a>
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

                {{-- @if($unApprovedStories > 0)
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                you have {{ $unApprovedStories}} stories that have not been approved, check them out <a href="{{ route('admin.unapprovedstories') }}">here</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif --}}



            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">{{ __('Title') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col">{{ __('Category') }}</th>
                            <th scope="col">{{ __('Type') }}</th>
                            <th scope="col">{{ __('Posted By') }}</th>
                            <th scope="col">{{ __('Posted On') }}</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stories as $story)
                        <tr>
                            <th scope="row" title="{{ $story->title }}">
                                <div class="truncate" style="max-width:260px;margin-bottom:5px;">{{ $story->title }}</div>
                                <span class="text-muted" style="font-weight: 400;">By {{ $story->author }}</span>
                            </th>
                            <td>
                                <span class="badge {{ $story->status == 'Approved' ? 'badge-success' : 'badge-danger' }}">
                                    {{ $story->status }}
                                </span>
                            </td>
                            <td>{{ ucfirst($story->category->name) }}</td>
                            <td>
                                <span class="badge {{ $story->subscription == 'Regular' ? 'badge-primary' : 'bg-yellow' }}">
                                    {{ $story->subscription }}
                                </span>
                            </td>
                            <td>{{ $story->user->fullname }}</td>
                            <td>
                                <abbr title="{{ $story->created_at->format('d-M-Y') . ' @ ' . $story->created_at->format('H:ia') }}">
                                    {{ $story->created_at->diffForHumans() }}
                                </abbr>
                            </td>

                            <td class="text-right">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">



                                        <a class="dropdown-item" href="{{ route('admin.stories.show', $story->slug) }}">{{ __('Detail') }}</a>
                                        <a class="dropdown-item" href="{{ route('admin.stories.edit', $story->slug) }}">{{ __('Edit') }}</a>
                                        <form action="{{ route('admin.unapprovestory', $story->id) }}" method="post">
                                            @csrf

                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to unpublish?") }}') ? this.parentElement.submit() : ''">
                                                {{ __('unApprove') }}
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.stories.destroy', $story->slug) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete?") }}') ? this.parentElement.submit() : ''">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer py-4">
                <nav class="d-flex justify-content-end" aria-label="...">
                    {{ $stories->links() }}
                </nav>
            </div>
        </div>
    </div>
</div>
@include('admin.layouts.footers.auth')
</div>
@endsection