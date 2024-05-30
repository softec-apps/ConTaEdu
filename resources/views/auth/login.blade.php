<x-auth-layout>
	<div class="app-auth-body mx-auto">
		<div class="app-auth-branding mb-4"><a class="d-flex justify-content-center app-logo"
				href="{{ route('login') }}">
				<x-application-logo /></a></div>
		<h2 class="auth-heading text-center mb-5">Iniciar sesión en ConTaEdu</h2>
		<div class="auth-form-container text-start">
			<form method="POST" action="{{ route('login') }}" class="auth-form login-form">
				@csrf

				<div class="mb-3">
					<x-input-label for="email" class="sr-only" :value="__('Email')" />
					<x-text-input id="email" class="form-control signin-email" type="email" name="email" :value="old('email')"
						required placeholder="Email" autofocus autocomplete="username" />
					<x-input-error :messages="$errors->get('email')" class="mt-2" />
				</div>

				<div class="mb-3">
					<x-input-label for="password" class="sr-only" :value="__('Contraseña')" />

					<x-text-input id="password" class="form-control signin-password" type="password" name="password" required
						autocomplete="current-password" placeholder="Contraseña"/>
					<x-input-error :messages="$errors->get('password')" class="mt-2" />
				</div>

				<div class="text-center w-100">
					<button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Iniciar sesión</button>
				</div>
			</form>
		</div><!--//auth-form-container-->
	</div><!--//auth-body-->
</x-auth-layout>