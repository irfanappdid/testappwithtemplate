@extends('layouts/contentLayoutMaster')

@section('title', 'Employee')
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
                    <livewire:employee-table />
                </x-card>
            </div>
        </div>
    </section>
    <x-side-modal title="Add Employee" id="add-blade-modal">
        <x-form id="add-employees" method="POST" class="" :route="route('admin.employees.store')">
            <div class="col-md-12 col-12 ">
                <x-input name="name" />
                <x-input name="phone" type="number" />
                <x-input type="email" name="email" />
                <x-input type="password" name="password" />
            </div>
        </x-form>
    </x-side-modal>
    <x-side-modal title="Update Employee" id="edit-employees-modal">
        <x-form id="edit-employees" method="POST" class="" :route="route('admin.employees.update')">
            <div class="col-md-12 col-12 ">
                <x-input name="name" />
                <x-input name="phone" type="number" />
                <x-input type="email" name="email" />
                <x-input type="password" name="password" />
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
            $(modal + ' #email').val(data.email);
            $(modal + ' #phone').val(data.phone);
            $(modal + ' #password').val(data.password);
            $(modal).modal('show');
        }
    </script>
@endsection
