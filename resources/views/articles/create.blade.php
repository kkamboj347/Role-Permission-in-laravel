<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Articles / Create') }}
      </h2>
      <a href="{{ route('articles.index')}}" class="bg-slate-700 text-sm rounded-lg text-white px-5 py-2">Back</a>
    </div>
  </x-slot>
  <div class="p-12">
    <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <form action="{{ route('articles.store') }}" method="post">
            @csrf
            <div>
              <label for="" class="text-lg font-medium">Title</label>
              <div class="my-3">
                  <input type="text" name="title" value="{{ old('title') }}" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter Title">
                    @error('title')
                      <p class="text-red-400 font-medium">{{ $message }}</p>
                    @enderror
              </div>
              <lable for="" class="text-lg font-medium">Content</label>
              <div class="my-3">
                <textarea name="text" cols="20" rows="5" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Content"></textarea>
                @error('text')
                  <p class="text-red-400 font-medium">{{ $message }}</p>
                @enderror
              </div>
              <label for="" class="text-lg font-medium">Author</label>
              <div class="my-3">
                <input type="text" value="{{ old('author') }}" name="author" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter Author">
                @error('author')
                  <p class="text-red-400 font-medium">{{ $message }}</p>
                @enderror
              </div>
              <button class="bg-slate-700 text-sm rounded-md text-white px-5 py-3">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>