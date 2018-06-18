@extends ('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-body">

            <div class="panel-body">
              <p class="list-header">
                <span class="user-header">Users</span>
                <a href="{{ asset('register') }}" class="btn btn-default align-right">
                    <i class="fa fa-plus action-icon" title="New User"></i>
                </a><br>
                <span class="user-header">{{ Auth::user()->organisation()->first()->name }}</span>
              </p>

              <div class="form-group">

            <table class="table table-striped">
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>E-mail</th>
                  <th>Phone Number</th>
                  <th>Address</th>
                  <th>Organisation</th>
                  <th>Created at</th>
                  <th>Role</th>
                </tr>
                @if(!$users->count())
                  <tr>
                    <td colspan="4">No Users added yet.</td>
                  </tr>
                @endif

                @foreach($users as $user)
                  @if(\App\RoleUsers::where('user_id', Auth::id())->first()->role_id =! 1)
                    @if(Auth::user()->organisation()->first()->id == Auth::user()->organisation()->first()->id || \App\RoleUsers::where('user_id', Auth::id())->first()->role_id == 1)
                    <tr>
                        <td class="robot-actions">
                            <a href="{{ route('users.edit', $user->id) }}">
                                <i class="fa fa-pencil pull-left list-icon"></i>
                            </a>
                            <a href="{{ route('users.destroy', $user->id) }}" class="remove-confirm">
                                <i class="fa fa-trash pull-right list-icon"></i>
                            </a>
                            <a href="edit.blade.php"></a>
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->organisation_id != null ? $user->organisation()->first()->name : ""  }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->roles()->first()->name }}</td>
                    <tr>                        
                    @endif
                  @elseif(\App\RoleUsers::where('user_id', Auth::id())->first()->role_id = 1)
                    <tr>
                        <td class="robot-actions">
                            <a href="{{ route('users.edit', $user->id) }}">
                                <i class="fa fa-pencil pull-left list-icon"></i>
                            </a>
                            <a href="{{ route('users.destroy', $user->id) }}" class="remove-confirm">
                                <i class="fa fa-trash pull-right list-icon"></i>
                            </a>
                            <a href="edit.blade.php"></a>
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->organisation_id != null ? $user->organisation()->first()->name : ""  }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->roles()->first()->name }}</td> 
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
