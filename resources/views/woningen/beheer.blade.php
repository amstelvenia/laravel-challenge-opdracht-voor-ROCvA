<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
    <title>Beheer</title>
    @vite(['resources/css/app.scss'])
</head>
<body>
    <div class="home-container">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Beheer') }}
            </h2>
        </x-slot>
      <p class='swipe'>Swipe de tabel om meer te zien</p>

    <div class="tables">
        <!-- User to Roles -->
        <div class="table-responsive table table-center w-full overflow-x-auto">
              <table class="table-bordered table-striped table-hover w-full border-collapse table-auto">
                <h1>Role to User</h1>
                <thead class="header">
                    <tr>
                      <th>Naam</th>
                      <th>Rol</th>
                      <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($beheer as $user)
                <tr class="index-row">
                    <td>{{$user->name}}</td>
                    <td>
                    <form method="POST" action="/user_to_rol/{{$user->id}}">
                    @csrf
                    <select name="role" id="role" class="form-control">
                        @php
                            $userRole = $model_has_roles->firstWhere('model_id', $user->id);
                            $roleName = null;
                            $selectedRoleId = null;

                            if ($userRole) {
                                $role = $roles->firstWhere('id', $userRole->role_id);
                                $selectedRoleId = $role ? $role->id : null;
                            }
                        @endphp

                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $role->id == $selectedRoleId ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    </td>
                    <td>
                    <button type="submit" class="btn btn-primary" value="Upload">Opslaan</button>
                    </td>
                    </form>
                </tr>
                @endforeach
              </tbody>
              </table>
        </div>

        <!-- Roles to Permission -->
        <div class="table-responsive table table-center w-full overflow-x-auto">
            <table class="table-bordered table-striped table-hover w-full border-collapse table-auto">
            <h1>Role to Permission</h1>
                <thead class="header">
                    <tr>
                      <th>Rol</th>
                      <th>Permissions</th>
                      <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($roles as $role)
                    <tr class="index-row">
                        <td>{{ $role->name }}</td>
                        <td>
                            @php
                                // Filter permissions for this role
                                $rolePermissions = $role_has_permissions->where('role_id', $role->id);
                                // Get the permission names
                                $permissionNames = $rolePermissions->map(function ($rp) use ($permissions) {
                                    $permission = $permissions->firstWhere('id', $rp->permission_id);
                                    return $permission ? $permission->name : null;
                                })->filter(); // remove nulls
                            @endphp

                            @if ($permissionNames->isNotEmpty())
                                {{ $permissionNames->join(', ') }}
                            @else
                                No permissions found
                            @endif
                        </td>
                        <td><a href="/editPermission/{{$role->id}}" class="btn btn-primary edit">Update</a></td>
                    </tr>
                @endforeach
                <td></td>
                <td></td>
                <td><button type="submit" class="btn btn-primary" value="Upload">Add Role</button></td>
            </tbody>
            </table>
        </div>
      </div>
    </div>
</body>
</html>
</x-app-layout>
