<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Vie commune') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">



                    </div>
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
                                                <th class="w-[60px]">
                                                    <input class="checkbox checkbox-sm" data-datatable-check="true" type="checkbox"/>
                                                </th>
                                                <th>
                                                    Titre
                                                </th>
                                                <th>
                                                    Description
                                                </th>
                                                <th>
                                                    Order Date
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
                                                                @if(auth()->user()->school()->pivot->role == "admin")
                                                                    <input name="title" type="text" value="{{$task->title}}" onchange="this.form.submit()" size="10">
                                                                    <input type="hidden" id="id" name="id" value="{{$task->id}}">
                                                                @else
                                                                    {{$task->title}}
                                                                @endif


                                                            </td>
                                                            <td>
                                                                @if(auth()->user()->school()->pivot->role == "admin")
                                                                    <input name="description" type="text" value="{{$task->description}}" onchange="this.form.submit()">
                                                                    <input type="hidden" id="id" name="id" value="{{$task->id}}">
                                                                @else
                                                                    {{$task->description}}
                                                                @endif
                                                            </td>
                                                    </form>
                                                    <td>
                                                        <form method="post" action="{{route('common-life.swapDone')}}">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit">
                                                                @if($task->done == true) YES by {{$task->doneby}}
                                                                @elseif($task->done == false) NO
                                                                @endif
                                                            </button>
                                                            <input type="hidden" id="id" name="id" value="{{$task->id}}">
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <textarea type="text" name="comment"  onchange="this.form.submit()">{{$task->comment}}</textarea>

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
                </div>
            </div>
        </div>


                </div>
    <!-- end: grid -->
</x-app-layout>
