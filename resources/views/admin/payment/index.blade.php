@extends('admin.layouts.app', ['title' => __('User Management')])

@section('content')
    @include('admin.layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Users') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="" class="btn btn-sm btn-primary">{{ __('Add user') }}</a>
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
                                    <th scope="col">{{ __('User') }}</th>
                                    <th scope="col">{{ __('Email') }}</th>
                                    <th scope="col">{{ __('Amount') }}</th>
                                    <th scope="col">{{ __('Subscription') }}</th>
                                    <th scope="col">{{ __('Date')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ isset($transaction['metadata']['name']) ? $transaction['metadata']['name'] : "no name" }}</td>
                                        <td>
                                            {{  $transaction['customer']['email'] }}
                                        </td>
                                        <td>{{ $transaction['amount'] }}</td>

                                        <td>{{ isset($transaction['metadata']['subscription']) ? $transaction['metadata']['subscription'] : "no subscription" }} </td>
                                           <td>{{ $transaction['createdAt'] }}</td>
                                       
                                    </tr>

                                @endforeach
                       
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                           
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('admin.layouts.footers.auth')
    </div>
@endsection