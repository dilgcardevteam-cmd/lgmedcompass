<section x-data="{ editing: false }">
    <header class="flex items-start justify-between gap-4">
        <div>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Personal Info') }}
            </h2>
 
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Manage your personal information.') }}
            </p>
        </div>
 
        <x-primary-button
            type="button"
            x-show="!editing"
            x-on:click="editing = true"
            class="btn-edit flex items-center gap-2">

            <i class="uil uil-edit"></i>
            {{ __('Edit') }}
        </x-primary-button>

     </header>
 
     <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
         @csrf
         @method('patch')
 
         <div>
          
                <x-input-label for="name" :value="__('Name')" />
 
            <template x-if="editing">
                <div>
                    <x-texts-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                </div>
            </template>
            <p x-show="!editing" class="mt-1 text-lg font-semibold text-gray-900">{{ $user->name }}</p>
             <x-input-error class="mt-2" :messages="$errors->get('name')" />
         </div>
 
         <div>
          
               <x-input-label for="birthdate" :value="__('Birthdate')" />
            
            <template x-if="editing">
                <div>
                    <x-texts-input id="birthdate" name="birthdate" type="date" class="mt-1 block w-full" :value="old('birthdate', optional($user->birthdate)->format('Y-m-d') ?? $user->birthdate)" autocomplete="bday" />
                </div>
            </template>
            <p x-show="!editing" class="mt-1 text-lg font-semibold text-gray-900">{{ $user->birthdate ? \Illuminate\Support\Carbon::parse($user->birthdate)->format('F j, Y') : __('Not specified') }}</p>
            <x-input-error class="mt-2" :messages="$errors->get('birthdate')" />
         </div>
 
        <div>
            <div>
                <x-input-label for="section" :value="__('Section')" />

                    <p class="mt-1 text-lg font-semibold text-gray-900">
                        {{ optional($user->section)->name ?? __('Not specified') }}
                    </p>
            </div>

            <x-input-error class="mt-2" :messages="$errors->get('section_id')" />
        </div>

        <div>
           
               <x-input-label for="position" :value="__('Position')" />
       
               <template x-if="editing">
                 <div>
                    <x-texts-input id="position" name="position" type="text" class="mt-1 block w-full" :value="old('position', $user->position)" autocomplete="organization-title" />
                </div>
            </template>
            <p x-show="!editing" class="mt-1 text-lg font-semibold text-gray-900">{{ $user->position ?: __('Not specified') }}</p>
            <x-input-error class="mt-2" :messages="$errors->get('position')" />
        </div>

        <div>
            <x-input-label for="role" :value="__('Role')" />
            <p class="mt-1 text-lg font-semibold text-gray-900">{{ $user->role ?: __('Not specified') }}</p>
         </div>
 
        <div class="flex items-center gap-4" x-show="editing" x-cloak>
            <x-primary-button
                class="btn-save flex items-center gap-2">

                <i class="uil uil-save"></i>
                {{ __('Save') }}
            </x-primary-button>

            <x-secondary-button
                type="button"
                x-on:click="editing = false; $el.closest('form').reset();"
                class="btn-cancel flex items-center gap-2">

                <i class="uil uil-times"></i>
                {{ __('Cancel') }}
            </x-secondary-button>

 
             @if (session('status') === 'profile-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    x-init="setTimeout(() => show = false, 3000)"
                    class="fixed top-5 right-5 z-50 flex items-center gap-3 rounded-lg bg-[#05C274] px-5 py-3 text-white shadow-lg">

                    <i class="uil uil-check-circle text-xl"></i>
                    <span class="font-medium">Changes saved successfully.</span>
                </div>
            @endif

         </div>
     </form>
     <style>
        /* EDIT BUTTON */
        .btn-edit {
            background-color: #0C8EF4;
            color: #fff;
        }

        .btn-edit:hover {
            background-color: #0A7CD6;
        }

        /* SAVE BUTTON */
        .btn-save {
            background-color: #05C274;
            color: #fff;
        }

        .btn-save:hover {
            background-color: #04A764;
        }

        /* CANCEL BUTTON (optional styling) */
        .btn-cancel {
            background-color: #e5e7eb;
            color: #374151;
        }

        .btn-cancel:hover {
            background-color: #d1d5db;
        }
     </style>
 </section>