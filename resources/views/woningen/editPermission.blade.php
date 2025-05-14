<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Woning Aanpassen</title>
    @vite(['resources/css/app.scss'])
</head>
<body>
  <div class="container">
  <div class="create-update-container">
    <h1 class="display-4">Vakantie Woningen</h1>

    <form method="post" action="/update/{{$roles->id}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                        <label for="role">Select Role for {{ $roles->name }}:</label>
                        <select name="permissions[{{ $roles->id }}][]" multiple>
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}"
                        @if ($role_has_permissions->where('roles_id', $roles->id)->pluck('permission_id')->contains($permission->id)) selected @endif
                    >
                        {{ $permission->name }}
                    </option>
                @endforeach
            </select>
            </div>
        <button type="submit" class="btn btn-primary" value="Upload">Opslaan</button>
        <a href="/woningen" class="btn btn-danger">Annuleer</a>
    </form>
    </div>
  </div>

</body>
</html>
