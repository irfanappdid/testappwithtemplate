@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard Analytics')
@section('page-style')
    <style>
        .avatar svg {
            height: 20px;
            width: 20px;
            font-size: 1.45rem;
            flex-shrink: 0;
        }

        .dark-layout .avatar svg {
            color: #fff;
        }

        .cursor {
            cursor: pointer;
        }

        .revenue-div-border-style {
            border: 2px solid;
            border-left: 0;
            border-top: 0;
            border-bottom: 0;
        }

        .revenue-title-border-style {
            border: 1px solid red;
            border-top: 0;
            border-right: 0;
            border-left: 0;
            padding-bottom: 3px;
        }
    </style>
@endsection

@section('content')
    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card>

                    <livewire:emplyeedashboard-table />
                </x-card>
            </div>
        </div>
    </section>
    {{-- <div class="container my-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Assigned Projects</h4>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Employee Name</th>
                            <th>Project Titles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assign_projects as $assign_project)
                            <tr>
                                <td>{{ $assign_project->employee->name }}</td>
                                <td>{{ $assign_project->project->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}

@endsection

@section('page-script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/4.2.0/apexcharts.min.js"
        integrity="sha512-3+Gl3bmoEkUSCMsEZARlhT4bnq4/MD78aCvs07GULmDOEBpdHYVQF6bz8pIpEg+luEww2gXsOwuhvXUl0i+N4g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const userCount = [2, 4, 6, 7];
        const userDate = ["2024-10-01", "2024-10-02", "2024-10-03", "2024-10-04"];
        initBarChart({
            selector: '#users',
            categories: userDate,
            data: userCount,
            label: 'Users'
        });
        const membershipCount = [1000, 2000, 3000, 4000];
        const membershipDate = ["2024-10-01", "2024-10-02", "2024-10-03", "2024-10-04"];
        initBarChart({
            selector: '#membership',
            categories: membershipDate,
            data: membershipCount,
            label: 'Memberships'
        });
        const ecommerceOrdersCount = [100, 200, 300, 400];
        const ecommerceOrdersDate = ["2024-10-01", "2024-10-02", "2024-10-03", "2024-10-04"];
        initBarChart({
            selector: '#ecommerce',
            categories: ecommerceOrdersDate,
            data: ecommerceOrdersCount,
            label: 'Ecommerce'
        });
        const videoMembershipCount = [2, 4, 6, 7];
        const videoMembershipDate = ["2024-10-01", "2024-10-02", "2024-10-03", "2024-10-04"];
        initChart({
            selector: '#video-membership',
            categories: videoMembershipDate,
            data: videoMembershipCount,
            label: 'Video Memberships'
        });
    </script>


    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;

        var pusher = new Pusher('1cdf1e7644ae7f3d2a26', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('order_placed_vendor_9');
        channel.bind('my-event', function(data) {
            console.log(JSON.stringify(data));
        });
    </script>
@endsection
