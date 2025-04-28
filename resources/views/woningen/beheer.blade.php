<x-app-layout>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
        <div class="table-responsive table">
            <table class="table-bordered table-striped table-hover">
                <thead class="header">
                    <tr>
                      <th>Naam</th>
                      <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($beheer as $user)
                <tr class="index-row">
                    <td>{{$user->name}}</td>
                    <td>
                        @php
                            $userRole = $model_has_roles->firstWhere('model_id', $user->id);
                            $roleName = null;

                            if ($userRole) {
                                $role = $roles->firstWhere('id', $userRole->role_id);
                                $roleName = $role ? $role->name : null;
                            }
                        @endphp

                        {{ $roleName ?? '-' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</body>
</html>
</x-app-layout>