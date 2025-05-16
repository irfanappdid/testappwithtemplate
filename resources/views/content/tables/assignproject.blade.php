@extends('layouts/contentLayoutMaster')

@section('title', 'Assign Project')
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
                    <livewire:assign-table />
                </x-card>
            </div>
        </div>
    </section>
    <x-side-modal title="Add Employee" id="add-blade-modal">
        <x-form id="add-assignprojects" method="POST" class="" :route="route('admin.assignprojects.store')">
            <div class="col-md-12 col-12 ">
                {{-- <x-select name="employee_id" type="select" /> --}}
                <x-select name="employee_id" :options="$employees" />
                <x-select name="project_id[]" label="Select Project" :options="$projects" multiple />
            </div>
        </x-form>
    </x-side-modal>
    <x-side-modal title="Update Employee" id="edit-assignprojects-modal">
        <x-form id="edit-assignprojects" method="POST" class="" :route="route('admin.assignprojects.update')">
            <div class="col-md-12 col-12 ">
                <x-select name="employee_id" :options="$employees" />
                <x-select name="project_id" id="edit-assignproject" label="Select Project" :options="$projects"
                    :multiple="true" />
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
            console.log(data.assigned_project_ids);
            $(modal + ' #id').val(data.assign_project.assign_project_id);
            $(modal + ' select[name="employee_id"]').val(data.assign_project.employee_id).trigger('change');
            $(modal + ' #edit-assignproject').val(data.assigned_project_ids).trigger('change');
            $(modal).modal('show');
        }
    </script>
@endsection
