@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <p class="list-header">
                            <span class="robot-header">Robots</span>
                            <a href="{{ route('robots.create') }}" class="btn btn-default align-right">
                                <i class="fa fa-plus action-icon" title="New Robot"></i>
                            </a>
                        </p>

                        <table class="table table-striped">
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Type</th>
                                <th>OS</th>
                                <th>Version</th>
                            </tr>
                            @if(!$robots->count())
                                <tr>
                                    <td colspan="4">No robots added yet.</td>
                                </tr>
                            @endif

                            @foreach ($robots as $robot)
                                @if($robot->user_id == Illuminate\Support\Facades\Auth::id() || (bool)App\RoleUsers::where('user_id', Illuminate\Support\Facades\Auth::id())->where('role_id', 1)->first() || (bool)App\RoleUsers::where('user_id', Illuminate\Support\Facades\Auth::id())->where('role_id', 2)->first())
                                    <tr>
                                        <td class="robot-actions">
                                            <a href="{{ route('robots.edit', $robot->id) }}">
                                                <i class="fa fa-pencil pull-left list-icon"></i>
                                            </a>
                                            <a href="{{ route('robots.destroy', $robot->id) }}" class="remove-confirm">
                                                <i class="fa fa-trash pull-right list-icon"></i>
                                            </a>
                                            <a href="edit.blade.php"></a>
                                        </td>
                                        <td>{{ $robot->name }}</td>
                                        <td>{{ $robot->type }}</td>
                                        <td>{{ $robot->version }}</td>
                                        <td>{{ $robot->ostype }}</td>
                                        <td>{{ $robot->osversion }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection