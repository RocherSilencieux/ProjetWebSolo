<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Vie commune') }}
            </span>
        </h1>
    </x-slot>
    <div class="card-body flex flex-col gap-5">
        <div class="card min-w-full">
            <div class="card-header">
                <h3 class="card-title">
                    Latest Orders
                </h3>
            </div>
            <div class="card-table">
                <div data-datatable="true" data-datatable-page-size="5">
                    <div class="scrollable-x-auto">
                        <table class="table table-border text-sm" data-datatable-table="true">
                            <thead>
                            <tr>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Description
                                </th>
                                <th>
                                    Done
                                </th>
                                <th>
                                    Status
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                @if($task->deleted == true)
                                    <form method="post">
                                        @csrf
                                        @method('PUT')


                                        <tr>
                                            <td>
                                                {{$task->title}}
                                            </td>
                                            <td>
                                                {{$task->description}}
                                            </td>
                                            <td>
                                                YES by {{$task->doneby}}
                                            </td>
                                            <td>
                                                {{$task->comment}}
                                            </td>

                                @endif
                            @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-3 text-gray-600 text-2sm font-medium">
                            <div class="flex items-center gap-2">
                                Show
                                <select class="select select-sm w-16" data-datatable-size="true" name="perpage">
                                </select>
                                per page
                            </div>
                            <div class="flex items-center gap-4">
      <span data-datatable-info="true">
      </span>
                                <div class="pagination" data-datatable-pagination="true">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end: grid -->
</x-app-layout>
