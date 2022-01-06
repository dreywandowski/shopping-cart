@extends('shop-layout.auth')
@section('content')

    {{-- Success is as dangerous as failure. --}}
    <div>
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="float-right mt-5">
                    <input wire:model="search" class="form-control" type="text" placeholder="Search Users...">
                </div>
            </div>
        </div>

        <div class="row">
            @if ($users->count())
                <table class="table">
                    <thead>
                    <tr>
                        <th>
                            <a wire:click.prevent="sortBy('name')" role="button" href="#">
                                Name
                            </a>
                        </th>
                        <th>
                            <a wire:click.prevent="sortBy('email')" role="button" href="#">
                                Email
                            </a>
                        </th>
                        <th>
                            <a wire:click.prevent="sortBy('address')" role="button" href="#">
                                Address
                            </a>
                        </th>
                        <th>
                            <a wire:click.prevent="sortBy('created_at')" role="button" href="#">
                                Created at
                            </a>
                        </th>
                        <th>
                            Delete
                        </th>
                        <th>
                            Edit
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                            <td>
                               <button class="btn btn-sm btn-danger" wire:click="$emit('deleteTriggered', {{ $user->id }}, '{{ $user->name }}')">
                                Delete
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-dark">
                                    Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning">
                    Your query returned zero results.
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col">
                {{ $users->links() }}
            </div>
        </div>

</div>
    @livewireScripts

@endsection
