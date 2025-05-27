<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Users / Create') }}
    </h2>
    <a href="{{ route('users.index') }}" class="bg-slate-700 text-sm rounded-md text-white px-5 py-2">Back</a>
  </div>
  </x-slot>
</x-app-layout>