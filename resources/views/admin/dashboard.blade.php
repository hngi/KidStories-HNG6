@extends('admin.layouts.app')

@section('content')
    @include('admin.layouts.headers.cards')
    
    <div class="container-fluid mt--7">

        <div class="row mt-5">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Page Statistics</h3>
                            </div>
                         
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Total stories</th>
                                    <th scope="col">Total Users</th>
                                    <th scope="col">Total Premium Stories</th>
                                    <th scope="col">Total Subscription (NGN)</th>
                                    <th scope="col">Total Subscription (USD)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        0
                                    </th>
                                    <td>
                                       0
                                    </td>
                                    <td>
                                        0
                                    </td>
                                    <td>
                                        0
                                    </td>
                                    <td>
                                        0
                                    </td>
                                </tr>
 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        @include('admin.layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush