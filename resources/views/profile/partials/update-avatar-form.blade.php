<!-- resources/views/profile/partials/update-avatar-form.blade.php -->

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Avatar') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Upload a new avatar to display on your profile.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('profile.update.avatar') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        <!-- Display current avatar -->
        <div class="mb-4">
            <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('default-avatar.png') }}" 
                 alt="Current Avatar" 
                 class="rounded-full h-20 w-20 object-cover">
        </div>

        <div>
            <x-input-label for="avatar" :value="__('Avatar')" />
            <input type="file" name="avatar" id="avatar" class="block mt-1 w-full" accept="image/*">
            <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
