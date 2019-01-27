<!--Костыль для отмены автозаполнения в хроме -->
<input id="username" style="display:none" type="text" name="email">
<input id="password" style="display:none" type="password" name="password">

<div class="form-group">
    <label for="name">Имя пользователя</label>
    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" id="name" placeholder="Имя пользователя"
           value="{{ old("name", $user->name ?? '') }}"
           autocomplete="off" required>
    @if($errors->has('name'))
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
    @endif
</div>
<div class="form-group">
    <label for="slug">E-mail</label>
    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" id="email" placeholder="E-mail"
           value="{{ old("email", $user->email ?? '') }}"
           autocomplete="off" required>
    @if($errors->has('email'))
        <div class="invalid-feedback">
            {{ $errors->first('email') }}
        </div>
    @endif
</div>
<div class="form-group">
    <label for="password">Пароль</label>
    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" id="password"
           placeholder="Новый пароль(оставьте пустым, чтобы не изменять пароль)"
           value="{{ old("password") }}"
           autocomplete="off"
           {{ $user ? '' : 'required' }}>
    @if($errors->has('password'))
        <div class="invalid-feedback">
            {{ $errors->first('password') }}
        </div>
    @endif
</div>
<div class="form-group">
    <label for="password_confirmation">Подтверждение пароля</label>
    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password_confirmation" id="password_confirmation"
           placeholder="Подтверждение пароля"
           value="{{ old("password_confirmation") }}"
           autocomplete="off"
            {{ $user ? '' : 'required' }}>
    @if($errors->has('password'))
        <div class="invalid-feedback">
            {{ $errors->first('password') }}
        </div>
    @endif
</div>
<div class="form-group">
    <label for="categories-on-main">Роль</label>
    <select id="categories-on-main" class="form-control" name="roles">
        @include('content-manage.users.partials.role')
    </select>
</div>