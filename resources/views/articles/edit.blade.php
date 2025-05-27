<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <div class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Article / Edit') }}
      </div>
       <a href="{{ route('articles.index') }}" class="bg-slate-700 text-sm rounded-lg text-white py-2 px-5 ">Back</a>
    </div>
  </x-slot>
  <div class="py-12">
    <div class="max-w-7x1 mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <form action="{{ route('articles.update',$article->id) }}" method="post">
            @csrf
            <div>
              <label for="" class="text-lg font-medium">Title</label>
              <div class="my-3">
                  <input type="text" name="title" value="{{ old('title',$article->title) }}" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter Title">
                    @error('title')
                      <p class="text-red-400 font-medium">{{ $message }}</p>
                    @enderror
              </div>
              <label for="" class="text-lg font-medium">Content</label>
              <div class="my-3">
                <textarea name="text" class="border-gray-300 shadow-sm w-1/2 rounded-lg" row="5" cols="20" placeholder="Enter Content" value="{{ old('text',$article->text) }}">{{old('text',$article->text)}}</textarea>
                 @error('text')
                      <p class="text-red-400 font-medium">{{ $message }}</p>
                    @enderror
              </div>
              <label for="" class="text-lg font-medium">Author</label>
              <div class="my-3">
                  <input type="text" name="author" value="{{ old('author',$article->author) }}" class="border-gray-300 shadow-sm w-1/2 rounded-lg" placeholder="Enter Author">
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