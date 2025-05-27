<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Articles/Lists') }}
      </h2>
      @can('create articles')
      <a href="{{ route('articles.create') }}" class="bg-slate-700 text-sm rounded-lg text-white px-5 py-2">Create</a>
      @endcan
    </div>
  </x-slot>
  <div class="py-12">
      <div class="max-w-7x1 max-auto sm:px-6 lg:px-8">
        <x-message></x-message>
        <table class="w-full">
          <thead class="bg-gray-50">
            <tr class="border-b">
              <th class="px-6 py-3 text-left">#</th>
              <th class="px-6 py-3 text-left">Title</th>
              <th class="px-6 py-3 text-left">Content</th>
              <th class="px-6 py-3 text-left">Author</th>
              <th class="px-6 py-3 text-left" width="200">Action</th>
            </tr>
            
              @if($articles->isNotEmpty())
              @foreach($articles as $article)
              <tr class="border-b">
                <td class="px-6 py-3 text-left">{{ $article->id }}</td>
                <td class="px-6 py-3 text-left">{{ $article->title }}</td>
                <td class="px-6 py-3 text-left">{{ $article->text }}</td>
                <td class="px-6 py-3 text-left">{{ $article->author }}</td>
                <td class="px-6 py-3 text-left" width="200">
                  @can('Edit Articles')
                  <a href="{{ route('articles.edit',$article->id) }}" class="bg-slate-700 text-sm rounded-md text-white px-3 py-2 hover:bg-slate-600">Edit</a>
                  @endcan
                  @can('Delete Articles')
                  <a href="javascript:void(0)" onClick="deleteArticle({{ $article->id }})" class="bg-red-700 text-sm rounded-md text-white px-3 py-2 hover:bg-red-600">Delete</a>
                  @endcan
                </td>
              </tr>
              @endforeach
              @endif
            
          </thead>
        </table>
        <div class="my-3">
          {{ $articles->links() }}
        </div>
      </div>
  </div>
  <x-slot name="script">
    <script type="text/javascript">
      function deleteArticle(id) {
        if(confirm("Are you sure you want to delete?")) {
          $ajax.({
            url:'{{ route("articles.destroy") }}',
            type:"delete",
            data:{id:id},
            dataType:'json',
            headers:[
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            ],
            success:function(data) {
              window.location.href= '{{ route("articles.index") }}'
            }
          })
        }
      }
    </script>
  </x-slot>
</x-app-layout>