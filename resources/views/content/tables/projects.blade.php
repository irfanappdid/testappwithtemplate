@extends('layouts/contentLayoutMaster')

@section('title', 'Projects')
@section('page-style')
    <style>
        [x-cloak] {
            display: none !important;
        }

        .dropdown-menu {
            transform: scale(1) !important;
        }
    </style>
@endsection

@section('content')

    <section>
        <div class="row match-height">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <x-card>

                    <livewire:project-table />
                </x-card>
            </div>
        </div>
    </section>
    <th colspan="8">
        <a href="{{ url('admin/export-csv') }}" class="btn btn-success">Export CSV</a>
        <a href="{{ url('admin/generate-pdf') }}" class="btn btn-success">Export PDF</a>
    </th>
    <x-side-modal title="Add Employee" id="add-blade-modal">
        <x-form id="add-project" method="POST" class="" :route="route('admin.projects.store')">
            <div class="col-md-12 col-12 ">
                <x-input name="name" />
                <x-input name="description" type="textarea" />
                <x-input type="date" name="start_date" />
                <x-input type="date" name="end_date" />
                <x-input name="project_timeline" />
            </div>
        </x-form>
    </x-side-modal>
    <x-side-modal title="Update Employee" id="edit-project-modal">
        <x-form id="edit-project" method="POST" class="" :route="route('admin.projects.update')">
            <div class="col-md-12 col-12 ">
                <x-input name="name" />
                <x-input name="description" type="textarea" />
                <x-input type="date" name="start_date" />
                <x-input type="date" name="end_date" />
                <x-input name="project_timeline" />
                <x-input name="id" type="hidden" />
            </div>
        </x-form>
    </x-side-modal>
@endsection
@section('page-script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '[data-show]', function() {
                const modal = $(this).data('show');
                $(`#${modal}`).modal('show');
            });
        });

        function setValue(data, modal) {
            console.log(data);
            $(modal + ' #id').val(data.id);
            $(modal + ' #name').val(data.name);
            $(modal + ' #description').val(data.description);
            $(modal + ' #start_date').val(data.start_date);
            $(modal + ' #end_date').val(data.end_date);
            $(modal + ' #project_timeline').val(data.project_timeline);
            $(modal).modal('show');
        }
    </script>
@endsection
